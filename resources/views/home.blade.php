@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="">
                <div class="text-center h3">{{ __('METODE SIMPLE ADDITIVE WEIGHTING (SAW)') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h5 class="text-center">{{ __('Silahkan klik salah satu menu untuk mengelola') }}</h5>
                    <div class="text-center mt-4">
                        <h6>{{ __('Menu:') }}</p>
                        <p>1. Kriteria</p>
                        <p>2. Alternatif</p>
                        <p>3. Penilaian</p>
                        <p>4. Perhitungan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
