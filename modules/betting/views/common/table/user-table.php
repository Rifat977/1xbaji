<?php

defined('BASEPATH') or exit('No direct script access allowed');



$aColumns = [
    db_prefix() . 'user.id as uid',
    'full_name',
    'user_email',
    'mobile',
    'country',
    db_prefix() . 'currencies.name as currenci',
    'short_name',
    'balance',
    'reference',
    'is_active',
    'staff_id',
    'contact_id',
    'datetime',
];
$sIndexColumn = 'id';
$sTable       = db_prefix() . 'user';
$join         = [
    // 'JOIN ' . db_prefix() . 'staff ON ' . db_prefix() . 'staff.staffid = ' . db_prefix() . 'user.staff_id',
    'JOIN ' . db_prefix() . 'currencies ON ' . db_prefix() . 'currencies.id = ' . db_prefix() . 'user.currency_id',
    'JOIN ' . db_prefix() . 'countries ON ' . db_prefix() . 'countries.country_id = ' . db_prefix() . 'user.country',
];
$where = [];
if (!is_admin()) {
    array_push($where, ' AND (staff_id= ' . (get_staff_user_id()) . ' ) ');
}

$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where);

$output  = $result['output'];
$rResult = $result['rResult'];
foreach ($rResult as $key => $aRow) {
    $row = [];
    $row[] =  'USR-'.$aRow['uid'];
    $row[] =  $aRow['full_name'];
    $row[] =  $aRow['user_email'];
    $row[] =  $aRow['mobile'];
    $row[] =  $aRow['short_name'];
    $row[] =  $aRow['currenci'];
    $row[] =  number_format(own_balance($aRow['uid']),2);
    $row[] =  get_refference_name($aRow['reference']);
    $check = '';
    if ($aRow['is_active'] == 1) {
        $check = 'checked';
    } else {
        $check = '';
    }

    $row[] = '<div class="onoffswitch">
        <input type="checkbox"  name="onoffswitch" onclick="bet.common_status(\'' . admin_url("betting/admin/user_status/") . $aRow['uid'] . '/' . $aRow['is_active'] . '\')" class="onoffswitch-checkbox" id="c_' . $aRow['uid'] . '" data-id="' . $aRow['uid'] . '" ' . $check . '>
        <label class="onoffswitch-label" for="c_' . $aRow['uid'] . '"></label>
    </div>';

    $staff = '<a data-toggle="tooltip"  data-original-title="' . get_staff_full_name($aRow['staff_id']) . '" href="' . admin_url('staff/profile/' . $aRow['staff_id']) . '">' . staff_profile_image($aRow['staff_id'], [
        'staff-profile-image-small',
    ]) . '</a>';
    $row[] =  $staff;
    if($aRow['contact_id']==0)
    {
        $agent='defult';
    }
    else
    {
        $agent=get_agent_name($aRow['contact_id']);
    }
    $row[] =  $agent;

    $row[] =  time_ago($aRow['datetime']);

    $row[] =  '<a href="' . admin_url('betting/admin/add_user/' . $aRow['uid']) . '" class="btn btn-info" style="margin-right:2px"><i class="fa fa-edit"></i></a><button  type="button" class="btn btn-info" onclick="bet.common_delete(\'' . admin_url('betting/admin/user_delete/' . $aRow['uid']) . '\')" style="margin-right:2px"><i class="fa fa-trash"></i></button><a href="' . admin_url('betting/admin/user_sattle/' . $aRow['uid']) . '" class="btn btn-info"><i class="fa-solid fa-clock-rotate-left"></i></a>';
    $output['aaData'][] = $row;
}
