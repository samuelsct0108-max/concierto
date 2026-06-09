@extends('dist.index')
@section('title_page','Sales')
@push('head_code')
    <link rel="stylesheet" href="{{ asset("css-reservations/styles.css") }}">
    <link rel="stylesheet" href="{{ asset("css-reservations/styles-responsive.css") }}">
    <link rel="stylesheet" href=" {{ asset("alertify/css/alertify.min.css") }} "/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endpush
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                <h4 class="c-grey-900 mB-20">Available seats</h4>

                <form action="{{ url('/system/masive-sell-seats', []) }}" method="POST">
                    @csrf
                    {{-- <div class="row">
                        <div class="col-2">
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modelId2"><i class="ti-money mR-5"></i>Massive sale</button>
                        </div>
                    </div> --}}
                    {{-- <table id="dataTable" class="table table-striped table-bordered" cellspacing="0"
                        width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Seat number</th>
                                <th>Location</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Seat number</th>
                                <th>Location</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @php
                                $data = DB::select('select * from seats order by location')
                            @endphp
                            @foreach ($data as $item)
                                <tr>
                                    @if ($item->sold == '0')
                                        <td><input type="checkbox"  onclick="calculateAmount(this)" name="massive_sale[]" id="{{$item->price}}" value="{{$item->id}}" onclick="calculateAmount(this)"></td>
                                    @else
                                        <td><input type="checkbox"  onclick="calculateAmount(this)" disabled></td>
                                    @endif

                                    <td>{{$item->seat_number}}</td>
                                    <td>{{$item->location}}</td>
                                    <td>@money($item->price*100, 'USD')</td>
                                    @if ($item->sold == '0')
                                        <td><i class="c-green-500 ti-check mR-10"></i> Available</td>  
                                    @else
                                        <td><i class="c-red-500 ti-close mR-10"></i> Sold</td>  
                                    @endif
                                    @if ($item->sold == '0')
                                        <td style="text-align: center"><a data-bs-toggle="modal" data-bs-target="#modelId" onclick="copySeatId({{$item->id}})"><i class="c-red-500 ti-heart mR-10"></i></a></td>
                                    @else
                                        <td style="text-align: center"><a href=""><i class="c-blue-500 ti-eye mR-10"></i></a></td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table> --}}
                    <div class="seat_maps">
                        <main class="hero">
                            <div class="map">
                                <div class="content">
                                    <div class="header-map">
                                        <h5>Coolidge St.</h5>
                                        <div class="header-map__mid">
                                            <div class="parking">
                                                <div class="door"></div>
                                                <p>PARKING DOOR</p>
                                            </div>
                                            <div class="center">
                                                <p>STAGE</p>
                                            </div>
                                            <div class="coolidge">
                                                <div class="door"></div>
                                                <p>COOLIDGE ST. DOOR</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="map-content">
                                        <div class="x7-y1 empty"></div>
                                        <div class="x1-y16 empty"></div>
                                        <div class="x1-y19 empty"></div>
                                        <div class="x12-y4 empty"></div>
                                        <div class="x7-y1l empty"></div>
                                        <div class="x1-y16l empty"></div>
                                        <div class="x1-y19l empty"></div>
                                        <div class="x13-y38 empty"></div>
            
                                        @php
                                            $seats = DB::select( "select * from seats order by seat_number ASC")
                                        @endphp
            
                                        @foreach ( $seats as $item )
                                            @if (in_array( $item->seat_number, range(1, 798) ))
                                                @if ($item->sold == "1")
                                                    <label class="chairs" data-bs-toggle="tooltip" data-bs-custom-class="toolPrice" data-bs-html="true" title="<p><b> SOLD </b></p>" disabled>
                                                        <input type="checkbox"  onclick="calculateAmount(this)" class="check sold" id="{{ $item->price}}" value="{{ $item->id}}" name="massive_sale[]" disabled  >
                                                        <span class="material-icons">event_seat</span>
                                                    </label>
                                                @else
                                                    <label class="chairs" data-bs-toggle="tooltip" data-bs-custom-class="toolPrice" data-bs-html="true" title="<p><b> Seat number: </b> {{ $item->seat_number }}</p>  <p><b>Price: </b>  {{ money($item->price * 100,'USD') }} </p> <p> <b> Location: </b>  {{$item->location}} </p>">
                                                        <input type="checkbox"  onclick="calculateAmount(this)" class="check" id="{{ $item->price}}" value="{{ $item->id}}" name="massive_sale[]"  >
                                                        <span class="material-icons">event_seat</span>
                                                    </label>
                                                @endif
                                            @endif
                                        @endforeach            
                                    </div>
                                    <div class="footer-map">
                                        <div class="title">CORO</div>
                                        <div class="coro">
                                            <div class="coro-content">
                                                    @foreach ( $seats as $item )
                                                        @if (in_array( $item->seat_number, range(799, 848) ))
                                                            <label class="chairs" data-bs-toggle="tooltip" data-bs-custom-class="toolPrice" data-bs-html="true" title="<p><b> Seat number: </b> {{ $item->seat_number }}</p>  <p><b>Price: </b>  {{ money($item->price * 100,'USD') }} </p> <p> <b> Location: </b>  {{$item->location}} </p>">
                                                                <input type="checkbox"  onclick="calculateAmount(this)" class="check" id="{{ $item->price}}" value="{{ $item->id}}" name="massive_sale[]" >
                                                                <span class="material-icons">event_seat</span>
                                                            </label>
                                                        @endif
                                                    @endforeach   
                                                    <div class="xmid empty"></div>
                                                    <div class="x5-y1 empty"></div>
                                                    <div class="x4-y2 empty"></div>
                                                    <div class="x3-y3 empty"></div>
                                                    <div class="x2-y4 empty"></div>
                                                    <div class="x1-y5 empty"></div>
                                                    <div class="x12-y1 empty"></div>
                                                    <div class="x9-y2 empty"></div>
                                                    <div class="x14-y3 empty"></div>
                                                    <div class="x15-y4 empty"></div>
                                                    <div class="x16-y5 empty"></div>
                                                    <div class="x17-y6 empty"></div>
                                                    <div class="x22-y1 empty"></div>
                                                    <div class="x22-y2 empty"></div>
                                                    <div class="x22-y3 empty"></div>
                                                    <div class="x22-y4 empty"></div>
                                                    <div class="x22-y5 empty"></div>
                                                    <div class="x13-y2 empty"></div>
                                            </div>
                                        </div>
                                        <h5>New Britain Avenue</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="info">
                                <h1>CHOOSE LOCATION</h1>
                                <div class="card">
                                    <button  id="submit_seats"  >PAY</button>
                                </div>
                                <p class="note"><span>Important: </span> Handicap accessible seats can only be reserved previously at the Parish.</p>
                                <p class="note"><span>Nota:</span> Las sillas destinadas para discapacitados solo podrán ser reservadas deforma presencial en la Parroquia</p>
                                <div class="card">
                                    <div class="item">
                                        <span class="green1"></span>
                                        <p>Available - Disponible</p>
                                    </div>
                                    <div class="item">
                                        <span class="red"></span>
                                        <p>Occupied - Ocupado</p>
                                    </div>
                                    <div class="item">
                                        <span class="purple"></span>
                                        <p>Your seats - Tus asientos</p>
                                    </div>
                                    <div class="item">
                                        <span class="green2"></span>
                                        <p>Handicap accessible seat - Asiento para persona con discapacidad.</p>
                                    </div>
                                </div>
                            </div>
                        </main>
                    </div>

                    <div class="modal fade" id="modelId2" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Personal information</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-9" >
      
                                        </div>
                                        <label class="col-3" style="font-size: 20px; font-weight: bold" id="massive_amount"></label>
                                    </div>
                                    <label for="">Full name</label>
                                    <input type="text" class="form-control" name="buyer_name" id="buyer_name" value="{{old('buyer_name')}}" required>
                                    <label for="">Address</label>
                                    <input type="text" class="form-control" name="buyer_address" id="buyer_address" value="{{old('buyer_address')}}">
                                    <label for="">Email</label>
                                    <input class="form-control" name="buyer_email" id="buyer_email" type="email" value="{{old('buyer_email')}}">
                                    <label for="">Contact or file number</label>
                                    <input class="form-control" name="buyer_phone" id="buyer_phone" type="number" value="{{old('buyer_phone')}}" required>
                                    <label for="">Payment method</label>
                                    <select name="payment_method" id="payment_method" class="form-control" required>
                                        <option value="cash" {{old('buyer_phone') == 'cash' ? 'selected' : ''}}>Cash</option>
                                        <option value="check" {{old('buyer_phone') == 'check' ? 'selected' : ''}}>Check</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Personal information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('/system/sell-seats', []) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="text" name="seat_id" id="seat_id">
                    <label for="">Full name</label>
                    <input type="text" class="form-control" name="buyer_name" id="buyer_name" required>
                    <label for="">Address</label>
                    <input type="text" class="form-control" name="buyer_address" id="buyer_address">
                    <label for="">Email</label>
                    <input class="form-control" name="buyer_email" id="buyer_email" type="email">
                    <label for="">Contact or file number</label>
                    <input class="form-control" name="buyer_phone" id="buyer_phone" type="number" required>
                    <label for="">Payment method</label>
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
</main>
<script src=" {{ asset("alertify/alertify.min.js") }} "></script>
@endsection

@push('scripts_code')
    <script>

        var $value = 0;

        function copySeatId($id){
            document.getElementById('seat_id').value = $id;
        }

        function calculateAmount($el){
            if($el.checked){
                $value = $value + parseFloat($el.id)
            }else{
                $value = $value - parseFloat($el.id)
            }
            document.getElementById('massive_amount').textContent = formatter.format($value); 
        }

        var formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        });

        
        
        $(function() {

            $("#submit_seats").on('click', function (event){
                event.preventDefault();
                if($(".check:checkbox").filter(":checked").length < 1){
                    let notificationError = alertify.notify('Failed: Select a seat!', 'error', 6, function(){  console.log('dismissed'); });
                }else{
                    $("#modelId2").modal('show'); 
                }   
            })
        })
    </script>
@endpush
