@extends('layouts.owner')

@section('title', 'My Restaurants')

@section('content')
    <div class="section-head">
        <div>
            <h1 style="margin:0 0 8px">My Restaurants</h1>
            <p class="muted">Manage your restaurant profiles from one place.</p>
        </div>
        <a class="btn" href="{{ route('restaurant.create') }}">+ Create Restaurant</a>
    </div>

    @forelse($restaurants as $restaurant)
        <div class="panel restaurant-card">
            <div class="restaurant-photo">
    @if($restaurant->image)
        <img src="{{ asset('storage/' . $restaurant->image) }}"
             alt="{{ $restaurant->name }}"
             style="width:100%; height:100%; object-fit:cover; border-radius:inherit;">
    @else
        🍴
    @endif
    </div>

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
                <p class="muted">Restaurant ID: {{ $restaurant->id }}</p>
            </div>

            <div class="actions">
                <a class="btn" href="{{ route('restaurant.edit', $restaurant->id) }}">
                   ✏️ Edit Restaurant
                </a>
            </div>

        </div>
    @empty
        <div class="panel empty">
            <div class="emoji">🏪</div>
            <h3>No restaurants yet</h3>
            <p>Create your first restaurant profile to get started.</p>
            <a class="btn" href="{{ route('restaurant.create') }}">Create Restaurant</a>
        </div>
    @endforelse
@endsection
