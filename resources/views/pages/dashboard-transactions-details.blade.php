@extends('layouts.dashboard')

@section('title')
    Detail Transaksi
@endsection

@section('content')
    <!-- Section Content -->
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">#{{ $transaction->code }}</h2>
                <p class="dashboard-subtitle">
                    Detail Transaksi
                </p>
            </div>
            <div class="dashboard-content" id="transactionDetails">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <img src="{{ Storage::url($transaction->product->galleries->first()->photos ?? '') }}"
                                            class="w-100 mb-3" alt="" />
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Nama Pelanggan</div>
                                                <div class="product-subtitle">{{ $transaction->transaction->user->name }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Nama Produk</div>
                                                <div class="product-subtitle">
                                                    {{ $transaction->product->name }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">
                                                    Tanggal Transaksi
                                                </div>
                                                <div class="product-subtitle">
                                                    {{ $transaction->created_at->locale('id')->isoFormat('D MMMM YYYY | H:mm') }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Status Pembayaran</div>
                                                <div class="product-subtitle">
                                                    {{ $transaction->transaction->transaction_status }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">
                                                    Jumlah Total
                                                </div>
                                                <div class="product-subtitle">
                                                    Rp{{ number_format($transaction->transaction->total_price, 0, ',', '.') }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">
                                                    Nomor Telepon
                                                </div>
                                                <div class="product-subtitle">
                                                    {{ $transaction->transaction->user->phone_number }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('dashboard-transaction-update', $transaction->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 mt-4">
                                            <h5>Informasi Pengiriman</h5>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="product-title">Alamat Lengkap</div>
                                                    <div class="product-subtitle">
                                                        {{ $transaction->transaction->user->address_one }}
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="product-title">Patokan</div>
                                                    <div class="product-subtitle">
                                                        {{ $transaction->transaction->user->address_two }}
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="product-title">Provinsi</div>
                                                    <div class="product-subtitle">
                                                        {{ App\Models\Province::find($transaction->transaction->user->provinces_id)->name }}
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="product-title">Kota/Kabupaten</div>
                                                    <div class="product-subtitle">
                                                        {{ App\Models\Regency::find($transaction->transaction->user->regencies_id)->name }}
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="product-title">Kode Pos</div>
                                                    <div class="product-subtitle">
                                                        {{ $transaction->transaction->user->zip_code }}</div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="product-title">Negara</div>
                                                    <div class="product-subtitle">
                                                        {{ $transaction->transaction->user->country }}</div>
                                                </div>
                                                @auth
                                                    @if (Auth::user()->store_status == '1')
                                                        <div class="col-12 col-md-3">
                                                            <div class="product-title">Status Pesanan</div>
                                                            @if ($transaction->shipping_status === 'SELESAI')
                                                                <div class="product-subtitle">
                                                                    {{ $transaction->shipping_status }}
                                                                </div>
                                                            @else
                                                                <select name="shipping_status" id="status"
                                                                    class="form-control" v-model="status">
                                                                    <option value="PENDING">Pending</option>
                                                                    <option value="SHIPPING">Shipping</option>
                                                                    {{-- <option value="SUCCESS">Success</option> --}}
                                                                </select>
                                                            @endif
                                                        </div>
                                                    @else
                                                        <div class="col-12 col-md-3">
                                                            <div class="product-title">Status Pesanan</div>
                                                            <div class="product-subtitle">
                                                                {{ $transaction->shipping_status }}
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endauth
                                                @auth
                                                    @if (Auth::user()->store_status == '1')
                                                        <template v-if="status == 'SHIPPING'">
                                                            <div class="col-md-3">
                                                                <div class="product-title">Nomor Resi</div>
                                                                <input type="text" class="form-control" name="resi"
                                                                    v-model="resi" />
                                                            </div>
                                                            <div class="col-md-2">
                                                                <button type="submit" class="btn btn-success btn-block mt-4">
                                                                    Update Resi
                                                                </button>
                                                            </div>
                                                        </template>
                                                    @else
                                                        <template v-if="status == 'SHIPPING'">
                                                            <div class="col-md-3">
                                                                <div class="product-title">Nomor Resi</div>
                                                                <div class="product-subtitle">
                                                                    {{ $transaction->resi ?? 'Tidak tersedia' }}
                                                                </div>
                                                            </div>
                                                        </template>
                                                    @endif
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Tombol Konfirmasi Pesanan -->
                                    @auth
                                        @if (Auth::user()->store_status == '0' && $transaction->shipping_status === 'SHIPPING')
                                            <form action="{{ route('dashboard-transaction-confirm', $transaction->id) }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="shipping_status" value="SELESAI">
                                                <button type="submit" class="btn btn-success mt-4">Pesanan Selesai</button>
                                            </form>
                                        @endif
                                    @endauth
                                    @auth
                                        @if (Auth::user()->store_status == '1' && $transaction->shipping_status !== 'SELESAI')
                                            <div class="row mt-4">
                                                <div class="col-12 text-right">
                                                    <button type="submit" class="btn btn-success btn-lg mt-4">
                                                        Simpan
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    @endauth
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script>
        var transactionDetails = new Vue({
            el: "#transactionDetails",
            data: {
                status: "{{ $transaction->shipping_status }}",
                resi: "{{ $transaction->resi }}",
            },
        });
    </script>
@endpush
