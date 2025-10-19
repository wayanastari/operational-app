@props(['action', 'isEdit' => false])

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif

    {{ $slot }}

    <div class="d-flex justify-content-end pt-4">
        <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-add">
            {{ $isEdit ? 'Simpan Perubahan' : 'Tambah Data' }}
        </button>
    </div>
</form>