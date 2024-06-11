<?php

defined('BASEPATH') or exit('No direct script access allowed');
/**
 * The file is responsible for handing the installation
 */

/**
 * Mautic Settings Table
 */
$CI->db->query("INSERT INTO `tbloptions` (`id`, `name`, `value`, `autoload`) VALUES (NULL, 'betting_odds_api_active', '', '1'), (NULL, 'betting_odds_api_key', '', '1');");
if (!$CI->db->table_exists(db_prefix() . 'traking_pc')) {

	/**
	 * INSERT INTO `tbloptions` (`id`, `name`, `value`, `autoload`) VALUES (NULL, 'betting_odds_region', '', '1'), (NULL, 'betting_odds_oddsFormat', '', '1');
	 * CREATE TABLE `valkey`.`tblodds_sports` ( `id` INT NOT NULL AUTO_INCREMENT , `key` VARCHAR(255) NULL , `group` VARCHAR(255) NULL , `title` VARCHAR(255) NULL , `description` VARCHAR(500) NULL , `active` VARCHAR(255) NULL , `has_outrights` VARCHAR(255) NULL , `bet` BIT(1) NULL DEFAULT b'0' , `datetime` DATETIME NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = MyISAM;
	 * CREATE TABLE `valkey`.`tblsports_category` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NULL , `image` VARCHAR(255) NULL , PRIMARY KEY (`id`)) ENGINE = MyISAM;
	 * CREATE TABLE `valkey`.`tblbetting` ( `id` INT NOT NULL AUTO_INCREMENT , `rel_id` VARCHAR(255) NULL , `rel_type` VARCHAR(255) NULL , `staff_id` VARCHAR(255) NULL , `category_id` VARCHAR(255) NULL , `datetime` DATETIME NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = MyISAM;
	 * 
	 */
	// $CI->db->query('CREATE TABLE `' . db_prefix() . 'traking_pc` (

	// 	  `id` int(11) NOT NULL,
	// 	  `staff_id` varchar(255) NOT NULL,
	// 	  `pc_type` int(15) NULL DEFAULT "1" COMMENT "1= personal, 2=company",
	// 	  `pc_mac` varchar(145) NULL,
	// 	  `pc_ip` varchar(145) NULL,
	// 	  `private_ip` varchar(55) NULL,
	// 	  `pc_name` varchar(145) NULL,
	// 	  `pc_os` varchar(145) NULL,
	// 	  `pc_user` varchar(145) NULL,
	// 	  `install_date` varchar(145) NULL,
	// 	  `mode` INT NOT NULL DEFAULT "0" COMMENT "0= online, 1=ofline",
	// 	  `pc_key` varchar(255) NULL,
	// 	  `status` int NULL DEFAULT "1" COMMENT "1= active, 0=deactive"
	// 	) ENGINE=InnoDB DEFAULT CHARSET=' . $CI->db->char_set . ';');

	// $CI->db->query('ALTER TABLE `' . db_prefix() . 'traking_pc`

	// 	  ADD PRIMARY KEY (`id`);');

	// $CI->db->query('ALTER TABLE `' . db_prefix() . 'traking_pc`

	// 	  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');
}
/**
 * Mautic Campaign Table
 */

if (!$CI->db->table_exists(db_prefix() . 'traking_option')) {

	// $CI->db->query('CREATE TABLE `' . db_prefix() . 'traking_option` (

	// 	  `id` int(11) NOT NULL,
	// 	  `name` varchar(255) NULL,
	// 	  `value` varchar(255) NULL
	// 	) ENGINE=InnoDB DEFAULT CHARSET=' . $CI->db->char_set . ';');

	// $CI->db->query('ALTER TABLE `' . db_prefix() . 'traking_option`
	// 	  ADD PRIMARY KEY (`id`);');

	// $CI->db->query('ALTER TABLE `' . db_prefix() . 'traking_option`
	// 	  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');

	// $insert = [
	// 	["name" => "license", "value" => ""],
	// 	["name" => "activity_time", "value" => "10"],
	// 	['name' => "remove", 'value' => 0],
	// 	['name' => "ofline", 'value' => 0]
	// ];

	// foreach ($insert as $data) {
	// 	$CI->db->insert(db_prefix() . 'traking_option', $data);
	// }
}


/**
 * Mautic Settings Table
 */
if (!$CI->db->table_exists(db_prefix() . 'traking')) {

	// $CI->db->query('CREATE TABLE `' . db_prefix() . 'traking` (

	// 	  `id` int(11) NOT NULL,
	// 	  `staff_id` varchar(255) NOT NULL,
	// 	  `pc_id` int(15) NULL DEFAULT "1" COMMENT "1= personal, 2=company",
	// 	  `tracking_id` int NOT NULL,
	// 	  `tracking_image` LONGTEXT NULL,
	// 	  `active_windows` varchar(255) NULL,
	// 	  `tracking_click` LONGTEXT NULL,
	// 	  `tracking_history` LONGTEXT NULL,
	// 	  `tracking_time` varchar(255) NULL,
	// 	  `server_time` varchar(255) NULL
	// 	) ENGINE=InnoDB DEFAULT CHARSET=' . $CI->db->char_set . ';');

	// $CI->db->query('ALTER TABLE `' . db_prefix() . 'traking`

	// 	  ADD PRIMARY KEY (`id`);');

	// $CI->db->query('ALTER TABLE `' . db_prefix() . 'traking`

	// 	  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');


	// $CI->db->query('ALTER TABLE `' . db_prefix() . 'traking` ADD `start_time` VARCHAR(255) NULL AFTER `server_year`, ADD `end_time` VARCHAR(255) NULL AFTER `start_time`;');
}
