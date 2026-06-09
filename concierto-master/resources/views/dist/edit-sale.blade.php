@extends('dist.index')
@section('title_page', 'Admin sales')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <h4 class="c-grey-900 mB-20">Seat #{{ $id }} information</h4>
                    <a class="btn btn-danger mB-15" href="{{ url('/system/admin-sales') }}" type="button"><i
                            class="ti-back-left" aria-hidden="true"></i> Back</a>
                    <div class="container">
                        <div class="email-content-wrapper">
                            @php
                                $info_sale = DB::select('select *,DATE_FORMAT(created_at,"%m/%d/%y") as _date from seat_sold where seat_number = ?', [$id]);
                                $info_seat = DB::select('select *,DATE_FORMAT(created_at,"%m/%d/%y") as _date from seats where id = ?', [$info_sale[0]->seat_number]);
                                $buyer = DB::select('select * from buyer where id = ?', [$info_sale[0]->buyer_id]);
                            @endphp
                            <div class="peers ai-c jc-sb pX-40 pY-30">
                                <div class="peers peer-greed">
                                    {{-- <img class="bdrs-50p w-3r h-3r" alt=""
                                            src="{{ Avatar::create(strtoupper($buyer[0]->buyer_name))->toBase64() }}"> --}}
                                    <div class="peer mR-20"></div>
                                    <div class="peer"><small>Purchase date: {{ $info_sale[0]->_date }}</small>
                                        <h5 class="c-grey-900 mB-5">{{ $buyer[0]->buyer_name }}</h5>
                                        <span>Unique ticket identifier: {{ $info_sale[0]->id }}</span><br>
                                        <span>Seat number: {{ $info_seat[0]->seat_number }}</span><br>
                                        <span>Address: {{ $buyer[0]->buyer_address }}</span><br>
                                        <span>Email: {{ $buyer[0]->buyer_email }}</span><br>
                                        <span>Phone: {{ $buyer[0]->buyer_phone }}</span><br>
                                        <span class="badge bgc-red-50 c-red-700 p-10 lh-0 tt-c rounded-pill">Remember that
                                            the ticket identifier is different from the seat number, sometimes they may
                                            coincide but it does not mean that they are the same. </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col text-center">
                                    <a type="button" class="btn cur-p btn-warning" style="color: black"
                                        href="{{ url('/system/download-ticket', [$info_seat[0]->seat_number]) }}"
                                        download=""><i class="ti-download"></i> Download ticket</a>
                                    <button type="button" class="btn cur-p btn-primary btn-color"
                                        onclick="sendTicketToBuyer({{$info_seat[0]->seat_number}})"><i
                                            class="ti-email"></i> Send to user's email</button>
                                </div>
                            </div>
                            <div class="bdT pX-40 pY-30">
                                <h4>Seats related to this buyer</h4>
                                @php
                                    $all_sales_buyer = DB::select('select *,DATE_FORMAT(created_at,"%m/%d/%y") as _date from seat_sold where buyer_id = ?', [$buyer[0]->id]);
                                @endphp
                                @foreach ($all_sales_buyer as $item)
                                    @php
                                        $info_seat = DB::select('select *,DATE_FORMAT(created_at,"%m/%d/%y") as _date from seats where id = ?', [$item->seat_number]);
                                    @endphp
                                    <span class="badge rounded-pill fl-l bg-info lh-5 p-10"
                                        style="margin-left: 5px">{{ $item->id }} -
                                        {{ $info_seat[0]->seat_number }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts_code')
    <script>

        function sendTicketToBuyer(id){
            swal({
                title: "Are you sure?",
                text: "Once sent, you will not be able to reverse this action!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    axios.get('/system/send-ticket-customer/'+id)
                    .then(res => {
                        swal("Tickets sent successfully!", {icon: "success"});
                    })
                    .catch(err => {
                        console.error(err);
                    })

                }
            })
        }

    </script>
@endpush
