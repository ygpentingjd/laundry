@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h1>Create New Order</h1>

                <form action="{{ route('orders.store') }}" method="POST" id="orderForm">
                    @csrf

                    <div class="mb-3">
                        <label for="customer_id" class="form-label">Customer</label>
                        <select class="form-select @error('customer_id') is-invalid @enderror" id="customer_id" name="customer_id" required>
                            <option value="">Select Customer</option>
                            @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                {{ $customer->name }} - {{ $customer->phone }}
                            </option>
                            @endforeach
                        </select>
                        @error('customer_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="card mb-3">
                        <div class="card-header">
                            Services
                        </div>
                        <div class="card-body">
                            <div id="services-container">
                                <div class="service-item mb-3">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <select class="form-select service-select" name="services[]" required>
                                                <option value="">Select Service</option>
                                                @foreach($services as $service)
                                                <option value="{{ $service->id }}" data-price="{{ $service->price }}">
                                                    {{ $service->name }} - Rp{{ number_format($service->price, 0, ',', '.') }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number" class="form-control quantity-input" name="quantities[]" placeholder="Quantity" min="1" required>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control subtotal" readonly>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-danger btn-sm remove-service">×</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary btn-sm mt-2" id="add-service">Add Service</button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                        @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Total Amount</label>
                        <input type="text" class="form-control" id="total_amount" name="total_amount" readonly>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Create Order</button>
                        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const servicesContainer = document.getElementById('services-container');
        const addServiceBtn = document.getElementById('add-service');
        const firstServiceItem = document.querySelector('.service-item');

        // Function to update subtotal and total
        function updateTotals() {
            let total = 0;
            document.querySelectorAll('.service-item').forEach(item => {
                const serviceSelect = item.querySelector('.service-select');
                const quantityInput = item.querySelector('.quantity-input');
                const subtotalInput = item.querySelector('.subtotal');

                if (serviceSelect.value && quantityInput.value) {
                    const price = parseFloat(serviceSelect.options[serviceSelect.selectedIndex].dataset.price);
                    const quantity = parseInt(quantityInput.value);
                    const subtotal = price * quantity;
                    subtotalInput.value = 'Rp' + subtotal.toLocaleString('id-ID');
                    total += subtotal;
                }
            });

            document.getElementById('total_amount').value = 'Rp' + total.toLocaleString('id-ID');
        }

        // Add new service row
        addServiceBtn.addEventListener('click', function() {
            const newService = firstServiceItem.cloneNode(true);
            newService.querySelectorAll('input').forEach(input => input.value = '');
            newService.querySelector('select').selectedIndex = 0;
            servicesContainer.appendChild(newService);

            // Add event listeners to new elements
            addServiceListeners(newService);
        });

        // Function to add event listeners to service item
        function addServiceListeners(serviceItem) {
            const removeBtn = serviceItem.querySelector('.remove-service');
            const serviceSelect = serviceItem.querySelector('.service-select');
            const quantityInput = serviceItem.querySelector('.quantity-input');

            removeBtn.addEventListener('click', function() {
                if (document.querySelectorAll('.service-item').length > 1) {
                    serviceItem.remove();
                    updateTotals();
                }
            });

            serviceSelect.addEventListener('change', updateTotals);
            quantityInput.addEventListener('input', updateTotals);
        }

        // Add listeners to initial service item
        addServiceListeners(firstServiceItem);
    });
</script>
@endpush
@endsection