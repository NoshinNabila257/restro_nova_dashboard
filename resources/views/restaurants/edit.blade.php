
@extends('layouts.owner')

@section('title', 'Edit Restaurant')

@section('content')
    <div style="margin-bottom:22px">
        <a class="muted" href="{{ route('restaurants.index') }}">← Back to My Restaurants</a>
        <h1 style="margin:14px 0 8px">Edit Restaurant</h1>
        <p class="muted">Update your restaurant details.</p>
    </div>

    <div class="panel" style="max-width:850px">
        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('restaurant.update', $restaurant->id) }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="field">
                    <label>Restaurant Name *</label>
                    <input type="text" name="name"
                           value="{{ old('name', $restaurant->name) }}" required>
                </div>

                <div class="field">
                    <label>Phone Number *</label>
                    <input type="text" name="phone"
                           value="{{ old('phone', $restaurant->phone) }}" required>
                </div>

                <div class="field">
                    <label>Restaurant Email</label>
                    <input type="email" name="email"
                           value="{{ old('email', $restaurant->email) }}">
                </div>

                <div class="field">
                    <label>Address *</label>
                    <input type="text" name="address"
                           value="{{ old('address', $restaurant->address) }}" required>
                </div>
            </div>

            <div class="field">
                <label>Description</label>
                <textarea name="description">{{ old('description', $restaurant->description) }}</textarea>
            </div>

            <div class="field">
                <label>Current Restaurant Photo</label>

                @if($restaurant->image)
                    <img src="{{ asset('storage/' . $restaurant->image) }}"
                         alt="Restaurant Photo"
                         style="width:150px;height:110px;object-fit:cover;border-radius:10px;margin-bottom:10px;">
                @else
                    <p class="muted">No photo uploaded yet.</p>
                @endif

                <label>Upload New Photo (Optional)</label>
                <input type="file" name="image" accept="image/*">
                <small class="muted">JPG, PNG or WEBP (Max 2MB).</small>
            </div>

            <button type="submit" class="btn">✏️ Update Restaurant</button>
            <a href="{{ route('restaurants.index') }}"
               class="btn btn-light" style="margin-left:8px">Cancel</a>
        </form>
    </div>
@endsection
