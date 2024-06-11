<?php

defined('BASEPATH') or exit('No direct script access allowed');



$aColumns = [
    db_prefix() . 'bet_game_list.id as g_id',
    'game_name',
    'category',
    'image_url',
    'provider_id',
    'is_hot',
    db_prefix() . 'bet_game_type.type_name as name',
];
$sIndexColumn = 'id';
$sTable       = db_prefix() . 'bet_game_list';
$join         = [
    'LEFT JOIN ' . db_prefix() . 'bet_game_type ON ' . db_prefix() . 'bet_game_type.type_id = ' . db_prefix() . 'bet_game_list.game_type',
];
$where = [];


$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where);

$output  = $result['output'];
$rResult = $result['rResult'];
foreach ($rResult as $key => $aRow) {

    $row = [];
    $row[] =  $key + 1;
    $row[] = '<img src="' . $aRow['image_url'] . '" class="img-fluid staff-profile-image-small">';
    $row[] =  $aRow['game_name'];
    $row[] =  $aRow['category'];
    $row[] =  get_provider_name($aRow['provider_id']);
    $row[] =  $aRow['name'];
    $_data = '';
    if ($aRow['is_hot'] == 1) {
        $_data = '<i class="fa-solid fa-chess-queen text-danger
         fs-6 mb-1" data-bs-toggle="tooltip" style="color:red" data-bs-placement="top" aria-label="Hot Game" data-bs-original-title="Hot Game"></i>';
    }

    
    $row[] =  $_data;
    $row[] = '<button data-toggle="tooltip" title="Edit"  type="button" class="btn btn-info" onclick="game_edit(\'' . $aRow['g_id'] . '\')"><i class="fa fa-edit"></i></button>';


    $output['aaData'][] = $row;
}
