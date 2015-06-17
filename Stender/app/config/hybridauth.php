<?php
return array(	
	"base_url"   => URL::to('/social/auth'),
	"providers"  => array (
		
		"Foursquare"   => array (
			"enabled"    => true,
			"keys"       => array ( "id" => "ALPZSAMZ32ZIMVEOOTRNQ2BXG4GXXX0YJOZZ20J21USUHEAE", "secret" => "YSC5X4S123ITVJJ5RR0VCOVS2XOTBRWROM1N34YZ4SOG5CBJ" )
			),
		"Twitter"    => array (
			"enabled"    => true,
			"keys"       => array ( "key" => "R2yrXaggilT7eKnABiroNPTfs", "secret" => "pjwJMxXeHxnmYA4SRG0JKkzw95y2U0yRBeoBZiu4LKRCh9ZLKw" )
			),
		"LinkedIn"    => array (
			"enabled"    => true,
			"keys"       => array ( "key" => "77tbpbjpq67pkc", "secret" => "4rODgUe6YSGfNiMq" ),
			"scope" => "r_fullprofile"
			),
		"Facebook"   => array (
			"enabled"    => true,
			"keys"       => array ( "id" => "1584405708514903", "secret" => "e7472db1f7bcfb1d502e88eac9baaa08" ),
			"scope"		=> "user_friends, email, user_likes"
			),
	),
);