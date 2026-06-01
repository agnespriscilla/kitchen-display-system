@extends('superadmin.template')
@section('content')
    <div class="white-box">
        <div class="box-title mb-3">Pengaturan Website</div>

        <form action="{{ route('superadmin.website.update') }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Website</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $website->nama ?? '') }}"
                        required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Meta Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $website->deskripsi ?? '') }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Meta Keyword</label>
                    <input type="text" name="keyword" class="form-control"
                        value="{{ old('keyword', $website->keyword ?? '') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3">{{ old('alamat', $website->alamat ?? '') }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Telepon</label>
                    <input type="text" name="telepon" class="form-control"
                        value="{{ old('telepon', $website->telepon ?? '') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control"
                        value="{{ old('email', $website->email ?? '') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Facebook</label>
                    <input type="text" name="facebook" class="form-control"
                        value="{{ old('facebook', $website->facebook ?? '') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Instagram</label>
                    <input type="text" name="instagram" class="form-control"
                        value="{{ old('instagram', $website->instagram ?? '') }}">
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">WhatsApp</label>
                    <textarea type="text" name="wa" class="form-control" rows="3">{{ old('wa', $website->wa ?? '') }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Shopee</label>
                    <input type="text" name="shopee" class="form-control"
                        value="{{ old('shopee', $website->shopee ?? '') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Tokopedia</label>
                    <input type="text" name="tokped" class="form-control"
                        value="{{ old('tokped', $website->tokped ?? '') }}">
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Google Maps (Embed Link)</label>
                    <textarea name="gmaps" class="form-control" rows="4">{{ old('gmaps', $website->gmaps ?? '') }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Icon Website</label><br>
                    <input type="file" name="icon" class="form-control mb-3">
                    @if (!empty($website->icon))
                        <img src="{{ asset('img/' . $website->icon) }}" alt="Icon" width="50">
                    @endif
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Logo Website</label><br>
                    <input type="file" name="logo" class="form-control mb-3">
                    @if (!empty($website->logo))
                        <img src="{{ asset('img/' . $website->logo) }}" alt="Logo" width="100">
                    @endif
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">Jam Buka</label>
                    <textarea name="jambuka" class="form-control" rows="3">{{ old('jambuka', $website->jambuka ?? '') }}</textarea>
                    <script>
                        CKEDITOR.replace('jambuka');
                    </script>
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary float-end">Simpan Perubahan</button>
            </div>
        </form>
    </div>
@endsection
