<div>
    <div class="px-4 pt-5">
        <section class="section pt-5">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{route('transaksi')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Order Detail</h1>

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Orders</a></div>
                    <div class="breadcrumb-item">Order Detail</div>
                </div>
            </div>

            <div class="section-body">
                <div class="invoice  bg-secodary">
                    <div class="invoice-print">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="invoice-title">
                                    <h2>Invoice</h2>
                                    <div class="invoice-number">{{$transaksi->invoice}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- <address>
                                            <strong>Payment Method:</strong><br>
                                            Visa ending **** 4242<br>
                                            ujang@maman.com
                                        </address> -->
                                    </div>
                                    <div class="col-md-6 text-md-right">
                                        <address>
                                            <strong>Tanggal Transaksi:</strong><br>
                                            {{date("j F, Y", strtotime($transaksi->tanggal))}}<br><br>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="">List Transaksi {{$transaksi->status}}</h3>
                                <div class="table-responsive">
                                    <table class="table-striped table-hover table-md table">
                                        <tr class="bg-{{ $transaksi->status_badge }} text-white">
                                            <th data-width="5%">#</th>
                                            <th data-width="20%">Item</th>
                                            <th data-width="20%">Harga Beli</th>
                                            <th data-width="20%">Harga Jual</th>
                                            <th data-width="10%" class="text-center">Quantity</th>
                                            <th data-width="20%">Totals</th>
                                        </tr>
                                        @foreach ($detail as $index => $dt )
                                        <tr>
                                            <td>{{$index + 1}}</td>
                                            <td>{{$dt->obat->nama_obat}}</td>
                                            <td>Rp. {{number_format($dt->obat->harga_beli, 0, ',', '.')}}</td>
                                            <td>Rp. {{number_format($dt->obat->harga_jual, 0, ',', '.')}}</td>
                                            <td class="text-center">{{ $dt->quantity }}</td>
                                            <td>Rp. {{number_format($dt->total_price, 0, ',', '.')}}</td>
                                        </tr>
                                        @endforeach

                                    </table>
                                </div>
                                <div class="row ">
                                    <div class="col-lg-8">

                                    </div>
                                    <div class="col-lg-4 text-right">
                                        <hr class="mt-2 mb-2">
                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-name">Total</div>
                                            <div class="invoice-detail-value invoice-detail-value-lg">Rp. {{number_format($transaksi->total_price, 0, ',', '.')}}</div>
                                        </div>
                                        <!-- <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
</div>