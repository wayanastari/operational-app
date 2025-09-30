@php
    $isEdit = isset($vehicle_variants);
    $routeAction = $isEdit ? route('vehicle_variants.update', $vehicle_types->id) : route('vehicle_variants.store');
@endphp

<x-form-layout :action="$routeAction" :isEdit="$isEdit">
        <label for="vehicle_type_id" class="form-label">Tipe Kendaraan</label>
        <select class="form-select" id="vehicle_type_id" name="vehicle_type_id" required>
            <option value="" disabled {{ !$isEdit ? 'selected' : '' }}>Pilih Tipe Kendaraan</option>
            @foreach ($vehicle_types as $type)
                <option value="{{ $type->id }}" 
                    {{ $isEdit && $vehicle_variants->vehicle_type_id == $type->id ? 'selected' : (old('vehicle_type_id') == $type->id ? 'selected' : '') }}>
                    {{ $type->vehicle_type }}
                </option>
            @endforeach
        </select>
        @error('vehicle_type_id')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    <div class="mb-3">
        <label for="vehicle_variant" class="form-label">Nama Variant</label>
        <input type="text" 
               class="form-control" 
               id="vehicle_variant" 
               name="vehicle_variant" 
               value="{{ $isEdit ? old('vehicle_variant', $vehicle_variants->vehicle_variant) : old('vehicle_variant') }}"
               required>
        @error('vehicle_variant')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div> 
     
</x-form-layout>