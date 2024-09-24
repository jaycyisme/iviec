<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/fonts/custom-font.js') }}"></script>
<script src="{{ asset('assets/js/pcoded.js') }}"></script>
<script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>
<script>
    @if (session('status'))
        Swal.fire({
            icon: 'info',
            title: 'Thông tin!',
            html: '{!! session("status") !!}'
        });
    @endif
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Thành công!',
            html: '{!! session("success") !!}'
        });
    @endif
</script>