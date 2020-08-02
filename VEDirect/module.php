<?php
set_include_path(__DIR__.'/../libs');
require_once __DIR__ . "/../libs/VictronConstants.php";
require_once __DIR__ . "/../libs/ModuleHelper.php";

	class VEDirect extends IPSModule {

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
            $arrayElements[] = array("type" => "ValidationTextBox", "name" => "IPAddress", "caption" => "IP");
            $arrayElements[] = array("type" => "Label", "label" => "_____________________________________________________________________________________________________");
            $arrayElements[] = array("type" => "Label", "label" => "Zugriffsdaten des Raspberry Pi SSH:");
            $arrayElements[] = array("type" => "ValidationTextBox", "name" => "User", "caption" => "User");
            $arrayElements[] = array("type" => "PasswordTextBox", "name" => "Password", "caption" => "Password");
            $arrayElements[] = array("type" => "Label", "label" => "_____________________________________________________________________________________________________");
            $arrayElements[] = array("type" => "Label", "label" => "Detaillierung der genutzten I²C-Schnittstelle:");

            /*If (($this->ConnectionTest()) AND ($this->SearchSpecialI2CDevices(112) == true))  {
                $arrayOptions = array();
                $arrayOptions[] = array("label" => "Kein MUX", "value" => 0);
                $arrayOptions[] = array("label" => "TCA9548a Adr. 112/0x70", "value" => 1);
                $arrayOptions[] = array("label" => "PCA9542 Adr. 112/0x70", "value" => 2);
                $arrayElements[] = array("type" => "Select", "name" => "MUX", "caption" => "MUX-Auswahl", "options" => $arrayOptions );
            }
            else {
                $arrayElements[] = array("type" => "Label", "label" => "Es wurde kein MUX gefunden.");
            }*/
            $arrayOptions = array();

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

            If (($this->ConnectionTest()) AND ($this->ReadPropertyBoolean("Open") == true) AND ($this->GetBuffer("I2C_Enabled") == 1)) {
                // I²C-Devices einlesen und in das Values-Array kopieren
                $DeviceArray = array();
                $DeviceArray = unserialize($this->SearchI2CDevices());
                $arrayValues = array();
                If (count($DeviceArray , COUNT_RECURSIVE) >= 4) {
                    for ($i = 0; $i < Count($DeviceArray); $i++) {
                        $arrayValues[] = array("DeviceTyp" => $DeviceArray[$i][0], "DeviceAddress" => $DeviceArray[$i][1], "DeviceBus" => $DeviceArray[$i][2], "InstanceID" => $DeviceArray[$i][3], "DeviceStatus" => $DeviceArray[$i][4], "rowColor" => $DeviceArray[$i][5]);
                    }
                    $arrayElements[] = array("type" => "List", "name" => "I2C_Devices", "caption" => "I²C-Devices", "rowCount" => 5, "add" => false, "delete" => false, "sort" => $arraySort, "columns" => $arrayColumns, "values" => $arrayValues);
                    $arrayElements[] = array("type" => "Label", "label" => "_____________________________________________________________________________________________________");
                }
                else {
                    $arrayElements[] = array("type" => "Label", "label" => "Es wurden keine I²C-Devices gefunden.");
                }

                $arrayElements[] = array("type" => "Label", "label" => "_____________________________________________________________________________________________________");
            }


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
                /*$this->SetBuffer("ModuleReady", 0);
                $this->SetBuffer("Handle", -1);
                $this->SetBuffer("HardwareRev", 0);
                $Typ = array(2 => 2, 3, 4, 7 => 7, 8, 9, 10, 11, 14 => 14, 15, 17 => 17, 18, 22 => 22, 23, 24, 25, 27 => 27);
                $this->SetBuffer("PinPossible", serialize($Typ));
                $this->SetBuffer("PinI2C", "");
                $this->SetBuffer("I2CSearch", 0);
                $this->SetBuffer("I2C_Enabled", 0);
                $this->SetBuffer("I2C_0_Configured", 0);
                $this->SetBuffer("I2C_1_Configured", 0);
                $this->SetBuffer("Serial_Configured", 0);
                $this->SetBuffer("Serial_Display_Configured", 0);
                $this->SetBuffer("Serial_Display_RxD", -1);
                $this->SetBuffer("Serial_GPS_Configured", 0);
                $this->SetBuffer("Serial_GPS_RxD", -1);
                $this->SetBuffer("Serial_GPS_Data", "");
                $this->SetBuffer("Serial_SDS011_Configured", 0);
                $this->SetBuffer("Serial_SDS011_RxD", -1);
                $this->SetBuffer("1Wire_Configured", 0);
                $this->SetBuffer("SerialNotify", 0);
                $this->SetBuffer("SerialScriptID", -1);
                $this->SetBuffer("Default_I2C_Bus", 1);
                $this->SetBuffer("Default_Serial_Bus", 0);
                $this->SetBuffer("MUX_Handle", -1);
                $this->SetBuffer("OW_Handle", -1);
                $this->SetBuffer("NotifyBitmask", -1);
                $this->SetBuffer("LastNotify", -1);
                $PinNotify = array();
                $this->SetBuffer("PinNotify", serialize($PinNotify));

                $this->SetBuffer("owLastDevice", 0);
                $this->SetBuffer("owLastDiscrepancy", 0);
                $this->SetBuffer("owTripletDirection", 1);
                $this->SetBuffer("owTripletFirstBit", 0);
                $this->SetBuffer("owTripletSecondBit", 0);
                $this->SetBuffer("owDeviceAddress_0", 0);
                $this->SetBuffer("owDeviceAddress_1", 0);

                $this->SetBuffer("IR_RC5_Toggle", 0);
                $this->SetBuffer("IR_RC5X_Toggle", 0);
*/
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
                    If (IPS_GetProperty($ParentID, 'Port') <> 8888) {
                        IPS_SetProperty($ParentID, 'Port', 8888);
                    }
                    If (IPS_GetProperty($ParentID, 'Open') <> $this->ReadPropertyBoolean("Open")) {
                        IPS_SetProperty($ParentID, 'Open', $this->ReadPropertyBoolean("Open"));
                    }
                    If (IPS_GetName($ParentID) == "Client Socket") {
                        IPS_SetName($ParentID, "IPS2GPIO");
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
                    If (GetValueBoolean($this->GetIDForIdent("PigpioStatus")) == false) {
                        SetValueBoolean($this->GetIDForIdent("PigpioStatus"), true);
                    }
                    $this->CheckConfig();
                    // Hardware und Softwareversion feststellen
                    $this->CommandClientSocket(pack("L*", 17, 0, 0, 0).pack("L*", 26, 0, 0, 0), 32);

                    // Alle Waveforms löschen
                    $this->CommandClientSocket(pack("L*", 27, 0, 0, 0), 16);

                    // I2C-Handle zurücksetzen
                    If ($this->GetBuffer("I2C_Enabled") == 1) {
                        $this->ResetI2CHandle(0);
                    }

                    // Notify Starten
                    $Handle = $this->ClientSocket(pack("L*", 99, 0, 0, 0));
                    $this->SetBuffer("Handle", $Handle);
                    $this->SendDebug("Handle", (int)$Handle, 0);

                    // MUX einrichten
                    If (($this->ReadPropertyInteger("MUX") > 0) AND ($this->GetBuffer("I2C_Enabled") == 1)) {
                        $MUX_Handle = $this->CommandClientSocket(pack("L*", 54, 1, 112, 4, 0), 16);
                        $this->SetBuffer("MUX_Handle", $MUX_Handle);
                        $this->SendDebug("MUX Handle", $MUX_Handle, 0);
                        $this->SetBuffer("MUX_Channel", -1);
                        If ($MUX_Handle >= 0) {
                            // MUX setzen
                            $this->SetMUX(0);
                        }
                    }

                    // OW einrichten
                    If (($this->ReadPropertyInteger("OW") > 0) AND ($this->GetBuffer("I2C_Enabled") == 1)) {
                        $OW_Handle = $this->CommandClientSocket(pack("L*", 54, 1, 24, 4, 0), 16);
                        $this->SetBuffer("OW_Handle", $OW_Handle);
                        $this->SendDebug("OW Handle", $OW_Handle, 0);
                    }

                    $I2C_DeviceHandle = array();
                    $this->SetBuffer("I2C_Handle", serialize($I2C_DeviceHandle));

                    // Vorbereitung beendet
                    $this->SendDebug("ApplyChanges", "Beende Vorbereitung", 0);
                    $this->SetBuffer("ModuleReady", 1);

                    // Ermitteln der genutzten I2C-Adressen
                    $this->SendDataToChildren(json_encode(Array("DataID" => "{8D44CA24-3B35-4918-9CBD-85A28C0C8917}", "Function"=>"get_used_i2c")));
                    // Ermitteln der sonstigen Seriellen Schnittstellen-Daten
                    $this->SendDataToChildren(json_encode(Array("DataID" => "{8D44CA24-3B35-4918-9CBD-85A28C0C8917}", "Function"=>"get_serial")));
                    // Ermitteln der sonstigen genutzen GPIO
                    $this->SendDataToChildren(json_encode(Array("DataID" => "{8D44CA24-3B35-4918-9CBD-85A28C0C8917}", "Function"=>"get_usedpin")));
                    // Start-trigger für andere Instanzen (BT, RPi)
                    $this->SendDataToChildren(json_encode(Array("DataID" => "{8D44CA24-3B35-4918-9CBD-85A28C0C8917}", "Function"=>"get_start_trigger")));

                    If ($Handle >= 0) {
                        // Notify setzen
                        $this->CommandClientSocket(pack("L*", 19, $Handle, $this->CalcBitmask(), 0), 16);
                    }

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

        public function GetConfigurationForParent()
        {
            $JsonArray = array( "Host" => $this->ReadPropertyString('IPAddress'), "Port" => 8888, "Open" => $this->ReadPropertyBoolean("Open"));
            $Json = json_encode($JsonArray);
            return $Json;
        }

        public function MessageSink($TimeStamp, $SenderID, $Message, $Data)
        {
            IPS_LogMessage("IPS2GPIO MessageSink", "Message from SenderID ".$SenderID." with Message ".$Message."\r\n Data: ".print_r($Data, true));
            switch ($Message) {
                case 10100:
                    If ($Data[0] == 10103) {
                        $this->ApplyChanges();
                    }
                    break;
                case 11101:
                    IPS_LogMessage("IPS2GPIO MessageSink", "Instanz ".$SenderID." wurde verbunden");
                    break;
                case 11102:
                    $this->SendDebug("MessageSink", "Instanz  ".$SenderID." wurde getrennt", 0);
                    //IPS_LogMessage("IPS2GPIO MessageSink", "Instanz  ".$SenderID." wurde getrennt");
                    // Prüfung für die Pin-Belegung
                    $PinUsed = array();
                    $PinUsed = unserialize($this->GetBuffer("PinUsed"));
                    foreach($PinUsed as $Pin => $InstanceID ){
                        If ($InstanceID == $SenderID) {
                            unset($PinUsed[$Pin]);
                            $this->SendDebug("MessageSink", "Pin ".$Pin." wurde freigegeben", 0);
                        }
                    }
                    $this->SetBuffer("PinUsed", serialize($PinUsed));

                    break;
                case 10505:
                    If ($Data[0] == 102) {
                        $this->ApplyChanges();
                    }
                    elseif ($Data[0] == 200) {
                        If ($this->ReadPropertyBoolean("AutoRestart") == true) {
                            $this->ConnectionTest();
                        }
                        If (GetValueBoolean($this->GetIDForIdent("PigpioStatus")) == true) {
                            SetValueBoolean($this->GetIDForIdent("PigpioStatus"), false);
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
			$data = json_decode($JSONString);
			IPS_LogMessage("Device RECV", utf8_decode($data->Buffer));
		}

	}