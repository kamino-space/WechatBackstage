<?php
/**
 * Author: kamino
 * CreateTime: 2018/4/26,下午 11:43
 * Description:
 * Version:
 */

namespace wx;


class wx_token {
	private static $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . WX_APPID . "&secret=" . WX_SECRET;
	private static $timeout = 7000;

	private static function newToken() {
		$wch = new \wcurl( self::$url );
		while ( true ) {
			if ( ! empty( $json = $wch->get() ) ) {
				break;
			}
		}
		$raw = json_decode( $json, true );
		@file_put_contents( ROOT_PATH . "save/wx_token.json", json_encode( array(
			$raw["access_token"],
			time()
		) ) );

		return $raw["access_token"];
	}

	static function getToken() {
		if ( ! file_exists( ROOT_PATH . "save/wx_token.json" ) || empty( $f = file_get_contents( ROOT_PATH . "save/wx_token.json" ) ) ) {
			return self::newToken();
		}
		$raw = json_decode( $f, true );
		if ( time() - $raw[1] < self::$timeout && ! empty( $raw[0] ) ) {

			return $raw[0];
		}

		return self::newToken();
	}

}