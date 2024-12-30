@extends('layouts.admin')

@section('title', 'Obat-Dashboard')

@section('content')
    <div>
        <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#addModal">
            Tambah Data Obat
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
                <h4>Data Obat</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead style="background-color: black">
                        <tr class="text-white">
                            <th>Nama Obat</th>
                            <th>Kemasan</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->nama_obat }}</td>
                                <td>{{ $item->kemasan }}</td>
                                <td>Rp.{{ $item->harga }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm"
                                        onclick="editPoli({{ $item }})">Edit</button>
                                    <form action="{{ route('admin.obat.destroy', $item->id) }}" method="POST"
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
                        <h5 class="modal-title" id="addModalLabel">Tambah Data Obat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.obat.store') }}" method="POST" id="addForm">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_obat" class="form-label">Nama Obat:</label>
                                <input type="text" class="form-control" name="nama_obat" id="nama_obat" required>
                            </div>
                            <div class="mb-3">
                                <label for="kemasan" class="form-label">Kemasan:</label>
                                <input type="text" class="form-control" name="kemasan" id="kemasan" required>
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga:</label>
                                <input type="number" class="form-control" name="harga" id="harga" required>
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
                            <h5 class="modal-title" id="editModalLabel">Edit Data Obat</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="edit_nama_obat" class="form-label">Nama Obat:</label>
                                <input type="text" class="form-control" name="nama_obat" id="edit_nama_obat" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_kemasan" class="form-label">Kemasan:</label>
                                <input type="text" class="form-control" name="kemasan" id="edit_kemasan" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_harga" class="form-label">Harga:</label>
                                <input type="number" class="form-control" name="harga" id="edit_harga" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function editPoli(item) {
            $('#editModalLabel').text('Edit Data Obat');

            //action set
            $('#editForm').attr('action', '/admin/obat/' + item.id);
            //item
            $('#edit_nama_obat').val(item.nama_obat);
            $('#edit_kemasan').val(item.kemasan);
            $('#edit_harga').val(item.harga);

            $('#editModal').modal('show');
        }

        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data Obat ini akan dihapus!',
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
                        'Data Obat telah berhasil dihapus.',
                        'success'
                    );
                }
            });
        }
    </script>
@endsection
