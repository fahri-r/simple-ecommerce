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
                    <h4 class="text-gray-800 font-medium">John Doe</h4>
                </div>
            </div>

            <div class="mt-6 bg-white shadow rounded p-4 divide-y divide-gray-200 space-y-4 text-gray-600">
                <div class="space-y-1 pl-8">
                    <a href="{{ route('profile.index') }}"
                        class="relative hover:text-primary block font-medium capitalize transition">
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
                    <a href="#" id="order-history"
                        class="relative text-primary block font-medium capitalize transition">
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
        <div class="col-span-9 grid grid-cols-3 gap-4">
            @if (isset($orders->data))
                @foreach ($orders->data as $o)
                    <div class="shadow rounded bg-white px-4 pt-6 pb-8 flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-medium text-gray-800 text-lg">Order#{{ $o->id }}</h3>
                            <button onclick="downloadInvoice('{{ $o->id }}')" class="text-primary">Invoice</button>
                        </div>
                        <ul class="list-disc list-inside">
                            @foreach ($o->details as $d)
                                <li class="text-gray-800 " id="product-{{ $d->id }}"></li>
                            @endforeach
                        </ul>
                        <p class="text-gray-800">${{ $o->price_total }}</p>
                    </div>
                @endforeach
            @endif

        </div>
        <!-- ./info -->

    </div>
@endsection

@section('script')
    <script>
        let username = getCookie('username');
        let url = '{{ route('profile.orders.index', ':username') }}';
        url = url.replace(':username', username);
        document.getElementById('order-history').href = url;

        $(document).ready(function() {
            for (let elem of document.querySelectorAll("[id^=product]")) {
                fetchProduct(elem.id.split('-')[1]);
            }
        });

        const fetchProduct = async (id) => {
            const response = await axios.get(
                `/api/v1/products/${id}`
            );
            document.getElementById(`product-${id}`).innerHTML = response.data.data.name;
        };


        let token = `Bearer ${getCookie('token')}`;
        let config = {
            responseType: 'blob',
            'headers': {
                'Authorization': token,
            }
        };

        function downloadInvoice(id) {
            axios.get(`/api/v1/profile/${username}/orders/${id}/invoice`, config)
                .then((response) => {
                    console.log(response.data)
                    const blob = new Blob([response.data], {
                        type: 'application/pdf;'
                    });
                    const href = URL.createObjectURL(blob);

                    // create "a" HTML element with href to file & click
                    const link = document.createElement('a');
                    link.href = href;
                    link.setAttribute('download', 'invoice.pdf'); //or any other extension
                    document.body.appendChild(link);
                    link.click();

                    // clean up "a" element & remove ObjectURL
                    document.body.removeChild(link);
                    URL.revokeObjectURL(href);
                });
        };
    </script>
@endsection
