<?php
/**
 * Author: kamino
 * CreateTime: 2018/4/27,下午 01:00
 * Description:
 * Version:
 */

namespace sw;


class sw_config {
	static function dbQuery( $sql, $select = true, $err = false ) {
		$conn = new \mysqli( DB_HOST, DB_USER, DB_PASSWD, DB_DBNAME );
		if ( $conn->connect_error ) {
			die( $conn->error );
		}
		if ( $select ) {
			if ( ! $result = $conn->query( $sql ) ) {
				die( $conn->error );
			}
			if ( $result->num_rows == 0 ) {
				return false;
			} else {
				return $result->fetch_assoc();
			}
		} else {
			if ( $conn->query( $sql ) ) {
				return true;
			} else {
				if ( $err ) {
					die( $conn->error );
				} else {
					return false;
				}
			}
		}
	}

	static function getConfig( $name ) {
		$sql = "SELECT * FROM `sw_config` WHERE `name` = '{$name}' ORDER BY `time` DESC;";
		$res = self::dbQuery( $sql );

		return $res["value"];
	}

	static function newConfig( $name, $value ) {
		if ( self::getConfig( $name ) ) {
			return self::updateConfig( $name, $value );
		}
		$time = time();
		$sql  = "INSERT INTO `sw_config` (`name`, `value`, `time`) VALUES ('{$name}', '{$value}', '{$time}');";

		return self::dbQuery( $sql, false );
	}

	static function updateConfig( $name, $value ) {
		if ( ! self::getConfig( $name ) ) {
			return self::newConfig( $name, $value );
		}
		$time = time();
		$sql  = "UPDATE `sw_config` SET `value` = '{$value}', `time` = '{$time}' WHERE `name` = '{$name}';";

		return self::dbQuery( $sql, false );
	}

	//add
	static function getAll() {
		$wdb    = new \wmysql( DB_HOST, DB_USER, DB_PASSWD, DB_DBNAME );
		$result = $wdb->query( "SELECT * FROM `sw_config`;" );
		$all    = array();
		while ( $row = $result->fetch_assoc() ) {
			$all[] = $row;
		}

		return $all;
	}
}