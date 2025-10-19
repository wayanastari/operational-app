@php
    $isEdit = isset($vehicle_variants);
    $routeAction = $isEdit 
        ? route('vehicle_variants.update', $vehicle_variants->id) 
        : route('vehicle_variants.store');
@endphp

<x-form-layout :action="$routeAction" :isEdit="$isEdit" enctype="multipart/form-data">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    {{-- Pilih Tipe Kendaraan --}}
    <div class="mb-3">
        <label for="id_vehicle_type" class="form-label">Tipe Kendaraan</label>
        <select class="form-select" id="id_vehicle_type" name="id_vehicle_type" required>
            <option value="" disabled {{ !$isEdit ? 'selected' : '' }}>Pilih Tipe Kendaraan</option>
            @foreach ($vehicle_types as $type)
                <option value="{{ $type->id }}"
                    {{ $isEdit && $vehicle_variants->id_vehicle_type == $type->id ? 'selected' : (old('id_vehicle_type') == $type->id ? 'selected' : '') }}>
                    {{ $type->vehicle_type }}
                </option>
            @endforeach
        </select>
        @error('id_vehicle_type')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    {{-- Nama Variant --}}
    <div class="mb-3">
        <label for="vehicle_variant" class="form-label">Nama Variant</label>
        <input type="text"
               class="form-control"
               id="vehicle_variant"
               name="vehicle_variant"
               value="{{ old('vehicle_variant', $isEdit ? $vehicle_variants->vehicle_variant : '') }}"
               required>
        @error('vehicle_variant')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    {{-- Foto Kendaraan --}}
    <div class="mb-3">
        <label for="vehicle_image" class="form-label">Foto Kendaraan</label>
        <input type="file"
               class="form-control"
               id="vehicle_image"
               name="vehicle_image"
               {{ !$isEdit ? 'required' : '' }}>
        @error('vehicle_image')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror

        @if($isEdit && $vehicle_variants->vehicle_image)
            <p class="mt-2">Gambar saat ini:</p>
            <img src="{{ asset('storage/' . $vehicle_variants->vehicle_image) }}" alt="Foto Kendaraan" width="120">
        @endif
    </div>

</x-form-layout>
