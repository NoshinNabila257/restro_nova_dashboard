@extends('layouts.owner')

@section('title', 'Dashboard')

@section('content')
    @php
        $restaurants = auth()->user()->restaurants;
    @endphp

    <div class="hero">
        <div>
            <h1>Welcome back, {{ auth()->user()->name }}! 👋</h1>
            <p>Manage your restaurants and grow your food business.</p>
            <p>Your restaurant journey starts here.</p>
        </div>
        <a class="btn" href="{{ route('restaurant.create') }}">+ Create Restaurant</a>
    </div>

    <div class="stats">
        <div class="stat">
            <div class="stat-icon">🏪</div>
            <div class="stat-number">{{ $restaurants->count() }}</div>
            <div class="muted">My Restaurants</div>
        </div>
        <div class="stat">
            <div class="stat-icon">🍽️</div>
            <div class="stat-number">{{ $menuItemsCount ?? 0 }}</div>
            <div class="muted">Menu Items</div>
        </div>
        <div class="stat">
            <div class="stat-icon">🪑</div>
            <div class="stat-number">—</div>
            <div class="muted">Restaurant Tables</div>
        </div>
        <div class="stat">
            <div class="stat-icon">🛍️</div>
            <div class="stat-number">—</div>
            <div class="muted">Orders</div>
        </div>
    </div>

    <div class="panel">
        <div class="section-head">
            <h2>Your Restaurants</h2>
            <a class="muted" href="{{ route('restaurants.index') }}">View all →</a>
        </div>

        @forelse($restaurants as $restaurant)
            <div class="restaurant-card">
                <div class="restaurant-photo">🍴</div>

                <div class="restaurant-info">
                    <h3>{{ $restaurant->name }} <span class="status">● Active</span></h3>
                    <p>📍 {{ $restaurant->address }}</p>
                    <p>☎ {{ $restaurant->phone }}</p>
                    @if($restaurant->email)
                        <p>✉ {{ $restaurant->email }}</p>
                    @endif
                    @if($restaurant->description)
                        <p>{{ $restaurant->description }}</p>
                    @endif
                </div>

                <div class="actions">
                    <a class="btn" href="{{ route('restaurants.index') }}">Manage</a>
                </div>
            </div>
        @empty
            <div class="empty">
                <div class="emoji">🍽️</div>
                <h3>Your restaurant journey starts here</h3>
                <p>Create your first restaurant profile to get started.</p>
                <a class="btn" href="{{ route('restaurant.create') }}">Create Restaurant</a>
            </div>
        @endforelse
    </div>

    <div class="hero" style="margin-top:24px;margin-bottom:0">
        <div>
            <h2 style="margin:0 0 8px">Ready to grow your business?</h2>
            <p>Next up: menu, tables, bookings and order management.</p>
        </div>
        <a class="btn" href="{{ route('restaurants.index') }}">Explore My Restaurants →</a>
    </div>
@endsection
