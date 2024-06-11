<?php

defined('BASEPATH') or exit('No direct script access allowed');



$aColumns = [
    'id',
    'name',
    'image',
    'id_active',
    'staff_id',
    'datetime',
];
$sIndexColumn = 'id';
$sTable       = db_prefix() . 'sports_category';
$join         = ['LEFT JOIN ' . db_prefix() . 'staff ON ' . db_prefix() . 'staff.staffid = ' . db_prefix() . 'sports_category.staff_id'];
$where = [];


$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where);

$output  = $result['output'];
$rResult = $result['rResult'];
foreach ($rResult as $key => $aRow) {
    $row = [];
    $row[] =  $key + 1;
    $row[] =  $aRow['name'];
    if ($aRow['image'] != '') {
        $row[] = '<img src="' . base_url('modules/betting/upload/category/' . ($aRow['image'])) . '" class="img-fluid staff-profile-image-small">';
    } else {
        $row[] = '';
    }

    $check = '';
    if ($aRow['id_active'] == 1) {
        $check = 'checked';
    } else {
        $check = '';
    }

    $row[] =
        '<div class="onoffswitch">
    <input type="checkbox"  name="onoffswitch" onclick="category_status(\'' . $aRow['id'] . '\',\'' . $aRow['id_active'] . '\')" class="onoffswitch-checkbox" id="c_' . $aRow['id'] . '" data-id="' . $aRow['id'] . '" ' . $check . '>
    <label class="onoffswitch-label" for="c_' . $aRow['id'] . '"></label>
</div>';

    $staff = '<a data-toggle="tooltip" data-original-title="' . get_staff_full_name($aRow['staff_id']) . '" href="' . admin_url('staff/profile/' . $aRow['staff_id']) . '">' . staff_profile_image($aRow['staff_id'], [
        'staff-profile-image-small',
    ]) . '</a>';
    $row[] =  $staff;

    $row[] =  $aRow['datetime'];

    $row[] =  '<button type="button" class="btn btn-info" style="margin-right: 10px;" onclick="category_edit(\'' . $aRow['id'] . '\',\'' . $aRow['name'] . '\', \'' . base_url('modules/betting/upload/category/' . $aRow['image']) . '\')"><i class="fa fa-edit"></i></button> <button  type="button" class="btn btn-info" onclick="bet.common_delete(\'' . admin_url('betting/admin/category_delete/' . $aRow['id']) . '\')"><i class="fa fa-trash"></i></button>';
    $output['aaData'][] = $row;
}
