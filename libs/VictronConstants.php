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
        "A053" => "SmartSolar MPPT 75|15",
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
        "V" => array('Position' => 1, 'Name' => 'Main or channel 1 (battery) voltage', 'custom_profile'  => '~Volt', 'Divider' => 1000, 'Value' => 0.0),
        "V2" => array('Position' => 2, 'Name' => 'Channel 2 (battery) voltage', 'custom_profile' => '~Volt', 'Divider' => 1000, 'Value' => 0.0),
        "V3" => array('Position' => 3, 'Name' => 'Channel 3 (battery) voltage', 'custom_profile'  => '~Volt', 'Divider' => 1000, 'Value' => 0.0),
        "VS" => array('Position' => 4, 'Name' => 'Auxiliary (starter) voltage', 'custom_profile' => '~Volt', 'Divider' => 1000, 'Value' => 0.0),
        "VM" => array('Position' => 5, 'Name' => 'Mid-point voltage of the battery bank', 'custom_profile'  => '~Volt', 'Divider' => 1000, 'Value' => 0.0),
        "DM" => array('Position' => 6, 'Name' => 'Mid-point deviation of the battery bank', 'custom_profile' => '~Intensity.100', 'Divider' => 1000, 'Value' => 0),
        "VPV" => array('Position' => 7, 'Name' => 'Panel voltage', 'custom_profile' => '~Volt', 'Divider' => 1000, 'Value' => 0.0),
        "PPV" => array('Position' => 8, 'Name' => 'Panel power', 'custom_profile' => '~Watt.3680', 'Divider' => 1, 'Value' => 0.0),
        "I" => array('Position' => 9, 'Name' => 'Main or channel 1 battery current', 'custom_profile' => '~Ampere', 'Divider' => 1000, 'Value' => 0.0),
        "I2" => array('Position' => 10, 'Name' => 'Channel 2 battery current', 'custom_profile' => '~Ampere', 'Divider' => 1000, 'Value' => 0.0),
        "I3" => array('Position' => 11, 'Name' => 'Channel 3 battery current', 'custom_profile' => '~Ampere', 'Divider' => 1000, 'Value' => 0.0),
        "IL" => array('Position' => 12, 'Name' => 'Load current', 'custom_profile' => '~Ampere', 'Divider' => 1000, 'Value' => 0.0),
        "LOAD" => array('Position' => 13, 'Name' => 'Load output state', 'custom_profile' => array('Name' => 'Load output state', 'icon' => '', 'prefix'  => '', 'suffix' => '', 'min' => '', 'max' => 1, 'steps' => ''), 'Divider' => NULL, 'Value' => 0),
        "T" => array('Position' => 14, 'Name' => 'Battery temperature', 'custom_profile' => '~Temperature', 'Divider' => 1, 'Value' => 0.0),
        "P" => array('Position' => 15, 'Name' => 'Instantaneous power', 'custom_profile' => '~Watt.3680', 'Divider' => 1, 'Value' => 0.0),
        "CE" => array('Position' => 16, 'Name' => 'Consumed Amp Hours', 'custom_profile' => '~Ampere', 'Divider' => 1000, 'Value' => 0.0),
        "SOC" => array('Position' => 17, 'Name' => 'State-of-charge', 'custom_profile' => '~Intensity.100', 'Divider' => 1000, 'Value' => 0.0),
        "TTG" => array('Position' => 18, 'Name' => 'Time-to-go', 'custom_profile' => array('Name' => 'Time_to_go', 'icon' => '', 'prefix'  => '', 'suffix' => ' min', 'min' => '', 'max' => 100, 'steps' => 1), 'Divider' => NULL, 'Value' => 0),
        "Alarm" => array('Position' => 19, 'Name' => 'Alarm condition active', 'custom_profile' => array('Name' => 'Alarm condition active', 'icon' => '', 'prefix'  => '', 'suffix' => '', 'min' => '', 'max' => 1, 'steps' => ''), 'Divider' => NULL, 'Value' => FALSE),
        "Relay" => array('Position' => 20, 'Name' => 'Relay state', 'custom_profile'  => array('Name' => 'Relay state', 'icon' => '', 'prefix'  => '', 'suffix' => '', 'min' => '', 'max' => 1, 'steps' => ''), 'Divider' => NULL, 'Value' => FALSE),
        "AR" => array('Position' => 21, 'Name' => 'Alarm reason', 'custom_profile'  => array('Name' => 'Alarm reason', 'icon' => '', 'prefix'  => '', 'suffix' => '', 'min' => '', 'max' => 8192, 'steps' => ''), 'Divider' => NULL, 'Value' => 0),
        "OR" => array('Position' => 22, 'Name' => 'Off reason', 'custom_profile'  => array('Name' => 'Off reason', 'icon' => '', 'prefix'  => '', 'suffix' => '', 'min' => '', 'max' => 128, 'steps' => 1), 'Divider' => NULL, 'Value' => 0),
        "H1" => array('Position' => 23, 'Name' => 'Depth of the deepest discharge', 'custom_profile' => '~Ampere', 'Divider' => 1000, 'Value' => 0.0),
        "H2" => array('Position' => 24, 'Name' => 'Depth of the last discharge', 'custom_profile' => '~Ampere', 'Divider' => 1000, 'Value' => 0.0),
        "H3" => array('Position' => 25, 'Name' => 'Depth of the average discharge', 'custom_profile' => '~Ampere', 'Divider' => 1000, 'Value' => 0.0),
        "H4" => array('Position' => 26, 'Name' => 'Number of charge cycles', 'custom_profile' => '', 'Divider' => 1, 'Value' => 0),
        "H5" => array('Position' => 27, 'Name' => 'Number of full discharges', 'custom_profile'  => '', 'Divider' => 1, 'Value' => 0),
        "H6" => array('Position' => 28, 'Name' => 'Cumulative Amp Hours drawn', 'custom_profile' => '~Ampere', 'Divider' => 1000, 'Value' => 0.0),
        "H7" => array('Position' => 29, 'Name' => 'Minimum main (battery) voltage', 'custom_profile' => '~Volt', 'Divider' => 1000, 'Value' => 0.0),
        "H8" => array('Position' => 30, 'Name' => 'Maximum main (battery) voltage', 'custom_profile' => '~Volt', 'Divider' => 1000, 'Value' => 0.0),
        "H9" => array('Position' => 31, 'Name' => 'Number of seconds since last full charge', 'custom_profile'  => '', 'Divider' => 1, 'Value' => 0),
        "H10" => array('Position' => 32, 'Name' => 'Number of automatic synchronizations', 'custom_profile'  => '', 'Divider' => 1, 'Value' => 0),
        "H11" => array('Position' => 33, 'Name' => 'Number of low main voltage alarms', 'custom_profile' => '', 'Divider' => 1, 'Value' => 0),
        "H12" => array('Position' => 34, 'Name' => 'Number of high main voltage alarms', 'custom_profile' => '', 'Divider' => 1, 'Value' => 0),
        "H13" => array('Position' => 35, 'Name' => 'Number of low auxiliary voltage alarms', 'custom_profile' => '', 'Divider' => 1, 'Value' => 0),
        "H14" => array('Position' => 36, 'Name' => 'Number of high auxiliary voltage alarms', 'custom_profile' => '', 'Divider' => 1, 'Value' => 0),
        "H15" => array('Position' => 37, 'Name' => 'Minimum auxiliary (battery) voltage', 'custom_profile'  => '~Volt', 'Divider' => 1000, 'Value' => 0.0),
        "H16" => array('Position' => 38, 'Name' => 'Maximum auxiliary (battery) voltage', 'custom_profile' => '~Volt', 'Divider' => 1000, 'Value' => 0.0),
        "H17" => array('Position' => 39, 'Name' => 'Amount of discharged energy', 'custom_profile' => '~Electricity', 'Divider' => 100, 'Value' => 0.0),
        "H18" => array('Position' => 40, 'Name' => 'Amount of charged energy', 'custom_profile' => '~Electricity', 'Divider' => 100, 'Value' => 0.0),
        "H19" => array('Position' => 41, 'Name' => 'Yield total (user resettable counter)', 'custom_profile'  => '~Electricity', 'Divider' => 100, 'Value' => 0.0),
        "H20" => array('Position' => 42, 'Name' => 'Yield today', 'custom_profile' => '~Electricity', 'Divider' => 100, 'Value' => 0.0),
        "H21" => array('Position' => 43, 'Name' => 'Maximum power today', 'custom_profile' => '~Watt.3680', 'Divider' => 1, 'Value' => 0.0),
        "H22" => array('Position' => 44, 'Name' => 'Yield yesterday', 'custom_profile' => '~Electricity', 'Divider' => 100, 'Value' => 0.0),
        "H23" => array('Position' => 45, 'Name' => 'Maximum power yesterday', 'custom_profile' => '~Watt.3680', 'Divider' => 1, 'Value' => 0.0),
        "ERR" => array('Position' => 46, 'Name' => 'Error code', 'custom_profile' => array('Name' => 'Error code', 'icon' => '', 'prefix'  => '', 'suffix' => '', 'min' => '', 'max' => 128, 'steps' => ''), 'Divider' => NULL, 'Value' => 0),
        "CS" => array('Position' => 47, 'Name' => 'State of operation', 'custom_profile' => array('Name' => 'State of operation', 'icon' => '', 'prefix'  => '', 'suffix' => '', 'min' => '', 'max' => 255, 'steps' => 1), 'Divider' => NULL, 'Value' => 0),
        "BMV" => array('Position' => 48, 'Name' => 'Model description (deprecated)', 'custom_profile'  => '', 'Divider' => NULL, 'Value' => ''),
        "FW" => array('Position' => 49, 'Name' => 'Firmware version (16 bit)', 'custom_profile'  => '', 'Divider' => NULL, 'Value' => ''),
        "FWE" => array('Position' => 50, 'Name' => 'Firmware version (24 bit)', 'custom_profile'  => '', 'Divider' => NULL, 'Value' => ''),
        "PID" => array('Position' => 51, 'Name' => 'Product ID', 'custom_profile'  => '', 'Divider' => NULL, 'Value' => ''),
        "SER#" => array('Position' => 52, 'Name' => 'Serial number', 'custom_profile'  => '', 'Divider' => NULL, 'Value' => ''),
        "HSDS" => array('Position' => 53, 'Name' => 'Day sequence number', 'custom_profile'  => '', 'Divider' => NULL, 'Value' => 0),
        "MODE" => array('Position' => 54, 'Name' => 'Device mode', 'custom_profile' => array('Name' => 'Device mode', 'icon' => '', 'prefix'  => '', 'suffix' => '', 'min' => '', 'max' => 16, 'steps' => 1), 'Divider' => NULL, 'Value' => 0),
        "AC_OUT_V" => array('Position' => 55, 'Name' => 'AC output voltage', 'custom_profile' => '~Volt', 'Divider' => 1, 'Value' => 0.0),
        "AC_OUT_I" => array('Position' => 56, 'Name' => 'AC output current', 'custom_profile' => '~Ampere', 'Divider' => 1, 'Value' => 0.0),
        "AC_OUT_S" => array('Position' => 57, 'Name' => 'AC output apparent power', 'custom_profile' => '~Power', 'Divider' => 1, 'Value' => 0.0),
        "WARN" => array('Position' => 58, 'Name' => 'Warning reason', 'custom_profile' => array('Name' => 'Warning reason', 'icon' => '', 'prefix'  => '', 'suffix' => '', 'min' => '', 'max' => '', 'steps' => ''), 'Divider' => NULL, 'Value' => 0),
        "MPPT" => array('Position' => 59, 'Name' => 'Tracker operation mode', 'custom_profile' => array('Name' => 'Tracker operation mode', 'icon' => '', 'prefix'  => '', 'suffix' => '', 'min' => '', 'max' => 2, 'steps' => 1), 'Divider' => NULL, 'Value' => 0)
    ];

    protected $display_mapping = [
        "SmartSolar MPPT 75|15" => "V,VS,VPV,PPV,I,IL,LOAD,Alarm,Relay,AR,OR,H1,H2,H3,H5,H7,H8,H19,H20,H21,H22,H23,ERR,FW,PID,SER#,HSDS,MODE,WARN,MPPT"
    ];
}