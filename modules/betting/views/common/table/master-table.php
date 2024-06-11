<?php

defined('BASEPATH') or exit('No direct script access allowed');



$aColumns = [
    'staffid',
    'CONCAT(firstname, \' \',lastname) as name',
    'email',
    'phonenumber',
    'active',

];
$sIndexColumn = 'staffid ';
$sTable       = db_prefix() . 'staff';
$join         = [];
$where = [];
array_push($where, ' AND (create_by= ' . get_staff_user_id() . ' ) ');
$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where);

$output  = $result['output'];
$rResult = $result['rResult'];
foreach ($rResult as $key => $aRow) {
    $row = [];
    $row[] =  $key + 1;
    $row[] =  '<a href="' . admin_url('staff/profile/' . $aRow['staffid']) . '">' . staff_profile_image($aRow['staffid'], ['staff-profile-image-small',]) . '</a>' . '   ' . $aRow['name'];
    $row[] = $aRow['email'];
    $row[] = $aRow['phonenumber'];
    $check = '';
    if ($aRow['active'] == 1) {
        $check = 'checked';
    } else {
        $check = '';
    }

    $row[] ='<div class="onoffswitch" data-toggle="tooltip" title="Switch">
    <input type="checkbox"  name="onoffswitch" onclick="bet.common_status(\'' . admin_url("betting/admin/master_active/") . $aRow['staffid'] . '/' . $aRow['active'] . '\')" class="onoffswitch-checkbox" id="c_' . $aRow['staffid'] . '" data-id="' . $aRow['staffid'] . '" ' . $check . '>
    <label class="onoffswitch-label" for="c_' . $aRow['staffid'] . '"></label>
</div>';
        
    $output['aaData'][] = $row;
};
