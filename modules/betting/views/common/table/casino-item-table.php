<?php

defined('BASEPATH') or exit('No direct script access allowed');



$aColumns = [
    db_prefix() . 'bet_provider.id as uid',
    'provider_id',
    'provider_name',
    'provider_type',
    'provider_image',
    db_prefix() . 'bet_provider.is_active as active',
    db_prefix() . 'bet_game_type.type_name as name',
];
$sIndexColumn = 'id';
$sTable       = db_prefix() . 'bet_provider';
$join         = ['LEFT JOIN ' . db_prefix() . 'bet_game_type ON ' . db_prefix() . 'bet_game_type.type_id = ' . db_prefix() . 'bet_provider.provider_type'];
$where = [];


$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where);

$output  = $result['output'];
$rResult = $result['rResult'];
foreach ($rResult as $key => $aRow) {

    $row = [];
    $row[] =  $key + 1;
    $row[] =  $aRow['provider_id'];
    $row[] =  $aRow['provider_name'];
    $row[] = '<img src="' . base_url('modules/betting/upload/game-type/' . $aRow['provider_image']) . '" class="img-fluid staff-profile-image-small">';
    $row[] = $aRow['name'];
    $check = '';
    if ($aRow['active'] == 1) {
        $check = 'checked';
    }

    $_data = '<div class="onoffswitch">
    <input type="checkbox"  name="onoffswitch" class="onoffswitch-checkbox" onchange="on_off_switch_provider(' . $aRow['uid'] . ',' . $check . ')" id="c_' . $aRow['uid'] . '" data-id="' . $aRow['uid'] . '" ' . $check . '>
    <label class="onoffswitch-label" for="c_' . $aRow['uid'] . '"></label>
</div>';
    $row[] =  $_data;

    $edit = '<button data-toggle="tooltip" title="Edit"  type="button" class="btn btn-info" onclick="provider_edit_f(\'' . $aRow['uid'] . '\',\'' . $aRow['provider_name'] . '\',\'' . $aRow['provider_image'] . '\')"><i class="fa fa-edit"></i></button>';
    $sync = '<button id="sync_bttn_' . $aRow['provider_id'] . '_' . $aRow['provider_type'] . '" data-toggle="tooltip" title="Sync" type="button" class="btn btn-primary mleft5" onclick="sync_by_provider(\'' . $aRow['provider_id'] .  '\',\'' . $aRow['provider_type'] . '\')"><i class="fa fa-refresh"></i></button>';
    $sync_wait = '<button id="display_wati_' . $aRow['provider_id'] . '_' . $aRow['provider_type'] . '" style="display: none"; data-toggle="tooltip" title="Syncing..." type="button" class="btn btn-primary mleft5"> <i class="fas fa-sync fa-spin"></i></button>';
    $row[] = $edit . $sync . ' ' . $sync_wait;

    $output['aaData'][] = $row;
}
