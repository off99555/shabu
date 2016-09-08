-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2016 at 01:26 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shabu`
--

-- --------------------------------------------------------

--
-- Table structure for table `asset`
--

CREATE TABLE `asset` (
  `ASSET_ID` varchar(20) NOT NULL COMMENT 'รหัสทรัพย์สินและอุปกรณ์',
  `ASSET_NAME` varchar(60) NOT NULL COMMENT 'ชื่อทรัพย์สินและอุปกรณ์',
  `ASSET_BROKEN` tinyint(1) NOT NULL COMMENT 'บันทึกว่าทรัพย์สินหรืออปุกร์มีความเสียหายหรือไม่ ถ้าใช่่ต้องแจ้งซ่อม',
  `ASSET_START_DATE` date DEFAULT NULL COMMENT 'วันที่เริ่มใช้งานทรัพย์สินหรืออุปกรณ์'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='บันทึกข้อมูลเกี่ยวกับทรัพย์สินและอุปกรณ์ต่างๆ';

--
-- Dumping data for table `asset`
--

INSERT INTO `asset` (`ASSET_ID`, `ASSET_NAME`, `ASSET_BROKEN`, `ASSET_START_DATE`) VALUES
('G070365/0000181', 'Display ผลไม้', 0, '2010-05-26'),
('G070365/0000233', 'ถังต้มน้ำไฟฟ้า ดิจิตอล', 0, '2014-10-09'),
('G110365/0000005', 'กล่องใส่เครื่องปรุงรส', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `daily_usage`
--

CREATE TABLE `daily_usage` (
  `MATERIAL_ID` int(10) UNSIGNED NOT NULL COMMENT 'รหัสวัตถุดิบที่ทำการบันทึกข้อมูล',
  `USAGE_DATE` date NOT NULL COMMENT 'วันที่ทำการบันทึกข้อมูล',
  `USAGE_AMOUNT` decimal(6,2) NOT NULL COMMENT 'จำนวนที่ใช้',
  `EXPIRED_AMOUNT` decimal(6,2) NOT NULL COMMENT 'จำนวนที่หมดอายุ',
  `REMAINING_AMOUNT` decimal(6,2) NOT NULL COMMENT 'จำนวนคงเหลือ',
  `EMPLOYEE_ID` int(7) UNSIGNED NOT NULL COMMENT 'รหัสพนักงานที่ทำการบันทึกข้อมูล'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ับันทึกข้อมูลการใช้วัตถุดิบภายในร้าน';

--
-- Dumping data for table `daily_usage`
--

INSERT INTO `daily_usage` (`MATERIAL_ID`, `USAGE_DATE`, `USAGE_AMOUNT`, `EXPIRED_AMOUNT`, `REMAINING_AMOUNT`, `EMPLOYEE_ID`) VALUES
(106, '2016-05-31', '1.00', '0.01', '9.00', 1165912);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EMPLOYEE_ID` int(7) UNSIGNED NOT NULL,
  `EMPLOYEE_FNAME` varchar(60) NOT NULL COMMENT 'ชื่อพนักงาน',
  `EMPLOYEE_LNAME` varchar(50) NOT NULL COMMENT 'นามสกุลพนักงาน',
  `EMPLOYEE_RANK` varchar(30) NOT NULL COMMENT 'ตำแหน่งของพนักงานคนหนึ่งๆ',
  `EMPLOYEE_START_DATE` date NOT NULL COMMENT 'วันที่เริ่มทำงาน',
  `EMPLOYEE_ACCOUTNUM` varchar(10) NOT NULL COMMENT 'เลขที่บัญชี',
  `EMPLOYEE_INSURANCE` varchar(13) NOT NULL COMMENT 'เลขบัตรประกันสังคม',
  `EMPLOYEE_WORKING` varchar(20) NOT NULL COMMENT 'สถานะของพนักงาน (ทำงาน/ลาออก)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='บันทึกข้อมูลเกี่ยวกับพนักงาน';

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EMPLOYEE_ID`, `EMPLOYEE_FNAME`, `EMPLOYEE_LNAME`, `EMPLOYEE_RANK`, `EMPLOYEE_START_DATE`, `EMPLOYEE_ACCOUTNUM`, `EMPLOYEE_INSURANCE`, `EMPLOYEE_WORKING`) VALUES
(1080007, 'นางสาวสุนิดา', 'จุลโยธิน', 'Ship Supervisor', '2011-03-02', '5422159835', '2210698357159', 'ทำงาน'),
(1080009, 'นายสมบูรณ์', 'ลำจวน', 'Management', '2012-01-06', '9543675210', '1154365425876', 'ลาออก'),
(1165912, 'นายอลงกรณ์', 'ภัทรพงศ์ธร', 'กุ๊ก1', '2013-12-12', '1253657895', '3320158400235', 'ทำงาน'),
(1844467, 'นายไอยรักษ์', 'บุญเลิศ', 'CM/Parttime', '2015-11-19', '6031258748', '1209700608693', 'ทำงาน');

-- --------------------------------------------------------

--
-- Table structure for table `employ_expense`
--

CREATE TABLE `employ_expense` (
  `EMPLOYEE_ID` int(7) UNSIGNED NOT NULL,
  `WORK_DATE` date NOT NULL,
  `TOTAL_PAYMENT` int(11) NOT NULL,
  `EXPENSE_PAID` int(11) NOT NULL,
  `DETAILS_PAID` varchar(100) NOT NULL COMMENT 'รายละเอียดค่าใช้จ่ายต่างๆ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ข้อมูลเงินเดือนพนักงาน';

--
-- Dumping data for table `employ_expense`
--

INSERT INTO `employ_expense` (`EMPLOYEE_ID`, `WORK_DATE`, `TOTAL_PAYMENT`, `EXPENSE_PAID`, `DETAILS_PAID`) VALUES
(1080007, '2016-12-28', 12500, 800, 'ประกันสังคม 500 บาท\r\nค่าชุดทำงาน 400 บาท'),
(1080009, '2016-03-28', 19475, 1025, 'ประกันสังคม 1025'),
(1165912, '2015-12-28', 11400, 600, 'ประกันสังคม'),
(1844467, '2016-05-28', 4000, 200, 'ประกันสังคม 200');

-- --------------------------------------------------------

--
-- Table structure for table `energy_consumption`
--

CREATE TABLE `energy_consumption` (
  `EXAMINE_DATE` date NOT NULL COMMENT 'วันที่ทำการบันทึก',
  `ELECTRICITY_USAGE` decimal(7,2) NOT NULL COMMENT 'ยอดใช้ไฟฟ้า(บาท)',
  `GAS_USAGE` decimal(7,2) NOT NULL COMMENT 'ยอดใช้แก๊ส(บาท)',
  `WATER_USAGE` decimal(7,2) NOT NULL COMMENT 'ยอดใช้น้ำประปา(บาท)',
  `EMPLOYEE_ID` int(7) UNSIGNED NOT NULL COMMENT 'รหัสพนักงานที่ทำการบันทึกข้อมูล'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ข้อมูลเกี่ยวกับการใช้พลังงานต่างๆ ภายในร้าน';

--
-- Dumping data for table `energy_consumption`
--

INSERT INTO `energy_consumption` (`EXAMINE_DATE`, `ELECTRICITY_USAGE`, `GAS_USAGE`, `WATER_USAGE`, `EMPLOYEE_ID`) VALUES
('2016-04-15', '450.00', '351.14', '254.00', 1080009),
('2016-04-20', '700.56', '452.78', '310.00', 1080009),
('2016-05-03', '654.24', '452.78', '150.69', 1080009);

-- --------------------------------------------------------

--
-- Table structure for table `extra_menu`
--

CREATE TABLE `extra_menu` (
  `MENU_ID` int(11) NOT NULL,
  `MENU_NAME` varchar(60) NOT NULL,
  `MENU_PRICE` int(11) NOT NULL,
  `MATERIAL_ID` int(7) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='เมนูพิเศษ';

--
-- Dumping data for table `extra_menu`
--

INSERT INTO `extra_menu` (`MENU_ID`, `MENU_NAME`, `MENU_PRICE`, `MATERIAL_ID`) VALUES
(1, 'ซัลมอน ซาซิมิ', 79, 10770);

-- --------------------------------------------------------

--
-- Table structure for table `extra_ordering`
--

CREATE TABLE `extra_ordering` (
  `RECEIPT_ID` int(13) UNSIGNED NOT NULL COMMENT 'รหัสใบเสร็จ',
  `MENU_ID` int(11) NOT NULL,
  `ORDER_AMOUNT` int(11) NOT NULL COMMENT 'จำนวนที่สั่ง',
  `ORDER_PRICE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `extra_ordering`
--

INSERT INTO `extra_ordering` (`RECEIPT_ID`, `MENU_ID`, `ORDER_AMOUNT`, `ORDER_PRICE`) VALUES
(1414, 1, 2, 158),
(1416, 1, 5, 395);

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `MATERIAL_ID` int(10) UNSIGNED NOT NULL,
  `MATERIAL_NAME` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `MATERIAL_TYPE` varchar(30) CHARACTER SET utf8mb4 NOT NULL COMMENT 'ประเภทของวัตถุดิบ (ของแช่แข็ง เช่น เนื้อสัตว์แช่แข็ง, ของสด เช่น น้ำจิ้ม หัวเชื้อน้ำชาเขียว, ของแห้ง เช่น ข้าวสาร แป้ง ไข่, เครื่องดื่มอัดลม, ไอศกรีม และ ผัก)',
  `MATERIAL_QOH` decimal(6,2) UNSIGNED NOT NULL COMMENT 'จำนวนคงเหลือ',
  `MATERIAL_UNIT` varchar(20) NOT NULL COMMENT 'หน่วยวัดปริมาณ',
  `MATERIAL_STOCK_LOC` varchar(30) CHARACTER SET utf8mb4 NOT NULL COMMENT 'สถานที่สำหรับจัดเก็บวัตถุดิบ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='บันทึกข้อมูลเกี่ยวกับวัตถุดิบภายในร้าน';

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`MATERIAL_ID`, `MATERIAL_NAME`, `MATERIAL_TYPE`, `MATERIAL_QOH`, `MATERIAL_UNIT`, `MATERIAL_STOCK_LOC`) VALUES
(106, 'เอสโคล่า', 'เครื่องดื่มอัดลม', '9.00', 'ถัง', 'สโตร์'),
(109, 'เอสแดง', 'เครื่องดื่มอัดลม', '9.99', 'ถัง', 'ในร้าน'),
(125, 'แตงญี่ปุ่น', 'ผัก', '12.00', 'กิโลกรัม', 'ในร้าน'),
(1987, 'เห็ดฟางจัมโบ้', 'ผัก', '7.25', 'กิโลกรัม', 'ในร้าน'),
(10198, 'ปลาหมึกกรอบชาบู', 'ของแช่แข็ง', '4.00', 'แพ็ค', 'สโตร์'),
(10770, 'แซลมอน แอตแลนติค ซาซิมิ', 'ของแช่แข็ง', '2.00', 'กล่อง', 'สโตร์'),
(30293, 'งาขาว', 'ของแห้ง', '4.00', 'ถุง', 'ในร้าน'),
(30741, 'ข้าวสารญี่ปุ่น', 'ของแห้ง', '9.99', 'ถุง', 'ในร้าน'),
(37306, 'ไอศกรีมตัก วานิลลา1*1', 'ไอศกรีม', '7.00', 'กล่อง', 'ในร้าน'),
(37308, 'ไอศกรีมตัก สตรอเบอรี่1*1', 'ไอศกรีม', '5.00', 'กล่อง', 'ในร้าน'),
(40361, 'ถุงมือขาว Satory', 'ของใช้', '9.99', 'แพ็ค', 'ในร้าน'),
(40424, 'Suma Star', 'ของใช้', '2.00', 'ถัง', 'สโตร์'),
(310001899, 'น้ำจิ้มเกี๊ยวซ่าทรงเครื่อง', 'ของสด', '6.50', 'ถุง', 'ในร้าน'),
(310001903, 'น้ำจิ้มปลาย่าง', 'ของสด', '4.00', 'ถุง', 'ในร้าน');

-- --------------------------------------------------------

--
-- Table structure for table `membercard`
--

CREATE TABLE `membercard` (
  `MEMBERCARD_ID` int(20) UNSIGNED NOT NULL,
  `MEMBERCARD_NAME` varchar(50) NOT NULL,
  `MEMBERCARD_PHONE` varchar(10) NOT NULL,
  `MEMBERCARD_EXP_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ข้อมูลบัตรสมาชิก';

--
-- Dumping data for table `membercard`
--

INSERT INTO `membercard` (`MEMBERCARD_ID`, `MEMBERCARD_NAME`, `MEMBERCARD_PHONE`, `MEMBERCARD_EXP_DATE`) VALUES
(1213065005, 'นายกพล คนเห็นผี', '0991186523', '2015-10-20'),
(1213065102, 'นายสุธิชัย หยวน', '0920051596', '2016-05-26'),
(1213065496, 'นางสาวใจดี มีเมตตา', '0882081264', '2016-06-08');

-- --------------------------------------------------------

--
-- Table structure for table `ordering`
--

CREATE TABLE `ordering` (
  `ORDER_ID` int(10) UNSIGNED NOT NULL,
  `MATERIAL_ID` int(10) UNSIGNED NOT NULL,
  `SUPPLIER_ID` int(10) UNSIGNED NOT NULL,
  `EMPLOYEE_ID` int(7) UNSIGNED NOT NULL,
  `ORDER_AMOUNT` decimal(6,2) UNSIGNED NOT NULL,
  `ORDER_COST` decimal(6,2) NOT NULL,
  `ORDER_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ORDER_ARRIVED_DATE` datetime DEFAULT NULL,
  `ORDER_EXP_DATE` datetime DEFAULT NULL,
  `ORDER_DEPLETED` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ข้อมูลเกี่ยวกับการสั่งซื้อสินค้า';

--
-- Dumping data for table `ordering`
--

INSERT INTO `ordering` (`ORDER_ID`, `MATERIAL_ID`, `SUPPLIER_ID`, `EMPLOYEE_ID`, `ORDER_AMOUNT`, `ORDER_COST`, `ORDER_DATE`, `ORDER_ARRIVED_DATE`, `ORDER_EXP_DATE`, `ORDER_DEPLETED`) VALUES
(8, 109, 0, 1165912, '10.00', '200.00', '2016-05-29 15:14:53', '2016-05-30 12:09:59', '0000-00-00 00:00:00', 1),
(24, 1987, 0, 1165912, '2.00', '22.00', '2016-05-30 01:13:48', '2016-05-30 12:12:05', '0000-00-00 00:00:00', 0),
(25, 106, 1055420479, 1080007, '6.01', '100.00', '2016-05-30 12:14:40', '2016-05-30 12:15:00', '0000-00-00 00:00:00', 0),
(26, 125, 1055420479, 1844467, '10.00', '100.00', '2016-05-31 02:12:24', '2016-05-31 02:12:35', '2016-05-31 07:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `person_price`
--

CREATE TABLE `person_price` (
  `RECEIPT_ID` int(13) UNSIGNED NOT NULL COMMENT 'เลขที่ใบเสร็จ',
  `PERSON_TYPE` varchar(10) NOT NULL COMMENT 'ประเภทของลูกค้า',
  `TOTAL_PERSON` int(11) NOT NULL COMMENT 'จำนวนลูกค้า',
  `TOTAL_PRICE` int(11) NOT NULL COMMENT 'ยอดรวม'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `person_price`
--

INSERT INTO `person_price` (`RECEIPT_ID`, `PERSON_TYPE`, `TOTAL_PERSON`, `TOTAL_PRICE`) VALUES
(1414, 'CHILD', 3, 477),
(1414, 'MATURE', 2, 718),
(1416, 'CHILD', 1, 159),
(1416, 'MATURE', 10, 3590),
(1417, 'CHILD', 5, 795);

-- --------------------------------------------------------

--
-- Table structure for table `person_type`
--

CREATE TABLE `person_type` (
  `PERSON_TYPE` varchar(10) NOT NULL,
  `PERSON_BILL_RATE` int(11) NOT NULL,
  `PERSON_START_HEIGHT` int(11) NOT NULL,
  `PERSON_END_HEIGHT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ประเภทของลูกค้า(เด็ก,ผู้ใหญ่)';

--
-- Dumping data for table `person_type`
--

INSERT INTO `person_type` (`PERSON_TYPE`, `PERSON_BILL_RATE`, `PERSON_START_HEIGHT`, `PERSON_END_HEIGHT`) VALUES
('CHILD', 159, 0, 130),
('MATURE', 359, 131, 999);

-- --------------------------------------------------------

--
-- Table structure for table `planned_work_hour`
--

CREATE TABLE `planned_work_hour` (
  `EMPLOYEE_ID` int(7) UNSIGNED NOT NULL COMMENT 'รหัสพนักงานที่อยู่ในตารางงาน',
  `WORK_DATE` date NOT NULL COMMENT 'วันที่ต้องทำงาน',
  `HOUR_OF_DAY` int(2) NOT NULL COMMENT 'ชั่วโมงที่ต้องทำงานในแต่ละวัน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางการทำงานในหนึ่งสัปดาห์';

--
-- Dumping data for table `planned_work_hour`
--

INSERT INTO `planned_work_hour` (`EMPLOYEE_ID`, `WORK_DATE`, `HOUR_OF_DAY`) VALUES
(1165912, '2016-05-24', 0),
(1165912, '2016-05-31', 0),
(1844467, '2016-06-02', 3),
(1844467, '2016-06-03', 4);

-- --------------------------------------------------------

--
-- Table structure for table `promotion_usage`
--

CREATE TABLE `promotion_usage` (
  `RECEIPT_ID` int(13) UNSIGNED NOT NULL,
  `PROMOTION_ID` int(10) UNSIGNED NOT NULL,
  `DISCOUNT` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='โปรโมชั่นที่ลูกค้าใช้';

--
-- Dumping data for table `promotion_usage`
--

INSERT INTO `promotion_usage` (`RECEIPT_ID`, `PROMOTION_ID`, `DISCOUNT`) VALUES
(1414, 1, 0),
(1416, 1, 207);

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `RECEIPT_ID` int(13) UNSIGNED NOT NULL COMMENT 'รหัสใบเสร็จ',
  `EMPLOYEE_ID` int(7) UNSIGNED NOT NULL COMMENT 'รหัสพนักงานที่ออกใบเสร็จ',
  `TOTAL_PRICE` int(11) NOT NULL DEFAULT '0' COMMENT 'ยอดชำระ(ขั้นเริ่ม)',
  `LEFTOVER_FINE` int(11) NOT NULL DEFAULT '0' COMMENT 'ค่าปรับ',
  `TOTAL_DISCOUNT` int(11) NOT NULL COMMENT 'price - fine - discount = net',
  `NET_PRICE` int(11) AS (TOTAL_PRICE + LEFTOVER_FINE - TOTAL_DISCOUNT) PERSISTENT COMMENT 'ยอดชำระรวม',
  `MEMBERCARD_ID` int(20) UNSIGNED DEFAULT NULL COMMENT 'รหัสบัตรสมาชิก',
  `RECEIPT_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'วันที่ออกใบเสร็จ',
  `RECEIPT_PAYTYPE` varchar(50) NOT NULL COMMENT 'วิธีการชำระเงิน',
  `RECEIPT_PAID` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ข้อมูลใบเสร็จ';

--
-- Dumping data for table `receipt`
--

INSERT INTO `receipt` (`RECEIPT_ID`, `EMPLOYEE_ID`, `TOTAL_PRICE`, `LEFTOVER_FINE`, `TOTAL_DISCOUNT`, `NET_PRICE`, `MEMBERCARD_ID`, `RECEIPT_DATE`, `RECEIPT_PAYTYPE`, `RECEIPT_PAID`) VALUES
(1414, 1080007, 359, 0, 0, 359, 1213065005, '2016-05-26 14:00:00', 'เงินสด', 0),
(1416, 1165912, 4144, 10, 602, 3552, 1213065102, '2016-06-02 17:04:39', 'CHECK', 1),
(1417, 1080007, 795, 0, 0, 795, NULL, '2016-06-02 18:15:16', 'CASH', 1);

-- --------------------------------------------------------

--
-- Table structure for table `repairing`
--

CREATE TABLE `repairing` (
  `REPAIR_ID` int(10) NOT NULL,
  `REQUEST_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'วันที่แจ้งซ่อม',
  `REPAIR_DATE` datetime DEFAULT NULL COMMENT 'วันที่ซ่อม',
  `SUPPLIER_ID` int(10) UNSIGNED NOT NULL COMMENT 'รหัสบริษัทคู่ค้าที่ทำการสั่งอุปกรณ์ และแจ้งซ่อม(การแจ้งซ่อมจะส่งไปยังสำนักงานใหญ่ ซึ่งกำหนดให้รหัส = 0)',
  `ASSET_ID` varchar(20) NOT NULL COMMENT 'รหัสทรัพย์สินและอุปกรณ์ต่างๆ',
  `EMPLOYEE_ID` int(7) UNSIGNED NOT NULL COMMENT 'รหัสพนักงานที่ทำการแจ้งซ่อมและบันทึกข้อมูล',
  `REPAIR_COST` decimal(6,2) DEFAULT NULL COMMENT 'ค่าใช้จ่ายในการซ่อม',
  `REPAIR_DESC` varchar(200) DEFAULT NULL COMMENT 'รายละเอียดต่างๆ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='บันทึกข้อมูลเกี่ยวกับการแจ้งซ่อมต่างๆ ภายในร้าน';

--
-- Dumping data for table `repairing`
--

INSERT INTO `repairing` (`REPAIR_ID`, `REQUEST_DATE`, `REPAIR_DATE`, `SUPPLIER_ID`, `ASSET_ID`, `EMPLOYEE_ID`, `REPAIR_COST`, `REPAIR_DESC`) VALUES
(2, '2016-05-31 13:59:37', '2016-05-31 14:25:58', 1055420479, 'G070365/0000233', 1165912, '200.00', 'ซ่อมยากชิบ'),
(3, '2016-05-31 13:59:37', '2016-05-31 14:32:03', 1055420479, 'G070365/0000233', 1165912, '0.00', '');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `SUPPLIER_ID` int(10) UNSIGNED NOT NULL,
  `SUPPLIER_NAME` varchar(30) NOT NULL,
  `SUPPLIER_PHONE` varchar(11) NOT NULL,
  `SUPPLIER_FAX` varchar(9) NOT NULL,
  `SUPPLIER_ADDRESS` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='สำหรับบันทึกข้อมูลต่างๆ เกี่ยวกับบริษัทคู่ค้า';

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`SUPPLIER_ID`, `SUPPLIER_NAME`, `SUPPLIER_PHONE`, `SUPPLIER_FAX`, `SUPPLIER_ADDRESS`) VALUES
(0, 'Head Office', '', '', ''),
(7059313, 'HAVI Logistics(Thailand)Ltd.', '07059130510', '023153649', '363 หมู่ 17 นิคมอุตสาหกรรมบางพลี ซอย 7 ถนนบางนา-ตราด อำเภอบางเสาธง จังหวัดสมุทรปราการ 10540'),
(1055420479, 'F&N United Limited', '02895707182', '028957544', '95 ถนนท่าข้าม แขวงแสมดำ เขตบางขุนเทียน กรุงเทพมหานคร ');

-- --------------------------------------------------------

--
-- Table structure for table `temporal_promotion`
--

CREATE TABLE `temporal_promotion` (
  `PROMOTION_ID` int(10) UNSIGNED NOT NULL COMMENT 'รหัสโปรโมชั่น',
  `PROMOTION_CRITERIA` varchar(100) NOT NULL COMMENT 'เงื่อนไข',
  `PROMOTION_TYPE` varchar(50) NOT NULL COMMENT 'ประเภทของโปรโมชั่น',
  `PROMOTION_VALUE` decimal(10,2) NOT NULL COMMENT 'ส่วนลดที่ได้จากโปรโมชั่น',
  `PROMOTION_START_DATE` datetime NOT NULL,
  `PROMOTION_END_DATE` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ข้อมูลโปรโมชั่น';

--
-- Dumping data for table `temporal_promotion`
--

INSERT INTO `temporal_promotion` (`PROMOTION_ID`, `PROMOTION_CRITERIA`, `PROMOTION_TYPE`, `PROMOTION_VALUE`, `PROMOTION_START_DATE`, `PROMOTION_END_DATE`) VALUES
(1, 'ต้องจ่ายด้วยเช็ค', 'RELATIVE', '5.00', '2016-06-01 00:00:00', '2016-07-31 00:00:00'),
(2, 'มา 4 จ่าย 3', 'ABSOLUTE', '350.00', '2016-06-03 00:00:00', '2016-06-30 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `work_record`
--

CREATE TABLE `work_record` (
  `EMPLOYEE_ID` int(7) UNSIGNED NOT NULL COMMENT 'รหัสพนักงานที่ทำการบันทึก',
  `WORK_DATE` date NOT NULL COMMENT 'วันที่ทำการบันทึกข้อมูล',
  `HOUR_OF_DAY` int(2) NOT NULL COMMENT 'ชั่วโมงที่ทำงานในแต่ละวัน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='บันทึกชั่วโมงการทำงานของพนักงานในแต่ละวัน';

--
-- Dumping data for table `work_record`
--

INSERT INTO `work_record` (`EMPLOYEE_ID`, `WORK_DATE`, `HOUR_OF_DAY`) VALUES
(1165912, '2016-05-17', 5),
(1165912, '2016-05-30', 5),
(1844467, '2016-05-30', 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asset`
--
ALTER TABLE `asset`
  ADD PRIMARY KEY (`ASSET_ID`);

--
-- Indexes for table `daily_usage`
--
ALTER TABLE `daily_usage`
  ADD PRIMARY KEY (`MATERIAL_ID`,`USAGE_DATE`),
  ADD KEY `MATERIAL_ID` (`MATERIAL_ID`,`EMPLOYEE_ID`),
  ADD KEY `EMPLOYEE_ID` (`EMPLOYEE_ID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EMPLOYEE_ID`);

--
-- Indexes for table `employ_expense`
--
ALTER TABLE `employ_expense`
  ADD PRIMARY KEY (`EMPLOYEE_ID`,`WORK_DATE`),
  ADD KEY `EMPLOYEE_ID` (`EMPLOYEE_ID`);

--
-- Indexes for table `energy_consumption`
--
ALTER TABLE `energy_consumption`
  ADD PRIMARY KEY (`EXAMINE_DATE`),
  ADD KEY `EMPLOYEE_ID` (`EMPLOYEE_ID`);

--
-- Indexes for table `extra_menu`
--
ALTER TABLE `extra_menu`
  ADD PRIMARY KEY (`MENU_ID`),
  ADD KEY `MATERIAL_ID` (`MATERIAL_ID`);

--
-- Indexes for table `extra_ordering`
--
ALTER TABLE `extra_ordering`
  ADD PRIMARY KEY (`RECEIPT_ID`,`MENU_ID`),
  ADD KEY `RECEIPT_ID` (`RECEIPT_ID`),
  ADD KEY `MENU_ID` (`MENU_ID`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`MATERIAL_ID`);

--
-- Indexes for table `membercard`
--
ALTER TABLE `membercard`
  ADD PRIMARY KEY (`MEMBERCARD_ID`);

--
-- Indexes for table `ordering`
--
ALTER TABLE `ordering`
  ADD PRIMARY KEY (`ORDER_ID`),
  ADD KEY `MATERIAL_ID` (`MATERIAL_ID`),
  ADD KEY `SUPPLIER_ID` (`SUPPLIER_ID`),
  ADD KEY `EMPLOYEE_ID` (`EMPLOYEE_ID`);

--
-- Indexes for table `person_price`
--
ALTER TABLE `person_price`
  ADD PRIMARY KEY (`RECEIPT_ID`,`PERSON_TYPE`),
  ADD KEY `RECEIPT_ID` (`RECEIPT_ID`,`PERSON_TYPE`),
  ADD KEY `PERSON_TYPE` (`PERSON_TYPE`);

--
-- Indexes for table `person_type`
--
ALTER TABLE `person_type`
  ADD PRIMARY KEY (`PERSON_TYPE`);

--
-- Indexes for table `planned_work_hour`
--
ALTER TABLE `planned_work_hour`
  ADD PRIMARY KEY (`EMPLOYEE_ID`,`WORK_DATE`,`HOUR_OF_DAY`),
  ADD KEY `EMPLOYEE_ID` (`EMPLOYEE_ID`);

--
-- Indexes for table `promotion_usage`
--
ALTER TABLE `promotion_usage`
  ADD PRIMARY KEY (`RECEIPT_ID`,`PROMOTION_ID`),
  ADD KEY `RECEIPT_ID` (`RECEIPT_ID`),
  ADD KEY `PROMOTION_ID` (`PROMOTION_ID`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`RECEIPT_ID`),
  ADD KEY `EMPLOYEE_ID` (`EMPLOYEE_ID`),
  ADD KEY `MEMBERCARD_ID` (`MEMBERCARD_ID`);

--
-- Indexes for table `repairing`
--
ALTER TABLE `repairing`
  ADD PRIMARY KEY (`REPAIR_ID`),
  ADD KEY `SUPPLIER_ID` (`SUPPLIER_ID`,`ASSET_ID`,`EMPLOYEE_ID`),
  ADD KEY `EMPLOYEE_ID` (`EMPLOYEE_ID`),
  ADD KEY `repairing_ibfk_3` (`ASSET_ID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`SUPPLIER_ID`);

--
-- Indexes for table `temporal_promotion`
--
ALTER TABLE `temporal_promotion`
  ADD PRIMARY KEY (`PROMOTION_ID`);

--
-- Indexes for table `work_record`
--
ALTER TABLE `work_record`
  ADD PRIMARY KEY (`EMPLOYEE_ID`,`WORK_DATE`,`HOUR_OF_DAY`),
  ADD KEY `EMPLOYEE_ID` (`EMPLOYEE_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `extra_menu`
--
ALTER TABLE `extra_menu`
  MODIFY `MENU_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `extra_ordering`
--
ALTER TABLE `extra_ordering`
  MODIFY `RECEIPT_ID` int(13) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'รหัสใบเสร็จ', AUTO_INCREMENT=1417;
--
-- AUTO_INCREMENT for table `ordering`
--
ALTER TABLE `ordering`
  MODIFY `ORDER_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `person_price`
--
ALTER TABLE `person_price`
  MODIFY `RECEIPT_ID` int(13) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'เลขที่ใบเสร็จ', AUTO_INCREMENT=1418;
--
-- AUTO_INCREMENT for table `promotion_usage`
--
ALTER TABLE `promotion_usage`
  MODIFY `RECEIPT_ID` int(13) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1417;
--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `RECEIPT_ID` int(13) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'รหัสใบเสร็จ', AUTO_INCREMENT=1418;
--
-- AUTO_INCREMENT for table `repairing`
--
ALTER TABLE `repairing`
  MODIFY `REPAIR_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `daily_usage`
--
ALTER TABLE `daily_usage`
  ADD CONSTRAINT `daily_usage_ibfk_1` FOREIGN KEY (`MATERIAL_ID`) REFERENCES `material` (`MATERIAL_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `daily_usage_ibfk_2` FOREIGN KEY (`EMPLOYEE_ID`) REFERENCES `employee` (`EMPLOYEE_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employ_expense`
--
ALTER TABLE `employ_expense`
  ADD CONSTRAINT `employ_expense_ibfk_1` FOREIGN KEY (`EMPLOYEE_ID`) REFERENCES `employee` (`EMPLOYEE_ID`);

--
-- Constraints for table `energy_consumption`
--
ALTER TABLE `energy_consumption`
  ADD CONSTRAINT `energy_consumption_ibfk_1` FOREIGN KEY (`EMPLOYEE_ID`) REFERENCES `employee` (`EMPLOYEE_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `extra_menu`
--
ALTER TABLE `extra_menu`
  ADD CONSTRAINT `extra_menu_ibfk_1` FOREIGN KEY (`MATERIAL_ID`) REFERENCES `material` (`MATERIAL_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `extra_ordering`
--
ALTER TABLE `extra_ordering`
  ADD CONSTRAINT `extra_ordering_ibfk_1` FOREIGN KEY (`MENU_ID`) REFERENCES `extra_menu` (`MENU_ID`);

--
-- Constraints for table `ordering`
--
ALTER TABLE `ordering`
  ADD CONSTRAINT `ordering_ibfk_1` FOREIGN KEY (`MATERIAL_ID`) REFERENCES `material` (`MATERIAL_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ordering_ibfk_2` FOREIGN KEY (`SUPPLIER_ID`) REFERENCES `supplier` (`SUPPLIER_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ordering_ibfk_3` FOREIGN KEY (`EMPLOYEE_ID`) REFERENCES `employee` (`EMPLOYEE_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `person_price`
--
ALTER TABLE `person_price`
  ADD CONSTRAINT `person_price_ibfk_1` FOREIGN KEY (`PERSON_TYPE`) REFERENCES `person_type` (`PERSON_TYPE`),
  ADD CONSTRAINT `person_price_ibfk_2` FOREIGN KEY (`RECEIPT_ID`) REFERENCES `receipt` (`RECEIPT_ID`);

--
-- Constraints for table `planned_work_hour`
--
ALTER TABLE `planned_work_hour`
  ADD CONSTRAINT `planned_work_hour_ibfk_1` FOREIGN KEY (`EMPLOYEE_ID`) REFERENCES `employee` (`EMPLOYEE_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `promotion_usage`
--
ALTER TABLE `promotion_usage`
  ADD CONSTRAINT `promotion_usage_ibfk_1` FOREIGN KEY (`RECEIPT_ID`) REFERENCES `receipt` (`RECEIPT_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `promotion_usage_ibfk_2` FOREIGN KEY (`PROMOTION_ID`) REFERENCES `temporal_promotion` (`PROMOTION_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `receipt`
--
ALTER TABLE `receipt`
  ADD CONSTRAINT `receipt_ibfk_1` FOREIGN KEY (`EMPLOYEE_ID`) REFERENCES `employee` (`EMPLOYEE_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `receipt_ibfk_2` FOREIGN KEY (`MEMBERCARD_ID`) REFERENCES `membercard` (`MEMBERCARD_ID`);

--
-- Constraints for table `repairing`
--
ALTER TABLE `repairing`
  ADD CONSTRAINT `repairing_ibfk_1` FOREIGN KEY (`SUPPLIER_ID`) REFERENCES `supplier` (`SUPPLIER_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `repairing_ibfk_2` FOREIGN KEY (`EMPLOYEE_ID`) REFERENCES `employee` (`EMPLOYEE_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `repairing_ibfk_3` FOREIGN KEY (`ASSET_ID`) REFERENCES `asset` (`ASSET_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_record`
--
ALTER TABLE `work_record`
  ADD CONSTRAINT `work_record_ibfk_1` FOREIGN KEY (`EMPLOYEE_ID`) REFERENCES `employee` (`EMPLOYEE_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
