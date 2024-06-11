<?php

defined('BASEPATH') or exit('No direct script access allowed');



$aColumns = [
    'sports_key',
    'groups',
    'title',
    'description',
    'is_active',
    'has_outrights',
    'bet',
    'staff_id',
    'datetime',
];
$sIndexColumn = 'id';
$sTable       = db_prefix() . 'odds_sports';
$join         = ['LEFT JOIN ' . db_prefix() . 'staff ON ' . db_prefix() . 'staff.staffid = ' . db_prefix() . 'odds_sports.staff_id'];
$where = [];


if ($this->ci->input->post('group')) {
    array_push($where, ' AND groups="' .  $this->ci->db->escape_str($this->ci->input->post('group')) . '" ');
}

if ($this->ci->input->post('active')) {
    array_push($where, ' AND is_active=' .  $this->ci->db->escape_str($this->ci->input->post('active') - 1) . ' ');
}

if ($this->ci->input->post('has_outrights')) {
    array_push($where, ' AND has_outrights=' .  $this->ci->db->escape_str($this->ci->input->post('has_outrights') - 1) . ' ');
}
if ($this->ci->input->post('betting')) {
    array_push($where, ' AND bet=' .  $this->ci->db->escape_str($this->ci->input->post('betting') - 1) . ' ');
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
    $is_active = '';
    if ($aRow['is_active'] == 1) {
        $is_active = '<span class="label" style="border: 1px solid #7cb342;color:#7cb342;">' . _l('b_active') . '</span>';
    } else {
        $is_active = '<span class="label" style="border: 1px solid red;color:red;">' . _l('b_deactivate') . '</span>';
    }
    $row[] =  $is_active;

    $has_outrights = '';
    if ($aRow['has_outrights'] == 1) {
        $has_outrights = '<span class="label" style="border: 1px solid #7cb342;color:#7cb342;">' . _l('b_active') . '</span>';
    } else {
        $has_outrights = '<span class="label" style="border: 1px solid red;color:red;">' . _l('b_deactivate') . '</span>';
    }
    $row[] =  $has_outrights;

    $staff = '<a data-toggle="tooltip" data-original-title="' . get_staff_full_name($aRow['staff_id']) . '" href="' . admin_url('staff/profile/' . $aRow['staff_id']) . '">' . staff_profile_image($aRow['staff_id'], [
        'staff-profile-image-small',
    ]) . '</a>';
    $row[] =  $staff;
    $row[] =  $aRow['datetime'];

    $bet = '';
    if ($aRow['bet'] == 1) {
        $bet = '<span class="label" style="border: 1px solid #7cb342;color:#7cb342;">' . _l('b_active') . '</span>';
    } else {
        $bet = '<span class="label" style="border: 1px solid red;color:red;">' . _l('b_deactivate') . '</span>';
    }
    $row[] =  $bet;
    $row[] =  '<button class="btn btn-info" onclick="odds_sports(\'' . $aRow['sports_key'] . '\',\'' . $aRow['groups'] . '\',\'' . $aRow['description'] . '\')"><i class="fa fa-plus"></i></button>';
    $output['aaData'][] = $row;
}
