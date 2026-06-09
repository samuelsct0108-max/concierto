@extends('dist.index')
@section('title_page', 'Add money collection')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    @php
                        $user = DB::select('select * from users_gmos where id = ?', [$id]);
                    @endphp
                    <h4 class="c-grey-900 mB-20">Add money collection to <strong
                            style="text-transform: uppercase">{{ $user[0]->name }}</strong></h4>
                    <a class="btn btn-danger mB-15" href="{{ url('/system/collect-money') }}" type="button"><i
                            class="ti-back-left" aria-hidden="true"></i> Back</a>
                    <div class="row mb-2">
                        <div class="col-2">
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modelId"><i
                                    class="ti-plus"></i>Add collection</button>
                        </div>
                    </div>
                    <table id="dataTable" class="table table-striped table-bordered mt-3" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <td style="text-align: right"><strong>Amount</strong></th>
                                <th>Method of collection</th>
                                <th>Collection date</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td style="text-align: right"><strong>Amount</strong></th>
                                <th>Method of collection</th>
                                <th>Collection date</th>
                                <th>Delete</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @php
                                $data = DB::select('select *,DATE_FORMAT(created_at,"%m/%d/%y") as _date from collection');
                            @endphp
                            @foreach ($data as $item)
                                <tr>
                                    <td>@money($data[0]->amount*100,'USD')</td>
                                    <td>{{ $data[0]->payment_method }}</td>
                                    <td>{{ $data[0]->_date }}</td>
                                    <td><a class="btn btn-danger" id="{{ $item->id }}"
                                            onclick="deleteCollection(this)"><i class="text-black-50 ti-trash"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New collection</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/system/store-collect', []) }}" method="POST">
                    @csrf
                    <input type="text" name="user_id" id="user_id" value="{{ $id }}" hidden>
                    <div class="modal-body">
                        <label for="">Amount</label>
                        <input type="text" class="form-control" name="amount" id="amount" required>
                        <label for="">Method of collection</label>
                        <select name="payment_method" id="payment_method" class="form-control" required>
                            <option value="cash">Cash</option>
                            <option value="check">Check</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

@push('scripts_code')
    <script>

        function deleteCollection(el) {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        axios.get('/system/delete-collect/' + el.id)
                        .then(res => {
                            swal("Good job!", "Item successfully deleted!", "success");
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        })
                        .catch(err => {
                            console.error(err);
                        })
                    }
                });
        }
    </script>
@endpush
