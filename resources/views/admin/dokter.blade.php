@extends('layouts.admin')

@section('title', 'Dokter-Dashboard')

@section('content')
    <div>
        <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#addModal">
            Tambah Data Dokter
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
                <h4>Data Dokter</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead style="background-color: black">
                        <tr class="text-white">
                            <th>Nama Dokter</th>
                            <th>Alamat</th>
                            <th>No. HP</th>
                            <th>Poli</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $dokter)
                            <tr>
                                <td>{{ $dokter->name }}</td>
                                <td>{{ $dokter->alamat }}</td>
                                <td>{{ $dokter->no_hp }}</td>
                                <td>{{ $dokter->poli->name }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm"
                                        onclick="editDokter({{ $dokter }})">Edit</button>
                                    <form action="{{ route('admin.dokter.destroy', $dokter->id) }}" method="POST"
                                        style="display:inline;" id="deleteForm_{{ $dokter->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="confirmDelete({{ $dokter->id }})">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Modal Add Dokter --}}
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Tambah Data Dokter</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.dokter.store') }}" method="POST" id="addForm">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Dokter:</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat:</label>
                                <input type="text" class="form-control" name="alamat" required>
                            </div>
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No. HP:</label>
                                <input type="text" class="form-control" name="no_hp" required>
                            </div>
                            <div class="mb-3">
                                <label for="id_poli" class="form-label">Poli:</label>
                                <select name="id_poli" class="form-control" required>
                                    <option value="">Pilih Poli</option>
                                    @foreach ($poli as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Edit Dokter --}}
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Data Dokter</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="edit_name" class="form-label">Nama Dokter:</label>
                                <input type="text" class="form-control" name="name" id="edit_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_alamat" class="form-label">Alamat:</label>
                                <input type="text" class="form-control" name="alamat" id="edit_alamat" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_no_hp" class="form-label">No. HP:</label>
                                <input type="text" class="form-control" name="no_hp" id="edit_no_hp" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_id_poli" class="form-label">Poli:</label>
                                <select name="id_poli" class="form-control" id="edit_id_poli" required>
                                    @foreach ($poli as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script>
        function editDokter(dokter) {
            $('#editModalLabel').text('Edit Data Dokter');

            //action set
            $('#editForm').attr('action', '/admin/dokter/' + dokter.id);
            // set form data
            $('#edit_name').val(dokter.name);
            $('#edit_alamat').val(dokter.alamat);
            $('#edit_no_hp').val(dokter.no_hp);
            $('#edit_id_poli').val(dokter.id_poli);

            $('#editModal').modal('show');
        }

        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data Dokter ini akan dihapus!',
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
                        'Data Dokter telah berhasil dihapus.',
                        'success'
                    );
                }
            });
        }
    </script>

@endsection
