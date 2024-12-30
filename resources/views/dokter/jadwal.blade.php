@extends('layouts.dokter')

@section('title', 'Jadwal Periksa')

@section('content')
    <div>
        <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#addModal">
            Tambah Jadwal
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
                <h4>Jadwal Poli</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="bg-primary">
                        <tr class="text-white">
                            <th>Hari</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $jadwal)
                            <tr>
                                <td>{{ $jadwal->hari }}</td>
                                <td>{{ $jadwal->jam_mulai }}</td>
                                <td>{{ $jadwal->jam_selesai }}</td>
                                <td>
                                    @if ($jadwal->status == 'aktif')
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm"
                                        onclick="editJadwal({{ $jadwal }})">Edit</button>
                                    <form action="{{ route('dokter.jadwal.destroy', $jadwal->id) }}"
                                        id="deleteForm_{{ $jadwal->id }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="confirmDelete({{ $jadwal->id }})">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Modal Add Jadwal --}}
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('dokter.jadwal.store') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel">Tambah Jadwal Periksa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="hari" class="form-label">Hari:</label>
                                <select class="form-control" name="hari" required>
                                    <option value="" disabled selected>Pilih Hari</option>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                    <option value="Minggu">Minggu</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="jam_mulai" class="form-label">Jam Mulai:</label>
                                <input type="time" class="form-control" name="jam_mulai" required>
                            </div>
                            <div class="mb-3">
                                <label for="jam_selesai" class="form-label">Jam Selesai:</label>
                                <input type="time" class="form-control" name="jam_selesai" required>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status:</label>
                                <select class="form-control" name="status" required>
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Nonaktif</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
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
                            <h5 class="modal-title" id="editModalLabel">Edit Jadwal Periksa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="edit_hari" class="form-label">Hari:</label>
                                <select class="form-control" name="hari" id="edit_hari" required>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                    <option value="Minggu">Minggu</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit_jam_mulai" class="form-label">Jam Mulai:</label>
                                <input type="time" class="form-control" step="2" name="jam_mulai"
                                    id="edit_jam_mulai" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_jam_selesai" class="form-label">Jam Selesai:</label>
                                <input type="time" class="form-control" step="2" name="jam_selesai"
                                    id="edit_jam_selesai" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_status" class="form-label">Status:</label>
                                <select class="form-control" name="status" id="edit_status" required>
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Nonaktif</option>
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
        function editJadwal(jadwal) {
            $('#editModalLabel').text('Edit Jadwal Periksa');

            // Set action 
            $('#editForm').attr('action', '/dokter/jadwal/' + jadwal.id);

            $('#edit_hari').val(jadwal.hari);
            $('#edit_jam_mulai').val(jadwal.jam_mulai);
            $('#edit_jam_selesai').val(jadwal.jam_selesai);
            $('#edit_status').val(jadwal.status);

            $('#editModal').modal('show');
        }

        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data Jadwal ini akan dihapus!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm_' + id).submit();
                    Swal.fire('Dihapus!', 'Data Jadwal telah berhasil dihapus.', 'success');
                }
            });
        }
    </script>
@endsection
