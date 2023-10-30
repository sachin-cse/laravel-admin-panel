<script>
    @if(Session::has('success'))

    toastr.options = {
        "closeButton" : true,
  	    "progressBar" : true
    }

    toastr.success("{{ session('success') }}");

    @endif
    </script>