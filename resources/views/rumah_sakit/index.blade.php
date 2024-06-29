<!-- resources/views/rumah_sakit/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container-fluid w-100 m">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Data Rumah Sakit</h1>
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="bi bi-plus-circle"></i>
                <span class="ms-2">Tambah Rumah Sakit</span>
            </button>
        </div>
        <table class="table table-striped table-bordered border-dark m-0" id="table-data" style="width:100%">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Nama Rumah Sakit</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rumahSakits as $rumahSakit)
                    <tr>
                        <td>{{ $rumahSakit->id }}</td>
                        <td>{{ $rumahSakit->nama_rumah_sakit }}</td>
                        <td>{{ $rumahSakit->alamat }}</td>
                        <td>{{ $rumahSakit->email }}</td>
                        <td>{{ $rumahSakit->telepon }}</td>
                        <td class="align-middle text-center">
                            <div class="d-flex justify-content-center align-items-center">
                                <button class="btn btn-warning btn-edit me-2" data-id="{{ $rumahSakit->id }}" data-bs-toggle="modal" data-bs-target="#editModal"><i class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-danger btn-delete" data-id="{{ $rumahSakit->id }}"><i class="bi bi-trash3"></i></button>
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
                    <h5 class="modal-title" id="createModalLabel">Tambah Rumah Sakit</h5>
                    <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createForm">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="createNamaRumahSakit">Nama Rumah Sakit</label>
                            <input class="form-control" id="createNamaRumahSakit" name="nama_rumah_sakit" type="text" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="createAlamat">Alamat</label>
                            <input class="form-control" id="createAlamat" name="alamat" type="text" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="createEmail">Email</label>
                            <input class="form-control" id="createEmail" name="email" type="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="createTelepon">Telepon</label>
                            <input class="form-control" id="createTelepon" name="telepon" type="text" required>
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
                    <h5 class="modal-title" id="editModalLabel">Edit Rumah Sakit</h5>
                    <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        @csrf
                        @method('PUT')
                        <input id="editId" name="id" type="hidden">
                        <div class="mb-3">
                            <label class="form-label" for="editNamaRumahSakit">Nama Rumah Sakit</label>
                            <input class="form-control" id="editNamaRumahSakit" name="nama_rumah_sakit" type="text" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="editAlamat">Alamat</label>
                            <input class="form-control" id="editAlamat" name="alamat" type="text" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="editEmail">Email</label>
                            <input class="form-control" id="editEmail" name="email" type="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="editTelepon">Telepon</label>
                            <input class="form-control" id="editTelepon" name="telepon" type="text" required>
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

            $('#createForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('rumah_sakit.store') }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#createModal').modal('hide');
                        toastr.success('Data Rumah Sakit berhasil ditambahkan.');
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
                    url: `/rumah_sakit/${id}`,
                    method: 'GET',
                    success: function(response) {
                        $('#editId').val(response.id);
                        $('#editNamaRumahSakit').val(response.nama_rumah_sakit);
                        $('#editAlamat').val(response.alamat);
                        $('#editEmail').val(response.email);
                        $('#editTelepon').val(response.telepon);
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
                    url: `/rumah_sakit/${id}`,
                    method: 'PUT',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#editModal').modal('hide');
                        toastr.success('Data Rumah Sakit berhasil diperbarui.');
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
                        url: `/rumah_sakit/${id}`,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            toastr.success('Data Rumah Sakit berhasil dihapus.');
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
