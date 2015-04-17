$(document).ready(function () {

    $(".js-input-telephone, #profile-telephone").mask("+7 (999) 999-9999");
    $('#client-birthday, #master-birthday, #profile-birthday').mask("99.99.9999");

	$(document).on("click", ".newCal .fc-day", function () {
		$('.popUp, .popUpBg').removeClass('none');
		$('.dateCalPopUp').text($(this).attr('data-date'))
		$('.dateCalPopUp').parent().find('input[name="date"]').val($(this).attr('data-date'))
	})

	$(document).on("click", ".openPopUp", function () {
		$('.popUp, .popUpBg').removeClass('none');
	})

	$(document).on("click", ".popUpBg, .cancelFiles", function () {
		$('.popUp, .popUpBg').addClass('none');
	})

	$(document).on('click', '.calendar-header a', function (e) {
		var href = this.href;
		e.preventDefault();
		$.ajax({
			url: href,
			type: "get",
			dataType: 'script'
		})
	});

	$(function() {
	    $( "#tabs" ).tabs();
	  });
});


var timer = 0;
var price = 0;

var monthNames = ["января", "февраля", "марта", "апреля", "мая", "июня", "июля", "августа", "сентября", "октября", "ноября", "декабря"]
var dayNames = ["в понедельник", "во вторник", "в среду", "в четверг", "в пятницу", "в субботу", "в воскресенье"]

$(document).ready(function () {

	$('#transaction_form input[name=supplier_type]').change(function(){var type=$(this).val();$('.supplier_type').addClass('hide');$('.supplier_type'+type).removeClass('hide');});
	$(window).load(function () {
		$(".frame__content, .list, .masters").mCustomScrollbar({});
		$('.loader').addClass('none')
	});

	$('#whatPromo').change(function () {
		var PromoText = $("#whatPromo option:selected").attr('data-Value');
		console.log(PromoText)
		$('textarea').val(PromoText)
	})



	$('.sideBarNav .tab1, .sideBarNav .tab2, .sideBarNav .tab3, .sideBarNav .tab4').click(function () {
		$('.menu .tabs').addClass('none')
		$('.sideBarNav li').removeClass('active')
		var whatClass = $(this).attr('class')
		$('.' + whatClass).addClass('active')
		$('.' + whatClass).removeClass('none')
		$(".menu").mCustomScrollbar({
		});
	})

	$(document).on("click", ".graphCloser", function () {
		$('.popUpWork').remove()
		$(this).remove()
	})

	
	var clientsCount = function() {
		var newClientsCount = $('#newClients li').length
		if (newClientsCount == 0) {
				$('.tab3 span ').remove()
			}
		$('.tab3 span ').text(newClientsCount)
	}

	var calendarCount = function() {
		var newClientsCount = $('#newCal li').length
		if (newClientsCount == 0) {
				$('.tab4 span ').remove()
			}
		$('.tab4 span ').text(newClientsCount)
	}

	clientsCount()
	calendarCount()


	$('.menu ul ul .active').parents('ul').addClass('block')
	$('.menu ul ul .active').parents('ul').siblings('span').addClass('open')

	$(document).on("click", ".menu li span", function () {
		$(this).next().toggleClass('block')
		$(this).toggleClass('open')
	})
});
