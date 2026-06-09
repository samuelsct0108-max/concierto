@extends('dist.index')
@section('title_page','Users - collect money')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                <h4 class="c-grey-900 mB-20">Users - collect money</h4>
                <div class="row mb-2">
                </div>
                <table id="dataTable" class="table table-striped table-bordered mt-3" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <td style="text-align: right"><strong>Total collection</strong></th>
                            <td style="text-align: right"><strong>Total delivered</strong></th>
                            <th>Add</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <td style="text-align: right"><strong>Total collection</strong></th>
                                <td style="text-align: right"><strong>Total delivered</strong></th>
                            <th>Add</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php
                            $data = DB::select('select *,DATE_FORMAT(created_at,"%m/%d/%y") as _date from users_gmos')
                        @endphp
                        @foreach ($data as $item)
                            @php
                                $rol = DB::select('select * from roles_gmos where id = ?',[$item->id_rol]);
                                $total_collection = DB::select('select sum(seats.price) as total from seat_sold left join seats on seat_sold.seat_number = seats.id where seat_sold.id_seller = ?',[$item->id]);
                                $total_delivered = DB::select('select sum(amount) as total from collection where user_id = ?',[$item->id]);
                            @endphp
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$rol[0]->rol_name}}</td>
                                <td style="text-align: right">@money($total_collection[0]->total*100,'USD')</td>
                                <td style="text-align: right">@money($total_delivered[0]->total*100,'USD')</td>
                                <td><a class="btn btn-warning" href="{{ url('/system/add-collect', [$item->id]) }}"><i class="text-black-50 ti-plus"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</main>
@endsection