@extends('layouts.app')

@section('title', 'Transaksi')

@push('style')
<!-- CSS Libraries -->
@endpush

@section('main')
<div class="px-4 pt-5">
    <section class="section pt-5">
        <div class="section-header">
            <div class="section-header-back">
                <a href="/" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Data Transaksi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/">Home</a></div>
                <div class="breadcrumb-item">Transaksi</div>
            </div>
        </div>
    </section>
    <livewire:transaksi />
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/components-table.js') }}"></script>
@endpush