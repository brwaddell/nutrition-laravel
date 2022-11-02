 @stack('modal')

 <!--Add Contact Us  Modal -->
 <div class="modal fade" id="Contactadmin" tabindex="-1" >
    <div class="modal-dialog large-model modal-dialog-centered">
        <div class="modal-content container">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="primary-form">
                <h2 class="form-title mb-25">{{ __('Contact with the Admin') }}</h2>
                <form action="{{ route('send.message') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="Subject">{{ __('Subject') }}</label>
                                <input type="text" class="form-control" id="Subject" name="subject" placeholder="Alexander" />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="Message">{{ __('Message') }}</label>
                                <textarea class="form-control message-box" id="Message" rows="3" name="message" placeholder="Write reason"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group attach-file">
                                <label>{{ __('Attach File') }}</label>
                                <label for="Attach" class="Attach-file-info">
                                    <h4>{{ __('Drop file to attach or') }} <span>{{ __('Browse') }}</span></h4>
                                    <p>{{ __('Maximum file size 20 MB') }}</p>
                                </label>
                                <input type="file" class="form-control" id="Attach" name="attachment" />
                            </div>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <button type="submit" class="primary-btn-lg btn-rounded">{{ __('Send') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Add Contact Us  Modal -->
        <script src="{{ asset('front/assets/js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('front/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('front/assets/js/plugins.js') }}"></script>
        <script src="{{ asset('front/assets/js/main.js') }}"></script>
        <script src="{{ asset('otherjs/toastr.min.js') }}"></script>


@if(Session::has('success'))
{!! Toastr::message() !!}
@endif

@stack('scripts')

<script>
    function deleteConfirmation(){
    return confirm('Are you sure?');
}


function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 46 || charCode > 57)) {

            return false;
        }
        return true;
    }
</script>
