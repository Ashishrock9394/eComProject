@foreach ($orders as $order)
    <p>{{ $order->user->phone ?? 'N/A' }}</p>  {{-- Display each order's name --}}
@endforeach
