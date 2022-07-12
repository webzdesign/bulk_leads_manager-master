<script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('public/assets/js/jquery.slim.min.js') }}"></script>

<script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('public/assets/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('public/assets/js/validate.min.js') }}"></script>
<script src="{{ asset('public/assets/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('public/assets/js/jquery.dataTables.min.js') }}"></script>

<script src="{{ asset('public/assets/js/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/assets/js/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/assets/js/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('public/assets/js/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/assets/js/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('public/assets/js/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script defer src="{{ asset('public/assets/js/main.js') }}"></script>
<script src="https://code.jquery.com/jquery-migrate-1.4.1.min.js"></script>

<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        });
    });
</script>
