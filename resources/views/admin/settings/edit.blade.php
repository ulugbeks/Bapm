@extends('admin.layouts.app')

@section('title', 'Site Settings')

@section('page_title', 'Site Settings')

@section('breadcrumb')
<li class="breadcrumb-item active">Settings</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Site Settings</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('settings.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">SEO Settings</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="site_name">Site Name</label>
                                <input type="text" name="site_name" id="site_name" class="form-control @error('site_name') is-invalid @enderror" value="{{ old('site_name', $settings->site_name) }}" required>
                                @error('site_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="meta_title">SEO Title</label>
                                <input type="text" name="meta_title" id="meta_title" class="form-control @error('meta_title') is-invalid @enderror" value="{{ old('meta_title', $settings->meta_title) }}">
                                @error('meta_title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">Title used in search engine results (recommended length: 50-60 characters)</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="meta_description">SEO Description</label>
                                <textarea name="meta_description" id="meta_description" class="form-control @error('meta_description') is-invalid @enderror" rows="3">{{ old('meta_description', $settings->meta_description) }}</textarea>
                                @error('meta_description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">Description used in search engine results (recommended length: 150-160 characters)</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- <h5 class="mb-3">General Settings</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="site_name">Site Name</label>
                        <input type="text" name="site_name" id="site_name" class="form-control @error('site_name') is-invalid @enderror" value="{{ old('site_name', $settings->site_name) }}" required>
                        @error('site_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="site_title">Site Title</label>
                        <input type="text" name="site_title" id="site_title" class="form-control @error('site_title') is-invalid @enderror" value="{{ old('site_title', $settings->site_title) }}">
                        @error('site_title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="site_description">Site Description</label>
                <textarea name="site_description" id="site_description" class="form-control @error('site_description') is-invalid @enderror" rows="3">{{ old('site_description', $settings->site_description) }}</textarea>
                @error('site_description')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <hr class="mt-4 mb-4"> -->
            
            <!-- Rest of the form remains unchanged -->
            
            <h5 class="mb-3">Contact Information</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $settings->email) }}">
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $settings->phone) }}">
                        @error('phone')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $settings->address) }}">
                        @error('address')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="working_hours">Working Hours</label>
                        <input type="text" name="working_hours" id="working_hours" class="form-control @error('working_hours') is-invalid @enderror" value="{{ old('working_hours', $settings->working_hours) }}">
                        @error('working_hours')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <hr class="mt-4 mb-4">
            
            <h5 class="mb-3">Social Media</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="facebook">Facebook URL</label>
                        <input type="text" name="facebook" id="facebook" class="form-control @error('facebook') is-invalid @enderror" value="{{ old('facebook', $settings->facebook) }}">
                        @error('facebook')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                   </div>
               </div>
               <div class="col-md-6">
                   <div class="form-group">
                       <label for="twitter">Twitter URL</label>
                       <input type="text" name="twitter" id="twitter" class="form-control @error('twitter') is-invalid @enderror" value="{{ old('twitter', $settings->twitter) }}">
                       @error('twitter')
                           <span class="invalid-feedback">{{ $message }}</span>
                       @enderror
                   </div>
               </div>
           </div>
           
           <div class="row">
               <div class="col-md-6">
                   <div class="form-group">
                       <label for="linkedin">LinkedIn URL</label>
                       <input type="text" name="linkedin" id="linkedin" class="form-control @error('linkedin') is-invalid @enderror" value="{{ old('linkedin', $settings->linkedin) }}">
                       @error('linkedin')
                           <span class="invalid-feedback">{{ $message }}</span>
                       @enderror
                   </div>
               </div>
               <div class="col-md-6">
                   <div class="form-group">
                       <label for="whatsapp">WhatsApp</label>
                       <input type="text" name="whatsapp" id="whatsapp" class="form-control @error('whatsapp') is-invalid @enderror" value="{{ old('whatsapp', $settings->whatsapp) }}">
                       @error('whatsapp')
                           <span class="invalid-feedback">{{ $message }}</span>
                       @enderror
                   </div>
               </div>
           </div>
           
           <hr class="mt-4 mb-4">
           
           <h5 class="mb-3">Map & Footer</h5>
           <div class="form-group">
               <label for="map_url">Google Map Embed URL</label>
               <input type="text" name="map_url" id="map_url" class="form-control @error('map_url') is-invalid @enderror" value="{{ old('map_url', $settings->map_url) }}">
               @error('map_url')
                   <span class="invalid-feedback">{{ $message }}</span>
               @enderror
               <small class="form-text text-muted">Example: https://www.google.com/maps/embed?pb=!1m18!1m12!...</small>
           </div>
           
           <div class="form-group">
               <label for="footer_cta_title">Footer Call-to-Action Title</label>
               <input type="text" name="footer_cta_title" id="footer_cta_title" class="form-control @error('footer_cta_title') is-invalid @enderror" value="{{ old('footer_cta_title', $settings->footer_cta_title) }}">
               @error('footer_cta_title')
                   <span class="invalid-feedback">{{ $message }}</span>
               @enderror
           </div>
           
           <div class="form-group">
               <label for="newsletter_text">Newsletter Text</label>
               <textarea name="newsletter_text" id="newsletter_text" class="form-control @error('newsletter_text') is-invalid @enderror" rows="3">{{ old('newsletter_text', $settings->newsletter_text) }}</textarea>
               @error('newsletter_text')
                   <span class="invalid-feedback">{{ $message }}</span>
               @enderror
           </div>
           
           <div class="mt-4">
               <button type="submit" class="btn btn-primary">Save Settings</button>
           </div>
       </form>
   </div>
</div>
@endsection