<?php

defined('BASEPATH') or exit('No direct script access allowed');



$aColumns = [
    'id',
    'agent_id',
    'deposit_amount',
    'commission',
    'local_currency_id',
    'local_amount_commission',
    'currency_amount',
    'usd_amount_commission',
    'staff_id',


];
$sIndexColumn = 'id';
$sTable       = db_prefix() . 'bet_agent_comission';
$join         = [];
$where = [];

if (!is_admin()) {
    array_push($where, ' AND (staff_id= ' . (get_staff_user_id()) . ' ) ');
}




$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where);

$output  = $result['output'];
$rResult = $result['rResult'];
foreach ($rResult as $key => $aRow) {
    $row = [];
    $row[] =  $key + 1;
    $row[] =  get_agent_name($aRow['agent_id']);
    $row[] =  number_format($aRow['deposit_amount'], 2);
    $row[] =  $aRow['commission'] . '%';
    $row[] =  get_currency_name($aRow['local_currency_id']);
    $row[] =  number_format($aRow['currency_amount'], 2);
    $row[] =  get_currency_symble($aRow['local_currency_id']) . ' ' . number_format($aRow['local_amount_commission'], 2);
    $row[] =  '$ ' . number_format($aRow['usd_amount_commission'], 2);
    $row[] =  get_staff_full_name($aRow['staff_id']);



    // $row[] =  '<a href="' . admin_url('betting/admin/add_user/' . $aRow['uid']) . '" class="btn btn-info"><i class="fa fa-edit"></i></a><button  type="button" class="btn btn-info" onclick="bet.common_delete(\'' . admin_url('betting/admin/user_delete/' . $aRow['uid']) . '\')"><i class="fa fa-trash"></i></button>';
    $output['aaData'][] = $row;
}
