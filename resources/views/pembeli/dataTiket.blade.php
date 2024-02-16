@include('structure.header')
@include('structure.navbarPembeli')
<!-- gray bg -->
<!-- Button trigger modal -->
<section class="tm-white-bg section-padding-bottom">
    <div class="container" style="height: 600px;">
        <br><br><br>
        <h2 class="text-center"><b>TIKET ANDA</b></h2>
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
                @foreach ($dataTiket as $dt)
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
                            @if ($dt->keterangan == 'Berhasil')
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal{{ $dt->id_transaksi }}">
                                    <span class="fa fa-info-circle"></span>
                                </button>
                            @elseif ($dt->keterangan == 'Proses')
                                <button type="button" class="btn btn-secondary disabled">
                                    <span class="fa fa-info-circle"></span>
                                </button>
                            @elseif ($dt->keterangan == 'Gagal')
                                <button type="button" class="btn btn-secondary disabled">
                                    <span class="fa fa-info-circle"></span>
                                </button>
                            @endif

                            {{-- Modal --}}
                            <div class="modal fade" id="exampleModal{{ $dt->id_transaksi }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel"><b>E-Ticket</b></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body container">
                                            <div class="d-flex justify-content-between">
                                                <div class="card-title ">Detail Tiket</div>
                                                <div class="card-title"><span class="fa fa-ticket"></span> E-Tiket</div>
                                            </div>
                                            <hr>
                                            <div class="d-flex justify-content-center align-items-center">
                                                <div class="card-title">{{ $dt->name }}</div>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex flex-column">
                                                    <div class="card-title">Kode Tiket</div>
                                                    @php
                                                        $qrcodeFileName = pathinfo($dt->qrcode, PATHINFO_FILENAME);
                                                    @endphp
                                                    <div class="card-title"><b>{{ $qrcodeFileName }}</b></div>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <div class="card-title">
                                                        <img src="{{ asset('assets/img/qrcode/' . $dt->qrcode ) }}"
                                                            alt="QR Code" width="150" height="40">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex flex-column">
                                                    <div class="card-title">Nama Konser</div>
                                                    <div class="card-title">Nama Pembeli</div>
                                                    <div class="card-title">Total Tiket</div>
                                                    <div class="card-title">Harga</div>
                                                </div>
                                                <div class="d-flex flex-column text-end">
                                                    <div class="card-title">{{ $dt->nama_konser }}</div>
                                                    <div class="card-title">{{ $dt->name }}</div>
                                                    <div class="card-title">{{ $dt->qty }}</div>
                                                    <div class="card-title">Rp.
                                                        {{ number_format($dt->total, 2, ',', '.') }}</div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <a href="{{ route('unduh.pdf',$dt->id_transaksi) }}"  class="btn btn-primary">Unduh PDF</a>
                                            </div>
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
@include('structure.footer')
