<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가


// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

?>

<!-- 게시판 목록 시작 { -->
<div id="bo_list" style="width:<?php echo $width; ?>">

    <div class="tbl_head01 tbl_wrap">
        <table>
        <caption><?php echo $board['bo_subject'] ?> 목록</caption>
        <thead>
        <tr>
            <th scope="col">지갑주소</th>
            <th scope="col">Transaction Hash</th>
            <th scope="col">개수</th>
            <th scope="col">IP</th>
            <th scope="col">등록일</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i=0; $i<count($list); $i++) {
         ?>
        <tr>
            <td><?php echo $list[$i]['wallet_address'] ?></td>
            <td><a href="https://explorer.bbscoin.xyz/?hash=<?php echo $list[$i]['transaction_hash'] ?>#blockchain_transaction" target="_blank"><?php echo $list[$i]['transaction_hash'] ?></a></td>
            <td><?php echo $list[$i]['amount'] ?></td>
            <td><?php echo $list[$i]['ip'] ?></td>
            <td><?php echo $list[$i]['wdate'] ?></td>
        </tr>
        <?php } ?>
        <?php if (count($list) == 0) { echo '<tr><td colspan="'.$colspan.'" class="empty_table">게시물이 없습니다.</td></tr>'; } ?>
        </tbody>
        </table>
    </div>

</div>




<!-- 페이지 -->
<?php echo $write_pages;  ?>
