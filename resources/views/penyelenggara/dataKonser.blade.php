@include('structure.header')
@include('structure.navbarPenyelenggara')
<!-- gray bg -->
<!-- Button trigger modal -->
<section class="tm-white-bg section-padding-bottom">
    <div class="container" style="height: 600px;">
        <br><br><br>
        <h2 class="text-center"><b>DATA KONSER</b></h2>
        <hr>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <span class="fa fa-plus"></span> Tambah Konser
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"><b>Tambah Konser</b></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/penyelenggara/insertKonser" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label class="form-label"><b>Gambar</b></label>
                                        <input type="file" class="form-control" id="image" name="image">
                                    </div>
                                </div>
                                <div class="col-8" style="border-left: 1px solid black;">
                                    <div class="mb-3">
                                        <label class="form-label"><b>Nama Konser</b></label>
                                        <input type="text" class="form-control" id="nama_konser" name="nama_konser">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"><b>Tanggal</b></label>
                                        <input type="date" class="form-control" id="tanggal_konser"
                                            name="tanggal_konser">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"><b>Lokasi & Kapasitas</b></label>
                                        <select name="lokasi" id="lokasi" class="form-control">
                                            <option selected>Pilih Lokasi</option>

                                            @foreach ($lokasi as $lokasiItem)
                                                <option value="{{ $lokasiItem->id_lokasi }}">{{ $lokasiItem->lokasi }} -
                                                    {{ $lokasiItem->tiket }} Tiket</option>
                                            @endforeach
                                        </select>
                                        {{-- <input type="text" class="form-control" id="lokasi" name="lokasi"> --}}
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"><b>Harga Tiket</b></label>
                                        <input type="number" class="form-control" id="harga" name="harga">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label"><b>Jenis Bank</b></label>
                                        <input type="text" class="form-control" id="jenis_bank" name="jenis_bank">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"><b>Atas Nama</b></label>
                                        <input type="text" class="form-control" id="atas_nama" name="atas_nama">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"><b>No Rekening</b></label>
                                        <input type="number" class="form-control" id="rekening" name="rekening">
                                    </div>
                                    <input type="hidden" name="id_user" value="{{ $id }}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <table id="myTable" class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Konser</th>
                    <th>Lokasi</th>
                    <th>Jumlah Tiket</th>
                    <th>Jumlah Tiket yang terbeli</th>
                    <th>Harga</th>
                    <th>Penyelenggara</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($dataKonser as $dt) {
                ?>
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ date('d-m-Y', strtotime($dt->tanggal_konser)) }}</td>
                    <td>{{ $dt->nama_konser }}</td>
                    <td>{{ $dt->lokasi }}</td>
                    <td>{{ $dt->jumlah_tiket }}</td>
                    <td>{{ $dt->jumlah_tiket_terbeli }}</td>
                    <td>Rp. {{ number_format($dt->harga, 2, ',', '.') }}</td>
                    <td>{{ $dt->atas_nama }}</td>
                    <td>{{ $dt->status }}</td>
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal{{ $dt->id_konser }}">
                            <span class="fa fa-info-circle"></span>
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{ $dt->id_konser }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel"><b>Detail Konser</b></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/penyelenggara/updateKonser" method="POST">
                                            @csrf
                                            <input type="hidden" name="id_user" value="{{ $id }}">
                                            <input type="hidden" name="id_konser" value="{{ $dt->id_konser }}">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="mb-3">
                                                        <label class="form-label"><b>Gambar</b></label>
                                                        <img src="/assets/img/poster/{{ $dt->image }}"
                                                            class="card-img-top" alt="..."
                                                            style="height: 300px;">
                                                    </div>
                                                </div>
                                                <div class="col-8" style="border-left: 1px solid black;">
                                                    <div class="mb-3">
                                                        <label class="form-label"><b>Nama Konser</b></label>
                                                        <input type="text" class="form-control" id="nama_konser"
                                                            name="nama_konser" value="{{ $dt->nama_konser }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label"><b>Tanggal</b></label>
                                                        <input type="date" class="form-control"
                                                            id="tanggal_konser" name="tanggal_konser"
                                                            value="{{ $dt->tanggal_konser }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label"><b>Lokasi & Kapasitas</b></label>
                                                        <select name="lokasi" id="lokasi" class="form-control">
                                                            @foreach ($lokasi as $lokasiItem)
                                                                <option value="{{ $lokasiItem->id_lokasi }}"
                                                                    {{ $dt->id_lokasi == $lokasiItem->id_lokasi ? 'selected' : '' }}>
                                                                    {{ $lokasiItem->lokasi }} -
                                                                    {{ $lokasiItem->tiket }} Tiket
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label"><b>Harga Tiket</b></label>
                                                        <input type="text" class="form-control" id="harga"
                                                            name="harga" value="{{ $dt->harga }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label"><b>Jenis Bank</b></label>
                                                        <input type="text" class="form-control" id="jenis_bank"
                                                            name="jenis_bank" value="{{ $dt->jenis_bank }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label"><b>Atas Nama</b></label>
                                                        <input type="text" class="form-control" id="atas_nama"
                                                            name="atas_nama" value="{{ $dt->atas_nama }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label"><b>No Rekening</b></label>
                                                        <input type="number" class="form-control" id="rekening"
                                                            name="rekening" value="{{ $dt->rekening }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label"><b>Status</b></label>
                                                        <input type="text" class="form-control" id="status"
                                                            name="status" value="{{ $dt->status }}" disabled>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Ubah</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#ModalDelete{{ $dt->id_konser }}">
                            <span class="fa fa-trash"></span>
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="ModalDelete{{ $dt->id_konser }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel"><b>Hapus Konser</b></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/penyelenggara/deleteKonser" method="POST">
                                            @csrf
                                            <h6>Apakah Anda Yakin Akan Menghapus Konser "{{ $dt->nama_konser }}"?</h6>
                                            <input type="hidden" id="id_konser" name="id_konser"
                                                value="{{ $dt->id_konser }}">
                                            <input type="hidden" id="image" name="image"
                                                value="{{ $dt->image }}">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>
<script>
    let table = new DataTable('#myTable', {
        scrollX: true,
        autoWidth: false
    });
</script>




@include('structure.footer')