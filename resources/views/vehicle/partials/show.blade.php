@if (isset($vehicle))
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th style="width: 30%;">Cabang</th>
                <td>{{ $vehicle->branch ? $vehicle->branch->branch_name : '-' }}</td>
            </tr>
            <tr>
                <th>Variant Kendaraan</th>
                <td>
                    {{ $vehicle->variant ? $vehicle->variant->vehicle_variant : '-' }}
                </td>
            </tr>
            <tr>
                <th>Tipe Kendaraan</th>
                <td>
                    {{ $vehicle->variant && $vehicle->variant->vehicle_type 
                        ? $vehicle->variant->vehicle_type->vehicle_type 
                        : '-' }}
                </td>
            </tr>
            <tr>
                <th>Plat Nomor</th>
                <td>{{ $vehicle->plat_number }}</td>
            </tr>
            <tr>
                <th>Nama Pemilik</th>
                <td>{{ $vehicle->owner_name }}</td>
            </tr>
            <tr>
                <th>VIN</th>
                <td>{{ $vehicle->vehicle_identification_number }}</td>
            </tr>
        </tbody>
    </table>

    <div class="d-flex justify-content-end pt-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
    </div>
@else
    <p class="alert alert-danger">Detail data kendaraan tidak ditemukan.</p>
@endif
