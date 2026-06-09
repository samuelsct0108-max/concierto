<script src="{{ asset('admin-boostrap-5/js/admin-boostrap5.js') }}"></script>
<script defer="defer" src="{{ asset('admin-boostrap-5/main.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
@if (session()->has('success'))
    <script>
        setTimeout(() => {swal("Good job!", "{{session('success')}}", "success")}, 1500);
    </script>
    @php
        session()->forget('success')
    @endphp
@endif
@if (session()->has('error'))
    <script>
        setTimeout(() => {swal("Upss!", "{{session('error')}}", "info")}, 1500);
    </script>
@endif