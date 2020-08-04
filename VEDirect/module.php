<?php

declare(strict_types=1);

require_once __DIR__ . "/../libs/VictronConstants.php";
require_once __DIR__ . "/../libs/ModuleHelper.php";

	class VEDirect extends IPSModule {

	    const guid_device = "{DBD5563D-DFBA-A3DC-11A4-5E5E4C21F768}";

	    use \Helper\ModuleHelper;
        use \Constants\VictronConstants;

        private $Socket = false;

        protected $profile_mappings = [
            'Load output state' => 'Load_output_state',
            'Alarm condition active' => 'Alarm_condition_active',
            'Time-to-go' => 'Time_to_go',
            'Relay state' => 'Relay_state',
            'Alarm reason' => 'Alarm_reason',
            'Off reason' => 'Off_reason',
            'State of operation' => 'State_of_operation',
            'Error code' => 'Error_code',
            'Device mode' => 'Device_mode',
            'Warning reason' => 'Warning_reason',
            'Tracker operation mode' => 'Tracker_operation_mode'
        ];

        protected $icon_mappings = [
            'Load output state' => 'Light',
            'Relay state' => 'Light',
            'Panel power' => 'EnergySolar'
        ];

        protected $archive_mappings = [
            'Panel power' => 'Panel_power'
        ];

        protected $hidden_mappings = [
            'Off reason' => 'Off_reason'
        ];

        function __construct($InstanceID)
        {
            parent::__construct($InstanceID);
        }

        public function __destruct()
        {
            if ($this->Socket) {
                // Schliessen des Sockets
                socket_close($this->Socket);
            }
        }

        public function Create()
		{
			//Never delete this line!
			parent::Create();

			$this->ConnectParent("{3CFF0FD9-E306-41DB-9B5A-9D06D38576C3}");
            //$this->ConnectParent("{6DC3D946-0D31-450F-A8C6-C42DB8D7D4F1}");
            // Modul-Eigenschaftserstellung
            $this->RegisterPropertyBoolean("Open", true);
            $this->RegisterPropertyString("IPAddress", "192.168.2.2");
            $this->RegisterPropertyInteger("Socket", 10000);
            $this->RegisterPropertyString("Serial Port", "ttyUSB0");
            $this->RegisterPropertyBoolean("AutoRestart", true);
            $this->RegisterAttributeInteger("instance_id", NULL);
            $this->RegisterAttributeBoolean("LoadOutput", NULL);
            $this->RegisterPropertyBoolean("log", true);
            // Statusvariablen anlegen
            $this->RegisterVariableBoolean("SocketStatus", "SocketStatus", "~Alert.Reversed", 40);
            $this->DisableAction("SocketStatus");
		}

        public function GetConfigurationForm()
        {
            $arrayStatus = array();
            $arrayStatus[] = array("code" => 101, "icon" => "inactive", "caption" => "Instanz wird erstellt");
            $arrayStatus[] = array("code" => 102, "icon" => "active", "caption" => "Instanz ist aktiv");
            $arrayStatus[] = array("code" => 104, "icon" => "inactive", "caption" => "Instanz ist inaktiv");
            $arrayStatus[] = array("code" => 200, "icon" => "error", "caption" => "Instanz ist fehlerhaft");

            $arrayElements = array();
            $arrayElements[] = array("type" => "CheckBox", "name" => "Open", "caption" => "active");
            $arrayElements[] = array("type" => "Label", "label" => "_____________________________________________________________________________________________________");
            //$arrayElements[] = array("type" => "Select", "name" => "VictronVEDirect verbinden mit:", "caption" => "Einheit");
            $arraySort = array();
            $arraySort = array("column" => "Schnittstelle", "direction" => "ascending");
            $arrayColumns = array();
            $arrayColumns[] = array("label" => "Service", "name" => "Seriell", "width" => "200px", "add" => "");
            $arrayColumns[] = array("label" => "Status", "name" => "Socket", "width" => "auto", "add" => "");



            //"options" => ( "caption" => "Socket", "value" => 0 , "caption" => "Seriell" , "value" => 1));
            $arrayElements[] = array("type" => "Label", "label" => "_____________________________________________________________________________________________________");
            $arrayElements[] = array("type" => "CheckBox", "name" => "log", "caption" => "enable logging");
            $arrayElements[] = array("type" => "Label", "label" => "_____________________________________________________________________________________________________");

            $arraySort = array();
            $arraySort = array("column" => "ServiceTyp", "direction" => "ascending");
            $arrayColumns = array();
            $arrayColumns[] = array("label" => "Service", "name" => "ServiceTyp", "width" => "200px", "add" => "");
            $arrayColumns[] = array("label" => "Status", "name" => "ServiceStatus", "width" => "auto", "add" => "");

            $arraySort = array();
            $arraySort = array("column" => "DeviceTyp", "direction" => "ascending");
            $arrayColumns = array();
            $arrayColumns[] = array("label" => "Typ", "name" => "DeviceTyp", "width" => "120px", "add" => "");
            $arrayColumns[] = array("label" => "Adresse", "name" => "DeviceAddress", "width" => "60px", "add" => "");
            $arrayColumns[] = array("label" => "Bus", "name" => "DeviceBus", "width" => "60px", "add" => "");
            $arrayColumns[] = array("label" => "Instanz ID", "name" => "InstanceID", "width" => "70px", "add" => "");
            $arrayColumns[] = array("label" => "Status", "name" => "DeviceStatus", "width" => "auto", "add" => "");


            $arrayActions = array();
            If ($this->ReadPropertyBoolean("Open") == true) {
                $arrayActions[] = array("type" => "Label", "label" => "Aktuell sind keine Testfunktionen definiert");
                $arrayActions[] = array("type" => "CheckBox", "name" => "LoadOutput", "caption" => "enable Load output");
            }
            else {
                $arrayActions[] = array("type" => "Label", "label" => "Diese Funktionen stehen erst nach Eingabe und Übernahme der erforderlichen Daten zur Verfügung!");
            }
            /*{"elements": [],
                "actions": [
                    {
                       "name": "Text",
                        "type": "ValidationTextBox",
                        "caption": "Text"
                    },
                    {
                        "type": "Button",
                        "caption": "Send",
                        "onClick": "VICTRON_Send($id, $Text);"
                    }
                ],
                "status": []
            }*/

            return JSON_encode(array("status" => $arrayStatus, "elements" => $arrayElements, "actions" => $arrayActions));
        }

        public function ApplyChanges()
        {
            //Never delete this line!
            parent::ApplyChanges();

            // Nachrichten abonnieren
            $this->RegisterMessage(0, 10100); // Alle Kernelmessages (10103 muss im MessageSink ausgewertet werden.)

            If (IPS_GetKernelRunlevel() == 10103) {

                $ParentID = $this->GetParentID();
                // Änderung an den untergeordneten Instanzen
                $this->RegisterMessage($this->InstanceID, 11101); // Instanz wurde verbunden (InstanceID vom Parent)
                $this->RegisterMessage($this->InstanceID, 11102); // Instanz wurde getrennt (InstanceID vom Parent)
                // INSTANCEMESSAGE
                $this->RegisterMessage($ParentID, 10505); // Status hat sich geändert

                If ($ParentID > 0) {
                    If (IPS_GetProperty($ParentID, 'Host') <> $this->ReadPropertyString('IPAddress')) {
                        IPS_SetProperty($ParentID, 'Host', $this->ReadPropertyString('IPAddress'));
                    }
                    If (IPS_GetProperty($ParentID, 'Open') <> $this->ReadPropertyBoolean("Open")) {
                        IPS_SetProperty($ParentID, 'Open', $this->ReadPropertyBoolean("Open"));
                    }
                    If (IPS_GetName($ParentID) == "Client Socket") {
                        IPS_SetName($ParentID, "Victron");
                    }
                    if(IPS_HasChanges($ParentID))
                    {
                        $Result = @IPS_ApplyChanges($ParentID);
                        If ($Result) {
                            $this->_log("ApplyChanges", "Einrichtung des Client Socket erfolgreich", true);
                        }
                        else {
                            $this->_log("ApplyChanges", "Einrichtung des Client Socket nicht erfolgreich!", true);
                        }
                    }
                }

                If (($this->ConnectionTest()) AND ($this->ReadPropertyBoolean("Open") == true))  {
                    $this->SetSummary($this->ReadPropertyString('IPAddress'));
                    $this->_log("ApplyChanges", "Starte Vorbereitung", true);
                    If (GetValueBoolean($this->GetIDForIdent("SocketStatus")) == false) {
                        SetValueBoolean($this->GetIDForIdent("SocketStatus"), true);
                    }

                    // Vorbereitung beendet
                    $this->_log("ApplyChanges", "Beende Vorbereitung", true);
                    $this->SetBuffer("ModuleReady", 1);

                    $this->SetStatus(102);

                }
                else {
                    $this->SetStatus(104);
                    $this->SetBuffer("ModuleReady", 0);
                }
            }
            else {
                if ($this->ReadPropertyBoolean("LoadOutput") == true) {
                    $this->LoadOutputControl(true);
                }
                else {
                    $this->LoadOutputControl(false);
                }
                return;
            }
        }
        private function ConnectionTest()
        {
            $result = false;
            If (Sys_Ping($this->ReadPropertyString("IPAddress"), 2000)) {
                $this->_log("Victron Netzanbindung","Angegebene IP ".$this->ReadPropertyString("IPAddress")." reagiert",true);
                $status = @fsockopen($this->ReadPropertyString("IPAddress"), $this->ReadPropertyInteger("Socket"), $errno, $errstr, 10);
                if (!$status) {
                    $this->_log("Victron Netzanbindung: ","Port ist geschlossen!", true);
                    If (GetValueBoolean($this->GetIDForIdent("SocketStatus")) == true) {
                        SetValueBoolean($this->GetIDForIdent("SocketStatus"), false);
                    }
                    $status = @fsockopen($this->ReadPropertyString("IPAddress"), $this->ReadPropertyInteger("Socket"), $errno, $errstr, 10);
                    if (!$status) {
                        $this->_log(" Netzanbindung: ","Port ist geschlossen!", true);
                        If (GetValueBoolean($this->GetIDForIdent("SocketStatus")) == true) {
                            SetValueBoolean($this->GetIDForIdent("SocketStatus"), false);
                        }
                        $this->SetStatus(104);
                    }
                }
                else {
                    fclose($status);
                    $this->_log("Victron Netzanbindung: ","Port ist geöffnet", true);
                    $result = true;
                    $this->SetStatus(102);
                }
            }
            else {
                $this->_log("Victron Netzanbindung: ","IP ".$this->ReadPropertyString("IPAddress")."Port ".$this->ReadPropertyInteger("Socket")." reagiert nicht!", true);
                If (GetValueBoolean($this->GetIDForIdent("SocketStatus")) == true) {
                    SetValueBoolean($this->GetIDForIdent("SocketStatus"), false);
                }
                $this->SetStatus(104);
            }
            return $result;
        }

        public function GetConfigurationForParent()
        {
            $JsonArray = array( "Host" => $this->ReadPropertyString('IPAddress'), "Port" => $this->ReadPropertyInteger("Socket"), "Open" => $this->ReadPropertyBoolean("Open"));
            $Json = json_encode($JsonArray);
            return $Json;
        }

        public function MessageSink($TimeStamp, $SenderID, $Message, $Data)
        {
            $this->_log("Victron MessageSink", "Message from SenderID ".$SenderID." with Message ".$Message."\r\n Data: ".print_r($Data, true));
            switch ($Message) {
                case 10100:
                    If ($Data[0] == 10103) {
                        $this->ApplyChanges();
                    }
                    break;
                case 11101:
                    $this->_log("Victron MessageSink", "Instanz ".$SenderID." wurde verbunden",true);
                    break;
                case 11102:
                    $this->_log("Victron MessageSink", "Instanz  ".$SenderID." wurde getrennt",true);
                    break;
                case 10505:
                    If ($Data[0] == 102) {
                        $this->ApplyChanges();
                    }
                    elseif ($Data[0] == 200) {
                        If ($this->ReadPropertyBoolean("AutoRestart") == true) {
                            $this->ConnectionTest();
                        }
                        If (GetValueBoolean($this->GetIDForIdent("SocketStatus")) == true) {
                            SetValueBoolean($this->GetIDForIdent("SocketStatus"), false);
                        }
                    }
                    break;
            }
        }

		public function Destroy()
		{
			//Never delete this line!
			parent::Destroy();
		}

		public function TransmitData(string $payload)
		{
            // send to io
            $this->SetBuffer("lastcommand",$payload);
            $this->_log("Sendcommand:", $payload, true);
            $calc = $this->checksum("$payload");
            $this->_log("Checksum:", $calc, true);
            $payload = ":".$payload.$calc."\n";
            $this->_log("Sendcomplete:", $payload, true);
            $result = $this->SendDataToParent(json_encode(Array("DataID" => "{79827379-F36E-4ADA-8A95-5F8D1DC92FA9}", "Buffer" => $payload))); // Interface GUI
            return $result;
		}

        public function ReceiveData($JSONString)
        {
            //$receive = json_decode($JSONString);
            $data = json_decode($JSONString);
            //$this->_log("ReceiveData Utf-8", utf8_decode($data->Buffer), true);
            $buffer = $data->{'Buffer'};
            $message = preg_split('/\r\n/', $buffer);
            $bufferend = array_pop($message);

            for ($i = 1; $i < count($message); $i++) {
                $var = preg_split('/[\t]/', $message[$i]);
                for ($n = 1; $n < count($var); $n++) {
                    $label = $var[$n - 1];
                    $labelvalue = $var[$n];
                    //$this->_log("ReceiveData ", $label . '  --->  ' . $labelvalue, true);

                    if (($label == "PID" ) && (!$this->ReadAttributeInteger('instance_id'))) {
                        // Initiales Anlegen der Kategorie und der Gerätevariablen
                        $DeviceName = $this->device_mapping[substr($labelvalue, 2)]['DeviceName'];
                        // Prüfung ob instance_id gesetzt ?
                        if (empty($this->ReadAttributeInteger('instance_id'))) {
                            $this->WriteAttributeInteger('instance_id', $this->InstanceID);
                            $this->_log("Victron", "Device: ".$DeviceName." gefunden",true);

                            // Gerätevariablen anlegen

                            $position = 0;
                            foreach ($this->variable_mapping as $key => $value) {
                                $DisplayedValues = $this->device_mapping[substr($labelvalue, 2)]['DisplayedValues'];
                                $this->_log("Victron", "lege Variablen an: ".$DisplayedValues,true);
                                if (in_array($key, $DisplayedValues) == true) {         // ist die Variable im Array display_mapping dabei ?
                                    $ident = $this->InstanceID . '_' . $value['Name'];
                                    $custom_profile = isset($value['custom_profile']) && $value['custom_profile'] ? $value['custom_profile'] : false;
                                    $this->CreateVariableByIdentifier([
                                        'parent_id' => $this->InstanceID,
                                        'name' => $value['Name'],
                                        'value' => $value['Value'],
                                        'identifier' => $ident,
                                        'position' => $position,
                                        'icon' => $value['icon'],
                                        'custom_profile' => $custom_profile
                                    ]);
                                   $position++;
                                }
                            }
                        }
                    }
                    elseif ($label == "Checksum") {
                        //$this->_log("Victron Checksum", $labelvalue, true);
                        break;
                    }
                    else {
                        foreach ($this->variable_mapping as $key => $value) {
                            if ($label == $key) {
                                $needle = $value['Name'];
                                $divider = $value['Divider'];
                            }
                        }
                        $Ident = implode($this->_getIdentifierByNeedle($needle));
                        //$this->_log("Ident by needle", $Ident, true);
                        if(strpos($Ident,"VEDirect")!==false) {
                            $id = $this->GetIdForIdentRecursive($Ident);
                            //$this->_log("IdForIdentRecursive", $id, true);
                            if (isset($id)) {
                                //$this->_log("Schreiben Wert", "Id: " . $id . " / divisor: " . $divider . "/ value: " . $labelvalue, true);
                                switch ($divider) {
                                    case 1:
                                        if ($labelvalue == "ON") {
                                            $labelvalue = true;
                                        }
                                        elseif ($labelvalue == "Off") {
                                            $labelvalue = false;
                                        }
                                        if (($label == "PID" ) {
                                            $labelvalue = $this->device_mapping[substr($labelvalue, 2)]['DeviceName'];
                                        }
                                        if (IPS_GetVariable($id)["VariableType"] == 0) {
                                            SetValueBoolean($id, $labelvalue);
                                        }
                                        if (IPS_GetVariable($id)["VariableType"] == 1) {
                                            SetValueInteger($id, $labelvalue);
                                        }
                                        if (IPS_GetVariable($id)["VariableType"] == 2) {
                                            SetValueFloat($id, $labelvalue);
                                        }
                                        if (IPS_GetVariable($id)["VariableType"] == 3) {
                                            SetValueString($id, $labelvalue);
                                        }
                                        break;
                                    case 100:
                                        SetValueFloat($id, $labelvalue / 100);
                                        break;
                                    case 1000:
                                        SetValueFloat($id, $labelvalue / 1000);
                                        break;
                                }
                            }
                            else {
                                $this->_log("Keine Variablen-Id gefunden !!!", $label . " divisor: " . $divider . " : value: " . $labelvalue, true);
                            }
                        } else {
                            $this->_log("Keinen Variablen-Ident gefunden !!!", $label . " divisor: " . $divider . " : value: " . $labelvalue, true);
                        }
                    }
                }
                //$this->_log("ReceiveData buffer_end", $bufferend, true);
            }
        }

        /**
         * Load output control values (register 0xEDAB)
         * @param bool $value
         * @return bool
         */

        public function LoadOutputControl(bool $value)
        {
            $value (!$value) ? 4 : 0;
            $this->_log("Victron Senden:", "LoadOutputControl Value: ".$value, true);
            $payload = '8'.'ABED'.'00'.hexdec($value);
            $result = $this->TransmitData($payload);
            return (!$result) ? true : false;
        }

        /**
         * calculate checksum
         * @param string $payload
         * @param bool $transmit
         * @return bool|int
         */

        protected function checksum(string $payload, bool $transmit)
        {
            //$this->SendDebug("Test:", $payload, 0);
            if (strlen($payload) == 0) {
                return FALSE;
            }

            $this->_log("Checksum:", "Len: ".$len, true);
            $this->_log("Test:",  "Checksum received: ".$payload[$len-2].$payload[$len-1],true);

            $checksum_calc = (0x55 - hexdec($payload[0]));
            for($i=1; $i < $len-2; $i=$i+2) {
                $checksum_calc = $checksum_calc - hexdec($payload[$i].$payload[$i+1]);
            }
            if ($transmit === TRUE) {
                return strtoupper(dechex($checksum_calc));
            }
            else {
                $checksum_calc = $checksum_calc & 0x000000FF;
                $this->_log("Test:",  "Checksum calculated: ".dechex($checksum_calc),true);
                $checksum_rec = hexdec($payload[$len-2].$payload[$len-1]);
                if ($checksum_calc == $checksum_rec) {
                    return TRUE;
                }
                else {
                    return FALSE;
                }
            }
        }

        /**
         * create custom variable profile
         * @param string $profile_id
         * @param string $name
         */


        protected function CreateCustomVariableProfile(string $profile_id, string $name)
        {
            $this->_log("CreateCustomVariableProfile: ", $profile_id." : ".$name,true);
            switch ($name):
                case 'Load_output_state':
                    IPS_CreateVariableProfile($profile_id, 0); // boolean
                    IPS_SetVariableProfileAssociation($profile_id,0,$this->Translate('Off'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,1,$this->Translate('On'),"",0xFFFFFF);
                    break;

                case 'Alarm_condition_active':
                    IPS_CreateVariableProfile($profile_id, 0); // boolean
                    IPS_SetVariableProfileAssociation($profile_id,0,$this->Translate('Off'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,1,$this->Translate('On'),"",0xFFFFFF);
                    break;

                case 'Relay_state':
                    IPS_CreateVariableProfile($profile_id, 0); // boolean
                    IPS_SetVariableProfileAssociation($profile_id,0,$this->Translate('Off'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,1,$this->Translate('On'),"",0xFFFFFF);
                    break;

                case 'Alarm_reason':
                    IPS_CreateVariableProfile($profile_id, 1); // integer
                    IPS_SetVariableProfileAssociation($profile_id,1,$this->Translate('Low Voltage'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,2,$this->Translate('High Voltage'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,4,$this->Translate('Low SOC'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,8,$this->Translate('Low Starter Voltage'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,16,$this->Translate('High Starter Voltage'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,32,$this->Translate('Low Temperature'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,64,$this->Translate('High Temperature'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,128,$this->Translate('Mid Voltage'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,256,$this->Translate('Overload'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,512,$this->Translate('DC-ripple'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,1024,$this->Translate('Low V AC out'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,2048,$this->Translate('BMS'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,4096,$this->Translate('Short Circuit'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,8192,$this->Translate('BMS Lockout'),"",0xFFFFFF);
                    break;

                case 'Off_reason':
                    IPS_CreateVariableProfile($profile_id, 1); // integer
                    IPS_SetVariableProfileAssociation($profile_id,1,$this->Translate('No Input Power'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,2,$this->Translate('Switched off (power switch)'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,4,$this->Translate('Switched off (device mode register)'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,8,$this->Translate('Remote input'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,10,$this->Translate('Protection active'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,20,$this->Translate('Paygo'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,40,$this->Translate('BMS'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,80,$this->Translate('Engine shutdown detection'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,100,$this->Translate('Analysing input voltage'),"",0xFFFFFF);
                    break;

                case 'State_of_operation':
                    IPS_CreateVariableProfile($profile_id, 1); // integer
                    IPS_SetVariableProfileAssociation($profile_id,0,$this->Translate('Off'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,1,$this->Translate('Low power'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,2,$this->Translate('Fault'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,3,$this->Translate('Bulk'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,4,$this->Translate('Absorption'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,5,$this->Translate('Float'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,6,$this->Translate('Storage'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,7,$this->Translate('Equalize (manual)'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,9,$this->Translate('Inverting'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,11,$this->Translate('Power supply'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,245,$this->Translate('Starting-up'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,246,$this->Translate('Repeated absorption'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,247,$this->Translate('Auto equalize / Recondition'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,248,$this->Translate('BatterySafe'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,252,$this->Translate('External Control'),"",0xFFFFFF);
                    break;

                case 'Error_code':
                    IPS_CreateVariableProfile($profile_id, 1); // integer
                    IPS_SetVariableProfileAssociation($profile_id,0,$this->Translate('No error'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,2,$this->Translate('Battery voltage too high'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,17,$this->Translate('Charger temperature too high'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,18,$this->Translate('Charger over current'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,19,$this->Translate('Charger current reversed'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,20,$this->Translate('Bulk time limit exceeded'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,21,$this->Translate('Current sensor issue (sensor bias/sensor broken)'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,26,$this->Translate('Terminals overheated'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,28,$this->Translate('Converter issue (dual converter models only)'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,33,$this->Translate('Input voltage too high (solar panel)'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,34,$this->Translate('Input current too high (solar panel)'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,38,$this->Translate('Input shutdown (due to excessive battery voltage)'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,39,$this->Translate('Input shutdown (due to current flow during off mode)'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,65,$this->Translate('Lost communication with one of devices'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,66,$this->Translate('Synchronised charging device configuration issue'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,67,$this->Translate('BMS connection lost'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,68,$this->Translate('Network misconfigured'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,116,$this->Translate('Factory calibration data lost'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,117,$this->Translate('Invalid/incompatible firmware'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,119,$this->Translate('User settings invalid'),"",0xFFFFFF);
                    break;

                case 'Device_mode':
                    IPS_CreateVariableProfile($profile_id, 1); // integer
                    IPS_SetVariableProfileAssociation($profile_id,1,$this->Translate('VE_REG_MODE_CHARGER'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,2,$this->Translate('VE_REG_MODE_INVERTER'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,4,$this->Translate('VE_REG_MODE_OFF'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,8,$this->Translate('VE_REG_MODE_ECO'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,16,$this->Translate('VE_REG_MODE_HIBERNATE'),"",0xFFFFFF);

                    break;

                case 'Warning_reason':
                    IPS_CreateVariableProfile($profile_id, 1); // integer
                    IPS_SetVariableProfileAssociation($profile_id,1,$this->Translate('Low Voltage'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,2,$this->Translate('High Voltage'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,4,$this->Translate('Low SOC'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,8,$this->Translate('Low Starter Voltage'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,16,$this->Translate('High Starter Voltage'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,32,$this->Translate('Low Temperature'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,64,$this->Translate('High Temperature'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,128,$this->Translate('Mid Voltage'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,256,$this->Translate('Overload'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,512,$this->Translate('DC-ripple'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,1024,$this->Translate('Low V AC out'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,2048,$this->Translate('BMS'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,4096,$this->Translate('Short Circuit'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,8192,$this->Translate('BMS Lockout'),"",0xFFFFFF);
                    break;

                case 'Tracker_operation_mode':
                    IPS_CreateVariableProfile($profile_id, 1); // integer
                    IPS_SetVariableProfileAssociation($profile_id,0,$this->Translate('Off'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,1,$this->Translate('Voltage or current limited'),"",0xFFFFFF);
                    IPS_SetVariableProfileAssociation($profile_id,2,$this->Translate('MPP Tracker active'),"",0xFFFFFF);
                    break;
            endswitch;
        }
	}