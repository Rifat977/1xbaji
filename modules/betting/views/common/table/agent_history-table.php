<?php

defined('BASEPATH') or exit('No direct script access allowed');



$aColumns = [

    'tblcontacts.id as agent_id',
    'CONCAT(tblcontacts.firstname, \' \', tblcontacts.lastname) as name',
    'balance',
    'remark',
    'create_date',
    'create_at',


];
$sIndexColumn = 'id';
$sTable       = db_prefix() . 'agent_history';
$join         = [
    'JOIN ' . db_prefix() . 'contacts ON ' . db_prefix() . 'contacts.id = ' . db_prefix() . 'agent_history.agent_id',

];
$where = [];

if ($this->ci->input->post('agent_id_hidden')) {
    array_push($where, ' AND (agent_id= ' . $this->ci->input->post('agent_id_hidden') . ' ) ');
}



$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where);

$output  = $result['output'];
$rResult = $result['rResult'];
foreach ($rResult as $key => $aRow) {
    $row = [];
    $row[] =  'A-' . $aRow['agent_id'];
    $row[] =  $aRow['name'];
    $row[] =  $aRow['balance'];
    $row[] =  $aRow['remark'];
    $row[] =  $aRow['create_date'];
    $row[] =  get_staff_full_name($aRow['create_at']);


    // $row[] =  '<a href="' . admin_url('betting/admin/add_user/' . $aRow['uid']) . '" class="btn btn-info"><i class="fa fa-edit"></i></a><button  type="button" class="btn btn-info" onclick="bet.common_delete(\'' . admin_url('betting/admin/user_delete/' . $aRow['uid']) . '\')"><i class="fa fa-trash"></i></button>';
    $output['aaData'][] = $row;
}
