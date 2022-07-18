-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2022 at 08:46 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alapaap_db`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `active_user`
-- (See below for the actual view)
--
CREATE TABLE `active_user` (
`isOnline` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `disabled_user`
-- (See below for the actual view)
--
CREATE TABLE `disabled_user` (
`isDisabled` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `offline_user`
-- (See below for the actual view)
--
CREATE TABLE `offline_user` (
`isOffline` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_activity_logs`
--

CREATE TABLE `tbl_activity_logs` (
  `id` int(11) NOT NULL,
  `uid` varchar(20) DEFAULT NULL,
  `fullname` varchar(30) DEFAULT NULL,
  `form_type` varchar(20) DEFAULT NULL,
  `control_number` varchar(30) DEFAULT NULL,
  `activity` varchar(125) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `date_requested` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_activity_logs`
--

INSERT INTO `tbl_activity_logs` (`id`, `uid`, `fullname`, `form_type`, `control_number`, `activity`, `status`, `date_requested`) VALUES
(1, '6', 'whyllard ermie', '1', '2022071800001', 'created', '2', '2022-07-18 01:59:31'),
(2, '6', '', '1', '2022071800001', 'canceled', '0', '2022-07-18 02:01:26'),
(3, '6', '', '1', '2022071800001', 'canceled', '0', '2022-07-18 02:02:16'),
(4, '6', '', '1', '2022071800001', 'canceled', '0', '2022-07-18 02:53:12'),
(5, '6', '', '1', '2022071800001', 'canceled', '0', '2022-07-18 03:52:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_baas`
--

CREATE TABLE `tbl_baas` (
  `id` int(11) NOT NULL,
  `uid` text DEFAULT NULL,
  `control_number` text DEFAULT NULL,
  `form_type` text DEFAULT NULL,
  `fullname` text DEFAULT NULL,
  `email_add` text DEFAULT NULL,
  `contact_no` text DEFAULT NULL,
  `department` text DEFAULT NULL,
  `txt_others` text DEFAULT NULL,
  `form_factor` text DEFAULT NULL,
  `hostname` text DEFAULT NULL,
  `ip_add` text DEFAULT NULL,
  `os` text DEFAULT NULL,
  `os_version` text DEFAULT NULL,
  `db_type` text DEFAULT NULL,
  `db_version` text DEFAULT NULL,
  `action` text DEFAULT NULL,
  `node_name` text DEFAULT NULL,
  `backup_method` text DEFAULT NULL,
  `backup_method_desc` text DEFAULT NULL,
  `backup_sched` text DEFAULT NULL,
  `backup_time` text DEFAULT NULL,
  `backup_day` text DEFAULT NULL,
  `archive_sched` text DEFAULT NULL,
  `archive_time` text DEFAULT NULL,
  `archive_day` text DEFAULT NULL,
  `retention` text DEFAULT NULL,
  `retention_sched` text DEFAULT NULL,
  `server_contact` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `revised` text DEFAULT NULL,
  `num_revised` text DEFAULT NULL,
  `cancelled` text DEFAULT NULL,
  `date_requested` datetime DEFAULT NULL,
  `approver_id` text DEFAULT NULL,
  `approver` text DEFAULT NULL,
  `app_status` text DEFAULT NULL,
  `appr_date` datetime DEFAULT NULL,
  `reciever_id` text DEFAULT NULL,
  `reciever` text DEFAULT NULL,
  `rec_status` text DEFAULT NULL,
  `rec_date` datetime DEFAULT NULL,
  `performer_id` text DEFAULT NULL,
  `performer` text DEFAULT NULL,
  `perf_status` text DEFAULT NULL,
  `perform_date` datetime DEFAULT NULL,
  `verifier_id` text DEFAULT NULL,
  `verifier` text DEFAULT NULL,
  `ver_status` text DEFAULT NULL,
  `ver_date` datetime DEFAULT NULL,
  `verifier_2id` text DEFAULT NULL,
  `verifier_2` text DEFAULT NULL,
  `ver2_status` text DEFAULT NULL,
  `ver2_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_backup_pass`
--

CREATE TABLE `tbl_backup_pass` (
  `uid` int(11) NOT NULL,
  `email_add` varchar(50) DEFAULT NULL,
  `role` varchar(10) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cps`
--

CREATE TABLE `tbl_cps` (
  `id` int(11) NOT NULL,
  `uid` text DEFAULT NULL,
  `control_number` text DEFAULT NULL,
  `cps_new_control_num` text DEFAULT NULL,
  `cps_up_control_num` text DEFAULT NULL,
  `form_type` text DEFAULT NULL,
  `fullname` text DEFAULT NULL,
  `email_add` text DEFAULT NULL,
  `contact_no` text DEFAULT NULL,
  `cps_action` text DEFAULT NULL,
  `system_name` text DEFAULT NULL,
  `hostname` text DEFAULT NULL,
  `pattern` text DEFAULT NULL,
  `instance_name` text DEFAULT NULL,
  `location` text DEFAULT NULL,
  `env_profile` text DEFAULT NULL,
  `ip_add` text DEFAULT NULL,
  `ip_group` text DEFAULT NULL,
  `vcpu_size` text DEFAULT NULL,
  `vcpu_filesystem` text DEFAULT NULL,
  `vcpu_remarks` text DEFAULT NULL,
  `ram_size` text DEFAULT NULL,
  `ram_filesystem` text DEFAULT NULL,
  `ram_remarks` text DEFAULT NULL,
  `ue_enroll_size` text DEFAULT NULL,
  `ue_filesystem` text DEFAULT NULL,
  `ue_remarks` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `revised` text DEFAULT NULL,
  `num_revised` text DEFAULT NULL,
  `cancelled` text DEFAULT NULL,
  `date_requested` datetime DEFAULT NULL,
  `approver_id` text DEFAULT NULL,
  `approver` text DEFAULT NULL,
  `app_status` text DEFAULT NULL,
  `appr_date` datetime DEFAULT NULL,
  `reciever_id` text DEFAULT NULL,
  `reciever` text DEFAULT NULL,
  `rec_status` text DEFAULT NULL,
  `rec_date` datetime DEFAULT NULL,
  `performer_id` text DEFAULT NULL,
  `performer` text DEFAULT NULL,
  `perf_status` text DEFAULT NULL,
  `perform_date` datetime DEFAULT NULL,
  `verifier_id` text DEFAULT NULL,
  `verifier` text DEFAULT NULL,
  `ver_status` text DEFAULT NULL,
  `ver_date` datetime DEFAULT NULL,
  `verifier_2id` text DEFAULT NULL,
  `verifier_2` text DEFAULT NULL,
  `ver2_status` text DEFAULT NULL,
  `ver2_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `tbl_cps`
--
DELIMITER $$
CREATE TRIGGER `cps_validate_hostname` AFTER INSERT ON `tbl_cps` FOR EACH ROW INSERT INTO tbl_hostname (uid, control_number, form_type, hostname, action, date_created) values (NEW.uid, NEW.control_number, NEW.form_type ,NEW.hostname, 'inserted', NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_forms_others`
--

CREATE TABLE `tbl_forms_others` (
  `id` int(11) NOT NULL,
  `uid` text DEFAULT NULL,
  `hostname` text DEFAULT NULL,
  `form_type` text DEFAULT NULL,
  `control_number` text DEFAULT NULL,
  `others_id` text DEFAULT NULL,
  `others_1` text DEFAULT NULL,
  `others_2` text DEFAULT NULL,
  `others_3` text DEFAULT NULL,
  `others_4` text DEFAULT NULL,
  `status` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hci`
--

CREATE TABLE `tbl_hci` (
  `id` int(11) NOT NULL,
  `uid` text DEFAULT NULL,
  `control_number` text DEFAULT NULL,
  `hci_new_control_num` text DEFAULT NULL,
  `hci_up_control_num` text DEFAULT NULL,
  `deleted_hostname` text DEFAULT NULL,
  `form_type` text DEFAULT NULL,
  `fullname` text DEFAULT NULL,
  `email_add` text DEFAULT NULL,
  `contact_no` text DEFAULT NULL,
  `department` text DEFAULT NULL,
  `location` text DEFAULT NULL,
  `cluster` text DEFAULT NULL,
  `hostname` text DEFAULT NULL,
  `vcpu` text DEFAULT NULL,
  `vcpu_comment` text DEFAULT NULL,
  `ram` text DEFAULT NULL,
  `ram_comment` text DEFAULT NULL,
  `os` text DEFAULT NULL,
  `os_comment` text DEFAULT NULL,
  `txt_os_descript` text DEFAULT NULL,
  `txt_define_parti` text DEFAULT NULL,
  `ip_add_vlan` text DEFAULT NULL,
  `ip_comment` text DEFAULT NULL,
  `txt_ip_vlan` text DEFAULT NULL,
  `vlan_comment` text DEFAULT NULL,
  `hci_users` text DEFAULT NULL,
  `txt_hci_users` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `revised` text DEFAULT NULL,
  `cancelled` text DEFAULT NULL,
  `num_revised` text DEFAULT NULL,
  `date_requested` datetime DEFAULT NULL,
  `approver_id` text DEFAULT NULL,
  `approver` text DEFAULT NULL,
  `app_status` text DEFAULT NULL,
  `appr_date` datetime DEFAULT NULL,
  `reciever_id` text DEFAULT NULL,
  `reciever` text DEFAULT NULL,
  `rec_status` text DEFAULT NULL,
  `rec_date` datetime DEFAULT NULL,
  `performer_id` text DEFAULT NULL,
  `performer` text DEFAULT NULL,
  `perf_status` text DEFAULT NULL,
  `perform_date` datetime DEFAULT NULL,
  `verifier_id` text DEFAULT NULL,
  `verifier` text DEFAULT NULL,
  `ver_status` text DEFAULT NULL,
  `ver_date` datetime DEFAULT NULL,
  `verifier_2id` text DEFAULT NULL,
  `verifier_2` text DEFAULT NULL,
  `ver2_status` text DEFAULT NULL,
  `ver2_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_hci`
--

INSERT INTO `tbl_hci` (`id`, `uid`, `control_number`, `hci_new_control_num`, `hci_up_control_num`, `deleted_hostname`, `form_type`, `fullname`, `email_add`, `contact_no`, `department`, `location`, `cluster`, `hostname`, `vcpu`, `vcpu_comment`, `ram`, `ram_comment`, `os`, `os_comment`, `txt_os_descript`, `txt_define_parti`, `ip_add_vlan`, `ip_comment`, `txt_ip_vlan`, `vlan_comment`, `hci_users`, `txt_hci_users`, `status`, `revised`, `cancelled`, `num_revised`, `date_requested`, `approver_id`, `approver`, `app_status`, `appr_date`, `reciever_id`, `reciever`, `rec_status`, `rec_date`, `performer_id`, `performer`, `perf_status`, `perform_date`, `verifier_id`, `verifier`, `ver_status`, `ver_date`, `verifier_2id`, `verifier_2`, `ver2_status`, `ver2_date`) VALUES
(1, '6', '2022071800001', NULL, NULL, NULL, '1', 'whyllard ermie', 'whyllardermie@gmail.com', '09554194598', 'db2', 'HO', 'general_cluster', 'awdawd', 'awdawd', '', 'dawd', '', 'windows', '', 'awd', '', '12131awdada', '1231', 'awd', '', 'awd', '', '2', NULL, NULL, NULL, '2022-07-18 11:52:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Triggers `tbl_hci`
--
DELIMITER $$
CREATE TRIGGER `validate_hostname` AFTER INSERT ON `tbl_hci` FOR EACH ROW INSERT INTO tbl_hostname (uid, control_number, form_type, hostname, action, date_created) values (NEW.uid, NEW.control_number, NEW.form_type, NEW.hostname, 'inserted', NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hostname`
--

CREATE TABLE `tbl_hostname` (
  `id` int(11) NOT NULL,
  `uid` text DEFAULT NULL,
  `control_number` text DEFAULT NULL,
  `form_type` text DEFAULT NULL,
  `hostname` text DEFAULT NULL,
  `action` text DEFAULT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_hostname`
--

INSERT INTO `tbl_hostname` (`id`, `uid`, `control_number`, `form_type`, `hostname`, `action`, `date_created`) VALUES
(1, '6', '2022071800001', '1', 'awdawd', 'inserted', '2022-07-18 09:59:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification`
--

CREATE TABLE `tbl_notification` (
  `id` int(11) NOT NULL,
  `uid` varchar(30) DEFAULT NULL,
  `fullname` varchar(20) DEFAULT NULL,
  `form_type` varchar(50) DEFAULT NULL,
  `control_number` varchar(50) DEFAULT NULL,
  `activity` varchar(30) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `isViewed` varchar(10) DEFAULT NULL,
  `date_requested` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in structure for view `tbl_pending_request`
-- (See below for the actual view)
--
CREATE TABLE `tbl_pending_request` (
`uid` mediumtext
,`fullname` mediumtext
,`form_type` mediumtext
,`control_number` mediumtext
,`status` mediumtext
,`date_requested` datetime
,`revised` mediumtext
,`num_revised` mediumtext
,`approver_id` mediumtext
,`approver` mediumtext
,`reciever_id` mediumtext
,`reciever` mediumtext
,`performer_id` mediumtext
,`performer` mediumtext
,`verifier_id` mediumtext
,`verifier` mediumtext
,`verifier_2id` mediumtext
,`verifier_2` mediumtext
);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_remarks`
--

CREATE TABLE `tbl_remarks` (
  `id` int(11) NOT NULL,
  `form_type` text DEFAULT NULL,
  `control_number` text DEFAULT NULL,
  `comment_id` text DEFAULT NULL,
  `uid` text DEFAULT NULL,
  `fullname` text DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `remarks_date` datetime DEFAULT NULL,
  `role` text DEFAULT NULL,
  `toRole` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_remarks`
--

INSERT INTO `tbl_remarks` (`id`, `form_type`, `control_number`, `comment_id`, `uid`, `fullname`, `comments`, `remarks_date`, `role`, `toRole`) VALUES
(1, '1', '2022071800001', '763824', '6', 'whyllard ermie', 'awdawd', '2022-07-18 09:59:31', '1', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tbl_report_view`
-- (See below for the actual view)
--
CREATE TABLE `tbl_report_view` (
`uid` mediumtext
,`form_type` mediumtext
,`control_number` mediumtext
,`status` mediumtext
,`date_requested` datetime
);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_req_role`
--

CREATE TABLE `tbl_req_role` (
  `id` int(11) NOT NULL,
  `uid` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `his_id` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `fullname` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_add` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `requested_role` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tci`
--

CREATE TABLE `tbl_tci` (
  `id` int(11) NOT NULL,
  `uid` text DEFAULT NULL,
  `control_number` text DEFAULT NULL,
  `form_type` text DEFAULT NULL,
  `fullname` text DEFAULT NULL,
  `email_add` text DEFAULT NULL,
  `contact_no` text DEFAULT NULL,
  `department` text DEFAULT NULL,
  `cluster` text DEFAULT NULL,
  `location` text DEFAULT NULL,
  `prob_descript` text DEFAULT NULL,
  `act_taken` text DEFAULT NULL,
  `act_status` text DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `revised` text DEFAULT NULL,
  `num_revised` text DEFAULT NULL,
  `cancelled` text DEFAULT NULL,
  `date_requested` datetime DEFAULT NULL,
  `approver_id` text DEFAULT NULL,
  `approver` text DEFAULT NULL,
  `app_status` text DEFAULT NULL,
  `appr_date` datetime DEFAULT NULL,
  `reciever_id` text DEFAULT NULL,
  `reciever` text DEFAULT NULL,
  `rec_status` text DEFAULT NULL,
  `rec_date` datetime DEFAULT NULL,
  `performer_id` text DEFAULT NULL,
  `performer` text DEFAULT NULL,
  `perf_status` text DEFAULT NULL,
  `perform_date` datetime DEFAULT NULL,
  `verifier_id` text DEFAULT NULL,
  `verifier` text DEFAULT NULL,
  `ver_status` text DEFAULT NULL,
  `ver_date` datetime DEFAULT NULL,
  `verifier_2id` text DEFAULT NULL,
  `verifier_2` text DEFAULT NULL,
  `ver2_status` text DEFAULT NULL,
  `ver2_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `uid` int(11) NOT NULL,
  `email_add` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `middle_name` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `home_address` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_no` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_online` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `attempt` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `sub_role` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `default_role` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `multi_role` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `designation` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `department` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_modified` datetime DEFAULT NULL,
  `created_by` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`uid`, `email_add`, `password`, `first_name`, `last_name`, `middle_name`, `home_address`, `contact_no`, `image`, `status`, `is_online`, `token`, `attempt`, `role`, `sub_role`, `default_role`, `multi_role`, `title`, `designation`, `department`, `date_created`, `date_modified`, `created_by`) VALUES
(1, 'approver.role.ebiz@gmail.com', '0071d2e9dce14ead24e8635ca64803a6', 'maximo', 'george', NULL, NULL, '09095547291', NULL, '1', '0', '0', NULL, '2', NULL, '2', NULL, NULL, NULL, NULL, '2022-07-17 15:18:01', NULL, 'admin'),
(2, 'receiver.role.ebiz@gmail.com', 'b8c6a8ae0af5be0078c552364e264748', 'carlo', 'sanchez', NULL, NULL, '09503560331', NULL, '1', '0', '0', NULL, '3', NULL, '3', NULL, NULL, NULL, NULL, '2022-07-15 08:01:25', NULL, 'admin'),
(3, 'performer.role.ebiz@gmail.com', '28a89ff85c683cb147a3d1625d21dd08', 'ervin', 'delos reyes', NULL, NULL, '09397944150', NULL, '1', '0', '0', NULL, '4', NULL, '4', NULL, NULL, NULL, NULL, '2022-07-15 01:31:25', NULL, 'admin'),
(4, 'verifier.role.ebiz@gmail.com', '12780478482c15a9c2cb302a8ecf6f7b', 'rodrigo', 'de guzman', NULL, NULL, '09095547291', NULL, '1', '0', '0', NULL, '5', NULL, '5', NULL, NULL, NULL, NULL, '2022-07-15 01:36:08', NULL, 'admin'),
(5, 'verifier2.role.ebiz@gmail.com', 'a9a0fe80497a3b9ce9787c9ae13fcd7a', 'richard', 'ocampo', NULL, NULL, '09353173681', NULL, '1', '0', '0', NULL, '6', NULL, '6', NULL, NULL, NULL, NULL, '2022-07-17 15:18:23', NULL, 'admin'),
(6, 'whyllardermie@gmail.com', 'efb65a2fb845ce8a7b3509a6360a9f65', 'whyllard', 'ermie', '', '', '09554194598', NULL, '1', '1', 'c0e2bf725db7e7a854b8c181154d8059', '1', '1', NULL, '1', NULL, 'developer', 'full stack developer', 'devops', '2022-07-18 01:55:38', NULL, 'admin'),
(7, 'edwinville@gmail.com', '049c8cd3537b52d0f843c27e96ebc702', 'edwin', 'vjllapando', NULL, NULL, '09610679355', NULL, '1', '0', '0', NULL, '1', NULL, '1', NULL, NULL, NULL, NULL, '2022-06-19 15:26:11', NULL, 'admin'),
(9, 'borjiedechavez@gmail.com', '7bdeae478bc83a76c88a8e72a8a80e4d', 'borjie', 'de chavez', NULL, NULL, '09095547291', NULL, '1', '0', '0', NULL, '1', NULL, '1', NULL, NULL, NULL, NULL, '2022-06-19 15:26:13', NULL, 'admin'),
(10, 'nlapis5711@gmail.com', '4c832d0e13c987e77f79c28e0d59cad3', 'nuel', 'lapis', NULL, NULL, '09095547291', NULL, '1', '0', '0', NULL, '1', NULL, '1', NULL, NULL, NULL, NULL, '2022-06-20 03:27:16', NULL, 'admin'),
(11, 'eduardoermie@gmail.com', 'efb65a2fb845ce8a7b3509a6360a9f65', 'eduardo', 'ermie', NULL, NULL, '09095547291', NULL, '1', '0', '0', NULL, '2', NULL, '2', NULL, NULL, NULL, NULL, '2022-06-19 15:26:12', NULL, 'admin'),
(12, 'admin@ebizolution.com', '18617f440f78ad488cff35f557b880ad', 'Jericho', 'Roxales', '', '', '09554194598', NULL, '1', '0', '0', NULL, 'admin', NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-17 16:15:51', NULL, 'admin'),
(13, 'aadaya@ebizolution.com', 'efb65a2fb845ce8a7b3509a6360a9f65', 'alyssa claire', 'adaya', NULL, NULL, '09262359755', NULL, '1', '0', '0', NULL, '1', NULL, '1', NULL, NULL, NULL, NULL, '2022-06-20 01:12:35', NULL, 'admin'),
(27, 'jreyes@ebizolution.com', 'a22b049fd91b2670e49e9d3607893a7b', 'jeramy lai', 'reyes', NULL, NULL, '09216234092', NULL, '1', '0', '0', NULL, '1', NULL, '1', NULL, NULL, NULL, NULL, '2022-06-07 01:52:08', NULL, 'admin');

-- --------------------------------------------------------

--
-- Stand-in structure for view `total_user`
-- (See below for the actual view)
--
CREATE TABLE `total_user` (
`total` bigint(21)
);

-- --------------------------------------------------------

--
-- Structure for view `active_user`
--
DROP TABLE IF EXISTS `active_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `active_user`  AS SELECT count(`tbl_user`.`uid`) AS `isOnline` FROM `tbl_user` WHERE `tbl_user`.`status` = 1 AND `tbl_user`.`is_online` = 11  ;

-- --------------------------------------------------------

--
-- Structure for view `disabled_user`
--
DROP TABLE IF EXISTS `disabled_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `disabled_user`  AS SELECT count(`tbl_user`.`uid`) AS `isDisabled` FROM `tbl_user` WHERE `tbl_user`.`status` = 2222  ;

-- --------------------------------------------------------

--
-- Structure for view `offline_user`
--
DROP TABLE IF EXISTS `offline_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `offline_user`  AS SELECT count(`tbl_user`.`uid`) AS `isOffline` FROM `tbl_user` WHERE `tbl_user`.`status` = 1 AND `tbl_user`.`is_online` = 00  ;

-- --------------------------------------------------------

--
-- Structure for view `tbl_pending_request`
--
DROP TABLE IF EXISTS `tbl_pending_request`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_pending_request`  AS SELECT `tbl_hci`.`uid` AS `uid`, `tbl_hci`.`fullname` AS `fullname`, `tbl_hci`.`form_type` AS `form_type`, `tbl_hci`.`control_number` AS `control_number`, `tbl_hci`.`status` AS `status`, `tbl_hci`.`date_requested` AS `date_requested`, `tbl_hci`.`revised` AS `revised`, `tbl_hci`.`num_revised` AS `num_revised`, `tbl_hci`.`approver_id` AS `approver_id`, `tbl_hci`.`approver` AS `approver`, `tbl_hci`.`reciever_id` AS `reciever_id`, `tbl_hci`.`reciever` AS `reciever`, `tbl_hci`.`performer_id` AS `performer_id`, `tbl_hci`.`performer` AS `performer`, `tbl_hci`.`verifier_id` AS `verifier_id`, `tbl_hci`.`verifier` AS `verifier`, `tbl_hci`.`verifier_2id` AS `verifier_2id`, `tbl_hci`.`verifier_2` AS `verifier_2` FROM `tbl_hci` union select `tbl_cps`.`uid` AS `uid`,`tbl_cps`.`fullname` AS `fullname`,`tbl_cps`.`form_type` AS `form_type`,`tbl_cps`.`control_number` AS `control_number`,`tbl_cps`.`status` AS `status`,`tbl_cps`.`date_requested` AS `date_requested`,`tbl_cps`.`revised` AS `revised`,`tbl_cps`.`num_revised` AS `num_revised`,`tbl_cps`.`approver_id` AS `approver_id`,`tbl_cps`.`approver` AS `approver`,`tbl_cps`.`reciever_id` AS `reciever_id`,`tbl_cps`.`reciever` AS `reciever`,`tbl_cps`.`performer_id` AS `performer_id`,`tbl_cps`.`performer` AS `performer`,`tbl_cps`.`verifier_id` AS `verifier_id`,`tbl_cps`.`verifier` AS `verifier`,`tbl_cps`.`verifier_2id` AS `verifier_2id`,`tbl_cps`.`verifier_2` AS `verifier_2` from `tbl_cps` union select `tbl_tci`.`uid` AS `uid`,`tbl_tci`.`fullname` AS `fullname`,`tbl_tci`.`form_type` AS `form_type`,`tbl_tci`.`control_number` AS `control_number`,`tbl_tci`.`status` AS `status`,`tbl_tci`.`date_requested` AS `date_requested`,`tbl_tci`.`revised` AS `revised`,`tbl_tci`.`num_revised` AS `num_revised`,`tbl_tci`.`approver_id` AS `approver_id`,`tbl_tci`.`approver` AS `approver`,`tbl_tci`.`reciever_id` AS `reciever_id`,`tbl_tci`.`reciever` AS `reciever`,`tbl_tci`.`performer_id` AS `performer_id`,`tbl_tci`.`performer` AS `performer`,`tbl_tci`.`verifier_id` AS `verifier_id`,`tbl_tci`.`verifier` AS `verifier`,`tbl_tci`.`verifier_2id` AS `verifier_2id`,`tbl_tci`.`verifier_2` AS `verifier_2` from `tbl_tci` union select `tbl_baas`.`uid` AS `uid`,`tbl_baas`.`fullname` AS `fullname`,`tbl_baas`.`form_type` AS `form_type`,`tbl_baas`.`control_number` AS `control_number`,`tbl_baas`.`status` AS `status`,`tbl_baas`.`date_requested` AS `date_requested`,`tbl_baas`.`revised` AS `revised`,`tbl_baas`.`num_revised` AS `num_revised`,`tbl_baas`.`approver_id` AS `approver_id`,`tbl_baas`.`approver` AS `approver`,`tbl_baas`.`reciever_id` AS `reciever_id`,`tbl_baas`.`reciever` AS `reciever`,`tbl_baas`.`performer_id` AS `performer_id`,`tbl_baas`.`performer` AS `performer`,`tbl_baas`.`verifier_id` AS `verifier_id`,`tbl_baas`.`verifier` AS `verifier`,`tbl_baas`.`verifier_2id` AS `verifier_2id`,`tbl_baas`.`verifier_2` AS `verifier_2` from `tbl_baas`  ;

-- --------------------------------------------------------

--
-- Structure for view `tbl_report_view`
--
DROP TABLE IF EXISTS `tbl_report_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_report_view`  AS SELECT `tbl_hci`.`uid` AS `uid`, `tbl_hci`.`form_type` AS `form_type`, `tbl_hci`.`control_number` AS `control_number`, `tbl_hci`.`status` AS `status`, `tbl_hci`.`date_requested` AS `date_requested` FROM `tbl_hci` WHERE `tbl_hci`.`status` = 7 union select `tbl_tci`.`uid` AS `uid`,`tbl_tci`.`form_type` AS `form_type`,`tbl_tci`.`control_number` AS `control_number`,`tbl_tci`.`status` AS `status`,`tbl_tci`.`date_requested` AS `date_requested` from `tbl_tci` where `tbl_tci`.`status` = 7 union select `tbl_cps`.`uid` AS `uid`,`tbl_cps`.`form_type` AS `form_type`,`tbl_cps`.`control_number` AS `control_number`,`tbl_cps`.`status` AS `status`,`tbl_cps`.`date_requested` AS `date_requested` from `tbl_cps` where `tbl_cps`.`status` = 7 union select `tbl_baas`.`uid` AS `uid`,`tbl_baas`.`form_type` AS `form_type`,`tbl_baas`.`control_number` AS `control_number`,`tbl_baas`.`status` AS `status`,`tbl_baas`.`date_requested` AS `date_requested` from `tbl_baas` where `tbl_baas`.`status` = 7  ;

-- --------------------------------------------------------

--
-- Structure for view `total_user`
--
DROP TABLE IF EXISTS `total_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `total_user`  AS SELECT count(`tbl_user`.`uid`) AS `total` FROM `tbl_user` WHERE `tbl_user`.`status` = 11  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_activity_logs`
--
ALTER TABLE `tbl_activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_baas`
--
ALTER TABLE `tbl_baas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_backup_pass`
--
ALTER TABLE `tbl_backup_pass`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `tbl_cps`
--
ALTER TABLE `tbl_cps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_forms_others`
--
ALTER TABLE `tbl_forms_others`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_hci`
--
ALTER TABLE `tbl_hci`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_hostname`
--
ALTER TABLE `tbl_hostname`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_remarks`
--
ALTER TABLE `tbl_remarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_req_role`
--
ALTER TABLE `tbl_req_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_tci`
--
ALTER TABLE `tbl_tci`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_activity_logs`
--
ALTER TABLE `tbl_activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_baas`
--
ALTER TABLE `tbl_baas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_backup_pass`
--
ALTER TABLE `tbl_backup_pass`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_cps`
--
ALTER TABLE `tbl_cps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_forms_others`
--
ALTER TABLE `tbl_forms_others`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_hci`
--
ALTER TABLE `tbl_hci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_hostname`
--
ALTER TABLE `tbl_hostname`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_remarks`
--
ALTER TABLE `tbl_remarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_req_role`
--
ALTER TABLE `tbl_req_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_tci`
--
ALTER TABLE `tbl_tci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
