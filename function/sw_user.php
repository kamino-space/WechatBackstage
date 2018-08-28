<?php
/**
 * Author: kamino
 * CreateTime: 2018/4/29,下午 01:01
 * Description:
 * Version:
 */

namespace sw;


class sw_user {
	/*
	 * 数据更新
	 * mode
	 * 0: new all
	 * 1: new name
	 * 2: del user
	 * 3: update name
	 */
	private static function updateData( $mode, $uid = null, $name = null ) {
		if ( empty( $uid ) && empty( $name ) ) {
			return false;
		}
		$time = time();
		$wdb  = new \wmysql( DB_HOST, DB_USER, DB_PASSWD, DB_DBNAME );
		switch ( $mode ) {
			case 0:
				$sql = "INSERT INTO `sw_user` (`name`, `uid`, `time`) VALUES ('{$name}', '{$uid}', '{$time}');";
				break;
			case 1:
				$sql = "UPDATE `sw_user` SET `name` = '{$name}' WHERE `uid` = '{$uid}';";
				break;
			case 2:
				$sql = "DELETE FROM `sw_user` WHERE `uid` = '{$uid}';";
				break;
			default:
				return false;
				break;
		}
		if ( $wdb->query( $sql ) ) {
			$wdb->close();

			return true;
		}
		$wdb->close();

		return false;
	}

	static function newUser( $uid, $name = null ) {
		return self::updateData( 0, $uid, $name );
	}

	static function updateName( $uid, $name = null ) {
		return self::updateData( 1, $uid, $name );
	}

	static function delUser( $uid ) {
		return self::updateData( 2, $uid );
	}

	/*
	 *数据查询
	 * mode
	 * 0: 用户总数
	 * 1: 查询name
	 * 2:
	 */

	private static function queryData( $mode, $uid = null ) {
		$wdb = new \wmysql( DB_HOST, DB_USER, DB_PASSWD, DB_DBNAME );
		switch ( $mode ) {
			case 0:
				$sql = "SELECT count(*) FROM `sw_user`;";
				break;
			case 1:
				$sql = "SELECT `name` FROM `sw_user` WHERE `uid` = '{$uid}';";
				break;
			default:
				return false;
				break;
		}
		if ( $result = $wdb->query( $sql ) ) {
			return $result->fetch_row()[0];
		} else {
			return false;
		}
	}

	static function userNum() {
		return self::queryData( 0 );
	}

	static function userName( $uid ) {
		return self::queryData( 1, $uid );
	}

	static function userList() {
		$wdb    = new \wmysql( DB_HOST, DB_USER, DB_PASSWD, DB_DBNAME );
		$result = $wdb->query( "SELECT * FROM `sw_user`;" );
		$list   = array();
		while ( $row = $result->fetch_assoc() ) {
			$list[] = $row;
		}

		return $list;
	}
}