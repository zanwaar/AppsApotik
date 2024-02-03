@extends('layouts.app')

@section('title', 'Data Obat')

@push('style')
@endpush

@section('main')
<div class="px-4 pt-5">
    <section class="section pt-5">
        <div class="section-header">
            <div class="section-header-back">
                <a href="/" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Data Obat</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/">Home</a></div>
                <div class="breadcrumb-item">Data Obat</div>
            </div>
        </div>

    </section>
    <livewire:list-obat />

</div>
@endsection
@push('scripts')

@endpush