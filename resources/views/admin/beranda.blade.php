@include('structure.header')
@include('structure.navbarAdmin')
<!-- gray bg -->
<section class="tm-white-bg section-padding-bottom">
    <div class="container" style="height: 600px;">
        <br><br><br>
        <h2 class="text-center"><b>BERANDA</b></h2>
        <hr>
        <h3 class="text-center"><b>Hello {{ ucwords($name) }} Selamat Datang!</b></h3>
        <h4 class="text-center">Hak akses admin master adalah mengelola menu konser, menu transaksi, menu pembeli.</h4>
        <hr>
        <div class="mb-3">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <span class="fa fa-plus"></span> Tambah Konser
            </button>
        </div>

        <table id="myTable" class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Lokasi</th>
                    <th>Kapasitas Orang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lokasi as $lok)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $lok->lokasi }}</td>
                        <td>{{ $lok->tiket }}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal{{ $lok->id_lokasi }}">
                                <span class="fa fa-info-circle"></span>
                            </button>
    
                            {{-- Modal --}}
                            <div class="modal fade" id="exampleModal{{ $lok->id_lokasi }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel"><b>Detail Lokasi</b>
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/updateLokasi" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="mb-3">
                                                            <label class="form-label"><b>Lokasi</b></label>
                                                            <input type="text" class="form-control" id="lokasi"
                                                                name="lokasi" value="{{ $lok->lokasi }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label"><b>Kapasitas</b></label>
                                                            <input type="number" class="form-control" id="tiket"
                                                                name="tiket" value="{{ $lok->tiket }}">
                                                        </div>
                                                        <input type="hidden" name="id_lokasi" value="{{ $lok->id_lokasi }}">
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
                        </td>
                    </tr>
                @endforeach
    
            </tbody>
        </table>


    </div>
    </div>
</section>
<script>
    let table = new DataTable('#myTable', {
        scrollX: true,
        autoWidth: false
    });
</script>

{{-- Modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><b>Tambah Konser</b></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/tambahLokasi" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label"><b>Lokasi</b></label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><b>Jumlah Kapasitas</b></label>
                            <input type="number" class="form-control" id="tiket" name="tiket">
                        </div>
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
@include('structure.footer')
