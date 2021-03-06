DROP TABLE IF EXISTS `#__oer_languages`;
DROP TABLE IF EXISTS `#__oer_licenses`;


--
-- Table structure for table `jos_oer_oers`
--

CREATE TABLE IF NOT EXISTS `jos_oer_oers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `filedata` varchar(255) NOT NULL,
  `oertype` varchar(255) NOT NULL,
  `programtag` varchar(255) NOT NULL,
  `projecttag` varchar(255) NOT NULL,
  `authors` varchar(255) NOT NULL,
  `licence` varchar(255) NOT NULL,
  `agree` tinyint(1) NOT NULL,
  `group` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;


ALTER TABLE `jos_oer_oers` CHANGE `publish` `published` tinyint(1) ;


--
-- Table structure for table `jos_oer_licenses`
--

CREATE TABLE IF NOT EXISTS `jos_oer_licenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `jos_oer_licenses`
--

INSERT INTO `jos_oer_licenses` (`id`, `name`, `description`, `url`) VALUES
(1, '- Please select a licence -', 'Please select a licence', 'http://creativecommons.org/licenses/'),
(2, 'Attribution', 'This license lets others distribute, remix, tweak, and build upon your work, even commercially, as long as they credit you for the original creation. This is the most accommodating of licenses offered. Recommended for maximum dissemination and use of licensed materials.', 'http://creativecommons.org/licenses/'),
(3, 'Attribution-ShareAlike ', 'This license lets others remix, tweak, and build upon your work even for commercial purposes, as long as they credit you and license their new creations under the identical terms. This license is often compared to "copyleft" free and open source software licenses. All new works based on yours will carry the same license, so any derivatives will also allow commercial use. This is the license used by Wikipedia, and is recommended for materials that would benefit from incorporating content from Wikipedia and similarly licensed projects.', 'http://creativecommons.org/licenses/'),
(4, 'Attribution-NoDerivs', 'This license allows for redistribution, commercial and non-commercial, as long as it is passed along unchanged and in whole, with credit to you.', 'http://creativecommons.org/licenses/'),
(5, 'Attribution-NonCommercial ', 'This license lets others remix, tweak, and build upon your work non-commercially, and although their new works must also acknowledge you and be non-commercial, they do not have to license their derivative works on the same terms.', 'http://creativecommons.org/licenses/'),
(6, 'Attribution-NonCommercial-ShareAlike', 'This license lets others remix, tweak, and build upon your work non-commercially, as long as they credit you and license their new creations under the identical terms.', 'http://creativecommons.org/licenses/'),
(7, 'Attribution-NonCommercial-NoDerivs ', 'This license is the most restrictive of our six main licenses, only allowing others to download your works and share them with others as long as they credit you, but they cannot change them in any way or use them commercially.', 'http://creativecommons.org/licenses/');


--
-- Table structure for table `jos_oer_languages`
--

CREATE TABLE IF NOT EXISTS `jos_oer_languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=164 ;

--
-- Dumping data for table `jos_oer_languages`
--

INSERT INTO `jos_oer_languages` (`id`, `text`) VALUES
(1, 'Abkhazian'),
(2, 'Afar'),
(3, 'Afrikaans'),
(4, 'Albanian'),
(5, 'Amharic'),
(6, 'Arabic'),
(7, 'Aragonese'),
(8, 'Armenian'),
(9, 'Assamese'),
(10, 'Aymara'),
(11, 'Azerbaijani'),
(12, 'Bashkir'),
(13, 'Basque'),
(14, 'Bengali (Bangla)'),
(15, 'Bhutani'),
(16, 'Bihari'),
(17, 'Bislama'),
(18, 'Breton'),
(19, 'Bulgarian'),
(20, 'Burmese'),
(21, 'Byelorussian (Belarusian)'),
(22, 'Cambodian'),
(23, 'Catalan'),
(24, 'Cherokee'),
(25, 'Chewa'),
(26, 'Chinese (Simplified)'),
(27, 'Chinese (Traditional)'),
(28, 'Corsican'),
(29, 'Croatian'),
(30, 'Czech'),
(31, 'Danish'),
(32, 'Divehi'),
(33, 'Dutch'),
(34, 'Edo'),
(35, 'English'),
(36, 'Esperanto'),
(37, 'Estonian'),
(38, 'Faeroese'),
(39, 'Farsi'),
(40, 'Fiji'),
(41, 'Finnish'),
(42, 'Flemish'),
(43, 'French'),
(44, 'Frisian'),
(45, 'Fulfulde'),
(46, 'Galician'),
(47, 'Gaelic (Scottish)'),
(48, 'Gaelic (Manx)'),
(49, 'Georgian'),
(50, 'German'),
(51, 'Greek'),
(52, 'Greenlandic'),
(53, 'Guarani'),
(54, 'Gujarati'),
(55, 'Haitian Creole'),
(56, 'Hausa'),
(57, 'Hawaiian'),
(58, 'Hebrew'),
(59, 'Hindi'),
(60, 'Hungarian'),
(61, 'Ibibio'),
(62, 'Icelandic'),
(63, 'Ido'),
(64, 'Igbo'),
(65, 'Indonesian'),
(66, 'Interlingua'),
(67, 'Interlingue'),
(68, 'Inuktitut'),
(69, 'Inupiak'),
(70, 'Irish'),
(71, 'Italian'),
(72, 'Japanese'),
(73, 'Javanese'),
(74, 'Kannada'),
(75, 'Kanuri'),
(76, 'Kashmiri'),
(77, 'Kazakh'),
(78, 'Kinyarwanda (Ruanda)'),
(79, 'Kirghiz'),
(80, 'Kirundi (Rundi)'),
(81, 'Konkani'),
(82, 'Korean'),
(83, 'Kurdish'),
(84, 'Laothian'),
(85, 'Latin'),
(86, 'Latvian (Lettish)'),
(87, 'Limburgish ( Limburger)'),
(88, 'Lingala'),
(89, 'Lithuanian'),
(90, 'Macedonian'),
(91, 'Malagasy'),
(92, 'Malay'),
(93, 'Malayalam'),
(94, 'Maltese'),
(95, 'Maori'),
(96, 'Marathi'),
(97, 'Moldavian'),
(98, 'Mongolian'),
(99, 'Nauru'),
(100, 'Nepali'),
(101, 'Norwegian'),
(102, 'Occitan'),
(103, 'Oriya'),
(104, 'Oromo (Afaan Oromo)'),
(105, 'Papiamentu'),
(106, 'Pashto (Pushto)'),
(107, 'Polish'),
(108, 'Portuguese'),
(109, 'Punjabi'),
(110, 'Quechua'),
(111, 'Rhaeto-Romance'),
(112, 'Romanian'),
(113, 'Russian'),
(114, 'Sami (Lappish)'),
(115, 'Samoan'),
(116, 'Sangro'),
(117, 'Sanskrit'),
(118, 'Serbian'),
(119, 'Serbo-Croatian'),
(120, 'Sesotho'),
(121, 'Setswana'),
(122, 'Shona'),
(123, 'Sichuan Yi'),
(124, 'Sindhi'),
(125, 'Sinhalese'),
(126, 'Siswati'),
(127, 'Slovak'),
(128, 'Slovenian'),
(129, 'Somali'),
(130, 'Spanish'),
(131, 'Sundanese'),
(132, 'Swahili (Kiswahili)'),
(133, 'Swedish'),
(134, 'Syriac'),
(135, 'Tagalog'),
(136, 'Tajik'),
(137, 'Tamazight'),
(138, 'Tamil'),
(139, 'Tatar'),
(140, 'Telugu'),
(141, 'Thai'),
(142, 'Tibetan'),
(143, 'Tigrinya'),
(144, 'Tonga'),
(145, 'Tsonga'),
(146, 'Turkish'),
(147, 'Turkmen'),
(148, 'Twi'),
(149, 'Uighur'),
(150, 'Ukrainian'),
(151, 'Urdu'),
(152, 'Uzbek'),
(153, 'Venda'),
(154, 'Vietnamese'),
(155, 'Volap'),
(156, 'Wallon'),
(157, 'Welsh'),
(158, 'Wolof'),
(159, 'Xhosa'),
(160, 'Yi'),
(161, 'Yiddish'),
(162, 'Yoruba'),
(163, 'Zulu');

