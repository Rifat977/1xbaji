<?php

defined('BASEPATH') or exit('No direct script access allowed');



$aColumns = [
    'slider_id',
    'image',
    'slider_url',
    'status',
    'staff_id',
    'datetime',
];
$sIndexColumn = 'slider_id';
$sTable       = db_prefix() . 'slider';
$join         = ['LEFT JOIN ' . db_prefix() . 'staff ON ' . db_prefix() . 'staff.staffid = ' . db_prefix() . 'slider.staff_id'];
$where = [];


$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where);

$output  = $result['output'];
$rResult = $result['rResult'];
foreach ($rResult as $key => $aRow) {
    $row = [];
    $row[] =  $key + 1;
    if ($aRow['image'] != '') {
        $row[] = '<img src="' . base_url('modules/betting/upload/slider/' . ($aRow['image'])) . '" class="img-fluid staff-profile-image-small">';
    } else {
        $row[] = '';
    }
    $row[] = $aRow['slider_url'];

    $check = '';
    if ($aRow['status'] == 1) {
        $check = 'checked';
    } else {
        $check = '';
    }

    $row[] =
        '<div class="onoffswitch" data-toggle="tooltip" title="Switch">
    <input type="checkbox"  name="onoffswitch" onclick="bet.common_status(\'' . admin_url("betting/admin/slider_status/") . $aRow['slider_id'] . '/' . $aRow['status'] . '\')" class="onoffswitch-checkbox" id="c_' . $aRow['slider_id'] . '" data-id="' . $aRow['slider_id'] . '" ' . $check . '>
    <label class="onoffswitch-label" for="c_' . $aRow['slider_id'] . '"></label>
</div>';

    $staff = '<a data-toggle="tooltip" data-original-title="' . get_staff_full_name($aRow['staff_id']) . '" href="' . admin_url('staff/profile/' . $aRow['staff_id']) . '">' . staff_profile_image($aRow['staff_id'], [
        'staff-profile-image-small',
    ]) . '</a>';
    $row[] =  $staff;

    $row[] =  $aRow['datetime'];

    $row[] =  '<button data-toggle="tooltip" title="Edit" type="button" class="btn btn-info" style="margin-right: 10px;" onclick="slider_edit(\'' . $aRow['slider_id'] . '\',\'' . base_url('modules/betting/upload/slider/' . ($aRow['image'])) . '\',\'' . $aRow['slider_url'] . '\')"><i class="fa fa-edit"></i></button> <button data-toggle="tooltip" title="Delete" type="button" class="btn btn-info" onclick="delete_slider(\'' . $aRow['slider_id'] . '\', \'' . $aRow['image'] . '\')"><i class="fa fa-trash"></i></button>';
    $output['aaData'][] = $row;
}
