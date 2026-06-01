{{-- ================= HASIL PENCARIAN ================= --}}

<div class="search-wrapper">

    {{-- ================= MAKANAN ================= --}}
    @if ($makanan->count() > 0)
        <h2 class="mb-4">🍽 Makanan</h2>
        <div class="row g-4">
            @foreach ($makanan as $p)
                <div class="col-lg-3 col-md-6 produk-card">

                    <div class="service-item">
                        <div class="position-relative overflow-hidden mb-3">
                            <img class="img-fluid produk-img" src="{{ asset('uploads/produk/' . $p->foto) }}">
                        </div>

                        <h5 class="mb-3">{{ $p->nama }}</h5>
                        <span>{!! Str::limit($p->deskripsi, 100, '...') !!}</span>

                        <div class="mt-4">
                            <a class="btn btn-light px-3" href="{{ route('produk.detail', $p->slug) }}">
                                Detail <i class="bi bi-chevron-double-right ms-1"></i>
                            </a>

                            <button class="btn btn-primary px-3 add-to-cart" data-id="{{ $p->id }}" data-nama="{{ $p->nama }}"
                                data-kategori="{{ $p->kategori }}" data-foto="{{ asset('uploads/produk/' . $p->foto) }}">
                                <i class="bi bi-cart-plus"></i>
                            </button>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    @endif


    {{-- ================= MINUMAN ================= --}}
    @if ($minuman->count() > 0)
        <h2 class="mt-5 mb-4">🥤 Minuman</h2>
        <div class="row g-4">
            @foreach ($minuman as $p)
                <div class="col-lg-3 col-md-6 produk-card">

                    <div class="service-item">
                        <div class="position-relative overflow-hidden mb-3">
                            <img class="img-fluid produk-img" src="{{ asset('uploads/produk/' . $p->foto) }}">
                        </div>

                        <h5 class="mb-3">{{ $p->nama }}</h5>
                        <span>{!! Str::limit($p->deskripsi, 100, '...') !!}</span>

                        <div class="mt-4">
                            <a class="btn btn-light px-3" href="{{ route('produk.detail', $p->slug) }}">
                                Detail <i class="bi bi-chevron-double-right ms-1"></i>
                            </a>

                            <button class="btn btn-primary px-3 add-to-cart" data-id="{{ $p->id }}" data-nama="{{ $p->nama }}"
                                data-kategori="{{ $p->kategori }}" data-foto="{{ asset('uploads/produk/' . $p->foto) }}">
                                <i class="bi bi-cart-plus"></i>
                            </button>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    @endif


    {{-- ================= TIDAK ADA DATA ================= --}}
    @if ($makanan->count() == 0 && $minuman->count() == 0)
        <p class="text-center mt-4">Produk tidak ditemukan.</p>
    @endif

</div>