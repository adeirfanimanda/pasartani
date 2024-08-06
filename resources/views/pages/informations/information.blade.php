@extends('layouts.app')

@section('title')
    PasarTani
@endsection

@section('content')
    <!-- Page Content -->
    <div class="page-content page-home">
        <section class="store-trend-categories">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>Semua Informasi Panen</h5>
                    </div>
                </div>
                <div class="row">
                    @foreach ($informations as $information)
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card border-primary rounded-lg shadow-sm">
                                <div class="card-body">
                                    <h6 class="card-title">{{ $information->user->store_name }}</h6>
                                    <p class="card-text"><strong>Nama Produk:</strong> {{ $information->name }}</p>
                                    <p class="card-text"><strong>Kategori:</strong> {{ $information->category->name }}
                                    </p>
                                    <p class="card-text"><strong>Waktu Tanam:</strong>
                                        @php
                                            $date_tanam = \Carbon\Carbon::parse($information->date_tanam);
                                        @endphp
                                        {{ $date_tanam->locale('id')->isoFormat('D MMMM YYYY') }}
                                    </p>
                                    <p class="card-text"><strong>Estimasi Panen:</strong>
                                        @php
                                            $date_panen = \Carbon\Carbon::parse($information->date_panen);
                                        @endphp
                                        {{ $date_panen->locale('id')->isoFormat('D MMMM YYYY') }}
                                    </p>
                                    <p class="card-text"><strong>Countdown:</strong>
                                        <span id="countdown-{{ $information->id }}"
                                            data-target-date="{{ $date_panen }}"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection

@push('addon-script')
    <script>
        function updateCountdown(targetDate, elementId) {
            const countDownDate = new Date(targetDate).getTime();
            const countdownElement = document.getElementById(elementId);

            const interval = setInterval(function() {
                const now = new Date().getTime();
                const distance = countDownDate - now;

                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                countdownElement.innerHTML = `${days} hari ${hours} jam ${minutes} menit ${seconds} detik`;

                if (distance < 0) {
                    clearInterval(interval);
                    countdownElement.innerHTML = "Waktu Habis";
                }
            }, 1000);
        }

        document.addEventListener("DOMContentLoaded", function() {
            const countdownElements = document.querySelectorAll('[id^="countdown-"]');
            countdownElements.forEach(function(element) {
                const targetDate = element.dataset.targetDate;
                updateCountdown(targetDate, element.id);
            });
        });
    </script>
@endpush
