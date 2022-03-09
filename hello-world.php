#!/usr/bin/php
<?php
	set_time_limit(30);
	require('phpagi/phpagi.php');
	error_reporting(E_ALL);

	/* REGEXP to match the AGI commands response */
	$success_regexp = '200[[:space]]+result=([0-9]+)?([[:space:]]+\(.*\))?';

	/* Init PHPAGI Class */
	$agi = new AGI();

	/* AGI Variables */
	$calleridnum    = $agi->request['agi_callerid'];
	$callerid       = $agi->request['agi_callerid'];
	$callidname     = $agi->request['agi_calleridname'];
	$phoneno        = $agi->request['agi_dnid'];
	$channel        = $agi->request['agi_channel'];
	$uniqueid       = $agi->request['agi_uniqueid'];

	/**
	 *  TODO "We need to answer the channel???
	 */
	$agi->answer();

	do {

		if($result = $agi->get_data('beep', 9000, 20)){
			$keys = $result['result'];
			LogMessage("This is the CID: ". $callerid);
			$agi->noop("My CalleID: ".$callerid);
		}else{
			LogMessage("Something went wrong!!!");
		}

		if( $keys == '999'){
			$agi->noop("Festival module");

			$agi->exec('Festival', "Hola Mundo");
		}

	} while($keys != '111');

	
	/* Get DTMF from channel */
	function getDTMF(){
		

		hangupCall();
	}

	/* Dirty Log */
	function LogMessage($Message){
		file_put_contents('/tmp/agi.log', $Message . "\n", FILE_APPEND);
	}

	/* Hangup channel */
	function hangupCall(){
		
		$agi->hangup();

		$read = fread(STDIN, 1024);
		LogMessage("read: {$read}");

		LogMessage("GoodBye");
	}


?>
