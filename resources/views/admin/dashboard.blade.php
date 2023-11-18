@extends('layouts.master')

@section('title')
    Admin Dashboard
@endsection

@section('dashboard')
    active
@endsection

@section('content')

<div class="row">
 
    <div class="col-md-4">
        <div class="card d-flex flex-column h-100">
            <div class="card-header">
                <h4 class="card-title">Total Users</h4>
            </div>
            <div class="card-body d-flex align-items-center justify-content-center">
                <h1 class="text-center">{{$total_users}}</h1>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card d-flex flex-column h-100">
            <div class="card-header">
                <h4 class="card-title">Recent Activities</h4>
            </div>
            <div class="card-body d-flex align-items-center justify-content-center">
                <h1 class="text-center">45</h1>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card d-flex flex-column h-100">
            <div class="card-header">
                <h4 class="card-title">Sales Overview</h4>
            </div>
            <div class="card-body d-flex align-items-center justify-content-center">
                <h1 class="text-center">45</h1>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <!-- Add any JavaScript scripts if needed -->
@endsection
