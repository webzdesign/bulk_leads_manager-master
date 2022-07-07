<script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('public/assets/js/jquery.slim.min.js') }}"></script>
<script src="{{ asset('public/assets/js/main.js') }}"></script>
<script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('public/assets/js/validate.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        });
    });
</script>
