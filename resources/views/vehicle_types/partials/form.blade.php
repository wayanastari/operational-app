@php
    $isEdit = isset($vehicle_types);
    $routeAction = $isEdit ? route('vehicle_types.update', $vehicle_types->id) : route('vehicle_types.store');
@endphp

<x-form-layout :action="$routeAction" :isEdit="$isEdit">
    <div class="mb-3">
        <label for="vehicle_type" class="form-label">Nama Tipe</label>
        <input type="text" 
               class="form-control" 
               id="vehicle_type" 
               name="vehicle_type" 
               value="{{ $isEdit ? old('vehicle_type', $vehicle_types->vehicle_type) : old('vehicle_type') }}"
               required>
        @error('vehicle_type')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>  
</x-form-layout>