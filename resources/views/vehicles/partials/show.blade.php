@if (isset($vehicle_variants))
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th style="width: 30%;">Tipe Kendaraan</th>
                <td>{{ $vehicle_variants->vehicle_type->vehicle_type }}</td>
            </tr>
            <tr>
                <th>Variant</th>
                <td>{{ $vehicle_variants->vehicle_variant }}</td>
            </tr>
        </tbody>
    </table>
    
    <div class="d-flex justify-content-end pt-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
    </div>
@else
    <p class="alert alert-danger">Detail data variasi kendaraan tidak ditemukan.</p>
@endif