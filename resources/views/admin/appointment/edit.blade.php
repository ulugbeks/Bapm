@extends('admin.layouts.app')

@section('title', 'Appointment Form Settings')

@section('page_title', 'Appointment Form Settings')

@section('breadcrumb')
<li class="breadcrumb-item active">Appointment Form Settings</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Appointment Form Settings</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('appointment.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $settings->title) }}">
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="subtitle">Subtitle</label>
                        <input type="text" name="subtitle" id="subtitle" class="form-control @error('subtitle') is-invalid @enderror" value="{{ old('subtitle', $settings->subtitle) }}">
                        @error('subtitle')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $settings->description) }}</textarea>
                @error('description')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="button_text">Button Text</label>
                <input type="text" name="button_text" id="button_text" class="form-control @error('button_text') is-invalid @enderror" value="{{ old('button_text', $settings->button_text) }}">
                @error('button_text')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <h4 class="mt-4 mb-3">Working Hours</h4>
            
            <div id="working-hours-container">
                @php
                    $working_hours = $settings->working_hours ?? [
                        'Mon - Tues' => '09:00AM - 6:00PM',
                        'Wed - Thu' => '09:00AM - 6:00PM',
                        'Fri - Sat' => '09:00AM - 6:00PM',
                        'Emergency' => '24/7 Hours 7 Days'
                    ];
                @endphp
                
                @foreach($working_hours as $day => $hours)
                <div class="row mb-2 working-hour-item">
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="text" name="working_hours[days][]" class="form-control" value="{{ $day }}" placeholder="Day(s)">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="text" name="working_hours[hours][]" class="form-control" value="{{ $hours }}" placeholder="Hours">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger remove-hours"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                @endforeach
            </div>
            
            <button type="button" class="btn btn-info mb-4" id="add-working-hours">
                <i class="fas fa-plus"></i> Add Working Hours
            </button>
            
            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="active" name="active" value="1" {{ $settings->active ? 'checked' : '' }}>
                    <label class="custom-control-label" for="active">Active</label>
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Save Settings</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add working hours
        document.getElementById('add-working-hours').addEventListener('click', function() {
            const container = document.getElementById('working-hours-container');
            const newHoursRow = document.createElement('div');
            newHoursRow.className = 'row mb-2 working-hour-item';
            newHoursRow.innerHTML = `
                <div class="col-md-5">
                    <div class="form-group">
                        <input type="text" name="working_hours[days][]" class="form-control" placeholder="Day(s)">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <input type="text" name="working_hours[hours][]" class="form-control" placeholder="Hours">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger remove-hours"><i class="fas fa-times"></i></button>
                </div>
            `;
            container.appendChild(newHoursRow);
            
            // Add event listener to new remove button
            newHoursRow.querySelector('.remove-hours').addEventListener('click', function() {
                container.removeChild(newHoursRow);
            });
        });
        
        // Remove working hours (for existing buttons)
        document.querySelectorAll('.remove-hours').forEach(button => {
            button.addEventListener('click', function() {
                const hourItem = this.closest('.working-hour-item');
                if (hourItem) {
                    hourItem.remove();
                }
            });
        });
    });
</script>
@endsection