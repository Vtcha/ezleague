-- ezLeague Dummy Data SQL Dump
-- version 3.4.2
-- http://www.mdloring.com
-- http://github.com/stoopkid1/ezleague
--
-- Host: localhost:8889
-- Generation Time: Apr 03, 2015 at 10:10 AM
-- Server version: 5.5.38
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ezldemo`
--

-- --------------------------------------------------------

--
-- Table structure for table `ezlusers`
--

CREATE TABLE `ezlusers` (
`id` int(10) unsigned NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `first_name` varchar(250) DEFAULT NULL,
  `last_name` varchar(250) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `guild` varchar(100) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT NULL,
  `salt` varchar(100) DEFAULT NULL,
  `hash` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  `forget` varchar(250) DEFAULT NULL,
  `invites` varchar(100) DEFAULT NULL,
  `post_count` int(10) DEFAULT '0',
  `signature` varchar(1000) DEFAULT NULL,
  `website` varchar(500) DEFAULT NULL,
  `location` varchar(250) DEFAULT NULL,
  `occupation` varchar(250) DEFAULT NULL,
  `hobbies` varchar(1000) DEFAULT NULL,
  `bio` varchar(50000) DEFAULT NULL,
  `avatar` varchar(500) DEFAULT NULL,
  `friends` blob
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=141 ;

--
-- Dumping data for table `ezlusers`
--

INSERT INTO `ezlusers` (`id`, `username`, `first_name`, `last_name`, `email`, `guild`, `role`, `created`, `modified`, `salt`, `hash`, `status`, `forget`, `invites`, `post_count`, `signature`, `website`, `location`, `occupation`, `hobbies`, `bio`, `avatar`, `friends`) VALUES
(1, 'admin', 'Head', 'Admin', 'ezleague@mdloring.com', '8', 'admin', '2014-09-01 22:27:00', NULL, '$2a$05$Bs3HEiQG6G9PZHkY.Ay3Cg==', '$2a$05$Bs3HEiQG6G9PZHkY.Ay3CeE1lBUiLRSiRSl57pmRs61C8GWsKAt6G', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'testing', 'Margie', 'Hurley', 'MargieAHurley@gustr.com', '1', 'user', '2014-09-02 23:25:03', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'stoop', 'Miguel', 'Garr', 'MiguelKGarr@armyspy.com', '8', 'admin', '2013-03-31 09:06:04', NULL, '', '', 0, '', '16,11', 3, '&lt;p&gt;developer of &lt;em&gt;ezLeague&lt;/em&gt;&lt;/p&gt;\n&lt;strong&gt;Maker of awesome!&lt;/strong&gt;\n', 'http://www.mdloring.com', 'Chicago, IL', 'Web Developer', 'Chicago Sports & My Beagle named Bagels', 'Creator & Developer of ezLeague', '1407294526-me.jpg', 0x5b223131222c223137222c223133222c223135225d),
(11, 'fierce', 'Nellie', 'Love', 'NellieFLove@armyspy.com', '9', 'user', '2013-03-31 12:32:34', NULL, '', '', 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'Venice', 'Delbert', 'Winger', 'DelbertCWinger@fleckens.hu', '8', 'user', '2013-03-31 12:38:26', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'Seraphim', 'Kyla', 'Robbins', 'KylaWRobbins@dayrep.com', '8', 'user', '2013-04-01 03:33:09', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'TonyS', 'Charlie', 'Hatcher', 'CharlieCHatcher@einrot.com', '9', 'user', '2013-04-01 08:51:08', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'Froggy', 'Norberto', 'Williams', 'NorbertoBWilliams@gustr.com', '8', 'user', '2013-04-01 13:20:42', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Mita', 'Amy', 'Adkins', 'AmyPAdkins@teleworm.us', '13', 'user', '2013-04-01 20:05:41', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'PLShady', 'Anne', 'McCann', 'AnneRMcCann@fleckens.hu', '14', 'user', '2013-04-02 12:11:39', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'DeathRogue', 'Josephine', 'Whaley', 'JosephineRWhaley@fleckens.hu', '9', 'user', '2013-04-02 14:12:10', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'destroyer', 'Thomas', 'Austin', 'ThomasKAustin@jourrapide.com', '11', 'user', '2013-04-02 15:30:27', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'slamkino', 'Janet', 'Aguilar', 'JanetFAguilar@cuvox.de', '11', 'user', '2013-04-02 15:38:57', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'Trickster', 'Amanda', 'Moore', 'AmandaLMoore@jourrapide.com', '11', 'user', '2013-04-02 15:44:14', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'iii', 'Melissa', 'Allen', 'MelissaJAllen@armyspy.com', '11', 'user', '2013-04-02 21:11:33', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'Cigs', 'Larry', 'Cotton', 'LarryLCotton@superrito.com', '14', 'user', '2013-04-03 04:39:20', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'ayo', 'Robert', 'Osborn', 'RobertPOsborn@superrito.com', '13', 'user', '2013-04-03 14:32:52', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'Rival', 'Nancy', 'Seman', 'NancyHSeman@jourrapide.com', '13', 'user', '2013-04-03 16:09:45', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'Active', 'John', 'Moretz', 'JohnAMoretz@armyspy.com', '11', 'user', '2013-04-03 16:32:54', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 'Kizaru', 'Dorthy', 'Womack', 'DorthyAWomack@fleckens.hu', '13', 'user', '2013-04-03 17:23:39', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 'Cooly', 'Eddie', 'Patchen', 'EddieMPatchen@fleckens.hu', '9', 'user', '2013-04-04 01:46:02', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 'Schizo', 'Michelle', 'Baker', 'MichelleRBaker@teleworm.us', '13', 'user', '2013-04-04 03:05:17', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 'Alexus', 'Claudette', 'Fortson', 'ClaudetteJFortson@cuvox.de', '9', 'user', '2013-04-04 08:11:29', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 'kurupt', 'Luis', 'Beeson', 'LuisPBeeson@armyspy.com', '9', 'user', '2013-04-04 14:45:42', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'Pug_BC', 'Gregory', 'Lovern', 'GregorySLovern@cuvox.de', '9', 'user', '2013-04-04 16:02:16', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 'Salyasin', 'Rachel', 'Haven', 'RachelTHaven@dayrep.com', '8', 'user', '2013-04-04 17:38:22', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 'prayer', 'Duncan', 'Crawford', 'DuncanACrawford@fleckens.hu', '13', 'user', '2013-04-04 22:02:06', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 'Danimal', 'Major', 'Bentley', 'MajorVBentley@gustr.com', '16', 'user', '2013-04-05 03:24:23', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 'h20sbr', 'Sam', 'Zackery', 'SamCZackery@gustr.com', NULL, 'user', '2013-04-05 04:06:57', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 'ChillZ_SBR', 'Anthony', 'Ransom', 'AnthonyRRansom@einrot.com', NULL, 'user', '2013-04-05 16:25:11', NULL, '', '', 0, NULL, '8', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 'Jaguar', 'Annette', 'Delaune', 'AnnetteLDelaune@einrot.com', '11', 'user', '2013-04-05 21:02:55', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 'PhiL', 'Jon', 'Anderson', 'JonVAnderson@gustr.com', NULL, 'user', '2013-04-06 16:23:33', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 'Deidara', 'Nancy', 'Nedd', 'NancyRNedd@armyspy.com', NULL, 'user', '2013-04-06 17:26:13', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 'Gdog7280', 'Sandra', 'Kepley', 'SandraTKepley@teleworm.us', '8', 'user', '2013-04-06 23:51:45', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 'Bizzebomb', 'James', 'Sirianni', 'JamesNSirianni@gustr.com', '8', 'user', '2013-04-07 04:16:41', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 'Rock', 'John', 'Marshall', 'JohnRMarshall@rhyta.com', '13', 'user', '2013-04-08 00:09:39', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 'Cawshun', 'Paul', 'Cox', 'PaulKCox@teleworm.us', '8', 'user', '2013-04-08 02:10:09', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 'Degas', 'William', 'Wade', 'WilliamAWade@superrito.com', '13', 'user', '2013-04-09 15:33:52', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 'Degas1', 'Richard', 'Begay', 'RichardFBegay@fleckens.hu', '13', 'user', '2013-04-09 15:38:17', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 'Sorrow', 'Tina', 'Stevens', 'TinaTStevens@teleworm.us', '9', 'user', '2013-04-09 17:46:12', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 'Gizhaan', 'Gail', 'Waller', 'GailAWaller@armyspy.com', NULL, 'user', '2013-04-12 18:56:00', NULL, '', '', 0, NULL, ',25,25', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 'wangum', 'Jennifer', 'Turner', 'JenniferATurner@rhyta.com', '11', 'user', '2013-04-12 22:34:46', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 'Limitless', 'Howard', 'Neal', 'HowardDNeal@cuvox.de', '11', 'user', '2013-04-13 08:33:14', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 'Bonkers', 'Susan', 'Wheeler', 'SusanRWheeler@armyspy.com', '11', 'user', '2013-04-13 22:15:42', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 'Myst=oB', 'Sandra', 'Alvarez', 'SandraJAlvarez@jourrapide.com', '', 'user', '2013-04-14 20:31:40', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(54, 'PL_Healy', 'Victor', 'Cooper', 'VictorLCooper@superrito.com', '14', 'user', '2013-04-15 19:44:02', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 'PL_MAJIKAL', 'George', 'Sam', 'GeorgeLSam@jourrapide.com', '14', 'user', '2013-04-15 23:36:07', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 'PL_Coronus', 'Patricia', 'Becker', 'PatriciaFBecker@cuvox.de', '14', 'user', '2013-04-16 01:04:27', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 'NoMercy', 'Virginia', 'Lopes', 'VirginiaALopes@einrot.com', '11', 'user', '2013-04-16 18:48:27', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58, 'PL_Daisy', 'Craig', 'Bowen', 'CraigTBowen@dayrep.com', '14', 'user', '2013-04-17 00:57:42', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59, 'PLScoobs', 'Sandra', 'Waters', 'SandraRWaters@cuvox.de', '14', 'user', '2013-04-17 19:10:53', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60, 'pl_fork', 'Phil', 'Heath', 'PhilAHeath@jourrapide.com', '14', 'user', '2013-04-18 17:12:03', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(61, 'mat_bc', 'Connie', 'Moore', 'ConnieWMoore@armyspy.com', '9', 'user', '2013-04-20 01:32:45', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, 'PL-BioDoom', 'Thomas', 'Williams', 'ThomasJWilliams@cuvox.de', '14', 'user', '2013-04-20 04:57:06', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(67, 'Finesse', 'Carol', 'Lattimore', 'CarolMLattimore@rhyta.com', '', 'user', '2013-04-21 20:33:01', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(68, 'PLRyan', 'Barbara', 'Evans', 'BarbaraJEvans@cuvox.de', '14', 'user', '2013-04-21 20:36:42', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(71, 'Draven', 'Minnie', 'Fisher', 'MinnieCFisher@rhyta.com', '16', 'user', '2013-05-16 21:41:25', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(72, 'mustang', 'Mark', 'Whipple', 'MarkAWhipple@superrito.com', NULL, 'user', '2013-05-16 23:30:58', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(73, 'Mustang_SBR', 'Keith', 'Wenger', 'KeithCWenger@einrot.com', '16', 'user', '2013-05-16 23:32:53', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(74, 'plumberoB', 'Edison', 'Johnson', 'EdisonRJohnson@cuvox.de', '8', 'user', '2013-05-17 04:42:27', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(75, 'Rayz_oB', 'Alden', 'Richards', 'AldenTRichards@einrot.com', '8', 'user', '2013-05-17 04:44:31', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(76, 'Medic-SBR', 'Daniel', 'Trevino', 'DanielGTrevino@teleworm.us', '16', 'user', '2013-05-17 13:34:45', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(77, 'wishbone', 'Christine', 'Smalley', 'ChristineLSmalley@jourrapide.com', '', 'user', '2013-05-18 22:25:14', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 'Chron', 'Aurelia', 'McHugh', 'AureliaWMcHugh@einrot.com', '16', 'user', '2013-05-19 22:46:34', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 'Kevorkian', 'Elizabeth', 'Henderson', 'ElizabethLHenderson@dayrep.com', '8', 'user', '2013-05-22 21:36:59', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(82, 'nastynate', 'Mary', 'Bailey', 'MaryPBailey@superrito.com', '8', 'user', '2013-05-26 19:30:54', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(83, 'TnT_oB', 'Emily', 'Ogden', 'EmilyCOgden@gustr.com', '8', 'user', '2013-05-26 21:33:27', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(84, 'Yacobie', 'Michael', 'Hale', 'MichaelDHale@rhyta.com', '', 'user', '2013-05-28 03:04:01', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(85, 'Hades', 'Jeannette', 'Bowman', 'JeannetteEBowman@dayrep.com', '14', 'user', '2013-05-28 15:49:20', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(86, 'Hukal', 'John', 'Gonzalez', 'JohnVGonzalez@rhyta.com', NULL, 'user', '2013-05-28 20:48:25', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(87, 'whoshotme', 'Erica', 'Mosley', 'EricaJMosley@jourrapide.com', '8', 'user', '2013-06-15 06:32:07', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(88, 'Fear', 'Adam', 'Maldonado', 'AdamGMaldonado@rhyta.com', NULL, 'user', '2013-06-26 22:16:08', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(92, 'testuser', 'Javier', 'Elgin', 'JavierYElgin@rhyta.com', '', 'user', '2014-03-23 03:52:23', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(97, 'stoopkid', 'James', 'Leblanc', 'JamesILeblanc@rhyta.com', '18', 'user', '2014-03-24 04:07:23', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(98, 'stoop1', 'Jack', 'Tucker', 'JackMTucker@gustr.com', NULL, 'user', '2014-04-05 21:41:22', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(99, 'RampantRastro', 'Sandy', 'Mercurio', 'SandyMMercurio@einrot.com', '20', 'user', '2014-04-05 21:56:58', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(100, 'Negley97', 'Carrie', 'Ratliff', 'CarrieMRatliff@gustr.com', '21', 'user', '2014-04-06 02:21:05', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(101, 'AbSCS', 'George', 'Gallegos', 'GeorgeAGallegos@dayrep.com', '22', 'user', '2014-04-06 06:58:01', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(102, 'jeremyteo', 'James', 'Alexander', 'JamesAAlexander@superrito.com', '23', 'user', '2014-04-06 11:53:37', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(103, 'Bucky33', 'Joann', 'Mendoza', 'JoannTMendoza@teleworm.us', '24', 'user', '2014-04-06 22:23:29', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(104, 'stooptest', 'Amanda', 'Pfeiffer', 'AmandaCPfeiffer@gustr.com', '', 'user', '2014-04-15 03:06:21', NULL, '', '', 0, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(105, 'stooptest1', 'Charlene', 'Garcia', 'CharleneFGarcia@fleckens.hu', NULL, 'user', '2014-04-15 03:07:40', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(106, 'Theopt', 'Sean', 'Winfield', 'SeanTWinfield@rhyta.com', NULL, 'user', '2014-04-15 15:22:45', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(107, 'testing', 'Phyllis', 'Smith', 'PhyllisCSmith@einrot.com', NULL, 'user', '2014-04-16 00:48:19', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(108, 'testagain', 'Ashley', 'Burleson', 'AshleyDBurleson@superrito.com', NULL, 'user', '2014-04-16 01:47:14', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(109, 'stoop12', 'Beverly', 'Peters', 'BeverlyRPeters@dayrep.com', NULL, 'user', '2014-04-16 02:58:39', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(110, 'abs', 'Larry', 'Clark', 'LarrySClark@rhyta.com', '30', 'user', '2014-04-17 08:21:59', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(111, 'test5', 'Sally', 'Lucia', 'SallyJLucia@jourrapide.com', NULL, 'user', '2014-04-18 05:02:05', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(122, 'xYundy', 'Carol', 'Chivers', 'CarolHChivers@teleworm.us', '26', 'user', '2014-04-29 14:08:21', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(123, 'abcd', 'Sherri', 'Buss', 'SherriCBuss@superrito.com', '27', 'user', '2014-04-29 20:25:06', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(124, 'dadada', 'Craig', 'Hambright', 'CraigDHambright@rhyta.com', NULL, 'user', '2014-05-04 18:54:55', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(126, 'shuy3n', 'Brian', 'Hackworth', 'BrianSHackworth@armyspy.com', '28', 'user', '2014-05-07 22:20:54', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(127, 'Aleks', 'William', 'Black', 'WilliamEBlack@rhyta.com', '29', 'user', '2014-05-08 20:01:05', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(128, 'stooper', 'Timothy', 'Grigg', 'TimothyPGrigg@einrot.com', '31', 'user', '2014-05-18 22:23:23', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(129, 'stooper1', 'Ronald', 'Staub', 'RonaldIStaub@teleworm.us', '18', 'user', '2014-05-18 22:28:06', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(134, 'stoop1234', NULL, NULL, 'stooper@gmail.com', '44', 'user', '2014-08-03 03:54:05', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(137, 'tester1', 'Stephen', 'Frey', 'StephenVFrey@teleworm.us', '45', 'user', '2014-09-01 11:17:22', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(138, 'tester', 'William', 'Iverson', 'WilliamSIverson@jourrapide.com', '46', 'user', '2014-09-01 16:43:28', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0x5b5d),
(139, 'stoopster', 'Brittany', 'Rudd', 'BrittanyLRudd@fleckens.hu', NULL, 'user', '2014-09-18 03:03:28', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(140, 'stooper22', 'Barbara', 'Avila', 'BarbaraRAvila@superrito.com', NULL, 'user', '2015-01-14 03:46:16', NULL, '', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ezlusers`
--
ALTER TABLE `ezlusers`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ezlusers`
--
ALTER TABLE `ezlusers`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=141;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
