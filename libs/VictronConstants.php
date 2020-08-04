<?php
// helper properties
declare(strict_types=1);

namespace Constants;

trait VictronConstants
{
    protected $device_mapping = [
        "0300" => "BlueSolar MPPT 70 15",
        "A040" => "BlueSolar MPPT 75 50",
        "A041" => "BlueSolar MPPT 150 35",
        "A042" => "BlueSolar MPPT 75 15",
        "A043" => "BlueSolar MPPT 100 15",
        "A044" => "BlueSolar MPPT 100 30",
        "A045" => "BlueSolar MPPT 100 50",
        "A046" => "BlueSolar MPPT 150 70",
        "A047" => "BlueSolar MPPT 150 100",
        "A048" => "BlueSolar MPPT 75 50 rev2",
        "A049" => "BlueSolar MPPT 100 50 rev2",
        "A04A" => "BlueSolar MPPT 100 30 rev2",
        "A04B" => "BlueSolar MPPT 150 35 rev2",
        "A04C" => "BlueSolar MPPT 75 10",
        "A04D" => "BlueSolar MPPT 150 45",
        "A04E" => "BlueSolar MPPT 150 60",
        "A04F" => "BlueSolar MPPT 150 85",
        "A050" => "SmartSolar MPPT 250 100",
        "A051" => "SmartSolar MPPT 150 100",
        "A052" => "SmartSolar MPPT 150 85",
        "A053" => "SmartSolar MPPT 75 15",
        "A054" => "SmartSolar MPPT 75 10",
        "A055" => "SmartSolar MPPT 100 15",
        "A056" => "SmartSolar MPPT 100 30",
        "A057" => "SmartSolar MPPT 100 50",
        "A058" => "SmartSolar MPPT 150 35",
        "A059" => "SmartSolar MPPT 150 100 rev2",
        "A05A" => "SmartSolar MPPT 150 85 rev2",
        "A05B" => "SmartSolar MPPT 250 70",
        "A05C" => "SmartSolar MPPT 250 85",
        "A05D" => "SmartSolar MPPT 250 60",
        "A05E" => "SmartSolar MPPT 250 45",
        "A05F" => "SmartSolar MPPT 100 20",
        "A060" => "SmartSolar MPPT 100 20 48V",
        "A061" => "SmartSolar MPPT 150 45",
        "A062" => "SmartSolar MPPT 150 60",
        "A063" => "SmartSolar MPPT 150 70",
        "A064" => "SmartSolar MPPT 250 85 rev2",
        "A065" => "SmartSolar MPPT 250 100 rev2",
        "A102" => "SmartSolar MPPT VE Can 150 70",
        "A103" => "SmartSolar MPPT VE Can 150 45",
        "A104" => "SmartSolar MPPT VE Can 150 60",
        "A105" => "SmartSolar MPPT VE Can 150 85",
        "A106" => "SmartSolar MPPT VE Can 150 100",
        "A107" => "SmartSolar MPPT VE Can 250 45",
        "A108" => "SmartSolar MPPT VE Can 250 60",
        "A109" => "SmartSolar MPPT VE Can 250 70",
        "A10A" => "SmartSolar MPPT VE Can 250 85",
        "A10B" => "SmartSolar MPPT VE Can 250 100"
    ];

    protected $variable_mapping = [
        "V" => array('Name' => 'Main battery voltage', 'icon' => 'EnergySolar', 'custom_profile' => '~Volt', 'Divider' => 1000, 'Value' => 2),
        "V2" => array('Name' => 'Channel 2 battery voltage', 'icon' => 'EnergySolar', 'custom_profile' => '~Volt', 'Divider' => 1000, 'Value' => 2),
        "V3" => array('Name' => 'Channel 3 battery voltage', 'icon' => 'EnergySolar', 'custom_profile' => '~Volt', 'Divider' => 1000, 'Value' => 2),
        "VS" => array('Name' => 'Auxiliary starter voltage', 'icon' => 'EnergySolar', 'custom_profile' => '~Volt', 'Divider' => 1000, 'Value' => 2),
        "VM" => array('Name' => 'Mid-point voltage of the battery bank', 'icon' => 'EnergySolar', 'custom_profile' => '~Volt', 'Divider' => 1000, 'Value' => 2),
        "DM" => array('Name' => 'Mid-point deviation of the battery bank', 'icon' => 'EnergySolar', 'custom_profile' => '~Intensity.100', 'Divider' => 1000, 'Value' => 1),
        "VPV" => array('Name' => 'Panel voltage', 'icon' => 'EnergySolar', 'custom_profile' => '~Volt', 'Divider' => 1000, 'Value' => 2),
        "PPV" => array('Name' => 'Panel power', 'icon' => 'EnergySolar', 'custom_profile' => '~Watt.3680', 'Divider' => 1, 'Value' => 2),
        "I" => array('Name' => 'Main battery current', 'icon' => 'EnergySolar', 'custom_profile' => '~Ampere', 'Divider' => 1000, 'Value' => 2),
        "I2" => array('Name' => 'Channel 2 battery current', 'icon' => 'EnergySolar', 'custom_profile' => '~Ampere', 'Divider' => 1000, 'Value' => 2),
        "I3" => array('Name' => 'Channel 3 battery current', 'icon' => 'EnergySolar', 'custom_profile' => '~Ampere', 'Divider' => 1000, 'Value' => 2),
        "IL" => array('Name' => 'Load current', 'icon' => 'EnergySolar', 'custom_profile' => '~Ampere', 'Divider' => 1000, 'Value' => 2),
        "LOAD" => array('Name' => 'Load output state', 'icon' => 'EnergySolar', 'Divider' => 1, 'Value' => 0),
        "T" => array('Name' => 'Battery temperature', 'icon' => 'EnergySolar', 'custom_profile' => '~Temperature', 'Divider' => 1, 'Value' => 2),
        "P" => array('Name' => 'Instantaneous power', 'icon' => 'EnergySolar', 'custom_profile' => '~Watt.3680', 'Divider' => 1, 'Value' => 2),
        "CE" => array('Name' => 'Consumed Amp Hours', 'icon' => 'EnergySolar', 'custom_profile' => '~Ampere', 'Divider' => 1000, 'Value' => 2),
        "SOC" => array('Name' => 'State-of-charge', 'icon' => 'EnergySolar', 'custom_profile' => '~Intensity.100', 'Divider' => 1000, 'Value' => 2),
        "TTG" => array('Name' => 'Time-to-go', 'icon' => 'EnergySolar', 'Divider' => 1, 'Value' => 1),
        "Alarm" => array('Name' => 'Alarm condition active', 'icon' => 'EnergySolar', 'Divider' => 1, 'Value' => 0),
        "Relay" => array('Name' => 'Relay state', 'icon' => 'EnergySolar', 'Divider' => 1, 'Value' => 0),
        "AR" => array('Name' => 'Alarm reason', 'icon' => 'EnergySolar', 'Divider' => 1, 'Value' => 1),
        "OR" => array('Name' => 'Off reason', 'icon' => 'EnergySolar', 'Divider' => 1, 'Value' => 1),
        "H1" => array('Name' => 'Depth of the deepest discharge', 'icon' => 'EnergySolar', 'custom_profile' => '~Ampere', 'Divider' => 1000, 'Value' => 2),
        "H2" => array('Name' => 'Depth of the last discharge', 'icon' => 'EnergySolar', 'custom_profile' => '~Ampere', 'Divider' => 1000, 'Value' => 2),
        "H3" => array('Name' => 'Depth of the average discharge', 'icon' => 'EnergySolar', 'custom_profile' => '~Ampere', 'Divider' => 1000, 'Value' => 2),
        "H4" => array('Name' => 'Number of charge cycles', 'icon' => 'EnergySolar', 'custom_profile' => false, 'Divider' => 1, 'Value' => 1),
        "H5" => array('Name' => 'Number of full discharges', 'icon' => 'EnergySolar', 'custom_profile' => false, 'Divider' => 1, 'Value' => 1),
        "H6" => array('Name' => 'Cumulative Amp Hours drawn', 'icon' => 'EnergySolar', 'custom_profile' => '~Ampere', 'Divider' => 1000, 'Value' => 2),
        "H7" => array('Name' => 'Minimum main battery voltage', 'icon' => 'EnergySolar', 'custom_profile' => '~Volt', 'Divider' => 1000, 'Value' => 2),
        "H8" => array('Name' => 'Maximum main battery voltage', 'icon' => 'EnergySolar', 'custom_profile' => '~Volt', 'Divider' => 1000, 'Value' => 2),
        "H9" => array('Name' => 'Number of seconds since last full charge', 'icon' => 'EnergySolar', 'custom_profile' => false, 'Divider' => 1, 'Value' => 1),
        "H10" => array('Name' => 'Number of automatic synchronizations', 'icon' => 'EnergySolar', 'custom_profile' => false, 'Divider' => 1, 'Value' => 1),
        "H11" => array('Name' => 'Number of low main voltage alarms', 'icon' => 'EnergySolar', 'custom_profile' => false, 'Divider' => 1, 'Value' => 1),
        "H12" => array('Name' => 'Number of high main voltage alarms', 'icon' => 'EnergySolar', 'custom_profile' => false, 'Divider' => 1, 'Value' => 1),
        "H13" => array('Name' => 'Number of low auxiliary voltage alarms', 'icon' => 'EnergySolar', 'custom_profile' => false, 'Divider' => 1, 'Value' => 1),
        "H14" => array('Name' => 'Number of high auxiliary voltage alarms', 'icon' => 'EnergySolar', 'custom_profile' => false, 'Divider' => 1, 'Value' => 1),
        "H15" => array('Name' => 'Minimum auxiliary battery voltage', 'icon' => 'EnergySolar', 'custom_profile' => '~Volt', 'Divider' => 1000, 'Value' => 2),
        "H16" => array('Name' => 'Maximum auxiliary battery voltage', 'icon' => 'EnergySolar', 'custom_profile' => '~Volt', 'Divider' => 1000, 'Value' => 2),
        "H17" => array('Name' => 'Amount of discharged energy', 'icon' => 'EnergySolar', 'custom_profile' => '~Electricity', 'Divider' => 1, 'Value' => 2),
        "H18" => array('Name' => 'Amount of charged energy', 'icon' => 'EnergySolar', 'custom_profile' => '~Electricity', 'Divider' => 1, 'Value' => 2),
        "H19" => array('Name' => 'Yield total', 'icon' => 'EnergySolar', 'custom_profile' => '~Electricity', 'Divider' => 100, 'Value' => 2),
        "H20" => array('Name' => 'Yield today', 'icon' => 'EnergySolar', 'custom_profile' => '~Electricity', 'Divider' => 100, 'Value' => 2),
        "H21" => array('Name' => 'Maximum power today', 'icon' => 'EnergySolar', 'custom_profile' => '~Watt.3680', 'Divider' => 1, 'Value' => 2),
        "H22" => array('Name' => 'Yield yesterday', 'icon' => 'EnergySolar', 'custom_profile' => '~Electricity', 'Divider' => 100, 'Value' => 2),
        "H23" => array('Name' => 'Maximum power yesterday', 'icon' => 'EnergySolar', 'custom_profile' => '~Watt.3680', 'Divider' => 1, 'Value' => 2),
        "ERR" => array('Name' => 'Error code', 'icon' => 'EnergySolar', 'Divider' => 1, 'Value' => 1),
        "CS" => array('Name' => 'State of operation', 'icon' => 'EnergySolar', 'Divider' => 1, 'Value' => 1),
        "BMV" => array('Name' => 'Model description (deprecated)', 'icon' => 'EnergySolar', 'custom_profile' => false, 'Divider' => 1, 'Value' => 3),
        "FW" => array('Name' => 'Firmware version', 'icon' => 'EnergySolar', 'custom_profile' => false, 'Divider' => 1, 'Value' => 3),
        "FWE" => array('Name' => 'Firmware version', 'icon' => 'EnergySolar', 'custom_profile' => false, 'Divider' => 1, 'Value' => 3),
        "PID" => array('Name' => 'Product ID', 'icon' => 'EnergySolar', 'custom_profile' => false, 'Divider' => 1, 'Value' => 3),
        "SER#" => array('Name' => 'Serial number', 'icon' => 'EnergySolar', 'custom_profile' => false, 'Divider' => 1, 'Value' => 3),
        "HSDS" => array('Name' => 'Day sequence number', 'icon' => 'EnergySolar', 'custom_profile' => false, 'Divider' => 1, 'Value' => 1),
        "MODE" => array('Name' => 'Device mode', 'icon' => 'EnergySolar', 'Divider' => 1, 'Value' => 1),
        "AC_OUT_V" => array('Name' => 'AC output voltage', 'icon' => 'EnergySolar', 'custom_profile' => '~Volt', 'Divider' => 1, 'Value' => 2),
        "AC_OUT_I" => array('Name' => 'AC output current', 'icon' => 'EnergySolar', 'custom_profile' => '~Ampere', 'Divider' => 1, 'Value' => 2),
        "AC_OUT_S" => array('Name' => 'AC output apparent power', 'icon' => 'EnergySolar', 'custom_profile' => '~Power', 'Divider' => 1, 'Value' => 2),
        "WARN" => array('Name' => 'Warning reason', 'icon' => 'EnergySolar','Divider' => 1, 'Value' => 1),
        "MPPT" => array('Name' => 'Tracker operation mode', 'icon' => 'EnergySolar', 'Divider' => 1, 'Value' => 1)
    ];

    protected $display_mapping = [
        "SmartSolar MPPT 75 15" => array('A053','PID','V','VPV','PPV','I','IL','LOAD','Alarm','Relay','AR','OR','H1','H2','H3','H7','H8','H19','H20','H21','H22','H23','ERR','CS','FW','SER#','HSDS','MODE','WARN','MPPT')
        ];
}