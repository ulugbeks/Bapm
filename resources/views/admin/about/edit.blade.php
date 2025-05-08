@extends('admin.layouts.app')

@section('title', 'Edit About Us')

@section('page_title', 'Edit About Us')

@section('breadcrumb')
<li class="breadcrumb-item active">About Us</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit About Us Information</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('about.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $about->title) }}" required>
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="form-text text-muted">You can use HTML for styling, e.g. &lt;span&gt;text&lt;/span&gt;</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="subtitle">Subtitle</label>
                        <input type="text" name="subtitle" id="subtitle" class="form-control @error('subtitle') is-invalid @enderror" value="{{ old('subtitle', $about->subtitle) }}">
                        @error('subtitle')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $about->description) }}</textarea>
                @error('description')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            
            
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="signature_image">Signature Image Path</label>
                        <input type="text" name="signature_image" id="signature_image" class="form-control @error('signature_image') is-invalid @enderror" value="{{ old('signature_image', $about->signature_image) }}">
                        @error('signature_image')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="form-text text-muted">Example: images/sign.png</small>
                        @if($about->signature_image)
                            <div class="mt-2">
                                <img src="{{ asset($about->signature_image) }}" alt="Signature" style="max-width: 100px;">
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="doctor_name">Doctor Name</label>
                        <input type="text" name="doctor_name" id="doctor_name" class="form-control @error('doctor_name') is-invalid @enderror" value="{{ old('doctor_name', $about->doctor_name) }}">
                        @error('doctor_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="doctor_title">Doctor Title</label>
                        <input type="text" name="doctor_title" id="doctor_title" class="form-control @error('doctor_title') is-invalid @enderror" value="{{ old('doctor_title', $about->doctor_title) }}">
                        @error('doctor_title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="doctor_image">Doctor Image Path</label>
                <input type="text" name="doctor_image" id="doctor_image" class="form-control @error('doctor_image') is-invalid @enderror" value="{{ old('doctor_image', $about->doctor_image) }}">
                @error('doctor_image')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <small class="form-text text-muted">Example: images/about-thumb.jpg</small>
                @if($about->doctor_image)
                    <div class="mt-2">
                        <img src="{{ asset($about->doctor_image) }}" alt="Doctor" style="max-width: 100px;">
                    </div>
                @endif
            </div>
            
            <div class="form-group">
                <label>Features List</label>
                @php
                    $features = [];
                    if(isset($about->features)) {
                        $features = is_string($about->features) ? json_decode($about->features) : $about->features;
                        if(!is_array($features)) $features = [];
                    }
                @endphp
                
                <div id="features-container">
                    @foreach($features as $index => $feature)
                    <div class="input-group mb-2">
                        <input type="text" name="features[]" class="form-control" value="{{ $feature }}">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-danger remove-feature">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    @endforeach
                    
                    @if(count($features) == 0)
                    <div class="input-group mb-2">
                        <input type="text" name="features[]" class="form-control" placeholder="Enter feature">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-danger remove-feature">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    @endif
                </div>
                
                <button type="button" class="btn btn-sm btn-info mt-2" id="add-feature">
                    <i class="fas fa-plus"></i> Add Feature
                </button>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">Second About Section</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="second_section_subtitle">Subtitle</label>
                                <input type="text" name="second_section_subtitle" id="second_section_subtitle" class="form-control @error('second_section_subtitle') is-invalid @enderror" value="{{ old('second_section_subtitle', $about->second_section_subtitle ?? 'Who We Are') }}">
                                @error('second_section_subtitle')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="second_section_title">Title</label>
                                <input type="text" name="second_section_title" id="second_section_title" class="form-control @error('second_section_title') is-invalid @enderror" value="{{ old('second_section_title', $about->second_section_title ?? 'Discover Our Commitment to <span>Research Center</span>') }}">
                                @error('second_section_title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">You can use HTML for styling, e.g. &lt;span&gt;text&lt;/span&gt;</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="second_section_description">Description</label>
                        <textarea name="second_section_description" id="second_section_description" class="form-control @error('second_section_description') is-invalid @enderror" rows="3">{{ old('second_section_description', $about->second_section_description ?? 'Delivering cutting-edge scientific services with precise testing, research support, and consultation, committed to excellence and advancement in every project.') }}</textarea>
                        @error('second_section_description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="second_section_years">Years of Experience</label>
                        <input type="number" name="second_section_years" id="second_section_years" class="form-control @error('second_section_years') is-invalid @enderror" value="{{ old('second_section_years', $about->second_section_years ?? 15) }}">
                        @error('second_section_years')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <h4 class="mt-4">First Feature</h4>
                    <div class="form-group">
                        <label for="second_section_feature1_title">Title</label>
                        <input type="text" name="second_section_feature1_title" id="second_section_feature1_title" class="form-control @error('second_section_feature1_title') is-invalid @enderror" value="{{ old('second_section_feature1_title', $about->second_section_feature1_title ?? 'Medical laboratory Technician') }}">
                        @error('second_section_feature1_title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <label for="second_section_feature1_description">Description</label>
                        <textarea name="second_section_feature1_description" id="second_section_feature1_description" class="form-control @error('second_section_feature1_description') is-invalid @enderror" rows="2">{{ old('second_section_feature1_description', $about->second_section_feature1_description ?? 'New evidence has been published on the protein dosing patients.') }}</textarea>
                        @error('second_section_feature1_description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <h4 class="mt-4">Second Feature</h4>
                    <div class="form-group">
                        <label for="second_section_feature2_title">Title</label>
                        <input type="text" name="second_section_feature2_title" id="second_section_feature2_title" class="form-control @error('second_section_feature2_title') is-invalid @enderror" value="{{ old('second_section_feature2_title', $about->second_section_feature2_title ?? '10+ Quality Research Center') }}">
                        @error('second_section_feature2_title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <label for="second_section_feature2_description">Description</label>
                        <textarea name="second_section_feature2_description" id="second_section_feature2_description" class="form-control @error('second_section_feature2_description') is-invalid @enderror" rows="2">{{ old('second_section_feature2_description', $about->second_section_feature2_description ?? 'We believe in fostering collaboration, innovation, and a knowledge.') }}</textarea>
                        @error('second_section_feature2_description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update About Information</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add feature
        document.getElementById('add-feature').addEventListener('click', function() {
            const container = document.getElementById('features-container');
            const newFeatureDiv = document.createElement('div');
            newFeatureDiv.className = 'input-group mb-2';
            newFeatureDiv.innerHTML = `
                <input type="text" name="features[]" class="form-control" placeholder="Enter feature">
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger remove-feature">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            container.appendChild(newFeatureDiv);
            
            // Add event listener to the new remove button
            newFeatureDiv.querySelector('.remove-feature').addEventListener('click', function() {
                container.removeChild(newFeatureDiv);
            });
        });
        
        // Remove feature (for existing buttons)
        document.querySelectorAll('.remove-feature').forEach(button => {
            button.addEventListener('click', function() {
                const inputGroup = this.closest('.input-group');
                if (inputGroup) {
                    inputGroup.remove();
                }
            });
        });
    });
</script>
@endsection