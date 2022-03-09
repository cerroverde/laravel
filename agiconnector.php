<?php

	class AgiConnector {
		
		/* AGI variables sent by  */
		private $agi_variables = NULL;

		/* AGI command response */
		private $response_struct = array (
			'result'	=> 0,
			'data'		=> ''
		);

	

		/* REGEXP to match the AGI commands response */
		private $success_regexp = '200[[:space]]+result=([0-9]+)?([[:space:]]+\(.*\))?';

		/* instance the ArrayObject for agi variables */
		public function __construct() {
			$this->LogMessage("Init Class");
			$this->agi_variables = new ArrayObject();

			$this->ReadAgiVariables();
		}

		/* read initial AGI Variables */
		public function ReadAgiVariables(){
			do {
				$this->LogMessage('Leyendo variables');
				$read_string = $this->ReadFromAsterisk();
				$read_lines = explode("\n", $read_string);

				foreach ( $read_lines as $read_line ) {
					$this->LogMessage('reading line: '. $read_line);
					if ( FALSE !== ( $dot_position = strpos($read_line, ':') ) ) {

						list($parameter_name, $parameter_value) = explode(':', $read_line, 2);
						$parameter_value = trim($parameter_value);

						$this->agi_variables->offsetSet($parameter_name, $parameter_value);
						$this->LogMessage('setting variable ' . $parameter_name . ' To ' . $parameter_value);
						
					}else{

						$this->LogMessage("Finish reading variables");
					}
				}
			} while (!$this->agi_variables->offsetExists('agi_accountcode') );
		}

		/* Dirty Log */
		private function LogMessage($Message){
			file_put_contents('/tmp/agi.log', $Message . "\n", FILE_APPEND);
		}

		/* Read from Asterisk (STDIN) */
		private function ReadFromAsterisk() {
			$this->LogMessage('reading from Asterisk');
			$read = fread(STDIN, 1024);
			$this->LogMessage("read: {$read}");

			return $read;
		}

		/**
		 * write to Asterisk (STDOUT)
		 * and log what is wrote
		 * @return int
		 * @param string $CommandString
		 */ 
		private function WriteToAsterisk($CommandString) {

			$this->LogMessage('writing to Asterisk: ' . $CommandString);
			$wrote = fwrite(STDOUT, $CommandString . "\n");
			$this->LogMessage("wrote: {$wrote}");
			
			return $wrote;
		}

		/**
		 * read the string response sent by Asterisk
		 * and parse it into response_struct
		 * @return struct asterisk_response
		 * @param void
		 */
		private function ReadAsteriskResponse() {

			$this->LogMessage('reading Asterisk command response');
			$response			= $this->ReadFromAsterisk();
			$asterisk_response	= $this->response_struct;
			
			if ( FALSE !== preg_match($this->success_regexp, $response, $matches) )
			{
				$asterisk_response['result'] = $matches[1];
				$asterisk_response['data']   = trim(str_replace(array('(',')'), "", $matches[2]));
			}
			
			$this->LogMessage('result=' . $asterisk_response['result']);
			$this->LogMessage('data='. $asterisk_response['data']);
			
			return $asterisk_response;
		}

		public function Write($Message, $VerbosityLevel = 1) {
			$message = (string)$Message;
			$message = str_replace("\\", "\\\\", $message);
			$message = str_replace("\"", "\\\"", $message);
			$message = str_replace("\n", "\\n", $message);
			$command = "VERBOSE \"{$message}\" {$VerbosityLevel}";

			$this->ExecuteCommand($command);
		}

		public function GetAgiVariable($VariableName) {
			$variable = 'agi_' . $VariableName;

			if ( $this->agi_variables->offsetExists($variable) )
			{
				return $this->agi_variables->offsetGet($variable);
			}

			return NULL;
		}

		/**
		 * wrapper for get DTMF pulsation
		 * @return void
		 * @param none
		 */
		public function GetDTMFClient(){
			$this->LogMessage("Init AGI");
			set_time_limit(30);
  			error_reporting(E_ALL);

			$this->LogMessage("Answer call");
			$this->agi->answer();
			
			$cid = $this->agi->parse_callerid();
			$agi->text2wav("Hello, {$cid['name']}.");
			do
			{
				//$agi->text2wav('Enter some numbers and then press the pound key. Press 1 1 1 followed by the pound key to quit.');
				$result = $agi->get_data('beep', 9000, 20);
				$keys = $result['result'];
				//$agi->text2wav("You entered $keys");
			} while($keys != '111');


			//$agi->text2wav('Goodbye');
			
			//$agi->hangup();

			return $keys;

			//$this->get_data('vm-enter-num-to-call', 9000, 8);
			//$this->ExecuteApplication('Read', 'numero, vm-enter-num-to-call.gsm,0');
		}

		/**
		 * wrapper for Playback Asterisk Application
		 * @return void
		 * @param string $FileName
		 */
		public function Playback($FileName) {

			$this->ExecuteApplication('Playback', $FileName);
		}

		/**
		 * wrapper for SayDigits Asterisk Application
		 * @return void
		 * @param string $Digits
		 */
		public function SayDigits($Digits) {
			
			$this->ExecuteApplication('SayDigits', $Digits);
		}

		/**
		 * simply ejecute the given application with the proper arguments
		 * @return void
		 * @param string $ApplicationName
		 * @param string $Arguments
		 */
		public function ExecuteApplication($ApplicationName, $Arguments)
		{
			$command = "EXEC {$ApplicationName} {$Arguments}";
			$this->ExecuteCommand($command);
		}

		/**
		 * @return struct asterisk_response
		 * @param string $CommandString
		 */
		public function ExecuteCommand($CommandString) {

			$this->WriteToAsterisk($CommandString);
			
			return $this->ReadAsteriskResponse();
		}
	}
