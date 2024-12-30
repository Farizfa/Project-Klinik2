@extends('layouts.admin')

@section('title', 'Pasien-Dashboard')

@section('content')
    <div>
        <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#addModal">
            Tambah Data Pasien
        </button>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h4>Data Pasien</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead style="background-color: black">
                        <tr class="text-white">
                            <th>Nama Pasien</th>
                            <th>Alamat</th>
                            <th>No KTP</th>
                            <th>No Hp</th>
                            <th>No Rekam Medis</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->no_ktp }}</td>
                                <td>{{ $item->no_hp }}</td>
                                <td>{{ $item->no_rm }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm"
                                        onclick="editPasien({{ $item }})">Edit</button>
                                    <form action="{{ route('admin.pasien.destroy', $item->id) }}" method="POST"
                                        style="display:inline;" id="deleteForm_{{ $item->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="confirmDelete({{ $item->id }})">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Modal Add --}}
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Tambah Data Pasien</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.pasien.store') }}" method="POST" id="addForm">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Pasien: </label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat:</label>
                                <input type="text" class="form-control" name="alamat" required>
                            </div>
                            <div class="mb-3">
                                <label for="no_ktp" class="form-label">No KTP:</label>
                                <input type="number" class="form-control" name="no_ktp" required>
                            </div>
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No Hp:</label>
                                <input type="number" class="form-control" name="no_hp" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Edit --}}
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Data Pasien</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="edit_name" class="form-label">Nama Pasien:</label>
                                <input type="text" class="form-control" name="name" id="edit_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_alamat" class="form-label">Alamat:</label>
                                <input type="text" class="form-control" name="alamat" id="edit_alamat" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_no_ktp" class="form-label">No KTP:</label>
                                <input type="number" class="form-control" name="no_ktp" id="edit_no_ktp" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_no_hp" class="form-label">No Hp:</label>
                                <input type="number" class="form-control" name="no_hp" id="edit_no_hp" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_no_rm" class="form-label">No Rekam Medis:</label>
                                <input type="text" class="form-control" name="no_rm" id="edit_no_rm" disabled>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function editPasien(item) {
            $('#editModalLabel').text('Edit Data Poli');

            //action set
            $('#editForm').attr('action', '/admin/pasien/' + item.id);
            //item
            $('#edit_name').val(item.name);
            $('#edit_alamat').val(item.alamat);
            $('#edit_no_ktp').val(item.no_ktp);
            $('#edit_no_hp').val(item.no_hp);
            $('#edit_no_rm').val(item.no_rm);

            $('#editModal').modal('show');
        }

        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data Pasien ini akan dihapus!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm_' + id).submit();
                    Swal.fire(
                        'Dihapus!',
                        'Data Pasien telah berhasil dihapus.',
                        'success'
                    );
                }
            });
        }
    </script>
@endsection
