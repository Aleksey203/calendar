
$(document).ready(function () {
	$('body').on('click', '#salonRegistration', function() {
		$('.popUpBg, .popUp').removeClass('none')
		var salonReg = $('#salonTitle').text()
		console.log(salonReg)
		$('#salonName').text(salonReg)
	});

    //$('.newService').live('click', function() {
    $('body').on('click', '.newService', function() {
        var master_id = $('.master.checked').data('master-id');
        var count = $('#shed_pat_count_id').val();
        var after = $('#shed_pat_after_id').val();
        var date = $('input[name="shed_date"]').val();
        var start_time = $('#shed_pat_time_start_id').val();
        var end_time = $('#shed_pat_time_end_id').val();
        var week_count = $('select[name="shed_pat_week_count"]').val();
        $.ajax({
            url: '/site/submit/',
            type: 'POST',
            dataType: 'json',
            data: {
                master_id: master_id,
                count: count,
                after: after,
                date: date,
                week_count: week_count,
                start_time: start_time,
                end_time: end_time
            },
            success: function(data) {
                if (data.success) {
                    $('#schedule').fullCalendar('refetchEvents');
                } else {
                    alert(data.data);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
        return false;
    });
});