@extends('admin.layouts.app')

@section('title', 'Create Slider')

@section('page_title', 'Create Slider')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('sliders.index') }}">Sliders</a></li>
<li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Create New Slider</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('sliders.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                @error('title')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <small class="form-text text-muted">You can use HTML for styling, e.g. &lt;span&gt;text&lt;/span&gt;</small>
            </div>
            
            <div class="form-group">
                <label for="subtitle">Subtitle</label>
                <input type="text" name="subtitle" id="subtitle" class="form-control @error('subtitle') is-invalid @enderror" value="{{ old('subtitle') }}">
                @error('subtitle')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description') }}</textarea>
                @error('description')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="image_path">Image Path</label>
                <input type="text" name="image_path" id="image_path" class="form-control @error('image_path') is-invalid @enderror" value="{{ old('image_path') }}" required>
                @error('image_path')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <small class="form-text text-muted">Example: images/banner/01.jpg</small>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="primary_button_text">Primary Button Text</label>
                        <input type="text" name="primary_button_text" id="primary_button_text" class="form-control @error('primary_button_text') is-invalid @enderror" value="{{ old('primary_button_text') }}">
                        @error('primary_button_text')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="primary_button_url">Primary Button URL</label>
                        <input type="text" name="primary_button_url" id="primary_button_url" class="form-control @error('primary_button_url') is-invalid @enderror" value="{{ old('primary_button_url') }}">
                        @error('primary_button_url')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="secondary_button_text">Secondary Button Text</label>
                        <input type="text" name="secondary_button_text" id="secondary_button_text" class="form-control @error('secondary_button_text') is-invalid @enderror" value="{{ old('secondary_button_text') }}">
                        @error('secondary_button_text')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="secondary_button_url">Secondary Button URL</label>
                        <input type="text" name="secondary_button_url" id="secondary_button_url" class="form-control @error('secondary_button_url') is-invalid @enderror" value="{{ old('secondary_button_url') }}">
                        @error('secondary_button_url')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="order">Order</label>
                        <input type="number" name="order" id="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', 0) }}">
                        @error('order')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="active">Status</label>
                        <select name="active" id="active" class="form-control @error('active') is-invalid @enderror">
                            <option value="1" {{ old('active') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('active') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('active')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Save Slider</button>
                <a href="{{ route('sliders.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection