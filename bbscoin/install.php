<?php
include_once('../common.php');

// 운영자가 아니면
if (!$is_admin) {
    echo "<script type=\"text/javascript\">";
    echo "  alert('요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.');";
    //echo "  location.href='/';";
    echo "</script>";
    exit;
}

// 테이블 생성
$sql = " CREATE TABLE `bbsmoney_deposit` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `mb_no` int(11) NOT NULL DEFAULT '0',
  `payment_id` varchar(64) NOT NULL DEFAULT '',
  `transaction_hash` varchar(100) NOT NULL DEFAULT '',
  `amount` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(255) NOT NULL DEFAULT '',
  `wdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 ";

sql_query($sql, false);

$sql = "CREATE TABLE `bbsmoney_user` (
  `mb_no` int(11) NOT NULL DEFAULT '0',
  `payment_id` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`mb_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
sql_query($sql, false);

$sql = "CREATE TABLE `bbsmoney_withdraw` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `mb_no` int(11) NOT NULL DEFAULT '0',
  `wallet_address` varchar(255) NOT NULL DEFAULT '',
  `transaction_hash` varchar(100) NOT NULL DEFAULT '',
  `amount` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(255) NOT NULL DEFAULT '',
  `wdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
";
sql_query($sql, false);


echo "<script type=\"text/javascript\">";
echo "  alert('테이블 추가 완료되었습니다.');";
echo "  location.href='./';";
echo "</script>";
?>