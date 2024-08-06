@extends('layouts.dashboard')

@section('title')
    Tambah Informasi Baru
@endsection

@section('content')
    <!-- Section Content -->
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Tambah Informasi</h2>
                <p class="dashboard-subtitle">
                    Tambah informasi baru Anda
                </p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('informations.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nama Produk</label>
                                                <input type="text" class="form-control" name="name" required />
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Kategori</label>
                                                <select name="categories_id" class="form-control">
                                                    @foreach ($categories as $categories)
                                                        <option value="{{ $categories->id }}">{{ $categories->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Kategori</label>
                                                <select name="category_id" class="form-control" required>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="date_tanam" class="form-label">Tanggal Tanam</label>
                                                <input type="date" class="form-control" id="date_tanam" name="date_tanam"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="date_panen" class="form-label">Estimasi Tanggal Panen</label>
                                                <input type="date" class="form-control" id="date_panen" name="date_panen"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-right">
                                            <button type="submit" class="btn btn-success px-5">
                                                Simpan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace("editor");
    </script>
@endpush
