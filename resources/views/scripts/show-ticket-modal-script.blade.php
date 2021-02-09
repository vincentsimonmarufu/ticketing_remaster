<script type="text/javascript">

	// SHOW TICKET MODAL
	$('#ticketInfo').on('show.bs.modal', function (e) {
        var name = $(e.relatedTarget).attr('data-name');
        var subject = $(e.relatedTarget).attr('data-subject');
        var contact = $(e.relatedTarget).attr('data-contact');
        var description = $(e.relatedTarget).attr('data-description');
        var key = $(e.relatedTarget).attr('data-key');
        var status = $(e.relatedTarget).attr('data-status');
        var rep = $(e.relatedTarget).attr('data-rep');
        var title = $(e.relatedTarget).attr('data-title');
        $(this).find('.modal-body p.p-name').text('Name:  ' + name);
        $(this).find('.modal-body p.p-contact').text('Contact:  ' + contact);
        $(this).find('.modal-body p.p-subject').text('Subject:  ' + subject);
        $(this).find('.modal-body p.p-description').text('Description:  ' + description);
        $(this).find('.modal-body p.p-key').text('Key:  ' + key);
        $(this).find('.modal-body p.p-status').text('Status:  ' + status);
        $(this).find('.modal-body p.p-rep').text('Date Reported:  ' + rep);
		$(this).find('.modal-title').text(title);
	});

</script>