@extends('layouts.main')
@section('content')
    <div class="container py-4 flex items-center gap-3">
        <a href="{{ route('home.index') }}" class="text-primary text-base">
            <i class="fa-solid fa-house"></i>
        </a>
        <span class="text-sm text-gray-400">
            <i class="fa-solid fa-chevron-right"></i>
        </span>
        <p class="text-gray-600 font-medium">Account</p>
    </div>
    <!-- ./breadcrumb -->

    <!-- account wrapper -->
    <div class="container grid grid-cols-12 items-start gap-6 pt-4 pb-16">

        <!-- sidebar -->
        <div class="col-span-3">
            <div class="px-4 py-3 shadow flex items-center gap-4">
                <div class="flex-shrink-0">
                    <img src="{{ asset('/assets/images/avatar.png') }}" alt="profile"
                        class="rounded-full w-14 h-14 border border-gray-200 p-1 object-cover">
                </div>
                <div class="flex-grow">
                    <p class="text-gray-600">Hello,</p>
                    <h4 class="text-gray-800 font-medium">{{ $profile->data->first_name }} {{ $profile->data->last_name }}
                    </h4>
                </div>
            </div>

            <div class="mt-6 bg-white shadow rounded p-4 divide-y divide-gray-200 space-y-4 text-gray-600">
                <div class="space-y-1 pl-8">
                    <a href="{{ route('profile.index') }}"
                        class="relative text-primary block font-medium capitalize transition">
                        <span class="absolute -left-8 top-0 text-base">
                            <i class="fa-regular fa-address-card"></i>
                        </span>
                        Manage account
                    </a>
                    {{-- <a href="#" class="relative hover:text-primary block capitalize transition">
                        Profile information
                    </a>
                    <a href="#" class="relative hover:text-primary block capitalize transition">
                        Manage addresses
                    </a>
                    <a href="#" class="relative hover:text-primary block capitalize transition">
                        Change password
                    </a> --}}
                </div>

                <div class="space-y-1 pl-8 pt-4">
                    <a href="{{ route('profile.orders.index', $profile->data->user->username) }}" id="order-history"
                        class="relative hover:text-primary block font-medium capitalize transition">
                        <span class="absolute -left-8 top-0 text-base">
                            <i class="fa-solid fa-box-archive"></i>
                        </span>
                        My order history
                    </a>
                    {{-- <a href="#" class="relative hover:text-primary block capitalize transition">
                        My returns
                    </a>
                    <a href="#" class="relative hover:text-primary block capitalize transition">
                        My Cancellations
                    </a>
                    <a href="#" class="relative hover:text-primary block capitalize transition">
                        My reviews
                    </a> --}}
                </div>

                {{-- <div class="space-y-1 pl-8 pt-4">
                    <a href="#" class="relative hover:text-primary block font-medium capitalize transition">
                        <span class="absolute -left-8 top-0 text-base">
                            <i class="fa-regular fa-credit-card"></i>
                        </span>
                        Payment methods
                    </a>
                    <a href="#" class="relative hover:text-primary block capitalize transition">
                        voucher
                    </a>
                </div>

                <div class="space-y-1 pl-8 pt-4">
                    <a href="#" class="relative hover:text-primary block font-medium capitalize transition">
                        <span class="absolute -left-8 top-0 text-base">
                            <i class="fa-regular fa-heart"></i>
                        </span>
                        My wishlist
                    </a>
                </div> --}}

                <div class="space-y-1 pl-8 pt-4">
                    <a href="#" class="relative hover:text-primary block font-medium capitalize transition">
                        <span class="absolute -left-8 top-0 text-base">
                            <i class="fa-regular fa-arrow-right-from-bracket"></i>
                        </span>
                        Logout
                    </a>
                </div>

            </div>
        </div>
        <!-- ./sidebar -->

        <!-- info -->

        <div class="col-span-9 border border-gray-200 p-4 rounded">
            <h3 class="text-lg font-medium capitalize mb-4">My Profile</h3>
            <form action="{{ route('profile.update', $profile->data->user->username) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="first_name" class="text-gray-600">First Name <span
                                    class="text-primary">*</span></label>
                            <input type="text" name="first_name" id="first_name" class="input-box"
                                value="{{ $profile->data->first_name ?? '' }}">
                        </div>
                        <div>
                            <label for="last_name" class="text-gray-600">Last Name <span
                                    class="text-primary">*</span></label>
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
                    <div class="flex flex-row-reverse">
                        <button type="submit"
                            class="basis-2/6 block w-full py-2 text-center text-white bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium">Update</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- ./info -->

    </div>
@endsection

@section('script')
    <script>
        @if ($message = session('error'))
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
                icon: "error",
                title: '{{ $message }}'
            });
        @endif
        @if ($message = session('success'))
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
                title: '{{ $message }}'
            });
        @endif
    </script>
@endsection
