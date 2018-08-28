<?php
/**
 * Author: kamino
 * CreateTime: 2018/4/27,下午 01:58
 * Description:
 * Version:
 */

namespace wx;


class wx_check {
	public function valid() {
		$echoStr = $_GET["echostr"];

		if ( $this->checkSignature() ) {
			echo $echoStr;
			exit;
		}
	}

	private function checkSignature() {
		$signature = $_GET["signature"];
		$timestamp = $_GET["timestamp"];
		$nonce     = $_GET["nonce"];

		$token  = WX_TOKEN;
		$tmpArr = array( $token, $timestamp, $nonce );
		sort( $tmpArr );
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );

		if ( $tmpStr == $signature ) {
			return true;
		} else {
			return false;
		}
	}
}