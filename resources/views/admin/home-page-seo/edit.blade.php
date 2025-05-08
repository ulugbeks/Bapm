@extends('admin.layouts.app')

@section('title', 'Home Page SEO')

@section('page_title', 'Home Page SEO')

@section('breadcrumb')
<li class="breadcrumb-item active">Home Page SEO</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Home Page SEO Settings</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('home-page-seo.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="seo_title">SEO Title</label>
                <input type="text" name="seo_title" id="seo_title" class="form-control @error('seo_title') is-invalid @enderror" value="{{ old('seo_title', $seo->seo_title) }}">
                @error('seo_title')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <small class="form-text text-muted">Title used in search engine results (recommended length: 50-60 characters)</small>
            </div>
            
            <div class="form-group mt-3">
                <label for="seo_description">SEO Description</label>
                <textarea name="seo_description" id="seo_description" class="form-control @error('seo_description') is-invalid @enderror" rows="3">{{ old('seo_description', $seo->seo_description) }}</textarea>
                @error('seo_description')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <small class="form-text text-muted">Description used in search engine results (recommended length: 150-160 characters)</small>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Save SEO Settings</button>
            </div>
        </form>
    </div>
</div>
@endsection