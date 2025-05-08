@extends('admin.layouts.app')

@section('title', 'Edit About Us Page')

@section('page_title', 'Edit About Us Page')

@section('breadcrumb')
<li class="breadcrumb-item active">About Us Page</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit About Us Content</h3>
    </div>
    <div class="card-body">
        <!-- @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
 -->

         
        <form action="{{ route('aboutus.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h4 class="card-title mb-0">SEO Settings</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="seo_title">SEO Title</label>
                        <input type="text" name="seo_title" id="seo_title" class="form-control @error('seo_title') is-invalid @enderror" value="{{ old('seo_title', $about->seo_title) }}" placeholder="SEO Title for About Us page">
                        @error('seo_title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="form-text text-muted">Title used in search engine results (recommended length: 50-60 characters)</small>
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="seo_description">SEO Description</label>
                        <textarea name="seo_description" id="seo_description" class="form-control @error('seo_description') is-invalid @enderror" rows="3" placeholder="SEO Description for About Us page">{{ old('seo_description', $about->seo_description) }}</textarea>
                        @error('seo_description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="form-text text-muted">Description used in search engine results (recommended length: 150-160 characters)</small>
                    </div>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title mb-0">Main Section</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="subtitle">Section Subtitle</label>
                        <input type="text" name="subtitle" id="subtitle" class="form-control @error('subtitle') is-invalid @enderror" value="{{ old('subtitle', $about->subtitle) }}" placeholder="e.g. What We Do">
                        @error('subtitle')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="form-text text-muted">This is the smaller text that appears above the main title</small>
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="title">Main Title</label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $about->title) }}" placeholder="e.g. Strong Values That Bring Great People Together">
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="form-text text-muted">You can use HTML for styling, e.g. "Strong Values That Bring &lt;span&gt;Great People Together.&lt;/span&gt;"</small>
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="description">Main Description</label>
                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="6" placeholder="Enter the main section description">{{ old('description', $about->description) }}</textarea>
                        @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h4 class="card-title mb-0">Additional Section</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="additional_title">Section Title</label>
                        <input type="text" name="additional_title" id="additional_title" class="form-control @error('additional_title') is-invalid @enderror" value="{{ old('additional_title', $about->additional_title) }}" placeholder="e.g. Our Mission">
                        @error('additional_title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="additional_description">Section Description</label>
                        <textarea name="additional_description" id="additional_description" class="form-control @error('additional_description') is-invalid @enderror" rows="6" placeholder="Enter the additional section description">{{ old('additional_description', $about->additional_description) }}</textarea>
                        @error('additional_description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    <h4 class="card-title mb-0">Timeline Section</h4>
                </div>
                <div class="card-body">
                    <p>Timeline items are managed separately. You can add, edit, or remove timeline items from the Timeline Management page.</p>
                    
                    <a href="{{ route('timeline.index') }}" class="btn btn-primary">
                        <i class="fas fa-history"></i> Manage Timeline Items
                    </a>
                    
                    @if(!empty($timelines) && count($timelines) > 0)
                    <div class="mt-4">
                        <h5>Current Timeline Items</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Year</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($timelines as $timeline)
                                    <tr>
                                        <td>{{ $timeline->year }}</td>
                                        <td>{{ $timeline->title }}</td>
                                        <td>{{ Str::limit($timeline->description, 100) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @else
                    <div class="alert alert-info mt-3">
                        No timeline items found. Add some from the Timeline Management page.
                    </div>
                    @endif
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

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // If you want to add a rich text editor for the description fields
        // You could add code here to initialize a WYSIWYG editor
    });
</script>
@endsection