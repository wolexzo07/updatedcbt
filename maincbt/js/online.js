function load(page) {
	$("#calculate").show();
     $("#calculate").fadeIn(400).html('<center><img src="images/load_1.gif" /></center>');
	$.ajax({
		type	: 'GET',
		url		: page,
		success	: function(data) {
			try {
				$('#calculate').html(data);
			} catch (err) {
				alert(err);
			}
		}
	});
}
