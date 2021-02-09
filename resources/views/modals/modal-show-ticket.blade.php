<div class="modal fade modal-success modal-save" id="ticketInfo" role="dialog" aria-labelledby="ticketInfoLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Show ticket info
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">close</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="p-name"></p>
                <p class="p-contact"></p>
                <p class="p-subject"></p>
                <p class="p-description"></p>
                <p class="p-key"></p>
                <p class="p-status"></p>
                <p class="p-rep"></p>
            </div>
            <div class="modal-footer">
                {!! Form::button('<i class="fa fa-fw '.trans('modals.confirm_modal_button_cancel_icon').'" aria-hidden="true"></i> ' . trans('close'), array('class' => 'btn btn-outline pull-left btn-flat', 'type' => 'button', 'data-dismiss' => 'modal' )) !!}
            </div>
        </div>
    </div>
</div>
