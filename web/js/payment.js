$(document).ready(function () {
	var tarif, tarifId, price, pack

	$('.tablePrice').click(function(){
		$('.tablePrice').removeClass('active')
		$(this).addClass('active')

		tarif = $(this).attr('data-tarif')
		tarifId = $(this).attr('data-tarif-id')
		price = $(this).attr('data-price')
		pack = $(this).attr('data-pack')
		$('.payment #prepay').html('Тариф ' + tarif + '<br>на срок' + pack + ' мес. <br>Цена:' + price + 'руб.' )
        $('.payment #invoice-amount').val(price);
	})

	$('#payment').click(function() {
	$('.popUp, .popUpBg').removeClass('none');
	$('#howPay').text(price + ' руб');
	$('#whatPay').text('Тариф: ' + tarif);
    $('#invoice-amount').val(price);
    $('#invoice-type').val(tarif);

})
})



