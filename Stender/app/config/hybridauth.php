<?php
return array(	
	"base_url"   => "http://stender.app/social/auth",
	"providers"  => array (
		
		"Facebook"   => array (
			"enabled"    => true,
			"keys"       => array ( "id" => "1584405708514903", "secret" => "5805b53d0d46b8a3a1080baefdbfe1a6" ),
			"scope"		=> "user_friends, email"
			),
		"Twitter"    => array (
			"enabled"    => false,
			"keys"       => array ( "key" => "ID", "secret" => "SECRET" )
			)
	),
);