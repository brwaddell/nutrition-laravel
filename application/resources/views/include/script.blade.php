
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
<!-- <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script> -->
<script type="text/javascript" src="{{ asset('otherjs/datatables.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('otherjs/pdfmake.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('otherjs/vfs_fonts.js') }}"></script>
<script type="text/javascript" src="{{ asset('otherjs/colvis_datatable.min.js') }}"></script>

<script src="{{ asset('all.js') }}"></script>
<script src="{{ asset('otherjs/toastr.min.js') }}"></script>


@if(Session::has('success'))
{!! Toastr::message() !!}
@endif
<!-- Stack array for including inline js or scripts -->
@stack('script')

<script src="{{ asset('otherjs/pace.min.js') }}"></script>
<script src="{{ asset('dist/js/theme.js') }}"></script>
<script src="{{ asset('otherjs/chat.js') }}"></script>
<script src="{{asset('otherjs/live-img.js')}}"></script>
<script src="{{asset('otherjs/time.js')}}"></script>

<script>
    function deleteConfirmation(){
   return confirm('Are you sure?');
}

function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>
