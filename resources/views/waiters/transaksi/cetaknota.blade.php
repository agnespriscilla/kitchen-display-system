<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Cetak Nota</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .nota {
            width: 300px;
            margin: auto;
        }

        .center {
            text-align: center;
        }

        .line {
            border-top: 1px dashed #000;
            margin: 8px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 3px 0;
            vertical-align: top;
        }

        .right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }

        @media print {
            button {
                display: none;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <div class="nota">

        {{-- HEADER --}}
        <div class="center">
            <h3>{{ $website->nama }}</h3>
            <small>{{ $transaksi->bagian->namabagian }}</small><br>
            <small>{{ now()->format('d M Y H:i') }}</small>
        </div>

        <div class="line"></div>

        {{-- INFO TRANSAKSI --}}
        <table>
            <tr>
                <td>No Nota</td>
                <td class="right">#{{ $transaksi->id }}</td>
            </tr>
            <tr>
                <td>Kasir</td>
                <td class="right">{{ $user->name }}</td>
            </tr>
        </table>

        <div class="line"></div>

        {{-- DETAIL PRODUK --}}
        <table>
            @foreach ($transaksi->transaksidetail as $item)
                <tr>
                    <td colspan="2" class="bold">
                        {{ $item->produk->nama }}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{ $item->jumlah }} pcs
                    </td>
                    <td class="right">
                    </td>
                </tr>
            @endforeach
        </table>

        <div class="line"></div>

        {{-- TOTAL --}}
        <table>
            {{-- Status removed --}}
        </table>

        @if ($transaksi->catatan)
            <div class="line"></div>
            <small><strong>Catatan:</strong></small><br>
            <small>{{ $transaksi->catatan }}</small>
        @endif

        <div class="line"></div>

        {{-- FOOTER --}}
        <div class="center">
            <p>Terima Kasih 🙏</p>
            <small>Barang yang sudah dibeli<br>tidak dapat dikembalikan</small>
        </div>

        <div class="center">
            <button onclick="window.print()">Cetak</button>
        </div>

    </div>

</body>

</html>