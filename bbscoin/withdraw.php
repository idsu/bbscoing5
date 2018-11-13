<?php
include_once('../common.php');

if (!$is_member){
	$json["result"] = "error";
	$json["msg"] = "로그인 해주세요.";
	echo json_encode($json);
	exit;
}

$deposit["bbscoin_wcnt"] = trim(preg_replace("/[^0-9]*/s", "", $_REQUEST["dt"]["bbscoin_wcnt"]));
$deposit["wallet_address"] = trim(preg_replace("/[^0-9a-zA-Z]*/s", "", $_REQUEST["dt"]["wallet_address"]));

if($deposit["bbscoin_wcnt"]<=0){
	$json["result"] = "error";
	$json["msg"] = "개수지정이 잘못되었습니다.";
	echo json_encode($json);
	exit;
}


if($member["mb_point"]<$deposit["bbscoin_wcnt"]){
	$json["result"] = "error";
	$json["msg"] = "환전 하시려는 코인의 개수가 보유하신 코인보다 많습니다.";
	echo json_encode($json);
	exit;
}


require './bbscoinapi.php';


$from_wallet = $wallet_address;
$to_wallet = $deposit["wallet_address"];
$amount = $deposit["bbscoin_wcnt"] * 100000000;//1개

// ok send to request
$rsp_data = BBSCoinApi::sendTransaction('http://127.0.0.1:8070/json_rpc', $from_wallet, $amount, $to_wallet);

if($rsp_data["error"]){
	$json["result"] = "error";
	$json["msg"] = $rsp_data["error"]["message"];
	echo json_encode($json);
	exit;
}else{

	sql_query("update {$g5['member_table']} set mb_point = mb_point - ".$deposit["bbscoin_wcnt"]." where mb_no = '".$member["mb_no"]."'");
	$sql = "insert into bbsmoney_withdraw set mb_no = '".$member["mb_no"]."',wallet_address = '".$deposit["wallet_address"]."',transaction_hash = '".$rsp_data["result"]["transactionHash"]."',amount = '".$deposit["bbscoin_wcnt"]."',ip = '".$_SERVER[REMOTE_ADDR]."',wdate = now()";
	sql_query($sql);

	$json["result"] = "ok";
	$json["hash"] = $rsp_data["result"]["transactionHash"];
	$json["msg"] = "신청이 완료되었습니다.";
	echo json_encode($json);
	exit;
}
?>
