<?php
// helper properties
declare(strict_types=1);

namespace Constants;

trait VictronConstants
{

    protected	$device_mapping = [
        "A053" => "SmartSolar MPPT 75|15"
    ];

    protected $custom_profile = [
        "LOAD" => array('Name' => 'Load_output_state', 'icon' => '', 'prefix'  => '', 'suffix' => '', 'min' => '', 'max' => '', 'steps' => ''),
        "Alarm" => array('Name' => 'Alarm_condition_active', 'icon' => '', 'prefix'  => '', 'suffix' => '', 'min' => '', 'max' => '', 'steps' => ''),
        "Relay" => array('Name' => 'Relay_state', 'icon' => '', 'prefix'  => '', 'suffix' => '', 'min' => '', 'max' => '', 'steps' => ''),
        "AR" => array('Name' => 'Alarm_reason', 'icon' => '', 'prefix'  => '', 'suffix' => '', 'min' => '', 'max' => '', 'steps' => ''),
        "OR" => array('Name' => 'Off_reason', 'icon' => '', 'prefix'  => '', 'suffix' => '', 'min' => 0, 'max' => 7, 'steps' => 1),
        "CS" => array('Name' => 'State_of_operation', 'icon' => '', 'prefix'  => '', 'suffix' => '', 'min' => 0, 'max' => 255, 'steps' => 1),
        "ERR" => array('Name' => 'Error_code', 'icon' => '', 'prefix'  => '', 'suffix' => '', 'min' => '', 'max' => '', 'steps' => ''),
        "MODE" => array('Name' => 'Device_mode', 'icon' => '', 'prefix'  => '', 'suffix' => '', 'min' => 0, 'max' => 4, 'steps' => 1),
        "WARN" => array('Name' => 'Warning_reason', 'icon' => '', 'prefix'  => '', 'suffix' => '', 'min' => '', 'max' => '', 'steps' => ''),
        "MPPT" => array('Name' => 'Tracker_operation_mode', 'icon' => '', 'prefix'  => '', 'suffix' => '', 'min' => 0, 'max' => 2, 'steps' => 1)
    ];

    protected $profile_mappings = [
        'Main or channel 1 (battery) voltage' => '~Volt',
        'Channel 2 (battery) voltage' => '~Volt',
        'Channel 3 (battery) voltage' => '~Volt',
        'Auxiliary (starter) voltage' => '~Volt',
        'Mid-point voltage of the battery bank'	=> '~Volt',
        'Mid-point deviation of the battery bank' => '~Intensity.100',
        'Panel voltage' => '~Volt',
        'Panel power' => '~Watt.3680',
        'Main or channel 1 battery current'	=> '~Ampere',
        'Channel 2 battery current'	=> '~Ampere',
        'Channel 3 battery current'	=> '~Ampere',
        'Load current' => '~Ampere',
        'Battery temperature' => '~Temperature',
        'Instantaneous power' => '~Watt.3680',
        'Consumed Amp Hours' => '~Ampere',
        'State-of-charge' => '~Intensity.100',
        'Depth of the deepest discharge' => '~Ampere',
        'Depth of the last discharge' => '~Ampere',
        'Depth of the average discharge' => '~Ampere',
        'Cumulative Amp Hours drawn' => '~Ampere',
        'Minimum main (battery) voltage' => '~Volt',
        'Maximum main (battery) voltage' => '~Volt',
        'Minimum auxiliary (battery) voltage' => '~Volt',
        'Maximum auxiliary (battery) voltage' => '~Volt',
        'Amount of discharged energy' => '~Electricity',
        'Amount of charged energy' => '~Electricity',
        'Yield total (user resettable counter)'	=> '~Electricity',
        'Yield today' => '~Electricity',
        'Maximum power today' => '~Watt.3680',
        'Yield yesterday' => '~Electricity',
        'Maximum power yesterday' => '~Watt.3680',
        'AC output voltage'	=> 	'~Volt',
        'AC output current'	=> '~Ampere',
        'AC output apparent power' => '~Power'
    ];

    protected $DeviceVariable = [
        "V" => array('Position' => 1, 'Name' => 'Main or channel 1 (battery) voltage', 'Profil'  => '~Volt', 'Vartype' => 0.0),
        "V2" => array('Position' => 2, 'Name' => 'Channel 2 (battery) voltage', 'Profil' => '~Volt', 'Vartype' => 0.0),
        "V3" => array('Position' => 3, 'Name' => 'Channel 3 (battery) voltage', 'Profil'  => '~Volt', 'Vartype' => 0.0),
        "VS" => array('Position' => 4, 'Name' => 'Auxiliary (starter) voltage', 'Profil' => '~Volt', 'Vartype' => 0.0),
        "VM" => array('Position' => 5, 'Name' => 'Mid-point voltage of the battery bank', 'Profil'  => '~Volt', 'Vartype' => 0.0),
        "DM" => array('Position' => 6, 'Name' => 'Mid-point deviation of the battery bank', 'Profil' => '~Intensity.100', 'Vartype' => 0),
        "VPV" => array('Position' => 7, 'Name' => 'Panel voltage', 'Profil' => '~Volt', 'Vartype' => 0.0),
        "PPV" => array('Position' => 8, 'Name' => 'Panel power', 'Profil' => '~Watt.3680', 'Vartype' => 0.0),
        "I" => array('Position' => 9, 'Name' => 'Main or channel 1 battery current', 'Profil' => '~Ampere', 'Vartype' => 0.0),
        "I2" => array('Position' => 10, 'Name' => 'Channel 2 battery current', 'Profil' => '~Ampere', 'Vartype' => 0.0),
        "I3" => array('Position' => 11, 'Name' => 'Channel 3 battery current', 'Profil' => '~Ampere', 'Vartype' => 0.0),
        "IL" => array('Position' => 12, 'Name' => 'Load current', 'Profil' => '~Ampere', 'Vartype' => 0.0),
        "LOAD" => array('Position' => 13, 'Name' => 'Load output state', 'Profil' => 'Load_output_state', 'Vartype' => 0),
        "T" => array('Position' => 14, 'Name' => 'Battery temperature', 'Profil' => '~Temperature', 'Vartype' => 0.0),
        "P" => array('Position' => 15, 'Name' => 'Instantaneous power', 'Profil' => '~Watt.3680', 'Vartype' => 0.0),
        "CE" => array('Position' => 16, 'Name' => 'Consumed Amp Hours', 'Profil' => '~Ampere', 'Vartype' => 0.0),
        "SOC" => array('Position' => 17, 'Name' => 'State-of-charge', 'Profil' => '~Intensity.100', 'Vartype' => 0.0),
        "TTG" => array('Position' => 18, 'Name' => 'Time-to-go', 'Profil' => 'Time-to-go', 'Vartype' => FALSE),
        "Alarm" => array('Position' => 19, 'Name' => 'Alarm condition active', 'Profil'  => 'Alarm_condition_active', 'Vartype' => FALSE),
        "Relay" => array('Position' => 20, 'Name' => 'Relay state', 'Profil'  => 'Relay_state', 'Vartype' => FALSE),
        "AR" => array('Position' => 21, 'Name' => 'Alarm_reason', 'Profil'  => 'Alarm_reason', 'Vartype' => 0),
        "OR" => array('Position' => 22, 'Name' => 'Off reason', 'Profil'  => 'Off_reason', 'Vartype' => 0),
        "H1" => array('Position' => 23, 'Name' => 'Depth of the deepest discharge', 'Profil' => '~Ampere', 'Vartype' => 0.0),
        "H2" => array('Position' => 24, 'Name' => 'Depth of the last discharge', 'Profil' => '~Ampere', 'Vartype' => 0.0),
        "H3" => array('Position' => 25, 'Name' => 'Depth of the average discharge', 'Profil' => '~Ampere', 'Vartype' => 0.0),
        "H4" => array('Position' => 26, 'Name' => 'Number of charge cycles', 'Profil' => '', 'Vartype' => 1),
        "H5" => array('Position' => 27, 'Name' => 'Number of full discharges', 'Profil'  => '', 'Vartype' => 1),
        "H6" => array('Position' => 28, 'Name' => 'Cumulative Amp Hours drawn', 'Profil' => '~Ampere', 'Vartype' => 0.0),
        "H7" => array('Position' => 29, 'Name' => 'Minimum main (battery) voltage', 'Profil' => '~Volt', 'Vartype' => 0.0),
        "H8" => array('Position' => 30, 'Name' => 'Maximum main (battery) voltage', 'Profil' => '~Volt', 'Vartype' => 0.0),
        "H9" => array('Position' => 31, 'Name' => 'Number of seconds since last full charge', 'Profil'  => '', 'Vartype' => 1),
        "H10" => array('Position' => 32, 'Name' => 'Number of automatic synchronizations', 'Profil'  => '', 'Vartype' => 1),
        "H11" => array('Position' => 33, 'Name' => 'Number of low main voltage alarms', 'Profil' => '', 'Vartype' => 1),
        "H12" => array('Position' => 34, 'Name' => 'Number of high main voltage alarms', 'Profil' => '', 'Vartype' => 1),
        "H13" => array('Position' => 35, 'Name' => 'Number of low auxiliary voltage alarms', 'Profil' => '', 'Vartype' => 1),
        "H14" => array('Position' => 36, 'Name' => 'Number of high auxiliary voltage alarms', 'Profil' => '', 'Vartype' => 1),
        "H15" => array('Position' => 37, 'Name' => 'Minimum auxiliary (battery) voltage', 'Profil'  => '~Volt', 'Vartype' => 0.0),
        "H16" => array('Position' => 38, 'Name' => 'Maximum auxiliary (battery) voltage', 'Profil' => '~Volt', 'Vartype' => 0.0),
        "H17" => array('Position' => 39, 'Name' => 'Amount of discharged energy', 'Profil' => '~Electricity', 'Vartype' => 0.0),
        "H18" => array('Position' => 40, 'Name' => 'Amount of charged energy', 'Profil' => '~Electricity', 'Vartype' => 0.0),
        "H19" => array('Position' => 41, 'Name' => 'Yield total (user resettable counter)', 'Profil'  => '~Electricity', 'Vartype' => 0.0),
        "H20" => array('Position' => 42, 'Name' => 'Yield today', 'Profil' => '~Electricity', 'Vartype' => 0.0),
        "H21" => array('Position' => 43, 'Name' => 'Maximum power today', 'Profil' => '~Watt.3680', 'Vartype' => 0.0),
        "H22" => array('Position' => 44, 'Name' => 'Yield yesterday', 'Profil' => '~Electricity', 'Vartype' => 0.0),
        "H23" => array('Position' => 45, 'Name' => 'Maximum power yesterday', 'Profil' => '~Watt.3680', 'Vartype' => 0.0),
        "ERR" => array('Position' => 46, 'Name' => 'Error code', 'Profil'  => 'Error_code', 'Vartype' => 1),
        "CS" => array('Position' => 47, 'Name' => 'State of operation', 'Profil'  => 'State_of_operation', 'Vartype' => 1),
        "BMV" => array('Position' => 48, 'Name' => 'Model description (deprecated)', 'Profil'  => '', 'Vartype' => ''),
        "FW" => array('Position' => 49, 'Name' => 'Firmware version (16 bit)', 'Profil'  => '', 'Vartype' => ''),
        "FWE" => array('Position' => 50, 'Name' => 'Firmware version (24 bit)', 'Profil'  => '', 'Vartype' => ''),
        "PID" => array('Position' => 51, 'Name' => 'Product ID', 'Profil'  => '', 'Vartype' => ''),
        "SER#" => array('Position' => 52, 'Name' => 'Serial number', 'Profil'  => '', 'Vartype' => ''),
        "HSDS" => array('Position' => 53, 'Name' => 'Day sequence number', 'Profil'  => 'State_of_operation', 'Vartype' => 1),
        "MODE" => array('Position' => 54, 'Name' => 'Device mode', 'Profil' => 'Device_mode', 'Vartype' => 1),
        "AC_OUT_V" => array('Position' => 55, 'Name' => 'AC output voltage', 'Profil' => '~Volt', 'Vartype' => 0.0),
        "AC_OUT_I" => array('Position' => 56, 'Name' => 'AC output current', 'Profil' => '~Ampere', 'Vartype' => 0.0),
        "AC_OUT_S" => array('Position' => 57, 'Name' => 'AC output apparent power', 'Profil' => '~Power', 'Vartype' => 0.0),
        "WARN" => array('Position' => 58, 'Name' => 'Warning reason', 'Profil' => 'Warning_reason', 'Vartype' => 1),
        "MPPT" => array('Position' => 59, 'Name' => 'Tracker operation mode', 'Profil' => 'Tracker_operation_mode', 'Vartype' => 1)
    ];

    protected $variable_mapping = array (
        "SmartSolar MPPT 75|15" => array(
            "V" => "Main or channel 1 (battery) voltage", 1,
            "VS" => "Auxiliary (starter) voltage", 1,
            "VPV" => "Panel voltage", 1,
            "PPV" => "Panel power", 'value' => 1,
            "I" => "Main or channel 1 battery current", 'value' => 1,
            "IL" => "Load current", 'value' => 1,
            "LOAD" => "Load output state", 'value' => 1,
            "Alarm" => "Alarm condition active", 'value' => 0,
            "Relay" => "Relay state", 'value' => 0,
            "AR" => "Alarm_reason", 'value' => 2,
            "OR" => "Off reason", 'value' => 2,
            "H1" => "Depth of the deepest discharge", 'value' => 1,
            "H2" => "Depth of the last discharge", 'value' => 1,
            "H3" => "Depth of the average discharge", 'value' => 1,
            "H7" => "Minimum main (battery) voltage", 'value' => 1,
            "H8" => "Maximum main (battery) voltage",  'value' => 1,
            "H19" => "Yield total (user resettable counter)", 'value' => 1,
            "H20" => "Yield today",  'value' => 1,
            "H21" => "Maximum power today", 'value' => 1,
            "H22" => "Yield yesterday", 'value' => 1,
            "H23" => "Maximum power yesterday", 'value' => 1,
            "ERR" => "Error code", 'value' => 2,
            "FW" => "Firmware version (16 bit)", 'value' => 3,
            "SER#" => "Serial number", 'value' => 1, 'value' => 3,
            "HSDS" => "Day sequence number", 'value' => 2,
            "MODE" => "Device mode", 'value' => 1,
            "WARN" => "Warning reason", 'value' => 2,
            "MPPT" => "Tracker operation mode", 'value' => 2
        )
    );
}