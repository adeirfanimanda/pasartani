@extends('layouts.dashboard')

@section('title')
    Daftar Panen
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Informasi Saya</h2>
                <p class="dashboard-subtitle">
                    Kelola informasi tanam dan panen hasil pertanian Anda
                </p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('informations.create') }}" class="btn btn-success">Tambah Informasi Baru</a>
                    </div>
                </div>
                <div class="row mt-4">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Tanggal Tanam</th>
                                <th>Tanggal Panen</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($informations as $information)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td width="30%">{{ $information->name }}</td>
                                    <td width="20%">{{ $information->category->name }}</td>
                                    <td>
                                        @php
                                            $date_tanam = \Carbon\Carbon::parse($information->date_tanam);
                                        @endphp
                                        {{ $date_tanam->locale('id')->isoFormat('D MMMM YYYY') }}
                                    </td>
                                    <td>
                                        @php
                                            $date_panen = \Carbon\Carbon::parse($information->date_panen);
                                        @endphp
                                        {{ $date_panen->locale('id')->isoFormat('D MMMM YYYY') }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('informations.edit', $information->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('informations.destroy', $information->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="container">
        <h1>Daftar Panen</h1>
        <a href="{{ route('informations.create') }}" class="btn btn-primary mb-3">Tambah Panen</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Tanggal Tanam</th>
                    <th>Tanggal Panen</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($informations as $information)
                    <tr>
                        <td>{{ $information->name }}</td>
                        <td>{{ $information->category->name }}</td>
                        <td>{{ $information->date_tanam->format('d-m-Y') }}</td>
                        <td>{{ $information->date_panen->format('d-m-Y') }}</td>
                        <td>
                            <a href="{{ route('informations.edit', $information->id) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('informations.destroy', $information->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> --}}
@endsection
