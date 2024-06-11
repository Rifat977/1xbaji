<?php

defined('BASEPATH') or exit('No direct script access allowed');



$aColumns = [
    'staffid',
    'CONCAT(firstname, \' \',lastname) as name',
    'email',
    'phonenumber',
    'role',
    'commission'
];
$sIndexColumn = 'staffid';
$sTable       = db_prefix() . 'staff';
$join         = [];
$where = [];
// array_push($where, ' AND role = ' . get_option('bet_super_agent_role') . ' OR role= ' . get_option('bet_master_agent_role') . '  ');
$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where);

$output  = $result['output'];
$rResult = $result['rResult'];
foreach ($rResult as $key => $aRow) {
    $row = [];
    $row[] =  $aRow['staffid'];
    $row[] =  '<a href="' . admin_url('staff/profile/' . $aRow['staffid']) . '">' . staff_profile_image($aRow['staffid'], ['staff-profile-image-small',]) . '</a>' . '   ' . $aRow['name'];
    $row[] = $aRow['email'];
    $row[] = $aRow['phonenumber'];
    $check = '';


    $row[] = get_staff_role_name($aRow['staffid']);
    $row[] = $aRow['commission'];
    $row[] = '<a href="#" onclick="commission('.$aRow['staffid'].','. $aRow['commission'].')" class="btn btn-info" style="margin-right:2px"><i class="fa fa-edit"></i></a>';
    $output['aaData'][] = $row;
};
