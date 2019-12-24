@if (Session::has('sweet_alert.alert'))
    <script>
        Swal.mixin({!! Session::pull('sweet_alert.alert') !!}).fire();
    </script>
@endif
