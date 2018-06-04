-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `asal_usul`;
CREATE TABLE `asal_usul` (
  `asal_usul_id` int(11) NOT NULL AUTO_INCREMENT,
  `asal_usul_ket` varchar(255) NOT NULL,
  `asal_usul_insert_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `asal_usul_update_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`asal_usul_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `asal_usul` (`asal_usul_id`, `asal_usul_ket`, `asal_usul_insert_date`, `asal_usul_update_date`) VALUES
(1,	'APBN',	'2018-06-02 23:36:08',	NULL),
(2,	'APBD',	'2018-06-02 23:36:14',	NULL);

DROP TABLE IF EXISTS `hak_akses`;
CREATE TABLE `hak_akses` (
  `ha_id` int(11) NOT NULL AUTO_INCREMENT,
  `ha_menu` int(11) NOT NULL,
  `ha_ur` int(11) NOT NULL,
  `ha_view` int(11) DEFAULT NULL,
  `ha_insert` int(11) DEFAULT NULL,
  `ha_update` int(11) DEFAULT NULL,
  `ha_delete` int(11) DEFAULT NULL,
  PRIMARY KEY (`ha_id`),
  KEY `ha_ur` (`ha_ur`),
  KEY `ha_menu` (`ha_menu`),
  CONSTRAINT `hak_akses_ibfk_1` FOREIGN KEY (`ha_ur`) REFERENCES `users_role` (`ur_id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `hak_akses` (`ha_id`, `ha_menu`, `ha_ur`, `ha_view`, `ha_insert`, `ha_update`, `ha_delete`) VALUES
(1,	1,	1,	1,	0,	0,	0),
(2,	1,	5,	1,	0,	0,	0),
(3,	2,	1,	1,	0,	0,	0),
(4,	3,	1,	1,	1,	1,	1),
(5,	4,	1,	1,	1,	1,	1),
(6,	5,	1,	1,	1,	1,	1),
(7,	5,	2,	0,	0,	0,	0),
(8,	4,	2,	0,	0,	0,	0),
(9,	6,	1,	1,	1,	1,	1),
(10,	6,	4,	0,	0,	0,	0),
(11,	6,	3,	0,	0,	0,	0),
(12,	6,	6,	0,	0,	0,	0),
(13,	6,	5,	0,	0,	0,	0),
(14,	6,	2,	0,	0,	0,	0),
(15,	1,	4,	1,	0,	0,	0),
(16,	1,	3,	1,	0,	0,	0),
(17,	1,	6,	1,	0,	0,	0),
(18,	1,	5,	1,	0,	0,	0),
(19,	7,	1,	1,	1,	1,	1),
(20,	7,	2,	1,	0,	0,	0),
(21,	7,	3,	1,	0,	0,	0),
(22,	7,	4,	1,	0,	0,	0),
(23,	7,	5,	1,	0,	0,	0),
(24,	7,	6,	1,	0,	0,	0),
(25,	8,	1,	1,	1,	1,	1),
(26,	8,	2,	1,	0,	0,	0),
(27,	8,	3,	1,	0,	0,	0),
(28,	8,	4,	1,	0,	0,	0),
(29,	8,	5,	1,	0,	0,	0),
(30,	8,	6,	1,	0,	0,	0),
(31,	9,	1,	1,	1,	1,	1),
(32,	9,	2,	1,	0,	0,	0),
(33,	9,	3,	1,	0,	0,	0),
(34,	9,	4,	1,	0,	0,	0),
(35,	9,	5,	1,	0,	0,	0),
(36,	9,	6,	1,	0,	0,	0),
(37,	10,	1,	1,	1,	1,	1),
(38,	10,	2,	1,	0,	0,	0),
(39,	10,	3,	1,	0,	0,	0),
(40,	10,	4,	1,	0,	0,	0),
(41,	10,	5,	1,	0,	0,	0),
(42,	10,	6,	1,	0,	0,	0),
(43,	11,	1,	1,	1,	1,	1),
(44,	11,	2,	1,	0,	0,	0),
(45,	11,	3,	1,	0,	0,	0),
(46,	11,	4,	1,	0,	0,	0),
(47,	11,	5,	1,	0,	0,	0),
(48,	11,	6,	1,	0,	0,	0),
(49,	12,	1,	1,	1,	1,	1),
(50,	12,	2,	1,	0,	0,	0),
(51,	12,	3,	1,	0,	0,	0),
(52,	12,	4,	1,	0,	0,	0),
(53,	12,	5,	1,	0,	0,	0),
(54,	12,	6,	1,	0,	0,	0),
(55,	13,	1,	1,	1,	1,	1),
(56,	13,	2,	1,	0,	0,	0),
(57,	13,	3,	1,	0,	0,	0),
(58,	13,	4,	1,	0,	0,	0),
(59,	13,	5,	1,	0,	0,	0),
(60,	13,	6,	1,	0,	0,	0),
(61,	14,	1,	1,	1,	1,	1),
(62,	14,	2,	1,	0,	0,	0),
(63,	14,	3,	1,	0,	0,	0),
(64,	14,	4,	1,	0,	0,	0),
(65,	14,	5,	1,	0,	0,	0),
(66,	14,	6,	1,	0,	0,	0),
(67,	15,	1,	1,	1,	1,	1),
(68,	15,	2,	1,	0,	0,	0),
(69,	15,	3,	1,	0,	0,	0),
(70,	15,	4,	1,	0,	0,	0),
(71,	15,	5,	1,	0,	0,	0),
(72,	15,	6,	1,	0,	0,	0),
(73,	16,	1,	1,	1,	1,	1),
(74,	16,	2,	1,	1,	1,	1),
(75,	16,	3,	1,	1,	1,	1),
(76,	16,	4,	1,	1,	1,	1),
(77,	16,	5,	1,	1,	1,	1),
(78,	16,	6,	1,	1,	1,	1),
(79,	17,	1,	1,	1,	1,	1),
(80,	17,	2,	1,	1,	1,	1),
(81,	17,	3,	1,	1,	1,	1),
(82,	17,	4,	1,	1,	1,	1),
(83,	17,	5,	1,	1,	1,	1),
(84,	17,	6,	1,	1,	1,	1),
(85,	2,	2,	1,	0,	0,	0),
(86,	2,	3,	1,	0,	0,	0),
(87,	2,	4,	1,	0,	0,	0),
(88,	2,	5,	1,	0,	0,	0),
(89,	2,	6,	1,	0,	0,	0),
(90,	18,	1,	1,	1,	1,	1),
(91,	18,	2,	1,	1,	1,	1),
(92,	18,	3,	1,	1,	1,	1),
(93,	18,	4,	1,	1,	1,	1),
(94,	18,	5,	1,	1,	1,	1),
(95,	18,	6,	1,	1,	1,	1);

DROP TABLE IF EXISTS `kode_barang`;
CREATE TABLE `kode_barang` (
  `kode_barang_id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang_gol` varchar(2) NOT NULL,
  `kode_barang_bidang` varchar(2) NOT NULL,
  `kode_barang_kelompok` varchar(2) NOT NULL,
  `kode_barang_sub_kelompok` varchar(2) NOT NULL,
  `kode_barang_sub2_kelompok` varchar(2) NOT NULL,
  `kode_barang_ket` varchar(255) NOT NULL,
  `kode_barang_insert_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `kode_barang_update_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode_barang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `kode_bidang`;
CREATE TABLE `kode_bidang` (
  `bidang_id` int(11) NOT NULL AUTO_INCREMENT,
  `bidang_kode` varchar(2) NOT NULL,
  `bidang_ket` varchar(255) NOT NULL,
  `bidang_insert_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `bidang_update_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`bidang_id`),
  UNIQUE KEY `bidang_kode` (`bidang_kode`),
  KEY `bidang_ket` (`bidang_ket`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `kode_bidang` (`bidang_id`, `bidang_kode`, `bidang_ket`, `bidang_insert_date`, `bidang_update_date`) VALUES
(1,	'01',	'SEKWAN/DPRD',	'2018-06-02 22:25:25',	NULL);

DROP TABLE IF EXISTS `kode_kabupaten`;
CREATE TABLE `kode_kabupaten` (
  `kabupaten_id` int(11) NOT NULL AUTO_INCREMENT,
  `kabupaten_kode` varchar(2) NOT NULL,
  `kabupaten_ket` varchar(255) NOT NULL,
  `kabupaten_provinsi` int(11) NOT NULL,
  `kabupaten_insert_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `kabupaten_update_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kabupaten_id`),
  UNIQUE KEY `kabupaten_kode` (`kabupaten_kode`),
  KEY `kabupaten_provinsi` (`kabupaten_provinsi`),
  KEY `kabupaten_ket` (`kabupaten_ket`),
  CONSTRAINT `kode_kabupaten_ibfk_1` FOREIGN KEY (`kabupaten_provinsi`) REFERENCES `kode_provinsi` (`provinsi_id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `kode_kabupaten` (`kabupaten_id`, `kabupaten_kode`, `kabupaten_ket`, `kabupaten_provinsi`, `kabupaten_insert_date`, `kabupaten_update_date`) VALUES
(1,	'01',	'KABUPATEN ACEH BESAR',	1,	'2018-06-02 22:18:58',	NULL);

DROP TABLE IF EXISTS `kode_pemilik_barang`;
CREATE TABLE `kode_pemilik_barang` (
  `pb_id` int(11) NOT NULL AUTO_INCREMENT,
  `pb_kode` varchar(2) NOT NULL,
  `pb_ket` varchar(255) NOT NULL,
  `pb_insert_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `pb_update_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pb_id`),
  UNIQUE KEY `pb_kode` (`pb_kode`),
  KEY `pb_ket` (`pb_ket`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `kode_pemilik_barang` (`pb_id`, `pb_kode`, `pb_ket`, `pb_insert_date`, `pb_update_date`) VALUES
(1,	'00',	'BARANG MILIK PEMERINTAH PUSAT',	'2018-06-02 21:16:07',	NULL),
(2,	'11',	'BARANG MILIK PEMERINTAH PROVINSI',	'2018-06-02 21:16:27',	NULL),
(3,	'12',	'BARANG MILIK PEMERINTAH KABUPATEN/KOTA',	'2018-06-02 21:16:46',	NULL);

DROP TABLE IF EXISTS `kode_provinsi`;
CREATE TABLE `kode_provinsi` (
  `provinsi_id` int(11) NOT NULL AUTO_INCREMENT,
  `provinsi_kode` varchar(2) NOT NULL,
  `provinsi_ket` varchar(255) NOT NULL,
  `provinsi_insert_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `provinsi_update_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`provinsi_id`),
  UNIQUE KEY `provinsi_kode` (`provinsi_kode`),
  KEY `provinsi_ket` (`provinsi_ket`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `kode_provinsi` (`provinsi_id`, `provinsi_kode`, `provinsi_ket`, `provinsi_insert_date`, `provinsi_update_date`) VALUES
(1,	'01',	'NANGGROE ACEH DARRUSALAM',	'2018-06-02 21:28:20',	'2018-06-02 21:28:20');

DROP TABLE IF EXISTS `kode_ssub_unit`;
CREATE TABLE `kode_ssub_unit` (
  `ssub_unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `ssub_unit_kode` varchar(3) NOT NULL,
  `ssub_unit_ket` varchar(255) NOT NULL,
  `ssub_unit_sub_unit` int(11) NOT NULL,
  `ssub_unit_insert_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `ssub_unit_update_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ssub_unit_id`),
  UNIQUE KEY `ssub_unit_kode` (`ssub_unit_kode`),
  KEY `ssub_unit_sub_unit` (`ssub_unit_sub_unit`),
  KEY `ssub_unit_ket` (`ssub_unit_ket`),
  CONSTRAINT `kode_ssub_unit_ibfk_1` FOREIGN KEY (`ssub_unit_sub_unit`) REFERENCES `kode_sub_unit` (`sub_unit_id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `kode_ssub_unit` (`ssub_unit_id`, `ssub_unit_kode`, `ssub_unit_ket`, `ssub_unit_sub_unit`, `ssub_unit_insert_date`, `ssub_unit_update_date`) VALUES
(1,	'00',	'-',	1,	'2018-06-02 23:16:32',	NULL);

DROP TABLE IF EXISTS `kode_sub_unit`;
CREATE TABLE `kode_sub_unit` (
  `sub_unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_unit_kode` varchar(3) NOT NULL,
  `sub_unit_ket` varchar(255) NOT NULL,
  `sub_unit_unit` int(11) NOT NULL,
  `sub_unit_insert_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `sub_unit_update_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sub_unit_id`),
  UNIQUE KEY `sub_unit_kode` (`sub_unit_kode`),
  KEY `sub_unit_unit` (`sub_unit_unit`),
  KEY `sub_unit_ket` (`sub_unit_ket`),
  CONSTRAINT `kode_sub_unit_ibfk_1` FOREIGN KEY (`sub_unit_unit`) REFERENCES `kode_unit_bidang` (`unit_bidang_id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `kode_sub_unit` (`sub_unit_id`, `sub_unit_kode`, `sub_unit_ket`, `sub_unit_unit`, `sub_unit_insert_date`, `sub_unit_update_date`) VALUES
(1,	'01',	'SETWAN',	1,	'2018-06-02 23:00:56',	NULL);

DROP TABLE IF EXISTS `kode_unit_bidang`;
CREATE TABLE `kode_unit_bidang` (
  `unit_bidang_id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_bidang_kode` varchar(3) NOT NULL,
  `unit_bidang_ket` varchar(255) NOT NULL,
  `unit_bidang_bidang` int(11) NOT NULL,
  `unit_bidang_insert_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `unit_bidang_update_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`unit_bidang_id`),
  UNIQUE KEY `unit_bidang_kode` (`unit_bidang_kode`),
  KEY `unit_bidang_bidang` (`unit_bidang_bidang`),
  KEY `unit_bidang_ket` (`unit_bidang_ket`),
  CONSTRAINT `kode_unit_bidang_ibfk_1` FOREIGN KEY (`unit_bidang_bidang`) REFERENCES `kode_bidang` (`bidang_id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `kode_unit_bidang` (`unit_bidang_id`, `unit_bidang_kode`, `unit_bidang_ket`, `unit_bidang_bidang`, `unit_bidang_insert_date`, `unit_bidang_update_date`) VALUES
(1,	'01',	'SEKRETARIS DEWAN',	1,	'2018-06-02 22:36:06',	NULL);

DROP TABLE IF EXISTS `lokasi`;
CREATE TABLE `lokasi` (
  `lokasi_id` int(11) NOT NULL AUTO_INCREMENT,
  `lokasi_kode` varchar(25) NOT NULL,
  `lokasi_ket` varchar(255) NOT NULL,
  `lokasi_insert_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `lokasi_update_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`lokasi_id`),
  UNIQUE KEY `lokasi_kode` (`lokasi_kode`),
  KEY `lokasi_ket` (`lokasi_ket`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `lokasi` (`lokasi_id`, `lokasi_kode`, `lokasi_ket`, `lokasi_insert_date`, `lokasi_update_date`) VALUES
(1,	'11.06.00.00.00.THN.00.00',	'PUSAT',	'2018-06-02 19:57:08',	'2018-06-02 19:57:08'),
(2,	'11.06.00.01.01.THN.00.00',	'SEKRETARIAT DPRD',	'2018-06-02 19:57:02',	'2018-06-02 19:57:02');

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_ket` varchar(50) NOT NULL,
  `menu_parent` int(11) NOT NULL,
  `menu_url` varchar(100) NOT NULL,
  `menu_order` int(11) NOT NULL,
  PRIMARY KEY (`menu_id`),
  UNIQUE KEY `menu_ket` (`menu_ket`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `menu` (`menu_id`, `menu_ket`, `menu_parent`, `menu_url`, `menu_order`) VALUES
(1,	'beranda',	0,	'home',	1),
(2,	'setting',	0,	'setting',	2),
(3,	'menu',	2,	'menu',	1),
(4,	'users role',	2,	'users_role',	2),
(5,	'users',	2,	'users',	3),
(6,	'lokasi',	2,	'lokasi',	4),
(7,	'kodefikasi',	0,	'#',	3),
(8,	'kode barang',	7,	'kode_barang',	1),
(9,	'pemilik barang',	7,	'pemilik_barang',	2),
(10,	'provinsi',	7,	'provinsi',	3),
(11,	'kabupaten',	7,	'kabupaten',	4),
(12,	'bidang',	7,	'bidang',	5),
(13,	'unit bidang',	7,	'unit_bidang',	6),
(14,	'sub unit',	7,	'sub_unit',	7),
(15,	'sub sub unit',	7,	'ssub_unit',	8),
(16,	'satuan barang',	2,	'satuan_barang',	5),
(17,	'asal usul',	2,	'asal_usul',	6),
(18,	'kode lokasi',	7,	'kode_lokasi',	9);

DROP TABLE IF EXISTS `satuan_barang`;
CREATE TABLE `satuan_barang` (
  `satuan_barang_id` int(11) NOT NULL AUTO_INCREMENT,
  `satuan_barang_kode` varchar(10) NOT NULL,
  `satuan_barang_ket` varchar(255) NOT NULL,
  `satuan_barang_insert_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `satuan_barang_update_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`satuan_barang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `satuan_barang` (`satuan_barang_id`, `satuan_barang_kode`, `satuan_barang_ket`, `satuan_barang_insert_date`, `satuan_barang_update_date`) VALUES
(1,	'unit',	'UNIT',	'2018-06-02 23:27:11',	NULL);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_username` varchar(50) NOT NULL,
  `user_password` varchar(60) NOT NULL,
  `user_nama` varchar(50) NOT NULL,
  `user_nip` varchar(50) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_ur` int(11) NOT NULL,
  `user_lokasi` int(11) NOT NULL,
  `user_active` int(11) NOT NULL,
  `user_insert_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `user_update_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_username` (`user_username`),
  KEY `user_ur` (`user_ur`),
  KEY `user_lokasi` (`user_lokasi`),
  KEY `user_nama` (`user_nama`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_ur`) REFERENCES `users_role` (`ur_id`) ON DELETE NO ACTION,
  CONSTRAINT `users_ibfk_2` FOREIGN KEY (`user_lokasi`) REFERENCES `lokasi` (`lokasi_id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`user_id`, `user_username`, `user_password`, `user_nama`, `user_nip`, `user_email`, `user_ur`, `user_lokasi`, `user_active`, `user_insert_date`, `user_update_date`) VALUES
(1,	'admin',	'$2y$12$kof95rzoHFcnICJlWwnpRuBURUmzYblb4S4b7KEwAOsYE5Iq611le',	'administrator',	'',	'admin@localhost.com',	1,	1,	1,	'2018-06-02 18:31:55',	'2018-06-02 18:31:55'),
(3,	'kepalaskpd0101',	'$2y$10$u4XAyD0Xxzsff2fXoK4eWetssMicrCfoAzjFHVKKAAdBliCAB6kS6',	'kepala skpd',	'1234567890',	'kepalaskpd0101@localhost.com',	3,	2,	1,	'2018-06-02 20:05:09',	NULL);

DROP TABLE IF EXISTS `users_role`;
CREATE TABLE `users_role` (
  `ur_id` int(11) NOT NULL AUTO_INCREMENT,
  `ur_ket` varchar(50) NOT NULL,
  `ur_insert_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `ur_update_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ur_id`),
  UNIQUE KEY `ur_ket` (`ur_ket`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users_role` (`ur_id`, `ur_ket`, `ur_insert_date`, `ur_update_date`) VALUES
(1,	'administrator',	NULL,	NULL),
(2,	'staf',	NULL,	NULL),
(3,	'kepala skpd',	NULL,	NULL),
(4,	'atasan langsung',	NULL,	NULL),
(5,	'penyimpan',	NULL,	NULL),
(6,	'pengurus',	NULL,	NULL);

DROP TABLE IF EXISTS `users_sessions`;
CREATE TABLE `users_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP VIEW IF EXISTS `v_kabupaten`;
CREATE TABLE `v_kabupaten` (`kabupaten_id` int(11), `kabupaten_kode` varchar(2), `kabupaten_ket` varchar(255), `kabupaten_provinsi` int(11), `kabupaten_insert_date` timestamp, `kabupaten_update_date` timestamp, `provinsi_id` int(11), `provinsi_kode` varchar(2), `provinsi_ket` varchar(255), `provinsi_insert_date` timestamp, `provinsi_update_date` timestamp);


DROP VIEW IF EXISTS `v_ssub_unit`;
CREATE TABLE `v_ssub_unit` (`ssub_unit_id` int(11), `ssub_unit_kode` varchar(3), `ssub_unit_ket` varchar(255), `ssub_unit_sub_unit` int(11), `ssub_unit_insert_date` timestamp, `ssub_unit_update_date` timestamp, `sub_unit_id` int(11), `sub_unit_kode` varchar(3), `sub_unit_ket` varchar(255), `sub_unit_unit` int(11), `sub_unit_insert_date` timestamp, `sub_unit_update_date` timestamp, `unit_bidang_id` int(11), `unit_bidang_kode` varchar(3), `unit_bidang_ket` varchar(255), `unit_bidang_bidang` int(11), `unit_bidang_insert_date` timestamp, `unit_bidang_update_date` timestamp, `bidang_id` int(11), `bidang_kode` varchar(2), `bidang_ket` varchar(255), `bidang_insert_date` timestamp, `bidang_update_date` timestamp);


DROP VIEW IF EXISTS `v_sub_unit`;
CREATE TABLE `v_sub_unit` (`sub_unit_id` int(11), `sub_unit_kode` varchar(3), `sub_unit_ket` varchar(255), `sub_unit_unit` int(11), `sub_unit_insert_date` timestamp, `sub_unit_update_date` timestamp, `unit_bidang_id` int(11), `unit_bidang_kode` varchar(3), `unit_bidang_ket` varchar(255), `unit_bidang_bidang` int(11), `unit_bidang_insert_date` timestamp, `unit_bidang_update_date` timestamp, `bidang_id` int(11), `bidang_kode` varchar(2), `bidang_ket` varchar(255), `bidang_insert_date` timestamp, `bidang_update_date` timestamp);


DROP VIEW IF EXISTS `v_unit_bidang`;
CREATE TABLE `v_unit_bidang` (`unit_bidang_id` int(11), `unit_bidang_kode` varchar(3), `unit_bidang_ket` varchar(255), `unit_bidang_bidang` int(11), `unit_bidang_insert_date` timestamp, `unit_bidang_update_date` timestamp, `bidang_id` int(11), `bidang_kode` varchar(2), `bidang_ket` varchar(255), `bidang_insert_date` timestamp, `bidang_update_date` timestamp);


DROP VIEW IF EXISTS `v_users`;
CREATE TABLE `v_users` (`user_id` int(11), `user_username` varchar(50), `user_password` varchar(60), `user_nama` varchar(50), `user_nip` varchar(50), `user_email` varchar(100), `user_ur` int(11), `user_lokasi` int(11), `user_active` varchar(11), `user_insert_date` timestamp, `user_update_date` timestamp, `ur_id` int(11), `ur_ket` varchar(50), `lokasi_id` int(11), `lokasi_kode` varchar(25), `lokasi_ket` varchar(255), `lokasi_insert_date` timestamp, `lokasi_update_date` timestamp);


DROP TABLE IF EXISTS `v_kabupaten`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_kabupaten` AS select `kode_kabupaten`.`kabupaten_id` AS `kabupaten_id`,`kode_kabupaten`.`kabupaten_kode` AS `kabupaten_kode`,`kode_kabupaten`.`kabupaten_ket` AS `kabupaten_ket`,`kode_kabupaten`.`kabupaten_provinsi` AS `kabupaten_provinsi`,`kode_kabupaten`.`kabupaten_insert_date` AS `kabupaten_insert_date`,`kode_kabupaten`.`kabupaten_update_date` AS `kabupaten_update_date`,`kode_provinsi`.`provinsi_id` AS `provinsi_id`,`kode_provinsi`.`provinsi_kode` AS `provinsi_kode`,`kode_provinsi`.`provinsi_ket` AS `provinsi_ket`,`kode_provinsi`.`provinsi_insert_date` AS `provinsi_insert_date`,`kode_provinsi`.`provinsi_update_date` AS `provinsi_update_date` from (`kode_kabupaten` join `kode_provinsi` on((`kode_kabupaten`.`kabupaten_provinsi` = `kode_provinsi`.`provinsi_id`)));

DROP TABLE IF EXISTS `v_ssub_unit`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_ssub_unit` AS select `kode_ssub_unit`.`ssub_unit_id` AS `ssub_unit_id`,`kode_ssub_unit`.`ssub_unit_kode` AS `ssub_unit_kode`,`kode_ssub_unit`.`ssub_unit_ket` AS `ssub_unit_ket`,`kode_ssub_unit`.`ssub_unit_sub_unit` AS `ssub_unit_sub_unit`,`kode_ssub_unit`.`ssub_unit_insert_date` AS `ssub_unit_insert_date`,`kode_ssub_unit`.`ssub_unit_update_date` AS `ssub_unit_update_date`,`kode_sub_unit`.`sub_unit_id` AS `sub_unit_id`,`kode_sub_unit`.`sub_unit_kode` AS `sub_unit_kode`,`kode_sub_unit`.`sub_unit_ket` AS `sub_unit_ket`,`kode_sub_unit`.`sub_unit_unit` AS `sub_unit_unit`,`kode_sub_unit`.`sub_unit_insert_date` AS `sub_unit_insert_date`,`kode_sub_unit`.`sub_unit_update_date` AS `sub_unit_update_date`,`kode_unit_bidang`.`unit_bidang_id` AS `unit_bidang_id`,`kode_unit_bidang`.`unit_bidang_kode` AS `unit_bidang_kode`,`kode_unit_bidang`.`unit_bidang_ket` AS `unit_bidang_ket`,`kode_unit_bidang`.`unit_bidang_bidang` AS `unit_bidang_bidang`,`kode_unit_bidang`.`unit_bidang_insert_date` AS `unit_bidang_insert_date`,`kode_unit_bidang`.`unit_bidang_update_date` AS `unit_bidang_update_date`,`kode_bidang`.`bidang_id` AS `bidang_id`,`kode_bidang`.`bidang_kode` AS `bidang_kode`,`kode_bidang`.`bidang_ket` AS `bidang_ket`,`kode_bidang`.`bidang_insert_date` AS `bidang_insert_date`,`kode_bidang`.`bidang_update_date` AS `bidang_update_date` from (((`kode_ssub_unit` join `kode_sub_unit` on((`kode_ssub_unit`.`ssub_unit_sub_unit` = `kode_sub_unit`.`sub_unit_id`))) join `kode_unit_bidang` on((`kode_sub_unit`.`sub_unit_unit` = `kode_unit_bidang`.`unit_bidang_id`))) join `kode_bidang` on((`kode_unit_bidang`.`unit_bidang_bidang` = `kode_bidang`.`bidang_id`)));

DROP TABLE IF EXISTS `v_sub_unit`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_sub_unit` AS select `su`.`sub_unit_id` AS `sub_unit_id`,`su`.`sub_unit_kode` AS `sub_unit_kode`,`su`.`sub_unit_ket` AS `sub_unit_ket`,`su`.`sub_unit_unit` AS `sub_unit_unit`,`su`.`sub_unit_insert_date` AS `sub_unit_insert_date`,`su`.`sub_unit_update_date` AS `sub_unit_update_date`,`ub`.`unit_bidang_id` AS `unit_bidang_id`,`ub`.`unit_bidang_kode` AS `unit_bidang_kode`,`ub`.`unit_bidang_ket` AS `unit_bidang_ket`,`ub`.`unit_bidang_bidang` AS `unit_bidang_bidang`,`ub`.`unit_bidang_insert_date` AS `unit_bidang_insert_date`,`ub`.`unit_bidang_update_date` AS `unit_bidang_update_date`,`b`.`bidang_id` AS `bidang_id`,`b`.`bidang_kode` AS `bidang_kode`,`b`.`bidang_ket` AS `bidang_ket`,`b`.`bidang_insert_date` AS `bidang_insert_date`,`b`.`bidang_update_date` AS `bidang_update_date` from ((`kode_sub_unit` `su` join `kode_unit_bidang` `ub` on((`su`.`sub_unit_unit` = `ub`.`unit_bidang_id`))) join `kode_bidang` `b` on((`ub`.`unit_bidang_bidang` = `b`.`bidang_id`)));

DROP TABLE IF EXISTS `v_unit_bidang`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_unit_bidang` AS select `kode_unit_bidang`.`unit_bidang_id` AS `unit_bidang_id`,`kode_unit_bidang`.`unit_bidang_kode` AS `unit_bidang_kode`,`kode_unit_bidang`.`unit_bidang_ket` AS `unit_bidang_ket`,`kode_unit_bidang`.`unit_bidang_bidang` AS `unit_bidang_bidang`,`kode_unit_bidang`.`unit_bidang_insert_date` AS `unit_bidang_insert_date`,`kode_unit_bidang`.`unit_bidang_update_date` AS `unit_bidang_update_date`,`kode_bidang`.`bidang_id` AS `bidang_id`,`kode_bidang`.`bidang_kode` AS `bidang_kode`,`kode_bidang`.`bidang_ket` AS `bidang_ket`,`kode_bidang`.`bidang_insert_date` AS `bidang_insert_date`,`kode_bidang`.`bidang_update_date` AS `bidang_update_date` from (`kode_unit_bidang` join `kode_bidang` on((`kode_unit_bidang`.`unit_bidang_bidang` = `kode_bidang`.`bidang_id`)));

DROP TABLE IF EXISTS `v_users`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_users` AS select `users`.`user_id` AS `user_id`,`users`.`user_username` AS `user_username`,`users`.`user_password` AS `user_password`,`users`.`user_nama` AS `user_nama`,`users`.`user_nip` AS `user_nip`,`users`.`user_email` AS `user_email`,`users`.`user_ur` AS `user_ur`,`users`.`user_lokasi` AS `user_lokasi`,(case when (`users`.`user_active` = 1) then 'AKTIF' when (`users`.`user_active` = 0) then 'TIDAK AKTIF' end) AS `user_active`,`users`.`user_insert_date` AS `user_insert_date`,`users`.`user_update_date` AS `user_update_date`,`users_role`.`ur_id` AS `ur_id`,`users_role`.`ur_ket` AS `ur_ket`,`lokasi`.`lokasi_id` AS `lokasi_id`,`lokasi`.`lokasi_kode` AS `lokasi_kode`,`lokasi`.`lokasi_ket` AS `lokasi_ket`,`lokasi`.`lokasi_insert_date` AS `lokasi_insert_date`,`lokasi`.`lokasi_update_date` AS `lokasi_update_date` from ((`users` join `users_role` on((`users`.`user_ur` = `users_role`.`ur_id`))) join `lokasi` on((`users`.`user_lokasi` = `lokasi`.`lokasi_id`)));

-- 2018-06-04 17:09:24
