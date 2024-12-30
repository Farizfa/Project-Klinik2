@extends('layouts.pasien')

@section('title', 'pasien Dashboard')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Profile</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-primary">
                            <tr class="text-white">
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>No Hp</th>
                                <th>Nama Poli</th>
                                <th>No Rm</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $pasien)
                                <tr>
                                    <td>{{ $pasien->name }}</td>
                                    <td>{{ $pasien->alamat }}</td>
                                    <td>{{ $pasien->no_hp }}</td>
                                    <td>{{ $pasien->no_ktp }}</td>
                                    <td>{{ $pasien->no_rm }}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm"
                                            onclick="editPasien({{ $pasien }})">Edit</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_name" class="form-label">Nama:</label>
                            <input type="text" class="form-control" name="name" id="edit_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_alamat" class="form-label">Alamat:</label>
                            <input type="text" class="form-control" name="alamat" id="edit_alamat" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_no_hp" class="form-label">No Hp:</label>
                            <input type="text" class="form-control" name="no_hp" id="edit_no_hp" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_no_ktp" class="form-label">No KTP:</label>
                            <input type="text" class="form-control" name="no_ktp" id="edit_no_ktp" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function editPasien(pasien) {
            $('#editModalLabel').text('Edit Data Pasien');

            // Set action URL
            $('#editForm').attr('action', '/pasien/profile/' + pasien.id);

            // Set form values
            $('#edit_name').val(pasien.name);
            $('#edit_alamat').val(pasien.alamat);
            $('#edit_no_hp').val(pasien.no_hp);
            $('#edit_no_ktp').val(pasien.no_ktp);

            // Show modal
            $('#editModal').modal('show');
        }
    </script>
@endsection
