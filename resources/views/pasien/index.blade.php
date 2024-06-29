@extends('layouts.app')

@section('content')
    <div class="container-fluid w-100 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Data Pasien</h1>
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="bi bi-plus-circle"></i>
                <span class="ms-2">Tambah Pasien</span>
            </button>
        </div>
        <div class="form-group mb-3">
            <label for="filter-rumah-sakit">Filter Berdasarkan Rumah Sakit:</label>
            <select class="form-control" id="filter-rumah-sakit">
                <option value="">Semua Rumah Sakit</option>
                @foreach ($rumahSakits as $rumahSakit)
                    <option value="{{ $rumahSakit->id }}">{{ $rumahSakit->nama_rumah_sakit }}</option>
                @endforeach
            </select>
        </div>
        <table class="table table-striped table-bordered border-dark m-0" id="table-data" style="width:100%">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Nama Pasien</th>
                    <th>Alamat</th>
                    <th>No Telepon</th>
                    <th>Rumah Sakit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="pasien-table">
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
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="createModal" aria-labelledby="createModalLabel" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Pasien</h5>
                    <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createForm">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="createNamaPasien">Nama Pasien</label>
                            <input class="form-control" id="createNamaPasien" name="nama_pasien" type="text" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="createAlamat">Alamat</label>
                            <input class="form-control" id="createAlamat" name="alamat" type="text" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="createTelepon">No Telepon</label>
                            <input class="form-control" id="createTelepon" name="no_telepon" type="text" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="createRumahSakit">Rumah Sakit</label>
                            <select class="form-control" id="createRumahSakit" name="rumah_sakit_id" required>
                                @foreach ($rumahSakits as $rumahSakit)
                                    <option value="{{ $rumahSakit->id }}">{{ $rumahSakit->nama_rumah_sakit }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" aria-labelledby="editModalLabel" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Pasien</h5>
                    <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        @csrf
                        @method('PUT')
                        <input id="editId" name="id" type="hidden">
                        <div class="mb-3">
                            <label class="form-label" for="editNamaPasien">Nama Pasien</label>
                            <input class="form-control" id="editNamaPasien" name="nama_pasien" type="text" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="editAlamat">Alamat</label>
                            <input class="form-control" id="editAlamat" name="alamat" type="text" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="editTelepon">No Telepon</label>
                            <input class="form-control" id="editTelepon" name="no_telepon" type="text" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="editRumahSakit">Rumah Sakit</label>
                            <select class="form-control" id="editRumahSakit" name="rumah_sakit_id" required>
                                @foreach ($rumahSakits as $rumahSakit)
                                    <option value="{{ $rumahSakit->id }}">{{ $rumahSakit->nama_rumah_sakit }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-primary" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            function reloadPageAfterDelay() {
                setTimeout(function() {
                    location.reload();
                }, 1500);
            }

            $('#filter-rumah-sakit').change(function() {
                var rumahSakitId = $(this).val();
                var url = "{{ url('pasien/filter') }}" + '/' + (rumahSakitId ? rumahSakitId : 'all');

                $.ajax({
                    url: url,
                    method: "GET",
                    success: function(response) {
                        $('#pasien-table').html(response.html);
                    },
                    error: function(xhr) {
                        if (xhr.status == 404) {
                            $('#pasien-table').html('<tr><td colspan="6" class="text-center">Tidak ada data pasien ditemukan untuk Rumah Sakit ini.</td></tr>');
                        } else {
                            toastr.error('Terjadi kesalahan saat memfilter data.');
                        }
                    }
                });
            });

            $('#createForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('pasien.store') }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#createModal').modal('hide');
                        toastr.success('Data Pasien berhasil ditambahkan.');
                        reloadPageAfterDelay();
                    },
                    error: function(xhr) {
                        toastr.error('Terjadi kesalahan saat menambahkan data.');
                    }
                });
            });

            $(document).on('click', '.btn-edit', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: `/pasien/${id}`,
                    method: 'GET',
                    success: function(response) {
                        $('#editId').val(response.id);
                        $('#editNamaPasien').val(response.nama_pasien);
                        $('#editAlamat').val(response.alamat);
                        $('#editTelepon').val(response.no_telepon);
                        $('#editRumahSakit').val(response.rumah_sakit_id);
                    },
                    error: function(xhr) {
                        toastr.error('Terjadi kesalahan saat mengambil data.');
                    }
                });
            });

            $('#editForm').on('submit', function(e) {
                e.preventDefault();
                var id = $('#editId').val();
                $.ajax({
                    url: `/pasien/${id}`,
                    method: 'PUT',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#editModal').modal('hide');
                        toastr.success('Data Pasien berhasil diperbarui.');
                        reloadPageAfterDelay();
                    },
                    error: function(xhr) {
                        toastr.error('Terjadi kesalahan saat memperbarui data.');
                    }
                });
            });

            $(document).on('click', '.btn-delete', function() {
                var id = $(this).data('id');
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    $.ajax({
                        url: `/pasien/${id}`,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            toastr.success('Data Pasien berhasil dihapus.');
                            reloadPageAfterDelay();
                        },
                        error: function(xhr) {
                            toastr.error('Terjadi kesalahan saat menghapus data.');
                        }
                    });
                }
            });
        });
    </script>
@endsection
