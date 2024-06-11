<?php

defined('BASEPATH') or exit('No direct script access allowed');



$aColumns = [
    'id',
    'contract_id',
    'deposit_commission',
    'deposit_amount',
    'withdrow_commission',
    'withdrow_amount',
    'staff_id',
    'create_date',

];
$sIndexColumn = 'id';
$sTable       = db_prefix() . 'commission_history';
$join         = [];
$where = [];

if ($this->ci->input->post('user_info_get')) {
    array_push($where, ' AND (deposit_user_id= ' . $this->ci->input->post('user_info_get') . ' ) ');
}

if ($this->ci->input->post('payment_info')) {
    array_push($where, ' AND (status= ' . ($this->ci->input->post('payment_info') - 1) . ' ) ');
}


$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where);

$output  = $result['output'];
$rResult = $result['rResult'];
foreach ($rResult as $key => $aRow) {
    $row = [];
    $row[] =  $aRow['id'];
    $row[] =  agent_full_name($aRow['contract_id']);
    $row[] =  number_format($aRow['deposit_commission'],2).'%';
    $row[] =  number_format($aRow['deposit_amount'],2);
    $row[] =  number_format($aRow['withdrow_commission'],2).'%';
    $row[] =  number_format($aRow['withdrow_amount'],2);
    $row[] =  get_staff_full_name($aRow['staff_id']);
    $row[] =  $aRow['create_date'];

    
    // $row[] =  '<a href="' . admin_url('betting/admin/add_user/' . $aRow['uid']) . '" class="btn btn-info"><i class="fa fa-edit"></i></a><button  type="button" class="btn btn-info" onclick="bet.common_delete(\'' . admin_url('betting/admin/user_delete/' . $aRow['uid']) . '\')"><i class="fa fa-trash"></i></button>';
    $output['aaData'][] = $row;
}
