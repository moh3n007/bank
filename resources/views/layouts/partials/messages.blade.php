@if(session()->has('alert') and sizeof(session()->get('alert')) > 0)
    @php($key = key(session()->get('alert')))
    <div id="admin-error-modal" class="modal modal-{{$key}} fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-1"></div>
                        <div class="col-xs-10">
                            <p style="text-align: center">{{session()->get('alert.'.$key)}}</p>
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