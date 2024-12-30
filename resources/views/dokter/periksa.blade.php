@extends('layouts.dokter')

@section('title', 'Daftar Periksa')

@section('content')

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
            <h4>Daftar Pasien</h4>
        </div>
        <div class="card-body">
            <table class="table table-hover table-dark">
                <thead>
                    <tr class="text-white">
                        <th>No</th>
                        <th>Nama Pasien</th>
                        <th>Keluhan</th>
                        <th>No Antrian</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($daftarPoli as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->pasien->name }}</td>
                            <td>{{ $item->keluhan }}</td>
                            <td>{{ $item->no_antrian }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm"
                                    onclick="openPeriksaModal({{ $item }})">Periksa</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Periksa --}}
    <div class="modal fade" id="periksaModal" tabindex="-1" aria-labelledby="periksaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="periksaForm" method="POST" action="{{ route('dokter.periksa.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="periksaModalLabel">Periksa Pasien</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_daftar_poli" id="id_daftar_poli">
                        <p><strong>Nama Pasien:</strong> <span id="nama_pasien"></span></p>
                        <p><strong>No RM:</strong> <span id="no_rm"></span></p>
                        <p><strong>Keluhan:</strong> <span id="keluhan"></span></p>
                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan Dokter:</label>
                            <textarea name="catatan" id="catatan" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="obat" class="form-label">Pilih Obat:</label>
                            <select name="obat[]" id="obat" class="form-control" multiple required
                                onchange="calculateTotal()">
                                @foreach ($obats as $obat)
                                    <option value="{{ $obat->id }}" data-harga="{{ $obat->harga }}">
                                        {{ $obat->nama_obat }} - Rp{{ $obat->harga }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="biaya_periksa" class="form-label">Biaya Periksa:</label>
                            <input type="text" id="biaya_periksa" class="form-control" value="150000" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openPeriksaModal(daftarPoli) {
            document.getElementById('id_daftar_poli').value = daftarPoli.id;
            document.getElementById('nama_pasien').innerText = daftarPoli.pasien.name;
            document.getElementById('no_rm').innerText = daftarPoli.pasien.no_rm;
            document.getElementById('keluhan').innerText = daftarPoli.keluhan;

            document.getElementById('biaya_periksa').value = 150000;

            const select = document.getElementById('obat');
            select.selectedIndex = -1;

            $('#periksaModal').modal('show');
        }

        function calculateTotal() {
            const baseBiaya = 150000;
            let total = baseBiaya;

            const selectedOptions = document.getElementById('obat').selectedOptions;
            for (let option of selectedOptions) {
                const hargaObat = parseInt(option.getAttribute('data-harga'));
                total += hargaObat;
            }

            document.getElementById('biaya_periksa').value = total;
        }
    </script>

@endsection
