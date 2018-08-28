<?php
/**
 * Author: kamino
 * CreateTime: 2018/4/28,下午 11:50
 * Description:
 * Version:
 */


namespace sw;


class sw_diyreply {
	private static $keyList;

	private static function keyList() {
		$wdb    = new \wmysql( DB_HOST, DB_USER, DB_PASSWD, DB_DBNAME );
		$result = $wdb->query( "SELECT `id`, `keyword` FROM `sw_reply`;" );
		while ( $row = $result->fetch_assoc() ) {
			self::$keyList[ $row["id"] ] = $row["keyword"];
		}
		$wdb->close();

		return self::$keyList;
	}

	private static function findKey( $msg ) {
		foreach ( self::keyList() AS $n => $keys ) {
			$a = explode( ",", $keys );
			if ( array_search( $msg, $a ) !== false ) {
				return $n;
			}
		}

		return false;
	}

	static function reply( $msg ) {
		if ( $n = self::findKey( $msg ) ) {
			$wdb    = new \wmysql( DB_HOST, DB_USER, DB_PASSWD, DB_DBNAME );
			$result = $wdb->query( "SELECT `reply` FROM `sw_reply` WHERE `id` = '{$n}';" )->fetch_assoc();
			$wdb->close();

			return $result["reply"];
		} else {
			return false;
		}
	}

	static function queryAll() {
		$wdb    = new \wmysql( DB_HOST, DB_USER, DB_PASSWD, DB_DBNAME );
		$result = $wdb->query( "SELECT `id`, `keyword` FROM `sw_reply`;" );
		while ( $row = $result->fetch_assoc() ) {
			self::$keyList[ $row["id"] ] = $row["keyword"];
		}
		$wdb->close();

	}

	static function selectAll() {
		$wdb    = new \wmysql( DB_HOST, DB_USER, DB_PASSWD, DB_DBNAME );
		$result = $wdb->query( "SELECT * FROM `sw_reply`;" );
		$list   = array();
		while ( $row = $result->fetch_assoc() ) {
			$list[] = $row;
		}
		$wdb->close();

		return $list;
	}
}

