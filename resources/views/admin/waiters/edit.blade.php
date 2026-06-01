@extends('admin.template')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="white-box">
                <h4 class="mb-3">Edit Waiters</h4>

                <form action="{{ route('admin.waiters.update', $waiter->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control" value="{{ $waiter->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $waiter->email }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" value="{{ $waiter->username }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Password <small class="text-muted">(Kosongkan jika tidak diubah)</small></label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Bagian</label>
                        <select name="bagian_id" class="form-control" required>
                            <option value="">-- Pilih Bagian --</option>
                            @foreach ($bagian as $b)
                                <option value="{{ $b->id }}" {{ $waiter->bagian_id == $b->id ? 'selected' : '' }}>
                                    {{ $b->namabagian }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.waiters.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>

                        <button type="submit" class="btn btn-success">
                            Update
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
@endsection
