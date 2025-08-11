<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Print Barcode - {{ $invitation->name }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'DM Serif Display', serif;
            text-align: center;
            padding: 30px;
        }

        .card {
            border: 2px solid #641b0f;
            padding: 20px;
            display: inline-block;
            border-radius: 12px;
            background: white;
        }

        .name {
            font-size: 1.5rem;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .barcode {
            margin: 20px 0;
        }

        .note {
            font-size: 1rem;
            color: #444;
            margin-top: 15px;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .card {
                box-shadow: none;
                border: none;
            }
        }
    </style>
</head>

<body>

    <div class="card">
        <div class="name">{{ $invitation->name }}</div>

        <div class="barcode">
            {!! Milon\Barcode\Facades\DNS2DFacade::getBarcodeSVG($invitation->code, 'QRCODE', 5, 5) !!}
        </div>

        <div class="note">
            <strong>Tunjukkan barcode ini untuk memasuki acara pernikahan.</strong>
        </div>
    </div>

    <script>
        // Auto open print dialog
    window.print();
    </script>

</body>

</html>