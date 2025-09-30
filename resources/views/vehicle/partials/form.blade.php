@php
    // cek mode edit
    $isEdit = isset($vehicle);
    // route untuk create atau update
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
                    {{ old('branch_id', $isEdit ? $vehicle->branch_id : '') == $branch->id ? 'selected' : '' }}>
                    {{ $branch->branch_name }}
                </option>
            @endforeach
        </select>
        @error('branch_id')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    {{-- Pilih Varian --}}
    <div class="mb-3">
        <label for="variant_id" class="form-label">Varian Kendaraan</label>
        <select class="form-select" id="variant_id" name="variant_id" required>
            <option value="" disabled {{ !$isEdit ? 'selected' : '' }}>Pilih Varian</option>
            @foreach ($variants as $variant)
                <option value="{{ $variant->id }}"
                    {{ old('variant_id', $isEdit ? $vehicle->variant_id : '') == $variant->id ? 'selected' : '' }}>
                    {{ $variant->vehicle_variant }}
                    {{-- Jika ingin tampilkan juga tipe kendaraan --}}
                    {{-- ({{ $variant->vehicle_type->vehicle_type ?? '' }}) --}}
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
               value="{{ old('plat_number', $isEdit ? $vehicle->plat_number : '') }}"
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
               value="{{ old('owner_name', $isEdit ? $vehicle->owner_name : '') }}"
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
               value="{{ old('vehicle_identification_number', $isEdit ? $vehicle->vehicle_identification_number : '') }}">
        @error('vehicle_identification_number')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
</x-form-layout>
