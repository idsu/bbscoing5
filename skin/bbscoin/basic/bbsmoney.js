function bbsmoney_deposit_fun(){
	var dt = {tp:"deposit"};
	dt["payment_id"]	= $("#payment_id").val();
	dt["bbscoin_dcnt"]	= $("#bbscoin_dcnt").val();
	dt["transaction_hash"]	= $("#transaction_hash").val();
	$.ajax({
		type: "POST",
		url: g5_url+"/bbscoin/deposit.php",
		data: {
			dt			
		},
		dataType: "json",
		async: false,
		cache: false,
		success: function(data, textStatus) {
			if(data.result=="error"){
				alert(data.msg);
			}else{
				alert(data.msg);
				$("#bbscoin_dcnt").val(0)
				$("#transaction_hash").val("")
			}
		}
	});
}

function bbsmoney_withdraw_fun(){
	var dt = {tp:"withdraw"};
	dt["bbscoin_wcnt"]	= $("#bbscoin_wcnt").val();
	dt["wallet_address"]	= $("#wallet_address").val();
	$.ajax({
		type: "POST",
		url: g5_url+"/bbscoin/withdraw.php",
		data: {
			dt			
		},
		dataType: "json",
		async: false,
		cache: false,
		success: function(data, textStatus) {
			if(data.result=="error"){
				alert(data.msg);
			}else{
				alert(data.msg);
				$("#bbscoin_wcnt").val(0)
				$("#wallet_address").val("")
				$("#thash").html(data.hash)
			}
		}
	});
}



$( document ).ready(function() {
	$("#bbscoin_deposit").click(function(){
		bbsmoney_deposit_fun();
	});
	$("#bbscoin_withdraw").click(function(){
		bbsmoney_withdraw_fun();
	});
});

