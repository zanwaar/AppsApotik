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
                <div class="invoice  bg-secodary">
                    <div class="invoice-print">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class=" text-md-right">
                                    <address>
                                        <strong>Tanggal Transaksi:</strong><br>
                                        Invoice
                                    </address>
                                </div>
                            </div>
                        </div>
                        <form autocomplete="off" wire:submit.prevent="addTask">


                            <div class="row">
                                <div class="col-md-2">
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
                                </div>
                                <div class="col-md-2">
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
                                <div class="col-md-2">
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
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="harga">harga</label>
                                        <input type="text" wire:model.defer="state.harga" style="border-radius: 6px; height: 42px;" class="form-control @error('harga') is-invalid @enderror" id="harga" placeholder="Masukan Harga ">
                                        @error('harga')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <input type="text" wire:model.defer="state.quantity" style="border-radius: 6px; height: 42px;" class="form-control @error('quantity') is-invalid @enderror" id="quantity" placeholder="Masukan quantity ">
                                        @error('quantity')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                                <span>Save</span>
                            </button>
                        </form>
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="">Keranjang</h5>
                                <div class="table-responsive">
                                    <table class="table-striped table-hover table-md table">
                                        <tr class="bg-primary text-white">
                                            <th>#</th>
                                            <th>Item</th>
                                            <th class="text-center">Quantity</th>
                                            <th>Harga</th>
                                            <th>Totals</th>
                                            <th>a</th>
                                        </tr>

                                        @forelse($tasks as $index => $task)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $task['nama_obat'] }}</td>
                                            <td>{{ $task['quantity'] }}</td>
                                            <td>{{ $task['harga'] }}</td>
                                            <td>{{ $task['total'] }}</td>
                                            <td>
                                                <button wire:click="editTask({{ $index }})" class="btn btn-sm btn-primary">Edit</button>
                                                <button wire:click="removeTask({{ $index }})" class="btn btn-sm btn-danger">Hapus</button>
                                            </td>
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
                                            <div class="invoice-detail-value invoice-detail-value-lg">{{$sumharga}}</div>
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