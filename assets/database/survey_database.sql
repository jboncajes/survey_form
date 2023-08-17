-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 07, 2023 at 02:40 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `survey_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `survey_id` int NOT NULL,
  `user_id` int NOT NULL,
  `answer` text NOT NULL,
  `question_id` int NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('active','archived') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=325 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `survey_id`, `user_id`, `answer`, `question_id`, `date_created`, `status`) VALUES
(67, 1, 4, 'Filipino', 9, '2023-07-31 22:18:46', 'active'),
(66, 1, 4, 'Andrea', 1, '2023-07-31 22:18:46', 'active'),
(65, 1, 4, 'Female', 2, '2023-07-31 22:18:46', 'active'),
(64, 1, 4, '35', 3, '2023-07-31 22:18:46', 'active'),
(63, 1, 4, '09222222222', 4, '2023-07-31 22:18:46', 'active'),
(62, 1, 4, '38.0', 5, '2023-07-31 22:18:46', 'active'),
(61, 1, 4, 'Yes', 6, '2023-07-31 22:18:46', 'active'),
(60, 1, 4, 'Yes', 7, '2023-07-31 22:18:46', 'active'),
(59, 1, 4, 'Yes', 8, '2023-07-31 22:18:46', 'active'),
(58, 1, 3, 'Filipino', 9, '2023-07-31 22:18:46', 'active'),
(57, 1, 3, 'Juancho', 1, '2023-07-31 22:18:46', 'active'),
(56, 1, 3, 'Prefer not to answer', 2, '2023-07-31 22:18:46', 'active'),
(55, 1, 3, '23', 3, '2023-07-31 22:18:46', 'active'),
(54, 1, 3, '09111111111', 4, '2023-07-31 22:18:46', 'active'),
(53, 1, 3, '36.0', 5, '2023-07-31 22:18:46', 'active'),
(52, 1, 3, 'No', 6, '2023-07-31 22:18:46', 'active'),
(51, 1, 3, 'No', 7, '2023-07-31 22:18:46', 'active'),
(50, 1, 3, 'Yes', 8, '2023-07-31 22:18:46', 'active'),
(36, 1, 5, 'American', 9, '2023-07-31 22:18:46', 'active'),
(35, 1, 5, 'Andres Bonifacio', 1, '2023-07-31 22:18:46', 'active'),
(34, 1, 5, 'Male', 2, '2023-07-31 22:18:46', 'active'),
(33, 1, 5, '45', 3, '2023-07-31 22:18:46', 'active'),
(32, 1, 5, '09123123123', 4, '2023-07-31 22:18:46', 'active'),
(31, 1, 5, '39.0', 5, '2023-07-31 22:18:46', 'active'),
(30, 1, 5, 'Yes', 6, '2023-07-31 22:18:46', 'active'),
(29, 1, 5, 'Yes', 7, '2023-07-31 22:18:46', 'active'),
(28, 1, 5, 'Yes', 8, '2023-07-31 22:18:46', 'active'),
(27, 1, 2, 'Filipino', 9, '2023-08-07 00:00:00', 'active'),
(19, 1, 2, 'Juan Dela Cruz', 1, '2023-08-07 00:00:00', 'active'),
(20, 1, 2, 'Male', 2, '2023-08-07 00:00:00', 'active'),
(21, 1, 2, '26', 3, '2023-08-07 00:00:00', 'active'),
(22, 1, 2, '123123123', 4, '2023-08-07 00:00:00', 'active'),
(23, 1, 2, '36.2', 5, '2023-08-07 00:00:00', 'active'),
(24, 1, 2, 'No', 6, '2023-08-07 00:00:00', 'active'),
(25, 1, 2, 'No', 7, '2023-08-07 00:00:00', 'active'),
(26, 1, 2, 'Yes', 8, '2023-08-07 00:00:00', 'active'),
(68, 1, 6, 'John Doe', 1, '2023-08-02 00:00:00', 'active'),
(69, 1, 7, 'Jane Smith', 1, '2023-08-02 00:00:00', 'active'),
(70, 1, 8, 'Michael Johnson', 1, '2023-08-02 00:00:00', 'active'),
(71, 1, 9, 'Emily Williams', 1, '2023-08-02 00:00:00', 'active'),
(72, 1, 10, 'David Brown', 1, '2023-08-02 00:00:00', 'active'),
(73, 1, 11, 'Sarah Miller', 1, '2023-08-02 00:00:00', 'active'),
(74, 1, 12, 'Robert Wilson', 1, '2023-08-02 00:00:00', 'active'),
(75, 1, 13, 'Olivia Martinez', 1, '2023-08-02 00:00:00', 'active'),
(76, 1, 14, 'James Anderson', 1, '2023-08-02 00:00:00', 'active'),
(310, 1, 18, '12313132', 4, '2023-08-05 02:34:03', 'active'),
(78, 1, 6, 'Male', 2, '2023-08-02 00:00:00', 'active'),
(79, 1, 7, 'Female', 2, '2023-08-02 00:00:00', 'active'),
(80, 1, 8, 'Male', 2, '2023-08-02 00:00:00', 'active'),
(81, 1, 9, 'Female', 2, '2023-08-02 00:00:00', 'active'),
(82, 1, 10, 'Male', 2, '2023-08-02 00:00:00', 'active'),
(83, 1, 11, 'Female', 2, '2023-08-02 00:00:00', 'active'),
(84, 1, 12, 'Male', 2, '2023-08-02 00:00:00', 'active'),
(85, 1, 13, 'Female', 2, '2023-08-02 00:00:00', 'active'),
(86, 1, 14, 'Male', 2, '2023-08-02 00:00:00', 'active'),
(308, 1, 18, 'Male', 2, '2023-08-05 02:34:03', 'active'),
(88, 1, 6, '30', 3, '2023-08-02 00:00:00', 'active'),
(89, 1, 7, '25', 3, '2023-08-02 00:00:00', 'active'),
(90, 1, 8, '42', 3, '2023-08-02 00:00:00', 'active'),
(91, 1, 9, '28', 3, '2023-08-02 00:00:00', 'active'),
(92, 1, 10, '35', 3, '2023-08-02 00:00:00', 'active'),
(93, 1, 11, '19', 3, '2023-08-02 00:00:00', 'active'),
(94, 1, 12, '55', 3, '2023-08-02 00:00:00', 'active'),
(95, 1, 13, '37', 3, '2023-08-02 00:00:00', 'active'),
(96, 1, 14, '43', 3, '2023-08-02 00:00:00', 'active'),
(309, 1, 18, '11', 3, '2023-08-05 02:34:03', 'active'),
(98, 1, 6, '1234567890', 4, '2023-08-02 00:00:00', 'active'),
(99, 1, 7, '9876543210', 4, '2023-08-02 00:00:00', 'active'),
(100, 1, 8, '5551234567', 4, '2023-08-02 00:00:00', 'active'),
(101, 1, 9, '7778889999', 4, '2023-08-02 00:00:00', 'active'),
(102, 1, 10, '4443332222', 4, '2023-08-02 00:00:00', 'active'),
(103, 1, 11, '2225557777', 4, '2023-08-02 00:00:00', 'active'),
(104, 1, 12, '1119998888', 4, '2023-08-02 00:00:00', 'active'),
(105, 1, 13, '6667778888', 4, '2023-08-02 00:00:00', 'active'),
(106, 1, 14, '3332221111', 4, '2023-08-02 00:00:00', 'active'),
(307, 1, 18, 'juan juan', 1, '2023-08-05 02:34:02', 'active'),
(108, 1, 6, '36.7', 5, '2023-08-02 00:00:00', 'active'),
(109, 1, 7, '37.2', 5, '2023-08-02 00:00:00', 'active'),
(110, 1, 8, '36.5', 5, '2023-08-02 00:00:00', 'active'),
(111, 1, 9, '37.8', 5, '2023-08-02 00:00:00', 'active'),
(112, 1, 10, '37.0', 5, '2023-08-02 00:00:00', 'active'),
(113, 1, 11, '36.9', 5, '2023-08-02 00:00:00', 'active'),
(114, 1, 12, '37.5', 5, '2023-08-02 00:00:00', 'active'),
(115, 1, 13, '36.8', 5, '2023-08-02 00:00:00', 'active'),
(116, 1, 14, '37.1', 5, '2023-08-02 00:00:00', 'active'),
(323, 1, 15, 'Yes', 8, '2023-08-06 18:56:34', 'active'),
(118, 1, 6, 'Yes', 6, '2023-08-02 00:00:00', 'active'),
(119, 1, 7, 'No', 6, '2023-08-02 00:00:00', 'active'),
(120, 1, 8, 'Yes', 6, '2023-08-02 00:00:00', 'active'),
(121, 1, 9, 'No', 6, '2023-08-02 00:00:00', 'active'),
(122, 1, 10, 'Yes', 6, '2023-08-02 00:00:00', 'active'),
(123, 1, 11, 'Yes', 6, '2023-08-02 00:00:00', 'active'),
(124, 1, 12, 'No', 6, '2023-08-02 00:00:00', 'active'),
(125, 1, 13, 'No', 6, '2023-08-02 00:00:00', 'active'),
(126, 1, 14, 'Yes', 6, '2023-08-02 00:00:00', 'active'),
(128, 1, 6, 'No', 7, '2023-08-02 00:00:00', 'active'),
(129, 1, 7, 'Yes', 7, '2023-08-02 00:00:00', 'active'),
(130, 1, 8, 'Yes', 7, '2023-08-02 00:00:00', 'active'),
(131, 1, 9, 'No', 7, '2023-08-02 00:00:00', 'active'),
(132, 1, 10, 'No', 7, '2023-08-02 00:00:00', 'active'),
(133, 1, 11, 'Yes', 7, '2023-08-02 00:00:00', 'active'),
(134, 1, 12, 'Yes', 7, '2023-08-02 00:00:00', 'active'),
(135, 1, 13, 'No', 7, '2023-08-02 00:00:00', 'active'),
(136, 1, 14, 'No', 7, '2023-08-02 00:00:00', 'active'),
(138, 1, 6, 'Yes', 8, '2023-08-02 00:00:00', 'active'),
(139, 1, 7, 'No', 8, '2023-08-02 00:00:00', 'active'),
(140, 1, 8, 'No', 8, '2023-08-02 00:00:00', 'active'),
(141, 1, 9, 'Yes', 8, '2023-08-02 00:00:00', 'active'),
(142, 1, 10, 'Yes', 8, '2023-08-02 00:00:00', 'active'),
(143, 1, 11, 'No', 8, '2023-08-02 00:00:00', 'active'),
(144, 1, 12, 'Yes', 8, '2023-08-02 00:00:00', 'active'),
(145, 1, 13, 'Yes', 8, '2023-08-02 00:00:00', 'active'),
(146, 1, 14, 'No', 8, '2023-08-02 00:00:00', 'active'),
(324, 1, 15, 'American', 9, '2023-08-06 18:56:34', 'active'),
(148, 1, 6, 'United States', 9, '2023-08-02 00:00:00', 'active'),
(149, 1, 7, 'Canada', 9, '2023-08-02 00:00:00', 'active'),
(150, 1, 8, 'United Kingdom', 9, '2023-08-02 00:00:00', 'active'),
(151, 1, 9, 'Australia', 9, '2023-08-02 00:00:00', 'active'),
(152, 1, 10, 'Germany', 9, '2023-08-02 00:00:00', 'active'),
(153, 1, 11, 'France', 9, '2023-08-02 00:00:00', 'active'),
(154, 1, 12, 'Japan', 9, '2023-08-02 00:00:00', 'active'),
(155, 1, 13, 'Brazil', 9, '2023-08-02 00:00:00', 'active'),
(156, 1, 14, 'India', 9, '2023-08-02 00:00:00', 'active'),
(322, 1, 15, 'Yes', 7, '2023-08-06 18:56:34', 'active'),
(321, 1, 15, 'No', 6, '2023-08-06 18:56:34', 'active'),
(320, 1, 15, '36.1', 5, '2023-08-06 18:56:34', 'active'),
(319, 1, 15, '09111111111', 4, '2023-08-06 18:56:34', 'active'),
(318, 1, 15, '17', 3, '2023-08-06 18:56:34', 'active'),
(317, 1, 15, 'Female', 2, '2023-08-06 18:56:34', 'active'),
(316, 1, 15, 'Ava Lee', 1, '2023-08-06 18:56:34', 'active'),
(311, 1, 18, '35', 5, '2023-08-05 02:34:03', 'active'),
(312, 1, 18, 'No', 6, '2023-08-05 02:34:03', 'active'),
(313, 1, 18, 'Yes', 7, '2023-08-05 02:34:03', 'active'),
(314, 1, 18, 'Yes', 8, '2023-08-05 02:34:03', 'active'),
(315, 1, 18, 'Filipino', 9, '2023-08-05 02:34:03', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `frm_option` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `order_by` int NOT NULL,
  `survey_id` int NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `default_value` text NOT NULL,
  `status` enum('active','archived') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `frm_option`, `type`, `order_by`, `survey_id`, `date_created`, `default_value`, `status`) VALUES
(1, 'Name', '', 'text', 1, 1, '2023-07-31 21:30:39', '', 'active'),
(2, 'Gender', 'Male,Female,Prefer not to answer', 'select', 2, 1, '2023-07-31 21:30:39', '', 'active'),
(3, 'Age', '', 'number', 3, 1, '2023-07-31 21:30:39', '', 'active'),
(4, 'Mobile Number', '', 'text', 4, 1, '2023-07-31 21:30:39', '', 'active'),
(5, 'Body Temperature', '', 'number', 5, 1, '2023-07-31 21:30:39', '37.0', 'active'),
(6, 'Diagnosed with COVID-19?', 'Yes,No', 'select', 6, 1, '2023-07-31 21:30:39', '', 'active'),
(7, 'Encounter with a person diagnosed with COVID-19?', 'Yes,No', 'select', 7, 1, '2023-07-31 21:30:39', '', 'active'),
(8, 'Vaccinated against COVID-19?', 'Yes,No', 'select', 8, 1, '2023-07-31 21:30:39', '', 'active'),
(9, 'Nationality', 'Filipino,Afghan,Albanian,Algerian,American,Andorran,Angolan,Antiguans,Argentinean,Armenian,Australian,Austrian,Azerbaijani,Bahamian,Bahraini,Bangladeshi,Barbadian,Barbudans,Belarusian,Belgian,Belizean,Beninese,Bhutanese,Bolivian,Bosnian,Brazilian,British,Bruneian,Bulgarian,Burkinabe,Burmese,Burundian,Cambodian,Cameroonian,Canadian,Cape Verdean,Central African,Chadian,Chilean,Chinese,Colombian,Comoran,Congolese,Costa Rican,Croatian,Cuban,Cypriot,Czech,Danish,Djibouti,Dominican,Dutch,East Timorese,Ecuadorean,Egyptian,Emirian,Equatorial Guinean,Eritrean,Estonian,Ethiopian,Fijian,Filipino,Finnish,French,Gabonese,Gambian,Georgian,German,Ghanaian,Greek,Grenadian,Guatemalan,Guinean,Guyanese,Haitian,Herzegovinian,Honduran,Hungarian,I-Kiribati,Icelander,Indian,Indonesian,Iranian,Iraqi,Irish,Israeli,Italian,Ivorian,Jamaican,Japanese,Jordanian,Kazakhstani,Kenyan,Kittian and Nevisian,Kuwaiti,Kyrgyz,Laotian,Latvian,Lebanese,Liberian,Libyan,Liechtensteiner,Lithuanian,Luxembourger,Macedonian,Malagasy,Malawian,Malaysian,Maldivan,Malian,Maltese,Marshallese,Mauritanian,Mauritian,Mexican,Micronesian,Moldovan,Monacan,Mongolian,Moroccan,Mosotho,Motswana,Mozambican,Namibian,Nauruan,Nepalese,New Zealander,Nicaraguan,Nigerian,Nigerien,North Korean,Northern Irish,Norwegian,Omani,Pakistani,Palauan,Panamanian,Papua New Guinean,Paraguayan,Peruvian,Polish,Portuguese,Qatari,Romanian,Russian,Rwandan,Saint Lucian,Salvadoran,Samoan,San Marinese,Sao Tomean,Saudi,Scottish,Senegalese,Serbian,Seychellois,Sierra Leonean,Singaporean,Slovakian,Slovenian,Solomon Islander,Somali,South African,South Korean,Spanish,Sri Lankan,Sudanese,Surinamer,Swazi,Swedish,Swiss,Syrian,Taiwanese,Tajik,Tanzanian,Thai,Togolese,Tongan,Trinidadian or Tobagonian,Tunisian,Turkish,Tuvaluan,Ugandan,Ukrainian,Uruguayan,Uzbekistani,Venezuelan,Vietnamese,Welsh,Yemenite,Zambian,Zimbabwean', 'select', 9, 1, '2023-07-31 21:30:39', 'Filipino', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

DROP TABLE IF EXISTS `survey`;
CREATE TABLE IF NOT EXISTS `survey` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `user_id` int NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('active','archived') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`id`, `title`, `description`, `user_id`, `start_date`, `end_date`, `date_created`, `status`) VALUES
(1, 'COVID-19 Health Declaration Survey', 'This survey is designed to collect essential health information related to COVID-19. It aims to assess potential exposure risks and understand the overall health status of respondents. The survey covers topics such as recent travel history, exposure to COVID-19 positive individuals, symptoms experienced, and vaccination status. The data collected will be used to implement necessary safety measures, track potential outbreaks, and safeguard the health of the community. Participation in this survey is vital in helping authorities and healthcare providers make informed decisions to combat the spread of COVID-19 effectively. All responses will be kept confidential and used solely for public health purposes. Your contribution in completing this survey is greatly appreciated. Stay safe and take care.', 1, '2023-08-01', '2025-01-01', '2023-07-31 21:29:48', 'active'),
(3, 'Public Perception of Online Shopping Habits', 'This sample survey aims to gather insights into the online shopping habits and preferences of consumers. Through a series of concise and straightforward questions, we seek to understand the frequency of online purchases, preferred platforms, factors influencing purchase decisions, and satisfaction levels with the overall online shopping experience. The survey intends to identify trends and provide valuable data for businesses seeking to enhance their digital retail strategies to better cater to customer needs and preferences. Participation in this survey will help shape a deeper understanding of the evolving landscape of e-commerce and consumer behavior in the digital age.', 0, '2023-08-01', '2023-09-30', '2023-07-31 23:51:46', 'archived'),
(4, 'Workplace Wellbeing and Job Satisfaction Survey', 'This survey aims to assess the overall wellbeing and job satisfaction of employees in various industries. By gathering anonymous responses, we seek to understand the factors that contribute to employee happiness, motivation, and engagement at work. The survey covers aspects such as work-life balance, job responsibilities, workplace culture, opportunities for professional growth, and the availability of support systems. The insights gathered will be used to identify areas of improvement in the workplace environment and enhance employee experiences. Your participation in this survey is instrumental in promoting healthier and more fulfilling work environments for all employees. Your responses are confidential, and the aggregated data will be used solely for research purposes.', 0, '0000-00-00', '0000-00-00', '2023-08-01 13:35:20', 'archived');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `middlename` varchar(200) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1=Admin, 2=User',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('active','archived') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `middlename`, `contact`, `address`, `email`, `password`, `type`, `date_created`, `status`) VALUES
(2, 'Juan', 'Cruz', 'Dela', '12312313', 'Manila', 'juan@gmail.com', '$2y$10$BmEDUtE.gwBoB4TJcLVfO.errQzAv6F4aoiuin02YM/nDQdc5hcrG', 2, '2023-07-31 21:18:08', 'active'),
(1, 'Admin', 'Admin', 'Admin', '091234556789', 'Sample address', 'admin@admin.com', '$2y$10$YSVnPNO1oBwYbtmH/F.4..2.gqUBrJ9icJ9.IysF73mvRUVZCV0Yi', 1, '2023-07-31 22:31:18', 'active'),
(5, 'Andres', 'Facio', 'Boni', '123123132', 'San Andres Alaminos', 'andres@email.com', '$2y$10$BmEDUtE.gwBoB4TJcLVfO.errQzAv6F4aoiuin02YM/nDQdc5hcrG', 2, '2023-07-31 23:41:02', 'archived'),
(3, 'Juancho', 'Juancho', '', '09111111111', 'Manila', 'juancho@gmail.com', '$2y$10$BmEDUtE.gwBoB4TJcLVfO.errQzAv6F4aoiuin02YM/nDQdc5hcrG', 2, '2023-07-31 21:18:08', 'active'),
(4, 'Andrea', 'Andrea', '', '09222222222', 'Manila', 'andrea@gmail.com', '$2y$10$BmEDUtE.gwBoB4TJcLVfO.errQzAv6F4aoiuin02YM/nDQdc5hcrG', 2, '2023-07-31 21:18:08', 'active'),
(6, 'John', 'Doe', 'A.', '1234567890', '123 Main St', 'john.doe@example.com', '$2y$10$BmEDUtE.gwBoB4TJcLVfO.errQzAv6F4aoiuin02YM/nDQdc5hcrG', 2, '2023-08-02 00:00:00', 'active'),
(7, 'Jane', 'Smith', 'B.', '9876543210', '456 Elm St', 'jane.smith@example.com', '$2y$10$BmEDUtE.gwBoB4TJcLVfO.errQzAv6F4aoiuin02YM/nDQdc5hcrG', 2, '2023-08-02 00:00:00', 'active'),
(8, 'Michael', 'Johnson', 'C.', '5551234567', '789 Oak Ave', 'michael.johnson@example.com', '$2y$10$BmEDUtE.gwBoB4TJcLVfO.errQzAv6F4aoiuin02YM/nDQdc5hcrG', 2, '2023-08-02 00:00:00', 'active'),
(9, 'Emily', 'Williams', 'D.', '7778889999', '101 Maple Rd', 'emily.williams@example.com', '$2y$10$BmEDUtE.gwBoB4TJcLVfO.errQzAv6F4aoiuin02YM/nDQdc5hcrG', 2, '2023-08-02 00:00:00', 'active'),
(10, 'David', 'Brown', 'E.', '4443332222', '222 Pine Ln', 'david.brown@example.com', '$2y$10$BmEDUtE.gwBoB4TJcLVfO.errQzAv6F4aoiuin02YM/nDQdc5hcrG', 2, '2023-08-02 00:00:00', 'active'),
(11, 'Sarah', 'Miller', 'F.', '2225557777', '333 Cedar St', 'sarah.miller@example.com', '$2y$10$BmEDUtE.gwBoB4TJcLVfO.errQzAv6F4aoiuin02YM/nDQdc5hcrG', 2, '2023-08-02 00:00:00', 'active'),
(12, 'Robert', 'Wilson', 'G.', '1119998888', '444 Birch Rd', 'robert.wilson@example.com', '$2y$10$BmEDUtE.gwBoB4TJcLVfO.errQzAv6F4aoiuin02YM/nDQdc5hcrG', 2, '2023-08-02 00:00:00', 'active'),
(13, 'Olivia', 'Martinez', 'H.', '6667778888', '555 Oak St', 'olivia.martinez@example.com', '$2y$10$BmEDUtE.gwBoB4TJcLVfO.errQzAv6F4aoiuin02YM/nDQdc5hcrG', 2, '2023-08-02 00:00:00', 'active'),
(14, 'James', 'Anderson', 'I.', '3332221111', '666 Elm Ave', 'james.anderson@example.com', '$2y$10$BmEDUtE.gwBoB4TJcLVfO.errQzAv6F4aoiuin02YM/nDQdc5hcrG', 2, '2023-08-02 00:00:00', 'active'),
(15, 'Ava', 'Lee', 'J.', '9991113333', '777 Maple Ln', 'ava.lee@example.com', '$2y$10$7eOBo8uEzfZcI.k6NVd4WuuAfu1r64xSzHMT45uxGHiOjfGETNB0O', 2, '2023-08-02 00:00:00', 'active');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
