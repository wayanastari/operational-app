@php
    $isEdit = isset($vehicle);
    $routeAction = $isEdit 
        ? route('vehicles.update', $vehicle->id) 
        : route('vehicles.store');
@endphp

<x-form-layout :action="$routeAction" :isEdit="$isEdit">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    {{-- Pilih Cabang --}}
    <div class="mb-3">
        <label for="branch_id" class="form-label">Cabang</label>
        <select class="form-select" id="branch_id" name="branch_id" required>
            <option value="" disabled {{ !$isEdit ? 'selected' : '' }}>Pilih Cabang</option>
            @foreach ($branches as $branch)
                <option value="{{ $branch->id }}"
                    {{ $isEdit && $vehicle->branch_id == $branch->id ? 'selected' : (old('branch_id') == $branch->id ? 'selected' : '') }}>
                    {{ $branch->branch_name }}
                </option>
            @endforeach
        </select>
        @error('branch_id')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    {{-- Pilih Variant --}}
    <div class="mb-3">
        <label for="variant_id" class="form-label">Variant Kendaraan</label>
        <select class="form-select" id="variant_id" name="variant_id" required>
            <option value="" disabled {{ !$isEdit ? 'selected' : '' }}>Pilih Variant</option>
            @foreach ($variants as $variant)
                <option value="{{ $variant->id }}"
                    {{ $isEdit && $vehicle->variant_id == $variant->id ? 'selected' : (old('variant_id') == $variant->id ? 'selected' : '') }}>
                    {{ $variant->vehicle_variant }}
                </option>
            @endforeach
        </select>
        @error('variant_id')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    {{-- Plat Nomor --}}
    <div class="mb-3">
        <label for="plat_number" class="form-label">Plat Nomor</label>
        <input type="text" 
               class="form-control" 
               id="plat_number" 
               name="plat_number" 
               value="{{ $isEdit ? old('plat_number', $vehicle->plat_number) : old('plat_number') }}"
               required>
        @error('plat_number')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    {{-- Nama Pemilik --}}
    <div class="mb-3">
        <label for="owner_name" class="form-label">Nama Pemilik</label>
        <input type="text" 
               class="form-control" 
               id="owner_name" 
               name="owner_name" 
               value="{{ $isEdit ? old('owner_name', $vehicle->owner_name) : old('owner_name') }}"
               required>
        @error('owner_name')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    {{-- Nomor Identifikasi Kendaraan (VIN) --}}
    <div class="mb-3">
        <label for="vehicle_identification_number" class="form-label">VIN</label>
        <input type="text" 
               class="form-control" 
               id="vehicle_identification_number" 
               name="vehicle_identification_number" 
               value="{{ $isEdit ? old('vehicle_identification_number', $vehicle->vehicle_identification_number) : old('vehicle_identification_number') }}"
               required>
        @error('vehicle_identification_number')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
</x-form-layout>
