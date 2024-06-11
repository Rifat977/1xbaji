<?php

defined('BASEPATH') or exit('No direct script access allowed');



$aColumns = [
    db_prefix() . 'withraw_history.id as uid',
    db_prefix() . 'user.full_name as user_name',
    'details',
    'tblcurrencies.name as currency_name',
    'amount',
    'status',
    db_prefix() . 'withraw_history.datetime as date',
];
$sIndexColumn = 'id';
$sTable       = db_prefix() . 'withraw_history';
$join         = [
    'JOIN ' . db_prefix() . 'user ON ' . db_prefix() . 'user.id = ' . db_prefix() . 'withraw_history.user_id',
    'JOIN ' . db_prefix() . 'currencies ON ' . db_prefix() . 'currencies.id = ' . db_prefix() . 'withraw_history.currency_id',
];

$where = [];



if ($this->ci->input->post('agent_withdrow_history')) {
    array_push($where, ' AND (tblwithraw_history.contact_id= ' . $this->ci->input->post('agent_withdrow_history') . ' ) ');
}

$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where);

$output  = $result['output'];
$rResult = $result['rResult'];
foreach ($rResult as $key => $aRow) {
    $row = [];
    $row[] =  'USR-'.$aRow['uid'];
    $row[] =  $aRow['user_name'];
    $row[] =  $aRow['currency_name'];
    $row[] =  $aRow['details'];
    $row[] =  number_format($aRow['amount'], 2);

    $row[] =  $aRow['date'];

    $row[] = deposit_status((($this->ci->input->post('online') == 2) ? $aRow['status'] : ($aRow['status'] == 0 ? 4 : $aRow['status'])), $aRow['uid']);

    $output['aaData'][] = $row;
}
