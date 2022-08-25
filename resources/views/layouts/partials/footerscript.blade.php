<script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>
{{-- <script src="{{ asset('public/assets/js/jquery.slim.min.js') }}"></script> --}}

<script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('public/assets/js/validate.min.js') }}"></script>
<script src="{{ asset('public/assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/assets/js/dataTables.bootstrap5.min.js') }}"></script>

<script src="{{ asset('public/assets/js/jquery.custom.selectbox.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script defer src="{{ asset('public/assets/js/main.js') }}"></script>
<script src="https://code.jquery.com/jquery-migrate-1.4.1.min.js"></script>
<script src="{{ asset('public/assets/js/bootstrap-datepicker.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        });
    });
</script>
