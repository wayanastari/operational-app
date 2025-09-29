@extends('layouts.app')
@section('title', 'Data Bengkel')
@section('page-title', 'Data Bengkel')
@section('content')
<div class="table-container">
    <div class="table-header">
        <button type="button" class="btn-add">
            + Tambah Bengkel
        </button>
        <form method="GET" action="{{ route('branch.index') }}" class="search-container">
            <input type="text" class="search-input" name="search" value="{{ request('search') }}" placeholder="Cari cabang...">
            <button type="submit">
                <!-- <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="#979797" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.1-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg> -->
            </button>
        </form>
        
    </div>
   
    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Bengkel</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($garage as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->garage_name }}</td>
                    <td>{{ $item->garage_address }}</td>
                    <td>
                        <button class="btn-view" >
                            <i class="bi bi-eye-fill"></i>
                        </button>
                        <button class="btn-edit" >
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button class="btn-delete delete-button" >
                            <i class="bi bi-trash-fill"></i>
                        </button>
                        <!-- <x-confirm-delete :id="$item->id" :route="route('branch.destroy', $item->id)" /> -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="table-footer">
        <div class="showing-results">
            Showing {{ $garage->firstItem() }} to {{ $garage->lastItem() }} of {{ $garage->total() }} results
        </div>
        <div class="pagination">
            {{ $garage->withQueryString()->links() }}
        </div>
    </div>

</div>
@endsection
@push('scripts')
@if ($errors->any() && session('modal-open') == 'createBranchModal')
<script>
    var createBranchModal = new bootstrap.Modal(document.getElementById('createBranchModal'));
    createBranchModal.show();
</script>
@endif
<script>
    var createBranchModal = document.getElementById('createBranchModal');
    createBranchModal.addEventListener('show.bs.modal', function () {
        document.getElementById('branch_name').focus();
    });
</script>
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