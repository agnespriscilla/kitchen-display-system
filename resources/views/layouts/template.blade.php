<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="{{ $website->keyword }}" name="keywords">
    <meta content="{{ $website->deskripsi }}" name="description">

    <link rel="canonical" href="{{ request()->url() }}">

    <meta property="og:title" content="{{ $title }}" />
    <meta property="og:description" content="{{ $website->deskripsi }}" />
    <meta property="og:url" content="{{ request()->fullUrl() }}" />

    @if ($active == 'katalog' && isset($foto))
        <meta property="og:type" content="article" />
        <meta property="og:image" content="{{ asset('uploads/produk/' . $foto) }}" />
    @else
        <meta property="og:type" content="website" />
        <meta property="og:image" content="{{ asset('img/' . $website->icon) }}" />
    @endif

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('img/' . $website->icon) }}">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Red+Rose:wght@600;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('home-assets') }}/lib/animate/animate.min.css" rel="stylesheet">
    <link href="{{ asset('home-assets') }}/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('home-assets') }}/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('home-assets') }}/css/style.css" rel="stylesheet">

    {{-- Sweet Alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<style type="text/css">
    .table-responsive::-webkit-scrollbar {
        display: none;
    }

    .map-container {
        position: relative;
        padding-bottom: 56.25%;
        /* Rasio 16:9 */
        height: 0;
        overflow: hidden;
    }

    .map-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }

    .truncate {
        display: -webkit-box;
        --webkit-line-clamp: 7;
        /* jumlah baris */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .produk-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        object-position: center;
    }
</style>

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->

    <!-- Topbar Start -->
    <div class="container-fluid py-2 d-none d-lg-flex">
        <div class="container">
            <div class="d-flex justify-content-between">
                <div>
                    <small class="me-3"><i class="fa fa-map-marker-alt me-2"></i>{{ $website->alamat }}</small>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Brand Start -->
    <div class="container-fluid bg-primary text-white pt-4 pb-5 d-none d-lg-flex">
        <div class="container pb-2">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex">
                    <i class="bi bi-telephone-inbound fs-2"></i>
                    <div class="ms-3">
                        <h5 class="text-white mb-0">Call Now</h5>
                        <span>{{ $website->telepon }}</span>
                    </div>
                </div>
                <a href="{{ url('/') }}" class="h1 text-white mb-0">{{ $website->nama }}</span></a>
                <div class="d-flex">
                    <i class="bi bi-envelope fs-2"></i>
                    <div class="ms-3">
                        <h5 class="text-white mb-0">Mail Now</h5>
                        <span>{{ $website->email }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Brand End -->

    <!-- Navbar Start -->
    <div class="container-fluid sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-white py-2 px-3 position-relative">
                <!-- Brand -->
                <a href="{{ url('/') }}" class="navbar-brand d-lg-none">
                    <h1 class="text-primary m-0">{{ $website->nama }}</h1>
                </a>

                <!-- Navbar Toggler & Cart Mobile -->
                <div class="d-flex align-items-center ms-auto ms-lg-0">
                    <!-- Cart Mobile -->
                    <a class="btn btn-sm-square btn-primary d-lg-none position-relative me-2 cart-toggle"
                        style="width: 40px; height: 40px;" href="javascript:void(0);">
                        <i class="bi bi-cart"></i>
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger d-flex align-items-center justify-content-center p-0"
                            style="min-width: 18px; height: 18px; font-size: 0.75rem; line-height: 1;"
                            id="cart-count">0</span>
                    </a>

                    <!-- Navbar Toggle -->
                    <button type="button" class="navbar-toggler" data-bs-toggle="collapse"
                        data-bs-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>

                <!-- Navbar Menu -->
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav">
                        <a href="{{ url('/') }}"
                            class="nav-item nav-link {{ $active == 'home' ? 'active' : '' }}">Home</a>
                        <a href="{{ url('/tentang') }}"
                            class="nav-item nav-link {{ $active == 'tentang' ? 'active' : '' }}">Tentang</a>
                        <a href="{{ url('/produk') }}"
                            class="nav-item nav-link {{ $active == 'katalog' ? 'active' : '' }}">Menu</a>
                        <a href="{{ url('/meja') }}"
                            class="nav-item nav-link {{ $active == 'meja' ? 'active' : '' }}">Scan Meja</a>
                        <a href="{{ url('/riwayat') }}"
                            class="nav-item nav-link {{ $active == 'riwayat' ? 'active' : '' }}">Riwayat</a>
                        <a href="{{ url('/kontak') }}"
                            class="nav-item nav-link {{ $active == 'kontak' ? 'active' : '' }}">Kontak</a>
                    </div>

                    <!-- Keranjang Desktop -->
                    <div class="ms-auto d-none d-lg-flex position-relative">
                        <a class="btn btn-sm-square btn-primary ms-2 fs-4 position-relative cart-toggle"
                            style="width: 40px; height: 40px;" href="javascript:void(0);">
                            <i class="bi bi-cart"></i>
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger d-flex align-items-center justify-content-center p-0"
                                style="min-width: 18px; height: 18px; font-size: 0.75rem; line-height: 1;"
                                id="cart-count">0</span>
                        </a>
                    </div>
                </div>

                <!-- Mini Cart Dropdown -->
                <div id="mini-cart" class="position-absolute bg-white shadow rounded p-3"
                    style="top: 100%; right: 0; width: 300px; display: none; z-index: 999;">
                    <div id="mini-cart-items"></div>
                    <hr>

                    <a href="{{ url('/cart') }}" class="btn btn-primary w-100 mt-3">Checkout</a>
                </div>
            </nav>
        </div>
    </div>


    <!-- Navbar End -->


    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                showConfirmButton: true,
            });
        </script>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                showConfirmButton: true,
            });
        </script>
    @endif


    @yield('content')



    <!-- Footer Start -->
    <div class="container-fluid footer position-relative py-5 wow fadeIn" data-wow-delay="0.1s"
        style="background-color: #0b0b0b; color: #ffffff;">
        <div class="container">
            <div class="row g-5 py-5">
                <div class="col-lg-6 pe-lg-5">
                    <a href="index.html" class="navbar-brand">
                        <h1 class="h1 mb-0 text-white">{{ $website->nama }}</h1>
                    </a>

                    <p class="fs-5 mb-4 text-white">{{ $website->deskripsi }}</p>

                    <div class="row">
                        <div class="col-md-6">
                            <p class="text-white"><i class="fa fa-map-marker-alt me-2"></i>{{ $website->alamat }}</p>
                            <p class="text-white"><i class="fa fa-phone-alt me-2"></i>{{ $website->telepon }}</p>
                            <p class="text-white"><i class="fa fa-envelope me-2"></i>{{ $website->alamat }}</p>
                        </div>

                        <div class="col-md-6 text-white">
                            <span>{!! $website->jambuka !!}</span>
                        </div>
                    </div>

                    <div class="d-flex mt-4">

                        @if (!empty($website->facebook))
                            <a class="btn btn-outline-light btn-social" href="{{ $website->facebook }}" target="_blank">
                                <img src="{{ asset('img/fb.png') }}" alt="Facebook" height="25">
                            </a>
                        @endif

                        @if (!empty($website->instagram))
                            <a class="btn btn-outline-light btn-social" href="{{ $website->instagram }}" target="_blank">
                                <img src="{{ asset('img/ig.webp') }}" alt="Instagram" height="25">
                            </a>
                        @endif

                        @if (!empty($website->shopee))
                            <a class="btn btn-outline-light btn-social" href="{{ $website->shopee }}" target="_blank">
                                <img src="{{ asset('img/shopee.png') }}" alt="Shopee" height="25">
                            </a>
                        @endif

                        @if (!empty($website->tokped))
                            <a class="btn btn-outline-light btn-social" href="{{ $website->tokped }}" target="_blank">
                                <img src="{{ asset('img/tokopedia.png') }}" alt="Tokopedia" height="25">
                            </a>
                        @endif
                    </div>

                </div>

                <div class="col-lg-6 ps-lg-5">
                    <h4 class="mb-4 text-white">Maps</h4>
                    <div class="map-container">{!! $website->gmaps !!}</div>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-primary text-white-50 py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">&copy; <a href="#">{{ $website->nama }}</a>. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    {{-- <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a> --}}

    <!-- WA ICON -->
    <a href="https://wa.me/{{ $website->wa }}" class="position-fixed" style="bottom: 30px; right: 30px;"
        title="Hubungi Admin" target="_blank"><img src="{{ asset('img/wa.png') }}" alt="Icon WA" width="50px"
            height="50px"></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('home-assets') }}/lib/wow/wow.min.js"></script>
    <script src="{{ asset('home-assets') }}/lib/easing/easing.min.js"></script>
    <script src="{{ asset('home-assets') }}/lib/waypoints/waypoints.min.js"></script>
    <script src="{{ asset('home-assets') }}/lib/counterup/counterup.min.js"></script>
    <script src="{{ asset('home-assets') }}/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('home-assets') }}/js/main.js"></script>

    <script>
        function getCart() {
            return JSON.parse(localStorage.getItem('cart')) || [];
        }

        function saveCart(cart) {
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
            renderMiniCart();
        }

        function updateCartCount() {
            let cart = getCart();
            let totalQty = cart.reduce((sum, item) => sum + item.qty, 0);
            document.getElementById('cart-count').textContent = totalQty;
        }

        function renderMiniCart() {
            let cart = getCart();
            let container = document.getElementById('mini-cart-items');


            container.innerHTML = cart.length === 0 ?
                '<p class="text-muted text-center mb-0">Keranjang kosong</p>' :
                '';

            cart.forEach(item => {
                container.innerHTML += `
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div>
                        <div class="fw-bold">${item.nama}</div>
                        <div class="text-muted">${item.kategori}</div>
                        <small>Qty: ${item.qty}</small>
                    </div>
                </div>
            `;
            });


        }

        // Event tombol tambah ke keranjang
        document.querySelectorAll('.add-to-cart').forEach(btn => {
            btn.addEventListener('click', function () {
                let cart = getCart();
                let id = this.dataset.id;
                let nama = this.dataset.nama;
                let kategori = this.dataset.kategori;

                let foto = this.dataset.foto;

                let existing = cart.find(item => item.id == id);
                if (existing) {
                    existing.qty += 1;
                } else {
                    cart.push({
                        id,
                        nama,
                        kategori,
                        qty: 1
                    });
                }

                saveCart(cart);
            });
        });

        // Hover event untuk menampilkan mini-cart
        const cartToggle = document.querySelectorAll('.cart-toggle');
        const miniCart = document.getElementById('mini-cart');

        cartToggle.forEach(btn => {
            // Toggle mini-cart saat klik
            btn.addEventListener('click', () => {
                renderMiniCart();
                if (miniCart.style.display === 'block') {
                    miniCart.style.display = 'none';
                } else {
                    miniCart.style.display = 'block';
                }
            });

            // Untuk desktop: hover tetap bisa muncul
            btn.addEventListener('mouseenter', () => {
                if (window.innerWidth >= 992) { // desktop
                    renderMiniCart();
                    miniCart.style.display = 'block';
                }
            });
        });

        miniCart.addEventListener('mouseleave', () => {
            miniCart.style.display = 'none';
        });

        miniCart.addEventListener('mouseenter', () => {
            miniCart.style.display = 'block';
        });


        // Init saat load
        document.addEventListener('DOMContentLoaded', () => {
            updateCartCount();
            renderMiniCart();
        });
    </script>

    @yield('scripts')
    @stack('scripts')


</body>

</html>