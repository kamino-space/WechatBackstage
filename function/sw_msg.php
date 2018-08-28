<?php
/**
 * Author: kamino
 * CreateTime: 2018/4/27,下午 02:18
 * Description:
 * Version:
 */

namespace sw;


class sw_msg {
	private $msgContent;
	private $msgType = 0;
	private $userID = "";

	private $responseMsg;
	private $responseType = 0;

	/*
	 * 初始化
	 * @param $msgContent, $msgType, $userID
	 */
	function __construct( $msgContent, $msgType, $userID ) {
		$this->msgContent = $msgContent;
		$this->msgType    = $msgType;
		$this->userID     = $userID;
	}

	/*
	 * 返回消息
	 * @return array
	 */
	function Msg() {
		$this->msgFunction();

		return $this->responseMsg;
	}

	/*
	 * 返回消息类型
	 * @return int
	 */
	function Type() {
		return $this->responseType;
	}

	/*
	 * 判断选择消息处理
	 */
	private function msgFunction() {
		switch ( $this->msgType ) {
			case 0:
				$this->isText(); //处理文字消息
				break;
			case 1:
				$this->isImage(); //处理图片消息
				break;
			case 2:
				$this->isVoice();
				break;
			case 3:
				$this->isVideo(); //处理视频消息
				break;
			case 4:
				$this->isSvideo(); //处理短视频
				break;
			case 5:
				$this->isLocation(); //处理位置信息
				break;
			case 6:
				$this->isLink(); //处理链接信息
				break;
			case 7:
				$this->isEvent(); //处理事件信息
				break;
			default:
				$this->responseMsg[0] = "不支持这消息";
				break;
		}
	}

	/*
	 * 文本消息
	 * 1.命令
	 * 2.表情包
	 * 3.预定义回复消息
	 * 4.自动回复
	 */
	private function isText() {
		/*
		if ( sw_config::getConfig( "kwreply" ) && $reply = sw_diyreply::reply( $content ) ) {
			$this->responseMsg[0] = $reply;

			return;
		}
		if ( preg_match( "/\>\>(.*)\:(.*)/", $content, $match ) ) {
			$function = $match[1];
			$value    = explode( ",", $match[2] );
			if ( hasAction( $function ) ) {
				$res = doAction( $function, $value, $this->userID );
				if ( is_array( $res ) ) {
					$this->responseMsg  = $res["msg"];
					$this->responseType = $res["type"];
				} else {
					$this->responseMsg[0] = $res;
				}
			} else {
				$this->responseMsg[0] = "unknown function " . $function;
			}
		} elseif ( $content == "【收到不支持的消息类型，暂无法显示】" ) {
			$this->responseMsg[0] = "看不懂,下一个";
		} else {
			if ( hasAction( "tulingAI" ) ) {
				$this->responseMsg[0] = doAction( "tulingAI", $content, $this->userID );
			} else {
				$this->responseMsg[0] = "自动回复";
			}
		}*/
		if ( hasAction( "textMsg" ) ) {
			$r                  = doAction( "textMsg", $this->msgContent, $this->userID );
			$this->responseMsg  = $r["msg"];
			$this->responseType = $r["type"];
		} else {
			$this->responseMsg[0] = "文本消息";
		}

	}

	/*
	 * 图片消息
	 */
	private function isImage() {
		if ( hasAction( "imageMsg" ) ) {
			$r                  = doAction( "imageMsg", $this->msgContent, $this->userID );
			$this->responseMsg  = $r["msg"];
			$this->responseType = $r["type"];
		} else {
			$this->responseMsg[0] = "图片消息";
		}
	}

	/*
	 * 语音消息
	 * 1.识别成功->文本消息
	 * 2.识别失败->预定义回复
	 */
	private function isVoice() {
		$content = $this->msgContent[2];
		if ( empty( $content ) ) {
			$this->responseMsg[0] = "啥?";
		} else {
			$this->msgContent[0] = $content;
			$this->isText();
		}
	}

	/*
	 * 视频消息
	 */
	private function isVideo() {
		if ( hasAction( "videoMsg" ) ) {
			$r                  = doAction( "videoMsg", $this->msgContent, $this->userID );
			$this->responseMsg  = $r["msg"];
			$this->responseType = $r["type"];
		} else {
			$this->responseMsg[0] = "视频消息";
		}
	}

	/*
	 * 短视频消息
	 */
	private function isSvideo() {
		if ( hasAction( "svideoMsg" ) ) {
			$r                  = doAction( "svideoMsg", $this->msgContent, $this->userID );
			$this->responseMsg  = $r["msg"];
			$this->responseType = $r["type"];
		} else {
			$this->responseMsg[0] = "短视频消息";
		}
	}

	/*
	 * 位置信息
	 */
	private function isLocation() {
		if ( hasAction( "locationMsg" ) ) {
			$r                  = doAction( "locationMsg", $this->msgContent, $this->userID );
			$this->responseMsg  = $r["msg"];
			$this->responseType = $r["type"];
		} else {
			$this->responseMsg[0] = "位置消息";
		}
	}

	/*
	 * 链接信息
	 */
	private function isLink() {
		if ( hasAction( "linkMsg" ) ) {
			$r                  = doAction( "linkMsg", $this->msgContent, $this->userID );
			$this->responseMsg  = $r["msg"];
			$this->responseType = $r["type"];
		} else {
			$this->responseMsg[0] = "链接消息";
		}
	}

	/*
	 * 事件信息
	 */
	private function isEvent() {
		if ( hasAction( "eventMsg" ) ) {
			$r                  = doAction( "eventMsg", $this->msgContent, $this->userID );
			$this->responseMsg  = $r["msg"];
			$this->responseType = $r["type"];
		} else {
			$this->responseMsg[0] = "事件消息";
		}
	}
}