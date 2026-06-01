<div class="row g-4">
    @foreach ($produk as $p)
        <div class="col-lg-3 col-md-6 produk-card" data-nama="{{ $p->nama }}" data-kategori="{{ $p->kategori }}">

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

<div class="mt-4">
    {{ $produk->onEachSide(1)->links('pagination::bootstrap-5', [
    'link_class' => 'ajax-pagination',
    'target' => $produk->first()->kategori == 'Makanan' ? 'list-makanan' : 'list-minuman',
]) }}
</div>