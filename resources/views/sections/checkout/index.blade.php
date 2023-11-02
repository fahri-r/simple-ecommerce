@extends('layouts.main')
@section('content')
    <div class="container py-4 flex items-center gap-3">
        <a href="{{ route('home.index') }}" class="text-primary text-base">
            <i class="fa-solid fa-house"></i>
        </a>
        <span class="text-sm text-gray-400">
            <i class="fa-solid fa-chevron-right"></i>
        </span>
        <p class="text-gray-600 font-medium">Checkout</p>
    </div>
    <!-- ./breadcrumb -->

    <!-- wrapper -->
    <div class="container grid grid-cols-12 items-start pb-16 pt-4 gap-6">

        <div class="col-span-8 border border-gray-200 p-4 rounded">
            <h3 class="text-lg font-medium capitalize mb-4">Checkout</h3>
            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="first_name" class="text-gray-600">First Name <span class="text-primary">*</span></label>
                        <input type="text" name="first_name" id="first_name" class="input-box"
                            value="{{ $profile->data->first_name ?? '' }}">
                    </div>
                    <div>
                        <label for="last_name" class="text-gray-600">Last Name <span class="text-primary">*</span></label>
                        <input type="text" name="last_name" id="last_name" class="input-box"
                            value="{{ $profile->data->last_name ?? '' }}">
                    </div>
                </div>
                <div>
                    <label for="address" class="text-gray-600">Address</label>
                    <textarea type="text" name="address" id="address" class="input-box">{{ $profile->data->address ?? '' }}</textarea>
                </div>
                <div>
                    <label for="city" class="text-gray-600">City</label>
                    <input type="text" name="city" id="city" class="input-box"
                        value="{{ $profile->data->city ?? '' }}">
                </div>
                <div>
                    <label for="postal_code" class="text-gray-600">Postal Code</label>
                    <input type="text" name="postal_code" id="postal_code" class="input-box"
                        value="{{ $profile->data->postal_code ?? '' }}">
                </div>
                <div>
                    <label for="phone" class="text-gray-600">Phone Number</label>
                    <input type="text" name="phone" id="phone" class="input-box"
                        value="{{ $profile->data->phone ?? '' }}">
                </div>
                <div>
                    <label for="email" class="text-gray-600">Email address</label>
                    <input type="email" name="email" id="email" class="input-box"
                        value="{{ $profile->data->user->email ?? '' }}">
                </div>
            </div>

        </div>

        <div class="col-span-4 border border-gray-200 p-4 rounded">
            <h4 class="text-gray-800 text-lg mb-4 font-medium uppercase">order summary</h4>
            <div class="space-y-2">
                <?php $sum_price = 0; ?>
                @if (isset($carts->data))
                    @foreach ($carts->data as $c)
                        <div class="flex justify-between">
                            <div>
                                <h5 class="text-gray-800 font-medium line-clamp-1">{{ $c->product->name }}</h5>
                            </div>
                            <input class="text-gray-600 w-20 h-8" type="number" id="quantity-{{ $c->id }}"
                                value="{{ $c->quantity }}"
                                onchange="updateQuantity({{ $c->id }}, {{ $c->product->id }})">
                            <p class="text-gray-800 font-medium" id="total-item-price-{{ $c->id }}">
                                ${{ $c->quantity * $c->product->price }}</p>
                        </div>
                        <?php $sum_price += $c->quantity * $c->product->price; ?>
                    @endforeach
                @endif
            </div>

            {{-- <div class="flex justify-between border-b border-gray-200 mt-1 text-gray-800 font-medium py-3 uppercas">
                <p>subtotal</p>
                <p>$1280</p>
            </div> --}}

            <div class="flex justify-between border-b border-gray-200 mt-1 text-gray-800 font-medium py-3 uppercas">
                <p>Shipping</p>
                <p>Free</p>
            </div>

            <div class="flex justify-between text-gray-800 font-medium py-3 uppercas">
                <p class="font-semibold">Total</p>
                <p>${{ $sum_price }}</p>
            </div>

            <div class="flex items-center mb-4 mt-2">
                <input type="checkbox" name="aggrement" id="aggrement"
                    class="text-primary focus:ring-0 rounded-sm cursor-pointer w-3 h-3">
                <label for="aggrement" class="text-gray-600 ml-3 cursor-pointer text-sm">I agree to the <a href="#"
                        class="text-primary">terms & conditions</a></label>
            </div>

            <button onclick="storeOrder()"
                class="block w-full py-3 px-4 text-center text-white bg-primary border border-primary rounded-md hover:bg-transparent hover:text-primary transition font-medium">Place
                order</button>
        </div>

    </div>
@endsection


@section('script')
    <script>
        let username = getCookie('username');
        let token = `Bearer ${getCookie('token')}`;
        let config = {
            'headers': {
                'Authorization': token,
            }
        };

        function updateQuantity(id, product_id) {
            let qty = document.getElementById(`quantity-${id}`).value;
            axios.put(`/api/v1/profile/${username}/carts/${id}`, {
                    'product_id': product_id,
                    'quantity': qty
                }, config)
                .then((response) => {
                    console.log(response);
                    let total_price = response.data.data.quantity * response.data.data.product.price;
                    document.getElementById(`total-item-price-${id}`).innerHTML = `$${total_price}`;
                });
        };

        function storeOrder() {
            axios.post(`/api/v1/profile/${username}/orders`, {}, config)
                .then((response) => {
                    console.log(response);
                })
                .catch((err) => {
                    window.location.href = "{{ route('login.index') }}"\;
                });
        };
    </script>
@endsection
