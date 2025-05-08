@extends('admin.layouts.app')

@section('title', 'Edit Section Headings')

@section('page_title', 'Edit Section Headings')

@section('breadcrumb')
<li class="breadcrumb-item active">Section Headings</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Home Page Section Headings</h3>
    </div>
    <div class="card-body">
        <!--@if(session('success'))-->
        <!--    <div class="alert alert-success">-->
        <!--        {{ session('success') }}-->
        <!--    </div>-->
        <!--@endif-->
        
        <form action="{{ route('section-headings.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title mb-0">Portfolio Section</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="portfolio_subtitle">Subtitle</label>
                        <input type="text" name="portfolio_subtitle" id="portfolio_subtitle" class="form-control @error('portfolio_subtitle') is-invalid @enderror" value="{{ old('portfolio_subtitle', $portfolio->subtitle) }}" placeholder="e.g. Latest Portfolio">
                        @error('portfolio_subtitle')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="portfolio_title">Title</label>
                        <input type="text" name="portfolio_title" id="portfolio_title" class="form-control @error('portfolio_title') is-invalid @enderror" value="{{ old('portfolio_title', $portfolio->title) }}" placeholder="e.g. We've Done A Lot's, Check">
                        @error('portfolio_title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="portfolio_title_span">Title Span (highlighted part)</label>
                        <input type="text" name="portfolio_title_span" id="portfolio_title_span" class="form-control @error('portfolio_title_span') is-invalid @enderror" value="{{ old('portfolio_title_span', $portfolio->title_span) }}" placeholder="e.g. Our Latest Research">
                        @error('portfolio_title_span')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="form-text text-muted">This part will be highlighted with &lt;span&gt; tags</small>
                    </div>
                    
                    <div class="mt-3">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="text-muted">Preview:</h6>
                                <h6>{{ $portfolio->subtitle }}</h6>
                                <h2>{{ $portfolio->title }} <span class="text-primary">{{ $portfolio->title_span }}</span></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h4 class="card-title mb-0">Blog Section</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="blog_subtitle">Subtitle</label>
                        <input type="text" name="blog_subtitle" id="blog_subtitle" class="form-control @error('blog_subtitle') is-invalid @enderror" value="{{ old('blog_subtitle', $blog->subtitle) }}" placeholder="e.g. Recent Articles">
                        @error('blog_subtitle')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="blog_title">Title</label>
                        <input type="text" name="blog_title" id="blog_title" class="form-control @error('blog_title') is-invalid @enderror" value="{{ old('blog_title', $blog->title) }}" placeholder="e.g. Innovation in Focus Stories">
                        @error('blog_title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="blog_title_span">Title Span (highlighted part)</label>
                        <input type="text" name="blog_title_span" id="blog_title_span" class="form-control @error('blog_title_span') is-invalid @enderror" value="{{ old('blog_title_span', $blog->title_span) }}" placeholder="e.g. Updated From Lab">
                        @error('blog_title_span')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="form-text text-muted">This part will be highlighted with &lt;span&gt; tags</small>
                    </div>
                    
                    <div class="mt-3">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="text-muted">Preview:</h6>
                                <h6>{{ $blog->subtitle }}</h6>
                                <h2>{{ $blog->title }} <span class="text-primary">{{ $blog->title_span }}</span></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Changes
                </button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Dashboard
                </a>
            </div>
        </form>
    </div>
</div>
@endsection