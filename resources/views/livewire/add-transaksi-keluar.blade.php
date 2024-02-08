<div>
    <div class="px-4 pt-5">
        <section class="section pt-5">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{route('transaksi')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Add Transaksi Keluar</h1>

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Transaksi</a></div>
                    <div class="breadcrumb-item">Add Transaksi Keluar</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-3">
                        <form autocomplete="off" wire:submit.prevent="addTask" class="card p-3">
                            <div class="form-group" wire:ignore>
                                <label>Select2</label>
                                <select id="mySelect2" class="form-control mySelect2">
                                    <option>Option 1</option>
                                    <option>Option 2</option>
                                    <option>Option 3</option>
                                </select>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Jenis Obat - {{$state['jenis_obat']}}</li>
                                <li class="list-group-item">Nama Obat - {{$state['nama_obat']}}</li>
                                <li class="list-group-item">Stok Obat - {{$state['stok']}}</li>
                                <li class="list-group-item">Harga - Rp. {{ number_format(floatval($state['harga']), 0, ',', '.') }}</li>
                                <li class="list-group-item">
                                    <div class="form-inline">
                                        <label for="email" class="mr-sm-2">Quantity</label>
                                        <input type="number" wire:model.defer="state.quantity" style="border-radius: 6px; " class="form-control @error('quantity') is-invalid @enderror" id="quantity" placeholder="Masukan quantity ">
                                        @error('quantity')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </li>

                            </ul>
                            <div class="">
                                <div class="mb-2">
                                    <input type="hidden" wire:model.defer="state.nama_obat" style="border-radius: 6px; " class="form-control @error('nama_obat') is-invalid @enderror" id="nama_obat" placeholder="Maukan Nama Obat">
                                    @error('nama_obat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="">
                                <div class="mb-2">
                                    <input type="hidden" wire:model.defer="state.harga" style="border-radius: 6px; " class="form-control @error('harga') is-invalid @enderror" id="harga" placeholder="Masukan Harga ">
                                    @error('harga')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary"><i class="fa fa-S mr-1"></i>
                                <span>Add to Keranjang</span>
                            </button>
                        </form>
                    </div>
                    <div class="col-9 card py-3">
                        <div class="">

                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="">Keranjang</h5>
                                    <div class="table-responsive">
                                        <table class="table-striped table-hover table-md table">
                                            <tr class="bg-primary text-white">
                                                <th>##</th>
                                                <th>Item</th>
                                                <th class="text-center">Quantity</th>
                                                <th>Harga</th>
                                                <th>Totals</th>
                                            </tr>

                                            @forelse($tasks as $index => $task)
                                            <tr>
                                                <td>
                                                    <!-- <button wire:click="editTask({{ $index }})" class="btn btn-sm btn-primary">Edit</button> -->
                                                    <button wire:click="removeTask({{ $index }})" class="btn btn-sm btn-danger mr-2">x</button>
                                                    {{ $index + 1 }}

                                                </td>
                                                <td>{{ $task['nama_obat'] }}</td>
                                                <td class="text-center"> {{ $task['quantity'] }}</td>
                                                <td>Rp. {{number_format($task['harga'], 0, ',', '.')}}</td>
                                                <td>Rp. {{number_format($task['total'], 0, ',', '.')}}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="6">Belum ada data obat.</td>
                                            </tr>
                                            @endforelse

                                        </table>
                                    </div>
                                    <div class="row ">
                                        <div class="col-lg-8">

                                        </div>
                                        <div class="col-lg-4 text-right">
                                            <hr class="mt-2 mb-2">
                                            <div class="invoice-detail-item">
                                                <div class="invoice-detail-name">Jumlah Total</div>
                                                <div class="invoice-detail-value invoice-detail-value-lg">Rp. {{ number_format(floatval($sumharga), 0, ',', '.') }}</div>
                                            </div>
                                            <button wire:click="savetodb()" class="btn btn-primary"><i class="fa fa-S mr-1"></i>
                                                <span>Simpan Transaksi</span>
                                            </button>
                                            <!-- <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="">
                        @if ($show)
                        <div class="invoice">
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
                                                    <th data-width="20%">Harga Jual</th>
                                                    <th data-width="10%" class="text-center">Quantity</th>
                                                    <th data-width="20%">Totals</th>
                                                </tr>
                                                @foreach ($detail as $index => $dt )
                                                <tr>
                                                    <td>{{$index + 1}}</td>
                                                    <td>{{$dt->obat->nama_obat}}</td>
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
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Print</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('style')>
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
@endpush

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>

<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script>
    window.addEventListener("show", function(event) {
        $("#exampleModal").modal("show");
    });
    window.addEventListener("allert", function(event) {
        swal(event.detail[0].icon,
            event.detail[0].message,
            event.detail[0].icon, );
    });
    $('.mySelect2').select2({
        ajax: {
            url: '{{ route("fetch") }}',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                console.log('Data from server:', data);
                return {
                    results: $.map(data, function(item) {
                        return {
                            id: item.id,
                            text: "Kode Obat -" + item.kode + ", Nama Obat -" + item.nama_obat
                        };
                    })
                };
            },
            cache: true
        }
    }).on('change', function(e) {
        @this.set('idobat', e.target.value);
    });
</script>
@endpush