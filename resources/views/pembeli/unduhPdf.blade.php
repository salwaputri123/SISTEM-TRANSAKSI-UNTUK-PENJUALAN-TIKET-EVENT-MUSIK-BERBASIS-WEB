<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-Ticket</title>
    <style>
        /* Reset some default styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
        }

        hr {
            border: 1px solid #ccc;
            margin: 20px 0;
        }

        .d-flex {
            display: flex;
        }

        .justify-content-between {
            justify-content: space-between;
        }

        .flex-column {
            flex-direction: column;
        }

        .text-end {
            text-align: right;
        }

        /* Styles for the QR Code image */
        .qr-code-img {
            width: 150px;
            height: 40px;
            /* Add more styles if needed */
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>E-Ticket</h1>

        <div>
            <div class="card-title">Detail Tiket</div>
            <hr>
            <div class="card-title">{{ $dataTiket->first()->name }}</div>
            <div class="d-flex justify-content-between">
                <div class="d-flex flex-column">
                    <div class="card-title">Kode Tiket</div>
                    @php
                        $qrcodeFileName = pathinfo($dataTiket->first()->qrcode, PATHINFO_FILENAME);
                    @endphp
                    <div class="card-title"><b>{{ $qrcodeFileName }}</b></div>
                </div>
                <div class="d-flex flex-column">
                    <div class="card-title">
                        <img src="data:image/png;base64, {{ base64_encode(file_get_contents('assets/img/qrcode/' . $dataTiket->first()->qrcode)) }}"
                            alt="QR Code" class="qr-code-img">
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
                    <div class="card-title">{{ $dataTiket->first()->nama_konser }}</div>
                    <div class="card-title">{{ $dataTiket->first()->name }}</div>
                    <div class="card-title">{{ $dataTiket->first()->qty }}</div>
                    <div class="card-title">Rp. {{ number_format($dataTiket->first()->total, 2, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
