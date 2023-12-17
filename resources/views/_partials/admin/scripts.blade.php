<!-- jQuery -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/js/theme.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<!-- Date Dropper -->
<script src="{{ asset('assets/js/datedropper.min.js') }}"></script>
<!-- Select 2 -->
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<!-- Main Js -->
<script src="{{ asset('js/main.js') }}"></script>
<!-- parsley js -->
<script type="text/javascript" src="{{ asset('assets/js/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('install/js/growl.min.js') }}"></script>
<!-- Drophify -->
<script type="text/javascript" src="{{ asset('assets/js/drophify.min.js') }}"></script>
<!-- Sweet Alert -->
<script type="text/javascript" src="{{asset('assets/js/sweetalert.min.js')}}"></script>
<!-- Toastr -->
<script src="{{ asset('assets/js/toastr.min.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function notify(message, type){
        $.growl({
            message: message
        },{
            type: type,
            allow_dismiss: true,
            label: 'Cancel',
            className: 'btn-xs btn-inverse',
            placement: {
                from: "top",
                align: "right"
            },
            delay: 5000,
            animate: {
                    enter: 'animated fadeInRight',
                    exit: 'animated fadeOutRight'
            },
            offset: {
                x: 30,
                y: 30
            }
        });
    };

    $(document).ready(function() {
        setInterval(timestamp, 1000);
    });

    function timestamp() {
        var time = '{{ formatDate(date('Y-m-d h:i:s')) }}';
        $('#timestamp').html(time);
    }

    toastr.options = {
//   "closeButton": false,
//   "debug": false,
//   "newestOnTop": false,
//   "progressBar": false,
//   "positionClass": "toast-top-right",
  "preventDuplicates": true,
//   "onclick": null,
//   "showDuration": "300",
//   "hideDuration": "1000",
//   "timeOut": "5000",
//   "extendedTimeOut": "1000",
//   "showEasing": "swing",
//   "hideEasing": "linear",
//   "showMethod": "fadeIn",
//   "hideMethod": "fadeOut"
}
</script>
@stack('admin.scripts')