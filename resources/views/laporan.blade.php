@extends('layouts.app')

@section('title', 'Laporan')

@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('main')
<div class="px-4 pt-5">
    <section class="section pt-5">
        <div class="section-header">
            <div class="section-header-back">
                <a href="/" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Laporan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/">Home</a></div>
                <div class="breadcrumb-item">Laporan</div>
            </div>
        </div>
        <livewire:laporan />

    </section>
</div>
@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr('#range_tanggal', {
        altInput: true,
        altFormat: "j F, Y",
        dateFormat: "Y-m-d",
    });
</script>
@endpush