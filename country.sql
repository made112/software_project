/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : software

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2022-02-19 22:44:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for country
-- ----------------------------
DROP TABLE IF EXISTS `country`;
CREATE TABLE `country` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `flag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=233 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of country
-- ----------------------------
INSERT INTO `country` VALUES ('1', 'فلسطين', 'Palestinian Territory', '972', 'PS', null, null, '1');
INSERT INTO `country` VALUES ('2', 'زمبابوي', 'Zimbabwe', '263', 'ZW', null, null, '1');
INSERT INTO `country` VALUES ('3', 'زامبيا', 'Zambia', '260', 'ZM', null, null, '1');
INSERT INTO `country` VALUES ('4', 'جنوب أفريقيا', 'South africa', '27', 'ZA', null, null, '1');
INSERT INTO `country` VALUES ('5', 'مايوت', 'Mayotte', '262', 'YT', null, null, '1');
INSERT INTO `country` VALUES ('6', 'اليمن', 'Yemen', '967', 'YE', null, null, '1');
INSERT INTO `country` VALUES ('7', '', 'Kosovo', '381', 'XK', null, null, '1');
INSERT INTO `country` VALUES ('8', 'ساموا', 'Samoa', '685', 'WS', null, null, '1');
INSERT INTO `country` VALUES ('9', 'والس وفوتونا', 'Wallis and futuna', '681', 'WF', null, null, '1');
INSERT INTO `country` VALUES ('10', 'فانواتو', 'Vanuatu', '678', 'VU', null, null, '1');
INSERT INTO `country` VALUES ('11', 'فيتنام', 'Viet nam', '84', 'VN', null, null, '1');
INSERT INTO `country` VALUES ('12', '', 'Virgin islands, u.s.', '1340', 'VI', null, null, '1');
INSERT INTO `country` VALUES ('13', '', 'Virgin islands, british', '1284', 'VG', null, null, '1');
INSERT INTO `country` VALUES ('14', 'فنزويلا', 'Venezuela', '58', 'VE', null, null, '1');
INSERT INTO `country` VALUES ('15', 'سانت فنسنت وجزر غرينادين', 'Saint vincent and the grenadines', '1784', 'VC', null, null, '1');
INSERT INTO `country` VALUES ('16', 'دولة مدينة الفاتيكان', 'Holy see (vatican city state)', '39', 'VA', null, null, '1');
INSERT INTO `country` VALUES ('17', 'أوزباكستان', 'Uzbekistan', '998', 'UZ', null, null, '1');
INSERT INTO `country` VALUES ('18', 'أورغواي', 'Uruguay', '598', 'UY', null, null, '1');
INSERT INTO `country` VALUES ('19', 'الولايات المتحدة', 'United states', '1', 'US', null, null, '1');
INSERT INTO `country` VALUES ('20', 'أوغندا', 'Uganda', '256', 'UG', null, null, '1');
INSERT INTO `country` VALUES ('21', 'أوكرانيا', 'Ukraine', '380', 'UA', null, null, '1');
INSERT INTO `country` VALUES ('22', 'تنزانيا', 'Tanzania, united republic of', '255', 'TZ', null, null, '1');
INSERT INTO `country` VALUES ('23', 'تايوان', 'Taiwan, province of china', '886', 'TW', null, null, '1');
INSERT INTO `country` VALUES ('24', 'توفالو', 'Tuvalu', '688', 'TV', null, null, '1');
INSERT INTO `country` VALUES ('25', 'ترينيداد وتوباغو', 'Trinidad and tobago', '1868', 'TT', null, null, '1');
INSERT INTO `country` VALUES ('26', 'تركيا', 'Turkey', '90', 'TR', null, null, '1');
INSERT INTO `country` VALUES ('27', 'تونغا', 'Tonga', '676', 'TO', null, null, '1');
INSERT INTO `country` VALUES ('28', 'تونس', 'Tunisia', '216', 'TN', null, null, '1');
INSERT INTO `country` VALUES ('29', 'تركمانستان', 'Turkmenistan', '993', 'TM', null, null, '1');
INSERT INTO `country` VALUES ('30', 'تيمور الشرقية', 'Timor-leste', '670', 'TL', null, null, '1');
INSERT INTO `country` VALUES ('31', '', 'Tokelau', '690', 'TK', null, null, '1');
INSERT INTO `country` VALUES ('32', 'طاجيكستان', 'Tajikistan', '992', 'TJ', null, null, '1');
INSERT INTO `country` VALUES ('33', 'تايلندا', 'Thailand', '66', 'TH', null, null, '1');
INSERT INTO `country` VALUES ('34', 'توغو', 'Togo', '228', 'TG', null, null, '1');
INSERT INTO `country` VALUES ('35', 'تشاد', 'Chad', '235', 'TD', null, null, '1');
INSERT INTO `country` VALUES ('36', '', 'Turks and caicos islands', '1649', 'TC', null, null, '1');
INSERT INTO `country` VALUES ('37', 'سوازيلند', 'Swaziland', '268', 'SZ', null, null, '1');
INSERT INTO `country` VALUES ('38', 'سوريا', 'Syrian arab republic', '963', 'SY', null, null, '1');
INSERT INTO `country` VALUES ('39', 'إلسلفادور', 'El salvador', '503', 'SV', null, null, '1');
INSERT INTO `country` VALUES ('40', 'ساو تومي وبرينسيبي', 'Sao tome and principe', '239', 'ST', null, null, '1');
INSERT INTO `country` VALUES ('41', 'سورينام', 'Suriname', '597', 'SR', null, null, '1');
INSERT INTO `country` VALUES ('42', 'الصومال', 'Somalia', '252', 'SO', null, null, '1');
INSERT INTO `country` VALUES ('43', 'السنغال', 'Senegal', '221', 'SN', null, null, '1');
INSERT INTO `country` VALUES ('44', 'سان مارينو', 'San marino', '378', 'SM', null, null, '1');
INSERT INTO `country` VALUES ('45', 'سيراليون', 'Sierra leone', '232', 'SL', null, null, '1');
INSERT INTO `country` VALUES ('46', 'سلوفاكيا', 'Slovakia', '421', 'SK', null, null, '1');
INSERT INTO `country` VALUES ('47', 'سلوفينيا', 'Slovenia', '386', 'SI', null, null, '1');
INSERT INTO `country` VALUES ('48', '', 'Saint helena', '290', 'SH', null, null, '1');
INSERT INTO `country` VALUES ('49', 'سنغافورة', 'Singapore', '65', 'SG', null, null, '1');
INSERT INTO `country` VALUES ('50', 'السويد', 'Sweden', '46', 'SE', null, null, '1');
INSERT INTO `country` VALUES ('51', 'السودان', 'Sudan', '249', 'SD', null, null, '1');
INSERT INTO `country` VALUES ('52', 'سيشيل', 'Seychelles', '248', 'SC', null, null, '1');
INSERT INTO `country` VALUES ('53', 'جزر سليمان', 'Solomon islands', '677', 'SB', null, null, '1');
INSERT INTO `country` VALUES ('54', 'رواندا', 'Rwanda', '250', 'RW', null, null, '1');
INSERT INTO `country` VALUES ('55', 'روسيا', 'Russian federation', '7', 'RU', null, null, '1');
INSERT INTO `country` VALUES ('56', 'جمهورية صربيا', 'Serbia', '381', 'RS', null, null, '1');
INSERT INTO `country` VALUES ('57', 'رومانيا', 'Romania', '40', 'RO', null, null, '1');
INSERT INTO `country` VALUES ('58', 'قطر', 'Qatar', '974', 'QA', null, null, '1');
INSERT INTO `country` VALUES ('59', 'باراغواي', 'Paraguay', '595', 'PY', null, null, '1');
INSERT INTO `country` VALUES ('60', 'بالاو', 'Palau', '680', 'PW', null, null, '1');
INSERT INTO `country` VALUES ('61', 'البرتغال', 'Portugal', '351', 'PT', null, null, '1');
INSERT INTO `country` VALUES ('62', 'بورتوريكو', 'Puerto rico', '1', 'PR', null, null, '1');
INSERT INTO `country` VALUES ('63', '', 'Pitcairn', '870', 'PN', null, null, '1');
INSERT INTO `country` VALUES ('64', '', 'Saint pierre and miquelon', '508', 'PM', null, null, '1');
INSERT INTO `country` VALUES ('65', 'بولندا', 'Poland', '48', 'PL', null, null, '1');
INSERT INTO `country` VALUES ('66', 'باكستان', 'Pakistan', '92', 'PK', null, null, '1');
INSERT INTO `country` VALUES ('67', 'الفليبين', 'Philippines', '63', 'PH', null, null, '1');
INSERT INTO `country` VALUES ('68', 'بابوا غينيا الجديدة', 'Papua new guinea', '675', 'PG', null, null, '1');
INSERT INTO `country` VALUES ('69', 'بولينيزيا الفرنسية', 'French polynesia', '689', 'PF', null, null, '1');
INSERT INTO `country` VALUES ('70', 'بيرو', 'Peru', '51', 'PE', null, null, '1');
INSERT INTO `country` VALUES ('71', 'بنما', 'Panama', '507', 'PA', null, null, '1');
INSERT INTO `country` VALUES ('72', 'عُمان', 'Oman', '968', 'OM', null, null, '1');
INSERT INTO `country` VALUES ('73', 'نيوزيلندا', 'New zealand', '64', 'NZ', null, null, '1');
INSERT INTO `country` VALUES ('74', 'نييوي', 'Niue', '683', 'NU', null, null, '1');
INSERT INTO `country` VALUES ('75', 'ناورو', 'Nauru', '674', 'NR', null, null, '1');
INSERT INTO `country` VALUES ('76', 'نيبال', 'Nepal', '977', 'NP', null, null, '1');
INSERT INTO `country` VALUES ('77', 'النرويج', 'Norway', '47', 'NO', null, null, '1');
INSERT INTO `country` VALUES ('78', 'هولندا', 'Netherlands', '31', 'NL', null, null, '1');
INSERT INTO `country` VALUES ('79', 'نيكاراجوا', 'Nicaragua', '505', 'NI', null, null, '1');
INSERT INTO `country` VALUES ('80', 'نيجيريا', 'Nigeria', '234', 'NG', null, null, '1');
INSERT INTO `country` VALUES ('81', 'النيجر', 'Niger', '227', 'NE', null, null, '1');
INSERT INTO `country` VALUES ('82', 'كاليدونيا الجديدة', 'New caledonia', '687', 'NC', null, null, '1');
INSERT INTO `country` VALUES ('83', 'ناميبيا', 'Namibia', '264', 'NA', null, null, '1');
INSERT INTO `country` VALUES ('84', 'موزمبيق', 'Mozambique', '258', 'MZ', null, null, '1');
INSERT INTO `country` VALUES ('85', 'ماليزيا', 'Malaysia', '60', 'MY', null, null, '1');
INSERT INTO `country` VALUES ('86', 'المكسيك', 'Mexico', '52', 'MX', null, null, '1');
INSERT INTO `country` VALUES ('87', 'مالاوي', 'Malawi', '265', 'MW', null, null, '1');
INSERT INTO `country` VALUES ('88', 'المالديف', 'Maldives', '960', 'MV', null, null, '1');
INSERT INTO `country` VALUES ('89', 'موريشيوس', 'Mauritius', '230', 'MU', null, null, '1');
INSERT INTO `country` VALUES ('90', 'مالطا', 'Malta', '356', 'MT', null, null, '1');
INSERT INTO `country` VALUES ('91', 'مونتسيرات', 'Montserrat', '1664', 'MS', null, null, '1');
INSERT INTO `country` VALUES ('92', 'موريتانيا', 'Mauritania', '222', 'MR', null, null, '1');
INSERT INTO `country` VALUES ('93', 'جزر ماريانا الشمالية', 'Northern mariana islands', '1670', 'MP', null, null, '1');
INSERT INTO `country` VALUES ('94', 'ماكاو', 'Macau', '853', 'MO', null, null, '1');
INSERT INTO `country` VALUES ('95', 'منغوليا', 'Mongolia', '976', 'MN', null, null, '1');
INSERT INTO `country` VALUES ('96', 'ميانمار', 'Myanmar', '95', 'MM', null, null, '1');
INSERT INTO `country` VALUES ('97', 'مالي', 'Mali', '223', 'ML', null, null, '1');
INSERT INTO `country` VALUES ('98', 'جمهورية مقدونيا', 'Macedonia, the former yugoslav republic of', '389', 'MK', null, null, '1');
INSERT INTO `country` VALUES ('99', 'جزر مارشال', 'Marshall islands', '692', 'MH', null, null, '1');
INSERT INTO `country` VALUES ('100', 'مدغشقر', 'Madagascar', '261', 'MG', null, null, '1');
INSERT INTO `country` VALUES ('101', '', 'Saint martin', '1599', 'MF', null, null, '1');
INSERT INTO `country` VALUES ('102', 'الجبل الأسود', 'Montenegro', '382', 'ME', null, null, '1');
INSERT INTO `country` VALUES ('103', 'مولدافيا', 'Moldova, republic of', '373', 'MD', null, null, '1');
INSERT INTO `country` VALUES ('104', 'موناكو', 'Monaco', '377', 'MC', null, null, '1');
INSERT INTO `country` VALUES ('105', 'المغرب', 'Morocco', '212', 'MA', null, null, '1');
INSERT INTO `country` VALUES ('106', 'ليبيا', 'Libyan arab jamahiriya', '218', 'LY', null, null, '1');
INSERT INTO `country` VALUES ('107', 'لاتفيا', 'Latvia', '371', 'LV', null, null, '1');
INSERT INTO `country` VALUES ('108', 'لوكسمبورغ', 'Luxembourg', '352', 'LU', null, null, '1');
INSERT INTO `country` VALUES ('109', 'لتوانيا', 'Lithuania', '370', 'LT', null, null, '1');
INSERT INTO `country` VALUES ('110', 'ليسوتو', 'Lesotho', '266', 'LS', null, null, '1');
INSERT INTO `country` VALUES ('111', 'ليبيريا', 'Liberia', '231', 'LR', null, null, '1');
INSERT INTO `country` VALUES ('112', 'سريلانكا', 'Sri lanka', '94', 'LK', null, null, '1');
INSERT INTO `country` VALUES ('113', 'ليختنشتين', 'Liechtenstein', '423', 'LI', null, null, '1');
INSERT INTO `country` VALUES ('114', 'سانت لوسيا', 'Saint lucia', '1758', 'LC', null, null, '1');
INSERT INTO `country` VALUES ('115', 'لبنان', 'Lebanon', '961', 'LB', null, null, '1');
INSERT INTO `country` VALUES ('116', 'لاوس', 'Lao peoples democratic republic', '856', 'LA', null, null, '1');
INSERT INTO `country` VALUES ('117', 'كازاخستان', 'Kazakstan', '7', 'KZ', null, null, '1');
INSERT INTO `country` VALUES ('118', '', 'Cayman islands', '1345', 'KY', null, null, '1');
INSERT INTO `country` VALUES ('119', 'الكويت', 'Kuwait', '965', 'KW', null, null, '1');
INSERT INTO `country` VALUES ('120', 'كوريا الجنوبية', 'Korea republic of', '82', 'KR', null, null, '1');
INSERT INTO `country` VALUES ('121', 'كوريا الشمالية', 'Korea democratic peoples republic of', '850', 'KP', null, null, '1');
INSERT INTO `country` VALUES ('122', 'سانت كيتس ونيفس', 'Saint kitts and nevis', '1869', 'KN', null, null, '1');
INSERT INTO `country` VALUES ('123', 'جزر القمر', 'Comoros', '269', 'KM', null, null, '1');
INSERT INTO `country` VALUES ('124', 'كيريباتي', 'Kiribati', '686', 'KI', null, null, '1');
INSERT INTO `country` VALUES ('125', 'كمبوديا', 'Cambodia', '855', 'KH', null, null, '1');
INSERT INTO `country` VALUES ('126', 'قيرغيزستان', 'Kyrgyzstan', '996', 'KG', null, null, '1');
INSERT INTO `country` VALUES ('127', 'كينيا', 'Kenya', '254', 'KE', null, null, '1');
INSERT INTO `country` VALUES ('128', 'اليابان', 'Japan', '81', 'JP', null, null, '1');
INSERT INTO `country` VALUES ('129', 'الأردن', 'Jordan', '962', 'JO', null, null, '1');
INSERT INTO `country` VALUES ('130', 'جمايكا', 'Jamaica', '1876', 'JM', null, null, '1');
INSERT INTO `country` VALUES ('131', 'إيطاليا', 'Italy', '39', 'IT', null, null, '1');
INSERT INTO `country` VALUES ('132', 'آيسلندا', 'Iceland', '354', 'IS', null, null, '1');
INSERT INTO `country` VALUES ('133', 'إيران', 'Iran, islamic republic of', '98', 'IR', null, null, '1');
INSERT INTO `country` VALUES ('134', 'العراق', 'Iraq', '964', 'IQ', null, null, '1');
INSERT INTO `country` VALUES ('135', 'الهند', 'India', '91', 'IN', null, null, '1');
INSERT INTO `country` VALUES ('136', '', 'Isle of man', '44', 'IM', null, null, '1');
INSERT INTO `country` VALUES ('137', 'إسرائيل', 'Israel', '972', 'IL', null, null, '1');
INSERT INTO `country` VALUES ('138', 'جمهورية أيرلندا', 'Ireland', '353', 'IE', null, null, '1');
INSERT INTO `country` VALUES ('139', 'أندونيسيا', 'Indonesia', '62', 'ID', null, null, '1');
INSERT INTO `country` VALUES ('140', 'المجر', 'Hungary', '36', 'HU', null, null, '1');
INSERT INTO `country` VALUES ('141', 'هايتي', 'Haiti', '509', 'HT', null, null, '1');
INSERT INTO `country` VALUES ('142', 'كرواتيا', 'Croatia', '385', 'HR', null, null, '1');
INSERT INTO `country` VALUES ('143', 'هندوراس', 'Honduras', '504', 'HN', null, null, '1');
INSERT INTO `country` VALUES ('144', 'هونغ كونغ', 'Hong kong', '852', 'HK', null, null, '1');
INSERT INTO `country` VALUES ('145', 'غيانا', 'Guyana', '592', 'GY', null, null, '1');
INSERT INTO `country` VALUES ('146', 'غينيا-بيساو', 'Guinea-bissau', '245', 'GW', null, null, '1');
INSERT INTO `country` VALUES ('147', 'جوام', 'Guam', '1671', 'GU', null, null, '1');
INSERT INTO `country` VALUES ('148', 'غواتيمال', 'Guatemala', '502', 'GT', null, null, '1');
INSERT INTO `country` VALUES ('149', 'اليونان', 'Greece', '30', 'GR', null, null, '1');
INSERT INTO `country` VALUES ('150', 'غينيا الاستوائي', 'Equatorial guinea', '240', 'GQ', null, null, '1');
INSERT INTO `country` VALUES ('151', 'غينيا', 'Guinea', '224', 'GN', null, null, '1');
INSERT INTO `country` VALUES ('152', 'غامبيا', 'Gambia', '220', 'GM', null, null, '1');
INSERT INTO `country` VALUES ('153', '', 'Greenland', '299', 'GL', null, null, '1');
INSERT INTO `country` VALUES ('154', '', 'Gibraltar', '350', 'GI', null, null, '1');
INSERT INTO `country` VALUES ('155', 'غانا', 'Ghana', '233', 'GH', null, null, '1');
INSERT INTO `country` VALUES ('156', 'جيورجيا', 'Georgia', '995', 'GE', null, null, '1');
INSERT INTO `country` VALUES ('157', 'غرينادا', 'Grenada', '1473', 'GD', null, null, '1');
INSERT INTO `country` VALUES ('158', 'المملكة المتحدة', 'United kingdom', '44', 'GB', null, null, '1');
INSERT INTO `country` VALUES ('159', 'الغابون', 'Gabon', '241', 'GA', null, null, '1');
INSERT INTO `country` VALUES ('160', 'فرنسا', 'France', '33', 'FR', null, null, '1');
INSERT INTO `country` VALUES ('161', 'جزر فارو', 'Faroe islands', '298', 'FO', null, null, '1');
INSERT INTO `country` VALUES ('162', 'ولايات ميكرونيسيا المتحدة', 'Micronesia, federated states of', '691', 'FM', null, null, '1');
INSERT INTO `country` VALUES ('163', 'جزر فوكلاند', 'Falkland islands (malvinas)', '500', 'FK', null, null, '1');
INSERT INTO `country` VALUES ('164', 'فيجي', 'Fiji', '679', 'FJ', null, null, '1');
INSERT INTO `country` VALUES ('165', 'فنلندا', 'Finland', '358', 'FI', null, null, '1');
INSERT INTO `country` VALUES ('166', 'أثيوبيا', 'Ethiopia', '251', 'ET', null, null, '1');
INSERT INTO `country` VALUES ('167', 'إسبانيا', 'Spain', '34', 'ES', null, null, '1');
INSERT INTO `country` VALUES ('168', 'إريتريا', 'Eritrea', '291', 'ER', null, null, '1');
INSERT INTO `country` VALUES ('169', 'مصر', 'Egypt', '20', 'EG', null, null, '1');
INSERT INTO `country` VALUES ('170', 'استونيا', 'Estonia', '372', 'EE', null, null, '1');
INSERT INTO `country` VALUES ('171', 'إكوادور', 'Ecuador', '593', 'EC', null, null, '1');
INSERT INTO `country` VALUES ('172', 'الجزائر', 'Algeria', '213', 'DZ', null, null, '1');
INSERT INTO `country` VALUES ('173', 'الجمهورية الدومينيكية', 'Dominican republic', '1809', 'DO', null, null, '1');
INSERT INTO `country` VALUES ('174', 'دومينيكا', 'Dominica', '1767', 'DM', null, null, '1');
INSERT INTO `country` VALUES ('175', 'الدانمارك', 'Denmark', '45', 'DK', null, null, '1');
INSERT INTO `country` VALUES ('176', 'جيبوتي', 'Djibouti', '253', 'DJ', null, null, '1');
INSERT INTO `country` VALUES ('177', 'ألمانيا', 'Germany', '49', 'DE', null, null, '1');
INSERT INTO `country` VALUES ('178', 'الجمهورية التشيكية', 'Czech republic', '420', 'CZ', null, null, '1');
INSERT INTO `country` VALUES ('179', 'قبرص', 'Cyprus', '357', 'CY', null, null, '1');
INSERT INTO `country` VALUES ('180', '', 'Christmas island', '61', 'CX', null, null, '1');
INSERT INTO `country` VALUES ('181', 'الرأس الأخضر', 'Cape verde', '238', 'CV', null, null, '1');
INSERT INTO `country` VALUES ('182', 'كوبا', 'Cuba', '53', 'CU', null, null, '1');
INSERT INTO `country` VALUES ('183', 'كوستاريكا', 'Costa rica', '506', 'CR', null, null, '1');
INSERT INTO `country` VALUES ('184', 'كولومبيا', 'Colombia', '57', 'CO', null, null, '1');
INSERT INTO `country` VALUES ('185', 'جمهورية الصين الشعبية', 'China', '86', 'CN', null, null, '1');
INSERT INTO `country` VALUES ('186', 'كاميرون', 'Cameroon', '237', 'CM', null, null, '1');
INSERT INTO `country` VALUES ('187', 'شيلي', 'Chile', '56', 'CL', null, null, '1');
INSERT INTO `country` VALUES ('188', 'جزر كوك', 'Cook islands', '682', 'CK', null, null, '1');
INSERT INTO `country` VALUES ('189', 'ساحل العاج', 'Cote d ivoire', '225', 'CI', null, null, '1');
INSERT INTO `country` VALUES ('190', 'سويسرا', 'Switzerland', '41', 'CH', null, null, '1');
INSERT INTO `country` VALUES ('191', 'جمهورية الكونغو الديمقراطية', 'Congo', '242', 'CG', null, null, '1');
INSERT INTO `country` VALUES ('192', 'جمهورية أفريقيا الوسطى', 'Central african republic', '236', 'CF', null, null, '1');
INSERT INTO `country` VALUES ('193', '', 'Congo, the democratic republic of the', '243', 'CD', null, null, '1');
INSERT INTO `country` VALUES ('194', '', 'Cocos (keeling) islands', '61', 'CC', null, null, '1');
INSERT INTO `country` VALUES ('195', 'كندا', 'Canada', '1', 'CA', null, null, '1');
INSERT INTO `country` VALUES ('196', 'بيليز', 'Belize', '501', 'BZ', null, null, '1');
INSERT INTO `country` VALUES ('197', 'روسيا البيضاء', 'Belarus', '375', 'BY', null, null, '1');
INSERT INTO `country` VALUES ('198', 'بوتسوانا', 'Botswana', '267', 'BW', null, null, '1');
INSERT INTO `country` VALUES ('199', 'بوتان', 'Bhutan', '975', 'BT', null, null, '1');
INSERT INTO `country` VALUES ('200', 'الباهاماس', 'Bahamas', '1242', 'BS', null, null, '1');
INSERT INTO `country` VALUES ('201', 'البرازيل', 'Brazil', '55', 'BR', null, null, '1');
INSERT INTO `country` VALUES ('202', 'بوليفيا', 'Bolivia', '591', 'BO', null, null, '1');
INSERT INTO `country` VALUES ('203', 'بروني', 'Brunei darussalam', '673', 'BN', null, null, '1');
INSERT INTO `country` VALUES ('204', 'جزر برمود', 'Bermuda', '1441', 'BM', null, null, '1');
INSERT INTO `country` VALUES ('205', '', 'Saint barthelemy', '590', 'BL', null, null, '1');
INSERT INTO `country` VALUES ('206', 'بنين', 'Benin', '229', 'BJ', null, null, '1');
INSERT INTO `country` VALUES ('207', 'بوروندي', 'Burundi', '257', 'BI', null, null, '1');
INSERT INTO `country` VALUES ('208', 'البحرين', 'Bahrain', '973', 'BH', null, null, '1');
INSERT INTO `country` VALUES ('209', 'بلغاريا', 'Bulgaria', '359', 'BG', null, null, '1');
INSERT INTO `country` VALUES ('210', 'بوركينا فاسو', 'Burkina faso', '226', 'BF', null, null, '1');
INSERT INTO `country` VALUES ('211', 'بلجيكا', 'Belgium', '32', 'BE', null, null, '1');
INSERT INTO `country` VALUES ('212', 'بنغلاديش', 'Bangladesh', '880', 'BD', null, null, '1');
INSERT INTO `country` VALUES ('213', 'بربادوس', 'Barbados', '1246', 'BB', null, null, '1');
INSERT INTO `country` VALUES ('214', 'البوسنة و الهرسك', 'Bosnia and herzegovina', '387', 'BA', null, null, '1');
INSERT INTO `country` VALUES ('215', 'أذربيجان', 'Azerbaijan', '994', 'AZ', null, null, '1');
INSERT INTO `country` VALUES ('216', 'أروبا', 'Aruba', '297', 'AW', null, null, '1');
INSERT INTO `country` VALUES ('217', 'أستراليا', 'Australia', '61', 'AU', null, null, '1');
INSERT INTO `country` VALUES ('218', 'النمسا', 'Austria', '43', 'AT', null, null, '1');
INSERT INTO `country` VALUES ('219', '', 'American samoa', '1684', 'AS', null, null, '1');
INSERT INTO `country` VALUES ('220', 'الأرجنتين', 'Argentina', '54', 'AR', null, null, '1');
INSERT INTO `country` VALUES ('221', '', 'Antarctica', '672', 'AQ', null, null, '1');
INSERT INTO `country` VALUES ('222', 'أنغولا', 'Angola', '244', 'AO', null, null, '1');
INSERT INTO `country` VALUES ('223', 'جزر الأنتيل الهولندي', 'Netherlands antilles', '599', 'AN', null, null, '1');
INSERT INTO `country` VALUES ('224', 'أرمينيا', 'Armenia', '374', 'AM', null, null, '1');
INSERT INTO `country` VALUES ('225', 'ألبانيا', 'Albania', '355', 'AL', null, null, '1');
INSERT INTO `country` VALUES ('226', 'أنغويلا', 'Anguilla', '1264', 'AI', null, null, '1');
INSERT INTO `country` VALUES ('227', 'أنتيغوا وبربودا', 'Antigua and barbuda', '1268', 'AG', null, null, '1');
INSERT INTO `country` VALUES ('228', 'أفغانستان', 'Afghanistan', '93', 'AF', null, null, '1');
INSERT INTO `country` VALUES ('229', 'الإمارات العربية المتحدة', 'United arab emirates', '971', 'AE', null, null, '1');
INSERT INTO `country` VALUES ('230', 'أندورا', 'Andorra', '376', 'AD', null, null, '1');
INSERT INTO `country` VALUES ('231', 'المملكة العربية السعودية', 'Saudi Arabia', '966', 'SA', null, null, '1');
INSERT INTO `country` VALUES ('232', 'ص', 'صؤ', '255', null, null, null, '1');
