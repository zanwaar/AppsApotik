@extends('layouts.app')

@section('title', 'Dashboard')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/owl.carousel/dist/assets/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/owl.carousel/dist/assets/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/flag-icon-css/css/flag-icon.min.css') }}">
@endpush

@section('main')
<!-- Main Content -->
<div class="px-4 pt-5">
    <section class="section pt-5">
        <div class="row">
            <a href="transaksi" class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-archive"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Transaksi Obat</h4>
                        </div>
                        <div class="card-body">
                            Transaksi Obat
                        </div>
                    </div>
                </div>
            </a>
            <a href="obat" class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Data Obat</h4>
                        </div>
                        <div class="card-body">
                            Data OBat
                        </div>
                    </div>
                </div>
            </a>
            <a href="laporan" class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>laporan</h4>
                        </div>
                        <div class="card-body">
                            Laporan
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Transaksi Keluar / Penjualn Obat</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="keluarChart" height="150"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <!-- <div class="card gradient-bottom">
                    <div class="card-header">
                        <h4>Top 5 Products</h4>
                        <div class="card-header-action dropdown">
                            <a href="#" data-toggle="dropdown" class="btn btn-danger dropdown-toggle">Month</a>
                            <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <li class="dropdown-title">Select Period</li>
                                <li><a href="#" class="dropdown-item">Today</a></li>
                                <li><a href="#" class="dropdown-item">Week</a></li>
                                <li><a href="#" class="dropdown-item active">Month</a></li>
                                <li><a href="#" class="dropdown-item">This Year</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                            <table class="table-striped table">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama Obat</th>
                                        <th>Total Penjualan</th>
                                    </tr>
                                </thead>
                                <tbody id="topSellingDrugsTable">
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex justify-content-center pt-3">
                            <div class="budget-price justify-content-center">
                                <div class="budget-price-square bg-primary" data-width="20"></div>
                                <div class="budget-price-label">Selling Price</div>
                            </div>
                            <div class="budget-price justify-content-center">
                                <div class="budget-price-square bg-danger" data-width="20"></div>
                                <div class="budget-price-label">Budget Price</div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <livewire:grafik />
            </div>
    </section>
</div>
@endsection

@push('scripts')

<script src="{{ asset('library/chart.js/dist/Chart.js') }}"></script>

<script>
    function addCommas(nStr) {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        let rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }
    document.addEventListener('DOMContentLoaded', function() {
        fetch('/keluar-chart-data')
            .then(response => response.json())
            .then(data => {
                const dates = Object.keys(data);
                const values = Object.values(data);
                console.log(data);
                console.log(values);
                const ctx = document.getElementById('keluarChart').getContext('2d');
                const keluarChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: dates,
                        datasets: [{
                            label: 'Garfik Penjualn Per Hari',
                            data: values,
                            backgroundColor: "rgba(143,199,232,0.2)",
                            borderColor: "rgba(108,108,108,1)",
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                gridLines: {
                                    color: "#ECECEC",
                                },
                                ticks: {
                                    fontSize: 14,
                                    callback: function(value, index, values) {
                                        return addCommas(value); //! panggil function addComas tadi disini
                                    }
                                }
                            }]
                        }

                    }
                });
            });

    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('/top-selling-drugs')
            .then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById('topSellingDrugsTable');
                data.forEach(drug => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                            <td>${drug.kode}</td>
                            <td>${drug.nama_obat}</td>
                            <td>${drug.total_quantity}</td>
                        `;
                    tableBody.appendChild(row);
                });
            });
    });
</script>
@endpush