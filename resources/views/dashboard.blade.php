@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Dashboard</h1>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Customers</h5>
                        <p class="card-text">Manage your customers</p>
                        <a href="{{ route('customers.index') }}" class="btn btn-primary">View Customers</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Services</h5>
                        <p class="card-text">Manage laundry services</p>
                        <a href="{{ route('services.index') }}" class="btn btn-primary">View Services</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Orders</h5>
                        <p class="card-text">Manage customer orders</p>
                        <a href="{{ route('orders.index') }}" class="btn btn-primary">View Orders</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection