@include('structure.header')
@include('structure.navbarPembeli')
@php
    use Carbon\Carbon;
@endphp

<!-- Banner -->
<section class="tm-banner">
    <!-- Flexslider -->
    <div class="flexslider flexslider-banner">
        <ul class="slides">
            <li>
                <img src="/assets/img/banner/bg1.jpeg" alt="Image" class="blur" />
                <div class="tm-banner-inner">
                    <h1 class="tm-banner-title">Temukan <span class="tm-yellow-text">Konsermu</span> Disini</h1>
                    <p class="tm-banner-subtitle">Hai, {{ $name }}</p>
                    <!-- <a href="#more" class="tm-banner-link">Learn More</a> -->
                </div>
            </li>
            <li>
                <img src="/assets/img/banner/bg2.jpg" alt="Image" class="blur" />
                <div class="tm-banner-inner">
                    <h1 class="tm-banner-title">Temukan <span class="tm-yellow-text">Konsermu</span> Disini</h1>
                    <p class="tm-banner-subtitle">Events App</p>
                    <!-- <a href="#more" class="tm-banner-link">Learn More</a> -->
                </div>
            </li>
            <li>
                <img src="/assets/img/banner/bg3.png" alt="Image" class="blur" />
                <div class="tm-banner-inner">
                    <h1 class="tm-banner-title">Temukan <span class="tm-yellow-text">Konsermu</span> Disini</h1>
                    <p class="tm-banner-subtitle">Events App</p>
                    <!-- <a href="#more" class="tm-banner-link">Learn More</a> -->
                </div>
            </li>
        </ul>
    </div>
</section>

<!-- gray bg -->
<section class="tm-white-bg section-padding-bottom">
    <div class="container">
        <br><br>
        <h2 class="text-center"><b>DAFTAR KONSER TERBARU</b></h2>
        <hr>
        <div class="row">
            <?php
            foreach ($dataKonser as $dt) {
            ?>
            <div class="card" style="width: 19rem; margin:12px">
                <img src="/assets/img/poster/{{ $dt->image }}" class="card-img-top" alt="..."
                    style="height: 300px;">
                <div class="card-body">
                    <h5 class="card-title">{{ $dt->nama_konser }}</h5>
                    <h6 class="card-title">Rp. {{ number_format($dt->harga, 2, ',', '.') }}</h6>
                    <h6 class="card-title"><span class="fa fa-map-marker"></span> {{ $dt->lokasi->lokasi }}</h6>
                    <h6 class="card-title">Tiket Terjual {{ $dt->jumlah_tiket_terbeli }}</h6>
                    <div class="row">
                        <div class="col-6">
                            <h6 class="card-title"><span class="fa fa-calendar"></span>
                                {{ date('d-m-Y', strtotime($dt->tanggal_konser)) }}</h6>
                        </div>
                        <div class="col-6">
                            <h6 class="card-title"><span class="fa fa-ticket"></span> {{ $dt->jumlah_tiket }} Tiket</h6>
                        </div>
                    </div>
                    <hr>
                    <!-- Button trigger modal -->
                    <button type="button"
                        class="btn
                        @if (\Carbon\Carbon::parse($dt->tanggal_konser)->isPast()) btn-secondary
                        @else
                        btn-primary 
                        @endif
                        col-12"
                        data-bs-toggle="modal" data-bs-target="#exampleModal{{ $dt->id_konser }}"
                        {{ \Carbon\Carbon::parse($dt->tanggal_konser)->isPast() ? 'disabled' : '' }}>
                        <span class="fa fa-paper-plane"></span>
                        @if (\Carbon\Carbon::parse($dt->tanggal_konser)->isPast())
                            Konser Telah Selesai
                        @else
                            Pesan Sekarang
                        @endif
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
                                    <form action="/transaksiPembeli" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <label class="form-label"><b>Jenis Bank</b></label>
                                                    <input type="text" class="form-control" id="jenis_bank"
                                                        name="jenis_bank" value="{{ $dt->jenis_bank }}" disabled>
                                                </div>
                                                <div class=" mb-3">
                                                    <label class="form-label"><b>Atas Nama</b></label>
                                                    <input type="text" class="form-control" id="atas_nama"
                                                        name="atas_nama" value="{{ $dt->atas_nama }}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label"><b>No Rekening</b></label>
                                                    <input type="number" class="form-control" id="rekening"
                                                        name="rekening" value="{{ $dt->rekening }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-6" style="border-left: 1px solid black;">
                                                <div class="mb-3">
                                                    <label class="form-label"><b>Nama Konser</b></label>
                                                    <input type="text" class="form-control" id="nama_konser"
                                                        name="nama_konser" value="{{ $dt->nama_konser }}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label"><b>Harga</b></label>
                                                    <input type="text" class="form-control"
                                                        id="harga{{ $dt->id_konser }}" name="harga"
                                                        value="{{ $dt->harga }}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label"><b>Qty</b></label>
                                                    <input type="number" class="form-control"
                                                        id="qty{{ $dt->id_konser }}" name="qty" value="1">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label"><b>Total</b></label>
                                                    <h3 name="total"></h3>
                                                    <input type="text" class="form-control"
                                                        id="total{{ $dt->id_konser }}" name="total">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label"><b>Bukti Transfer</b></label>
                                                    <input type="file" class="form-control" id="transfer"
                                                        name="transfer">
                                                </div>
                                                <input type="hidden" name="id_konser" value="{{ $dt->id_konser }}">
                                                <input type="hidden" name="id_user" value="{{ $id }}">
                                                <input type="hidden" name="jumlah_tiket"
                                                    value="{{ $dt->jumlah_tiket }}">
                                            </div>
                                            <script>
                                                $("input#qty{{ $dt->id_konser }}")
                                                    .on("keyup", function() {
                                                        var harga = $("#harga{{ $dt->id_konser }}").val();
                                                        var value = $(this).val();
                                                        var total = harga * value;
                                                        $("input#total{{ $dt->id_konser }}").val(total);
                                                    })
                                                    .trigger("keyup");
                                            </script>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Konfirmasi</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
@include('structure.footer')
