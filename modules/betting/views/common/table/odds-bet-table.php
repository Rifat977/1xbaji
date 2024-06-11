<?php

defined('BASEPATH') or exit('No direct script access allowed');


$this->ci->load->model('corn_model');

$aColumns = [
    db_prefix() . 'betting.id as id',
    'rel_id as sports_key', //rel_id
    db_prefix() . 'odds_sports.groups as groups',
    db_prefix() . 'odds_sports.title as title',
    db_prefix() . 'odds_sports.description as description',
    db_prefix() . 'betting.is_active as is_active',
    db_prefix() . 'betting.staff_id as staff_id',
    db_prefix() . 'betting.datetime as datetime',
];
$sIndexColumn = 'id';
$sTable       = db_prefix() . 'betting';
$join         = [
    'LEFT JOIN ' . db_prefix() . 'staff ON ' . db_prefix() . 'staff.staffid = ' . db_prefix() . 'betting.staff_id',
    'LEFT JOIN ' . db_prefix() . 'odds_sports ON ' . db_prefix() . 'odds_sports.sports_key = ' . db_prefix() . 'betting.rel_id',
];
$where = [];


if ($this->ci->input->post('group')) {
    array_push($where, ' AND ' . db_prefix() . 'odds_sports.' . 'groups="' .  $this->ci->db->escape_str($this->ci->input->post('group')) . '" ');
}

if ($this->ci->input->post('active')) {
    array_push($where, ' AND ' . db_prefix() . 'betting.' . 'is_active=' .  $this->ci->db->escape_str($this->ci->input->post('active') - 1) . ' ');
}


$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where);

$output  = $result['output'];
$rResult = $result['rResult'];
foreach ($rResult as $key => $aRow) {
    $row = [];
    $row[] =  $key + 1;
    $row[] =  $aRow['sports_key'];
    $row[] =  $aRow['groups'];
    $row[] =  $aRow['title'];
    $row[] =  $aRow['description'];

    $staff = '<a data-toggle="tooltip" data-original-title="' . get_staff_full_name($aRow['staff_id']) . '" href="' . admin_url('staff/profile/' . $aRow['staff_id']) . '">' . staff_profile_image($aRow['staff_id'], [
        'staff-profile-image-small',
    ]) . '</a>';
    $row[] =  $staff;

    $row[] =  $aRow['datetime'];

    $check = '';
    if ($aRow['is_active'] == 1) {
        $check = 'checked';
    }

    $_data = '<div class="onoffswitch">
    <input type="checkbox"  name="onoffswitch" class="onoffswitch-checkbox" onchange="on_off_switch(' . $aRow['id'] . ',' . $check . ')" id="c_' . $aRow['id'] . '" data-id="' . $aRow['id'] . '" ' . $check . '>
    <label class="onoffswitch-label" for="c_' . $aRow['id'] . '"></label>
</div>';
    $row[] =  $_data;
    $data =  $this->ci->corn_model->userbet(['id' => $aRow['id']]);
    $bet = $data['count'];
    $status =  $bet > 0 ? ' <span style="color:white;">' . $bet . '</span>' : '';
    $row[] =   '<button class="btn btn-info" onclick="bet.view(' . $aRow['id'] . ')" ><i class="fa fa-eye"></i></button> <button class="btn btn-danger"  onclick="delete_(' . $aRow['id'] . ')" ><i class="fa fa-trash"></i></button> <button class="btn btn-success" onclick="bet.winloss(' . $aRow['id'] . ')" ><i class="fa fa-trophy"></i> ' . $status . ' </button>';
    $output['aaData'][] = $row;
}
