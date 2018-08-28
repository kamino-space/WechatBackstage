<?php
/**
 * Author: kamino
 * CreateTime: 2018/4/28,下午 05:48
 * Description:
 * Version:
 */

namespace wx;


class wx_ticket {
	private static function newTicket() {
		$url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=" . wx_token::getToken() . "&type=jsapi";
		$wch = new \wcurl( $url );
		while ( true ) {
			if ( $raw = json_decode( $wch->get(), true ) ) {
				break;
			}
		}
		@file_put_contents( ROOT_PATH . "save/wx_ticket.json", json_encode( array(
			$raw["ticket"],
			time()
		) ) );

		return $raw["ticket"];
	}

	static function getTicket() {
		if ( ! file_exists( ROOT_PATH . "save/wx_ticket.json" ) || empty( $f = file_get_contents( ROOT_PATH . "save/wx_ticket.json" ) ) ) {
			return self::newTicket();
		}
		$raw = json_decode( $f, true );
		if ( time() - $raw[1] < 7000 && ! empty( $raw[0] ) ) {

			return $raw[0];
		}

		return self::newTicket();
	}
}