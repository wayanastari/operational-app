<div class="modal fade" id="createBranchModal" tabindex="-1" aria-labelledby="createBranchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createBranchModalLabel">Tambah Data Cabang Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('branch.store') }}" method="POST">
                @csrf 
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="branch_name" class="form-label">Nama Cabang</label>
                        <input type="text" class="form-control @error('branch_name') is-invalid @enderror" id="branch_name" name="branch_name" value="{{ old('branch_name') }}" required>
                        @error('branch_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="branch_address" class="form-label">Alamat</label>
                        <textarea class="form-control @error('branch_address') is-invalid @enderror" id="branch_address" name="branch_address" rows="3" required>{{ old('branch_address') }}</textarea>
                        @error('branch_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-add">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>