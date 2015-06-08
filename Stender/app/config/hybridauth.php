<?php
return array(	
	"base_url"   => URL::to('/social/auth'),
	"providers"  => array (
		
		"Facebook"   => array (
			"enabled"    => true,
			"keys"       => array ( "id" => "1584405708514903", "secret" => "5805b53d0d46b8a3a1080baefdbfe1a6" ),
			"scope"		=> "user_friends, email"
			),
		"Twitter"    => array (
			"enabled"    => true,
			"keys"       => array ( "key" => "R2yrXaggilT7eKnABiroNPTfs", "secret" => "pjwJMxXeHxnmYA4SRG0JKkzw95y2U0yRBeoBZiu4LKRCh9ZLKw" )
			),
		"LinkedIn"    => array (
			"enabled"    => true,
			"keys"       => array ( "key" => "77tbpbjpq67pkc", "secret" => "4rODgUe6YSGfNiMq" ),
			"scope" => "r_fullprofile"
			)
	),
);