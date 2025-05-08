@extends('admin.layouts.app')

@section('title', 'Create Timeline Item')

@section('page_title', 'Create Timeline Item')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('timeline.index') }}">Timeline</a></li>
<li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Create New Timeline Item</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('timeline.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="year">Year</label>
                <input type="text" name="year" id="year" class="form-control @error('year') is-invalid @enderror" value="{{ old('year') }}" required>
                @error('year')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                @error('title')
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
                <label for="icon">Icon Class</label>
                <input type="text" name="icon" id="icon" class="form-control @error('icon') is-invalid @enderror" value="{{ old('icon', 'flaticon flaticon-microscope') }}">
                @error('icon')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <small class="form-text text-muted">Example: flaticon flaticon-microscope</small>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Save Timeline Item</button>
                <a href="{{ route('timeline.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection