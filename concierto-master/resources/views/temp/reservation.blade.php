<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset("assets/css-frontend/styles.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css-frontend/styles-responsive.css") }}">
    <link rel="stylesheet" href=" {{ asset("alertify/css/alertify.min.css") }} "/>
    <link rel="stylesheet" href="{{ asset("alertify/css/themes/bootstrap.min.css") }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Maria Reina de La Paz</title>
</head>
<body>
    <header>
        
    </header>
    <main>
        <form class="hero container" id="form_seats">
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
                                    @if ( $item->seat_number >= 57 && $item->seat_number <= 78 )
                                        @if ($item->sold == "1")
                                            <label class="chairs" data-bs-toggle="tooltip" data-bs-custom-class="toolPrice" data-bs-html="true" title="<b> SOLD </b>">
                                                <input type="checkbox" class="check sold" id="seat_{{ $item->seat_number }}" value="{{ $item->seat_number }}" name="seat[]"  disabled>
                                                <span class="material-icons">event_seat</span>
                                            </label>
                                        @else
                                            <label class="chairs" data-bs-toggle="tooltip" data-bs-custom-class="toolPrice" data-bs-html="true" title=" <p> <b> This seat is only available for sale on site. </b> </p> <p><b>Price: </b>  {{ money($item->price * 100,'USD') }} </p>">
                                                <input type="checkbox" class="check disabled" id="seat_{{ $item->seat_number }}" value="{{ $item->seat_number }}" name="seat[]"  disabled>
                                                <span class="material-icons">event_seat</span>
                                            </label>
                                        @endif
                                    @else
                                        @if ($item->sold == "1")
                                            <label class="chairs" data-bs-toggle="tooltip" data-bs-custom-class="toolPrice" data-bs-html="true" title="<p><b> SOLD: </b></p>" disabled>
                                                <input type="checkbox" class="check sold" id="seat_{{ $item->seat_number }}" value="{{ $item->seat_number }}" name="seat[]"  >
                                                <span class="material-icons">event_seat</span>
                                            </label>
                                        @else
                                            <label class="chairs" data-bs-toggle="tooltip" data-bs-custom-class="toolPrice" data-bs-html="true" title="<p><b> Seat number: </b> {{ $item->seat_number }}</p>  <p><b>Price: </b>  {{ money($item->price * 100,'USD') }} </p> <p> <b> Location: </b>  {{$item->location}} </p>">
                                                <input type="checkbox" class="check" id="seat_{{ $item->seat_number }}" value="{{ $item->seat_number }}" name="seat[]"  >
                                                <span class="material-icons">event_seat</span>
                                            </label>
                                        @endif
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
                                                <input type="checkbox" class="check" id="seat_{{ $item->seat_number }}" value="{{ $item->seat_number }}" name="seat[]" >
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
                <p> <strong>Friday, December 3rd <br> Entrace: 6 pm</strong>  </p>
                <br>
                <p> <strong>Viernes 3 de Diciembre <br> Entrada: 6 pm</strong>  </p>
                <div class="card">
                    <p> <strong>Selected seats - Sillas seleccionadas :</strong> </p>
                    <p>112, 113, 114, 115, 116 (location B1) </p>
                    <p> <strong>Entrance - Entrada:</strong>  Coolidge St.door</p>
                    
                    <p class="fee"> <strong>Online Fee: </strong> $10.00</p>
                    <p class="price"> Total: $225.00</p>
                    <button  id="submit_seats" >PAY</button>
                </div>
                <p class="note"><span>Important: </span> Handicap accessible seats can only be reserved previously at the Parish.</p>
                <p class="note"><span>Nota:</span> Las sillas destinadas para discapacitados solo podrán ser reservadas deforma presencial en la Parroquia</p>
                <div class="card">
                    <div class="item">
                        <span class="gray"></span>
                        <p>Available - Disponible</p>
                    </div>
                    <div class="item">
                        <span class="red"></span>
                        <p>Occupied - Ocupado</p>
                    </div>
                    <div class="item">
                        <span class="green1"></span>
                        <p>Your seats - Tus asientos</p>
                    </div>
                    <div class="item">
                        <span class="green2"></span>
                        <p>Handicap accessible seat - Asiento para persona con discapacidad.</p>
                    </div>
                </div>
            </div>
        </form>
        <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-html="true" title="<em>Tooltip</em> <u>with</u> <b>HTML</b>">
            Tooltip with HTML
        </button>

    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"></script>
    <script src=" {{ asset("alertify/alertify.min.js") }} "></script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        $(function() {
            $("#form_seats").on('submit', function (event){
                event.preventDefault();
                if($(".check:checkbox").filter(":checked").length < 1){
                    let notificationError = alertify.notify('Failed: Select a seat!', 'error', 15, function(){  console.log('dismissed'); });
                }else{
                    let notificationSucces = alertify.notify('Successful!', 'success', 15, function(){  console.log('dismissed'); });
                }   
            })
        })

    </script>
</body>
</html>