<?php

defined('BASEPATH') or exit('No direct script access allowed');

$this->ci->load->model('gdpr_model');

$consentContacts = get_option('gdpr_enable_consent_for_contacts');
$aColumns        = ['firstname', 'lastname'];
if (is_gdpr() && $consentContacts == '1') {
    array_push($aColumns, '1');
}

$aColumns = array_merge($aColumns, [
    'email',
    'company',
    db_prefix() . 'contacts.phonenumber as phonenumber',
    'title',
    'last_login',
    'agent_deposit',
    'agent_withdrow',
    db_prefix() . 'contacts.active as active',
]);

$sIndexColumn = 'id';
$sTable       = db_prefix() . 'contacts';
$join         = ['JOIN ' . db_prefix() . 'clients ON ' . db_prefix() . 'clients.userid=' . db_prefix() . 'contacts.userid'];

$where = [];
if ($this->ci->input->post('agent_information')) {
    array_push($where, ' AND (id= ' . ($this->ci->input->post('agent_information')) . ' ) ');
}
if ($this->ci->input->post('country_information')) {
    array_push($where, ' AND (' . db_prefix() . 'clients.country= ' . ($this->ci->input->post('country_information')) . ' ) ');
}

$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, [db_prefix() . 'contacts.id as id', db_prefix() . 'contacts.userid as userid', 'is_primary', '(SELECT count(*) FROM ' . db_prefix() . 'contacts c WHERE c.userid=' . db_prefix() . 'contacts.userid) as total_contacts', db_prefix() . 'clients.registration_confirmed as registration_confirmed']);

$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];
    $row[] = 'A-' . $aRow['id'];
    $rowName = '<img src="' . contact_profile_image_url($aRow['id']) . '" class="client-profile-image-small mright5"><a href="#" onclick="contact(' . $aRow['userid'] . ',' . $aRow['id'] . ');return false;">' . $aRow['firstname'] . ' ' . $aRow['lastname'] . '</a>';

    $rowName .= '<div class="row-options">';

    //    $rowName .= '<a href="#" onclick="contact(' . $aRow['userid'] . ',' . $aRow['id'] . ');return false;">' . _l('edit') . '</a>';

    $rowName .= '</div>';

    $row[] = $rowName;



    if (is_gdpr() && $consentContacts == '1') {
        $consentHTML = '<p class="bold"><a href="#" onclick="view_contact_consent(' . $aRow['id'] . '); return false;">' . _l('view_consent') . '</a></p>';
        $consents    = $this->ci->gdpr_model->get_consent_purposes($aRow['id'], 'contact');
        foreach ($consents as $consent) {
            $consentHTML .= '<p style="margin-bottom:0px;">' . $consent['name'] . (!empty($consent['consent_given']) ? '<i class="fa fa-check text-success pull-right"></i>' : '<i class="fa fa-remove text-danger pull-right"></i>') . '</p>';
        }
        $row[] = $consentHTML;
    }

    $row[] = '<a href="mailto:' . $aRow['email'] . '">' . $aRow['email'] . '</a>';

    if (!empty($aRow['company'])) {
        $row[] = '<a href="' . admin_url('clients/client/' . $aRow['userid']) . '">' . $aRow['company'] . '</a>';
    } else {
        $row[] = '';
    }

    $row[] = '<a href="tel:' . $aRow['phonenumber'] . '">' . $aRow['phonenumber'] . '</a>';

    $row[] = $aRow['title'];

    $row[] = (!empty($aRow['last_login']) ? '<span class="text-has-action is-date" data-toggle="tooltip" data-title="' . _dt($aRow['last_login']) . '">' . time_ago($aRow['last_login']) . '</span>' : '');

    $outputActive = '<div class="onoffswitch">
                <input type="checkbox"' . ($aRow['registration_confirmed'] == 0 ? ' disabled' : '') . ' data-switch-url="' . admin_url() . 'clients/change_contact_status" name="onoffswitch" class="onoffswitch-checkbox" id="c_' . $aRow['id'] . '" data-id="' . $aRow['id'] . '"' . ($aRow['active'] == 1 ? ' checked' : '') . '>
                <label class="onoffswitch-label" for="c_' . $aRow['id'] . '"></label>
            </div>';
    // For exporting
    $outputActive .= '<span class="hide">' . ($aRow['active'] == 1 ? _l('is_active_export') : _l('is_not_active_export')) . '</span>';

    $row[] = $outputActive;
    // Custom fields add values
    foreach ($customFieldsColumns as $customFieldColumn) {
        $row[] = (strpos($customFieldColumn, 'date_picker_') !== false ? _d($aRow[$customFieldColumn]) : $aRow[$customFieldColumn]);
    }

    $row['DT_RowClass'] = 'has-row-options';

    if ($aRow['registration_confirmed'] == 0) {
        $row['DT_RowClass'] .= ' info requires-confirmation';
        $row['Data_Title']  = _l('customer_requires_registration_confirmation');
        $row['Data_Toggle'] = 'tooltip';
    }
    $row[] = agent_country($aRow['id']);
    $row[] = $aRow['agent_deposit'] . '%' . ' - ' . $aRow['agent_withdrow'] . '%';
    $row[] = number_format(agent_current_balance($aRow['id']), 2);
    $row[] = '<button class="btn btn-info" onclick="comission_model(' . $aRow['id'] . ')"><i class="fa fa-plus"></i></button> <button class="btn btn-info" onclick="view_history(' . $aRow['id'] . ')"><i class="fa fa-eye"></i> </button>';
    $row = hooks()->apply_filters('all_contacts_table_row', $row, $aRow);

    $output['aaData'][] = $row;
}
