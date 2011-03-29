<?php

namespace Zonomi;

class Console
{
	public static function run($cmd, $options=array())
	{	
		switch ($cmd) {
			case 'set':
				self::setAddress($options);
				break;
			case 'setmx':
				self::setMailAddress($options);
				break;
			case 'delete':
				self::deleteAddress($options);
				break;
			default:
				throw new Exception("Unrecognized command: $cmd");
		}
	}

	protected static function setMailAddress($args)
	{
		list($name, $ip) = $args;
	
		$z = new Zonomi(ZONOMI_API_KEY);
		if ($z->setMailAddress($name, $ip))
			printf("Address set.\n");
		else
			printf("Failed to set address.\n");
	}
	
	protected static function setAddress($args)
	{
		list($name, $ip) = $args;
	
		$z = new Zonomi(ZONOMI_API_KEY);
		if ($z->setAddress($name, $ip))
			printf("Address set.\n");
		else
			printf("Failed to set address.\n");
	}
	
	protected static function deleteAddress($args)
	{
		$name = $args[0];
	
		$z = new Zonomi(ZONOMI_API_KEY);
		if ($z->setAddress($name, $ip))
			printf("Address deleted.\n");
		else
			printf("Failed to delete address.\n");	
	}
}