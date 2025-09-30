@if (isset($garage))
    <table class="table table-bordered table-striped">
        <tbody>
            <tr>
                <th>Nama Bengkel</th>
                <td>{{ $garage->garage_name }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $garage->garage_address }}</td>
            </tr>
        </tbody>
    </table>
    
    <div class="d-flex justify-content-end pt-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
    </div>
@else
    <p class="alert alert-danger">Detail data bengkel tidak ditemukan.</p>
@endif