<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css-frontend/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css-frontend/styles-responsive.css') }}">
    <link rel="stylesheet" href=" {{ asset('alertify/css/alertify.min.css') }} " />
    <link rel="stylesheet" href="{{ asset('alertify/css/themes/bootstrap.min.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
    <title>Maria Reina de La Paz </title>
</head>

<body>
    <header class="header">
        <div class="top_bar">
            <div class="container">
                <div class="left">
                    <p><i class="fas fa-phone-alt"></i> Call Us: +1 (860) 522-1129</p>
                    <p>Parish Office Hours: Mon - Thu 9:00 AM - 4:00 PM</p>
                </div>
                <ul class="right">
                    <li><a target="_blank" href="https://www.facebook.com/mariareinadelapazhartfordct"><i
                                class="fab fa-facebook-f"></i></a></li>
                    <li><a target="_blank" href="https://www.instagram.com/mariareinapazct/"><i
                                class="fab fa-instagram"></i></a></li>
                    <li><a target="_blank" href="https://www.youtube.com/channel/UCv1WSzNV6GDw0qQdbqzsGPA"><i
                                class="fab fa-youtube"></i></a></li>
                    <span class="separador"></span>
                    <li><a href="{{ url("/form-login") }}"><i class="fas fa-user"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="bot_bar">
            <div class="container">
                <div class="logo">
                    <a href="https://www.mrpct.org/">
                        <img src="{{ asset('assets/images/logo maria.png') }}" alt="">
                    </a>
                </div>

                
                <div class="content-btns">
                    <a href="https://www.mrpct.org/" class="button-home">
                        <div class="icon">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <div class="text">
                            GO TO WEB WWW.MRPCT.ORG
                        </div>
                    </a>
                    <a class="button-home" href="{{ url("/consult-reservation") }}">
                        <div class="icon">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <div class="text">
                            Check your tickets
                        </div>
                    </a>
                </div>
                
            </div>
        </div>
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
                            $seats = DB::select('select * from seats order by seat_number ASC');
                        @endphp
                        @foreach ($seats as $item)
                            @if (in_array($item->seat_number, range(1, 798)))
                                @if ($item->seat_number >= 57 && $item->seat_number <= 78)
                                    @if ($item->sold == '1')
                                        <label class="chairs" data-bs-toggle="tooltip"
                                            data-bs-custom-class="toolPrice" data-bs-html="true" title="<b> SOLD </b>">
                                            <input type="checkbox" class="check sold" value="{{ $item->id }}"
                                                name="massive_sale[]" id="{{ $item->price }}"
                                                onclick="calculateAmount(this)" disabled>
                                            <span class="material-icons">event_seat</span>
                                        </label>
                                    @else
                                        <label class="chairs" data-bs-toggle="tooltip"
                                            data-bs-custom-class="toolPrice" data-bs-html="true"
                                            title=" <p> <b> This massive_sale is only available for sale on site. </b> </p> <p><b>Price: </b>  {{ money($item->price * 100, 'USD') }} </p>">
                                            <input type="checkbox" class="check disabled" value="{{ $item->id }}"
                                                name="massive_sale[]" id="{{ $item->price }}"
                                                onclick="calculateAmount(this)" disabled>
                                            <span class="material-icons">event_seat</span>
                                        </label>
                                    @endif
                                @else
                                    @if ($item->sold == '1')
                                        <label class="chairs" data-bs-toggle="tooltip"
                                            data-bs-custom-class="toolPrice" data-bs-html="true"
                                            title="<p><b> SOLD </b></p>" disabled>
                                            <input type="checkbox" class="check sold" value="{{ $item->id }}"
                                                name="massive_sale[]" id="{{ $item->price }}"
                                                onclick="calculateAmount(this)" disabled>
                                            <span class="material-icons">event_seat</span>
                                        </label>
                                    @else
                                        <label class="chairs" data-bs-toggle="tooltip"
                                            data-bs-custom-class="toolPrice" data-bs-html="true"
                                            title="<p><b> massive_sale number: </b> {{ $item->seat_number }}</p>  <p><b>Price: </b>  {{ money($item->price * 100, 'USD') }} </p> <p> <b> Location: </b>  {{ $item->location }} </p>">
                                            <input type="checkbox" class="check" value="{{ $item->id }}"
                                                name="massive_sale[]" id="{{ $item->price }}"
                                                onclick="calculateAmount(this)">
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
                                @foreach ($seats as $item)
                                    @if (in_array($item->seat_number, range(799, 848)))
                                        <label class="chairs" data-bs-toggle="tooltip"
                                            data-bs-custom-class="toolPrice" data-bs-html="true"
                                            title="<p><b> massive_sale number: </b> {{ $item->seat_number }}</p>  <p><b>Price: </b>  {{ money($item->price * 100, 'USD') }} </p> <p> <b> Location: </b>  {{ $item->location }} </p>">
                                            <input type="checkbox" class="check" value="{{ $item->id }}"
                                                name="massive_sale[]" id="{{ $item->price }}"
                                                onclick="calculateAmount(this)">
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
                <p> <strong>Friday, December 3rd <br> Entrace: 6 pm</strong> </p>
                <br>
                <p> <strong>Viernes 3 de Diciembre <br> Entrada: 6 pm</strong> </p>
                <div class="card">
                    <p> <strong>Selected seats - Sillas seleccionadas :</strong> </p>
                    <p>112, 113, 114, 115, 116 (location B1) </p>
                    <p> <strong>Entrance - Entrada:</strong> Coolidge St.door</p>
                    <p class="fee"> <strong>Online Fee: </strong> <p id="fee">$0.00</p></p>
                    <p class="price"> Total: <p id="price">$0.00</p></p>
                    <button onclick="checkSeat()">PAY</button>
                </div>
                <p class="note"><span>Important: </span> Handicap accessible seats can only be reserved
                    previously at the Parish.
                </p>
                <p class="note"><span>Nota:</span> Las sillas destinadas para discapacitados solo podrán ser
                    reservadas deforma presencial en la Parroquia
                </p>
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
                        <p>Handicap accessible massive_sale - Asiento para persona con discapacidad.</p>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modelId2" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal-seats">
                        <div class="modal-header">
                            <h5 class="modal-title">Personal information</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="header-amount">
                                <label class="amount-ticket" id="massive_amount"></label>
                            </div>
                            <div class="mb-3">
                                <label class="label-modal" for="">Full name</label>
                                <input  type="text" class="form-control input-modal" name="buyer_name" id="buyer_name"
                                    value="{{ old('buyer_name') }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="label-modal" for="">Address</label>
                                <input type="text" class="form-control input-modal" name="buyer_address" id="buyer_address"
                                    value="{{ old('buyer_address') }}">
                            </div>
                            <div class="mb-3">
                                <label class="label-modal" for="">Email</label>
                                <input class="form-control input-modal" name="buyer_email" id="buyer_email" type="email"
                                    value="{{ old('buyer_email') }}">
                            </div>
                            <div class="mb-3">
                                <label class="label-modal" for="">Contact or file number</label>
                                <input class="form-control input-modal" name="buyer_phone" id="buyer_phone" type="number"
                                    value="{{ old('buyer_phone') }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="label-modal" for="">Payment method</label>
                                <select name="payment_method" id="payment_method" class="form-control select-modal" required>
                                    <option value="cash" selected>Online</option>
                                </select>
                            </div>
                            <div class="row container-paypal">
                                <div class="col">
                                    <div id="paypal_button">
    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-html="true"
            title="<em>Tooltip</em> <u>with</u> <b>HTML</b>">
            Tooltip with HTML
        </button>
    </main>
    <input type="text" id="massive_amount_dummy" name="massive_amount_dummy" hidden>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"></script>
    <script src=" {{ asset('alertify/alertify.min.js') }} "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=ATev4XuupOUo4iEAJJOG3A9YOc97pM8buKqZ2uUCdVCRRdbFRo7bN6CYMyGU2gKfM0kT2FF7Mn7jOFSS&currency=USD" data-sdk-integration-source="button-factory"></script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        function initPayPalButton() {
            paypal.Buttons({
                style: {
                    shape: 'rect',
                    color: 'gold',
                    layout: 'vertical',
                    label: 'paypal',

                },
                createOrder: function(data, actions) {
                    if(document.getElementById('buyer_name').value == ''){
                        let notificationError = alertify.notify('Name: This field cannot be empty!', 'error', 8,function() {console.log('dismissed');});
                        return false;
                    }
                    if(document.getElementById('buyer_address').value == ''){
                        let notificationError = alertify.notify('Adddress: This field cannot be empty!', 'error', 8,function() {console.log('dismissed');});
                        return false; 
                    }
                    if(document.getElementById('buyer_email').value == ''){
                        let notificationError = alertify.notify('Email: This field cannot be empty!', 'error', 8,function() {console.log('dismissed');});
                        return false;
                    }
                    if(document.getElementById('buyer_phone').value == ''){
                        let notificationError = alertify.notify('Phone: This field cannot be empty!', 'error', 8,function() {console.log('dismissed');});
                        return false;
                    }
                    if(document.getElementById('payment_method').value == ''){
                        let notificationError = alertify.notify('Payment method: This field cannot be empty!', 'error', 8,function() {console.log('dismissed');});
                        return false;
                    }
                    return actions.order.create({
                        purchase_units: [{
                            "amount": {
                                "currency_code": "USD",
                                "value": document.getElementById('massive_amount_dummy').value
                            }
                        }]
                    });
                },

                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        axios.post('/system/masive-sell-seats', {
                                buyer_name: document.getElementById('buyer_name').value,
                                buyer_address: document.getElementById('buyer_address').value,
                                buyer_email: document.getElementById('buyer_email').value,
                                buyer_phone: document.getElementById('buyer_phone').value,
                                payment_method: document.getElementById('payment_method').value,
                                massive_sale: $seats,
                                online: 'yes'
                            })
                            .then(function(response) {
                                console.log(response)
                                swal("Check your email!", "The payment has been successfully completed. Your tickets were sent to the contact email address.", "success")
                                setTimeout(() => {
                                    window.location.href = '/'
                                }, 3500);
                            })
                            .catch(function(error) {
                                console.log(error)
                            });
                            //alert('Transaction completed by ' + details.payer.name.given_name + '!');
                    });
                },
                onError: function(err) {
                    console.log(err);
                }
            }).render('#paypal_button');
        }
        initPayPalButton();


        var $value = 0;
        var $seats = [];

        function checkSeat() {
            if ($(".check:checkbox").filter(":checked").length < 1) {
                let notificationError = alertify.notify('Failed: Select at least one seat!', 'error', 8,function() {console.log('dismissed');});
            } else {
                $('#modelId2').modal('show');
            }
        }

        function calculateAmount($el) {
            console.log($el.checked)
            console.log($el.id)
            if ($el.checked) {
                $seats.push($el.value)
                $value = $value + parseFloat($el.id)
            } else {
                const index = $seats.indexOf($el.value);
                if (index > -1) {
                    $seats.splice(index, 1);
                }
                $value = $value - parseFloat($el.id)
            }

            document.getElementById('price').textContent = formatter.format($value);
            document.getElementById('fee').textContent = formatter.format(parseFloat(($value * 0.029) + 0.3).toFixed(2));
            $price = $value;
            $fee = parseFloat(($value * 0.029) + 0.3).toFixed(2);
            $total = parseFloat($price) + parseFloat($fee);
            document.getElementById('massive_amount').textContent = formatter.format(parseFloat($total).toFixed(2));
            document.getElementById('massive_amount_dummy').value = parseFloat($total).toFixed(2);
            
        }

        var formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
        });
    </script>
</body>
</html>
