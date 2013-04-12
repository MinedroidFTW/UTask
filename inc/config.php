<?php
/**
 * Created by Daniel Vidmar.
 * Date: 3/29/2013
 * Time: 10:28 PM
 * Version: Beta 1
 * Last Modified: 3/31/2013 at 12:46 AM
 * Last Modified by Daniel Vidmar.
 */
abstract class Configuration {	
	
    private static $configs;
	
	public function __construct() {
		self::$configs = json_decode(file_get_contents('configuration.json'), true);
		self::$configs['version'] = "Beta 1";
		self::$configs['initialized'] = false;
	}
	
	public static function getValue($property) {
		return self::$configs[$property];
	}
	
	public static function setValue($property, $value) {
		self::$configs[$property] = $value;
	}
	
	public static function getListValue($list, $property) {
        return self::$configs[$list][$property];
    }

    public static function setListValue($list, $property, $value) {
        self::$configs[$list][$property] = $value;
    }
	
	public function save() {
		file_put_contents('configuration.json',json_encode(self::$configs));
	}
}
?>