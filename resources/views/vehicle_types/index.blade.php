@extends('layouts.app')
@section('title', 'Data Tipe Kendaraan')
@section('page-title', 'Data Tipe Kendaraan')
@section('content')
<div class="table-container">
    <div class="table-header">
        <button type="button" class="btn-add" 
            onclick="openCreateModal('{{ route('vehicle_types.create') }}', 'Bengkel')">
            + Tambah Tipe Kendaraan
        </button>
        <form method="GET" action="{{ route('vehicle_types.index') }}" class="search-container">
            <input type="text" class="search-input" name="search" value="{{ request('search') }}" placeholder="Cari cabang...">
            <button type="submit">
            </button>
        </form>
        
    </div>
   
    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tipe Kendaraan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehicle_types as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->vehicle_type }}</td>
                    <td>
                        <button class="btn-view" onclick="openShowModal('{{ route('vehicle_types.show', $item->id) }}', '{{ $item->vehicle_type }}')">
                            <i class="bi bi-eye-fill"></i>
                        </button>
                        <button class="btn-edit" onclick="openEditModal('{{ route('vehicle_types.edit', $item->id) }}', '{{ $item->vehicle_type }}')">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button class="btn-delete delete-button" onclick="event.preventDefault(); confirmDelete('{{ $item->id }}','{{ $item->vehicle_type }}')">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                        <x-confirm-delete :id="$item->id" :route="route('vehicle_types.destroy', $item->id)" /> 
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="table-footer">
        <div class="pagination">
            {{ $vehicle_types->withQueryString()->links() }}
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