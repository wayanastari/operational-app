@extends('layouts.app')
@section('title', 'Data Kendaraan')
@section('page-title', 'Data Kendaraan')

@section('content')
<div class="table-container">
    <div class="table-header">
        {{-- Tombol tambah kendaraan --}}
        <button type="button" class="btn-add"
            onclick="openCreateModal('{{ route('vehicles.create') }}', 'Kendaraan')">
            + Tambah Kendaraan
        </button>

        {{-- Form pencarian --}}
        <form method="GET" action="{{ route('vehicles.index') }}" class="search-container">
            <input type="text" class="search-input" name="search" value="{{ request('search') }}" placeholder="Cari kendaraan...">
            <button type="submit"></button>
        </form>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Cabang</th>
                <th>Variant</th>
                <th>Plat Nomor</th>
                <th>Nama Pemilik</th>
                <th>VIN</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($vehicles as $item)
                <tr>
                    <td>{{ $loop->iteration + ($vehicles->currentPage() - 1) * $vehicles->perPage() }}</td>
                    <td>{{ $item->branch ? $item->branch->branch_name : '-' }}</td>
                    <td>
                        {{ $item->variant ? $item->variant->vehicle_variant : '-' }}
                        {{-- Jika ingin juga tampilkan tipe kendaraan: --}}
                        {{-- ({{ $item->variant && $item->variant->vehicle_type ? $item->variant->vehicle_type->vehicle_type : '-' }}) --}}
                    </td>
                    <td>{{ $item->plat_number }}</td>
                    <td>{{ $item->owner_name }}</td>
                    <td>{{ $item->vehicle_identification_number }}</td>
                    <td>
                        <button class="btn-view" 
                            onclick="openShowModal('{{ route('vehicles.show', $item->id) }}', '{{ $item->plat_number }}')">
                            <i class="bi bi-eye-fill"></i>
                        </button>
                        <button class="btn-edit" 
                            onclick="openEditModal('{{ route('vehicles.edit', $item->id) }}', '{{ $item->plat_number }}')">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button class="btn-delete delete-button" 
                            onclick="event.preventDefault(); confirmDelete('{{ $item->id }}','{{ $item->plat_number }}')">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                        <x-confirm-delete :id="$item->id" :route="route('vehicles.destroy', $item->id)" />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data kendaraan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="table-footer">
        <div class="pagination">
            {{ $vehicles->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: "{{ session('success') }}",
        timer: 3000,
        showConfirmButton: false
    });
</script>
@endif

@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: "{{ session('error') }}",
        timer: 3000,
        showConfirmButton: false
    });
</script>
@endif
@endpush
