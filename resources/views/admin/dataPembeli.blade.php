@include('structure.header')
@include('structure.navbarAdmin')
<!-- gray bg -->
<!-- Button trigger modal -->
<section class="tm-white-bg section-padding-bottom">
    <div class="container" style="height: 600px;">
        <br><br><br>
        <h2 class="text-center"><b>DATA PEMBELI</b></h2>
        <hr>
        <table id="myTable" class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($dataPembeli as $dt) {
                ?>
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $dt->name }}</td>
                        <td>{{ $dt->email }}</td>
                        <td>{{ ucwords($dt->role) }}</td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $dt->id_user }}">
                                <span class="fa fa-info-circle"></span>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $dt->id_user }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel"><b>Detail Pembeli</b></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/updateTransaksi" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label class="form-label"><b>Nama</b></label>
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ $dt->name }}" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label"><b>Email</b></label>
                                                    <input type="email" class="form-control" id="email" name="email" value="{{ $dt->email }}" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label"><b>Role</b></label>
                                                    <select class="form-select" name="role" id="role">
                                                        <option value="Pembeli" selected>Pembeli</option>
                                                    </select>
                                                </div>
                                                <input type="hidden" name="id_user" value="{{ $dt->id_user }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    <!-- <button type="submit" class="btn btn-primary">Ubah</button> -->
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
        responsive: true
    });
</script>
@include('structure.footer')