<div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white" style="font-size: 26px;">List Data Obat</h4>
                        <div class="card-header-form">
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card" style="box-shadow:none">
                        <div class="card-header ">
                            <button type="button" class="btn btn-primary rounded" wire:click.prevent="addNew">
                                <i class="fas fa-plus"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
                                <div class="modal-dialog  modal-lg" role="document">
                                    <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'update' : 'create' }}">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    @if($showEditModal)
                                                    <span>Edit Data Oba</span>
                                                    @else
                                                    <span>Tambah Data Obat</span>
                                                    @endif
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
                                                            <input type="text" wire:model.defer="state.harga_beli" style="border-radius: 6px; height: 42px;" class="form-control @error('hargabeli') is-invalid @enderror" id="hargabeli" placeholder="Masukan Harga Beli">
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
                                                            <input type="text" wire:model.defer="state.harga_jual" style="border-radius: 6px; height: 42px;" class="form-control @error('hargajual') is-invalid @enderror" id="hargajual" placeholder="Masukan Harga Jual">
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
                                                            <input type="number" wire:model.defer="state.stok" style="border-radius: 6px; height: 42px;" class="form-control @error('quantity') is-invalid @enderror" id="stok">
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
                                                    @if($showEditModal)
                                                    <span>Save Changes</span>
                                                    @else
                                                    <span>Save</span>
                                                    @endif
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table-striped table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Obat</th>
                                            <th>Nama Obat</th>
                                            <th>Jenis Obat</th>
                                            <th>Harga Beli</th>
                                            <th>Harga Jual</th>
                                            <th>Stok</th>
                                            <th>Status Expired</th>
                                            <!-- <th>Tgl Expired</th> -->
                                            <th class="text-right">Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataobat as $index => $dt)
                                        <tr>
                                            <th scope="row">{{ $dataobat->firstItem() + $index }}</th>
                                            <td>{{ $dt->kode}}</td>
                                            <td>{{ $dt->nama_obat}}</td>
                                            <td>{{ $dt->jenis_obat}}</td>
                                            <td>{{ $dt->harga_beli}}</td>
                                            <td>{{ $dt->harga_jual}}</td>
                                            <td>{{ $dt->stok}}</td>
                                            <td> {!! $dt->status['badge'] !!} </td>
                                            <!-- <td>   <div class="badge badge-danger">Kedaluwarsa</div> </td> -->
                                            <td class="text-right pr-3">
                                                <a wire:click.prevent="edit({{ $dt }})" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                                <a wire:click.prevent="confirmRemoval({{ $dt }})" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="float-right pr-3">
                                {{ $dataobat->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Delete</h5>
                </div>

                <div class="modal-body">
                    <h4>Konfirmasi Delete</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancel</button>
                    <button type="button" wire:click.prevent="delete" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Delete</button>
                </div>
            </div>
        </div>
    </div>

</div>
@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/izitoast/dist/css/iziToast.min.css') }}">
@endpush
@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/izitoast/dist/js/iziToast.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-toastr.js') }}"></script>
<script>
    window.addEventListener("show-form", function(event) {
        $("#form").modal("show");
    });
    window.addEventListener("hide-form", function(event) {
        $("#form").modal("hide");
        $("#confirmationModal").modal("hide");
        iziToast.success({
            title: '' + event.detail[0].message + '',
            message: 'Success',
            position: 'topRight'
        });
    });
    window.addEventListener("show-delete-modal", function(event) {
        $("#confirmationModal").modal("show");
    });
</script>
@endpush