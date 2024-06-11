<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-08-31 10:42:05 --> Query error: Unknown column 'sports_key' in 'field list' - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS sports_key, groups, title, description, is_active, has_outrights, bet, staff_id, datetime 
    FROM tblsports_category
    LEFT JOIN tblstaff ON tblstaff.staffid = tblsports_category.staff_id
    
    
    
    ORDER BY sports_key ASC
    LIMIT 0, 25
    
ERROR - 2023-08-31 10:48:06 --> Query error: Unknown column 'is_active' in 'field list' - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS name, image, staff_id, is_active, has_outrights, bet, staff_id, datetime 
    FROM tblsports_category
    LEFT JOIN tblstaff ON tblstaff.staffid = tblsports_category.staff_id
    
    
    
    ORDER BY name ASC
    LIMIT 0, 25
    
ERROR - 2023-08-31 11:09:45 --> Severity: Warning --> strpos() expects parameter 1 to be string, array given D:\wamp64\www\valkey\system\helpers\form_helper.php 74
ERROR - 2023-08-31 11:09:45 --> Severity: Notice --> Array to string conversion D:\wamp64\www\valkey\system\helpers\form_helper.php 91
ERROR - 2023-08-31 11:09:45 --> Severity: Warning --> strpos() expects parameter 1 to be string, array given D:\wamp64\www\valkey\system\helpers\form_helper.php 102
ERROR - 2023-08-31 11:12:26 --> Severity: Notice --> Undefined index: image D:\wamp64\www\valkey\modules\betting\controllers\Admin.php 159
ERROR - 2023-08-31 11:12:26 --> Severity: Notice --> Trying to access array offset on value of type null D:\wamp64\www\valkey\modules\betting\controllers\Admin.php 159
ERROR - 2023-08-31 11:12:26 --> Query error: Unknown column 'staffid' in 'field list' - Invalid query: INSERT INTO `tblsports_category` (`name`, `image`, `staffid`) VALUES (NULL, '', '1')
ERROR - 2023-08-31 11:16:24 --> Query error: Unknown column 'staffid' in 'field list' - Invalid query: INSERT INTO `tblsports_category` (`name`, `image`, `staffid`) VALUES ('Khulna-category-support', 'bGFiZWwtd2l0aC1kZW1vLW1lZ2FwaG9uZS1tYXJrZXRpbmctYW5ub3VuY2VtZW50LXZlY3Rvci00MjE4NDUyNS5qcGc=', '1')
ERROR - 2023-08-31 11:50:50 --> Severity: Notice --> Undefined index: id D:\wamp64\www\valkey\modules\betting\views\common\table\category-table.php 47
ERROR - 2023-08-31 11:50:50 --> Severity: Notice --> Undefined index: id D:\wamp64\www\valkey\modules\betting\views\common\table\category-table.php 47
ERROR - 2023-08-31 11:50:50 --> Severity: Notice --> Undefined index: id D:\wamp64\www\valkey\modules\betting\views\common\table\category-table.php 47
ERROR - 2023-08-31 11:50:50 --> Severity: Notice --> Undefined index: id D:\wamp64\www\valkey\modules\betting\views\common\table\category-table.php 47
ERROR - 2023-08-31 11:50:50 --> Severity: Notice --> Undefined index: id D:\wamp64\www\valkey\modules\betting\views\common\table\category-table.php 47
ERROR - 2023-08-31 13:03:28 --> Severity: error --> Exception: syntax error, unexpected 'Are' (T_STRING) D:\wamp64\www\valkey\modules\betting\views\common\table\category-table.php 48
ERROR - 2023-08-31 13:03:45 --> Severity: error --> Exception: syntax error, unexpected 'Are' (T_STRING) D:\wamp64\www\valkey\modules\betting\views\common\table\category-table.php 48
ERROR - 2023-08-31 07:08:18 --> 404 Page Not Found: ../../modules/betting/controllers/Admin/category_delete9
ERROR - 2023-08-31 07:08:47 --> 404 Page Not Found: ../../modules/betting/controllers/Admin/category_delete9
ERROR - 2023-08-31 07:15:11 --> 404 Page Not Found: admin/Upload/category
ERROR - 2023-08-31 07:15:11 --> 404 Page Not Found: admin/Upload/category
ERROR - 2023-08-31 07:15:11 --> 404 Page Not Found: admin/Upload/category
ERROR - 2023-08-31 07:15:39 --> 404 Page Not Found: admin/Upload/category
ERROR - 2023-08-31 07:15:39 --> 404 Page Not Found: admin/Upload/category
ERROR - 2023-08-31 07:15:39 --> 404 Page Not Found: admin/Upload/category
ERROR - 2023-08-31 07:16:11 --> 404 Page Not Found: /index
ERROR - 2023-08-31 07:16:50 --> 404 Page Not Found: /index
ERROR - 2023-08-31 07:17:08 --> 404 Page Not Found: /index
ERROR - 2023-08-31 13:22:03 --> Severity: Notice --> Undefined variable: id_active D:\wamp64\www\valkey\modules\betting\views\common\table\category-table.php 47
ERROR - 2023-08-31 13:22:03 --> Severity: Notice --> Undefined variable: id_active D:\wamp64\www\valkey\modules\betting\views\common\table\category-table.php 47
ERROR - 2023-08-31 13:22:03 --> Severity: Notice --> Undefined variable: id_active D:\wamp64\www\valkey\modules\betting\views\common\table\category-table.php 47
ERROR - 2023-08-31 13:22:03 --> Severity: Notice --> Undefined variable: id_active D:\wamp64\www\valkey\modules\betting\views\common\table\category-table.php 47
ERROR - 2023-08-31 13:22:03 --> Severity: Notice --> Undefined variable: id_active D:\wamp64\www\valkey\modules\betting\views\common\table\category-table.php 47
ERROR - 2023-08-31 14:15:53 --> Severity: Notice --> Undefined index: id_status D:\wamp64\www\valkey\modules\betting\views\common\table\category-table.php 44
ERROR - 2023-08-31 14:15:53 --> Severity: Notice --> Undefined index: id_status D:\wamp64\www\valkey\modules\betting\views\common\table\category-table.php 44
ERROR - 2023-08-31 14:15:53 --> Severity: Notice --> Undefined index: id_status D:\wamp64\www\valkey\modules\betting\views\common\table\category-table.php 44
ERROR - 2023-08-31 14:15:53 --> Severity: Notice --> Undefined index: id_status D:\wamp64\www\valkey\modules\betting\views\common\table\category-table.php 44
ERROR - 2023-08-31 14:16:06 --> Severity: Notice --> Undefined index: id_status D:\wamp64\www\valkey\modules\betting\views\common\table\category-table.php 44
ERROR - 2023-08-31 14:16:06 --> Severity: Notice --> Undefined index: id_status D:\wamp64\www\valkey\modules\betting\views\common\table\category-table.php 44
ERROR - 2023-08-31 14:16:06 --> Severity: Notice --> Undefined index: id_status D:\wamp64\www\valkey\modules\betting\views\common\table\category-table.php 44
ERROR - 2023-08-31 14:16:06 --> Severity: Notice --> Undefined index: id_status D:\wamp64\www\valkey\modules\betting\views\common\table\category-table.php 44
ERROR - 2023-08-31 14:16:13 --> Severity: Notice --> Undefined index: id_status D:\wamp64\www\valkey\modules\betting\views\common\table\category-table.php 44
ERROR - 2023-08-31 14:16:13 --> Severity: Notice --> Undefined index: id_status D:\wamp64\www\valkey\modules\betting\views\common\table\category-table.php 44
ERROR - 2023-08-31 14:16:13 --> Severity: Notice --> Undefined index: id_status D:\wamp64\www\valkey\modules\betting\views\common\table\category-table.php 44
ERROR - 2023-08-31 14:16:13 --> Severity: Notice --> Undefined index: id_status D:\wamp64\www\valkey\modules\betting\views\common\table\category-table.php 44
ERROR - 2023-08-31 14:16:22 --> Severity: Notice --> Undefined index: id_status D:\wamp64\www\valkey\modules\betting\views\common\table\category-table.php 44
ERROR - 2023-08-31 14:16:22 --> Severity: Notice --> Undefined index: id_status D:\wamp64\www\valkey\modules\betting\views\common\table\category-table.php 44
ERROR - 2023-08-31 14:16:22 --> Severity: Notice --> Undefined index: id_status D:\wamp64\www\valkey\modules\betting\views\common\table\category-table.php 44
ERROR - 2023-08-31 14:16:22 --> Severity: Notice --> Undefined index: id_status D:\wamp64\www\valkey\modules\betting\views\common\table\category-table.php 44
ERROR - 2023-08-31 15:46:29 --> Severity: Notice --> Undefined variable: modal D:\wamp64\www\valkey\modules\betting\views\admin\add-user.php 74
ERROR - 2023-08-31 15:46:29 --> Severity: Notice --> Undefined variable: _ci_file D:\wamp64\www\valkey\application\core\App_Loader.php 90
ERROR - 2023-08-31 16:20:16 --> Could not find the language line "full_name"
ERROR - 2023-08-31 16:20:16 --> Could not find the language line "email"
ERROR - 2023-08-31 16:20:16 --> Could not find the language line "mobile"
ERROR - 2023-08-31 16:20:16 --> Could not find the language line "country"
ERROR - 2023-08-31 16:20:16 --> Could not find the language line "country"
ERROR - 2023-08-31 16:20:16 --> Could not find the language line "address"
ERROR - 2023-08-31 16:20:16 --> Could not find the language line "zip"
ERROR - 2023-08-31 16:20:16 --> Could not find the language line "state"
ERROR - 2023-08-31 16:20:16 --> Could not find the language line "city"
ERROR - 2023-08-31 16:20:16 --> Could not find the language line "city"
ERROR - 2023-08-31 16:21:33 --> Could not find the language line "full_name"
ERROR - 2023-08-31 16:21:33 --> Could not find the language line "email"
ERROR - 2023-08-31 16:21:33 --> Could not find the language line "mobile"
ERROR - 2023-08-31 16:21:33 --> Could not find the language line "country"
ERROR - 2023-08-31 16:21:33 --> Could not find the language line "country"
ERROR - 2023-08-31 16:21:33 --> Could not find the language line "address"
ERROR - 2023-08-31 16:21:33 --> Could not find the language line "zip"
ERROR - 2023-08-31 16:21:33 --> Could not find the language line "state"
ERROR - 2023-08-31 16:21:33 --> Could not find the language line "city"
ERROR - 2023-08-31 16:21:33 --> Could not find the language line "city"
ERROR - 2023-08-31 16:25:38 --> Could not find the language line "full_name"
ERROR - 2023-08-31 16:25:38 --> Could not find the language line "email"
ERROR - 2023-08-31 16:25:38 --> Could not find the language line "mobile"
ERROR - 2023-08-31 16:25:38 --> Could not find the language line "country"
ERROR - 2023-08-31 16:25:38 --> Could not find the language line "country"
ERROR - 2023-08-31 16:25:38 --> Could not find the language line "address"
ERROR - 2023-08-31 16:25:38 --> Could not find the language line "zip"
ERROR - 2023-08-31 16:25:38 --> Could not find the language line "state"
ERROR - 2023-08-31 16:25:38 --> Could not find the language line "city"
ERROR - 2023-08-31 16:25:38 --> Could not find the language line "city"
ERROR - 2023-08-31 16:25:44 --> Could not find the language line "full_name"
ERROR - 2023-08-31 16:25:44 --> Could not find the language line "email"
ERROR - 2023-08-31 16:25:44 --> Could not find the language line "mobile"
ERROR - 2023-08-31 16:25:44 --> Could not find the language line "country"
ERROR - 2023-08-31 16:25:44 --> Could not find the language line "country"
ERROR - 2023-08-31 16:25:44 --> Could not find the language line "address"
ERROR - 2023-08-31 16:25:44 --> Could not find the language line "zip"
ERROR - 2023-08-31 16:25:44 --> Could not find the language line "state"
ERROR - 2023-08-31 16:25:44 --> Could not find the language line "city"
ERROR - 2023-08-31 16:25:44 --> Could not find the language line "city"
ERROR - 2023-08-31 16:27:54 --> Could not find the language line "full_name"
ERROR - 2023-08-31 16:27:54 --> Could not find the language line "email"
ERROR - 2023-08-31 16:27:54 --> Could not find the language line "mobile"
ERROR - 2023-08-31 16:27:54 --> Could not find the language line "country"
ERROR - 2023-08-31 16:27:54 --> Could not find the language line "country"
ERROR - 2023-08-31 16:27:54 --> Could not find the language line "address"
ERROR - 2023-08-31 16:27:54 --> Could not find the language line "zip"
ERROR - 2023-08-31 16:27:54 --> Could not find the language line "state"
ERROR - 2023-08-31 16:27:54 --> Could not find the language line "city"
ERROR - 2023-08-31 16:27:54 --> Could not find the language line "city"
ERROR - 2023-08-31 16:28:24 --> Could not find the language line "full_name"
ERROR - 2023-08-31 16:28:24 --> Could not find the language line "email"
ERROR - 2023-08-31 16:28:24 --> Could not find the language line "mobile"
ERROR - 2023-08-31 16:28:24 --> Could not find the language line "country"
ERROR - 2023-08-31 16:28:24 --> Could not find the language line "country"
ERROR - 2023-08-31 16:28:24 --> Could not find the language line "address"
ERROR - 2023-08-31 16:28:24 --> Could not find the language line "zip"
ERROR - 2023-08-31 16:28:24 --> Could not find the language line "state"
ERROR - 2023-08-31 16:28:24 --> Could not find the language line "city"
ERROR - 2023-08-31 16:28:24 --> Could not find the language line "city"
ERROR - 2023-08-31 16:28:37 --> Could not find the language line "full_name"
ERROR - 2023-08-31 16:28:37 --> Could not find the language line "email"
ERROR - 2023-08-31 16:28:37 --> Could not find the language line "mobile"
ERROR - 2023-08-31 16:28:37 --> Could not find the language line "country"
ERROR - 2023-08-31 16:28:37 --> Could not find the language line "country"
ERROR - 2023-08-31 16:28:37 --> Could not find the language line "address"
ERROR - 2023-08-31 16:28:37 --> Could not find the language line "zip"
ERROR - 2023-08-31 16:28:37 --> Could not find the language line "state"
ERROR - 2023-08-31 16:28:37 --> Could not find the language line "city"
ERROR - 2023-08-31 16:28:37 --> Could not find the language line "city"
ERROR - 2023-08-31 16:29:32 --> Could not find the language line "full_name"
ERROR - 2023-08-31 16:29:32 --> Could not find the language line "email"
ERROR - 2023-08-31 16:29:32 --> Could not find the language line "mobile"
ERROR - 2023-08-31 16:29:32 --> Could not find the language line "country"
ERROR - 2023-08-31 16:29:32 --> Could not find the language line "country"
ERROR - 2023-08-31 16:29:32 --> Could not find the language line "address"
ERROR - 2023-08-31 16:29:32 --> Could not find the language line "zip"
ERROR - 2023-08-31 16:29:32 --> Could not find the language line "state"
ERROR - 2023-08-31 16:29:32 --> Could not find the language line "city"
ERROR - 2023-08-31 16:29:32 --> Could not find the language line "city"
ERROR - 2023-08-31 16:34:53 --> Severity: Notice --> Array to string conversion D:\wamp64\www\valkey\application\helpers\fields_helper.php 92
ERROR - 2023-08-31 16:38:16 --> Could not find the language line "required"
ERROR - 2023-08-31 16:38:24 --> Could not find the language line "required"
ERROR - 2023-08-31 17:57:39 --> Severity: Notice --> Undefined index: id D:\wamp64\www\valkey\modules\betting\models\Betting_model.php 220
ERROR - 2023-08-31 17:58:05 --> Severity: Notice --> Undefined index: id D:\wamp64\www\valkey\modules\betting\models\Betting_model.php 220
ERROR - 2023-08-31 17:59:12 --> Severity: Notice --> Undefined index: id D:\wamp64\www\valkey\modules\betting\models\Betting_model.php 220
ERROR - 2023-08-31 12:02:09 --> Severity: error --> Exception: syntax error, unexpected '$result' (T_VARIABLE) D:\wamp64\www\valkey\modules\betting\controllers\Admin.php 200
ERROR - 2023-08-31 12:02:20 --> Severity: error --> Exception: syntax error, unexpected '$result' (T_VARIABLE) D:\wamp64\www\valkey\modules\betting\controllers\Admin.php 200
ERROR - 2023-08-31 18:29:51 --> Could not find the language line "form_validation_email"
ERROR - 2023-08-31 18:44:14 --> Severity: Warning --> A non-numeric value encountered D:\wamp64\www\valkey\modules\betting\models\Betting_model.php 255
ERROR - 2023-08-31 18:44:14 --> Severity: error --> Exception: Unsupported operand types D:\wamp64\www\valkey\modules\betting\models\Betting_model.php 255
ERROR - 2023-08-31 18:47:47 --> Severity: Warning --> A non-numeric value encountered D:\wamp64\www\valkey\modules\betting\models\Betting_model.php 256
ERROR - 2023-08-31 18:47:47 --> Severity: error --> Exception: Unsupported operand types D:\wamp64\www\valkey\modules\betting\models\Betting_model.php 256
ERROR - 2023-08-31 18:48:48 --> Severity: Warning --> A non-numeric value encountered D:\wamp64\www\valkey\modules\betting\models\Betting_model.php 256
ERROR - 2023-08-31 18:48:48 --> Severity: error --> Exception: Unsupported operand types D:\wamp64\www\valkey\modules\betting\models\Betting_model.php 256
ERROR - 2023-08-31 18:55:09 --> Could not find the language line "form_validation_s_unique"
ERROR - 2023-08-31 12:55:27 --> 404 Page Not Found: admin/Bettting/admin
ERROR - 2023-08-31 19:10:27 --> Severity: error --> Exception: Too few arguments to function Betting_model::user_delete(), 0 passed in D:\wamp64\www\valkey\modules\betting\controllers\Admin.php on line 207 and exactly 1 expected D:\wamp64\www\valkey\modules\betting\models\Betting_model.php 295
ERROR - 2023-08-31 19:10:37 --> Severity: error --> Exception: Too few arguments to function Betting_model::user_delete(), 0 passed in D:\wamp64\www\valkey\modules\betting\controllers\Admin.php on line 207 and exactly 1 expected D:\wamp64\www\valkey\modules\betting\models\Betting_model.php 295
ERROR - 2023-08-31 19:13:30 --> Query error: Unknown column 'stuff_id' in 'field list' - Invalid query: UPDATE `tbluser` SET `full_name` = 'Modhu', `email` = 'modhu1@gmail.com', `mobile` = '01578695871', `country` = 'Bangladesh', `address` = 'Khulna', `state` = 'Shibbari', `city` = 'Khulna', `zip` = '35004', `reference` = 'Modhu Babu', `stuff_id` = '1'
WHERE `id` = ' 2'
ERROR - 2023-08-31 19:28:41 --> Severity: Notice --> Undefined offset: 7 D:\wamp64\www\valkey\application\helpers\datatables_helper.php 180
ERROR - 2023-08-31 19:28:41 --> Severity: Notice --> Undefined offset: 8 D:\wamp64\www\valkey\application\helpers\datatables_helper.php 180
ERROR - 2023-08-31 19:28:41 --> Severity: Notice --> Undefined offset: 9 D:\wamp64\www\valkey\application\helpers\datatables_helper.php 180
ERROR - 2023-08-31 19:28:41 --> Severity: Notice --> Undefined offset: 10 D:\wamp64\www\valkey\application\helpers\datatables_helper.php 180
ERROR - 2023-08-31 19:28:41 --> Severity: Notice --> Undefined offset: 11 D:\wamp64\www\valkey\application\helpers\datatables_helper.php 180
ERROR - 2023-08-31 19:28:41 --> Severity: Notice --> Undefined offset: 12 D:\wamp64\www\valkey\application\helpers\datatables_helper.php 180
ERROR - 2023-08-31 19:28:41 --> Query error: Column 'email' in field list is ambiguous - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS id, full_name, email, mobile, country, address, state, city, zip, reference, password, staff_id, address 
    FROM tbluser
    LEFT JOIN tblstaff ON tblstaff.staffid = tbluser.staff_id
    
    
    
    ORDER BY id ASC
    LIMIT 0, 25
    
ERROR - 2023-08-31 19:28:41 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at D:\wamp64\www\valkey\system\core\Exceptions.php:271) D:\wamp64\www\valkey\system\core\Common.php 573
ERROR - 2023-08-31 19:43:35 --> Could not find the language line "email"
ERROR - 2023-08-31 19:43:35 --> Could not find the language line "mobile"
ERROR - 2023-08-31 19:43:35 --> Could not find the language line "country"
ERROR - 2023-08-31 19:43:35 --> Could not find the language line "address"
ERROR - 2023-08-31 19:43:35 --> Could not find the language line "city"
ERROR - 2023-08-31 19:43:35 --> Could not find the language line "zip"
ERROR - 2023-08-31 19:43:35 --> Could not find the language line "zip"
ERROR - 2023-08-31 19:43:35 --> Could not find the language line "reference"
ERROR - 2023-08-31 19:43:35 --> Could not find the language line "passwprd"
ERROR - 2023-08-31 19:43:36 --> Query error: Column 'email' in field list is ambiguous - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS id, full_name, email, mobile, country, address, state, city, zip, reference, password, staff_id, address 
    FROM tbluser
    LEFT JOIN tblstaff ON tblstaff.staffid = tbluser.staff_id
    
    
    
    ORDER BY id ASC
    LIMIT 0, 25
    
ERROR - 2023-08-31 19:45:01 --> Could not find the language line "email"
ERROR - 2023-08-31 19:45:01 --> Could not find the language line "mobile"
ERROR - 2023-08-31 19:45:01 --> Could not find the language line "country"
ERROR - 2023-08-31 19:45:01 --> Could not find the language line "address"
ERROR - 2023-08-31 19:45:01 --> Could not find the language line "city"
ERROR - 2023-08-31 19:45:01 --> Could not find the language line "zip"
ERROR - 2023-08-31 19:45:01 --> Could not find the language line "zip"
ERROR - 2023-08-31 19:45:01 --> Could not find the language line "reference"
ERROR - 2023-08-31 19:45:01 --> Could not find the language line "passwprd"
ERROR - 2023-08-31 19:45:01 --> Could not find the language line "active"
ERROR - 2023-08-31 19:45:02 --> Query error: Column 'email' in field list is ambiguous - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS id, full_name, email, mobile, country, address, state, city, zip, reference, password, staff_id, address 
    FROM tbluser
    LEFT JOIN tblstaff ON tblstaff.staffid = tbluser.staff_id
    
    
    
    ORDER BY id ASC
    LIMIT 0, 25
    
ERROR - 2023-08-31 19:49:53 --> Could not find the language line "email"
ERROR - 2023-08-31 19:49:53 --> Could not find the language line "mobile"
ERROR - 2023-08-31 19:49:53 --> Could not find the language line "country"
ERROR - 2023-08-31 19:49:53 --> Could not find the language line "address"
ERROR - 2023-08-31 19:49:53 --> Could not find the language line "city"
ERROR - 2023-08-31 19:49:53 --> Could not find the language line "zip"
ERROR - 2023-08-31 19:49:53 --> Could not find the language line "zip"
ERROR - 2023-08-31 19:49:53 --> Could not find the language line "reference"
ERROR - 2023-08-31 19:49:53 --> Could not find the language line "passwprd"
ERROR - 2023-08-31 19:49:53 --> Could not find the language line "active"
ERROR - 2023-08-31 19:49:54 --> Query error: Column 'email' in field list is ambiguous - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS id, full_name, email, mobile, country, address, state, city, zip, reference, password, staff_id, address 
    FROM tbluser
    LEFT JOIN tblstaff ON tblstaff.staffid = tbluser.staff_id
    
    
    
    ORDER BY id ASC
    LIMIT 0, 25
    
ERROR - 2023-08-31 19:50:30 --> Could not find the language line "email"
ERROR - 2023-08-31 19:50:30 --> Could not find the language line "mobile"
ERROR - 2023-08-31 19:50:30 --> Could not find the language line "country"
ERROR - 2023-08-31 19:50:30 --> Could not find the language line "address"
ERROR - 2023-08-31 19:50:30 --> Could not find the language line "city"
ERROR - 2023-08-31 19:50:30 --> Could not find the language line "zip"
ERROR - 2023-08-31 19:50:30 --> Could not find the language line "zip"
ERROR - 2023-08-31 19:50:30 --> Could not find the language line "reference"
ERROR - 2023-08-31 19:50:30 --> Could not find the language line "passwprd"
ERROR - 2023-08-31 19:50:30 --> Could not find the language line "active"
ERROR - 2023-08-31 19:50:31 --> Query error: Column 'email' in field list is ambiguous - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS id, full_name, email, mobile, country, address, state, city, zip, reference, password, staff_id, address 
    FROM tbluser
    LEFT JOIN tblstaff ON tblstaff.staffid = tbluser.staff_id
    
    
    
    ORDER BY id ASC
    LIMIT 0, 25
    
ERROR - 2023-08-31 19:50:58 --> Could not find the language line "email"
ERROR - 2023-08-31 19:50:58 --> Could not find the language line "mobile"
ERROR - 2023-08-31 19:50:58 --> Could not find the language line "country"
ERROR - 2023-08-31 19:50:58 --> Could not find the language line "address"
ERROR - 2023-08-31 19:50:58 --> Could not find the language line "city"
ERROR - 2023-08-31 19:50:58 --> Could not find the language line "zip"
ERROR - 2023-08-31 19:50:58 --> Could not find the language line "zip"
ERROR - 2023-08-31 19:50:58 --> Could not find the language line "reference"
ERROR - 2023-08-31 19:50:58 --> Could not find the language line "passwprd"
ERROR - 2023-08-31 19:50:58 --> Could not find the language line "active"
ERROR - 2023-08-31 19:50:58 --> Query error: Column 'email' in field list is ambiguous - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS id, full_name, email, mobile, country, address, state, city, zip, reference, password, staff_id, address 
    FROM tbluser
    LEFT JOIN tblstaff ON tblstaff.staffid = tbluser.staff_id
    
    
    
    ORDER BY id ASC
    LIMIT 0, 25
    
ERROR - 2023-08-31 19:54:12 --> Could not find the language line "email"
ERROR - 2023-08-31 19:54:12 --> Could not find the language line "mobile"
ERROR - 2023-08-31 19:54:12 --> Could not find the language line "country"
ERROR - 2023-08-31 19:54:12 --> Could not find the language line "address"
ERROR - 2023-08-31 19:54:12 --> Could not find the language line "city"
ERROR - 2023-08-31 19:54:12 --> Could not find the language line "zip"
ERROR - 2023-08-31 19:54:12 --> Could not find the language line "zip"
ERROR - 2023-08-31 19:54:12 --> Could not find the language line "reference"
ERROR - 2023-08-31 19:54:12 --> Could not find the language line "passwprd"
ERROR - 2023-08-31 19:54:12 --> Could not find the language line "active"
ERROR - 2023-08-31 19:54:13 --> Query error: Column 'email' in field list is ambiguous - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS id, full_name, email, mobile, country, address, state, city, zip, reference, password, staff_id, address 
    FROM tbluser
    LEFT JOIN tblstaff ON tblstaff.staffid = tbluser.staff_id
    
    
    
    ORDER BY id ASC
    LIMIT 0, 25
    
ERROR - 2023-08-31 19:54:34 --> Could not find the language line "email"
ERROR - 2023-08-31 19:54:34 --> Could not find the language line "mobile"
ERROR - 2023-08-31 19:54:34 --> Could not find the language line "country"
ERROR - 2023-08-31 19:54:34 --> Could not find the language line "address"
ERROR - 2023-08-31 19:54:34 --> Could not find the language line "city"
ERROR - 2023-08-31 19:54:34 --> Could not find the language line "zip"
ERROR - 2023-08-31 19:54:34 --> Could not find the language line "zip"
ERROR - 2023-08-31 19:54:34 --> Could not find the language line "reference"
ERROR - 2023-08-31 19:54:34 --> Could not find the language line "passwprd"
ERROR - 2023-08-31 19:54:34 --> Could not find the language line "active"
ERROR - 2023-08-31 19:54:34 --> Query error: Column 'email' in field list is ambiguous - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS id, full_name, email, mobile, country, address, state, city, zip, reference, password, staff_id, address 
    FROM tbluser
    LEFT JOIN tblstaff ON tblstaff.staffid = tbluser.staff_id
    
    
    
    ORDER BY id ASC
    LIMIT 0, 25
    
ERROR - 2023-08-31 19:55:48 --> Could not find the language line "email"
ERROR - 2023-08-31 19:55:48 --> Could not find the language line "mobile"
ERROR - 2023-08-31 19:55:48 --> Could not find the language line "country"
ERROR - 2023-08-31 19:55:48 --> Could not find the language line "address"
ERROR - 2023-08-31 19:55:48 --> Could not find the language line "city"
ERROR - 2023-08-31 19:55:48 --> Could not find the language line "zip"
ERROR - 2023-08-31 19:55:48 --> Could not find the language line "zip"
ERROR - 2023-08-31 19:55:48 --> Could not find the language line "reference"
ERROR - 2023-08-31 19:55:48 --> Could not find the language line "passwprd"
ERROR - 2023-08-31 19:55:48 --> Could not find the language line "active"
ERROR - 2023-08-31 19:55:49 --> Query error: Column 'email' in field list is ambiguous - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS id, full_name, email, mobile, country, address, state, city, zip, reference, password, staff_id 
    FROM tbluser
    LEFT JOIN tblstaff ON tblstaff.staffid = tbluser.staff_id
    
    
    
    ORDER BY id ASC
    LIMIT 0, 25
    
ERROR - 2023-08-31 19:57:32 --> Could not find the language line "email"
ERROR - 2023-08-31 19:57:32 --> Could not find the language line "mobile"
ERROR - 2023-08-31 19:57:32 --> Could not find the language line "country"
ERROR - 2023-08-31 19:57:32 --> Could not find the language line "address"
ERROR - 2023-08-31 19:57:32 --> Could not find the language line "city"
ERROR - 2023-08-31 19:57:32 --> Could not find the language line "zip"
ERROR - 2023-08-31 19:57:32 --> Could not find the language line "zip"
ERROR - 2023-08-31 19:57:32 --> Could not find the language line "reference"
ERROR - 2023-08-31 19:57:32 --> Could not find the language line "passwprd"
ERROR - 2023-08-31 19:57:32 --> Could not find the language line "active"
ERROR - 2023-08-31 19:57:34 --> Query error: Column 'email' in field list is ambiguous - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS id, full_name, email, mobile, country, address, state, city, zip, reference, password, staff_id, datetime 
    FROM tbluser
    LEFT JOIN tblstaff ON tblstaff.staffid = tbluser.staff_id
    
    
    
    ORDER BY id ASC
    LIMIT 0, 25
    
ERROR - 2023-08-31 19:58:48 --> Could not find the language line "email"
ERROR - 2023-08-31 19:58:49 --> Severity: Notice --> Undefined index: full_name D:\wamp64\www\valkey\modules\betting\views\common\table\user-table.php 27
ERROR - 2023-08-31 19:58:49 --> Severity: Notice --> Undefined index: email D:\wamp64\www\valkey\modules\betting\views\common\table\user-table.php 28
ERROR - 2023-08-31 19:58:49 --> Severity: Notice --> Undefined index: datetime D:\wamp64\www\valkey\modules\betting\views\common\table\user-table.php 56
ERROR - 2023-08-31 19:58:49 --> Severity: Notice --> Undefined index: id D:\wamp64\www\valkey\modules\betting\views\common\table\user-table.php 58
ERROR - 2023-08-31 19:58:49 --> Severity: Notice --> Undefined index: name D:\wamp64\www\valkey\modules\betting\views\common\table\user-table.php 58
ERROR - 2023-08-31 19:58:49 --> Severity: Notice --> Undefined index: id D:\wamp64\www\valkey\modules\betting\views\common\table\user-table.php 58
ERROR - 2023-08-31 19:59:28 --> Could not find the language line "email"
ERROR - 2023-08-31 19:59:29 --> Query error: Column 'email' in field list is ambiguous - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS id, full_name, email 
    FROM tbluser
    LEFT JOIN tblstaff ON tblstaff.staffid = tbluser.staff_id
    
    
    
    ORDER BY id ASC
    LIMIT 0, 25
    
ERROR - 2023-08-31 19:59:53 --> Severity: Notice --> Undefined index: datetime D:\wamp64\www\valkey\modules\betting\views\common\table\user-table.php 56
ERROR - 2023-08-31 19:59:53 --> Severity: Notice --> Undefined index: name D:\wamp64\www\valkey\modules\betting\views\common\table\user-table.php 58
ERROR - 2023-08-31 20:00:13 --> Severity: Notice --> Undefined index: name D:\wamp64\www\valkey\modules\betting\views\common\table\user-table.php 58
ERROR - 2023-08-31 20:00:54 --> Could not find the language line "email"
ERROR - 2023-08-31 20:00:56 --> Query error: Column 'email' in field list is ambiguous - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS id, full_name, email 
    FROM tbluser
    LEFT JOIN tblstaff ON tblstaff.staffid = tbluser.staff_id
    
    
    
    ORDER BY id ASC
    LIMIT 0, 25
    
ERROR - 2023-08-31 20:01:43 --> Could not find the language line "email"
ERROR - 2023-08-31 20:01:44 --> Query error: Column 'email' in field list is ambiguous - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS id, full_name, email as email_ 
    FROM tbluser
    LEFT JOIN tblstaff ON tblstaff.staffid = tbluser.staff_id
    
    
    
    ORDER BY id ASC
    LIMIT 0, 25
    
ERROR - 2023-08-31 20:03:36 --> Could not find the language line "email"
ERROR - 2023-08-31 20:03:37 --> Severity: Notice --> Undefined index: full_name D:\wamp64\www\valkey\modules\betting\views\common\table\user-table.php 27
ERROR - 2023-08-31 20:03:37 --> Severity: Notice --> Undefined index: email_ D:\wamp64\www\valkey\modules\betting\views\common\table\user-table.php 28
ERROR - 2023-08-31 20:03:58 --> Could not find the language line "email"
ERROR - 2023-08-31 20:03:59 --> Severity: Notice --> Undefined index: full_name D:\wamp64\www\valkey\modules\betting\views\common\table\user-table.php 27
ERROR - 2023-08-31 20:03:59 --> Severity: Notice --> Undefined index: email D:\wamp64\www\valkey\modules\betting\views\common\table\user-table.php 28
ERROR - 2023-08-31 20:04:05 --> Could not find the language line "email"
ERROR - 2023-08-31 20:04:07 --> Severity: Notice --> Undefined index: full_name D:\wamp64\www\valkey\modules\betting\views\common\table\user-table.php 27
ERROR - 2023-08-31 20:04:07 --> Severity: Notice --> Undefined index: email D:\wamp64\www\valkey\modules\betting\views\common\table\user-table.php 28
ERROR - 2023-08-31 20:05:53 --> Could not find the language line "email"
ERROR - 2023-08-31 20:05:54 --> Severity: Notice --> Undefined index: full_name D:\wamp64\www\valkey\modules\betting\views\common\table\user-table.php 27
ERROR - 2023-08-31 20:05:54 --> Severity: Notice --> Undefined index: email D:\wamp64\www\valkey\modules\betting\views\common\table\user-table.php 28
ERROR - 2023-08-31 20:06:38 --> Could not find the language line "email"
ERROR - 2023-08-31 20:06:40 --> Severity: Notice --> Undefined index: full_name D:\wamp64\www\valkey\modules\betting\views\common\table\user-table.php 27
ERROR - 2023-08-31 20:06:40 --> Severity: Notice --> Undefined index: email D:\wamp64\www\valkey\modules\betting\views\common\table\user-table.php 28
ERROR - 2023-08-31 20:06:58 --> Could not find the language line "email"
ERROR - 2023-08-31 20:06:59 --> Severity: Notice --> Undefined index: full_name D:\wamp64\www\valkey\modules\betting\views\common\table\user-table.php 27
ERROR - 2023-08-31 20:07:47 --> Could not find the language line "email"
ERROR - 2023-08-31 20:08:32 --> Could not find the language line "email"
ERROR - 2023-08-31 20:08:32 --> Could not find the language line "mobile"
ERROR - 2023-08-31 20:08:33 --> Query error: Column 'email' in field list is ambiguous - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS id, full_name, email, mobile 
    FROM tbluser
    LEFT JOIN tblstaff ON tblstaff.staffid = tbluser.staff_id
    
    
    
    ORDER BY id ASC
    LIMIT 0, 25
    
ERROR - 2023-08-31 20:08:47 --> Could not find the language line "email"
ERROR - 2023-08-31 20:09:01 --> Could not find the language line "email"
ERROR - 2023-08-31 20:09:01 --> Could not find the language line "mobile"
ERROR - 2023-08-31 20:09:19 --> Could not find the language line "email"
ERROR - 2023-08-31 20:09:19 --> Could not find the language line "mobile"
ERROR - 2023-08-31 20:09:19 --> Could not find the language line "country"
ERROR - 2023-08-31 20:09:41 --> Could not find the language line "email"
ERROR - 2023-08-31 20:09:41 --> Could not find the language line "mobile"
ERROR - 2023-08-31 20:09:41 --> Could not find the language line "country"
ERROR - 2023-08-31 20:09:41 --> Could not find the language line "address"
ERROR - 2023-08-31 20:09:59 --> Could not find the language line "email"
ERROR - 2023-08-31 20:09:59 --> Could not find the language line "mobile"
ERROR - 2023-08-31 20:09:59 --> Could not find the language line "country"
ERROR - 2023-08-31 20:09:59 --> Could not find the language line "address"
ERROR - 2023-08-31 20:09:59 --> Could not find the language line "city"
ERROR - 2023-08-31 20:10:21 --> Could not find the language line "email"
ERROR - 2023-08-31 20:10:21 --> Could not find the language line "mobile"
ERROR - 2023-08-31 20:10:21 --> Could not find the language line "country"
ERROR - 2023-08-31 20:10:21 --> Could not find the language line "address"
ERROR - 2023-08-31 20:10:21 --> Could not find the language line "city"
ERROR - 2023-08-31 20:10:21 --> Could not find the language line "zip"
ERROR - 2023-08-31 20:10:22 --> Query error: Column 'email' in field list is ambiguous - Invalid query: 
    SELECT SQL_CALC_FOUND_ROWS id, full_name, email, mobile, country, address, city, zip 
    FROM tbluser
    LEFT JOIN tblstaff ON tblstaff.staffid = tbluser.staff_id
    
    
    
    ORDER BY id ASC
    LIMIT 0, 25
    
ERROR - 2023-08-31 20:10:43 --> Could not find the language line "email"
ERROR - 2023-08-31 20:10:43 --> Could not find the language line "mobile"
ERROR - 2023-08-31 20:10:43 --> Could not find the language line "country"
ERROR - 2023-08-31 20:10:43 --> Could not find the language line "address"
ERROR - 2023-08-31 20:10:43 --> Could not find the language line "city"
