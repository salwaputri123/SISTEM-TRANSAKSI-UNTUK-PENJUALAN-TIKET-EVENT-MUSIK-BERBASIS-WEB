@include('structure.header')
@include('structure.navbarPenyelenggara')
<!-- gray bg -->
<!-- Button trigger modal -->
<section class="tm-white-bg section-padding-bottom">
    <div class="container" style="height: 600px;">
        <br><br><br>
        <h2 class="text-center"><b>DATA TRANSAKSI</b></h2>
        <hr>
        <table id="myTable" class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Tiket</th>
                    <th>Tanggal</th>
                    <th>Nama Konser</th>
                    <th>Nama</th>
                    <th>Jumlah Tiket</th>
                    <th>Total</th>
                    <th>QrCode</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataTransaksi as $dt)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if ($dt->keterangan == 'Berhasil')
                                @php
                                    $qrcodeFileName = pathinfo($dt->qrcode, PATHINFO_FILENAME);
                                @endphp
                                {{ $qrcodeFileName }}
                            @elseif ($dt->keterangan == 'Proses')
                                Pembayaran Sedang di Proses
                            @elseif ($dt->keterangan == 'Gagal')
                                Pembayaran Gagal
                            @endif
                        </td>
                        <td>{{ date('d-m-Y', strtotime($dt->tanggal)) }}</td>
                        <td>{{ $dt->nama_konser }}</td>
                        <td>{{ $dt->name }}</td>
                        <td>{{ $dt->qty }}</td>
                        <td>Rp. {{ number_format($dt->total, 2, ',', '.') }}</td>
                        <td>
                            @if ($dt->keterangan == 'Berhasil')
                                <img src="{{ asset('assets/img/qrcode/' . $dt->qrcode) }}" alt="QR Code" width="150"
                                    height="50">
                            @elseif ($dt->keterangan == 'Proses')
                                Sedang di Proses
                            @elseif ($dt->keterangan == 'Gagal')
                                Pembayaran Gagal
                            @endif
                        </td>
                        <td>{{ $dt->keterangan }}</td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal{{ $dt->id_transaksi }}">
                                <span class="fa fa-info-circle"></span>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $dt->id_transaksi }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel"><b>Detail Transaksi</b>
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/penyelenggara/updateTransaksi" method="POST">
                                                @csrf
                                                <input type="hidden" name="id_transaksi"
                                                    value="{{ $dt->id_transaksi }}">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="mb-3">
                                                            <label class="form-label"><b>Bukti Transfer</b></label>
                                                            <img src="/assets/img/transfer/{{ $dt->transfer }}"
                                                                class="card-img-top" alt="..."
                                                                style="height: 300px;">
                                                        </div>
                                                    </div>
                                                    <div class="col-8" style="border-left: 1px solid black;">
                                                        <div class="mb-3">
                                                            <label class="form-label"><b>Nama Konser</b></label>
                                                            <input type="text" class="form-control" id="nama_konser"
                                                                name="nama_konser" value="{{ $dt->nama_konser }}"
                                                                disabled>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label"><b>Nama</b></label>
                                                            <input type="text" class="form-control" id="name"
                                                                name="name" value="{{ $dt->name }}" disabled>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label"><b>Harga Tiket</b></label>
                                                            <input type="text" class="form-control" id="harga"
                                                                name="harga"
                                                                value="Rp. {{ number_format($dt->harga, 2, ',', '.') }}"
                                                                disabled>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label"><b>Jumlah Tiket</b></label>
                                                            <input type="number" class="form-control" id="qty"
                                                                name="qty" value="{{ $dt->qty }}" disabled>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label"><b>Total</b></label>
                                                            <input type="text" class="form-control" id="total"
                                                                name="total"
                                                                value="Rp. {{ number_format($dt->total, 2, ',', '.') }}"
                                                                disabled>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label"><b>Status</b></label>
                                                            <select name="status" id="status" class="form-control">
                                                                <option value="Berhasil"
                                                                    {{ $dt->keterangan == 'Berhasil' ? 'selected' : '' }}>
                                                                    Berhasil
                                                                </option>
                                                                <option value="Proses"
                                                                    {{ $dt->keterangan == 'Proses' ? 'selected' : '' }}>
                                                                    Proses
                                                                </option>
                                                                <option value="Gagal"
                                                                    {{ $dt->keterangan == 'Gagal' ? 'selected' : '' }}>
                                                                    Gagal
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup
                                                    </button>
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
</section>

<script>
    let table = new DataTable('#myTable', {
        scrollX: true,
        autoWidth: false
    });
</script>

@include('structure.footer')
