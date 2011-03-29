<?php

namespace Zonomi;

class Zonomi
{
	protected $apiURL = 'https://zonomi.com/app/dns/dyndns.jsp';
	protected $apiKey;
	
	public function __construct($api_key)
	{
		$this->apiKey = $api_key;
	}
	
	public function createZone()
	{
		return $this->execute('SET', $payload=array('name'=>$name));
	}
	
	public function setMailAddress($name, $value, $priority=5)
	{
		$payload = array('name'=>$name, 'value'=>$value,
						 'prio'=>$priority, 'type'=>'MX');				   
		return $this->execute('SET', $payload);
	}
	
	public function setAddress($name, $value, $type='A')
	{
		$payload = array('name'=>$name, 'value'=>$value, 'type'=>$type);
		return $this->execute('SET', $payload);
	}

	public function deleteAddress($name, $type='A')
	{
		$payload = array('name'=>$name, 'type'=>$type);
		return $this->execute('DELETE', $payload);
	}
	
	protected function execute($action, array $params)
	{
		// Build parameter string.
		$params += array(
					'action'=>$action,
					'api_key'=>$this->apiKey
				);
		$param_str = http_build_query($params);
		$exec_url  = sprintf('%s?%s', $this->apiURL, $param_str);
		
		$data = @file_get_contents($exec_url);
		
		// Zonomi handles bad data with a 500 Internal Server Error.
		if (!$data) {
			throw new \Exception("Zonomi operation failed. Check your parameters.");
		}
		
		$xml = simplexml_load_string($data);
		
		if ($xml->is_ok == 'OK:') {
			return true;
		} else {
			throw new \Exception($xml->is_ok);
		}
	}
}
