@extends('dashboard.layout')

@section('title', 'Dashboard - Soccer Store')

@section('content')
<div class="space-y-6">
    <!-- Stats Cards -->
    @include('dashboard.components.stats-cards')

    <!-- Charts and Tables -->
    <div class="grid gap-6 lg:grid-cols-2">
        <!-- Recent Sales -->
        @include('dashboard.components.recent-sales')

        <!-- Recent Orders -->
        @include('dashboard.components.recent-orders')
    </div>
</div>
@endsection
