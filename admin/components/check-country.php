<?php

	function locateIp($ip) {
		
		$primary = file_get_contents("http://www.ipinfodb.com/ip_query.php?ip=$ip&output=xml");
	 
		// If we can't make a connection, use the backup server.
		if (!$primary) {
			
			$secondary = file_get_contents("http://backup.ipinfodb.com/ip_query.php?ip=$ip&output=xml");

			// Unable to make a connection.
			if (!$secondary) {
				return false;
			}
			else {
				$answer = new SimpleXMLElement($secondary);	
			}
			
		}
		else {
			$answer = new SimpleXMLElement($primary);
		}
	 
		$country_code = $answer->CountryCode;
		$country_name = $answer->CountryName;
		$region_name = $answer->RegionName;
		$city = $answer->City;
		$zippostalcode = $answer->ZipPostalCode;
		$latitude = $answer->Latitude;
		$longitude = $answer->Longitude;
		$gmtoffset = $answer->Gmtoffset;
		$dstoffset = $answer->Dstoffset;
	 
		// Return the data as an array
		return array('ip' => $ip, 'country_code' => $country_code, 'country_name' => $country_name, 'region_name' => $region_name, 'city' => $city, 'zippostalcode' => $zippostalcode, 'latitude' => $latitude, 'longitude' => $longitude, 'gmtoffset' => $gmtoffset, 'dstoffset' => $dstoffset);
		
	}

?>