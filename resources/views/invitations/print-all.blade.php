<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Print Barcodes - {{ ucfirst($side) }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap');

        body {
            font-family: 'DM Serif Display', serif;
            margin: 6mm;
            -webkit-print-color-adjust: exact;
        }

        .page {
            /* each page will break after */
            margin-bottom: 6mm;
        }

        .grid {
            display: grid;
            gap: 8px;
            /* default 4 columns (adjust via per-page / css) */
            grid-template-columns: repeat(4, 1fr);
        }

        .card {
            border: 2px solid #641b0f;
            padding: 10px;
            border-radius: 8px;
            text-align: center;
            background: #fff;
            box-sizing: border-box;
            min-height: 110px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .name {
            font-size: 0.95rem;
            margin-bottom: 6px;
            font-weight: 700;
            color: #222;
        }

        .barcode {
            margin: 4px 0;
        }

        .note {
            font-size: 0.75rem;
            color: #444;
            margin-top: 6px;
        }

        /* Avoid breaking a card across pages */
        .card {
            page-break-inside: avoid;
            -webkit-page-break-inside: avoid;
            break-inside: avoid;
        }

        /* Force page breaks between .page containers */
        .page {
            page-break-after: always;
        }

        /* Print tweaks */
        @media print {
            body {
                margin: 4mm;
            }

            .grid {
                gap: 6px;
            }
        }

        /* Responsive: smaller screens show fewer columns */
        @media (max-width: 900px) {
            .grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 600px) {
            .grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>

<body>
    <div style="text-align:center; margin-bottom:10px;">
        <h3>Barcodes for: <span style="text-transform:capitalize;">{{ $side }}</span></h3>
        <div>
            <small>Total invitations: {{ $invitations->count() }} |
                Copies / invitation: {{ $copies }} |
                Barcode size param: {{ $size }} |
                Cards per page: {{ $perPage }}
            </small>
        </div>
    </div>

    {{-- chunk invitations into pages so printing isn't a single infinite page --}}
    @php
    $chunks = $invitations->chunk($perPage);
    @endphp

    @foreach($chunks as $pageInvitations)
    <div class="page">
        <div class="grid">
            @foreach($pageInvitations as $inv)
            {{-- produce $copies cards for each invitation if requested --}}
            @for($c = 0; $c < $copies; $c++) <div class="card">
                <div class="name">{{ $inv->name }}</div>

                <div class="barcode" aria-hidden="true">
                    {!! Milon\Barcode\Facades\DNS2DFacade::getBarcodeSVG($inv->code, 'QRCODE', $size, $size) !!}
                </div>

                <div class="note"><small>Tunjukkan barcode ini untuk masuk acara.</small></div>
        </div>
        @endfor
        @endforeach
    </div>
    </div>
    @endforeach

    <script>
        // auto print after small delay so SVGs render
        window.addEventListener('load', function() {
            setTimeout(function(){ window.print(); }, 250);
        });
    </script>
</body>

</html>