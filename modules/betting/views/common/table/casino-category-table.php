<?php

defined('BASEPATH') or exit('No direct script access allowed');



$aColumns = [
    'id',
    'type_name',
    'type_image',
    'is_api',
    'order_by',
    'is_active',

];
$sIndexColumn = 'id';
$sTable       = db_prefix() . 'bet_game_type';
$where = [];


$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $where);

$output  = $result['output'];
$rResult = $result['rResult'];
foreach ($rResult as $key => $aRow) {
    $row = [];
    $row[] =  $key + 1;
    $row[] =  $aRow['type_name'];
    $row[] = '<img src="' . base_url('modules/betting/upload/game-type/'.$aRow['type_image']) . '" class="img-fluid staff-profile-image-small">';
    $row[] =  $aRow['order_by'];
    $check = '';
    if ($aRow['is_active'] == 1) {
        $check = 'checked';
    }

    $_data = '<div class="onoffswitch">
    <input type="checkbox"  name="onoffswitch" class="onoffswitch-checkbox" onchange="on_off_switch_type(' . $aRow['id'] . ',' . $check . ')" id="c_' . $aRow['id'] . '" data-id="' . $aRow['id'] . '" ' . $check . '>
    <label class="onoffswitch-label" for="c_' . $aRow['id'] . '"></label>
</div>';
    $row[] =  $_data;
    $edit = '<button data-toggle="tooltip" title="Edit"  type="button" class="btn btn-info" onclick="casino_category_edit(\'' . $aRow['id'] . '\',\'' . $aRow['type_name'] . '\',\'' . $aRow['type_image'] . '\',\'' . $aRow['order_by'] . '\')"><i class="fa fa-edit"></i></button>';
    $dlet = '<button data-toggle="tooltip" title="Delete" type="button" class="btn btn-danger mleft5" onclick="bet.common_delete(\'' . admin_url('betting/admin/casino_category_delete/' . $aRow['id']) . '\')"><i class="fa fa-trash"></i></button>';
    
    $action = $edit;
    if (!$aRow['is_api']) {
        $action .= ' ' . $dlet;
    }
    $row[] = $action;
    $output['aaData'][] = $row;
}
