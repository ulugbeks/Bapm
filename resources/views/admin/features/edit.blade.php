@extends('admin.layouts.app')

@section('title', 'Edit Feature')

@section('page_title', 'Edit Feature')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('features.index') }}">Features</a></li>
<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Feature</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('features.update', $feature->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $feature->title) }}" required>
                @error('title')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $feature->description) }}</textarea>
                @error('description')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="icon">Icon Class</label>
                <input type="text" name="icon" id="icon" class="form-control @error('icon') is-invalid @enderror" value="{{ old('icon', $feature->icon) }}" placeholder="flaticon flaticon-chemistry-2">
                @error('icon')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <small class="form-text text-muted">Example: flaticon flaticon-chemistry-2</small>
                @if($feature->icon)
                <div class="mt-2">
                    <i class="{{ $feature->icon }}" style="font-size: 2em;"></i>
                </div>
                @endif
            </div>
            
            <div class="form-group">
                <label for="link_url">Link URL</label>
                <input type="text" name="link_url" id="link_url" class="form-control @error('link_url') is-invalid @enderror" value="{{ old('link_url', $feature->link_url) }}">
                @error('link_url')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="order">Order</label>
                        <input type="number" name="order" id="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', $feature->order) }}">
                        @error('order')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="active">Status</label>
                        <select name="active" id="active" class="form-control @error('active') is-invalid @enderror">
                            <option value="1" {{ old('active', $feature->active) == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('active', $feature->active) == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('active')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update Feature</button>
                <a href="{{ route('features.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection