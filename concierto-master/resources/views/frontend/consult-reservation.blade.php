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
                <a href="https://www.mrpct.org/" class="button-home">
                    <div class="icon">
                        <i class="fas fa-arrow-left"></i>
                    </div>
                    <div class="text">
                        GO TO WEB WWW.MRPCT.ORG
                    </div>
                </a>
            </div>
        </div>
    </header>
    <main>
        <div class="consult container">
            <div class="card">
                <form action="">
                    <div class="mb-3">
                        <label for="email">Enter your email</label>
                        <input class="form-control" type="email" name="email" id="email" placeholder="Email" required>
                    </div>
                    
                    <button type="submit">SEARCH</button>
                </form>
            </div>

            @if (session()->has('table'))
                <table id="dataTable" class="table table-striped table-bordered " cellspacing="0" width="100%">
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
                    </tbody>
                </table>
            @endif
            
        </div>
    </main>
    <script defer="defer" src="{{ asset('admin-boostrap-5/main.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"></script>
    <script src=" {{ asset('alertify/alertify.min.js') }} "></script>
</body>
</html>