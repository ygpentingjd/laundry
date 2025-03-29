@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Order #{{ $order->id }}</h1>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to Orders</a>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        Customer Information
                    </div>
                    <div class="card-body">
                        <p><strong>Name:</strong> {{ $order->customer->name }}</p>
                        <p><strong>Phone:</strong> {{ $order->customer->phone }}</p>
                        <p><strong>Address:</strong> {{ $order->customer->address }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        Order Information
                    </div>
                    <div class="card-body">
                        <p><strong>Order Date:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
                        <p><strong>Status:</strong>
                            <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'processing' ? 'warning' : ($order->status === 'cancelled' ? 'danger' : 'info')) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </p>
                        <p><strong>Notes:</strong> {{ $order->notes ?? 'No notes' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Order Items
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Service</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $item)
                            <tr>
                                <td>{{ $item->service->name }}</td>
                                <td>Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                <td><strong>Rp{{ number_format($order->total_amount, 0, ',', '.') }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        @if($order->status !== 'completed' && $order->status !== 'cancelled')
        <div class="card mt-4">
            <div class="card-header">
                Update Order Status
            </div>
            <div class="card-body">
                <form action="{{ route('orders.update', $order) }}" method="POST" class="d-flex gap-2">
                    @csrf
                    @method('PUT')
                    <select name="status" class="form-select w-auto">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection