@extends('dist.index')
@section('title_page','Edit users')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                <h4 class="c-grey-900 mB-5">Edit users</h4>
                <a class="btn btn-danger mB-15" href="{{url('/system/users')}}" type="button"><i class="ti-back-left" aria-hidden="true"></i> Back</a>
                <div class="container">
                    <form action="{{url('/system/update-user')}}" method="POST">
                        @csrf
                        <input type="text" name="id" id="id" value={{$id}} hidden>
                        <div class="container">
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-row">
                                        <div class="col"><label class="col-form-label">Name</label></div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col"><input class="form-control" type="text" name="name" value="{{$user[0]->name}}" required></div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-row">
                                        <div class="col"><label class="col-form-label">Email</label></div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col"><input class="form-control" type="email" name="email" value="{{$user[0]->email}}" required></div>
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
                                        <div class="col"><input class="form-control" type="password" name="password" value="{{$user[0]->password}}" required></div>
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
                                                    <option value="{{$rol->id}}" {{$user[0]->id_rol == $rol->id ? 'selected' : ''}}>{{$rol->rol_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="container">
                                <div class="col" style="text-align: center;">
                                    <button class="btn btn-success" name="update" value="update" type="submit" style="margin-top: 15px;"><i class="ti-plus"></i> Save Information</button>
                                    <button class="btn btn-danger" type="button" id="{{$id}}" onclick="deleteUser(this)" style="margin-top: 15px;"><i class="ti-trash"></i> Delete</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
@endsection

@push('scripts_code')
    <script>
        function deleteUser(el){    
            swal("Are you sure you want to delete this record?")
            .then((value) => {
                axios.get('/system/delete-user/'+el.id)
                .then(function (response) {
                    swal('Item successfully deleted', '', 'success')
                    setTimeout(function(){
                        window.location.href = '/system/users'
                    },1000)
                })
                .catch(function (error) {
                    swal('Error', error, 'fail')
                });
            });

        }
    </script>
@endpush