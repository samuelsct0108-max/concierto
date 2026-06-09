<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <title>Sign In - Maria reina de la paz</title>
    @include('dist.partials.heads')
</head>

<body class="app">
    <div id="loader">
        <div class="spinner"></div>
    </div>
    <script>window.addEventListener("load", (function () { const t = document.getElementById("loader"); setTimeout((function () { t.classList.add("fadeOut") }), 300) }))</script>
    <div class="peers ai-s fxw-nw h-100vh">
        <div class="d-n@sm- peer peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv"
            style="background-image:url(https://services.meteored.com/img/article/cuantos-azules-tiene-el-cielo-289011-2_1024.jpg)">
            <div class="pos-a centerXY">
                <div class="bgc-white bdrs-50p pos-r" style="width:260px;height:250px"><img class="pos-a centerXY"
                        src="https://www.mrpct.org/images/logo.svg" alt="" style="width:250px;height:250px;margin-left:5px"></div>
            </div>
        </div>
        <div class="col-12 col-md-4 peer pX-40 pY-80 h-100 bgc-white scrollable pos-r" style="min-width:320px">
            <h4 class="fw-300 c-grey-900 mB-40">Login</h4>
            <form action="{{ url('/system/login', []) }}" method="POST">
                @csrf
                <div class="mb-3"><label class="text-normal text-dark form-label">Username</label> <input type="email"
                        class="form-control" placeholder="email@email.com" id="email" name="email"></div>
                <div class="mb-3"><label class="text-normal text-dark form-label">Password</label> <input
                        type="password" class="form-control" name="password" id="password" placeholder="Password"></div>
                <div class="">
                    <div class="peers ai-c jc-sb fxw-nw">
                        <div class="peer">
                            <div class="checkbox checkbox-circle checkbox-info peers ai-c"><input type="checkbox"
                                    id="inputCall1" name="inputCheckboxesCall" class="peer"> <label for="inputCall1"
                                    class="peers peer-greed js-sb ai-c form-label"><span
                                        class="peer peer-greed">Remember Me</span></label></div>
                        </div>
                        <div class="peer"><button class="btn btn-primary btn-color">Login</button></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include('dist.partials.scripts')
</body>

</html>