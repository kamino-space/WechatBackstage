<?php
/**
 * Author: kamino
 * CreateTime: 2018/4/28,下午 06:12
 * Description:
 * Version:
 */

namespace wx;


class wx_jsapi {
	private $str = array();

	function __construct() {
		$this->str["noncestr"]     = $this->getNon( 10 );
		$this->str["jsapi_ticket"] = wx_ticket::getTicket();
		$this->str["timestamp"]    = time();
		$this->str["url"]          = WWW_URL;
	}

	function getSignature() {
		ksort( $this->str );

		return sha1( urldecode( http_build_query( $this->str ) ) );
	}

	function getTimestamp() {
		return $this->str["timestamp"];
	}

	function getNoncestr() {
		return $this->str["noncestr"];
	}

	function getUrl() {
		return $this->str["url"];
	}

	private function getNon( $len = 0 ) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$non   = "";
		for ( $i = 0; $i < $len; $i ++ ) {
			$non .= $chars[ rand( 0, strlen( $chars ) - 1 ) ];
		}

		return $non;
	}
}