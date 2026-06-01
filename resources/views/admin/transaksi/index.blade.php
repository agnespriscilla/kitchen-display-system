@extends('admin.template')

@section('content')
    <div class="container-fluid p-0">
        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0 text-dark">Daftar Transaksi</h4>
            <a href="{{ route('admin.transaksi.create') }}" class="btn btn-primary">
                + Tambah Transaksi
            </a>
        </div>

        {{-- TABS --}}
        <ul class="nav nav-tabs mb-4 border-bottom-0">
            <li class="nav-item">
                <a class="nav-link {{ empty($bagianAktif) ? 'active text-primary border-bottom border-primary' : 'text-muted' }}"
                    href="{{ route('admin.transaksi') }}"
                    style="{{ empty($bagianAktif) ? 'border-bottom-width: 3px !important; font-weight: 500;' : '' }}">
                    Semua
                </a>
            </li>
            @foreach ($bagian as $b)
                <li class="nav-item">
                    <a class="nav-link {{ $bagianAktif == $b->id ? 'active text-primary border-bottom border-primary' : 'text-muted' }}"
                        href="{{ route('admin.transaksi', ['bagian_id' => $b->id]) }}"
                        style="{{ $bagianAktif == $b->id ? 'border-bottom-width: 3px !important; font-weight: 500;' : '' }}">
                        {{ $b->namabagian }}
                    </a>
                </li>
            @endforeach
        </ul>

        {{-- TRANSACTION CARDS --}}
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
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm border-0 h-100">
                        {{-- CARD HEADER --}}
                        <div
                            class="card-header {{ $headerColor }} text-white d-flex justify-content-between align-items-start p-3">
                            <div>
                                <h6 class="mb-1 fw-bold">{{ $value->bagian->namabagian ?? 'Salah Jurusan' }}</h6>
                                <small style="font-size: 0.8rem;">
                                    {{ $value->created_at->format('d M Y H:i') }}
                                    {{ $value->created_at->locale('id')->diffForHumans() }}
                                </small>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-link text-white p-0" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.transaksidetail', $value->id) }}">
                                            Detail
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        {{-- CARD BODY --}}
                        <div class="card-body p-3">
                            <h6 class="fw-bold mb-3">Menu Pesanan Order</h6>

                            {{-- ORDER LIST --}}
                            <div class="table-responsive mb-3">
                                <table class="table table-borderless table-sm mb-0">
                                    <thead class="text-muted border-bottom">
                                        <tr>
                                            <th class="ps-0 fw-normal">Produk</th>
                                            <th class="pe-0 fw-normal text-end" width="50">Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($value->transaksidetail as $detail)
                                            <tr>
                                                <td class="ps-0 py-2">{{ $detail->produk->nama ?? '-' }}</td>
                                                <td class="pe-0 py-2 text-end">{{ $detail->jumlah }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- NOTES --}}
                            @if($value->catatan)
                                <div class="p-2 mb-3 rounded" style="background-color: #d1ecf1; color: #0c5460;">
                                    <span class="fw-bold d-block">Catatan:</span>
                                    <span>{{ $value->catatan }}</span>
                                </div>
                            @else
                                <div class="mb-3"></div>
                            @endif

                            {{-- DELETE BUTTON --}}
                            <div class="mt-auto">
                                <form action="{{ route('admin.transaksidestroy', $value->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-100 text-white">
                                        <i class="fas fa-trash-alt me-1"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        Belum ada transaksi.
                    </div>
                </div>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $transaksi->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>

    <style>
        .nav-tabs .nav-link {
            border: none;
            color: #6c757d;
            padding-bottom: 10px;
        }

        .nav-tabs .nav-link:hover {
            border: none;
            color: #0d6efd;
        }

        .nav-tabs .nav-link.active {
            color: #0d6efd;
            background: transparent;
        }
    </style>
@endsection