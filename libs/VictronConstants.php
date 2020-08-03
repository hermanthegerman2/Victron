<?php
// helper properties
declare(strict_types=1);

namespace Constants;

trait VictronConstants
{
    protected $device_mapping = [
        "0300" => "BlueSolar MPPT 70|15",
        "A040" => "BlueSolar MPPT 75|50",
        "A041" => "BlueSolar MPPT 150|35",
        "A042" => "BlueSolar MPPT 75|15",
        "A043" => "BlueSolar MPPT 100|15",
        "A044" => "BlueSolar MPPT 100|30",
        "A045" => "BlueSolar MPPT 100|50",
        "A046" => "BlueSolar MPPT 150|70",
        "A047" => "BlueSolar MPPT 150|100",
        "A048" => "BlueSolar MPPT 75|50 rev2",
        "A049" => "BlueSolar MPPT 100|50 rev2",
        "A04A" => "BlueSolar MPPT 100|30 rev2",
        "A04B" => "BlueSolar MPPT 150|35 rev2",
        "A04C" => "BlueSolar MPPT 75|10",
        "A04D" => "BlueSolar MPPT 150|45",
        "A04E" => "BlueSolar MPPT 150|60",
        "A04F" => "BlueSolar MPPT 150|85",
        "A050" => "SmartSolar MPPT 250|100",
        "A051" => "SmartSolar MPPT 150|100",
        "A052" => "SmartSolar MPPT 150|85",
        "A053" => "SmartSolar MPPT 75/15",
        "A054" => "SmartSolar MPPT 75|10",
        "A055" => "SmartSolar MPPT 100|15",
        "A056" => "SmartSolar MPPT 100|30",
        "A057" => "SmartSolar MPPT 100|50",
        "A058" => "SmartSolar MPPT 150|35",
        "A059" => "SmartSolar MPPT 150|100 rev2",
        "A05A" => "SmartSolar MPPT 150|85 rev2",
        "A05B" => "SmartSolar MPPT 250|70",
        "A05C" => "SmartSolar MPPT 250|85",
        "A05D" => "SmartSolar MPPT 250|60",
        "A05E" => "SmartSolar MPPT 250|45",
        "A05F" => "SmartSolar MPPT 100|20",
        "A060" => "SmartSolar MPPT 100|20 48V",
        "A061" => "SmartSolar MPPT 150|45",
        "A062" => "SmartSolar MPPT 150|60",
        "A063" => "SmartSolar MPPT 150|70",
        "A064" => "SmartSolar MPPT 250|85 rev2",
        "A065" => "SmartSolar MPPT 250|100 rev2",
        "A102" => "SmartSolar MPPT VE.Can 150|70",
        "A103" => "SmartSolar MPPT VE.Can 150|45",
        "A104" => "SmartSolar MPPT VE.Can 150|60",
        "A105" => "SmartSolar MPPT VE.Can 150|85",
        "A106" => "SmartSolar MPPT VE.Can 150|100",
        "A107" => "SmartSolar MPPT VE.Can 250|45",
        "A108" => "SmartSolar MPPT VE.Can 250|60",
        "A109" => "SmartSolar MPPT VE.Can 250|70",
        "A10A" => "SmartSolar MPPT VE.Can 250|85",
        "A10B" => "SmartSolar MPPT VE.Can 250|100"
    ];

    protected $variable_mapping = [
        "V" => array('Name' => 'Main or channel 1 battery voltage', 'custom_profile' => '~Volt', 'Divider' => 1000, 'Value' => 0.0),
        "V2" => array('Name' => 'Channel 2 battery voltage', 'custom_profile' => '~Volt', 'Divider' => 1000, 'Value' => 0.0),
        "V3" => array('Name' => 'Channel 3 battery voltage', 'custom_profile' => '~Volt', 'Divider' => 1000, 'Value' => 0.0),
        "VS" => array('Name' => 'Auxiliary starter voltage', 'custom_profile' => '~Volt', 'Divider' => 1000, 'Value' => 0.0),
        "VM" => array('Name' => 'Mid-point voltage of the battery bank', 'custom_profile' => '~Volt', 'Divider' => 1000, 'Value' => 0.0),
        "DM" => array('Name' => 'Mid-point deviation of the battery bank', 'custom_profile' => '~Intensity.100', 'Divider' => 1000, 'Value' => 0),
        "VPV" => array('Name' => 'Panel voltage', 'custom_profile' => '~Volt', 'Divider' => 1000, 'Value' => 0.0),
        "PPV" => array('Name' => 'Panel power', 'custom_profile' => '~Watt.3680', 'Divider' => NULL, 'Value' => 0.0),
        "I" => array('Name' => 'Main or channel 1 battery current', 'custom_profile' => '~Ampere', 'Divider' => 1000, 'Value' => 0.0),
        "I2" => array('Name' => 'Channel 2 battery current', 'custom_profile' => '~Ampere', 'Divider' => 1000, 'Value' => 0.0),
        "I3" => array('Name' => 'Channel 3 battery current', 'custom_profile' => '~Ampere', 'Divider' => 1000, 'Value' => 0.0),
        "IL" => array('Name' => 'Load current', 'custom_profile' => '~Ampere', 'Divider' => 1000, 'Value' => 0.0),
        "LOAD" => array('Name' => 'Load output state', 'custom_profile' => array('Name' => 'Load output state', 'icon' => '', 'prefix'  => '', 'suffix' => '', 'min' => '', 'max' => 1, 'steps' => ''), 'Divider' => NULL, 'Value' => FALSE),
        "T" => array('Name' => 'Battery temperature', 'custom_profile' => '~Temperature', 'Divider' => NULL, 'Value' => 0.0),
        "P" => array('Name' => 'Instantaneous power', 'custom_profile' => '~Watt.3680', 'Divider' => NULL, 'Value' => 0.0),
        "CE" => array('Name' => 'Consumed Amp Hours', 'custom_profile' => '~Ampere', 'Divider' => 1000, 'Value' => 0.0),
        "SOC" => array('Name' => 'State-of-charge', 'custom_profile' => '~Intensity.100', 'Divider' => 1000, 'Value' => 0.0),
        "TTG" => array('Name' => 'Time-to-go', 'custom_profile' => array('Name' => 'Time_to_go', 'icon' => '', 'prefix' => '', 'suffix' => ' min', 'min' => '', 'max' => 100, 'steps' => 1), 'Divider' => NULL, 'Value' => 0),
        "Alarm" => array('Name' => 'Alarm condition active', 'custom_profile' => array('Name' => 'Alarm condition active', 'icon' => '', 'prefix' => '', 'suffix' => '', 'min' => '', 'max' => 1, 'steps' => ''), 'Divider' => NULL, 'Value' => FALSE),
        "Relay" => array('Name' => 'Relay state', 'custom_profile' => array('Name' => 'Relay state', 'icon' => '', 'prefix' => '', 'suffix' => '', 'min' => '', 'max' => 1, 'steps' => ''), 'Divider' => NULL, 'Value' => FALSE),
        "AR" => array('Name' => 'Alarm reason', 'custom_profile' => array('Name' => 'Alarm reason', 'icon' => '', 'prefix' => '', 'suffix' => '', 'min' => '', 'max' => 8192, 'steps' => ''), 'Divider' => NULL, 'Value' => 0),
        "OR" => array('Name' => 'Off reason', 'custom_profile' => array('Name' => 'Off reason', 'icon' => '', 'prefix' => '', 'suffix' => '', 'min' => '', 'max' => 128, 'steps' => 1), 'Divider' => NULL, 'Value' => 0),
        "H1" => array('Name' => 'Depth of the deepest discharge', 'custom_profile' => '~Ampere', 'Divider' => 1000, 'Value' => 0.0),
        "H2" => array('Name' => 'Depth of the last discharge', 'custom_profile' => '~Ampere', 'Divider' => 1000, 'Value' => 0.0),
        "H3" => array('Name' => 'Depth of the average discharge', 'custom_profile' => '~Ampere', 'Divider' => 1000, 'Value' => 0.0),
        "H4" => array('Name' => 'Number of charge cycles', 'custom_profile' => '', 'Divider' => NULL, 'Value' => 0),
        "H5" => array('Name' => 'Number of full discharges', 'custom_profile' => '', 'Divider' => NULL, 'Value' => 0),
        "H6" => array('Name' => 'Cumulative Amp Hours drawn', 'custom_profile' => '~Ampere', 'Divider' => 1000, 'Value' => 0.0),
        "H7" => array('Name' => 'Minimum main battery voltage', 'custom_profile' => '~Volt', 'Divider' => 1000, 'Value' => 0.0),
        "H8" => array('Name' => 'Maximum main battery voltage', 'custom_profile' => '~Volt', 'Divider' => 1000, 'Value' => 0.0),
        "H9" => array('Name' => 'Number of seconds since last full charge', 'custom_profile' => '', 'Divider' => NULL, 'Value' => 0),
        "H10" => array('Name' => 'Number of automatic synchronizations', 'custom_profile' => '', 'Divider' => NULL, 'Value' => 0),
        "H11" => array('Name' => 'Number of low main voltage alarms', 'custom_profile' => '', 'Divider' => NULL, 'Value' => 0),
        "H12" => array('Name' => 'Number of high main voltage alarms', 'custom_profile' => '', 'Divider' => NULL, 'Value' => 0),
        "H13" => array('Name' => 'Number of low auxiliary voltage alarms', 'custom_profile' => '', 'Divider' => NULL, 'Value' => 0),
        "H14" => array('Name' => 'Number of high auxiliary voltage alarms', 'custom_profile' => '', 'Divider' => NULL, 'Value' => 0),
        "H15" => array('Name' => 'Minimum auxiliary battery voltage', 'custom_profile' => '~Volt', 'Divider' => 1000, 'Value' => 0.0),
        "H16" => array('Name' => 'Maximum auxiliary battery voltage', 'custom_profile' => '~Volt', 'Divider' => 1000, 'Value' => 0.0),
        "H17" => array('Name' => 'Amount of discharged energy', 'custom_profile' => '~Electricity', 'Divider' => 100, 'Value' => 0.0),
        "H18" => array('Name' => 'Amount of charged energy', 'custom_profile' => '~Electricity', 'Divider' => 100, 'Value' => 0.0),
        "H19" => array('Name' => 'Yield total', 'custom_profile' => '~Electricity', 'Divider' => 100, 'Value' => 0.0),
        "H20" => array('Name' => 'Yield today', 'custom_profile' => '~Electricity', 'Divider' => 100, 'Value' => 0.0),
        "H21" => array('Name' => 'Maximum power today', 'custom_profile' => '~Watt.3680', 'Divider' => NULL, 'Value' => 0.0),
        "H22" => array('Name' => 'Yield yesterday', 'custom_profile' => '~Electricity', 'Divider' => 100, 'Value' => 0.0),
        "H23" => array('Name' => 'Maximum power yesterday', 'custom_profile' => '~Watt.3680', 'Divider' => NULL, 'Value' => 0.0),
        "ERR" => array('Name' => 'Error code', 'custom_profile' => array('Name' => 'Error code', 'icon' => '', 'prefix' => '', 'suffix' => '', 'min' => '', 'max' => 128, 'steps' => ''), 'Divider' => NULL, 'Value' => 0),
        "CS" => array('Name' => 'State of operation', 'custom_profile' => array('Name' => 'State of operation', 'icon' => '', 'prefix' => '', 'suffix' => '', 'min' => '', 'max' => 255, 'steps' => 1), 'Divider' => NULL, 'Value' => 0),
        "BMV" => array('Name' => 'Model description (deprecated)', 'custom_profile' => '', 'Divider' => NULL, 'Value' => ''),
        "FW" => array('Name' => 'Firmware version', 'custom_profile' => '', 'Divider' => NULL, 'Value' => ''),
        "FWE" => array('Name' => 'Firmware version', 'custom_profile' => '', 'Divider' => NULL, 'Value' => ''),
        "PID" => array('Name' => 'Product ID', 'custom_profile' => '', 'Divider' => NULL, 'Value' => ''),
        "SER#" => array('Name' => 'Serial number', 'custom_profile' => '', 'Divider' => NULL, 'Value' => ''),
        "HSDS" => array('Name' => 'Day sequence number', 'custom_profile' => '', 'Divider' => NULL, 'Value' => 0),
        "MODE" => array('Name' => 'Device mode', 'custom_profile' => array('Name' => 'Device mode', 'icon' => '', 'prefix' => '', 'suffix' => '', 'min' => '', 'max' => 16, 'steps' => 1), 'Divider' => NULL, 'Value' => 0),
        "AC_OUT_V" => array('Name' => 'AC output voltage', 'custom_profile' => '~Volt', 'Divider' => NULL, 'Value' => 0.0),
        "AC_OUT_I" => array('Name' => 'AC output current', 'custom_profile' => '~Ampere', 'Divider' => NULL, 'Value' => 0.0),
        "AC_OUT_S" => array('Name' => 'AC output apparent power', 'custom_profile' => '~Power', 'Divider' => NULL, 'Value' => 0.0),
        "WARN" => array('Name' => 'Warning reason', 'custom_profile' => array('Name' => 'Warning reason', 'icon' => '', 'prefix' => '', 'suffix' => '', 'min' => '', 'max' => '', 'steps' => ''), 'Divider' => NULL, 'Value' => 0),
        "MPPT" => array('Name' => 'Tracker operation mode', 'custom_profile' => array('Name' => 'Tracker operation mode', 'icon' => '', 'prefix' => '', 'suffix' => '', 'min' => 0, 'max' => 2, 'steps' => 1), 'Divider' => NULL, 'Value' => 0)
    ];

    protected $display_mapping = [
        "SmartSolar MPPT 75/15" => "V,VPV,PPV,I,IL,LOAD,Alarm,Relay,AR,OR,H1,H2,H3,H5,H7,H8,H19,H20,H21,H22,H23,ERR,CS,FW,SER#,HSDS,MODE,WARN,MPPT"
    ];
}