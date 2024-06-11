<?php

defined('BASEPATH') or exit('No direct script access allowed');



$aColumns = [
    'id',
    'title',
    'details',
    'link',
    'image',
    'is_active',
];
$sIndexColumn = 'id';
$sTable       = db_prefix() . 'bet_promotion';
$join         = [];

$where = [];
//image	title	details	link	is_active


// if ($this->ci->input->post('agent_withdrow_history')) {
//     array_push($where, ' AND (contact_id= ' . $this->ci->input->post('agent_withdrow_history') . ' ) ');
// }

$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where);

$output  = $result['output'];
$rResult = $result['rResult'];
foreach ($rResult as $key => $aRow) {
    $row = [];
    $row[] =  $aRow['id'];
    $row[] =  $aRow['title'];
    $row[] =  $aRow['details'];
    

    $row[] =  '<img width="200px" src="' . base_url('modules/betting/upload/promotion/' . $aRow['image']) . '">';
    $row[] =  $aRow['link'];

    // $row[] = '<div class="onoffswitch mtop10 text-center" data-toggle="tooltip" title="" data-original-title="Footer">
    //             <input type="checkbox" onchange="status_change(' . $aRow['id'] . ')" class="onoffswitch-checkbox" id="fo_' . $aRow['id'] . '" ' . ($aRow['is_active'] == 1 ? 'checked' : '') . ' >
    //             <label class="onoffswitch-label" for="fo_' . $aRow['id'] . '"></label>
    //         </div>';

    $row[] = '<button class="btn btn-danger" onclick="delete_promotion('.$aRow['id'].')"><i class="fa fa-trash"></button>';
    $output['aaData'][] = $row;
}
