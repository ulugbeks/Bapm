@extends('admin.layouts.app')

@section('title', 'Create Blog Post')

@section('page_title', 'Create Blog Post')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Blog Posts</a></li>
<li class="breadcrumb-item active">Create</li>
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Create New Post</h3>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="title">Post Title</label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="excerpt">Excerpt</label>
                        <textarea name="excerpt" id="excerpt" class="form-control @error('excerpt') is-invalid @enderror" rows="3">{{ old('excerpt') }}</textarea>
                        @error('excerpt')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="text-muted">A short summary of the post (optional)</small>
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="content">Content</label>
                        <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="10">{{ old('content') }}</textarea>
                        @error('content')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="card mt-4">
                    <div class="card-header">
                        <h4>SEO Settings</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="seo_title">SEO Title</label>
                            <input type="text" name="seo_title" id="seo_title" class="form-control @error('seo_title') is-invalid @enderror" value="{{ old('seo_title') }}">
                            @error('seo_title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <small class="form-text text-muted">Title used in search engine results (recommended length: 50-60 characters). If left empty, the post title will be used.</small>
                            <div id="seo-title-char-count" class="text-muted mt-1">
                                Character count: <span>0</span>/60
                            </div>
                        </div>
                        
                        <div class="form-group mt-3">
                            <label for="seo_description">SEO Description</label>
                            <textarea name="seo_description" id="seo_description" class="form-control @error('seo_description') is-invalid @enderror" rows="3">{{ old('seo_description') }}</textarea>
                            @error('seo_description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <small class="form-text text-muted">Description used in search engine results (recommended length: 150-160 characters). If left empty, the post excerpt will be used.</small>
                            <div id="seo-description-char-count" class="text-muted mt-1">
                                Character count: <span>0</span>/160
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                
                <div class="col-md-4">
                    <div class="form-group" style="display: none;">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="author_name">Author Name</label>
                        <input type="text" name="author_name" id="author_name" 
                               class="form-control @error('author_name') is-invalid @enderror" 
                               value="{{ old('author_name', $post->author_name ?? '') }}" placeholder="Optional author name">
                        @error('author_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="text-muted">Leave empty for no author display</small>
                    </div>

                    <div class="form-group mt-3">
                        <label for="author_link">Author Link</label>
                        <input type="text" name="author_link" id="author_link" 
                               class="form-control @error('author_link') is-invalid @enderror" 
                               value="{{ old('author_link', $post->author_link ?? '') }}" placeholder="https://...">
                        @error('author_link')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="text-muted">Optional - add a link to the author's profile</small>
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="featured_image">Featured Image</label>
                        
                        <!-- Current image display (if any) -->
                        <div id="image-preview" class="mb-2">
                            @if(isset($post) && $post->featured_image)
                                <img src="{{ asset($post->featured_image) }}" alt="Current Image" style="max-height: 150px;">
                            @endif
                        </div>
                        
                        <!-- File upload control -->
                        <div class="input-group">
                            <input type="file" id="image" class="form-control" accept="image/*">
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                        
                        <!-- Hidden input to store the image path -->
                        <input type="hidden" name="featured_image" id="featured_image" 
                               class="form-control mt-2 @error('featured_image') is-invalid @enderror" 
                               value="{{ isset($post) ? old('featured_image', $post->featured_image) : old('featured_image') }}">
                        
                        @error('featured_image')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="form-text text-muted">Upload an image for your blog post</small>
                    </div>
                    
                    <div class="form-group mt-3">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="active" name="active" value="1" {{ old('active') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="active">Active</label>
                        </div>
                        <small class="text-muted">Enable to publish the post</small>
                    </div>
                    
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-save"></i> Save Post
                        </button>
                        <a href="{{ route('posts.index') }}" class="btn btn-secondary btn-block mt-2">
                            <i class="fas fa-arrow-left"></i> Cancel
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Summernote editor
        $('#content').summernote({
            height: 400,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ]
        });
        
        // Handle image upload
        $('#image').on('change', function() {
            var formData = new FormData();
            formData.append('image', this.files[0]);
            
            $.ajax({
                url: '{{ route("image.upload.direct") }}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        // Update the hidden input with the image URL
                        $('#featured_image').val(response.url);
                        
                        // Show image preview
                        $('#image-preview').html('<img src="' + response.url + '" alt="Uploaded Image" style="max-height: 150px;">');
                    }
                },
                error: function(error) {
                    console.error('Upload error:', error);
                    alert('Image upload failed. Please try again.');
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const seoTitle = document.getElementById('seo_title');
        const seoDescription = document.getElementById('seo_description');
        const titleCharCount = document.querySelector('#seo-title-char-count span');
        const descriptionCharCount = document.querySelector('#seo-description-char-count span');
        
        // Update character count for title
        if (seoTitle && titleCharCount) {
            seoTitle.addEventListener('input', function() {
                titleCharCount.textContent = this.value.length;
                if (this.value.length > 60) {
                    titleCharCount.classList.add('text-danger');
                } else {
                    titleCharCount.classList.remove('text-danger');
                }
            });
        }
        
        // Update character count for description
        if (seoDescription && descriptionCharCount) {
            seoDescription.addEventListener('input', function() {
                descriptionCharCount.textContent = this.value.length;
                if (this.value.length > 160) {
                    descriptionCharCount.classList.add('text-danger');
                } else {
                    descriptionCharCount.classList.remove('text-danger');
                }
            });
        }
    });
</script>
@endsection