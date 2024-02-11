<div>
    <div class="px-4 pt-5">
        <section class="section pt-5">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{route('transaksi')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Add Transaksi Masuk</h1>

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Transaksi</a></div>
                    <div class="breadcrumb-item">Add Transaksi Masuk</div>
                </div>
            </div>
            <div class="section-body">
                <div class="card p-3">
                    <div class="row">
                        <div class="col-md-10">

                            <div class="form-group" wire:ignore>
                                <label>Pilih Obat</label>
                                <select id="mySelect2" class="form-control mySelect2">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Tambah Obat</label>
                                <button type="submit" class="btn btn-dark form-control" wire:click.prevent="addNew">
                                    <span>Tambah Obat</span>
                                </button>


                            </div>

                        </div>

                    </div>

                </div>
                <div class="row">
                    <div class="col-3">
                        <form autocomplete="off" wire:submit.prevent="addTask" class="card p-3">

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Jenis Obat - {{$state['jenis_obat']}}</li>
                                <li class="list-group-item">Nama Obat - {{$state['nama_obat']}}</li>
                                <li class="list-group-item">Stok Obat - {{$state['stok']}}</li>
                                <li class="list-group-item">Harga Beli - Rp. {{ number_format(floatval($state['hargabeli']), 0, ',', '.') }}</li>
                                <li class="list-group-item">Harga Jual - Rp. {{ number_format(floatval($state['hargajual']), 0, ',', '.') }}</li>
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

                                </div>
                            </div>

                            <div class="">
                                <div class="mb-2">
                                    <input type="hidden" wire:model.defer="state.hargabeli" style="border-radius: 6px; " class="form-control @error('hargabeli') is-invalid @enderror" id="hargabeli" placeholder="Masukan Hargabeli ">

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
                                                <th>Harga Beli</th>
                                                <th>Harga Jual</th>
                                                <th>Total Harga Beli</th>
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
                                                <td>Rp. {{number_format($task['hargabeli'], 0, ',', '.')}}</td>
                                                <td>Rp. {{number_format($task['hargajual'], 0, ',', '.')}}</td>
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
                                            <br>
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
        <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog  modal-lg" role="document">
                <form autocomplete="off" wire:submit.prevent="addTaskDb">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                <span>Tambah Data Obat</span>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="jenis_obat">Jenis Obat</label>
                                <select wire:model.defer="state.jenis_obat" style="border-radius: 6px; height: 42px;" class="form-control @error('jenis_obat') is-invalid @enderror">
                                    <option value="">Select</option>
                                    <option value="Tablet">Tablet</option>
                                    <option value="Obat cair">Obat cair</option>
                                    <option value="Kapsul">Kapsul</option>
                                    <option value="Obat oles">Obat oles</option>
                                </select>
                                @error('jenis_obat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kode">Kode Obat</label>
                                        <input type="text" wire:model.defer="state.kode" style="border-radius: 6px; height: 42px;" class="form-control @error('kode') is-invalid @enderror" id="kode" placeholder="Masukan Kode Obat ">
                                        @error('kode')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Nama Obat</label>
                                        <input type="text" wire:model.defer="state.nama_obat" style="border-radius: 6px; height: 42px;" class="form-control @error('nama_obat') is-invalid @enderror" id="nama_obat" placeholder="Maukan Nama Obat">
                                        @error('nama_obat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="harga">harga Beli</label>
                                        <input type="text" wire:model.defer="state.hargabeli" style="border-radius: 6px; height: 42px;" class="form-control @error('hargabeli') is-invalid @enderror" id="hargabeli" placeholder="Masukan Harga Beli">
                                        @error('hargabeli')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="harga">harga Jual</label>
                                        <input type="text" wire:model.defer="state.hargajual" style="border-radius: 6px; height: 42px;" class="form-control @error('hargajual') is-invalid @enderror" id="hargajual" placeholder="Masukan Harga Jual">
                                        @error('hargajual')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="stok">quantity</label>
                                        <input type="number" wire:model.defer="state.quantity" style="border-radius: 6px; height: 42px;" class="form-control @error('quantity') is-invalid @enderror" id="stok">
                                        @error('quantity')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="expired">expired</label>
                                <input type="date" wire:model.defer="state.expired" style="border-radius: 6px; height: 42px;" class="form-control @error('expired') is-invalid @enderror" id="expired" placeholder="Masukan expired ">
                                @error('expired')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancel</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>

                                <span>Save & to keranjang</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="masukmodal" tabindex="-1" role="dialog" aria-labelledby="masukmodalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                @if ($show)
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="masukmodalLabel">Success</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="">
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Selesai</button>
                        <a href="{{ route('cetakpdf', ['id' => $transaksi->invoice]) }}" target="_blank" class="btn btn-primary">Cetak Invoice</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@push('style')
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
@endpush

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>

<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script>
    window.addEventListener("show-form", function(event) {
        $("#form").modal({
            show: true,
            backdrop: 'static',
        });
    });
    window.addEventListener("show-hidden", function(event) {
        $("#form").modal("hide");
    });
    window.addEventListener("show", function(event) {
        $("#masukmodal").modal("show");
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