<div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Tanggal</h4>
                </div>
                <div class="card-body">
                    <form autocomplete="off" wire:submit.prevent="filtertanggal">
                        <div class="form-group ">
                            <label for="inputState">Type Transaksi</label>
                            <select id="inputState" wire:model.defer="status" class="form-control">
                                <option value=""> --- Type Transaksi ---</option>
                                <option value="Keluar">Transaksi Keluar</option>
                                <option value="Masuk">Transaksi Masuk</option>
                            </select>
                            @error('status')
                            <div class="text-danger pt-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <div wire:ignore>
                                        <label>Tanggal Awal *</label>
                                        <input required type="text" wire:model.defer="startDate" class="form-control @error('startDate') is-invalid @enderror" id="range_tanggal" name="range_tanggal" required />
                                    </div>
                                    @error('startDate')
                                    <div class="text-danger pt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <div wire:ignore>
                                        <label>Tanggal Akhir</label>
                                        <input required type="text" wire:model.defer="endDate" class="form-control" id="range_tanggal" name="range_tanggal" required />
                                    </div>
                                    @error('endDate')
                                    <div class="text-danger pt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Filter Laporan</button>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Tahun & Bulan</h4>
                </div>
                <div class="card-body">
                    <form autocomplete="off" wire:submit.prevent="filtertahun">
                        <div class="form-group ">
                            <label for="inputState">Type Transaksi</label>
                            <select id="inputState" wire:model.defer="statust" class="form-control">
                                <option value=""> --- Type Transaksi ---</option>
                                <option value="Keluar">Transaksi Keluar</option>
                                <option value="Masuk">Transaksi Masuk</option>
                            </select>
                            @error('statust')
                            <div class="text-danger pt-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group ">
                                    <label for="inputState">Tahum</label>
                                    <select wire:model.defer="tahun" class="form-control">
                                        <option value=""> --- Select Tahun ---</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                    </select>
                                    @error('tahun')
                                    <div class="text-danger pt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group ">
                                    <label for="inputState">Bulan</label>
                                    <select wire:model.defer="bulan" class="form-control">
                                        <option value=""> --- Select Bulan ---</option>
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>

                                    </select>
                                    @error('bulan')
                                    <div class="text-danger pt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Filter Laporan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if ($filter)
    <div class="card">
        @if ($filtert)
        <div class="card-header ">
            <h4 class="text-dark" style="font-size: 26px;">Laporan {{$statust}} Tahun: {{$tahun}} - Bulan: {{$namabulan}}</h4>
            <div class="card-header-form">
                <form method="POST" action="{{ route('laporanpdf') }}">
                    @csrf
                    <input type="hidden" wire:model.defer="statust" name="statust" />
                    <input type="hidden" wire:model.defer="tahun" name="tahun" />
                    <input type="hidden" wire:model.defer="bulan" name="bulan" />
                    <input type="hidden" wire:model.defer="namabulan" name="namabulan" />

                    <button type="submit" class="btn btn-dark">Download Laporan</button>
                </form>
            </div>
        </div>
        @else
        <div class="card-header bg-{{ $statusbg }}">
            <h4 class="text-white" style="font-size: 26px;">Laporan {{$status}}</h4>
            <div class="card-header-form">
                <form method="POST" action="{{ route('laporanpdf') }}">
                    @csrf
                    <input type="hidden" wire:model.defer="status" name="status" />
                    <input type="hidden" wire:model.defer="startDate" name="startDate" />
                    <input type="hidden" wire:model.defer="endDate" name="endDate" />

                    <button type="submit" class="btn btn-dark">Download Laporan</button>
                </form>
            </div>
        </div>
        @endif


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
                        <td>{{1 + $index}}</td>
                        <td><a target="_blank" href="{{ route('cetakpdf', ['id' => $ts->invoice]) }}">{{$ts->invoice}}</a></td>
                        <td> {{date("j F, Y h:i A", strtotime($ts->tanggal))}}</td>
                        <td>
                            <div class="badge badge-{{ $ts->status_badge }}">{{$ts->status}}</div>
                        </td>
                        <td>Rp. {{number_format($ts->total_price, 0, ',', '.')}}</td>
                    </tr>
                    @endforeach

                </table>
            </div>
            <div class="float-right pr-3">
            </div>
        </div>
    </div>
    @endif

</div>
@push('style')
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
@endpush

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>


<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    window.addEventListener("allert", function(event) {
        swal(event.detail[0].title,
            event.detail[0].message,
            event.detail[0].icon, );
    });
    flatpickr('#range_tanggal', {
        altInput: true,
        altFormat: "j F, Y",
        dateFormat: "Y-m-d",
    });
</script>
@endpush