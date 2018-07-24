@if (Session::has('sweet_alert.alert'))
    <script>
        @if (Session::has('sweet_alert.content'))
            var config = {!! Session::pull('sweet_alert.alert') !!}
            config.content = document.createElement('div').innerHtml = config.content;
            swal(config);
        @else
            swal({!! Session::pull('sweet_alert.alert') !!});
        @endif
    </script>
@endif
