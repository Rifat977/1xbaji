<?php

defined('BASEPATH') or exit('No direct script access allowed');



$aColumns = [
    'affiliate_id',
    db_prefix() . 'user.full_name as name',
    'affiliate_withdrow',
    'create_date'

];
$sIndexColumn = 'affiliate_id';
$sTable       = db_prefix() . 'affiliate_history';
$join         = ['JOIN ' . db_prefix() . 'user ON ' . db_prefix() . 'user.id = ' . db_prefix() . 'affiliate_history.user_id'];
$where = [];



$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where);

$output  = $result['output'];
$rResult = $result['rResult'];
$num=0;
foreach ($rResult as $key => $aRow) {
    $num=$num+1;
    $row = [];
    $row[] =  $num;
    $row[] =  $aRow['name'];
    $row[] =  number_format($aRow['affiliate_withdrow'],2);
    $row[] =  $aRow['create_date'];

    
    // $row[] =  '<a href="' . admin_url('betting/admin/add_user/' . $aRow['uid']) . '" class="btn btn-info"><i class="fa fa-edit"></i></a><button  type="button" class="btn btn-info" onclick="bet.common_delete(\'' . admin_url('betting/admin/user_delete/' . $aRow['uid']) . '\')"><i class="fa fa-trash"></i></button>';
    $output['aaData'][] = $row;
}
