

<script src="/js/app.js"></script>

<script src="/js/toastr.min.js"></script>

<script>
     @if(Session::has('message'))

    var type = "{{ Session::get('alert-type', 'info') }}";
    toastr.options.closeButton = true;
    switch (type) {
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @endif
</script>

@if (!empty($errors) && count($errors) > 0)

    @foreach ($errors->all() as $error)

        <script>
            toastr.warning("{{$error}}");
        </script>

    @endforeach

@endif