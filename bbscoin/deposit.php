<?php
include_once('../common.php');

if (!$is_member){
	$json["result"] = "error";
	$json["msg"] = "로그인 해주세요.";
	echo json_encode($json);
	exit;
}

$deposit["payment_id"] = trim(preg_replace("/[^ABCDEF0123456789]*/s", "", $_REQUEST["dt"]["payment_id"]));
$deposit["bbscoin_dcnt"] = trim(preg_replace("/[^0-9]*/s", "", $_REQUEST["dt"]["bbscoin_dcnt"]));
$deposit["transaction_hash"] = trim(preg_replace("/[^0-9a-zA-Z]*/s", "", $_REQUEST["dt"]["transaction_hash"]));

if($deposit["bbscoin_dcnt"]<=0){
	$json["result"] = "error";
	$json["msg"] = "개수지정이 잘못되었습니다.";
	echo json_encode($json);
	exit;
}


if(strlen($deposit["payment_id"])!=64){
	$json["result"] = "error";
	$json["msg"] = "페이먼트 ID가 잘못되었습니다.";
	echo json_encode($json);
	exit;
}


require './bbscoinapi.php';

// modify transaction_hash
$transaction_hash = $deposit["transaction_hash"];

// ok send to request
$rsp_data = BBSCoinApi::getTransaction('http://127.0.0.1:8070/json_rpc', $transaction_hash);
//echo "<xmp>";
//print_r($rsp_data[result][transaction]);

if(strtolower($rsp_data["result"]["transaction"]["transactionHash"])==strtolower($deposit["transaction_hash"])){

	if(strtolower($rsp_data["result"]["transaction"]["paymentId"])==strtolower($deposit["payment_id"])){
		$cnt = count($rsp_data["result"]["transaction"]["transfers"]);
		for($i=0;$i<$cnt;$i++){
			if($rsp_data["result"]["transaction"]["transfers"][$i]["address"]==$wallet_address){
				if(($rsp_data["result"]["transaction"]["transfers"][$i]["amount"]/100000000)==$deposit["bbscoin_dcnt"]){
					$coin = sql_fetch("select wdate from bbsmoney_deposit where transaction_hash = '".$deposit["transaction_hash"]."' and payment_id = '".$deposit["payment_id"]."'");
					if($coin){
						$json["result"] = "error";
						$json["msg"] = $coin["wdate"]."에 이미 충전 하셨습니다.";
						echo json_encode($json);
						exit;
					}else{
						sql_query("update {$g5['member_table']} set mb_point = mb_point + ".$deposit["bbscoin_dcnt"]." where mb_no = '".$member["mb_no"]."'");
						$sql = "insert into bbsmoney_deposit set mb_no = '".$member["mb_no"]."',payment_id = '".$deposit["payment_id"]."',transaction_hash = '".$deposit["transaction_hash"]."',amount = '".$deposit["bbscoin_dcnt"]."',ip = '".$_SERVER[REMOTE_ADDR]."',wdate = now()";
						sql_query($sql);

						$json["result"] = "ok";
						$json["msg"] = "충전이 정상적으로 완료되었습니다.";
						echo json_encode($json);
						exit;
					}
				}else{
					$json["result"] = "error";
					$json["msg"] = "충전금액이 정확치 않습니다. 확인해주세요.";
					echo json_encode($json);
					exit;
				}
			}
		}
	}else{
		$json["result"] = "error";
		$json["msg"] = "페이먼트 ID가 잘못되었습니다..".$deposit["payment_id"].":".$rsp_data["result"]["transaction"]["paymentId"];
		echo json_encode($json);
		exit;
	}
}else{
	$json["result"] = "error";
	$json["msg"] = "해당 transaction hash 가 없습니다.";
	echo json_encode($json);
	exit;
}
?>
