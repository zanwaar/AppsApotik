<div>
    <div class="card gradient-bottom">
        <div class="card-header">
            <h4>Top 5 {{$period}}</h4>
            <div class="card-header-action dropdown">
                <a href="#" data-toggle="dropdown" class="btn btn-danger dropdown-toggle">{{$period}}</a>
                <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                    <li class="dropdown-title">Select Period</li>
                    <li><a wire:click="topSellingDrugs('today')" class="dropdown-item {{$period == 'today' ? 'active' : ''}}">Today</a></li>
                    <li><a wire:click="topSellingDrugs('week')" class="dropdown-item {{$period == 'week' ? 'active' : ''}}">Week</a></li>
                    <li><a wire:click="topSellingDrugs('month')" class="dropdown-item {{$period == 'month' ? 'active' : ''}}">Month</a></li>
                    <li><a wire:click="topSellingDrugs('year')" class="dropdown-item {{$period == 'year' ? 'active' : ''}}">This Year</a></li>

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
                @foreach ($top as $index => $ts )
                <tr>
                    <td>{{$ts->kode}}</td>
                    <td>{{$ts->nama_obat}}</td>
                    <td>{{$ts->total_quantity}}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
</div>