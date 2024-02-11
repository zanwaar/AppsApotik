<div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card card-statistic-2">
                    <div wire:click="addkeluar()" class="card-icon shadow-primary bg-primary" style="border-radius: 50%; cursor: pointer;">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Transaksi Keluar</h4>
                        </div>
                        <div class="card-body">
                            <a wire:click="filterStatus('Keluar')" style="cursor: pointer; text-decoration: none;" class="h4">Transaksi Keluar</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card card-statistic-2">
                    <div wire:click="addmasuk()" class="card-icon shadow-primary bg-success" style="border-radius: 50%; cursor: pointer;">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Transaksi Masuk</h4>
                            </div>
                            <div class="card-body">
                                <a wire:click="filterStatus('Masuk')" style="cursor: pointer; text-decoration: none;" class="h4 text-success">Transaksi Masuk</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-{{ $statusbg }}">
                            <h4 class="text-white" style="font-size: 26px;">Transaksi {{$status}}</h4>
                            <div class="card-header-form">
                                <!-- <form>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <div class="input-group-btn">
                                        <button class="btn btn-{{ $statusbg }}"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form> -->
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table-striped table">
                                    <tr>

                                        <th>No</th>
                                        <th>Invoice</th>
                                        <th>Tanggal dan Waktu</th>
                                        <th>Status</th>
                                        <th>Total harga</th>
                                    </tr>
                                    @foreach ($transaksi as $index => $ts )
                                    <tr>
                                        <td>{{$transaksi->firstItem() + $index}}</td>
                                        <td><a href="{{ route('detail', $ts->id) }}">{{$ts->invoice}}</a></td>
                                        <td> {{date("j F, Y h:i A", strtotime($ts->tanggal))}}</td>
                                        <td>
                                            <div class="badge badge-{{ $ts->status_badge }}">{{$ts->status}}</div>
                                        </td>
                                        <td>Rp. {{number_format($ts->total_price, 0, ',', '.')}}</td>
                                    </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>