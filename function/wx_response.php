<?php
/**
 * Author: kamino
 * Time: 2018/2/20,下午 10:51
 * Description: 回复消息
 */

namespace wx;

class wx_response {
	private $postStr;
	private $postObj;
	private $msgType;
	private $typeCode;
	private $msgContent = array();
	private $responseMsg = array(); //返回消息内容
	private $responseType; //返回消息类型
	private $toUser;
	private $fromUser;
	private $xml = array(
		"<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[%s]]></Content></xml>",
		"<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[image]]></MsgType><Image><MediaId><![CDATA[%s]]></MediaId></Image></xml>",
		"<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[voice]]></MsgType><Voice><MediaId><![CDATA[%s]]></MediaId></Voice></xml>",
		"<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[video]]></MsgType><Video><MediaId><![CDATA[%s]]></MediaId><Title><![CDATA[%s]]></Title><Description><![CDATA[%s]]></Description></Video></xml>",
		"<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[music]]></MsgType><Music><Title><![CDATA[%s]]></Title><Description><![CDATA[%s]]></Description><MusicUrl><![CDATA[%s]]></MusicUrl><HQMusicUrl><![CDATA[%s]]></HQMusicUrl><ThumbMediaId><![CDATA[%s]]></ThumbMediaId></Music></xml>",
		"<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[news]]></MsgType><ArticleCount>1</ArticleCount><Articles><item><Title><![CDATA[%s]]></Title><Description><![CDATA[%s]]></Description><PicUrl><![CDATA[%s]]></PicUrl><Url><![CDATA[%s]]></Url></item></Articles></xml>"
	);

	//启动
	public function responseStart() {
		$this->getMsg();
		$this->loadXml();
		$this->loadObj();
		$this->getRes();
		$this->responseMsg();
	}

	//获取xml消息
	private function getMsg() {
		//echo $this->postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		$this->postStr = file_get_contents( "php://input" );
		if ( empty( $this->postStr ) ) {
			die( "" );
		}
	}

	//解析xml
	private function loadXml() {
		$this->postObj = simplexml_load_string( $this->postStr, 'SimpleXMLElement', LIBXML_NOCDATA );
	}

	//解析消息
	private function loadObj() {
		$obj_tmp        = $this->postObj;
		$this->fromUser = $obj_tmp->ToUserName;
		$this->toUser   = $obj_tmp->FromUserName;
		$this->msgType  = $obj_tmp->MsgType;
		switch ( $this->msgType ) {
			case "text":
				$this->typeCode   = 0;
				$this->msgContent = array( trim( $obj_tmp->Content ) );
				break;
			case "image":
				$this->typeCode   = 1;
				$this->msgContent = array( trim( $obj_tmp->PicUrl ), trim( $obj_tmp->MediaId ) );
				break;
			case "voice":
				$this->typeCode   = 2;
				$this->msgContent = array(
					trim( $obj_tmp->MediaId ),
					trim( $obj_tmp->Format ),
					trim( $obj_tmp->Recognition )
				);
				break;
			case "video":
				$this->typeCode   = 3;
				$this->msgContent = array(
					trim( $obj_tmp->MediaId ),
					trim( $obj_tmp->ThumbMediaId )
				);
				break;
			case "shortvideo":
				$this->typeCode   = 4;
				$this->msgContent = array(
					trim( $obj_tmp->MediaId ),
					trim( $obj_tmp->ThumbMediaId )
				);
				break;
			case "location":
				$this->typeCode   = 5;
				$this->msgContent = array(
					trim( $obj_tmp->Location_X ),
					trim( $obj_tmp->Location_Y ),
					trim( $obj_tmp->Scale ),
					trim( $obj_tmp->Label )
				);
				break;
			case "link":
				$this->typeCode   = 6;
				$this->msgContent = array(
					trim( $obj_tmp->Title ),
					trim( $obj_tmp->Description ),
					trim( $obj_tmp->Url )
				);
				break;
			case "event":
				$this->typeCode   = 7;
				$this->msgContent = array( trim( $obj_tmp->Event ), trim( $obj_tmp->EventKey ) );
				break;
			default:
				$this->typeCode   = 8;
				$this->msgContent = array( 0 );
				break;
		}
	}


	//获取返回消息
	private function getRes() {
		$msg                = new \sw\sw_msg( $this->msgContent, $this->typeCode, $this->toUser );
		$this->responseMsg  = $msg->Msg();
		$this->responseType = $msg->Type();

	}

	//返回xml
	private function responseMsg() {
		$time = time();
		$res  = "";
		$code = "\$res = sprintf( '" . $this->xml[ $this->responseType ] . "', '$this->toUser', '$this->fromUser', '$time', '";
		$code .= implode( "','", $this->responseMsg );
		$code .= "');";
		@eval( "$code" );
		header( "Content-Type: text/xml; charset=\"utf-8\"" );
		echo $res;
	}

}