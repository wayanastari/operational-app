@php
    $isEdit = isset($branch);
    $routeAction = $isEdit ? route('branch.update', $branch->id) : route('branch.store');
@endphp

<x-form-layout :action="$routeAction" :isEdit="$isEdit">
    <div class="mb-3">
        <label for="branch_name" class="form-label">Nama Cabang</label>
        <input type="text" 
               class="form-control" 
               id="branch_name" 
               name="branch_name" 
               value="{{ $isEdit ? old('branch_name', $branch->branch_name) : old('branch_name') }}"
               required>
        @error('branch_name')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="branch_address" class="form-label">Alamat Cabang</label>
        <textarea class="form-control" 
                  id="branch_address" 
                  name="branch_address" 
                  rows="3" 
                  required>{{ $isEdit ? old('branch_address', $branch->branch_address) : old('branch_address') }}</textarea>
        @error('branch_address')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>    
</x-form-layout>