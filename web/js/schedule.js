$(function () {
    $(document).on("click", ".master", function() {
        $('.master').removeClass('checked');
        $(this).addClass('checked');

		$('#schedule').fullCalendar('refetchEvents');
    });
	
    //$(document).on('click', '.fc-day', function() {
    $(document).on('click', '.fc-day-number', function() {
		var date = $(this).data('date');
		
        $('body').append('<div class="graphCloser"></div>');
        var newBlock = '<div class="popUpWork"><a href="" class="doWork js-full-work">Полный день</a><a href="" class="doWork js-holiday">Выходной</a><div class="workTime"><label><select id="work_starts_to" class="datetime"><option value="00:00:00">00:00</option><option value="01:00:00">01:00</option><option value="02:00:00">02:00</option><option value="03:00:00">03:00</option><option value="04:00:00">04:00</option><option value="05:00:00">05:00</option><option value="06:00:00">06:00</option><option value="07:00:00">07:00</option><option value="08:00:00">08:00</option><option value="09:00:00" selected >09:00</option><option value="10:00:00">10:00</option><option value="11:00:00">11:00</option><option value="12:00:00">12:00</option><option value="13:00:00">13:00</option><option value="14:00:00">14:00</option><option value="15:00:00">15:00</option><option value="16:00:00">16:00</option><option value="17:00:00">17:00</option><option value="18:00:00">18:00</option><option value="19:00:00">19:00</option><option value="20:00:00">20:00</option><option value="21:00:00">21:00</option><option value="22:00:00">22:00</option><option value="23:00:00">23:00</option></select><select id="work_starts_at" class="datetime"><option value="00:00:00">00:00</option><option value="01:00:00">01:00</option><option value="02:00:00">02:00</option><option value="03:00:00">03:00</option><option value="04:00:00">04:00</option><option value="05:00:00">05:00</option><option value="06:00:00">06:00</option><option value="07:00:00">07:00</option><option value="08:00:00">08:00</option><option value="09:00:00">09:00</option><option value="10:00:00">10:00</option><option value="11:00:00">11:00</option><option value="12:00:00">12:00</option><option value="13:00:00">13:00</option><option value="14:00:00">14:00</option><option value="15:00:00">15:00</option><option value="16:00:00">16:00</option><option value="17:00:00">17:00</option><option value="18:00:00">18:00</option><option value="19:00:00" selected >19:00</option><option value="20:00:00">20:00</option><option value="21:00:00">21:00</option><option value="22:00:00">22:00</option><option value="23:00:00">23:00</option></select></label></div><div class="btn save js-save" >Сохранить</div></div>'
        newBlock = $(newBlock);
		
		newBlock.find('.js-full-work').on('click', function(e){
			e.preventDefault();
			schedule.updateDay($('.master.checked').data('master-id'), date, 0, openDayStartTime, openDayEndTime);
		});
		newBlock.find('.js-holiday').on('click', function(e){
			e.preventDefault();
			schedule.updateDay($('.master.checked').data('master-id'), date, 1);
		});
		newBlock.find('.js-save').on('click', function(){
			schedule.updateDay($('.master.checked').data('master-id'), date, 0, $('#work_starts_to').val(), $('#work_starts_at').val());
		});
		
		$('body').append(newBlock);
   }); 

	$('#schedule').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,basicWeek,basicDay'
		},
		firstDay: 1,
		events: {
			url: '/site/feed/',
			type: 'POST',
			data: function() { // a function that returns an object
				return {
					master_id: $('.master.checked').data('master-id')
				};
			},
			error: function() {
				alert('there was an error while fetching events!');
			},
			color: '#00A8FF',   // a non-ajax option
			textColor: 'white' // a non-ajax option
		},
		dayRender: function(date, cell){
			cell.addClass('day');

			var span = $('<span/>', {
				'text': date.date()
			});
			cell.append(span);
            var div = $('<div/>', {
                'text': date.date()
            });
            //cell.append(div);
		},
	});

});

var schedule = {
	updateDay: function(master_id, date, holiday, start_time, end_time){
        var urlUpdateDay = '/site/update-day/';
		$.ajax({
			url: urlUpdateDay,
			type: 'POST',
			dataType: 'json',
			data: {
				master_id: master_id,
				date: date,
				holiday: holiday,
				start_time: start_time,
				end_time: end_time
			},
			success: function(data) {
				if (data.success) {
					$('#schedule').fullCalendar('refetchEvents');
					$('.popUpWork').remove();
					$('.graphCloser').remove();
				} else {
					alert(data.data);
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert(errorThrown);
			}
		});
	}
};
