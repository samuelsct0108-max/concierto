@extends('dist.index')
@section('title_page','Dashboard')
@section('content')
<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="bd bgc-white">
            <div class="layers">
                <div class="layer w-100 p-20">
                    <h6 class="lh-1">Sales Report</h6>
                </div>
                <div class="layer w-100">
                    <div class="bgc-light-blue-500 c-white p-20">
                        <div class="peers ai-c jc-sb gap-40">
                            <div class="peer peer-greed">
                                <h5>{{date('m/d/y')}}</h5>
                                <p class="mB-0">Sales Report</p>
                            </div>
                            @php
                                $total_sold = DB::select('select sum(seats.price) as total from seat_sold LEFT JOIN seats on  seat_sold.seat_number = seats.id')
                            @endphp
                            <div class="peer">
                                <h3 class="text-end">@money($total_sold[0]->total*100,'USD')</h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive p-20">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="bdwT-0">User</th>
                                    <th class="bdwT-0">Check</th>
                                    <th class="bdwT-0">Cash</th>
                                    <th class="bdwT-0">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $users = DB::select('select * from users_gmos')
                                @endphp
                                @foreach ($users as $item)
                                    @php
                                       $check = DB::select('select sum(seats.price) as total from seat_sold LEFT JOIN seats on  seat_sold.id_seller = seats.id where seat_sold.id_seller = ? and payment_method = "check"',[$item->id]);
                                       $cash = DB::select('select sum(seats.price) as total from seat_sold LEFT JOIN seats on  seat_sold.id_seller = seats.id where seat_sold.id_seller = ? and payment_method = "cash"',[$item->id]);
                                       $total_user = DB::select('select sum(seats.price) as total from seat_sold LEFT JOIN seats on  seat_sold.id_seller = seats.id where seat_sold.id_seller = ?',[$item->id]);
                                    @endphp
                                    <tr>
                                        <td class="fw-600">{{$item->name}}</td>
                                        <td>@money($check[0]->total*100,'USD')</td>
                                        <td>@money($cash[0]->total*100,'USD')</td>
                                        <td><strong>@money($total_user[0]->total*100,'USD')</strong></td>
                                    </tr>
                                @endforeach
                                @php
                                     $total_online = DB::select('select sum(seats.price) as total from seat_sold LEFT JOIN seats on  seat_sold.seat_number = seats.id where seat_sold.id_seller IS NULL');
                                @endphp
                                <tr>
                                    <td class="fw-600">Online sales</td>
                                    <td>@money(0*100,'USD')</td>
                                    <td>@money(0*100,'USD')</td>
                                    <td><strong>@money($total_online[0]->total*100,'USD')</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="bd bgc-white">
            <div class="container mt-3">
                <div class="layers">
                    <div class="layer w-100">
                        <div class="layers">
                            <div class="layer w-100">
                                <h5 class="mB-5">100k</h5><small
                                    class="fw-600 c-grey-700">Visitors From USA</small> <span
                                    class="pull-right c-grey-600 fsz-sm">50%</span>
                                <div class="progress mT-10">
                                    <div class="progress-bar bgc-deep-purple-500"
                                        role="progressbar" aria-valuenow="50" aria-valuemin="0"
                                        aria-valuemax="100" style="width:50%"><span
                                            class="visually-hidden">50% Complete</span></div>
                                </div>
                            </div>
                            <div class="layer w-100 mT-15">
                                <h5 class="mB-5">1M</h5><small
                                    class="fw-600 c-grey-700">Visitors From Europe</small> <span
                                    class="pull-right c-grey-600 fsz-sm">80%</span>
                                <div class="progress mT-10">
                                    <div class="progress-bar bgc-green-500" role="progressbar"
                                        aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"
                                        style="width:80%"><span class="visually-hidden">80%
                                            Complete</span></div>
                                </div>
                            </div>
                            <div class="layer w-100 mT-15">
                                <h5 class="mB-5">450k</h5><small
                                    class="fw-600 c-grey-700">Visitors From Australia</small>
                                <span class="pull-right c-grey-600 fsz-sm">40%</span>
                                <div class="progress mT-10">
                                    <div class="progress-bar bgc-light-blue-500"
                                        role="progressbar" aria-valuenow="50" aria-valuemin="0"
                                        aria-valuemax="100" style="width:40%"><span
                                            class="visually-hidden">40% Complete</span></div>
                                </div>
                            </div>
                            <div class="layer w-100 mT-15">
                                <h5 class="mB-5">1B</h5><small
                                    class="fw-600 c-grey-700">Visitors From India</small> <span
                                    class="pull-right c-grey-600 fsz-sm">90%</span>
                                <div class="progress mT-10">
                                    <div class="progress-bar bgc-blue-grey-500"
                                        role="progressbar" aria-valuenow="50" aria-valuemin="0"
                                        aria-valuemax="100" style="width:90%"><span
                                            class="visually-hidden">90% Complete</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
