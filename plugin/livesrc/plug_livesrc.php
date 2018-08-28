<?php
/**
 * Author: kamino
 * CreateTime: 2018/5/12,下午 05:03
 * Description:
 * Version:
 */

class plug_livesrc_class {
	private $url;
	private $qua;
	private $lid;
	private $rid;
	private $info;
	private $src = array();

	function __construct( $url = "", $quality = 4 ) {
		$this->url = $url;
		$this->qua = $quality;
	}

	function R() {
		$this->getLiveId()->getRoomId()->getRoomInfo()->getPlayUrl();
		if ( ! count( $this->src ) > 0 ) {
			return "失败了啊, 请重试或联系主体老哥";
		}
		$msg = "标题: " . $this->info . PHP_EOL;
		$msg .= "质量: " . $this->qua . PHP_EOL;
		$msg .= "地址: " . PHP_EOL;
		$msg .= implode( PHP_EOL, $this->src ) . PHP_EOL;
		$msg .= "建议使用curl下载视频";

		return $msg;
	}

	private function getLiveId() {
		$str = "/[1-9]\d*/";
		preg_match( $str, $this->url, $match );
		$this->lid = $match[0];

		return $this;
	}

	private function getRoomId() {
		if ( $obj = $this->get( "https://api.live.bilibili.com/room/v1/Room/room_init?id=" . $this->lid ) ) {
			$this->rid = $obj["data"]["room_id"];
		}

		return $this;
	}

	private function getRoomInfo() {
		if ( $obj = $this->get( "https://api.live.bilibili.com/room/v1/Room/get_info?room_id={$this->rid}&from=room" ) ) {
			$this->info = $obj["data"]["title"];
		}

		return $this;
	}

	private function getPlayUrl() {
		if ( $obj = $this->get( "https://api.live.bilibili.com/room/v1/Room/playUrl?cid={$this->rid}&quality={$this->qua}&platform=web" ) ) {
			foreach ( $obj["data"]["durl"] AS $item ) {
				$this->src[] = $item["url"];
			}
		}

		return $this;
	}

	private function get( $url ) {
		$wch = new wcurl( $url );
		$raw = json_decode( $wch->get(), true );
		if ( $raw["code"] == 0 ) {
			return $raw;
		}

		return false;
	}
}

function livesrc( $arr, $uid ) {
	$l = new plug_livesrc_class( $arr[0], $arr[1] );

	return array( "msg" => array( $l->R() ), "type" => 0 );
}

addAction( "livesrc", "livesrc" );