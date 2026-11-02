@extends('layouts.owner')

@section('title', 'Create Restaurant')

@section('content')
    <div style="margin-bottom:22px">
        <a class="muted" href="{{ route('dashboard') }}">← Back to Dashboard</a>
        <h1 style="margin:14px 0 8px">Create Your Restaurant</h1>
        <p class="muted">Add your restaurant details to get started with Restro Nova.</p>
    </div>

    <div class="panel" style="max-width:850px">
        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('restaurant.store') }}" method="POST"enctype="multipart/form-data">
            @csrf

            <div class="form-grid">
                <div class="field">
                    <label>Restaurant Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Bitebox" required>
                </div>

                <div class="field">
                    <label>Phone Number *</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Your restaurant phone" required>
                </div>

                <div class="field">
                    <label>Restaurant Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="info@example.com">
                </div>

                <div class="field">
                    <label>Address *</label>
                    <input type="text" name="address" value="{{ old('address') }}" placeholder="Restaurant address" required>
                </div>
            </div>

            <div class="field">
                <label>Description</label>
                <textarea name="description" placeholder="Tell customers about your restaurant...">{{ old('description') }}</textarea>
            </div>
            <div class="field">
                 <label>Restaurant Photo</label>
                 <input type="file" name="image" accept="image/*">
                 <small class="muted">Upload JPG, PNG or WEBP image (Max 2MB).</small>
            </div>

            <p class="muted">* Required fields</p>
            <button type="submit" class="btn">Create Restaurant Profile →</button>
            <a href="{{ route('dashboard') }}" class="btn btn-light" style="margin-left:8px">Cancel</a>
        </form>
    </div>
@endsection
