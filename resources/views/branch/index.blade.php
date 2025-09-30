@extends('layouts.app')
@section('title', 'Data Cabang')
@section('page-title', 'Data Cabang')
@section('content')
<div class="table-container">
    <div class="table-header">
        <button type="button" class="btn-add"
            onclick="openCreateModal('{{ route('branch.create') }}', 'Cabang')">
            + Tambah Cabang
        </button>
        <form method="GET" action="{{ route('branch.index') }}" class="search-container">
            <input type="text" class="search-input" name="search" value="{{ request('search') }}" placeholder="Cari cabang...">
            <button type="submit">
            </button>
        </form>
        
    </div>
   
    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Cabang</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($branch as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->branch_name }}</td>
                    <td>{{ $item->branch_address }}</td>
                    <td>
                        <button class="btn-view" onclick="openShowModal('{{ route('branch.show', $item->id) }}', '{{ $item->branch_name }}')">
                            <i class="bi bi-eye-fill"></i>
                        </button>
                        <button class="btn-edit" onclick="openEditModal('{{ route('branch.edit', $item->id) }}', '{{ $item->branch_name }}')">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button class="btn-delete delete-button" onclick="event.preventDefault(); confirmDelete('{{ $item->id }}','{{ $item->branch_name }}')">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                        <x-confirm-delete :id="$item->id" :route="route('branch.destroy', $item->id)" />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="table-footer">
        <div class="pagination">
            {{ $branch->withQueryString()->links() }}
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