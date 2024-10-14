-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2024 at 01:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `service_sp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbaction_code`
--

CREATE TABLE `tbaction_code` (
  `Action_Code_ID` varchar(10) NOT NULL,
  `Action_Code_Name` varchar(255) DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL,
  `UpdatedBy` varchar(10) DEFAULT NULL,
  `CreateDateTime` datetime DEFAULT NULL,
  `IsDeleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbaction_code`
--

INSERT INTO `tbaction_code` (`Action_Code_ID`, `Action_Code_Name`, `UpdatedDateTime`, `UpdatedBy`, `CreateDateTime`, `IsDeleted`) VALUES
('AC1', 'Rescan S/N', NULL, 'th00000001', '2024-10-01 14:31:23', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbassign_group`
--

CREATE TABLE `tbassign_group` (
  `Assign_Group_ID` varchar(10) NOT NULL,
  `Emp_ID` varchar(10) DEFAULT NULL,
  `Group_ID` varchar(10) DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL,
  `UpdatedBy` varchar(10) DEFAULT NULL,
  `CreateDateTime` datetime DEFAULT NULL,
  `IsDeleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbassign_group`
--

INSERT INTO `tbassign_group` (`Assign_Group_ID`, `Emp_ID`, `Group_ID`, `UpdatedDateTime`, `UpdatedBy`, `CreateDateTime`, `IsDeleted`) VALUES
('AG1', 'th00000001', 'G1', NULL, 'th00000001', '2024-10-01 18:16:27', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbcategory`
--

CREATE TABLE `tbcategory` (
  `Category_ID` varchar(10) NOT NULL,
  `Category_Name` varchar(255) DEFAULT NULL,
  `Category_Description` varchar(255) DEFAULT NULL,
  `Category_Pic` varchar(255) DEFAULT NULL,
  `Category_Type` enum('0','1') NOT NULL DEFAULT '0',
  `UpdatedDateTime` datetime DEFAULT NULL,
  `UpdatedBy` varchar(10) DEFAULT NULL,
  `CreateDateTime` datetime DEFAULT NULL,
  `IsDeleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbcategory`
--

INSERT INTO `tbcategory` (`Category_ID`, `Category_Name`, `Category_Description`, `Category_Pic`, `Category_Type`, `UpdatedDateTime`, `UpdatedBy`, `CreateDateTime`, `IsDeleted`) VALUES
('C1', 'Laptop / Desktop Order', 'Order buy new one', 'cat_66fa72a3aa3931.977605745f785ef5d301fcd99c55d2c60f69d1eac0b3df0a5a7d9136a9cc41ff27ac64d6.jpg', '1', NULL, 'th00000001', '2024-09-30 16:42:59', '0'),
('C2', 'Computer Problem', 'Report Problem', 'cat_66fa75d5af7223.24540817353a65366e27ff198f7736e8df6745c18975aa16e325d1981053965e1863e0ea.jpg', '0', NULL, 'th00000001', '2024-09-30 16:56:37', '0'),
('C3', 'Local Application Issue', 'Local Application Issue request', 'cat_66fb8b5ea1f881.04038010d1fc4100dacea34be5ec5e2a769b5e132f73a45bf410ed7ab39b1f42d7d02f8a.jpg', '0', NULL, 'th00000001', '2024-10-01 12:40:46', '0'),
('C4', 'SAP Issue', 'Report for SAP Problem', 'cat_66fb8b93f28246.968288736d4bfd5996c955466049459b78a21344f94d01392e0299f70278337d1e2aa696.jpg', '0', NULL, 'th00000001', '2024-10-01 12:41:40', '0'),
('C5', 'test', 'test', 'cat_66fb8dff556238.9997295839507b9b267516c55ad35e33f00e79b4aa1ce72a40c6d8e617696e459d8f1c7a.jpg', '0', NULL, 'th00000001', '2024-10-01 12:51:59', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbclose_code`
--

CREATE TABLE `tbclose_code` (
  `Close_Code_ID` varchar(10) NOT NULL,
  `Close_Code_Name` varchar(255) DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL,
  `UpdatedBy` varchar(10) DEFAULT NULL,
  `CreateDateTime` datetime DEFAULT NULL,
  `IsDeleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbclose_code`
--

INSERT INTO `tbclose_code` (`Close_Code_ID`, `Close_Code_Name`, `UpdatedDateTime`, `UpdatedBy`, `CreateDateTime`, `IsDeleted`) VALUES
('CC1', 'Information to user', NULL, 'th00000001', '2024-10-01 14:30:57', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbconfiguration_item`
--

CREATE TABLE `tbconfiguration_item` (
  `Configuration_Item_ID` varchar(10) NOT NULL,
  `Configuration_Item_Name` varchar(255) DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL,
  `UpdatedBy` varchar(10) DEFAULT NULL,
  `CreateDateTime` datetime DEFAULT NULL,
  `IsDeleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbdepartment`
--

CREATE TABLE `tbdepartment` (
  `Dep_ID` varchar(10) NOT NULL,
  `Site_ID` varchar(10) NOT NULL,
  `Dep_Name` varchar(255) DEFAULT NULL,
  `Dep_Manager` varchar(10) DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL,
  `UpdatedBy` varchar(10) DEFAULT NULL,
  `CreateDateTime` datetime DEFAULT NULL,
  `IsDeleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbdepartment`
--

INSERT INTO `tbdepartment` (`Dep_ID`, `Site_ID`, `Dep_Name`, `Dep_Manager`, `UpdatedDateTime`, `UpdatedBy`, `CreateDateTime`, `IsDeleted`) VALUES
('D1', 'S1', 'IT', 'th00000004', '2024-10-05 18:19:30', 'th00000001', '2024-10-05 18:17:34', '0'),
('D2', 'S2', 'IT', 'th00000006', '2024-10-05 18:22:08', 'th00000001', '2024-10-05 18:17:45', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbemployee`
--

CREATE TABLE `tbemployee` (
  `Emp_ID` varchar(10) NOT NULL,
  `Emp_FirstName` varchar(255) DEFAULT NULL,
  `Emp_LastName` varchar(255) DEFAULT NULL,
  `Emp_GivenName` varchar(255) DEFAULT NULL,
  `Emp_Email` varchar(255) DEFAULT NULL,
  `Emp_Phone` varchar(10) DEFAULT NULL,
  `Emp_BusinessPhone` varchar(10) DEFAULT NULL,
  `Emp_Pic` varchar(255) DEFAULT NULL,
  `Emp_Username` varchar(255) DEFAULT NULL,
  `Emp_Password` varchar(255) DEFAULT NULL,
  `Dep_ID` varchar(10) NOT NULL,
  `Position_ID` varchar(10) NOT NULL,
  `Status_ID` varchar(10) NOT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL,
  `UpdatedBy` varchar(10) DEFAULT NULL,
  `CreateDateTime` datetime DEFAULT NULL,
  `IsDeleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbemployee`
--

INSERT INTO `tbemployee` (`Emp_ID`, `Emp_FirstName`, `Emp_LastName`, `Emp_GivenName`, `Emp_Email`, `Emp_Phone`, `Emp_BusinessPhone`, `Emp_Pic`, `Emp_Username`, `Emp_Password`, `Dep_ID`, `Position_ID`, `Status_ID`, `UpdatedDateTime`, `UpdatedBy`, `CreateDateTime`, `IsDeleted`) VALUES
('th00000001', 'System', 'Admin', 'admin', 'admin@gmail.com', '0877841290', '0', 'emp_66fa3dabbcaa28.25124571cc67df8941e91773858209fe63dea0cbb3cfbc02b2ac46cb9ca01d7e2bd0192b.png', 'admin', '$2y$12$8n7gGIafW/aKD7pXLeRpKOT6npQbR1cIkB1eYFid7wpGfF6O/KKgC', 'D1', 'P1', 'S1', NULL, 'th00000001', '2024-09-30 12:57:00', '0'),
('th00000002', 'TH', 'TH', 'TH', 'TH@GMAIL.COM', '0', '0', 'emp_670120821e3ce4.3642109112dc0c1ed2f585b10102391e709512f73d88b13565fb0349a35e0ee500c54493.png', 'TH', '$2y$12$x8alee8yD43nZWiTrp1RjOqM6Wjk2r7Fyuq.CAzdrEGD.aP8c1AIS', 'D1', 'P1', 'S1', NULL, 'th00000001', '2024-10-05 18:18:26', '0'),
('th00000003', 'TH2', 'TH2', 'TH2', 'TH2@GMAIL.COM', '0', '0', 'emp_670120a5dca0b1.06214693a110d1ec58e958df443b7497b548c6cb2c5781e8aa4db7ec366abc9cf37bc5e7.png', 'TH2', '$2y$12$tWbwFjPOTQgrrojEhwwipeCOMozFT9.ejr3Wvhl8Eaudc738w3Eym', 'D1', 'P1', 'S1', NULL, 'th00000001', '2024-10-05 18:19:01', '0'),
('th00000004', 'TH3', 'TH3', 'TH3', 'TH3@GMAIL.COM', '0', '0', 'emp_670120b6885256.00925384a36bc14e513f0058f5ff4070f17f6d9e8c3496bb504e73cfc844e032285c013a.png', 'TH3', '$2y$12$qtnH4TR9GD8igaxulvl.XeMPzZuxH/0NiTsbMteX0p5N464i8T7SK', 'D1', 'P2', 'S1', NULL, 'th00000001', '2024-10-05 18:19:18', '0'),
('th00000005', 'JP', 'JP', 'JP', 'JP@GMAIL.COM', '0', '0', 'emp_670121241677e7.72381623d1785c95364944a3faf76cbbd0a2076502d4f2afe7bce5b654fc7750da6467b8.png', 'JP', '$2y$12$KRtRwVA0Kd8CoNsxKEulr.2VpsPF73/a6H30q7KObyENoI8mQP/.W', 'D2', 'P1', 'S1', NULL, 'th00000001', '2024-10-05 18:21:08', '0'),
('th00000006', 'JP2', 'JP2', 'JP2', 'JP2@GMAIL.COM', '2', '2', 'emp_670121569e6a14.66571203e72cc5d553fe0f9f675482f9d841370b400152f6e4235b5133dc368b04e3a96e.png', 'JP2', '$2y$12$bMlor4RNT5eV.QjR4Kzb6exy71lBJVK82jmjJZeRUqKySpVhRgXRq', 'D2', 'P1', 'S1', NULL, 'th00000001', '2024-10-05 18:21:58', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbemployeestatus`
--

CREATE TABLE `tbemployeestatus` (
  `Status_ID` varchar(10) NOT NULL,
  `Status_Name` varchar(10) DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL,
  `UpdatedBy` varchar(10) DEFAULT NULL,
  `CreateDateTime` datetime DEFAULT NULL,
  `IsDeleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbemployeestatus`
--

INSERT INTO `tbemployeestatus` (`Status_ID`, `Status_Name`, `UpdatedDateTime`, `UpdatedBy`, `CreateDateTime`, `IsDeleted`) VALUES
('S1', 'Active', '2024-09-30 12:31:28', 'th00000001', '2024-09-24 00:28:25', '0'),
('S2', 'Disable', '2024-09-30 12:31:24', 'th00000001', '2024-09-24 00:29:35', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbgroup`
--

CREATE TABLE `tbgroup` (
  `Group_ID` varchar(10) NOT NULL,
  `Group_Name` varchar(255) DEFAULT NULL,
  `Group_Admin` enum('0','1','2') NOT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL,
  `UpdatedBy` varchar(10) DEFAULT NULL,
  `CreateDateTime` datetime DEFAULT NULL,
  `IsDeleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbgroup`
--

INSERT INTO `tbgroup` (`Group_ID`, `Group_Name`, `Group_Admin`, `UpdatedDateTime`, `UpdatedBy`, `CreateDateTime`, `IsDeleted`) VALUES
('G1', 'Super Admin', '2', '2024-09-30 14:55:23', 'th00000001', '2024-09-30 14:20:52', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbposition`
--

CREATE TABLE `tbposition` (
  `Position_ID` varchar(10) NOT NULL,
  `Position_name` varchar(255) DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL,
  `UpdatedBy` varchar(10) DEFAULT NULL,
  `CreateDateTime` datetime DEFAULT NULL,
  `IsDeleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbposition`
--

INSERT INTO `tbposition` (`Position_ID`, `Position_name`, `UpdatedDateTime`, `UpdatedBy`, `CreateDateTime`, `IsDeleted`) VALUES
('P1', 'Employee', '2024-09-30 11:01:31', 'th00000003', '2024-09-23 23:37:51', '0'),
('P2', 'Manager', '2024-09-30 11:00:07', 'th00000003', '2024-09-23 23:48:15', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbpriority`
--

CREATE TABLE `tbpriority` (
  `Priority_ID` varchar(10) NOT NULL,
  `Priority_Name` varchar(255) DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL,
  `UpdatedBy` varchar(10) DEFAULT NULL,
  `CreateDateTime` datetime DEFAULT NULL,
  `IsDeleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbpriority`
--

INSERT INTO `tbpriority` (`Priority_ID`, `Priority_Name`, `UpdatedDateTime`, `UpdatedBy`, `CreateDateTime`, `IsDeleted`) VALUES
('P1', 'High', NULL, 'th00000001', '2024-10-01 13:22:50', '0'),
('P2', 'Medium', NULL, 'th00000001', '2024-10-01 13:22:50', '0'),
('P3', 'Low', NULL, 'th00000001', '2024-10-01 13:22:50', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbsite`
--

CREATE TABLE `tbsite` (
  `Site_ID` varchar(10) NOT NULL,
  `Site_Name` varchar(255) DEFAULT NULL,
  `Site_Location` varchar(255) DEFAULT NULL,
  `Site_Street` varchar(255) DEFAULT NULL,
  `Site_City` varchar(255) DEFAULT NULL,
  `Site_Province` varchar(255) DEFAULT NULL,
  `Site_Postal_Code` varchar(10) DEFAULT NULL,
  `Site_Manager` varchar(10) DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL,
  `UpdatedBy` varchar(10) DEFAULT NULL,
  `CreateDateTime` datetime DEFAULT NULL,
  `IsDeleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbsite`
--

INSERT INTO `tbsite` (`Site_ID`, `Site_Name`, `Site_Location`, `Site_Street`, `Site_City`, `Site_Province`, `Site_Postal_Code`, `Site_Manager`, `UpdatedDateTime`, `UpdatedBy`, `CreateDateTime`, `IsDeleted`) VALUES
('S1', 'TH', 'Thailand', 'N/A', 'Sriracha', 'Chonburi', '20230', 'th00000003', '2024-09-30 16:23:51', 'th00000001', '2024-09-30 14:16:06', '0'),
('S2', 'JP', 'Japan', 'N/A', 'N/A', 'N/A', '0045210', 'th00000001', NULL, 'th00000001', '2024-10-02 16:28:53', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbstate`
--

CREATE TABLE `tbstate` (
  `State_ID` varchar(10) NOT NULL,
  `State_Name` varchar(255) DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL,
  `UpdatedBy` varchar(10) DEFAULT NULL,
  `CreateDateTime` datetime DEFAULT NULL,
  `IsDeleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbstate`
--

INSERT INTO `tbstate` (`State_ID`, `State_Name`, `UpdatedDateTime`, `UpdatedBy`, `CreateDateTime`, `IsDeleted`) VALUES
('ST01', 'NEW', NULL, '62022378', '2024-09-30 16:38:18', '0'),
('ST02', 'In progress', NULL, '62022378', '2024-09-30 16:38:18', '0'),
('ST03', 'On Hold', NULL, '62022378', '2024-09-30 16:38:18', '0'),
('ST04', 'Resolved', NULL, '62022378', '2024-09-30 16:38:18', '0'),
('ST05', 'Cancel', NULL, '62022378', '2024-09-30 16:38:18', '0'),
('ST06', 'Waiting Approve', NULL, '62022378', '2024-09-30 16:39:03', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbticket`
--

CREATE TABLE `tbticket` (
  `Ticket_ID` varchar(10) NOT NULL,
  `Emp_ID` varchar(255) DEFAULT NULL,
  `Group_ID` varchar(10) DEFAULT NULL,
  `Configuration_Item_ID` varchar(10) DEFAULT NULL,
  `Priority_ID` varchar(10) DEFAULT NULL,
  `Category_ID` varchar(10) DEFAULT NULL,
  `Action_Code_ID` varchar(10) DEFAULT NULL,
  `Close_Code_ID` varchar(10) DEFAULT NULL,
  `State_ID` varchar(10) NOT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL,
  `UpdatedBy` varchar(10) DEFAULT NULL,
  `CreateDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbticket`
--

INSERT INTO `tbticket` (`Ticket_ID`, `Emp_ID`, `Group_ID`, `Configuration_Item_ID`, `Priority_ID`, `Category_ID`, `Action_Code_ID`, `Close_Code_ID`, `State_ID`, `UpdatedDateTime`, `UpdatedBy`, `CreateDateTime`) VALUES
('SER0000001', 'th00000002', 'G1', NULL, 'P3', 'C1', NULL, NULL, 'ST06', NULL, NULL, '2024-10-05 18:19:53'),
('SER0000002', 'th00000002', 'G1', NULL, 'P3', 'C1', NULL, NULL, 'ST06', NULL, NULL, '2024-10-05 18:19:59'),
('SER0000003', 'th00000003', 'G1', NULL, 'P3', 'C1', NULL, NULL, 'ST06', NULL, NULL, '2024-10-05 18:20:13'),
('SER0000004', 'th00000005', 'G1', NULL, 'P3', 'C1', NULL, NULL, 'ST06', NULL, NULL, '2024-10-05 18:22:29');

-- --------------------------------------------------------

--
-- Table structure for table `tbticketcomment`
--

CREATE TABLE `tbticketcomment` (
  `Comment_ID` varchar(10) NOT NULL,
  `Ticket_Detail_ID` varchar(10) DEFAULT NULL,
  `Comment_Detail` varchar(255) DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL,
  `UpdatedBy` varchar(10) DEFAULT NULL,
  `CreateDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbticketdetail`
--

CREATE TABLE `tbticketdetail` (
  `Ticket_Detail_ID` int(10) NOT NULL,
  `Ticket_ID` varchar(10) DEFAULT NULL,
  `Ticket_Detail` varchar(255) DEFAULT NULL,
  `Ticket_AdditionalComment` varchar(255) DEFAULT NULL,
  `Ticket_CustomerComment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbticketdetail`
--

INSERT INTO `tbticketdetail` (`Ticket_Detail_ID`, `Ticket_ID`, `Ticket_Detail`, `Ticket_AdditionalComment`, `Ticket_CustomerComment`) VALUES
(32, 'SER0000001', 'ASD', 'ASD', 'ASD'),
(33, 'SER0000002', 'ASD', 'ASD', 'AS'),
(34, 'SER0000003', 'ASDDASADS', 'ASDDSAD', ''),
(35, 'SER0000004', 'ASDADSADS', 'ADSASDADS', 'ASDADSADS');

-- --------------------------------------------------------

--
-- Table structure for table `tbticketworknote`
--

CREATE TABLE `tbticketworknote` (
  `WorkNote_ID` varchar(10) NOT NULL,
  `Ticket_Detail_ID` varchar(10) DEFAULT NULL,
  `WorkNote_Detail` varchar(255) DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL,
  `UpdatedBy` varchar(10) DEFAULT NULL,
  `CreateDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbaction_code`
--
ALTER TABLE `tbaction_code`
  ADD PRIMARY KEY (`Action_Code_ID`);

--
-- Indexes for table `tbassign_group`
--
ALTER TABLE `tbassign_group`
  ADD PRIMARY KEY (`Assign_Group_ID`);

--
-- Indexes for table `tbcategory`
--
ALTER TABLE `tbcategory`
  ADD PRIMARY KEY (`Category_ID`);

--
-- Indexes for table `tbclose_code`
--
ALTER TABLE `tbclose_code`
  ADD PRIMARY KEY (`Close_Code_ID`);

--
-- Indexes for table `tbconfiguration_item`
--
ALTER TABLE `tbconfiguration_item`
  ADD PRIMARY KEY (`Configuration_Item_ID`);

--
-- Indexes for table `tbdepartment`
--
ALTER TABLE `tbdepartment`
  ADD PRIMARY KEY (`Dep_ID`);

--
-- Indexes for table `tbemployee`
--
ALTER TABLE `tbemployee`
  ADD PRIMARY KEY (`Emp_ID`);

--
-- Indexes for table `tbemployeestatus`
--
ALTER TABLE `tbemployeestatus`
  ADD PRIMARY KEY (`Status_ID`);

--
-- Indexes for table `tbgroup`
--
ALTER TABLE `tbgroup`
  ADD PRIMARY KEY (`Group_ID`);

--
-- Indexes for table `tbposition`
--
ALTER TABLE `tbposition`
  ADD PRIMARY KEY (`Position_ID`);

--
-- Indexes for table `tbpriority`
--
ALTER TABLE `tbpriority`
  ADD PRIMARY KEY (`Priority_ID`);

--
-- Indexes for table `tbsite`
--
ALTER TABLE `tbsite`
  ADD PRIMARY KEY (`Site_ID`);

--
-- Indexes for table `tbstate`
--
ALTER TABLE `tbstate`
  ADD PRIMARY KEY (`State_ID`);

--
-- Indexes for table `tbticket`
--
ALTER TABLE `tbticket`
  ADD PRIMARY KEY (`Ticket_ID`);

--
-- Indexes for table `tbticketcomment`
--
ALTER TABLE `tbticketcomment`
  ADD PRIMARY KEY (`Comment_ID`);

--
-- Indexes for table `tbticketdetail`
--
ALTER TABLE `tbticketdetail`
  ADD PRIMARY KEY (`Ticket_Detail_ID`);

--
-- Indexes for table `tbticketworknote`
--
ALTER TABLE `tbticketworknote`
  ADD PRIMARY KEY (`WorkNote_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbticketdetail`
--
ALTER TABLE `tbticketdetail`
  MODIFY `Ticket_Detail_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
