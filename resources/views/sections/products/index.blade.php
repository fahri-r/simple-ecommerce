@extends('layouts.main')
@section('content')
    <!-- breadcrumb -->
    <div class="container py-4 flex items-center gap-3">
        <a href="{{ route('home.index') }}" class="text-primary text-base">
            <i class="fa-solid fa-house"></i>
        </a>
        <span class="text-sm text-gray-400">
            <i class="fa-solid fa-chevron-right"></i>
        </span>
        <p class="text-gray-600 font-medium">Shop</p>
    </div>
    <!-- ./breadcrumb -->

    <!-- shop wrapper -->
    <div class="container grid md:grid-cols-4 grid-cols-2 gap-6 pt-4 pb-16 items-start">

        <!-- products -->
        <div class="col-span-4">
            <div class="flex items-center mb-4">
                <select name="sort" id="sort"
                    class="w-44 text-sm text-gray-600 py-3 px-4 border-gray-300 shadow-sm rounded focus:ring-primary focus:border-primary">
                    <option value="">Default sorting</option>
                    <option value="price-low-to-high">Price low to high</option>
                    <option value="price-high-to-low">Price high to low</option>
                    <option value="latest">Latest product</option>
                </select>

                <div class="flex gap-2 ml-auto">
                    <div
                        class="border border-primary w-10 h-9 flex items-center justify-center text-white bg-primary rounded cursor-pointer">
                        <i class="fa-solid fa-grip-vertical"></i>
                    </div>
                    <div
                        class="border border-gray-300 w-10 h-9 flex items-center justify-center text-gray-600 rounded cursor-pointer">
                        <i class="fa-solid fa-list"></i>
                    </div>
                </div>
            </div>

            <div class="grid md:grid-cols-3 grid-cols-2 gap-6">
                @foreach ($products->data as $p)
                    <div class="bg-white shadow rounded overflow-hidden group">
                        <div class="relative">
                            <img src="{{ isset($p->image) ? $p->image->url : asset('/assets/images/product-placeholder.png') }}"
                                alt="{{ isset($p->image) ? $p->image->name : 'Product' }}" class="w-full">
                            <div
                                class="absolute inset-0 bg-black bg-opacity-40 flex items-center 
                    justify-center gap-2 opacity-0 group-hover:opacity-100 transition">
                                <a href="{{ route('products.show', $p->id) }}"
                                    class="text-white text-lg w-9 h-8 rounded-full bg-primary flex items-center justify-center hover:bg-gray-800 transition"
                                    title="view product">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </a>
                                <a href="#"
                                    class="text-white text-lg w-9 h-8 rounded-full bg-primary flex items-center justify-center hover:bg-gray-800 transition"
                                    title="add to wishlist">
                                    <i class="fa-solid fa-heart"></i>
                                </a>
                            </div>
                        </div>
                        <div class="pt-4 pb-3 px-4">
                            <a href="#">
                                <h4
                                    class="uppercase font-medium text-xl mb-2 text-gray-800 hover:text-primary transition line-clamp-1">
                                    {{ $p->name }}</h4>
                            </a>
                            <div class="flex items-baseline mb-1 space-x-2">
                                <p class="text-xl text-primary font-semibold">${{ $p->price }}</p>
                            </div>
                            <div class="flex items-center">
                                <div class="flex gap-1 text-sm text-yellow-400">
                                    <span><i class="fa-solid fa-star"></i></span>
                                    <span><i class="fa-solid fa-star"></i></span>
                                    <span><i class="fa-solid fa-star"></i></span>
                                    <span><i class="fa-solid fa-star"></i></span>
                                    <span><i class="fa-solid fa-star"></i></span>
                                </div>
                                <div class="text-xs text-gray-500 ml-3">(150)</div>
                            </div>
                        </div>
                        <button onclick="storeCart({{ $p->id }})"
                            class="block w-full py-1 text-center text-white bg-primary border border-primary rounded-b hover:bg-transparent hover:text-primary transition">Add
                            to cart</button>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- ./products -->
    </div>
    <!-- ./shop wrapper -->
@endsection

@section('script')
    <script>
        const username = getCookie('username');
        const token = `Bearer ${getCookie('token')}`
        const config = {
            'headers': {
                'Authorization': token,
            }
        }

        function storeCart(id) {
            axios.post(`/api/v1/profile/${username}/carts`, {
                    'product_id': id,
                    'quantity': 1
                }, config)
                .then((response) => {


                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: "success",
                        title: "Product added to cart"
                    });

                })
                .catch((err) => {
                    window.location.href = "{{ route('login.index') }}";
                })
        };
    </script>
@endsection
