<?php

declare(strict_types=1);

require_once __DIR__ . "/../libs/VictronConstants.php";
require_once __DIR__ . "/../libs/ModuleHelper.php";

	class VEDirect extends IPSModule {

	    const guid_device = "{DBD5563D-DFBA-A3DC-11A4-5E5E4C21F768}";

	    use \Helper\ModuleHelper;
        use \Constants\VictronConstants;

        private $Socket = false;

        public function __construct($InstanceID)
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
            $this->RegisterAttributeString("PID", NULL);
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
            $arrayElements[] = array("type" => "CheckBox", "name" => "Open", "caption" => "Aktiv");
            $arrayElements[] = array("type" => "Label", "label" => "_____________________________________________________________________________________________________");
            //$arrayElements[] = array("type" => "Select", "name" => "VictronVEDirect verbinden mit:", "caption" => "Einheit");
            $arraySort = array();
            $arraySort = array("column" => "Schnittstelle", "direction" => "ascending");
            $arrayColumns = array();
            $arrayColumns[] = array("label" => "Service", "name" => "Seriell", "width" => "200px", "add" => "");
            $arrayColumns[] = array("label" => "Status", "name" => "Socket", "width" => "auto", "add" => "");



            //"options" => ( "caption" => "Socket", "value" => 0 , "caption" => "Seriell" , "value" => 1));
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
                            $this->SendDebug("ApplyChanges", "Einrichtung des Client Socket erfolgreich", 0);
                        }
                        else {
                            $this->SendDebug("ApplyChanges", "Einrichtung des Client Socket nicht erfolgreich!", 0);
                        }
                    }
                }

                If (($this->ConnectionTest()) AND ($this->ReadPropertyBoolean("Open") == true))  {
                    $this->SetSummary($this->ReadPropertyString('IPAddress'));
                    $this->SendDebug("ApplyChanges", "Starte Vorbereitung", 0);
                    If (GetValueBoolean($this->GetIDForIdent("SocketStatus")) == false) {
                        SetValueBoolean($this->GetIDForIdent("SocketStatus"), true);
                    }

                    // Vorbereitung beendet
                    $this->SendDebug("ApplyChanges", "Beende Vorbereitung", 0);
                    $this->SetBuffer("ModuleReady", 1);

                    $this->SetStatus(102);

                }
                else {
                    $this->SetStatus(104);
                    $this->SetBuffer("ModuleReady", 0);
                }
            }
            else {
                return;
            }
        }
        private function ConnectionTest()
        {
            $result = false;
            If (Sys_Ping($this->ReadPropertyString("IPAddress"), 2000)) {
                //IPS_LogMessage("Victron Netzanbindung","Angegebene IP ".$this->ReadPropertyString("IPAddress")." reagiert");
                $this->SendDebug("Netzanbindung", "IP ".$this->ReadPropertyString("IPAddress")."Port ".$this->ReadPropertyInteger("Socket")." reagiert", 0);
                $status = @fsockopen($this->ReadPropertyString("IPAddress"), $this->ReadPropertyInteger("Socket"), $errno, $errstr, 10);
                if (!$status) {
                    IPS_LogMessage("Victron Netzanbindung: ","Port ist geschlossen!");
                    $this->SendDebug("Netzanbindung", "Port ist geschlossen!", 0);
                    If (GetValueBoolean($this->GetIDForIdent("SocketStatus")) == true) {
                        SetValueBoolean($this->GetIDForIdent("SocketStatus"), false);
                    }
                    $status = @fsockopen($this->ReadPropertyString("IPAddress"), $this->ReadPropertyInteger("Socket"), $errno, $errstr, 10);
                    if (!$status) {
                        IPS_LogMessage(" Netzanbindung: ","Port ist geschlossen!");
                        $this->SendDebug("Netzanbindung", "Port ist geschlossen!", 0);
                        If (GetValueBoolean($this->GetIDForIdent("SocketStatus")) == true) {
                            SetValueBoolean($this->GetIDForIdent("SocketStatus"), false);
                        }
                        $this->SetStatus(104);
                    }
                }
                else {
                    fclose($status);
                    //IPS_LogMessage("Victron Netzanbindung: ","Port ist geöffnet");
                    $this->SendDebug("Netzanbindung", "Port ist geoeffnet", 0);
                    $result = true;
                    $this->SetStatus(102);
                }
            }
            else {
                IPS_LogMessage("Victron Netzanbindung: ","IP ".$this->ReadPropertyString("IPAddress")."Port ".$this->ReadPropertyInteger("Socket")." reagiert nicht!");
                $this->SendDebug("Netzanbindung", "IP ".$this->ReadPropertyString("IPAddress")."Port ".$this->ReadPropertyInteger("Socket")." reagiert nicht!", 0);
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
            IPS_LogMessage("Victron MessageSink", "Message from SenderID ".$SenderID." with Message ".$Message."\r\n Data: ".print_r($Data, true));
            switch ($Message) {
                case 10100:
                    If ($Data[0] == 10103) {
                        $this->ApplyChanges();
                    }
                    break;
                case 11101:
                    IPS_LogMessage("Victron MessageSink", "Instanz ".$SenderID." wurde verbunden");
                    break;
                case 11102:
                    $this->SendDebug("MessageSink", "Instanz  ".$SenderID." wurde getrennt", 0);
                    //IPS_LogMessage("Victron MessageSink", "Instanz  ".$SenderID." wurde getrennt");
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

		public function Send(string $Text)
		{
			$this->SendDataToParent(json_encode(Array("DataID" => "{79827379-F36E-4ADA-8A95-5F8D1DC92FA9}", "Buffer" => $Text)));
		}

        public function ReceiveData($JSONString)
        {
            //$receive = json_decode($JSONString);
            $data = json_decode($JSONString);
            //$this->SendDebug("ReceiveData Utf-8", utf8_decode($data->Buffer), 0);
            $buffer = $data->{'Buffer'};
            $message = preg_split('/\r\n/', $buffer);
            $bufferend = array_pop($message);
            for ($i = 1; $i < count($message); $i++) {
                //$this->SendDebug("ReceiveData explode", $array[$i], 0);
                $var= preg_split('/[\t]/', $message[$i]);
                for ($n = 1; $n < count($var); $n++) {
                    $label = $var[$n - 1];
                    $value = $var[$n];
                    $this->SendDebug("ReceiveData ", $label . '  --->  ' . $value, 0);

                    switch ($label) {
                        case "V":
                        case "V2":
                        case "V3":
                        case "VS":
                        case "VM":
                        case "DM":
                        case "VPV":
                        case "I":
                        case "I2":
                        case "I3":
                        case "IL":
                        case "CE":
                        case "SOC":
                        case "H1":
                        case "H2":
                        case "H3":
                        case "H6":
                        case "H7":
                        case "H8":
                        case "H15":
                        case "H16":
                            $value = floatval($value) / 1000;
                            break;

                        case "PPV":
                        case "T":
                        case "LOAD":
                        case "P":
                        case "AR":
                        case "OR":
                        case "H4":
                        case "H5":
                        case "H9":
                        case "H10":
                        case "H11":
                        case "H12":
                        case "H13":
                        case "H14":
                        case "ERR":
                        case "CS":
                        case "HSDS":
                        case "MODE":
                        case "WARN":
                        case "MPPT":
                            $value = intval($value);
                            break;

                        case "Alarm":
                        case "Relay":
                            $value = boolval($value);
                            break;

                        case "H17":
                        case "H18":
                        case "H19":
                        case "H20":
                        case "H22":
                        case "AC_OUT_V":
                        case "AC_OUT_I":
                            $value = floatval($value) / 100;
                            break;

                        case "H21":
                        case "H23":
                        case "AC_OUT_S":
                            $value = floatval($value);
                            break;

                        case "PID":
                            $PID = substr($value, 2);
                            $PID = $this->device_mapping[$PID];
                            If (empty($this->ReadAttributeString('PID'))) {
                                $parent_id = $this->CreateCategoryByIdentifier($this->InstanceID, $PID, $name = null, $icon = null);
                                $this->WriteAttributeString('PID', $PID);
                                $this->SendDebug("Victron Gerät gefunden: ", $PID, 0);
                                IPS_LogMessage("Victron Gerät gefunden: ", $PID);

                                // Gerätevariablen anlegen
                                $position = 0;
                                foreach ($this->variable_mapping[$PID] as $v => $name) {
                                    $ident  = $parent_id . '_' . $name;
                                    // print $key." : ".$value."\n";
                                    $this->CreateVariableByIdentifier([
                                        'parent_id' => $parent_id,
                                        'name' => $name,
                                        'value' => $value,
                                        'identifier' => $ident,
                                        'position' => $position,
                                        'custom_profile' => ''
                                    ]);
                                    $position++;

                                }
                            }
                            break;
                    }

                }
            }
            $this->SendDebug("ReceiveData buffer_end", $bufferend, 0);


        }
	}