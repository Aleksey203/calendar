
$(document).ready(function () {
	$('body').on('click', '#salonRegistration', function() {
		$('.popUpBg, .popUp').removeClass('none')
		var salonReg = $('#salonTitle').text()
		console.log(salonReg)
		$('#salonName').text(salonReg)
	})
})