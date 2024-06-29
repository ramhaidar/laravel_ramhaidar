@foreach ($pasiens as $pasien)
    <tr>
        <td>{{ $pasien->id }}</td>
        <td>{{ $pasien->nama_pasien }}</td>
        <td>{{ $pasien->alamat }}</td>
        <td>{{ $pasien->no_telepon }}</td>
        <td>{{ $pasien->rumahSakit->nama_rumah_sakit }}</td>
        <td class="align-middle text-center">
            <div class="d-flex justify-content-center align-items-center">
                <button class="btn btn-warning btn-edit me-2" data-id="{{ $pasien->id }}" data-bs-toggle="modal" data-bs-target="#editModal"><i class="bi bi-pencil-square"></i></button>
                <button class="btn btn-danger btn-delete" data-id="{{ $pasien->id }}"><i class="bi bi-trash3"></i></button>
            </div>
        </td>
    </tr>
@endforeach
