@extends('layouts.auth')
@section('content')
    <div class="contain py-16">
        <div class="max-w-lg mx-auto shadow px-6 py-7 rounded overflow-hidden">
            <h2 class="text-2xl uppercase font-medium mb-1">Payment Confirmation</h2>
            <p class="text-gray-600 mb-6 text-sm">
                Order # {{ $order_id }}
            </p>
            <form
                action="{{ route('profile.orders.payments.update', [
                    'profile' => $username,
                    'orders' => $order_id,
                    'payments' => $order_id,
                ]) }}"
                method="POST" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="space-y-2">
                    <div>
                        <label for="provider" class="text-gray-600 mb-2 block">Provider</label>
                        <input type="text" name="provider" id="provider"
                            value="{{ isset($payments->provider) ? $payments->provider : '' }}"
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border- placeholder-gray-400"
                            placeholder="BCA">
                    </div>
                    <div>
                        <label for="amount" class="text-gray-600 mb-2 block">Amount</label>
                        <input type="number" name="amount" id="amount"
                            value="{{ isset($payments->amount) ? $payments->amount : '' }}"
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                            placeholder="100000">
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit"
                        class="block w-full py-2 text-center text-white bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium">Confirm</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        @if ($message = session('errors'))
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
    </script>
@endsection
