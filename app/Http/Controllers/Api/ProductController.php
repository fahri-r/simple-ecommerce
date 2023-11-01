<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\File;
use App\Models\Product;
use Illuminate\Http\Request;
use stdClass;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->has('page') ? $request->input('page') : 1;
        $per_page = $request->has('per_page') ? (int) $request->input('per_page') : 10;
        $data = new Product();

        if($request->has('random') && $request->input('random') == true) {
            $data = $data->inRandomOrder()->paginate($per_page, ['*'], 'page', $page);
        } else {
            $data = $data->paginate($per_page, ['*'], 'page', $page);
        }

        $return_data = ProductResource::collection($data->items());

        return response()->json([
            'success' => true,
            "data" => $return_data,
            'total' => $data->total(),
            'per_page' => $data->perPage(),
            'page' => $data->currentPage(),
        ]);
    }


    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();
        $validated = $request->safe();


        $data = Product::create([
            'name' => $validated->name,
            'description' => $validated->description,
            'stock' => $validated->stock,
            'price' => $validated->price,
        ]);

        if ($request->has('image')) {
            $file = $request->file('image')->storeOnCloudinary();

            $file_result = File::create([
                'url' => $file->getSecurePath(),
                'name' => $file->getOriginalFileName(),
                'type' => $file->getFileType(),
                'size' => $file->getSize(),
            ]);
            $data->image()->associate($file_result);
            $data->save();
        }

        return response()->json([
            "success" => true,
            "message" => "Product created successfully.",
            "data" => new ProductResource($data)
        ], 201);
    }


    public function show($id)
    {
        $data = Product::find($id);

        if (is_null($data)) {
            return response()->json([
                "success" => false,
                "message" => "Product not found.",
                "data" => new stdClass()
            ], 404);
        }

        return response()->json([
            "success" => true,
            "message" => "Product retrieved successfully.",
            "data" => new ProductResource($data)
        ]);
    }


    public function update(UpdateProductRequest $request, $id)
    {
        $data = Product::find($id);

        if (is_null($data)) {
            return response()->json([
                "success" => false,
                "message" => "Product not found.",
                "data" => new stdClass()
            ], 404);
        }

        $validated = $request->validated();
        $validated = $request->safe();

        if ($request->has('image')) {
            $file = $request->file('image')->storeOnCloudinary();

            $file_result = File::create([
                'url' => $file->getSecurePath(),
                'name' => $file->getOriginalFileName(),
                'type' => $file->getFileType(),
                'size' => $file->getSize(),
            ]);
            $data->image()->associate($file_result);
            $data->save();
        }
        
        $data->name = $validated->name;
        $data->description = $validated->description;
        $data->stock = $validated->stock;
        $data->price = $validated->price;
        $data->image_id = $file_result->file_id ?? $data->image_id;
        $data->save();

        return response()->json([
            "success" => true,
            "message" => "Product updated successfully.",
            "data" => new ProductResource($data)
        ]);
    }


    public function destroy($id)
    {
        $data = Product::find($id);
        if (is_null($data)) {
            return response()->json([
                "success" => false,
                "message" => "Product not found.",
                "data" => new stdClass()
            ], 404);
        }

        $data->delete();

        return response()->json([
            "success" => true,
            "message" => "Product deleted successfully.",
            "data" => new ProductResource($data)
        ]);
    }
}
