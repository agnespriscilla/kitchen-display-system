@extends('admin.template')
@section('content')
    <h1>Selamat Datang, {{ $user->name }}</h1>

    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Produk</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <li>
                        <i class="fas fa-boxes-stacked text-primary fa-2x"></i>
                    </li>
                    <li class="ms-auto"><span class="counter text-primary">{{ $produk }}</span></li>
                </ul>
            </div>
        </div>
        {{-- <div class="col-lg-6 col-md-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Customer</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <li>
                        <i class="fas fa-users text-primary fa-2x"></i>
                    </li>
                    <li class="ms-auto"><span class="counter text-primary">{{ $customer }}</span></li>
                </ul>
            </div>
        </div> --}}
    </div>
@endsection
