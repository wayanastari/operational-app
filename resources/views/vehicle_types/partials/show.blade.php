@if (isset($vehicle_types))
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>Tipe Kendaraan</th>
                <td>{{ $vehicle_types->vehicle_type }}</td>
            </tr>
        </tbody>
    </table>
    
    <div class="d-flex justify-content-end pt-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
    </div>
@else
    <p class="alert alert-danger">Detail data tipe kendaraan tidak ditemukan.</p>
@endif