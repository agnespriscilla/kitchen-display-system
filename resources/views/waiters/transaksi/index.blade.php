@extends('waiters.template')

@section('content')
    {{-- HEADER HALAMAN --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Daftar Transaksi</h4>

        <a href="{{ route('waiters.transaksi.create') }}" class="btn btn-primary">
            + Tambah Transaksi
        </a>
    </div>





    <div class="row">
        @forelse ($transaksi as $value)
            @php
                $created = $value->created_at;
                $diffMinutes = $created->diffInMinutes(now());

                if ($diffMinutes < 10) {
                    $headerColor = 'bg-success';
                } elseif ($diffMinutes <= 15) {
                    $headerColor = 'bg-warning';
                } else {
                    $headerColor = 'bg-danger';
                }
            @endphp

            <div class="col-4 mb-4">
                <div class="card shadow">

                    {{-- CARD HEADER --}}
                    <div class="card-header text-white {{ $headerColor }} d-flex justify-content-between align-items-start">
                        <div>
                            <strong style="font-size: 1.1rem;">{{ $value->bagian->namabagian ?? '-' }}</strong><br>
                            <small style="font-size: 0.85rem;">
                                {{ $created->format('d M Y H:i') }}
                                {{ $created->locale('id')->diffForHumans() }}
                            </small>
                        </div>

                        {{-- DROPDOWN MENU --}}
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="dropdownMenu{{ $value->id }}"
                                data-bs-toggle="dropdown" aria-expanded="false" style="padding: 2px 8px;">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenu{{ $value->id }}">
                                <li>
                                    <a class="dropdown-item" href="{{ route('waiters.transaksidetail', $value->id) }}">
                                        <i class="fas fa-info-circle"></i> Detail Transaksi
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>

                    {{-- CARD BODY --}}
                    <div class="card-body">
                        <h5 class="mb-3" style="font-size: 1.3rem; font-weight: bold;">Menu Pesanan Order</h5>

                        <div style="max-height: 200px; overflow-y: auto;" class="mb-3">
                            <table class="table table-sm table-bordered mb-0">
                                <thead class="table-light sticky-top">
                                    <tr style="font-size: 0.95rem;">
                                        <th>Produk</th>
                                        <th width="50">Qty</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 0.9rem;">
                                    @foreach ($value->transaksidetail as $detail)
                                        <tr>
                                            <td style="font-size: 1.2rem;">{{ $detail->produk->nama ?? '-' }}</td>
                                            <td class="text-center">{{ $detail->jumlah }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>



                        @if($value->catatan)
                            <div class="alert alert-info mb-3" style="font-size: 2.5rem;">
                                <strong>Catatan:</strong><br>
                                {{ $value->catatan }}
                            </div>
                        @endif

                        <form action="{{ route('waiters.transaksidestroy', $value->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100" style="font-size: 1rem;">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        @empty
            {{-- JIKA DATA KOSONG --}}
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle"></i>
                    <strong>Belum ada transaksi.</strong><br>
                    Silakan klik <b>Tambah Transaksi</b> untuk membuat transaksi baru.
                </div>
            </div>
        @endforelse
    </div>



    {{-- PAGINATION --}}
    <div class="d-flex justify-content-center">
        {{ $transaksi->links('vendor.pagination.bootstrap-4') }}
    </div>
@endsection