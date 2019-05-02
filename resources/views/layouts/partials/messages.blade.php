@if(session()->has('flash_message'))

    <div id="admin-error-modal" class="modal modal-{{session('flash_message_type')}} fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-1"></div>
                        <div class="col-xs-10">
                            <p style="text-align: center">{{session('flash_message')}}</p>
                        </div>
                        <div class="col-xs-1">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endif