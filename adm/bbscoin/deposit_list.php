<?php
$sub_menu = "909100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

if ($is_admin != 'super')
    alert('최고관리자만 접근 가능합니다.');



$g5['title'] = '충전 리스트';
include_once (G5_ADMIN_PATH.'/admin.head.php');

$sql_common = " from bbsmoney_deposit a left join {$g5['member_table']} b on a.mb_no = b.mb_no ";

$sql_where = " where (1)";


if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case "a.mb_nick" :
            $sql_search .= " ($sfl = '$stx') ";
            break;
        default :
            $sql_search .= " ($sfl = '$stx') ";
            break;
    }
    $sql_search .= " ) ";
}


// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common.$sql_where.$sql_search;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = "select * $sql_common $sql_where $sql_search order by no asc limit $from_record, {$config['cf_page_rows']} ";
$result = sql_query($sql);

?>

<div class="local_ov01 local_ov">
    <?php if ($page > 1) {?><a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>">처음으로</a><?php } ?>
    <span class="btn_ov01"><span class="ov_txt">전체 내용</span><span class="ov_num"> <?php echo $total_count; ?>건</span></span>
</div>


<form name="fsearch" id="fsearch" class="local_sch01 local_sch" method="get">

<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="b.mb_id"<?php echo get_selected($_GET['sfl'], "b.mb_id", true); ?>>아이디</option>
    <option value="b.mb_nick"<?php echo get_selected($_GET['sfl'], "b.mb_nick", true); ?>>닉네임</option>
    <option value="a.payment_id"<?php echo get_selected($_GET['sfl'], "a.payment_id", true); ?>>페이먼트 아이디</option>
    <option value="a.transaction_hash"<?php echo get_selected($_GET['sfl'], "a.transaction_hash", true); ?>>Transaction Hash</option>
</select>
<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
<input type="submit" value="검색" class="btn_submit">

</form>

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col">아이디</th>
        <th scope="col">닉네임</th>
        <th scope="col">페이먼트 아이디</th>
        <th scope="col">Transaction Hash</th>
        <th scope="col">개수</th>
        <th scope="col">아이피</th>
        <th scope="col">날짜</th>
    </tr>
    </thead>
    <tbody>
    <?php for ($i=0; $row=sql_fetch_array($result); $i++) {
        $bg = 'bg'.($i%2);
		if($row['sdate']<date("Y-m-d H:i:s") && $row['edate']>date("Y-m-d H:i:s")){
			
		}else{
			$enddate = "1";
		}
    ?>
    <tr class="<?php echo $bg; ?>">
        <td class="td_left"><?php echo $row['mb_id']; ?></td>
        <td class="td_left"><?php echo $row['mb_nick']; ?></td>
        <td class="td_left"><?php echo $row['payment_id']; ?></td>
        <td class="td_left"><?php echo $row['transaction_hash']; ?></td>
        <td class="td_left"><?php echo number_format($row['amount']); ?></td>
        <td class="td_left"><?php echo $row['ip']; ?></td>
        <td class="td_left"><?php echo $row['wdate']; ?></td>

    </tr>
    <?php
    }
    if ($i == 0) {
        echo '<tr><td colspan="10" class="empty_table">자료가 한건도 없습니다.</td></tr>';
    }
    ?>
    </tbody>
    </table>
</div>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
