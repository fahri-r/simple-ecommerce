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
        <p class="text-gray-600 font-medium">Product</p>
    </div>
    <!-- ./breadcrumb -->

    <!-- product-detail -->
    <div class="container grid grid-cols-2 gap-6">
        <div>
            <img src="{{ $product->data->image->url }}" alt="product" class="w-full">
            {{-- <div class="grid grid-cols-5 gap-4 mt-4">
                <img src="../assets/images/products/product2.jpg" alt="product2"
                    class="w-full cursor-pointer border border-primary">
                <img src="../assets/images/products/product3.jpg" alt="product2" class="w-full cursor-pointer border">
                <img src="../assets/images/products/product4.jpg" alt="product2" class="w-full cursor-pointer border">
                <img src="../assets/images/products/product5.jpg" alt="product2" class="w-full cursor-pointer border">
                <img src="../assets/images/products/product6.jpg" alt="product2" class="w-full cursor-pointer border">
            </div> --}}
        </div>

        <div>
            <h2 class="text-3xl font-medium uppercase mb-2">{{ $product->data->name }}</h2>
            <div class="flex items-center mb-4">
                <div class="flex gap-1 text-sm text-yellow-400">
                    <span><i class="fa-solid fa-star"></i></span>
                    <span><i class="fa-solid fa-star"></i></span>
                    <span><i class="fa-solid fa-star"></i></span>
                    <span><i class="fa-solid fa-star"></i></span>
                    <span><i class="fa-solid fa-star"></i></span>
                </div>
                <div class="text-xs text-gray-500 ml-3">(150 Reviews)</div>
            </div>
            <div class="space-y-2">
                <p class="text-gray-800 font-semibold space-x-2">
                    <span>Availability: </span>
                    <span class="text-green-600">In Stock</span>
                </p>
                <p class="space-x-2">
                    <span class="text-gray-800 font-semibold">Brand: </span>
                    <span class="text-gray-600">Apex</span>
                </p>
                <p class="space-x-2">
                    <span class="text-gray-800 font-semibold">Category: </span>
                    <span class="text-gray-600">Sofa</span>
                </p>
                <p class="space-x-2">
                    <span class="text-gray-800 font-semibold">SKU: </span>
                    <span class="text-gray-600">BE45VGRT</span>
                </p>
            </div>
            <div class="flex items-baseline mb-1 space-x-2 font-roboto mt-4">
                <p class="text-xl text-primary font-semibold">${{ $product->data->price }}</p>
                {{-- <p class="text-base text-gray-400 line-through">$55.00</p> --}}
            </div>

            <p class="mt-4 text-gray-600">{{ $product->data->description }}</p>

            {{-- <div class="pt-4">
                <h3 class="text-sm text-gray-800 uppercase mb-1">Size</h3>
                <div class="flex items-center gap-2">
                    <div class="size-selector">
                        <input type="radio" name="size" id="size-xs" class="hidden">
                        <label for="size-xs"
                            class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">XS</label>
                    </div>
                    <div class="size-selector">
                        <input type="radio" name="size" id="size-sm" class="hidden">
                        <label for="size-sm"
                            class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">S</label>
                    </div>
                    <div class="size-selector">
                        <input type="radio" name="size" id="size-m" class="hidden">
                        <label for="size-m"
                            class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">M</label>
                    </div>
                    <div class="size-selector">
                        <input type="radio" name="size" id="size-l" class="hidden">
                        <label for="size-l"
                            class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">L</label>
                    </div>
                    <div class="size-selector">
                        <input type="radio" name="size" id="size-xl" class="hidden">
                        <label for="size-xl"
                            class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">XL</label>
                    </div>
                </div>
            </div>

            <div class="pt-4">
                <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">Color</h3>
                <div class="flex items-center gap-2">
                    <div class="color-selector">
                        <input type="radio" name="color" id="red" class="hidden">
                        <label for="red"
                            class="border border-gray-200 rounded-sm h-6 w-6  cursor-pointer shadow-sm block"
                            style="background-color: #fc3d57;"></label>
                    </div>
                    <div class="color-selector">
                        <input type="radio" name="color" id="black" class="hidden">
                        <label for="black"
                            class="border border-gray-200 rounded-sm h-6 w-6  cursor-pointer shadow-sm block"
                            style="background-color: #000;"></label>
                    </div>
                    <div class="color-selector">
                        <input type="radio" name="color" id="white" class="hidden">
                        <label for="white"
                            class="border border-gray-200 rounded-sm h-6 w-6  cursor-pointer shadow-sm block"
                            style="background-color: #fff;"></label>
                    </div>

                </div>
            </div> --}}

            <div class="mt-4">
                <h3 class="text-sm text-gray-800 uppercase mb-1">Quantity</h3>
                <div class="flex border border-gray-300 text-gray-600 divide-x divide-gray-300 w-max">
                    <div class="h-8 w-8 text-xl flex items-center justify-center cursor-pointer select-none"
                        onclick="minQuantity()">-</div>
                    <div class="h-8 w-8 text-base flex items-center justify-center" id="quantity">1</div>
                    <div class="h-8 w-8 text-xl flex items-center justify-center cursor-pointer select-none"
                        onclick="plusQuantity()">+</div>
                </div>
            </div>

            <div class="mt-6 flex gap-3 border-b border-gray-200 pb-5 pt-5">
                <button onclick="storeCart('{{ $product->data->id }}')"
                    class="bg-primary border border-primary text-white px-8 py-2 font-medium rounded uppercase flex items-center gap-2 hover:bg-transparent hover:text-primary transition">
                    <i class="fa-solid fa-bag-shopping"></i> Add to cart
                </button>
                <button
                    class="border border-gray-300 text-gray-600 px-8 py-2 font-medium rounded uppercase flex items-center gap-2 hover:text-primary transition">
                    <i class="fa-solid fa-heart"></i> Wishlist
                </button>
            </div>

            {{-- <div class="flex gap-3 mt-4">
                <a href="#"
                    class="text-gray-400 hover:text-gray-500 h-8 w-8 rounded-full border border-gray-300 flex items-center justify-center">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
                <a href="#"
                    class="text-gray-400 hover:text-gray-500 h-8 w-8 rounded-full border border-gray-300 flex items-center justify-center">
                    <i class="fa-brands fa-twitter"></i>
                </a>
                <a href="#"
                    class="text-gray-400 hover:text-gray-500 h-8 w-8 rounded-full border border-gray-300 flex items-center justify-center">
                    <i class="fa-brands fa-instagram"></i>
                </a>
            </div> --}}
        </div>
    </div>
    <!-- ./product-detail -->
@endsection



@section('script')
    <script>
        function minQuantity() {
            let qtyElement = document.getElementById(`quantity`);
            let val = Number(qtyElement.innerHTML) - 1;
            qtyElement.innerHTML = val;
        };

        function plusQuantity() {
            let qtyElement = document.getElementById(`quantity`);
            let val = Number(qtyElement.innerHTML) + 1;
            qtyElement.innerHTML = val;
        };

        const username = getCookie('username');
        const token = `Bearer ${getCookie('token')}`
        const config = {
            'headers': {
                'Authorization': token,
            }
        }

        function storeCart(id) {
            let quantity = document.getElementById(`quantity`).innerHTML;
            axios.post(`/api/v1/profile/${username}/carts`, {
                    'product_id': id,
                    'quantity': quantity
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
                });
        };
    </script>
@endsection
