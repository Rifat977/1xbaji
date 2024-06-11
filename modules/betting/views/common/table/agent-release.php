<?php

defined('BASEPATH') or exit('No direct script access allowed');



$aColumns = [
    'id',
    'staff_id',
    'amount',
    'address',
    'status',
    'create_at',
];
$sIndexColumn = 'id';
$sTable       = db_prefix() . 'bet_agent_comission_withdraw';
$join         = [
    'JOIN ' . db_prefix() . 'staff ON ' . db_prefix() . 'staff.staffid = ' . db_prefix() . 'bet_agent_comission_withdraw.staff_id',
];

$where = [];



// if ($this->ci->input->post('agent_withdrow_history')) {
//     array_push($where, ' AND (contact_id= ' . $this->ci->input->post('agent_withdrow_history') . ' ) ');
// }

$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where);

$output  = $result['output'];
$rResult = $result['rResult'];
foreach ($rResult as $key => $aRow) {
    $row = [];
    $row[] =  $aRow['id'];
    $row[] =  get_staff_full_name($aRow['staff_id']);
    $row[] =  number_format($aRow['amount'],2);
    $row[] =  number_format(($aRow['amount']-2),2);
    $row[] =  $aRow['address'];
    $status = '';
    if($aRow['status']==0){
        $status = '<span class="inline-block label" style="color: #ddae22;border: 1px solid #e9bb15;">Pending</span>';
    }
    else if($aRow['status']==1){
        $status = '<span class="inline-block label" style="color: #1aa811;border: 1px solid #0b9139;">Approved</span>';
    }
    else{
        $status = '<span class="inline-block label" style="color: #dd2265;border: 1px solid #e9155a;">Reject</span>';
    }
    $row[] =  $status;

    $row[] =  $aRow['create_at'];

    $action = '';
    if(is_admin() && $aRow['status']==0){
        $action='<a href="#" data-toggle="tooltip" data-original-title="Accept" onclick="accept_status('.$aRow['id'].')" class="btn btn-info"><i class="fa fa-check"></i></a>
        <a href="#" data-toggle="tooltip" data-original-title="Reject" onclick="reject_status('.$aRow['id'].')" class="btn btn-danger"><i class="fa fa-times"></i></a>';
    }
    $row[] = $action;

    $output['aaData'][] = $row;
}
