<div class="tm-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-3 tm-site-name-container">
                <a href="#" class="tm-site-name">Events App</a>
            </div>
            <div class="col-lg-9 col-md-8 col-sm-9 flex">
                <div class="mobile-menu-icon" onclick="toggleMenu()">
                    <i class="fa fa-bars"></i>
                </div>
                <nav class="tm-nav">
                    <ul>
                        <?php
                        if ($pages == 'beranda') {
                            $m1 = 'active';
                            $m2 = '';
                            $m3 = '';
                        } elseif ($pages == 'dataTiket') {
                            $m1 = '';
                            $m2 = 'active';
                            $m3 = '';
                        } else {
                            $m1 = '';
                            $m2 = '';
                            $m3 = 'active';
                        }
                        ?>
                        <li><a href="/pembeli" class="{{ $m1 }}">Beranda</a></li>
                        <li><a href="/pembeli/dataTiket" class="{{ $m2 }}">Tiket</a></li>
                        <li><a href="/logout" class="{{ $m3 }}">Logout</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
