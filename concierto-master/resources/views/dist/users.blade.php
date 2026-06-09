@extends('dist.index')
@section('title_page','Users')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                <h4 class="c-grey-900 mB-20">Users</h4>
                <div class="row mb-2">
                    <div class="col-3">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modelId"><i class="ti-plus"></i> New user</button>
                    </div>
                </div>
                <table id="dataTable" class="table table-striped table-bordered mt-3" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Date</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Date</th>
                            <th>Edit</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php
                            $data = DB::select('select *,DATE_FORMAT(created_at,"%m/%d/%y") as _date from users_gmos')
                        @endphp
                        @foreach ($data as $item)
                            @php
                                $rol = DB::select('select * from roles_gmos where id = ?',[$item->id_rol]);
                            @endphp
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$rol[0]->rol_name}}</td>
                                <td>{{$item->_date}}</td>
                                <td><a class="btn btn-warning" href="{{ url('/system/edit-user', [$item->id]) }}"><i class="text-black-50 ti-pencil"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</main>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{url('/system/create-user')}}" method="POST">
                    @csrf
                    <div class="container">
                        <div class="form-row">
                            <div class="col">
                                <div class="form-row">
                                    <div class="col"><label class="col-form-label">Name</label></div>
                                </div>
                                <div class="form-row">
                                    <div class="col"><input class="form-control" type="text" name="name" required></div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-row">
                                    <div class="col"><label class="col-form-label">Email</label></div>
                                </div>
                                <div class="form-row">
                                    <div class="col"><input class="form-control" type="email" name="email" required></div>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top: 15px;"></div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-row">
                                    <div class="col"><label class="col-form-label">Password</label></div>
                                </div>
                                <div class="form-row">
                                    <div class="col"><input class="form-control" type="password" name="password" required></div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-row">
                                    <div class="col"><label class="col-form-label">Role</label></div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        @php
                                            $roles = DB::select('select * from roles_gmos where sw_visible = "S"')
                                        @endphp
                                        <select class="form-control" name="id_rol" required>
                                            @foreach ($roles as $rol)
                                                <option value="{{$rol->id}}">{{$rol->rol_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection