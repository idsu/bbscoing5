<?php
include_once('../common.php');

//$co_id = preg_replace('/[^a-z0-9_]/i', '', $co_id);


$g5['title'] = "bbscoin 환전";


include_once('../_head.php');

$bbs = sql_fetch("select * from bbsmoney_user where mb_no = '".$member["mb_no"]."'");
if($bbs){
	$payment_id = $bbs[payment_id];
}else{
	$len = 64;
	$xchars = 'ABCDEF0123456789'; 
	$maxPos = strlen($xchars);
    for ($i = 0; $i < $len; $i++) {
        $payment_id .= $xchars[rand(0,$maxPos-1)];
    }

	sql_query("insert into bbsmoney_user set mb_no = '".$member["mb_no"]."',payment_id = '$payment_id'");
}

$row = sql_fetch("select count(*) as cnt from bbsmoney_withdraw where mb_no = '".$member["mb_no"]."'");
$total_count = $row["cnt"];

$i=0;
$result = sql_query("select * from bbsmoney_withdraw where mb_no = '".$member["mb_no"]."' order by no desc");
while ($row = sql_fetch_array($result)){
	$list[$i] = $row;
	$i++;
}


$page_rows = 1;
$list_page_rows = 1;


$bbs_skin_path = get_skin_path('bbscoin', "basic");
$bbs_skin_url  = get_skin_url('bbscoin', "basic");


add_stylesheet('<link rel="stylesheet" href="'.$bbs_skin_url.'/style.css">', 0);
add_javascript('<script src="'.$bbs_skin_url.'/jquery.number.min.js"></script>', 0);
add_javascript('<script src="'.$bbs_skin_url.'/bbsmoney.js"></script>', 0);
$skin_file = $bbs_skin_path.'/withdraw_list.php';

?>

<?php
if(is_file($skin_file)) {
    include($skin_file);
} else {
    echo '<p>'.str_replace(G5_PATH.'/', '', $skin_file).'이 존재하지 않습니다.</p>';
}

include_once('../_tail.php');
?>
