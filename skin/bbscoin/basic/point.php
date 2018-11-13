<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가


?>

<div class="bbscoin_point">
	<div class="deposit">
		<table cellpadding="0" cellspacing="0" border="0" align="center">
			<tr>
				<td colspan="2">BBSCoin 충전</td>
			</tr>
			<tr>
				<td>BBSCoin 지갑주소</td>
				<td><?=$wallet_address?></td>
			</tr>
			<tr>
				<td>BBSCoin 충전개수</td>
				<td><input type="text" name="bbscoin_dcnt" id="bbscoin_dcnt" value="0" onkeyup="this.value = $.number(this.value)"></td>
			</tr>
			<tr>
				<td>페이먼트 아이디</td>
				<td><input type="text" name="payment_id" id="payment_id" value="<?=$payment_id?>" size="100"></td>
			</tr>
			<tr>
				<td>Transaction Hash</td>
				<td><input type="text" name="transaction_hash" id="transaction_hash" value="" size="100"></td>
			</tr>
			<tr>
				<td colspan="2">
					<div class="bbscoin_btn" id="bbscoin_deposit">충전하기</div>
				</td>
			</tr>
		</table>
	</div>

	<div class="deposit withdraw">
		<table cellpadding="0" cellspacing="0" border="0" align="center">
			<tr>
				<td colspan="2">BBSCoin 환전</td>
			</tr>
			<tr>
				<td>BBSCoin 환전개수</td>
				<td><input type="text" name="bbscoin_wcnt" id="bbscoin_wcnt" value="<?=$member["mb_point"]?>" onkeyup="this.value = $.number(this.value)"></td>
			</tr>
			<tr>
				<td>받을 주소</td>
				<td><input type="text" name="wallet_address" id="wallet_address" value="" size="100"></td>
			</tr>
			<tr>
				<td>Transaction Hash</td>
				<td><div id="thash"></div></td>
			</tr>
			<tr>
				<td colspan="2">
					<div class="bbscoin_btn_red" id="bbscoin_withdraw">환전하기</div>
				</td>
			</tr>
		</table>
	</div>
</div>