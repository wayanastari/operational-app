@php
    $isEdit = isset($garage);
    $routeAction = $isEdit ? route('garage.update', $garage->id) : route('garage.store');
@endphp

<x-form-layout :action="$routeAction" :isEdit="$isEdit">
    <div class="mb-3">
        <label for="garage_name" class="form-label">Nama Bengkel</label>
        <input type="text" 
               class="form-control" 
               id="garage_name" 
               name="garage_name" 
               value="{{ $isEdit ? old('garage_name', $garage->garage_name) : old('garage_name') }}"
               required>
        @error('garage_name')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="garage_address" class="form-label">Alamat Bengkel</label>
        <textarea class="form-control" 
                  id="garage_address" 
                  name="garage_address" 
                  rows="3" 
                  required>{{ $isEdit ? old('garage_address', $garage->garage_address) : old('garage_address') }}</textarea>
        @error('garage_address')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>    
</x-form-layout>