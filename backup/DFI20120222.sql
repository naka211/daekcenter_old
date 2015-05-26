-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 22, 2012 at 04:26 AM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-7+squeeze3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dfi`
--

-- --------------------------------------------------------

--
-- Table structure for table `jos_acajoom_lists`
--

CREATE TABLE IF NOT EXISTS `jos_acajoom_lists` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `list_name` varchar(101) NOT NULL DEFAULT '',
  `list_desc` text NOT NULL,
  `list_type` tinyint(2) NOT NULL DEFAULT '0',
  `sendername` varchar(64) NOT NULL DEFAULT '',
  `senderemail` varchar(64) NOT NULL DEFAULT '',
  `bounceadres` varchar(64) NOT NULL DEFAULT '',
  `layout` text NOT NULL,
  `template` int(9) NOT NULL DEFAULT '0',
  `subscribemessage` text NOT NULL,
  `unsubscribemessage` text NOT NULL,
  `unsubscribesend` tinyint(1) NOT NULL DEFAULT '1',
  `auto_add` tinyint(1) NOT NULL DEFAULT '0',
  `user_choose` tinyint(1) NOT NULL DEFAULT '0',
  `cat_id` varchar(250) NOT NULL DEFAULT '',
  `delay_min` int(2) NOT NULL DEFAULT '0',
  `delay_max` int(2) NOT NULL DEFAULT '7',
  `follow_up` int(10) NOT NULL DEFAULT '0',
  `html` tinyint(1) NOT NULL DEFAULT '1',
  `hidden` tinyint(1) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `createdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `acc_level` int(2) NOT NULL DEFAULT '0',
  `acc_id` int(11) NOT NULL DEFAULT '29',
  `notification` tinyint(1) NOT NULL DEFAULT '0',
  `owner` int(11) NOT NULL DEFAULT '0',
  `footer` tinyint(1) NOT NULL DEFAULT '1',
  `notify_id` int(10) NOT NULL DEFAULT '0',
  `next_date` int(11) NOT NULL DEFAULT '0',
  `start_date` date NOT NULL,
  `params` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `list_name` (`list_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `jos_acajoom_lists`
--

INSERT INTO `jos_acajoom_lists` (`id`, `list_name`, `list_desc`, `list_type`, `sendername`, `senderemail`, `bounceadres`, `layout`, `template`, `subscribemessage`, `unsubscribemessage`, `unsubscribesend`, `auto_add`, `user_choose`, `cat_id`, `delay_min`, `delay_max`, `follow_up`, `html`, `hidden`, `published`, `createdate`, `acc_level`, `acc_id`, `notification`, `owner`, `footer`, `notify_id`, `next_date`, `start_date`, `params`) VALUES
(1, 'Default', '', 1, 'Administrator', 'ngo.bieu@mwc.vn', 'ngo.bieu@mwc.vn', '<table border="0" cellspacing="0" cellpadding="0" width="100%" bgcolor="#f1f1f1">\r\n<tbody>\r\n<tr>\r\n<td align="center" valign="top">\r\n<table border="0" cellspacing="0" cellpadding="0" width="530" bgcolor="#f1f1f1">\r\n<tbody>\r\n<tr>\r\n<td class="hbnr" colspan="3" bgcolor="#ffffff"><img src="components/com_acajoom/templates/default/tpl0_top_header.jpg" border="0" alt="e Newsletter" width="530" height="137" /></td>\r\n</tr>\r\n<tr>\r\n<td colspan="3" bgcolor="#ffffff"><img src="components/com_acajoom/templates/default/tpl0_underban.jpg" border="0" alt="." width="530" height="22" /></td>\r\n</tr>\r\n<tr>\r\n<!-- /// gutter \\ -->\r\n<td width="15" valign="top" bgcolor="#ffffff"><img src="components/com_acajoom/templates/default/tpl0_spacer.gif" border="0" alt="1" width="15" height="1" /></td>\r\n<!-- \\ gutter /// --> <!-- /// content cell \\ -->\r\n<td width="500" valign="top" bgcolor="#ffffff"><br />\r\n<p>Â </p>\r\n<p>Your Subscription:<br /> [SUBSCRIPTIONS]</p>\r\n<p>Â </p>\r\n</td>\r\n<!-- \\ content cell /// --> <!-- /// gutter \\ -->\r\n<td width="15" valign="top" bgcolor="#ffffff"><img src="components/com_acajoom/templates/default/tpl0_spacer.gif" border="0" alt="1" width="15" height="1" /></td>\r\n<!-- \\ gutter /// -->\r\n</tr>\r\n<!-- /// footer area with contact info and opt-out link \\ --> \r\n<tr>\r\n<td colspan="3" bgcolor="#ffffff"><img src="components/com_acajoom/templates/default/tpl0_abovefooter.jpg" border="0" alt="." width="530" height="22" /></td>\r\n</tr>\r\n<tr>\r\n<td style="border-top: 1px solid #aeaeae;" colspan="3" align="center" valign="middle" bgcolor="#cacaca">\r\n<p class="footerText"><a href="http://www.ijoobi.com"><img src="components/com_acajoom/templates/default/tpl0_powered_by.gif" border="0" alt="Powered By Joobi" width="129" height="60" /></a></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<!-- \\ footer area with contact info and opt-out link /// --></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<!-- \\ Newsletter Powered by Acajoom!  /// -->\r\n<p>Â </p>', 0, '', '<p>This is a confirmation email that you have been unsubscribed from our list.  We are sorry that you decided to unsubscribe should you decide to re-subscribe you can always do so on our site.  Should you have any question please contact our webmaster.</p>', 1, 0, 0, '', 0, 0, 0, 1, 0, 1, '2010-01-06 03:01:38', 25, 29, 0, 62, 1, 0, 0, '0000-00-00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jos_acajoom_mailings`
--

CREATE TABLE IF NOT EXISTS `jos_acajoom_mailings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `list_id` int(10) NOT NULL DEFAULT '0',
  `list_type` tinyint(2) NOT NULL DEFAULT '0',
  `issue_nb` int(10) NOT NULL DEFAULT '0',
  `subject` varchar(120) NOT NULL DEFAULT '',
  `fromname` varchar(64) NOT NULL DEFAULT '',
  `fromemail` varchar(64) NOT NULL DEFAULT '',
  `frombounce` varchar(64) NOT NULL DEFAULT '',
  `htmlcontent` longtext NOT NULL,
  `textonly` longtext NOT NULL,
  `attachments` text NOT NULL,
  `images` text NOT NULL,
  `send_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delay` int(10) NOT NULL DEFAULT '0',
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `html` tinyint(1) NOT NULL DEFAULT '1',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `createdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `acc_level` int(2) NOT NULL DEFAULT '0',
  `author_id` int(11) NOT NULL DEFAULT '0',
  `params` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jos_acajoom_mailings`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_acajoom_queue`
--

CREATE TABLE IF NOT EXISTS `jos_acajoom_queue` (
  `qid` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(2) NOT NULL DEFAULT '0',
  `subscriber_id` int(11) NOT NULL DEFAULT '0',
  `list_id` int(10) NOT NULL DEFAULT '0',
  `mailing_id` int(11) NOT NULL DEFAULT '0',
  `issue_nb` int(10) NOT NULL DEFAULT '0',
  `send_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `suspend` tinyint(1) NOT NULL DEFAULT '0',
  `delay` int(10) NOT NULL DEFAULT '0',
  `acc_level` int(2) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `params` text,
  PRIMARY KEY (`qid`),
  UNIQUE KEY `subscriber_id` (`subscriber_id`,`list_id`,`mailing_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `jos_acajoom_queue`
--

INSERT INTO `jos_acajoom_queue` (`qid`, `type`, `subscriber_id`, `list_id`, `mailing_id`, `issue_nb`, `send_date`, `suspend`, `delay`, `acc_level`, `published`, `params`) VALUES
(1, 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 0, 0, 29, 0, ''),
(8, 1, 17, 1, 0, 0, '0000-00-00 00:00:00', 0, 0, 29, 0, ''),
(3, 1, 7, 1, 0, 0, '0000-00-00 00:00:00', 0, 0, 29, 0, ''),
(4, 1, 6, 1, 0, 0, '0000-00-00 00:00:00', 0, 0, 29, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `jos_acajoom_stats_details`
--

CREATE TABLE IF NOT EXISTS `jos_acajoom_stats_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mailing_id` int(11) NOT NULL DEFAULT '0',
  `subscriber_id` int(11) NOT NULL DEFAULT '0',
  `sentdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `html` tinyint(1) NOT NULL DEFAULT '0',
  `read` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `sub_mail` (`mailing_id`,`subscriber_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jos_acajoom_stats_details`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_acajoom_stats_global`
--

CREATE TABLE IF NOT EXISTS `jos_acajoom_stats_global` (
  `mailing_id` int(11) NOT NULL DEFAULT '0',
  `sentdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `html_sent` int(11) NOT NULL DEFAULT '0',
  `text_sent` int(11) NOT NULL DEFAULT '0',
  `html_read` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`mailing_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_acajoom_stats_global`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_acajoom_subscribers`
--

CREATE TABLE IF NOT EXISTS `jos_acajoom_subscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(64) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `receive_html` tinyint(1) NOT NULL DEFAULT '1',
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `blacklist` tinyint(1) NOT NULL DEFAULT '0',
  `timezone` time NOT NULL DEFAULT '00:00:00',
  `language_iso` varchar(10) NOT NULL DEFAULT 'eng',
  `subscribe_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `params` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `date` (`subscribe_date`),
  KEY `joomlauserid` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `jos_acajoom_subscribers`
--

INSERT INTO `jos_acajoom_subscribers` (`id`, `user_id`, `name`, `email`, `receive_html`, `confirmed`, `blacklist`, `timezone`, `language_iso`, `subscribe_date`, `params`) VALUES
(1, 62, 'Administrator', 'ngo.bieu@mwc.vn', 1, 1, 0, '00:00:00', 'eng', '2009-12-30 10:32:28', NULL),
(2, 63, 'client', 'client@client.com', 1, 1, 0, '00:00:00', 'eng', '2009-12-30 03:45:24', NULL),
(17, 0, '', 'cuongld85@yahoo.com', 1, 1, 0, '00:00:00', 'eng', '2011-12-16 04:13:09', ''),
(4, 69, 'Cuong', 'nguyen.cuong@mwc.vn', 1, 1, 0, '00:00:00', 'eng', '2010-01-13 07:14:47', NULL),
(5, 70, 'test2', 'a@a.a', 1, 1, 0, '00:00:00', 'eng', '2010-01-14 03:08:20', NULL),
(6, 71, 'Kim Hau', 'tkhau@mwc.vn', 1, 1, 0, '00:00:00', 'eng', '2010-01-20 13:14:16', NULL),
(7, 0, 'Tran Duy Loc', 'duylocstudy@gmail.com', 1, 1, 0, '00:00:00', 'eng', '2010-03-25 03:48:14', ''),
(8, 72, 'DFI', 'info@dfi.dk', 1, 1, 0, '00:00:00', 'eng', '2010-04-19 03:16:26', NULL),
(9, 73, 'Tran Duy Loc', 'tran.loc@mwc.vn', 1, 1, 0, '00:00:00', 'eng', '2010-04-22 04:34:21', NULL),
(10, 74, 'Kim Tran', 'info@mwc.vn', 1, 1, 0, '00:00:00', 'eng', '2010-05-19 09:13:56', NULL),
(11, 75, 'sdf', 'sdfs@sdfsdf.com', 1, 1, 0, '00:00:00', 'eng', '2010-05-21 03:37:15', NULL),
(12, 76, 'sdf', 'a@a.com', 1, 1, 0, '00:00:00', 'eng', '2010-05-21 03:38:04', NULL),
(13, 77, 'DFI Administrator', 'jesper@dinisenkraemmer.dk', 1, 1, 0, '00:00:00', 'eng', '2010-05-25 08:02:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jos_acajoom_xonfig`
--

CREATE TABLE IF NOT EXISTS `jos_acajoom_xonfig` (
  `akey` varchar(32) NOT NULL DEFAULT '',
  `text` varchar(254) NOT NULL DEFAULT '',
  `value` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`akey`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_acajoom_xonfig`
--

INSERT INTO `jos_acajoom_xonfig` (`akey`, `text`, `value`) VALUES
('component', 'Acajoom', 0),
('type', 'GPL', 0),
('version', '3.2.7', 0),
('level', '1', 0),
('emailmethod', 'mail', 0),
('sendmail_from', 'ngo.bieu@mwc.vn', 0),
('sendmail_name', 'CMS-System', 0),
('sendmail_path', '/usr/sbin/sendmail', 0),
('smtp_host', 'localhost', 0),
('smtp_auth_required', '0', 0),
('smtp_username', '', 0),
('smtp_password', '', 0),
('embed_images', '0', 0),
('confirm_return', 'ngo.bieu@mwc.vn', 0),
('upload_url', '/components/com_acajoom/upload', 0),
('enable_statistics', '1', 0),
('statistics_per_subscriber', '1', 0),
('send_data', '1', 0),
('allow_unregistered', '1', 0),
('require_confirmation', '0', 0),
('redirectconfirm', '', 0),
('show_login', '1', 0),
('show_logout', '1', 0),
('send_unsubcribe', '1', 0),
('confirm_fromname', 'CMS-System', 0),
('confirm_fromemail', 'ngo.bieu@mwc.vn', 0),
('confirm_html', '1', 0),
('time_zone', '0', 0),
('show_archive', '1', 0),
('pause_time', '20', 0),
('emails_between_pauses', '65', 0),
('wait_for_user', '0', 0),
('script_timeout', '0', 0),
('display_trace', '1', 0),
('send_log', '1', 0),
('send_auto_log', '0', 0),
('send_log_simple', '0', 0),
('send_log_closed', '1', 0),
('save_log', '0', 0),
('send_email', '1', 0),
('save_log_simple', '0', 0),
('save_log_file', '/administrator/components/com_acajoom/com_acajoom.log', 0),
('send_log_address', '@ijoobi.com', 0),
('option', 'com_sdonkey', 0),
('send_log_name', 'Acajoom Mailing Report', 0),
('homesite', 'http://www.ijoobi.com', 0),
('report_site', 'http://www.ijoobi.com', 0),
('integration', '0', 0),
('cb_plugin', '1', 0),
('cb_listIds', '0', 0),
('cb_intro', '', 0),
('cb_showname', '1', 0),
('cb_checkLists', '1', 0),
('cb_showHTML', '1', 0),
('cb_defaultHTML', '1', 0),
('cb_integration', '0', 0),
('cb_pluginInstalled', '0', 0),
('cron_max_freq', '10', 0),
('cron_max_emails', '60', 0),
('last_cron', '', 0),
('last_sub_update', '1324008762', 0),
('next_autonews', '', 0),
('show_footer', '1', 0),
('show_signature', '1', 0),
('update_url', 'http://www.ijoobi.com/update/', 0),
('date_update', '2009-12-30 07:21:12', 0),
('update_message', '', 0),
('show_guide', '1', 0),
('news1', '0', 0),
('news2', '0', 0),
('news3', '0', 0),
('cron_setup', '0', 0),
('queuedate', '', 0),
('update_avail', '0', 0),
('show_tips', '1', 0),
('update_notification', '1', 0),
('show_lists', '1', 0),
('use_sef', '0', 0),
('listHTMLeditor', '1', 0),
('mod_pub', '1', 0),
('firstmailing', '0', 0),
('nblist', '9', 0),
('license', '', 0),
('token', '', 0),
('maintenance', '', 0),
('admin_debug', '0', 0),
('send_error', '1', 0),
('report_error', '1', 0),
('fullcheck', '0', 0),
('frequency', '0', 0),
('nb_days', '7', 0),
('date_type', '1', 0),
('arv_cat', '', 0),
('arv_sec', '', 0),
('maintenance_clear', '24', 0),
('clean_stats', '90', 0),
('maintenance_date', '', 0),
('mail_format', '1', 0),
('showtag', '0', 0),
('show_author', '1', 0),
('addEmailRedLink', '0', 0),
('itemidAca', '999', 0),
('show_jcalpro', '0', 0),
('disabletooltip', '0', 0),
('minisendmail', '0', 0),
('word_wrap', '0', 0),
('listname0', '', 0),
('listnames0', 'All mailings', 0),
('listype0', '1', 0),
('listshow0', '1', 0),
('classes0', '', 0),
('listlogo0', 'addedit.png', 0),
('totallist0', '', 1),
('act_totallist0', '', 1),
('totalmailing0', '', 0),
('totalmailingsent0', '', 0),
('act_totalmailing0', '', 0),
('totalsubcribers0', '', 15),
('act_totalsubcribers0', '', 11),
('listname1', '_ACA_NEWSLETTER', 0),
('listnames1', '_ACA_MENU_NEWSLETTERS', 0),
('listype1', '1', 0),
('listshow1', '1', 0),
('classes1', 'newsletter', 0),
('listlogo1', 'inbox.png', 0),
('totallist1', '', 1),
('act_totallist1', '', 1),
('totalmailing1', '', 0),
('totalmailingsent1', '', 0),
('act_totalmailing1', '', 0),
('totalsubcribers1', '', 0),
('act_totalsubcribers1', '', 0),
('listname2', '', 0),
('listnames2', '', 0),
('listype2', '', 0),
('listshow2', '', 0),
('classes2', 'autoresponder', 0),
('listlogo2', '', 0),
('totallist2', '', 0),
('act_totallist2', '', 0),
('totalmailing2', '', 0),
('totalmailingsent2', '', 0),
('act_totalmailing2', '', 0),
('totalsubcribers2', '', 0),
('act_totalsubcribers2', '', 0),
('listname3', '', 0),
('listnames3', '', 0),
('listype3', '', 0),
('listshow3', '', 0),
('classes3', '', 0),
('listlogo3', '', 0),
('totallist3', '', 0),
('act_totallist3', '', 0),
('totalmailing3', '', 0),
('totalmailingsent3', '', 0),
('act_totalmailing3', '', 0),
('totalsubcribers3', '', 0),
('act_totalsubcribers3', '', 0),
('listname4', '', 0),
('listnames4', '', 0),
('listype4', '', 0),
('listshow4', '', 0),
('classes4', '', 0),
('listlogo4', '', 0),
('totallist4', '', 0),
('act_totallist4', '', 0),
('totalmailing4', '', 0),
('totalmailingsent4', '', 0),
('act_totalmailing4', '', 0),
('totalsubcribers4', '', 0),
('act_totalsubcribers4', '', 0),
('listname5', '', 0),
('listnames5', '', 0),
('listype5', '', 0),
('listshow5', '', 0),
('classes5', '', 0),
('listlogo5', '', 0),
('totallist5', '', 0),
('act_totallist5', '', 0),
('totalmailing5', '', 0),
('totalmailingsent5', '', 0),
('act_totalmailing5', '', 0),
('totalsubcribers5', '', 0),
('act_totalsubcribers5', '', 0),
('listname6', '', 0),
('listnames6', '', 0),
('listype6', '', 0),
('listshow6', '', 0),
('classes6', '', 0),
('listlogo6', '', 0),
('totallist6', '', 0),
('act_totallist6', '', 0),
('totalmailing6', '', 0),
('totalmailingsent6', '', 0),
('act_totalmailing6', '', 0),
('totalsubcribers6', '', 0),
('act_totalsubcribers6', '', 0),
('listname7', '', 0),
('listnames7', '', 0),
('listype7', '', 0),
('listshow7', '', 0),
('classes7', 'autonews', 0),
('listlogo7', '', 0),
('totallist7', '', 0),
('act_totallist7', '', 0),
('totalmailing7', '', 0),
('totalmailingsent7', '', 0),
('act_totalmailing7', '', 0),
('totalsubcribers7', '', 0),
('act_totalsubcribers7', '', 0),
('listname8', '', 0),
('listnames8', '', 0),
('listype8', '', 0),
('listshow8', '', 0),
('classes8', '', 0),
('listlogo8', '', 0),
('totallist8', '', 0),
('act_totallist8', '', 0),
('totalmailing8', '', 0),
('totalmailingsent8', '', 0),
('act_totalmailing8', '', 0),
('totalsubcribers8', '', 0),
('act_totalsubcribers8', '', 0),
('activelist', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_banner`
--

CREATE TABLE IF NOT EXISTS `jos_banner` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL DEFAULT '0',
  `type` varchar(30) NOT NULL DEFAULT 'banner',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `imptotal` int(11) NOT NULL DEFAULT '0',
  `impmade` int(11) NOT NULL DEFAULT '0',
  `clicks` int(11) NOT NULL DEFAULT '0',
  `imageurl` varchar(100) NOT NULL DEFAULT '',
  `clickurl` varchar(200) NOT NULL DEFAULT '',
  `date` datetime DEFAULT NULL,
  `showBanner` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `editor` varchar(50) DEFAULT NULL,
  `custombannercode` text,
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `sticky` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tags` text NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`bid`),
  KEY `viewbanner` (`showBanner`),
  KEY `idx_banner_catid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jos_banner`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_bannerclient`
--

CREATE TABLE IF NOT EXISTS `jos_bannerclient` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `contact` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `extrainfo` text NOT NULL,
  `checked_out` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out_time` time DEFAULT NULL,
  `editor` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jos_bannerclient`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_bannertrack`
--

CREATE TABLE IF NOT EXISTS `jos_bannertrack` (
  `track_date` date NOT NULL,
  `track_type` int(10) unsigned NOT NULL,
  `banner_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_bannertrack`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_categories`
--

CREATE TABLE IF NOT EXISTS `jos_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `section` varchar(50) NOT NULL DEFAULT '',
  `image_position` varchar(30) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `editor` varchar(50) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cat_idx` (`section`,`published`,`access`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `jos_categories`
--

INSERT INTO `jos_categories` (`id`, `parent_id`, `title`, `name`, `alias`, `image`, `section`, `image_position`, `description`, `published`, `checked_out`, `checked_out_time`, `editor`, `ordering`, `access`, `count`, `params`) VALUES
(1, 0, 'test', '', 'test', '', 'com_dfi_catalog', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 1, 0, 0, ''),
(2, 0, 'Nyheder', '', 'nyheder', '', '1', 'left', '', 1, 62, '2011-03-07 09:47:44', NULL, 1, 0, 0, ''),
(3, 0, 'Default', '', 'default', '', '1', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 2, 0, 0, ''),
(4, 0, 'Dinisenkræmmer', '', 'dinisenkraemmer', '', 'com_contact_details', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 1, 0, 0, ''),
(5, 0, 'Suppliers', '', 'suppliers', '', 'com_contact_details', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 2, 0, 0, ''),
(6, 0, 'Left', '', 'left', '', '1', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 3, 0, 0, ''),
(7, 0, 'Ugens Aviser', '', 'ugens-aviser', '', '1', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 4, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `jos_components`
--

CREATE TABLE IF NOT EXISTS `jos_components` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `link` varchar(255) NOT NULL DEFAULT '',
  `menuid` int(11) unsigned NOT NULL DEFAULT '0',
  `parent` int(11) unsigned NOT NULL DEFAULT '0',
  `admin_menu_link` varchar(255) NOT NULL DEFAULT '',
  `admin_menu_alt` varchar(255) NOT NULL DEFAULT '',
  `option` varchar(50) NOT NULL DEFAULT '',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `admin_menu_img` varchar(255) NOT NULL DEFAULT '',
  `iscore` tinyint(4) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `enabled` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `parent_option` (`parent`,`option`(32))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=111 ;

--
-- Dumping data for table `jos_components`
--

INSERT INTO `jos_components` (`id`, `name`, `link`, `menuid`, `parent`, `admin_menu_link`, `admin_menu_alt`, `option`, `ordering`, `admin_menu_img`, `iscore`, `params`, `enabled`) VALUES
(1, 'Banners', '', 0, 0, '', 'Banner Management', 'com_banners', 36, 'js/ThemeOffice/component.png', 0, 'track_impressions=0\ntrack_clicks=0\ntag_prefix=\n\n', 1),
(2, 'Banners', '', 0, 1, 'option=com_banners', 'Active Banners', 'com_banners', 1, 'js/ThemeOffice/edit.png', 0, '', 1),
(3, 'Clients', '', 0, 1, 'option=com_banners&c=client', 'Manage Clients', 'com_banners', 2, 'js/ThemeOffice/categories.png', 0, '', 1),
(45, 'Newsletters', '', 0, 42, 'option=com_acajoom&act=mailing&listype=1', 'Newsletters', 'com_acajoom', 2, '../includes/js/ThemeOffice/messaging_inbox.png', 0, '', 1),
(46, 'Statistics', '', 0, 42, 'option=com_acajoom&act=statistics', 'Statistics', 'com_acajoom', 3, '../includes/js/ThemeOffice/query.png', 0, '', 1),
(47, 'Configuration', '', 0, 42, 'option=com_acajoom&act=configuration', 'Configuration', 'com_acajoom', 4, '../includes/js/ThemeOffice/menus.png', 0, '', 1),
(7, 'Contacts', 'option=com_contact', 0, 0, '', 'Edit contact details', 'com_contact', 32, 'js/ThemeOffice/component.png', 1, 'contact_icons=0\nicon_address=\nicon_email=\nicon_telephone=\nicon_fax=\nicon_misc=\nshow_headings=1\nshow_position=1\nshow_email=0\nshow_telephone=1\nshow_mobile=1\nshow_fax=1\nbannedEmail=\nbannedSubject=\nbannedText=\nsession=1\ncustomReply=0\n\n', 1),
(8, 'Contacts', '', 0, 7, 'option=com_contact', 'Edit contact details', 'com_contact', 0, 'js/ThemeOffice/edit.png', 1, '', 1),
(9, 'Categories', '', 0, 7, 'option=com_categories&section=com_contact_details', 'Manage contact categories', '', 2, 'js/ThemeOffice/categories.png', 1, 'contact_icons=0\nicon_address=\nicon_email=\nicon_telephone=\nicon_fax=\nicon_misc=\nshow_headings=1\nshow_position=1\nshow_email=0\nshow_telephone=1\nshow_mobile=1\nshow_fax=1\nbannedEmail=\nbannedSubject=\nbannedText=\nsession=1\ncustomReply=0\n\n', 1),
(44, 'Subscribers', '', 0, 42, 'option=com_acajoom&act=subscribers', 'Subscribers', 'com_acajoom', 1, '../includes/js/ThemeOffice/users_add.png', 0, '', 1),
(40, 'RokQuickCart', '', 0, 0, '', 'RokQuickCart', 'com_rokquickcart', 27, '', 0, '', 1),
(41, 'Translation Manager', 'option=com_translationsmanager', 0, 0, 'option=com_translationsmanager', 'Translation Manager', 'com_translationsmanager', 51, 'class:language', 0, '', 1),
(42, 'Acajoom', 'option=com_acajoom', 0, 0, 'option=com_acajoom', 'Acajoom', 'com_acajoom', 37, '../administrator/components/com_acajoom/images/acajoom_icon.png', 0, '', 1),
(43, 'Lists', '', 0, 42, 'option=com_acajoom&act=list', 'Lists', 'com_acajoom', 0, '../includes/js/ThemeOffice/edit.png', 0, '', 1),
(14, 'User', 'option=com_user', 0, 0, '', '', 'com_user', 21, '', 1, '', 1),
(15, 'Search', 'option=com_search', 0, 0, 'option=com_search', 'Search Statistics', 'com_search', 24, 'js/ThemeOffice/component.png', 1, 'enabled=0\n\n', 1),
(16, 'Categories', '', 0, 1, 'option=com_categories&section=com_banner', 'Categories', '', 3, '', 1, '', 1),
(17, 'Wrapper', 'option=com_wrapper', 0, 0, '', 'Wrapper', 'com_wrapper', 4, '', 1, '', 1),
(18, 'Mail To', '', 0, 0, '', '', 'com_mailto', 13, '', 1, '', 1),
(19, 'Media Manager', '', 0, 0, 'option=com_media', 'Media Manager', 'com_media', 11, '', 1, 'upload_extensions=bmp,csv,doc,epg,gif,ico,jpg,odg,odp,ods,odt,pdf,png,ppt,swf,txt,xcf,xls,BMP,CSV,DOC,EPG,GIF,ICO,JPG,ODG,ODP,ODS,ODT,PDF,PNG,PPT,SWF,TXT,XCF,XLS\nupload_maxsize=10000000\nfile_path=images\nimage_path=images/stories\nrestrict_uploads=1\nallowed_media_usergroup=3\ncheck_mime=1\nimage_extensions=bmp,gif,jpg,png\nignore_extensions=\nupload_mime=image/jpeg,image/gif,image/png,image/bmp,application/x-shockwave-flash,application/msword,application/excel,application/pdf,application/powerpoint,text/plain,application/x-zip\nupload_mime_illegal=text/html\nenable_flash=0\n\n', 1),
(20, 'Articles', 'option=com_content', 0, 0, '', '', 'com_content', 31, '', 1, 'show_noauth=0\nshow_title=1\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\nfeed_summary=0\n\n', 1),
(21, 'Configuration Manager', '', 0, 0, '', 'Configuration', 'com_config', 33, '', 1, '', 1),
(22, 'Installation Manager', '', 0, 0, '', 'Installer', 'com_installer', 40, '', 1, '', 1),
(23, 'Language Manager', '', 0, 0, '', 'Languages', 'com_languages', 28, '', 1, 'site=da-DK\n\n', 1),
(24, 'Mass mail', '', 0, 0, '', 'Mass Mail', 'com_massmail', 12, '', 1, 'mailSubjectPrefix=\nmailBodySuffix=\n\n', 1),
(25, 'Menu Editor', '', 0, 0, '', 'Menu Editor', 'com_menus', 10, '', 1, '', 1),
(27, 'Messaging', '', 0, 0, '', 'Messages', 'com_messages', 9, '', 1, '', 1),
(28, 'Modules Manager', '', 0, 0, '', 'Modules', 'com_modules', 8, '', 1, '', 1),
(29, 'Plugin Manager', '', 0, 0, '', 'Plugins', 'com_plugins', 16, '', 1, '', 1),
(30, 'Template Manager', '', 0, 0, '', 'Templates', 'com_templates', 22, '', 1, '', 1),
(31, 'User Manager', '', 0, 0, '', 'Users', 'com_users', 20, '', 1, 'allowUserRegistration=1\nnew_usertype=Registered\nuseractivation=0\nfrontend_userparams=1\n\n', 1),
(32, 'Cache Manager', '', 0, 0, '', 'Cache', 'com_cache', 35, '', 1, '', 1),
(33, 'Control Panel', '', 0, 0, '', 'Control Panel', 'com_cpanel', 30, '', 1, '', 1),
(48, 'Import', '', 0, 42, 'option=com_acajoom&act=update', 'Import', 'com_acajoom', 5, '../includes/js/ThemeOffice/restore.png', 0, '', 1),
(49, 'About', '', 0, 42, 'option=com_acajoom&act=about', 'About', 'com_acajoom', 6, '../includes/js/ThemeOffice/credits.png', 0, '', 1),
(50, 'System', 'option=com_component', 0, 0, 'option=com_component', 'System', 'com_component', 54, '../images/rokquickcart/menu/icon-16-component.png', 0, 'com_component=component_config.xml\ncom_contact=config.xml\ncom_content=config.xml\ncom_media=config.xml\ncom_users=config.xml\ncom_weblinks=config.xml\ncom_newsfeeds=config.xml\ncom_banners=config.xml\n\n', 1),
(51, 'Control Panel', '', 0, 50, 'option=com_component&view=cpanel', 'DFI Control Panel', 'com_component', 1, '../includes/js/ThemeOffice/component.png', 0, 'com_component=component_config.xml\ncom_contact=config.xml\ncom_content=config.xml\ncom_media=config.xml\ncom_users=config.xml\ncom_weblinks=config.xml\ncom_newsfeeds=config.xml\ncom_banners=config.xml\n\n', 1),
(52, 'Resize_thumbnail', '', 0, 0, '', 'Resize_thumbnail', 'com_resize_thumbnail', 17, '', 0, '', 1),
(53, 'Dfi_shop', '', 0, 0, '', 'Dfi_shop', 'com_dfi_shop', 44, '', 0, '', 1),
(54, 'Shop', '', 0, 97, 'option=com_dfi_shop', 'Shop', 'com_dfi_shop', 2, '../includes/js/ThemeOffice/component.png', 0, '', 1),
(55, 'Dfi_member', '', 0, 0, '', 'Dfi_member', 'com_dfi_member', 50, '', 0, '', 1),
(57, 'Dfi_supplier', '', 0, 0, '', 'Dfi_supplier', 'com_dfi_supplier', 43, '', 0, '', 1),
(58, 'Leverandør', '', 0, 97, 'option=com_dfi_supplier', 'Leverandør', 'com_dfi_supplier', 8, '../includes/js/ThemeOffice/component.png', 0, '', 1),
(59, 'Dfi_product', '', 0, 0, '', 'Dfi_product', 'com_dfi_product', 46, '', 0, '', 1),
(60, 'Produkt', '', 0, 97, 'option=com_dfi_product', 'Produkt', 'com_dfi_product', 9, '../includes/js/ThemeOffice/component.png', 0, '', 1),
(62, 'Kampagne', '', 0, 97, 'option=com_dfi_campaign', 'Kampagne', 'com_dfi_campaign', 10, '../includes/js/ThemeOffice/component.png', 0, '', 1),
(64, 'Dfi_order_status', '', 0, 0, '', 'Dfi_order_status', 'com_dfi_order_status', 47, '', 0, '', 1),
(65, 'Status', '', 0, 97, 'option=com_dfi_order_status', 'Status', 'com_dfi_order_status', 11, '../includes/js/ThemeOffice/component.png', 0, '', 1),
(66, 'Dfi_catalog', '', 0, 0, '', 'Dfi_catalog', 'com_dfi_catalog', 38, '', 0, '', 1),
(67, 'Catalog', '', 0, 102, 'option=com_dfi_catalog', 'Catalog', 'com_dfi_catalog', 12, '../includes/js/ThemeOffice/component.png', 0, '', 1),
(68, 'Category', '', 0, 102, 'option=com_categories&section=com_dfi_catalog', 'Category', 'com_categories', 13, '../includes/js/ThemeOffice/component.png', 0, '', 1),
(69, 'Dfi_map', '', 0, 0, '', 'Dfi_map', 'com_dfi_map', 39, '', 0, '', 1),
(70, 'Shop Map', '', 0, 102, 'option=com_dfi_map', 'Shop Map', 'com_dfi_map', 14, '../includes/js/ThemeOffice/component.png', 0, '', 1),
(71, 'Dfi_order', '', 0, 0, '', 'Dfi_order', 'com_dfi_order', 49, '', 0, '', 1),
(72, 'Ordre', '', 0, 97, 'option=com_dfi_order', 'Ordre', 'com_dfi_order', 15, '../includes/js/ThemeOffice/component.png', 0, '', 0),
(73, 'Dfi_order_product', '', 0, 0, '', 'Dfi_order_product', 'com_dfi_order_product', 48, '', 0, '', 1),
(74, 'Dfi_report', '', 0, 0, '', 'Dfi_report', 'com_dfi_report', 45, '', 0, '', 1),
(75, 'DFI Report Manager', '', 0, 97, 'option=com_dfi_report', 'DFI Report Manager', 'com_dfi_report', 16, '../includes/js/ThemeOffice/component.png', 0, '', 0),
(76, 'Home', 'option=com_home', 0, 0, '', 'Home', 'com_home', 41, '../includes/js/ThemeOffice/component.png', 0, '', 1),
(77, 'Omos', 'option=com_omos', 0, 0, '', 'Omos', 'com_omos', 5, '../includes/js/ThemeOffice/component.png', 0, '', 1),
(78, 'Nyheder', 'option=com_nyheder', 0, 0, '', 'Nyheder', 'com_nyheder', 6, '../includes/js/ThemeOffice/component.png', 0, '', 1),
(79, 'Kontakt', 'option=com_kontakt', 0, 0, '', 'Kontakt', 'com_kontakt', 29, '../includes/js/ThemeOffice/component.png', 0, '', 1),
(80, 'Search_result', '', 0, 0, '', 'Search_result', 'com_search_result', 23, '', 0, '', 1),
(81, 'Flip_book', 'option=com_flip_book', 0, 0, '', 'Flip_book', 'com_flip_book', 42, '../includes/js/ThemeOffice/component.png', 0, '', 1),
(96, 'Catalog', '', 0, 0, '', 'Catalog', 'com_catalog', 34, '', 0, '', 1),
(84, 'Varedatabase', 'option=com_varedatabase', 0, 0, '', 'Varedatabase', 'com_varedatabase', 19, '../includes/js/ThemeOffice/component.png', 0, '', 1),
(86, 'Salgsrapportering', 'option=com_salgsrapportering', 0, 0, '', 'Salgsrapportering', 'com_salgsrapportering', 26, '../includes/js/ThemeOffice/component.png', 0, '', 1),
(97, 'DI Store', '', 0, 0, '', '', '', 53, '../images/rokquickcart/module___icon.png', 0, '', 1),
(90, 'Lever', 'option=com_lever', 0, 0, '', 'Lever', 'com_lever', 14, '../includes/js/ThemeOffice/component.png', 0, '', 1),
(91, 'Myshop', 'option=com_myshop', 0, 0, '', 'Myshop', 'com_myshop', 7, '../includes/js/ThemeOffice/component.png', 0, '', 1),
(92, 'Order', '', 0, 0, '', 'Order', 'com_order', 15, '', 0, '', 1),
(93, 'Workers', 'option=com_workers', 0, 0, '', 'Workers', 'com_workers', 18, '../includes/js/ThemeOffice/component.png', 0, '', 1),
(95, 'Salgsrapportering2', '', 0, 0, '', 'Salgsrapportering2', 'com_salgsrapportering2', 25, '', 0, '', 1),
(99, 'Dfi_kobreak', '', 0, 0, '', 'Dfi_kobreak', 'com_dfi_kobreak', 2, '../includes/js/ThemeOffice/component.png', 0, '', 1),
(100, 'Dfi_kobreak_product', '', 0, 0, '', 'Dfi_kobreak_product', 'com_dfi_kobreak_product', 1, '', 0, '', 1),
(101, 'Dfi_folder', '', 0, 0, '', 'Dfi_folder', 'com_dfi_folder', 3, '', 0, '', 1),
(102, 'DI Content', '', 0, 0, '', '', '', 52, '../images/rokquickcart/module___icon.png', 0, '', 1),
(103, 'Købeark', '', 0, 97, 'option=com_dfi_kobreak', 'Købeark', 'com_dfi_kobreak', 17, '../images/rokquickcart/module___icon.png', 0, '', 1),
(104, 'Dfi_distribution_rate', '', 0, 0, '', 'Dfi_distribution_rate', 'com_dfi_distribution_rate', 0, '', 0, '', 1),
(106, 'Dfi_campaign_to_product', '', 0, 0, '', 'Dfi_campaign_to_product', 'com_dfi_campaign_to_product', 0, '../includes/js/ThemeOffice/component.png', 0, '', 1),
(108, 'Dfi_review_product', '', 0, 0, '', 'Dfi_review_product', 'com_dfi_review_product', 0, '', 0, '', 1),
(109, 'Ajourmaster', '', 0, 97, 'option=com_dfi_order&view=active_checkbox', 'Ajourmaster', 'com_dfi_kobreak', 17, '../images/rokquickcart/module___icon.png', 0, '', 1),
(110, 'Omsætning', '', 0, 97, 'option=com_dfi_monthly', 'Omsætning', 'com_dfi_monthly', 17, '../images/rokquickcart/module___icon.png', 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jos_contact_details`
--

CREATE TABLE IF NOT EXISTS `jos_contact_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `con_position` varchar(255) DEFAULT NULL,
  `address` text,
  `suburb` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `postcode` varchar(100) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `misc` mediumtext,
  `image` varchar(255) DEFAULT NULL,
  `imagepos` varchar(20) DEFAULT NULL,
  `email_to` varchar(255) DEFAULT NULL,
  `default_con` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `catid` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `mobile` varchar(255) NOT NULL DEFAULT '',
  `webpage` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `jos_contact_details`
--

INSERT INTO `jos_contact_details` (`id`, `name`, `alias`, `con_position`, `address`, `suburb`, `state`, `country`, `postcode`, `telephone`, `fax`, `misc`, `image`, `imagepos`, `email_to`, `default_con`, `published`, `checked_out`, `checked_out_time`, `ordering`, `params`, `user_id`, `catid`, `access`, `mobile`, `webpage`) VALUES
(1, 'admin', 'admin', '', '', '', '', '', '', '', '', '', '', NULL, 'nguyen.cuong@mwc.vn', 0, 1, 0, '0000-00-00 00:00:00', 1, 'show_name=0\nshow_position=0\nshow_email=0\nshow_street_address=0\nshow_suburb=0\nshow_state=0\nshow_postcode=0\nshow_country=0\nshow_telephone=0\nshow_mobile=0\nshow_fax=0\nshow_webpage=0\nshow_misc=0\nshow_image=0\nallow_vcard=0\ncontact_icons=2\nicon_address=\nicon_email=\nicon_telephone=\nicon_mobile=\nicon_fax=\nicon_misc=\nshow_email_form=0\nemail_description=\nshow_email_copy=1\nbanned_email=\nbanned_subject=\nbanned_text=', 0, 4, 0, '', ''),
(2, 'supplier 1', 'supplier-1', '', '', '', '', '', '', '', '', '', '', NULL, 'nguyen.cuong@mwc.vn', 0, 1, 0, '0000-00-00 00:00:00', 1, 'show_name=1\nshow_position=1\nshow_email=0\nshow_street_address=1\nshow_suburb=1\nshow_state=1\nshow_postcode=1\nshow_country=1\nshow_telephone=1\nshow_mobile=1\nshow_fax=1\nshow_webpage=1\nshow_misc=1\nshow_image=1\nallow_vcard=0\ncontact_icons=0\nicon_address=\nicon_email=\nicon_telephone=\nicon_mobile=\nicon_fax=\nicon_misc=\nshow_email_form=1\nemail_description=\nshow_email_copy=1\nbanned_email=\nbanned_subject=\nbanned_text=', 0, 5, 0, '', ''),
(3, 'supplier 2', 'supplier-2', '', '', '', '', '', '', '', '', '', '', NULL, 'nguyen.cuong@mwc.vn', 0, 1, 0, '0000-00-00 00:00:00', 2, 'show_name=1\nshow_position=1\nshow_email=0\nshow_street_address=1\nshow_suburb=1\nshow_state=1\nshow_postcode=1\nshow_country=1\nshow_telephone=1\nshow_mobile=1\nshow_fax=1\nshow_webpage=1\nshow_misc=1\nshow_image=1\nallow_vcard=0\ncontact_icons=0\nicon_address=\nicon_email=\nicon_telephone=\nicon_mobile=\nicon_fax=\nicon_misc=\nshow_email_form=1\nemail_description=\nshow_email_copy=1\nbanned_email=\nbanned_subject=\nbanned_text=', 0, 5, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `jos_content`
--

CREATE TABLE IF NOT EXISTS `jos_content` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `title_alias` varchar(255) NOT NULL DEFAULT '',
  `introtext` mediumtext NOT NULL,
  `fulltext` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `sectionid` int(11) unsigned NOT NULL DEFAULT '0',
  `mask` int(11) unsigned NOT NULL DEFAULT '0',
  `catid` int(11) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `images` text NOT NULL,
  `urls` text NOT NULL,
  `attribs` text NOT NULL,
  `version` int(11) unsigned NOT NULL DEFAULT '1',
  `parentid` int(11) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `access` int(11) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  `metadata` text NOT NULL,
  `article_image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_section` (`sectionid`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `jos_content`
--

INSERT INTO `jos_content` (`id`, `title`, `alias`, `title_alias`, `introtext`, `fulltext`, `state`, `sectionid`, `mask`, `catid`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `checked_out`, `checked_out_time`, `publish_up`, `publish_down`, `images`, `urls`, `attribs`, `version`, `parentid`, `ordering`, `metakey`, `metadesc`, `access`, `hits`, `metadata`, `article_image`) VALUES
(1, 'Tilbudsavis', 'tilbudsavis', '', '<p>Se vores aktuelle tilbud her!</p>', '', 1, 0, 0, 0, '2010-01-09 07:36:56', 62, '', '2011-03-28 09:14:41', 62, 0, '0000-00-00 00:00:00', '2010-01-09 07:36:56', '0000-00-00 00:00:00', '', '', 'banner_icon=\ntitle_icon=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 4, 0, 4, '', '', 0, 0, 'robots=\nauthor=', ''),
(2, 'Om', 'om', '', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', 1, 0, 0, 0, '2010-01-09 08:33:33', 62, '', '2011-12-13 04:38:35', 69, 0, '0000-00-00 00:00:00', '2010-01-09 08:33:33', '0000-00-00 00:00:00', '', '', 'banner_icon=\ntitle_icon=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 11, 0, 3, '', '', 0, 0, 'robots=\nauthor=', 'images/rokquickcart/indretning.jpg'),
(3, 'Kop&Kande i StenlÃ¸se og i Frederikssund', 'kopakande-i-stenlose-og-i-frederikssund', '', '<p>Midt i november kommer Kop&amp;Kande til endnu 2 byer pÃ¥ SjÃ¦lland - denne gang er det StenlÃ¸se og...</p>', '', -2, 1, 0, 2, '2010-01-11 09:11:05', 62, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2010-01-11 09:11:05', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 1, 0, 0, '', '', 0, 0, 'robots=\nauthor=', ''),
(4, 'Kop&Kande i StenlÃ¸se og i Frederikssund', 'kopakande-i-stenlose-og-i-frederikssund', '', '<p>Midt i november kommer Kop&amp;Kande til endnu 2 byer pÃ¥ SjÃ¦lland - denne gang er det StenlÃ¸se og...</p>', '', -2, 1, 0, 2, '2010-01-11 09:11:48', 62, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2010-01-11 09:11:48', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 1, 0, 0, '', '', 0, 0, 'robots=\nauthor=', ''),
(5, 'Kop&Kande i StenlÃ¸se og i Frederikssund', 'kopakande-i-stenlose-og-i-frederikssund', '', '<p>Midt i november kommer Kop&amp;Kande til endnu 2 byer pÃ¥ SjÃ¦lland - denne gang er det StenlÃ¸se og...</p>', '', -2, 1, 0, 2, '2010-01-12 02:58:52', 62, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2010-01-12 02:58:52', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 1, 0, 0, '', '', 0, 0, 'robots=\nauthor=', ''),
(6, 'Kop&Kande i StenlÃ¸se og i Frederikssund', 'kopakande-i-stenlose-og-i-frederikssund', '', '<p>Midt i november kommer Kop&amp;Kande til endnu 2 byer pÃ¥ SjÃ¦lland - denne gang er det StenlÃ¸se og...</p>', '', -2, 1, 0, 2, '2010-01-12 02:59:28', 62, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2010-01-12 02:59:28', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 1, 0, 0, '', '', 0, 0, 'robots=\nauthor=', ''),
(7, 'StÃ¦rke kÃ¦der med plads til forskellighed', 'staerke-kaeder-med-plads-til-forskellighed', '', '<p>Midt i november kommer Kop&amp;Kande til endnu 2 byer pÃ¥ SjÃ¦lland - denne gang er det StenlÃ¸se og...</p>', '', -2, 1, 0, 2, '2010-01-12 02:59:42', 62, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2010-01-12 02:59:42', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 1, 0, 0, '', '', 0, 0, 'robots=\nauthor=', ''),
(8, 'Kop&Kande i StenlÃ¸se og i Frederikssund', 'kopakande-i-stenlose-og-i-frederikssund', '', '<p>Midt i november kommer Kop&amp;Kande til endnu 2 byer pÃ¥ SjÃ¦lland - denne gang er det StenlÃ¸se og...</p>', '', -2, 1, 0, 2, '2010-01-12 02:59:54', 62, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2010-01-12 02:59:54', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 1, 0, 0, '', '', 0, 0, 'robots=\nauthor=', ''),
(9, 'Kop&Kande i StenlÃ¸se og i Frederikssund', 'kopakande-i-stenlose-og-i-frederikssund', '', '<p>Midt i november kommer Kop&amp;Kande til endnu 2 byer pÃ¥ SjÃ¦lland - denne gang er det StenlÃ¸se og...</p>', '', -2, 1, 0, 2, '2010-01-12 03:00:04', 62, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2010-01-12 03:00:04', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 1, 0, 0, '', '', 0, 0, 'robots=\nauthor=', ''),
(10, 'Din Isenkræmmer holder fødselsdag', 'din-isenkraemmer-holder-fodselsdag', '', '<p>I forbindelse med Din Isenkræmmers 10 års fødselsdag, sælges varer til priser du ikke har set de sidste 10 år...............</p>\r\n', '\r\n<div class="img-cnt-right"><img src="templates/defrieisenkram/img/ledige-img.jpg" border="0" /></div>\r\n<div class="txt-cnt">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n</div>', 1, 1, 0, 2, '2010-01-12 03:00:14', 62, '', '2011-12-14 02:18:15', 69, 0, '0000-00-00 00:00:00', '2010-01-12 03:00:14', '0000-00-00 00:00:00', '', '', 'banner_icon=\ntitle_icon=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 5, 0, 1, '', '', 0, 0, 'robots=\nauthor=', 'images/rokquickcart/ledige-img.jpg'),
(11, 'Lorem ipsum dolor sit amet', 'lorem-ipsum-dolor-sit-amet', '', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ...</p>\r\n', '\r\n<div class="img-cnt-right"><img src="templates/defrieisenkram/img/ledige-img.jpg" border="0" /></div>\r\n<div class="txt-cnt">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n</div>', 1, 1, 0, 2, '2010-01-12 06:56:49', 62, '', '2011-12-14 02:18:04', 69, 0, '0000-00-00 00:00:00', '2010-01-12 06:56:49', '0000-00-00 00:00:00', '', '', 'banner_icon=\ntitle_icon=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 6, 0, 2, '', '', 0, 0, 'robots=\nauthor=', 'images/rokquickcart/ledige-img.jpg'),
(12, 'Kontakt Os', 'kontakt-os', '', '<p class="fs11 p10t">Axelhøj 65<br /><br />2610 Rødovre<br /><br />CVR: 32 65 92 09 <br />kontakt<a href="mailto:kontakt@dinisenkraemmer.dk">@dinisenkraemmer.dk</a></p>', '', 1, 0, 0, 0, '2010-01-12 06:58:25', 62, '', '2011-03-07 09:40:34', 62, 0, '0000-00-00 00:00:00', '2010-01-12 06:58:25', '0000-00-00 00:00:00', '', '', 'banner_icon=\ntitle_icon=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 3, 0, 1, '', '', 0, 0, 'robots=\nauthor=', ''),
(13, 'Kontakt Msg', 'kontakt-msg', '', '<h4>Tak for din henvendelse! Vi vil kontakte dig hurtigst muligt     <br /><br /> Venlig hilsen<br /> dfi.dk</h4>', '', -2, 1, 0, 3, '2010-01-12 07:09:03', 62, '', '2010-01-12 07:19:41', 62, 0, '0000-00-00 00:00:00', '2010-01-12 07:09:03', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 2, 0, 0, '', '', 0, 0, 'robots=\nauthor=', ''),
(14, 'Error Msg', 'error', '', '<p>Error! This function is not allowed</p>', '', -2, 1, 0, 3, '2010-01-12 07:12:28', 62, '', '2010-01-12 07:13:27', 62, 0, '0000-00-00 00:00:00', '2010-01-12 07:12:28', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 3, 0, 0, '', '', 0, 0, 'robots=\nauthor=', ''),
(15, 'Register Msg', 'register-msg', '', '<p>Thanks for registration.</p>', '', -2, 1, 0, 3, '2010-01-12 08:57:53', 62, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2010-01-12 08:57:53', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 1, 0, 0, '', '', 0, 0, 'robots=\nauthor=', ''),
(16, 'Ledige stillinger', 'ledige-stillinger', '', '<div class="img-cnt-right"><img src="templates/defrieisenkram/img/ledige-img.jpg" border="0" /></div>\r\n<div class="txt-cnt">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n</div>', '', 1, 1, 0, 6, '2011-12-15 03:34:15', 69, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2011-12-15 03:34:15', '0000-00-00 00:00:00', '', '', 'banner_icon=\ntitle_icon=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 1, 0, 4, '', '', 0, 39, 'robots=\nauthor=', ''),
(17, 'Uddannelse', 'uddannelse', '', '<div class="img-cnt-right"><img src="templates/defrieisenkram/img/ledige-img.jpg" border="0" /></div>\r\n<div class="txt-cnt">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n</div>', '', 1, 1, 0, 6, '2011-12-15 03:34:15', 69, '', '2011-12-15 03:35:34', 69, 0, '0000-00-00 00:00:00', '2011-12-15 03:34:15', '0000-00-00 00:00:00', '', '', 'banner_icon=\ntitle_icon=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 1, 0, 3, '', '', 0, 25, 'robots=\nauthor=', ''),
(18, 'Uopfordret Ansøgning', 'uopfordret-ansogning', '', '<div class="img-cnt-right"><img src="templates/defrieisenkram/img/ledige-img.jpg" border="0" /></div>\r\n<div class="txt-cnt">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n</div>', '', 1, 1, 0, 6, '2011-12-15 03:34:15', 69, '', '2011-12-15 03:35:47', 69, 0, '0000-00-00 00:00:00', '2011-12-15 03:34:15', '0000-00-00 00:00:00', '', '', 'banner_icon=\ntitle_icon=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 1, 0, 2, '', '', 0, 23, 'robots=\nauthor=', ''),
(19, 'Ny butik i Din Isenkræmmer', 'ny-butik-i-din-isenkraemmer', '', '<div class="img-cnt-right"><img src="templates/defrieisenkram/img/ledige-img.jpg" border="0" /></div>\r\n<div class="txt-cnt">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n</div>', '', 1, 1, 0, 6, '2011-12-15 03:34:15', 69, '', '2011-12-15 03:35:59', 69, 0, '0000-00-00 00:00:00', '2011-12-15 03:34:15', '0000-00-00 00:00:00', '', '', 'banner_icon=\ntitle_icon=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 1, 0, 1, '', '', 0, 20, 'robots=\nauthor=', ''),
(20, 'Lorem ipsum dolor sit amet', 'lorem-ipsum-dolor-sit-amet', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea  commodo consequat. Ut enim ad minim veniam, quis nostrud exercitation  ullamco laboris nisi ut aliquip ex ea commodo consequat. ...', '', 1, 1, 0, 7, '2011-12-15 04:01:48', 69, '', '2011-12-15 05:39:15', 69, 0, '0000-00-00 00:00:00', '2011-12-15 04:01:48', '0000-00-00 00:00:00', '', '', 'banner_icon=\ntitle_icon=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 2, 0, 3, '', 'http://files.flipsnack.net/app/swf/EmbedCanvas.swf?hash_id=3b8f4cb037a58609c2b75bfa0q453578&t=1320209803', 0, 0, 'robots=\nauthor=', 'images/rokquickcart/abc_03.jpg'),
(21, 'Lorem ipsum dolor sit amet', 'lorem-ipsum-dolor-sit-amet', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea  commodo consequat. Ut enim ad minim veniam, quis nostrud exercitation  ullamco laboris nisi ut aliquip ex ea commodo consequat. ...', '', 1, 1, 0, 7, '2011-12-15 04:01:48', 69, '', '2011-12-15 05:39:07', 69, 0, '0000-00-00 00:00:00', '2011-12-15 04:01:48', '0000-00-00 00:00:00', '', '', 'banner_icon=\ntitle_icon=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 1, 0, 2, '', 'http://files.flipsnack.net/app/swf/EmbedCanvas.swf?hash_id=3b8f4cb037a58609c2b75bfa0q453578&t=1320209803', 0, 0, 'robots=\nauthor=', 'images/rokquickcart/abc_03.jpg'),
(22, 'Lorem ipsum dolor sit amet', 'lorem-ipsum-dolor-sit-amet', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea  commodo consequat. Ut enim ad minim veniam, quis nostrud exercitation  ullamco laboris nisi ut aliquip ex ea commodo consequat. ...', '', 1, 1, 0, 7, '2011-12-15 04:01:48', 69, '', '2011-12-15 05:38:59', 69, 0, '0000-00-00 00:00:00', '2011-12-15 04:01:48', '0000-00-00 00:00:00', '', '', 'banner_icon=\ntitle_icon=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 1, 0, 1, '', 'http://files.flipsnack.net/app/swf/EmbedCanvas.swf?hash_id=3b8f4cb037a58609c2b75bfa0q453578&t=1320209803', 0, 0, 'robots=\nauthor=', 'images/rokquickcart/abc_03.jpg'),
(23, 'Nyheder Shop', 'nyheder-shop', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.', '', 1, 1, 0, 3, '2011-12-16 04:10:01', 69, '', '2011-12-16 10:24:59', 72, 0, '0000-00-00 00:00:00', '2011-12-16 04:10:01', '0000-00-00 00:00:00', '', '', 'banner_icon=\ntitle_icon=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 2, 0, 1, '', '', 0, 0, 'robots=\nauthor=', '');

-- --------------------------------------------------------

--
-- Table structure for table `jos_content_frontpage`
--

CREATE TABLE IF NOT EXISTS `jos_content_frontpage` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`content_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_content_frontpage`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_content_rating`
--

CREATE TABLE IF NOT EXISTS `jos_content_rating` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `rating_sum` int(11) unsigned NOT NULL DEFAULT '0',
  `rating_count` int(11) unsigned NOT NULL DEFAULT '0',
  `lastip` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`content_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_content_rating`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_core_acl_aro`
--

CREATE TABLE IF NOT EXISTS `jos_core_acl_aro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section_value` varchar(240) NOT NULL DEFAULT '0',
  `value` varchar(240) NOT NULL DEFAULT '',
  `order_value` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `hidden` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `jos_section_value_value_aro` (`section_value`(100),`value`(100)),
  KEY `jos_gacl_hidden_aro` (`hidden`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `jos_core_acl_aro`
--

INSERT INTO `jos_core_acl_aro` (`id`, `section_value`, `value`, `order_value`, `name`, `hidden`) VALUES
(10, 'users', '62', 0, 'Administrator', 0),
(11, 'users', '63', 0, 'client', 0),
(17, 'users', '69', 0, 'Cuong', 0),
(18, 'users', '70', 0, 'test2', 0),
(19, 'users', '71', 0, 'Kim Hau', 0),
(20, 'users', '72', 0, 'DFI', 0),
(21, 'users', '73', 0, 'Tran Duy Loc', 0),
(22, 'users', '74', 0, 'Kim Tran', 0),
(23, 'users', '75', 0, 'sdf', 0),
(24, 'users', '76', 0, 'sdf', 0),
(25, 'users', '77', 0, 'DFI Administrator', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_core_acl_aro_groups`
--

CREATE TABLE IF NOT EXISTS `jos_core_acl_aro_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `lft` int(11) NOT NULL DEFAULT '0',
  `rgt` int(11) NOT NULL DEFAULT '0',
  `value` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `jos_gacl_parent_id_aro_groups` (`parent_id`),
  KEY `jos_gacl_lft_rgt_aro_groups` (`lft`,`rgt`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `jos_core_acl_aro_groups`
--

INSERT INTO `jos_core_acl_aro_groups` (`id`, `parent_id`, `name`, `lft`, `rgt`, `value`) VALUES
(17, 0, 'ROOT', 1, 22, 'ROOT'),
(28, 17, 'USERS', 2, 21, 'USERS'),
(29, 28, 'Public Frontend', 3, 12, 'Public Frontend'),
(18, 29, 'Registered', 4, 11, 'Registered'),
(19, 18, 'Author', 5, 10, 'Author'),
(20, 19, 'Editor', 6, 9, 'Editor'),
(21, 20, 'Publisher', 7, 8, 'Publisher'),
(30, 28, 'Public Backend', 13, 20, 'Public Backend'),
(23, 30, 'Manager', 14, 19, 'Manager'),
(24, 23, 'Administrator', 15, 18, 'Administrator'),
(25, 24, 'Super Administrator', 16, 17, 'Super Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `jos_core_acl_aro_map`
--

CREATE TABLE IF NOT EXISTS `jos_core_acl_aro_map` (
  `acl_id` int(11) NOT NULL DEFAULT '0',
  `section_value` varchar(230) NOT NULL DEFAULT '0',
  `value` varchar(100) NOT NULL,
  PRIMARY KEY (`acl_id`,`section_value`,`value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_core_acl_aro_map`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_core_acl_aro_sections`
--

CREATE TABLE IF NOT EXISTS `jos_core_acl_aro_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(230) NOT NULL DEFAULT '',
  `order_value` int(11) NOT NULL DEFAULT '0',
  `name` varchar(230) NOT NULL DEFAULT '',
  `hidden` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `jos_gacl_value_aro_sections` (`value`),
  KEY `jos_gacl_hidden_aro_sections` (`hidden`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `jos_core_acl_aro_sections`
--

INSERT INTO `jos_core_acl_aro_sections` (`id`, `value`, `order_value`, `name`, `hidden`) VALUES
(10, 'users', 1, 'Users', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_core_acl_groups_aro_map`
--

CREATE TABLE IF NOT EXISTS `jos_core_acl_groups_aro_map` (
  `group_id` int(11) NOT NULL DEFAULT '0',
  `section_value` varchar(240) NOT NULL DEFAULT '',
  `aro_id` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `group_id_aro_id_groups_aro_map` (`group_id`,`section_value`,`aro_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_core_acl_groups_aro_map`
--

INSERT INTO `jos_core_acl_groups_aro_map` (`group_id`, `section_value`, `aro_id`) VALUES
(18, '', 11),
(18, '', 18),
(18, '', 19),
(18, '', 21),
(18, '', 22),
(18, '', 23),
(18, '', 24),
(23, '', 25),
(25, '', 10),
(25, '', 17),
(25, '', 20);

-- --------------------------------------------------------

--
-- Table structure for table `jos_core_log_items`
--

CREATE TABLE IF NOT EXISTS `jos_core_log_items` (
  `time_stamp` date NOT NULL DEFAULT '0000-00-00',
  `item_table` varchar(50) NOT NULL DEFAULT '',
  `item_id` int(11) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_core_log_items`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_core_log_searches`
--

CREATE TABLE IF NOT EXISTS `jos_core_log_searches` (
  `search_term` varchar(128) NOT NULL DEFAULT '',
  `hits` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_core_log_searches`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_dfi_campaigns`
--

CREATE TABLE IF NOT EXISTS `jos_dfi_campaigns` (
  `dfi_campaign_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `published` tinyint(1) DEFAULT '1',
  `ordering` int(11) DEFAULT NULL,
  `description` text,
  `published_date` date DEFAULT NULL,
  `unpublished_date` date DEFAULT NULL,
  PRIMARY KEY (`dfi_campaign_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `jos_dfi_campaigns`
--

INSERT INTO `jos_dfi_campaigns` (`dfi_campaign_id`, `name`, `created`, `modified`, `published`, `ordering`, `description`, `published_date`, `unpublished_date`) VALUES
(1, 'Kampagne 12-2010', '2010-09-21 10:36:44', '2011-04-04 08:58:04', 1, 2, 'Dette er en prøve', '2010-11-13', '2010-12-24'),
(2, 'Kampagne 11-2010', '2010-09-21 10:37:57', '2011-04-04 08:58:27', 1, 1, 'Test - test', '2010-10-30', '2010-11-07'),
(3, 'Kampagne 13-2010', '2010-09-21 10:38:47', '2010-09-21 10:38:47', 1, 3, '', '2010-11-27', '2010-12-24'),
(4, 'Kampagne 14-2010', '2010-09-21 10:39:20', '2010-09-21 10:39:20', 1, 4, '', '2010-12-04', '2010-09-24'),
(5, 'Kampagne 12-2011', '2011-03-28 08:13:21', '2011-03-30 09:08:02', 1, 5, '', '2011-03-12', '2011-12-24'),
(6, 'Kampagne 10-2011', '2011-04-12 08:44:35', '2011-04-12 08:45:06', 1, 6, 'Fødselsdagsavis', '2011-10-01', '2011-10-15'),
(7, 'Kampagne 11-2011', '2011-06-09 07:26:49', '2011-06-09 07:26:49', 0, 7, '<html />', '2011-10-29', '2011-11-12'),
(8, 'Avis 12 2011', '2011-06-09 09:23:33', '2011-06-09 09:23:33', 1, 8, '', '2011-06-09', '0000-00-00'),
(9, 'Kamp 10,5 2011', '2011-07-01 10:52:58', '2011-07-01 10:54:04', 1, 9, '', '2011-10-03', '2011-10-11'),
(10, 'Avis 3-2012', '2011-11-07 08:03:17', '2011-11-07 08:03:17', 1, 10, '', '2011-11-07', '0000-00-00'),
(11, 'Avis 4-2012', '2011-11-07 08:21:00', '2011-11-07 08:21:00', 1, 11, '', '2011-11-07', '0000-00-00'),
(12, 'Avis 5-2012', '2011-11-07 08:23:11', '2011-11-07 08:23:11', 1, 12, '', '2011-11-07', '0000-00-00'),
(13, 'Kampagne 4712', '2011-11-21 13:01:54', '2011-11-21 13:01:54', 1, 13, '', '2012-02-07', '2012-02-14'),
(15, 'Januar 2012', '2012-01-10 10:29:22', '2012-01-10 10:29:22', 1, 14, '<html />', '2012-01-17', '2012-01-31'),
(16, 'Februar 2012', '2012-01-10 10:37:48', '2012-01-10 10:37:48', 1, 15, '<html />', '2012-02-07', '2012-02-28'),
(17, 'Avis 6 - 2012', '2012-02-16 11:53:04', '2012-02-16 11:53:04', 1, 16, '<html />', '2012-06-11', '2012-06-25'),
(18, 'Avis 7 - 2012', '2012-02-16 12:14:37', '2012-02-16 12:14:37', 1, 17, '<html />', '2012-07-09', '2012-07-30'),
(19, 'Avis 8 - 2012', '2012-02-16 12:18:28', '2012-02-16 12:18:28', 1, 18, '<html />', '2012-08-13', '2012-08-27');

-- --------------------------------------------------------

--
-- Table structure for table `jos_dfi_campaign_products`
--

CREATE TABLE IF NOT EXISTS `jos_dfi_campaign_products` (
  `dfi_campaign_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `dfi_product_id` int(11) DEFAULT NULL,
  `dfi_campaign_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`dfi_campaign_product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `jos_dfi_campaign_products`
--

INSERT INTO `jos_dfi_campaign_products` (`dfi_campaign_product_id`, `dfi_product_id`, `dfi_campaign_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jos_dfi_campaign_to_products`
--

CREATE TABLE IF NOT EXISTS `jos_dfi_campaign_to_products` (
  `dfi_campaign_to_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `dfi_product_id` int(11) DEFAULT NULL,
  `dfi_campaign_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`dfi_campaign_to_product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=223 ;

--
-- Dumping data for table `jos_dfi_campaign_to_products`
--

INSERT INTO `jos_dfi_campaign_to_products` (`dfi_campaign_to_product_id`, `dfi_product_id`, `dfi_campaign_id`) VALUES
(186, 28, 15),
(122, 10, 2),
(121, 11, 2),
(127, 16, 1),
(119, 19, 2),
(117, 30, 1),
(115, 29, 9),
(164, 29, 13),
(108, 26, 7),
(107, 25, 7),
(106, 24, 7),
(105, 23, 7),
(104, 22, 7),
(160, 35, 13),
(112, 20, 7),
(17, 3, 2),
(18, 3, 1),
(19, 3, 3),
(20, 3, 4),
(21, 4, 4),
(22, 5, 4),
(23, 7, 5),
(92, 11, 6),
(90, 8, 6),
(89, 8, 5),
(83, 19, 5),
(80, 18, 4),
(88, 8, 4),
(167, 9, 12),
(58, 10, 5),
(91, 11, 5),
(60, 12, 5),
(188, 37, 11),
(126, 16, 2),
(87, 8, 3),
(79, 17, 6),
(77, 17, 4),
(184, 36, 15),
(78, 17, 5),
(70, 1, 2),
(181, 15, 15),
(183, 14, 15),
(212, 38, 12),
(128, 16, 6),
(165, 31, 8),
(180, 15, 16),
(196, 39, 12),
(166, 21, 13),
(216, 34, 12),
(176, 32, 15),
(144, 26, 1),
(161, 33, 13),
(179, 13, 15),
(182, 14, 16),
(175, 32, 16),
(185, 28, 16),
(221, 49, 18),
(197, 40, 12),
(192, 41, 11),
(193, 42, 11),
(194, 43, 11),
(195, 44, 11),
(198, 40, 11),
(199, 39, 11),
(204, 45, 12),
(205, 46, 12),
(206, 47, 12),
(207, 48, 12),
(208, 48, 11),
(209, 47, 11),
(210, 46, 11),
(211, 45, 11),
(213, 38, 11),
(215, 34, 11),
(218, 27, 17),
(222, 49, 19);

-- --------------------------------------------------------

--
-- Table structure for table `jos_dfi_catalogs`
--

CREATE TABLE IF NOT EXISTS `jos_dfi_catalogs` (
  `dfi_catalog_id` int(11) NOT NULL AUTO_INCREMENT,
  `catid` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `description` text,
  `published` tinyint(1) DEFAULT '1',
  `ordering` int(11) DEFAULT NULL,
  PRIMARY KEY (`dfi_catalog_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `jos_dfi_catalogs`
--

INSERT INTO `jos_dfi_catalogs` (`dfi_catalog_id`, `catid`, `title`, `filename`, `description`, `published`, `ordering`) VALUES
(1, 1, 'test', 'images/catalog/1.jpg', '', 1, 2),
(2, 1, 'test', 'images/catalog/2.jpg', '', 1, 3),
(3, 1, 'test', 'images/rokquickcart/3.jpg', '', 1, 4),
(4, 1, 'test', 'images/rokquickcart/4.jpg', '', 1, 5),
(5, 1, 'test', 'images/rokquickcart/5.jpg', '', 1, 6),
(6, 1, 'test', 'images/catalog/6.jpg', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jos_dfi_client_pris`
--

CREATE TABLE IF NOT EXISTS `jos_dfi_client_pris` (
  `id` int(11) NOT NULL DEFAULT '0',
  `shop_id` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `jan` float DEFAULT NULL,
  `feb` float DEFAULT NULL,
  `mar` float DEFAULT NULL,
  `apr` float DEFAULT NULL,
  `may` float DEFAULT NULL,
  `jun` float DEFAULT NULL,
  `july` float DEFAULT NULL,
  `aug` float DEFAULT NULL,
  `sep` float DEFAULT NULL,
  `otc` float DEFAULT NULL,
  `nov` float DEFAULT NULL,
  `dece` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_dfi_client_pris`
--

INSERT INTO `jos_dfi_client_pris` (`id`, `shop_id`, `year`, `jan`, `feb`, `mar`, `apr`, `may`, `jun`, `july`, `aug`, `sep`, `otc`, `nov`, `dece`) VALUES
(1, 44, 2011, 12, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_dfi_client_products`
--

CREATE TABLE IF NOT EXISTS `jos_dfi_client_products` (
  `dfi_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `dfi_shop_id` int(11) DEFAULT NULL,
  `ean_kode` varchar(255) DEFAULT NULL,
  `serial_number` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `hvidpris` float DEFAULT '0',
  `rodpris` float DEFAULT '0',
  `nettopris` float DEFAULT '0',
  `wee` float DEFAULT NULL,
  `kolli` text,
  `nupris` float DEFAULT '0',
  PRIMARY KEY (`dfi_product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `jos_dfi_client_products`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_dfi_distribution_rates`
--

CREATE TABLE IF NOT EXISTS `jos_dfi_distribution_rates` (
  `dfi_distribution_rate_id` int(11) NOT NULL AUTO_INCREMENT,
  `dfi_kobeark_product_id` int(11) DEFAULT NULL,
  `dfi_shop_id` int(11) DEFAULT NULL,
  `rate` float DEFAULT NULL,
  PRIMARY KEY (`dfi_distribution_rate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jos_dfi_distribution_rates`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_dfi_kobreaks`
--

CREATE TABLE IF NOT EXISTS `jos_dfi_kobreaks` (
  `dfi_kobreak_id` int(11) NOT NULL AUTO_INCREMENT,
  `dfi_supplier_id` int(11) DEFAULT NULL,
  `lev_uge` varchar(255) DEFAULT NULL,
  `val_uge` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `lev_betingelse` varchar(255) DEFAULT NULL,
  `ann_tilskud` varchar(255) DEFAULT NULL,
  `franko` varchar(255) DEFAULT NULL,
  `description` text,
  `published` tinyint(1) DEFAULT '1',
  `name` varchar(255) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `svarfrist` datetime DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `dfi_campaign_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `check_ok` int(1) NOT NULL,
  PRIMARY KEY (`dfi_kobreak_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `jos_dfi_kobreaks`
--

INSERT INTO `jos_dfi_kobreaks` (`dfi_kobreak_id`, `dfi_supplier_id`, `lev_uge`, `val_uge`, `created`, `lev_betingelse`, `ann_tilskud`, `franko`, `description`, `published`, `name`, `modified`, `svarfrist`, `ordering`, `dfi_campaign_id`, `status`, `check_ok`) VALUES
(1, 2, '52', '', '2010-09-21 10:32:22', 'Løbende uge + 35 dage', '', '', '', 0, 'OBHElkedel6450', '2011-03-28 08:48:58', '2011-03-25 10:00:00', 2, 2, 1, 0),
(2, 2, '52', '', '2010-09-21 10:32:22', 'Løbende uge + 35 dage', '', '', '', 1, 'Copy of OBHElkedel6450', '2011-03-28 08:41:15', '0000-00-00 00:00:00', 2, 2, 1, 1),
(3, 2, 'erer', 'ewrewr', '2011-01-28 07:46:55', NULL, 'ewrew', '', 'rewr', 1, 'Test', '2011-01-28 07:47:11', NULL, 3, 2, 1, 0),
(4, 2, '12', '16', '2011-02-24 12:14:28', NULL, '', '', '', 1, 'Hva', '2011-02-24 12:15:13', NULL, 4, 4, 1, 0),
(5, 2, '43', '52', '2011-03-28 08:18:55', NULL, '', '', '', 1, 'OBH-12-2011', '2011-03-28 08:18:55', '2011-04-20 10:15:00', 2, 5, 1, 0),
(6, 2, '43', '12', '2011-03-28 08:22:41', NULL, '', '', '', 0, 'OBH - 12-2011', '2011-03-28 08:22:41', '2011-10-11 10:22:04', 2, 5, 1, 0),
(7, 2, '43', '52', '2011-03-28 08:25:13', NULL, '', '', '', 1, 'sjov', '2011-03-29 10:45:42', '1999-11-29 10:00:00', 3, 5, 1, 0),
(8, 2, '52', '', '2011-03-28 08:30:47', NULL, '', '', '', 1, 'dddd', '2011-03-28 08:30:47', '0000-00-00 00:00:00', 4, 5, 1, 0),
(9, 9, '43', '52', '2011-03-28 08:31:39', NULL, '', '', '', 1, 'ole', '2011-03-28 08:31:39', '0000-00-00 00:00:00', 1, 1, 1, 0),
(10, 9, '', '', '2011-03-28 08:48:40', NULL, '', '', '', 1, 'hv', '2011-03-28 08:48:40', '2011-03-22 11:00:00', 1, 2, 1, 0),
(11, 2, '43', '52', '2011-03-30 06:30:42', NULL, '', '', '', 1, 'OBHSupremeNonstickA12-2011', '2011-03-31 12:19:37', '2011-04-11 10:00:00', 1, 5, 1, 0),
(12, 2, 'uge 37', 'uge 41', '2011-04-12 08:58:16', NULL, '', '', '', 1, 'OBH - test - 12042011', '2011-06-09 09:03:33', '1999-11-30 00:00:00', 1, 6, 1, 0),
(13, 2, '44', '52', '2011-05-06 07:17:23', NULL, '', '', '', 0, 'Avis 44', '2011-05-18 08:37:41', '1999-11-30 00:00:00', 5, 5, 1, 0),
(14, 9, '41', '', '2011-06-09 07:09:06', NULL, '', '', '<html />', 1, 'CondorConzeptkniveA11+13+1', '2011-06-09 07:09:06', '0000-00-00 00:00:00', 2, 2, 1, 0),
(15, 9, '41', '', '2011-06-09 07:25:03', NULL, '', '', '<html />', 0, 'CondorKniveA11+13+1-2011', '2011-06-09 07:38:12', '2011-06-10 10:00:00', 3, 2, 1, 0),
(17, 2, '', '', '2011-07-01 10:49:10', NULL, '', '', '', 0, 'Avis 9 2011', '2011-07-01 10:49:10', '0000-00-00 00:00:00', 1, 7, 0, 0),
(18, 2, '38', '50', '2011-07-01 10:55:34', NULL, '', '', '', 0, 'Tilbud 10,5 - 2011', '2011-07-01 10:55:34', '0000-00-00 00:00:00', 1, 9, 0, 0),
(19, 2, '', '', '2011-07-01 10:56:53', NULL, '', '', '', 0, 'Tilbud 10,5 - 2011', '2011-07-01 10:56:53', '0000-00-00 00:00:00', 2, 9, 0, 0),
(20, 2, '38', '52', '2011-07-01 11:00:24', NULL, '', '', '', 1, 'Tilbud 10', '2011-07-01 11:00:24', '0000-00-00 00:00:00', 3, 9, 0, 0),
(21, 2, '38', '52', '2011-07-01 11:01:58', NULL, '', '', '', 1, 'Tilbud 10,5', '2011-07-01 11:01:58', '0000-00-00 00:00:00', 4, 9, 0, 0),
(22, 32, '38', '52', '2011-07-01 11:06:48', NULL, '', '', '', 1, 'Tilbud 10,5', '2011-07-01 11:06:48', '0000-00-00 00:00:00', 1, 9, 0, 0),
(23, 32, '38', '52', '2011-07-01 11:08:48', NULL, '', '', '', 0, 'Tilbud 10,5,1', '2011-07-01 11:53:40', '1999-11-30 00:00:00', 2, 9, 1, 0),
(24, 32, '52', '', '2011-08-16 13:32:32', NULL, '', '', '', 0, 'Avis 4711', '2011-08-16 13:32:32', '0000-00-00 00:00:00', 1, 2, 1, 0),
(25, 32, '', '', '2011-09-01 10:15:10', NULL, '', '', '', 0, 'Test Hva', '2011-09-01 10:15:10', '0000-00-00 00:00:00', 1, 8, 1, 0),
(26, 30, '52', '4', '2011-09-28 07:18:56', NULL, '', '', '<html />', 1, 'Henrik', '2011-09-28 07:54:36', '1999-11-30 00:00:00', 2, 6, 1, 0),
(27, 32, '45', '52', '2011-11-01 08:31:06', NULL, '', '', '<html />', 1, 'CondorConzeptElkedelA12-2011', '2011-11-01 08:50:39', '1999-11-30 00:00:00', 1, 1, 1, 0),
(28, 32, '7', '', '2011-11-07 08:04:17', NULL, '', '', '', 1, 'Condor 3-2012', '2011-11-07 08:04:17', '0000-00-00 00:00:00', 1, 10, 1, 0),
(29, 32, '9', '', '2011-11-07 08:21:39', NULL, '', '', '', 1, 'Concorde 4-2012', '2011-11-07 08:50:23', '1999-11-30 00:00:00', 1, 11, 1, 1),
(30, 32, '12', '', '2011-11-07 08:52:14', NULL, '', '', '', 1, 'Concorde 5-2012', '2011-11-07 09:11:22', '1999-11-30 00:00:00', 4, 12, 1, 0),
(31, 32, '116', '', '2011-11-21 13:02:51', NULL, '', '', '', 1, 'Avis 4712', '2011-11-21 13:39:20', '1999-11-30 00:00:00', 1, 13, 1, 0),
(32, 32, '', '', '2011-12-21 14:06:21', NULL, '', '', '', 1, 'avis hva', '2011-12-21 15:10:34', '1999-11-30 00:00:00', 2, 10, 3, 1),
(34, 32, '3', '9', '2012-01-10 10:30:14', NULL, '', '', '<html />', 1, 'Januar 2012 - Condor', '2012-01-10 11:02:02', '1999-11-30 00:00:00', 1, 15, 1, 1),
(35, 2, '3', '9', '2012-01-10 11:10:59', NULL, '', '', '<html />', 1, 'Januar 2012 OBH', '2012-01-10 11:22:08', '1999-11-30 00:00:00', 1, 15, 3, 1),
(36, 26, '3', '9', '2012-01-10 11:28:28', NULL, '', '', '<html />', 1, 'Januar 2012 Adexi', '2012-01-10 11:42:39', '1999-11-30 00:00:00', 1, 15, 3, 1),
(37, 4, '11', '19', '2012-02-13 07:16:13', NULL, '', '', '<html />', 1, 'F&HA4-2012', '2012-02-13 07:51:34', '1999-11-30 00:00:00', 1, 11, 3, 1),
(38, 21, '11', '', '2012-02-13 07:36:25', NULL, '', '', '<html />', 1, 'HammarplastA4+5-2012', '2012-02-13 09:56:18', '1999-11-30 00:00:00', 4, 11, 3, 1),
(39, 32, '11', '', '2012-02-13 09:22:53', NULL, '', '', '<html />', 1, 'Nyt Købeark', '2012-02-21 13:35:44', '2012-02-23 00:00:00', 2, 11, 2, 1),
(40, 32, '', '', '2012-02-13 09:51:23', NULL, '', '', '<html />', 0, '123456', '2012-02-13 09:51:23', '0000-00-00 00:00:00', 3, 11, 1, 1),
(41, 32, '11', '', '2012-02-13 10:02:47', NULL, '', '', '<html />', 1, '9999999999', '2012-02-13 10:05:25', '1999-11-30 00:00:00', 5, 12, 1, 0),
(42, 32, '21', '', '2012-02-16 11:54:38', NULL, '', '', '<html />', 1, 'Condor 6/12', '2012-02-16 11:58:27', '1999-11-30 00:00:00', 2, 17, 1, 1),
(43, 1, '20', '', '2012-02-16 12:17:51', NULL, '', '', '<html />', 0, 'Scanpan 7/12', '2012-02-16 12:44:26', '1999-11-30 00:00:00', 1, 18, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_dfi_kobreak_products`
--

CREATE TABLE IF NOT EXISTS `jos_dfi_kobreak_products` (
  `dfi_kobreak_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `dfi_product_id` int(11) DEFAULT NULL,
  `dfi_kobreak_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT '0',
  `hvidpris` float DEFAULT '0',
  `nettopris` float DEFAULT '0',
  `rodpris` float DEFAULT '0',
  `nupris` float DEFAULT '0',
  PRIMARY KEY (`dfi_kobreak_product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=99 ;

--
-- Dumping data for table `jos_dfi_kobreak_products`
--

INSERT INTO `jos_dfi_kobreak_products` (`dfi_kobreak_product_id`, `dfi_product_id`, `dfi_kobreak_id`, `quantity`, `hvidpris`, `nettopris`, `rodpris`, `nupris`) VALUES
(1, 1, 1, 3000, 349.95, 119, 299.95, 299.95),
(2, 1, 2, 3000, 349.95, 12, 299.95, 199.95),
(3, 1, 3, 3000, 349.95, 12, 299.95, 299.95),
(4, 3, 3, 12, 133, 123, 2323, 2323),
(5, 7, 5, 0, 999, 250, 499, 399),
(6, 7, 7, 0, 999, 0.5, 499, 499),
(7, 8, 11, 0, 849.95, 0, 849.95, 849.95),
(8, 9, 11, 0, 399.95, 132, 399.95, 399.95),
(9, 10, 11, 0, 499.95, 0, 499.95, 299.95),
(10, 11, 11, 0, 599.95, 0, 599.95, 599.95),
(11, 12, 11, 0, 549.95, 0, 549.95, 549.95),
(12, 13, 11, 0, 599.95, 0, 599.95, 599.95),
(13, 14, 11, 0, 699.95, 0, 699.95, 699.95),
(14, 15, 11, 0, 799.95, 0, 799.95, 799.95),
(15, 16, 12, 0, 99.95, 25, 79.95, 79.95),
(16, 28, 23, 0, 24.95, 12, 29.95, 29.95),
(17, 29, 23, 0, 49.95, 10, 39, 39),
(18, 19, 3, 0, 620, 0, 580, 11),
(19, 16, 3, 0, 99.95, 0, 79.95, 10),
(20, 11, 3, 0, 599.95, 0, 599.95, 599.95),
(21, 10, 3, 0, 499.95, 0, 499.95, 499.95),
(22, 14, 3, 0, 699.95, 0, 699.95, 699.95),
(23, 15, 3, 0, 799.95, 0, 799.95, 799.95),
(24, 13, 3, 0, 599.95, 0, 599.95, 599.95),
(25, 29, 25, 0, 49.95, 10, 39.95, 29.95),
(26, 27, 25, 0, 39.95, 12.95, 34.95, 29.95),
(34, 34, 27, 0, 199.95, 59, 149.95, 99.95),
(33, 35, 27, 0, 199.95, 59, 149.95, 99.95),
(32, 30, 27, 0, 39.95, 0, 34.95, 34.95),
(31, 16, 27, 0, 99.95, 0, 79.95, 79.95),
(35, 33, 27, 0, 199.95, 59, 149.95, 99.95),
(36, 32, 27, 0, 199.95, 52, 149.95, 99.95),
(37, 26, 27, 1000, 149.95, 26, 99.95, 99.95),
(38, 34, 28, 0, 199.95, 59, 149.95, 99.95),
(39, 32, 28, 0, 199.95, 52, 149.95, 99.95),
(40, 27, 28, 0, 39.95, 12.95, 34.95, 29.95),
(41, 35, 29, 0, 199.95, 0, 149.95, 149.95),
(42, 34, 29, 0, 199.95, 0, 149.95, 149.95),
(43, 33, 29, 0, 199.95, 0, 149.95, 149.95),
(44, 32, 29, 0, 199.95, 0, 149.95, 149.95),
(45, 31, 29, 0, 0, 0, 0, 0),
(46, 21, 29, 1000, 149.95, 0, 99.95, 99.95),
(48, 32, 30, 0, 499.95, 0, 399.95, 12),
(49, 33, 30, 0, 199.95, 0, 149.95, 149.95),
(51, 21, 30, 1000, 399.95, 0, 249.95, 249.95),
(55, 29, 31, 0, 400, 0, 400, 400),
(54, 28, 31, 0, 24.95, 0, 29.95, 21.95),
(56, 27, 32, 10000, 45, 0, 45, 45),
(57, 28, 32, 0, 24.95, 0, 29.95, 29.95),
(63, 32, 34, 0, 199.95, 0, 149.95, 500.95),
(62, 28, 34, 0, 24.95, 0, 29.95, 29.95),
(61, 27, 34, 1000, 39.95, 0, 34.95, 34.95),
(68, 15, 35, 0, 799.95, 264, 799.95, 799.95),
(69, 14, 35, 0, 699.95, 231, 699.95, 699.95),
(66, 13, 35, 0, 599.95, 198, 599.95, 599.95),
(70, 36, 36, 0, 200, 60, 159, 159),
(71, 40, 37, 0, 149.95, 50, 149.95, 149.95),
(72, 39, 37, 0, 149.95, 50, 149.95, 149.95),
(73, 38, 37, 0, 249.95, 67.5, 199.95, 199.95),
(74, 41, 37, 0, 549.95, 149.95, 399.95, 399.95),
(75, 42, 37, 0, 549.95, 149.95, 399.95, 399.95),
(76, 43, 37, 0, 549.95, 149.95, 399.95, 399.95),
(77, 44, 37, 0, 549.95, 149.95, 399.95, 399.95),
(79, 37, 37, 0, 349.95, 135, 349.95, 349.95),
(80, 45, 38, 0, 29.95, 10.22, 29.95, 29.95),
(81, 46, 38, 0, 34.95, 12.66, 34.95, 34.95),
(82, 47, 38, 0, 39.95, 13.72, 39.95, 39.95),
(83, 48, 38, 0, 49.95, 15.13, 49.95, 49.95),
(84, 34, 40, 0, 0, 0, 0, 0),
(86, 34, 41, 1000, 199.95, 59, 149.95, 149.95),
(87, 27, 42, 0, 39.95, 0, 34.95, 24.95),
(88, 49, 43, 0, 149.95, 49.95, 139.95, 139.95),
(89, 34, 39, 1000, 199.95, 0, 149.95, 149.95),
(90, 37, 39, 0, 349.95, 0, 349.95, 349.95),
(91, 38, 39, 0, 249.95, 0, 199.95, 199.95),
(92, 39, 39, 0, 149.95, 0, 149.95, 149.95),
(93, 40, 39, 0, 149.95, 0, 149.95, 149.95),
(94, 41, 39, 0, 549.95, 0, 399.95, 399.95),
(95, 42, 39, 0, 549.95, 0, 399.95, 399.95),
(96, 43, 39, 0, 549.95, 0, 399.95, 399.95),
(97, 44, 39, 0, 549.95, 0, 399.95, 399.95),
(98, 45, 39, 0, 29.95, 0, 29.95, 29.95);

-- --------------------------------------------------------

--
-- Table structure for table `jos_dfi_maps`
--

CREATE TABLE IF NOT EXISTS `jos_dfi_maps` (
  `dfi_map_id` int(11) NOT NULL AUTO_INCREMENT,
  `dfi_shop_id` int(11) DEFAULT NULL,
  `x_value` float DEFAULT NULL,
  `y_value` float DEFAULT NULL,
  PRIMARY KEY (`dfi_map_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `jos_dfi_maps`
--

INSERT INTO `jos_dfi_maps` (`dfi_map_id`, `dfi_shop_id`, `x_value`, `y_value`) VALUES
(1, 6, 124, 16),
(2, 29, 180, 44),
(3, 21, 191, 41),
(4, 10, 95, 94),
(5, 30, 136, 112),
(6, 20, 136, 161),
(7, 26, 161, 179),
(8, 33, 165, 204),
(9, 22, 222, 228),
(10, 25, 216, 203),
(11, 31, 197, 181),
(12, 15, 187, 158),
(13, 27, 208, 177),
(14, 23, 207, 142),
(15, 3, 203, 152),
(16, 11, 251, 122),
(17, 8, 236, 123),
(18, 13, 246, 142),
(19, 9, 240, 148),
(20, 7, 224, 152),
(21, 32, 231, 158);

-- --------------------------------------------------------

--
-- Table structure for table `jos_dfi_members`
--

CREATE TABLE IF NOT EXISTS `jos_dfi_members` (
  `dfi_member_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `dfi_shop_id` int(11) DEFAULT NULL,
  `role` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`dfi_member_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `jos_dfi_members`
--

INSERT INTO `jos_dfi_members` (`dfi_member_id`, `user_id`, `dfi_shop_id`, `role`) VALUES
(1, 62, 35, 1),
(2, 70, 42, 0),
(3, 71, 43, 1),
(4, 63, 42, 0),
(5, 72, 44, 1),
(6, 73, 45, 1),
(7, 74, 46, 1),
(8, 69, 10, 1),
(9, 75, 47, 1),
(10, 76, 48, 1),
(11, 77, 28, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_dfi_orders`
--

CREATE TABLE IF NOT EXISTS `jos_dfi_orders` (
  `dfi_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `dfi_shop_id` int(11) DEFAULT NULL,
  `dfi_kobreak_id` int(11) DEFAULT NULL,
  `note` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `sent` datetime DEFAULT NULL,
  `dfi_order_status_id` int(11) DEFAULT NULL,
  `received` datetime DEFAULT NULL,
  PRIMARY KEY (`dfi_order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `jos_dfi_orders`
--

INSERT INTO `jos_dfi_orders` (`dfi_order_id`, `dfi_shop_id`, `dfi_kobreak_id`, `note`, `created`, `modified`, `sent`, `dfi_order_status_id`, `received`) VALUES
(1, 44, 1, '', '2010-11-04 10:21:33', '2010-11-04 10:21:33', '2010-12-10 08:52:50', 4, '1969-12-31 06:21:33'),
(2, 44, 2, '', '2010-12-22 10:17:32', '2010-12-22 10:17:32', '2011-12-08 07:28:05', 3, '1969-12-31 05:17:32'),
(3, 44, 3, '', '2011-01-28 07:47:47', '2011-01-28 07:47:47', NULL, 2, '1970-01-01 14:47:47'),
(4, 44, 11, '', '2011-04-12 08:42:31', '2011-04-12 08:42:31', '2011-04-12 08:50:24', 3, '1970-01-01 10:42:31'),
(5, 44, 12, '', '2011-04-12 09:10:22', '2011-04-12 09:10:22', '2011-04-12 09:11:14', 4, '1970-01-01 11:10:22'),
(6, 44, 13, '', '2011-05-09 06:34:18', '0000-00-00 00:00:00', NULL, 1, '1970-01-01 01:00:00'),
(7, 44, 23, '', '2011-07-01 11:51:16', '2011-07-01 11:51:16', '2011-07-01 11:55:40', 3, '1970-01-01 13:51:16'),
(8, 10, 3, '', NULL, NULL, NULL, 1, NULL),
(9, 10, 3, '', NULL, NULL, NULL, 1, NULL),
(10, 10, 3, '', NULL, NULL, NULL, 1, NULL),
(11, 44, 28, '', '2011-11-07 08:08:18', '2011-11-07 08:08:18', '2011-11-07 08:15:57', 3, '1970-01-01 09:08:18'),
(12, 44, 29, '', '2011-11-07 08:38:38', '2011-11-07 08:38:38', '2011-11-07 08:40:21', 3, '1970-01-01 09:38:38'),
(13, 44, 32, '', '2011-12-21 15:03:41', '2011-12-21 15:03:41', '2011-12-21 15:05:13', 4, '1970-01-01 16:03:41'),
(14, 44, 34, '', '2012-01-10 10:49:21', '2012-01-10 10:49:21', '2012-01-10 11:23:40', 3, '1970-01-01 11:49:21'),
(15, 44, 35, '', '2012-01-10 11:19:45', '2012-01-10 11:19:45', '2012-01-10 11:21:17', 3, '1970-01-01 12:19:45'),
(16, 44, 36, '', '2012-01-10 11:30:57', '2012-01-10 11:30:57', '2012-01-10 11:36:21', 4, '1970-01-01 12:30:57'),
(17, 44, 37, '', '2012-02-13 07:45:54', '2012-02-13 07:45:54', '2012-02-13 07:50:55', 3, '1970-01-01 08:45:54'),
(18, 44, 38, '', '2012-02-13 07:47:08', '2012-02-13 07:47:08', '2012-02-13 07:51:20', 3, '1970-01-01 08:47:08'),
(19, 44, 41, '', '2012-02-13 10:05:46', '2012-02-13 10:05:46', NULL, 2, '1970-01-01 11:05:46'),
(20, 44, 42, '', '2012-02-16 11:59:25', '2012-02-16 11:59:25', NULL, 2, '1970-01-01 12:59:25'),
(21, 44, 39, '', '2012-02-21 13:37:38', '2012-02-21 13:37:38', NULL, 2, '1970-01-01 14:37:38');

-- --------------------------------------------------------

--
-- Table structure for table `jos_dfi_order_products`
--

CREATE TABLE IF NOT EXISTS `jos_dfi_order_products` (
  `dfi_order_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `dfi_order_id` int(11) DEFAULT NULL,
  `dfi_product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`dfi_order_product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `jos_dfi_order_products`
--

INSERT INTO `jos_dfi_order_products` (`dfi_order_product_id`, `dfi_order_id`, `dfi_product_id`, `quantity`) VALUES
(1, 1, 1, 24),
(2, 2, 1, 2400),
(3, 3, 1, 100),
(4, 3, 3, 0),
(5, 4, 13, 25),
(6, 4, 14, 26),
(7, 4, 15, 27),
(8, 4, 12, 28),
(9, 4, 9, 29),
(10, 4, 10, 30),
(11, 4, 11, 31),
(12, 4, 8, 50),
(13, 5, 16, 125),
(14, 7, 28, 125),
(15, 7, 29, 250),
(16, 8, 1, 200),
(17, 9, 15, 0),
(18, 9, 13, 0),
(19, 10, 15, 300),
(20, 10, 13, 400),
(21, 11, 34, 125),
(22, 11, 32, 250),
(23, 11, 27, 500),
(24, 12, 31, 0),
(25, 12, 33, 500),
(26, 12, 35, 0),
(27, 12, 34, 0),
(28, 12, 32, 0),
(29, 12, 21, 400),
(30, 13, 27, 100),
(31, 13, 28, 200),
(32, 14, 32, 240),
(33, 14, 27, 70),
(34, 14, 28, 48),
(35, 15, 13, 16),
(36, 15, 14, 16),
(37, 15, 15, 16),
(38, 16, 36, 3000),
(39, 17, 40, 6),
(40, 17, 39, 6),
(41, 17, 41, 8),
(42, 17, 43, 4),
(43, 17, 44, 0),
(44, 17, 42, 8),
(45, 17, 38, 6),
(46, 17, 37, 12),
(47, 18, 45, 30),
(48, 18, 46, 60),
(49, 18, 47, 30),
(50, 18, 48, 200),
(51, 19, 34, 70),
(52, 20, 27, 250),
(53, 21, 45, 150),
(54, 21, 34, 70),
(55, 21, 40, 150),
(56, 21, 39, 150),
(57, 21, 41, 150),
(58, 21, 43, 150),
(59, 21, 44, 150),
(60, 21, 42, 15),
(61, 21, 38, 150),
(62, 21, 37, 150);

-- --------------------------------------------------------

--
-- Table structure for table `jos_dfi_order_product_folders`
--

CREATE TABLE IF NOT EXISTS `jos_dfi_order_product_folders` (
  `dfi_order_product_folder_id` int(11) NOT NULL AUTO_INCREMENT,
  `dfi_order_product_id` int(11) DEFAULT NULL,
  `dfi_campaign_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`dfi_order_product_folder_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jos_dfi_order_product_folders`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_dfi_order_statuses`
--

CREATE TABLE IF NOT EXISTS `jos_dfi_order_statuses` (
  `dfi_order_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  PRIMARY KEY (`dfi_order_status_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `jos_dfi_order_statuses`
--

INSERT INTO `jos_dfi_order_statuses` (`dfi_order_status_id`, `name`, `ordering`) VALUES
(1, 'Ny', 1),
(2, 'Sendt tll Shop', 3),
(3, 'Sendt til leverandær', 4);

-- --------------------------------------------------------

--
-- Table structure for table `jos_dfi_products`
--

CREATE TABLE IF NOT EXISTS `jos_dfi_products` (
  `dfi_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `dfi_supplier_id` int(11) DEFAULT NULL,
  `ean_kode` varchar(255) DEFAULT NULL,
  `serial_number` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `package_quantity` varchar(255) DEFAULT NULL,
  `hvidpris` float DEFAULT '0',
  `rodpris` float DEFAULT '0',
  `sortimentsnetto` float DEFAULT '0',
  `nettopris` float DEFAULT '0',
  `nupris` float DEFAULT '0',
  `wee` float NOT NULL DEFAULT '0',
  `range` tinyint(1) DEFAULT '1',
  `forced_distribution` tinyint(4) NOT NULL DEFAULT '0',
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`dfi_product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `jos_dfi_products`
--

INSERT INTO `jos_dfi_products` (`dfi_product_id`, `dfi_supplier_id`, `ean_kode`, `serial_number`, `product_name`, `package_quantity`, `hvidpris`, `rodpris`, `sortimentsnetto`, `nettopris`, `nupris`, `wee`, `range`, `forced_distribution`, `quantity`) VALUES
(1, 2, '5708642064385', '6450', 'OBH Nordica elkedel 1,7L stål/sort', '5', 349.95, 299.95, 1, 234, 199.95, 12, 1, 0, 3000),
(2, 4, '80756651', '4711', 'mentos', '6', 11.45, 9.95, NULL, 3.95, 0, 0, 1, 0, 0),
(4, 9, '57123456789', '091047', 'Balje', '25', 12.95, 9.95, NULL, 2.5, 10.95, 0, 1, 0, 0),
(5, 2, '57321654977', '471112', 'Badedyr', '12', 22.25, 19.95, NULL, 12.25, 17.95, 0, 1, 0, 0),
(6, 2, '574411223366557', '471113', 'Test Hva 0910', '6', 29.95, 27.95, NULL, 12.95, 24.95, 0, 1, 0, 0),
(7, 2, '5712365478925', 'hva 7892', 'Is maskine', '4', 999, 499, NULL, 250, 399, 0.5, 1, 0, 0),
(8, 2, '5708642081191', '8119', 'OBH Nordica Supreme non-stick sautepande 26 cm', '2', 849.95, 849.95, 320, 290, 599.95, 0, 1, 0, 0),
(9, 2, '5708642081207', '8120', 'OBH Nordica Supreme non-stick pande 20 cm', '4', 399.95, 399.95, 0, 132, 299.95, 0, 1, 0, 0),
(10, 2, '5708642081214', '8121', 'OBH Nordica Supreme non-stick pande 24 cm', '4', 499.95, 499.95, NULL, 165, 349.95, 0, 1, 0, 0),
(11, 2, '5708642081238', '8123', 'OBH Nordica Supreme non-stick pande 28 cm', '4', 599.95, 599.95, 0, 198, 449.95, 0, 1, 0, 0),
(12, 2, '5708642082211', '8221', 'OBH Nordica Supreme non-stick kasserolle 1,5 L', '4', 549.95, 549.95, NULL, 181, 399.95, 0, 1, 0, 0),
(13, 2, '5708642083195', '8319', 'OBH Nordica Supreme non-stick gryde 2 L', '4', 599.95, 599.95, NULL, 198, 449.95, 0, 1, 0, 0),
(14, 2, '5708642083201', '8320', 'OBH Nordica Supreme non-stick gryde 3 l', '4', 699.95, 699.95, 0, 231, 499.95, 0, 1, 0, 0),
(15, 2, '5708642083218', '8321', 'OBH Nordica Supreme non-stick gryde 5 l', '2', 799.95, 799.95, 0, 264, 599.95, 0, 1, 0, 0),
(16, 2, '5789654123', '5512', 'Badering', '12', 99.95, 79.95, 1, 25, 69.95, 0, 0, 0, 0),
(17, 9, '57987654321', '0910hva', 'Fødselsdag', '12', 149.95, 100, 0, 19.95, 70, 0, 1, 0, 0),
(18, 9, '', '', '', '', 69.5, 59.5, 22, 12.5, 45.95, 0, 1, 0, 0),
(19, 2, '4711213', '9955', 'Æble', '', 620, 580, 0, 360, 480, 0, 0, 0, 0),
(20, 9, '5705724015019', '1501', 'Conzept Kitchen kokkekniv 20 cm', '24', 149.95, 99.95, 0, 30, 99.95, 0, 0, 0, 1000),
(21, 32, '5705724015028', '1502', 'Conzept Kitchen brødkniv 20 cm', '24', 149.95, 99.95, 0, 26, 99.95, 0, 0, 0, 1000),
(22, 32, '5705724015037', '1503', 'Conzept Kitchen forskærerkniv 20 cm', '24', 149.95, 99.95, 0, 26, 99.95, 0, 0, 0, 1000),
(23, 32, '5705724015046', '1504', 'Conzept Kitchen santokukniv 18 cm', '24', 149.95, 99.95, 0, 30, 99.95, 0, 0, 0, 1000),
(24, 32, '5705724015055', '1505', 'Conzept Kitchen universalkniv 15 cm', '24', 99.95, 69.95, 0, 17, 69.95, 0, 0, 0, 1000),
(25, 32, '5705724015064', '1506', 'Conzept Kitchen urtekniv 9 cm', '24', 79.95, 49.95, 0, 15, 49.95, 0, 0, 0, 1000),
(26, 32, '5705724015073', '1507', 'Conzept Kitchen keramisk knivsliber', '24', 149.95, 99.95, 0, 26, 99.95, 0, 0, 0, 1000),
(27, 32, '5555555555555', '123456', 'Sodastream', '2', 39.95, 34.95, 14, 12.95, 29.95, 0, 1, 0, 0),
(28, 32, '1111111111111', '1245', 'Yok', '12', 24.95, 29.95, 0, 12.25, 22.95, 0, 0, 0, 0),
(29, 32, '22222222222', '32132', 'YokYok', '', 49.95, 39.95, 12, 10, 29.95, 0, 0, 0, 0),
(30, 32, '4545454545454', '111222', 'Test vare', '', 39.95, 34.95, 0, 12.95, 39.95, 0, 0, 0, 0),
(31, 32, 'aa', 'aa', 'a', '', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(32, 32, '5705724008664', '829', 'Conzept Electric elkedel stål 1,0 L', '6', 199.95, 149.95, 0, 52, 99.95, 0, 0, 0, 0),
(33, 32, '5705724011879', '1489', 'Conzept Electric elkedel hvid stål 1,0 L', '6', 199.95, 149.95, 0, 59, 99.95, 0, 0, 0, 0),
(34, 32, '5705724011886', '1490', 'Conzept Electric elkedel lime stål 1,0 L', '6', 199.95, 149.95, 0, 59, 99.95, 0, 0, 1, 1000),
(35, 32, '5705724011893', '1491', 'Conzept Electric elkedel lilla stål 1,0 L', '6', 199.95, 149.95, 0, 59, 99.95, 0, 0, 0, 0),
(36, 26, '87145464646464', '643159', 'Elkedel', '6', 200, 159, 0, 60, 129, 0, 0, 0, 0),
(37, 4, '4029466000061', '845563', 'Römertopf stegeso 5 kg.', '1', 349.95, 349.95, 135, 135, 299.95, 0, 1, 0, 0),
(38, 4, '4029466000153', '845576', 'Römertopf stegeso 2,5 kg.', '1', 249.95, 199.95, 69, 67.5, 149.95, 0, 1, 0, 0),
(39, 4, '5710234999012', '241503', 'Karkludstang Flex Sort', '6', 149.95, 149.95, 57, 50, 99.95, 0, 1, 0, 0),
(40, 4, '5710234999029', '241504', 'Karkludstang Flex Grå', '6', 149.95, 149.95, 57, 50, 99.95, 0, 1, 0, 0),
(41, 4, '8711269876696', '245042', 'Margrethe røreskåle 8 dele hvid', '4', 549.95, 399.95, 0, 149.95, 299.95, 0, 0, 0, 0),
(42, 4, '8711269876719', '245043', 'Margrethe røreskåle 8 dele sort', '4', 549.95, 399.95, 0, 149.95, 299.95, 0, 0, 0, 0),
(43, 4, '8711269880990', '245047', 'Margrethe røreskåle 8 dele lavendel', '4', 549.95, 399.95, 0, 149.95, 299.95, 0, 0, 0, 0),
(44, 4, '8711269881560', '245049', 'Margrethe røreskåle 8 dele rubin', '4', 549.95, 399.95, 0, 149.95, 299.95, 0, 0, 0, 0),
(45, 21, '7310542610012', '2610010', 'Altankasse 500 mm hvid', '30', 29.95, 29.95, 0, 10.22, 24.95, 0, 0, 0, 0),
(46, 21, '7310542611019', '2611010', 'Altankasse 700 mm hvid', '30', 34.95, 34.95, 0, 12.66, 29.95, 0, 0, 0, 0),
(47, 21, '7310542612016', '2612010', 'Altankasse 900 mm hvid', '30', 39.95, 39.95, 0, 13.72, 34.95, 0, 0, 0, 0),
(48, 21, '7310542640071', '2640070', 'Altankassebeslag 1 par galvaniseret', '40', 49.95, 49.95, 0, 15.13, 39.95, 0, 0, 0, 0),
(49, 1, '1234567896541', '666555444', 'Henrik Testvare', '', 149.95, 129.95, 0, 49.95, 99.95, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_dfi_reports`
--

CREATE TABLE IF NOT EXISTS `jos_dfi_reports` (
  `dfi_report_id` int(11) NOT NULL AUTO_INCREMENT,
  `dfi_shop_id` int(11) DEFAULT NULL,
  `dfi_product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `month` varchar(20) DEFAULT NULL,
  `year` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`dfi_report_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jos_dfi_reports`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_dfi_review_products`
--

CREATE TABLE IF NOT EXISTS `jos_dfi_review_products` (
  `dfi_review_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `dfi_product_id` int(11) DEFAULT NULL,
  `dfi_campaign_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`dfi_review_product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jos_dfi_review_products`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_dfi_shops`
--

CREATE TABLE IF NOT EXISTS `jos_dfi_shops` (
  `dfi_shop_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) DEFAULT NULL,
  `zipcode` varchar(10) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `butiksnr` varchar(100) DEFAULT '0',
  `published` tinyint(1) DEFAULT '1',
  `filename` varchar(255) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `description` text,
  `open_hour` text,
  `rate` float DEFAULT NULL,
  PRIMARY KEY (`dfi_shop_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `jos_dfi_shops`
--

INSERT INTO `jos_dfi_shops` (`dfi_shop_id`, `company_name`, `zipcode`, `city`, `street`, `telephone`, `fax`, `website`, `email`, `butiksnr`, `published`, `filename`, `ordering`, `description`, `open_hour`, `rate`) VALUES
(10, 'Test', '7500', 'Holstebro', 'Nørregade 60 Nørreport centret ', '97 42 64 55 ', '97 42 64 55', '', 'holstebroisenkram@mail.dk', '530', 1, '', 10, '', '', 3),
(9, 'Hillerød Isenkram', '3400 ', 'Hillerød', 'Frejasvej 32-38', '48 24 65 11 ', '48 28 65 56', '', 'hi@ekram.dk', '208', 1, '', 9, '', '', 3),
(3, 'Damborg Isenkram Asnæs', '4550 ', 'Asnæs', 'Asnæscentret 28 C', '59 64 32 64 ', '59 64 3 364', 'www.damborg.dk', 'dia@damborg.dk', '223', 1, '', 3, '', '', 2),
(4, 'Alstrøm Brønshøj', '2700', 'Brønshøj', 'Frederikssundsvej 314 - 316', '38 60 14 00 ', '38 60 14 05', 'www.alstrom.dk', 'bronshoj@alstrom.dk', '107', 1, '', 4, '', '', 3),
(5, 'Farum Isenkram ', '3520', 'Farum', 'Farum Bytorv 48', '44 95 66 67 ', '44 95 65 81', '', 'fa@ekram.dk', '101', 1, '', 5, '', '', 4),
(6, 'Voruhusid/Litaval Frerne', 'FR-110', 'Torshavn', 'Heilsla, Deild 9', '00298342500 ', '00298342501', 'www.voruhusid.fo', 'fm@litavel.fo', '602', 1, '', 6, '', '', 3),
(7, 'Haderslev Isenkram', '6100', 'Haderslev', 'Gravene 16', '74 53 44 55', '74 53 44 55', '', 'haderslevisenkram@live.dk', '441', 1, '', 7, '', '', 3),
(8, 'Helsinge Isenkram', '3200 ', 'Helsinge', 'Frederiksborgvej 30', '48 79 41 25 ', '48 79 42 25', '', 'he@ekram.dk', '227', 1, '', 8, '', '', 4),
(11, 'Hornbæk Isenkram', '3100 ', 'Hornbæk', 'Ndr. Strandvej 338', '49 70 00 28 ', '49 70 36 28', '', 'mogens@hornkram.dk', '209', 1, '', 11, '', '', 0),
(12, 'Alstrøm Friheden', '2650 ', 'Hvidovre', 'Strandmarksvej 20', '36 49 07 45 ', '36 49 99 52', 'www.alstrom.dk ', 'friheden@alstrom.dk ', '115', 1, '', 12, '', '', 0),
(13, 'Hørsholm Isenkram', '2970 ', 'Hørsholm', 'Hovedgaden 41', '45 86 65 11 ', '45 86 65 56', '', 'ho@ekram.dk', '215', 1, '', 13, '', '', 4),
(15, 'Damborg Isenkram Kalundborg', '4400 ', 'Kalundborg', 'Kordilgade 81', '59 56 19 77 ', '59 56 19 78', 'www.damborg.dk', 'dik@damborg.dk', '226', 1, '', 15, '', '', 2),
(16, 'Tårnby Torv Isenkram', '2770 ', 'Kastrup', 'Tårnby Torv 9', '32 50 36 11 ', '32 52 15 36', 'www.amagerisenkram.dk', 'tti@amagerisenkram.dk', '125', 1, '', 16, '', '', 0),
(17, 'Amager Isenkram Gør-det-selv-shop', '2300 ', 'København S', 'Reberbanegade 3', '32 54 35 11 ', '32 54 05 66', 'www.amagerisenkram.dk', 'gds@amagerisenkram.dk', '161', 1, '', 17, '', '', 0),
(18, 'Amager Isenkram', '2300 ', 'København S', 'Reberbanegade 3 ', '32 95 08 20 ', '32 95 08 40', 'www.amagerisenkram.dk', 'ac@amagerisenkram.dk', '163', 1, '', 18, '', '', 0),
(19, 'HW Hjørnet', '2800 ', 'Lyngby', 'Lyngby Hovedgade 68', '45 87 01 97 ', '45 87 02 26', '', 'hjornet@hw-hjornet.net', '220', 1, '', 19, '', '', 5),
(20, 'Middelfart Isenkram', '3300 ', 'Middelfart', 'Algade 46', '64 44 28 80 ', '64 44 28 82', '', 'middelfart@rkram.dk', '303', 1, '', 20, '', '', 2),
(21, 'Neksø Isenkram', '3730 ', 'Neksø', 'Torvet 3B', '56 49 14 09 ', '56 49 14 79', '', '', '280', 1, '', 21, '', '', 0),
(22, 'Nykøbing F. Isenkram', '4800 ', 'Nykøbing F.', 'Midtpunktet Jernbanegade 21-23', '54 86 17 67 ', '54 82 14 81', '', 'dfi242@defrie.dk', '242', 1, '', 22, '', '', 4),
(23, 'Damborg Shopping', '4500 ', 'Nykøbing Sjælland', 'Algade 23', '59 91 00 95 ', '59 91 23 00', 'www.damborg.dk', 'ds@damborg.dk', '245', 1, '', 23, '', '', 4),
(24, 'Sct. Jørgens Isenkram', '4700 ', 'Næstved', 'Sct. Jørgenspark 48 - 50', '55 72 08 60 ', '55 72 03 91', 'www.damborg.dk', 'sji@damborg.dk', '252', 1, '', 24, '', '', 2),
(25, 'Damborg Næstved', '4700 ', 'Næstved', 'Dania 36', '55 72 73 01 ', '55 72 73 61', 'www.damborg.dk', 'din@damborg.dk', '255', 1, '', 25, '', '', 2),
(26, 'Rosengårdens Isenkram', '5220 ', 'Odense S', 'røbkvej 75, Gul Gade, Rosengårdcentret', '65 93 58 01', '65 93 58 02', '', 'jan@rosengaardensisenkram.dk', '325', 1, '', 26, '', '', 3),
(27, 'Ringsted Isenkram', '4100 ', 'Ringsted', 'Sct. Hansgade 25', '57 61 25 69', '57 61 52 69', '', 'ringsted-isenkram@mail.tele.dk', '279', 1, '', 27, '', '', NULL),
(28, 'Rødovre Isenkram', '2610 ', 'Rødovre', 'Rødovre Centrum 132', '36 41 11 24 ', '36 70 60 90', '', 'ri@roedovreisenkram.dk', '180', 1, '', 28, '', '', 4),
(29, 'Rønne Isenkram', '3700 ', 'Rønne', 'Krystalgade 13', '56 95 04 09 ', '56 95 04 19', '', '', '281', 1, '', 29, '', '', 3),
(30, 'Silkeborg Isenkram', '8600 ', 'Silkeborg', 'Torvecentret, Fredensgade 1', '86 81 61 68', '86 81 61 78', 'www.silkeborg-isenkram.dk', 'sit@silkeborg-isenkram.dk', '575', 1, '', 30, '', '', 2),
(31, 'Damborg Slagelse', '4200 ', 'Slagelse', 'Jernbanegade 7, City 3 ', '58 50 50 32 ', '58 50 50 26', '', 'damborgslagelse@mail.dk ', '282', 1, '', 31, '', '', 3),
(33, 'Svendborg Isenkram', '5700 ', 'Svendborg', 'Vestergade 167 ', '62 21 62 72 ', '62 21 79 88', '', 'mail@svendborgisenkram.dk', '381', 1, '', 33, '', '', NULL),
(34, 'Alstrøm City 2', '2630 ', 'Taastrup', 'Plan 1, City 2', '43 52 56 56 ', '43 52 56 10', 'www.alstrom.dk ', 'city2@alstrom.dk', '189', 1, '', 34, '', '', 4),
(36, 'Alstrøm Spinderiet', '2500 ', 'Valby', 'Valby Torvegade 18', '36 16 00 51 ', '36 16 02 51', 'www.alstrom.dk ', 'spinderiet@alstrom.dk', '191', 1, '', 36, '', '', 4),
(37, 'Frederikssund Isenkram', '3600', 'Frederikssund', 'Nygade 1 stuen 06', '47 31 24 25', '47 31 24 55', '', 'frsund-isenkram@vip.cybercity.dk', '104', 1, '', 37, '', '', 3),
(38, 'Alstrøm Glostrup', '2600', 'Glostrup', 'Glostrup Storcenter 74', '43 45 50 70', '43 43 01 69', 'www.alstrom.dk', 'glostrup@altstrom.dk', '108', 1, '', 38, '', '', 4),
(44, 'mwc shop', 'a', 'a', 'Rødovre Centrum 132', 'a', 'a', 'a', 'nguyen.cuong@mwc.vn', '123', 1, '', 44, 'a', 'a', 7),
(46, 'My Web Creations1', '2999', 'Testby', 'Peter Bangsvej 59', '8990899', '', '', 'info@mwc.vn', '', 1, '', 46, '', '', NULL),
(49, 'DI Testbutik', '1234', 'Postby', 'Byvej 3', '12345678', '', '', 'henrik@webhousedenmark.com', '4711', 1, '', 49, '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jos_dfi_suppliers`
--

CREATE TABLE IF NOT EXISTS `jos_dfi_suppliers` (
  `dfi_supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `postalcode` varchar(20) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `contact_1` varchar(255) DEFAULT NULL,
  `contact_2` varchar(255) DEFAULT NULL,
  `payment_terms` text,
  `kampagnevalutering` text,
  `julevalutering` text,
  `delivery_terms` text,
  `contact_3` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`dfi_supplier_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `jos_dfi_suppliers`
--

INSERT INTO `jos_dfi_suppliers` (`dfi_supplier_id`, `name`, `telephone`, `fax`, `address`, `email`, `postalcode`, `city`, `contact_1`, `contact_2`, `payment_terms`, `kampagnevalutering`, `julevalutering`, `delivery_terms`, `contact_3`) VALUES
(1, 'Scanpan A/S', '87 74 14 00', '86 39 47 77 ', 'Industrivej 49', 'info@webhousedenmark.com', '8550', 'Ryomgaard', '2', 'test', '<p>30 dage netto</p>', '60 dage netto', '90 dage netto<br />', '<p>Franko ved kr. 2000,-</p>', ''),
(2, 'OBH Nordica A/S', '43 35 03 50', '43 35 03 55', 'Ole Lippmanns Vej 1', 'henrik@mywebcreations.dk', '2630', 'Taastrup', 'Ole Olsen', '', 'Løbende uge + 35 dage', '+ 4 uger', '', 'Franko v/kr. 1.500<br />V/Køb under kr. 1.500 gebyr kr. 50 (dog ekskl. reservedele &amp; tilbehør)', ''),
(3, 'MWC supplier', '23456', '655443', '', 'ngo.bieu@mwc.vn', '', '', '1', '1', 'Netto 30 dage', '', '', 'franko', NULL),
(4, 'F&H A/S', '89 28 13 13', '89 28 13 11', 'Gl. Skivevej 70', 'henrik@mywebcreations.dk ', '8800', 'Viborg', '', '', '<p>Løben uge + 35 dage netto</p>', '+ 8 uger', '<html />', '<html />', ''),
(5, 'Aida A/S', '87 49 09 00', '87 49 09 01', 'Grenåvej 635A ', '', '8541', 'Skødstrup', 'Martin Rosenvinge', '24 40 93 25', 'Lb.uge + 35 dage -1,5%', '+ 4 uger', '', 'Franko v/kr. 3.000,-. <br />Ved køb u/kr. 1.500,- gebyr kr. 75,-<br />Fra 1.8.2006: Alle fakturaer pålægges miljø- og fragtgebyr på 0,9%.<br />', 'mr@aida.dk'),
(6, 'Schou Company A/S', '76 93 93 93', '76 93 93 00', 'Industrivej 36', '', '6580', 'Vamdrup', '', '', 'Lb. uge + 28 dage netto.<br />', '+ 4 uger', '', 'Franko v/kr. 2.000. <br />Ved køb under kr. 2.000 tillægges fragt.<br />Ved kampagnekøb, franko kr. 1.000. <br />', NULL),
(7, 'Agimex A/S', '86 82 00 66', '86 82 81 82', 'Hagemannsvej 7', '', '8600', 'Silkeborg', '', '', '<p>Lb. uge + 28 dage -1,5%</p>', '', '', 'Franko v/kr. 1.500,-. Ved køb under kr. 500,- pålægges gebyr kr. 50,-.<br />', NULL),
(8, 'Albaline A/S', '36 78 80 83', '36 78 81 83', 'Avedøreholmen 84', '', '2650', 'Hvidovre', '', '', 'Lb.uge + 28 dage - 1,0%<br />', '', '', 'Franko v/kr. 2.000,-. Ved køb u/kr. 2.000,- gebyr kr. 100,-<br />', NULL),
(9, 'A-L Isenkram EN GROS A/S', '75 53 72 11', '75 52 25 38', 'Gl. Skivevej 70', '', '8800', 'Viborg', '', '', 'Lb. uge + 35 dage netto', '+ 4 uger', '', '1 ugentlig franko levering.<br />Hvis ordremængden er under kr. 1.500 tillægges der fragt kr. 95. Gælder ikke restordre.<br />Hasteordre ufranko.<br />', NULL),
(10, 'All Times Company A/S', '43 66 82 82', '43 66 82 81', 'Esplanaden 40', '', '1263', 'København K', '', '', 'Lb. uge + 28 dage -2%<br />', '', '', 'Franko v/kr. 1.500,-. Ved køb under kr. 1.500,- gebyr kr. 75,-.', NULL),
(11, 'Avenue A/S', '86 28 16 00', '86 28 12 22', 'Teglbækvej 12-14', '', '8361', 'Hasselager', '', '', 'Lb.uge + 28 dage -1,5%', '', '', 'Franko v/kr. 2000,-<br />', NULL),
(12, 'Uniross Batco Nordic ApS', '86 49 62 11', '86 49 62 17', 'Virkevangen 48', '', '8960', 'Randers SØ', '', '', 'Lb. uge + 35 dage netto', '+ 4 uger', '', 'Ordre under 500,- + moms pålægges et ekspeditionsgebyr på kr. 40,- + fragt. Ordre over kr. 1.500,- ekskl. moms og afg. leveres fragtfrit.<br />', NULL),
(13, 'Bodum (Scandinavien) A/S', '49 14 80 00', '49 18 18 44', 'Humlebæk Strandvej 21', '', '3050', 'Humlebæk', '', '', 'Lb. uge + 14 dage -1,5%', '', '', 'Franko v/kr. 1800,-<br />Gebyr kr. 100,- under kr. 1800,-', NULL),
(14, 'Brabantia International', '46 55 13 55', '46 55 18 20', 'Baldersbuen 15G 1.tv.', '', '2640', 'Hedehusene', '', '', 'Lb.uge + 28 dage -1,5%', '+ 4 uger', '', 'Franko v/kr. 2.500,00. Herunder tillægges kr. 250,00.<br />Kampagneordrer leveres franko.<br />', NULL),
(15, 'Brix Design A/S', '55 81 80 22', '55 81 80 50', 'Ved Havnen 8', '', '4780', 'Stege', '', '', 'Lb.uge + 28 dage netto', '', '', 'Ordrer o/kr. 1000,- - frit leveret<br />Odrer u/kr. 1000,- - fragt kr. 29,-', NULL),
(16, 'BSH Hvidevarer A/S', '44 89 80 80', '44 89 86 86', 'Telegrafvej 4', '', '2750', 'Ballerup', '', '', 'Lb.uge + 28 dage', '', '', '', NULL),
(17, 'AGK Nordic A/S', '87 45 07 00', '', 'Norddigesvej 2', '', '8240', 'Risskov', 'Martin Tønder Larsen', '87 45 07 16', 'Lb. uge + 56 dage', '', '', '', 'mtl@agknordic.dk'),
(19, 'Bovictus A/S', '86 60 25 30', '86 60 25 50', 'Hjarbækvej 65', '', '8831', 'Løgstrup', 'Finn Snedker', '22 69 22 23', 'Lb. uge 35 dage', '', '', 'Franko v/køb over kr. 2.500<br />V/køb under kr. 2.500 pålægges gebyr på kr. 100.-', 'fs@zonecompany.dk'),
(20, 'Elthermo Searchlight A/S', '36 72 22 00', '36 41 07 41', 'Højnæsvej 44', 'mail@elthermo.dk', '2610', 'Rødovre', 'Jan Olsen', '', 'Lb.uge + 35 dage', '', '', 'Franko. <br />Ved ordrer u/kr. 2.000,- pålægges gebyr og fragt kr. 140,-.<br />', ''),
(21, 'Hammarplast A/S', '46 38 09 10', '46 38 09 11', 'Ringstedvej 22 ', 'henrik@mywebcreations.dk ', '4000', 'Roskilde', 'Jan Pedersen', '28 98 69 63', '<html />', '<html />', '<html />', 'Franko ved kr. 6500,-', 'j.pedersen@hammarplast.se'),
(22, 'Nordic Living A/S', '49 14 79 25', '49 14 75 26', 'Møllevej 9', 'info@nordic-living.dk', '2990', 'Nivå', 'Morten Clausen', '26 30 00 03', 'Lb. uge + 63 dage<br />', '', '', 'Franko v/kr. 1000,-<br />V/køb under kr. 1000,- + kr. 90,- i fragt.<br />', 'morten@nordic-living.dk'),
(23, 'Rosendahl Design Group A/S', '45 88 66 33', '', 'Slotsmarken 1', 'info@rosendahl.dk', '2970', 'Hørsholm', 'Vivian Spiegelhauer', '45 17 38 34', 'Lb. uge 35 dage netto', '', '', 'Alle ordrer over "salg.rosendahl.dk" (Rosendahls Handelssystem) og kæde afgivne (kampagne) ordrer leveres franko i Danmark.<br />Alle ordrer afgivet pr. telefon, fax og mail leveres ab lager.<br />V/Køb under kr. 2.500 ekskl. moms uanset bestillingsmåde beregnes gebyr kr. 75,-<br />', 'vsp@rosendahl.dk'),
(24, 'Royal Copenhagen A/S', '38 14 48 48', '38 14 99 11', 'Smedeland 17', '', '2600', 'Glostrup', 'Jacob Engberg', '25 24 73 60', 'Lb. uge + 42 dage', '', '', 'Franko ved kr. 2.500. <br />Ved køb under kr. 2.500 + kr. 145', 'jae@royalcopenhagen.com'),
(25, 'Ørskov & Co. A/S', '49 19 49 49', '49 19 49 48', 'Bybjergvej 5', '', '3060', 'Espergærde', '', '', 'lb. uge + 28 dage', '', '', 'ab lager', ''),
(26, 'Adexi A/S', '87 41 71 01', '', 'Grenåvej 635A', 'info@webhousedenmark.com', '8541', 'Skødstrup', 'Rasmus Østergaard', '87 41 71 45', 'Lb.uge + 35 dage netto', '<html />', '<html />', 'Franko ved kr. 3.500,-. <br />Ordrer under kr. 3.500,- gebyr + fragt kr. 200,-.', ''),
(27, 'Eva Solo A/S', '36 73 20 73', '36 70 74 11', 'Måløv Teknikerby 18-20', '', '2760', 'Måløv', '', '', 'Lb.uge + 28 dage netto', '', '', 'Franko v/kr. 1.500,-. <br />Ordredag:<br />En fast ugedag, som aftales med Eva Denmark. Det er muligt at afgive hasteordrer, fra dag til dag, levering ufranko, dog + gebyr kr. 100,-.', ''),
(28, 'Melitta Skandinavia A/S', '46 35 30 00', '46 35 30 04', 'Skomagergade 13 1.', 'melitta@melitta.dk', '4000', 'Roskilde', 'Flemming Skytte', '23 60 56 57', 'Lb. uge + 42 dage', '', '', 'Franko v/kr. 1.500<br />V/Køb under kr. 1.500 fragt kr. 60<br />V/Køb under kr. 500 gebyr kr. 40 + fragt kr. 60', 'flemming.skytte@melitta.dk'),
(29, 'Dacore A/S', '58 11 14 00', '58 11 14 01', 'Hovedgaden 19', 'info@dacore.dk', '4261', 'Dalmose', 'Jan Kirk', '40 89 59 51', '', '', '', '', 'jk@dacore.dk'),
(30, 'Georg Jensen A/S', '38 14 98 98', '38 14 99 20', 'Søndre Fasanvej 7', '', '2000', 'Frederiksberg', '', '', 'Lb. uge + 28 dage', '', '', 'Franko v/kr. 2.500.-.<br />Hasteordrer + gebyr kr. 250.- incl. fragt hvis ordre er under kr. 2.500.-<br />Ved brud på colli + gebyr på +10%<br />Transportforsikring + 0,5% af fakturaværdi', ''),
(31, 'Stelton A/S', '39 62 23 55', '39 62 23 50', 'Christianshavns Kanal 4', 'stelton@stelton.dk', '1406', 'København K', '', '', 'Lb. uge 42 dage netto', '', '', 'Franko v/kr. 3.500<br />Restordrer altid gebyrfrit + franko<br />V/køb kr. 0-999,- + gebyr kr. 200,- incl. forsendelse.<br />V//køb kr. 1.000,- - 3.499,- + aktuel fragt', ''),
(32, 'Condor Danmark', '33 32 88 34', '33 32 88 35', 'Strandvejen 102 E 3.', 'info@webhousedenmark.com', '2900', 'Hellerup', '', '', '<html />', '<html />', '<html />', '<html />', 'nguyen.cuong@mwc.vn');

-- --------------------------------------------------------

--
-- Table structure for table `jos_groups`
--

CREATE TABLE IF NOT EXISTS `jos_groups` (
  `id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_groups`
--

INSERT INTO `jos_groups` (`id`, `name`) VALUES
(0, 'Public'),
(1, 'Registered'),
(2, 'Special');

-- --------------------------------------------------------

--
-- Table structure for table `jos_menu`
--

CREATE TABLE IF NOT EXISTS `jos_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menutype` varchar(75) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `link` text,
  `type` varchar(50) NOT NULL DEFAULT '',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `parent` int(11) unsigned NOT NULL DEFAULT '0',
  `componentid` int(11) unsigned NOT NULL DEFAULT '0',
  `sublevel` int(11) DEFAULT '0',
  `ordering` int(11) DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pollid` int(11) NOT NULL DEFAULT '0',
  `browserNav` tinyint(4) DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `utaccess` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `lft` int(11) unsigned NOT NULL DEFAULT '0',
  `rgt` int(11) unsigned NOT NULL DEFAULT '0',
  `home` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `componentid` (`componentid`,`menutype`,`published`,`access`),
  KEY `menutype` (`menutype`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `jos_menu`
--

INSERT INTO `jos_menu` (`id`, `menutype`, `name`, `alias`, `link`, `type`, `published`, `parent`, `componentid`, `sublevel`, `ordering`, `checked_out`, `checked_out_time`, `pollid`, `browserNav`, `access`, `utaccess`, `params`, `lft`, `rgt`, `home`) VALUES
(1, 'mainmenu', 'Forside', 'forside', 'index.php?option=com_home&view=index', 'component', 1, 0, 76, 0, 1, 62, '2010-07-31 02:40:49', 0, 0, 0, 3, 'page_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 1),
(2, 'mainmenu', 'Om Os', 'om-os', 'index.php?option=com_omos&view=index', 'component', 1, 0, 77, 0, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'page_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(3, 'mainmenu', 'Nyheder', 'nyheder', 'index.php?option=com_nyheder&view=index', 'component', 1, 0, 78, 0, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'page_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(4, 'mainmenu', 'Kontakt Os', 'kontakt-os', 'index.php?option=com_contact&view=contact&id=1', 'component', 1, 0, 7, 0, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_contact_list=0\nshow_category_crumb=0\ncontact_icons=\nicon_address=\nicon_email=\nicon_telephone=\nicon_mobile=\nicon_fax=\nicon_misc=\nshow_headings=\nshow_position=\nshow_email=\nshow_telephone=\nshow_mobile=\nshow_fax=\nallow_vcard=\nbanned_email=\nbanned_subject=\nbanned_text=\nvalidate_session=\ncustom_reply=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(5, 'mainmenu', 'Links', 'links', 'index.php?option=com_content&view=category&id=7', 'component', 0, 0, 20, 0, 5, 0, '0000-00-00 00:00:00', 0, 1, 0, 0, 'display_num=10\nshow_headings=1\nshow_date=0\ndate_format=\nfilter=1\nfilter_type=title\norderby_sec=\nshow_pagination=1\nshow_pagination_limit=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(6, 'shopmenu', 'Ajourmaster', 'ajourmaster', 'index.php?option=com_myshop&view=kampagnebestilling', 'component', 1, 0, 91, 0, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'page_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(7, 'shopmenu', 'Kampagnebestilling', 'kampagnebestilling', 'index.php?option=com_kampagnebestilling', 'component', 0, 0, 85, 0, 11, 62, '2010-02-02 14:58:12', 0, 0, 0, 0, 'page_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(8, 'shopmenu', 'Salgsrapportering', 'salgsrapportering', 'index.php?option=com_salgsrapportering', 'component', 0, 0, 86, 0, 5, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'page_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(9, 'shopmenu', 'OmsÃ¦tningsdel', 'omsaetningsdel', '#', 'url', 0, 0, 0, 0, 7, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'menu_image=-1\n\n', 0, 0, 0),
(10, 'shopmenu', 'Arbejdstagere', 'arbejdstagere', 'index.php?option=com_workers', 'component', 0, 0, 93, 0, 9, 0, '0000-00-00 00:00:00', 0, 0, 2, 0, 'page_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(11, 'shopmenu', 'Min profil', 'rediger-profil', 'index.php?option=com_user', 'component', 1, 0, 14, 0, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'page_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(12, 'shopmenu', 'TilfÃ¸j arbejdstager', 'tilfoj-arbejdstager', 'index.php?option=com_lever', 'component', 0, 0, 90, 0, 10, 0, '0000-00-00 00:00:00', 0, 0, 2, 0, 'page_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(13, 'shopmenu', 'Min butik', 'min-butik', 'index.php?option=com_myshop', 'component', 1, 0, 91, 0, 6, 0, '0000-00-00 00:00:00', 0, 0, 2, 0, 'page_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(14, 'shopmenu', 'Købeark', 'kobeark', 'index.php?option=com_myshop&view=kobeark', 'component', 1, 0, 91, 0, 1, 62, '2010-11-04 08:35:20', 0, 0, 0, 0, 'page_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(15, 'shopmenu', 'Nye købeark', 'new-kobeark', 'index.php?option=com_myshop&view=kobearkview', 'component', 1, 14, 91, 1, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'type=0\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(16, 'shopmenu', 'Afsluttede købeark', 'afsluttede-kobeark-', 'index.php?option=com_myshop&view=kobeark', 'component', 1, 14, 91, 1, 2, 62, '2010-11-04 09:44:46', 0, 0, 0, 0, 'type=1\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(17, 'shopmenu', 'Slutark', 'slutark-', 'index.php?option=com_myshop&view=kobeark', 'component', 0, 14, 91, 1, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'type=2\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(18, 'shopmenu', 'Månedsomsætning', 'manedsomsaetning-', 'index.php?option=com_myshop&view=order', 'component', 1, 0, 91, 0, 8, 62, '2011-02-28 08:34:48', 0, 0, 0, 0, 'page_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(19, 'shopmenu', 'Sortiment', 'sortiment', 'index.php?option=com_myshop&view=supplier', 'component', 1, 0, 91, 0, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'page_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(20, 'shopmenu', 'Leverandør', 'supplier', 'index.php?option=com_myshop&view=supplier', 'component', 1, 19, 91, 1, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'page_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(21, 'shopmenu', 'Produkter', 'produkter', 'index.php?option=com_myshop&view=product', 'component', 1, 19, 91, 1, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'page_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(22, 'menuleft', 'Ledige stillinger', 'ledige-stillinger', 'index.php?option=com_content&view=article&id=16', 'component', 1, 0, 20, 0, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(23, 'menuleft', 'Uddannelse', 'uddannelse', 'index.php?option=com_content&view=article&id=17', 'component', 1, 0, 20, 0, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(24, 'menuleft', 'Uopfordret Ansøgning', 'uopfordret-ansogning', 'index.php?option=com_content&view=article&id=18', 'component', 1, 0, 20, 0, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(25, 'menuleft', 'Ny butik i Din Isenkræmmer', 'ny-butik-i-din-isenkraemmer', 'index.php?option=com_content&view=article&id=19', 'component', 1, 0, 20, 0, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_menu_types`
--

CREATE TABLE IF NOT EXISTS `jos_menu_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menutype` varchar(75) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `menutype` (`menutype`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `jos_menu_types`
--

INSERT INTO `jos_menu_types` (`id`, `menutype`, `title`, `description`) VALUES
(1, 'mainmenu', 'Main Menu', 'The main menu for the site'),
(2, 'shopmenu', 'shop menu', ''),
(3, 'menuleft', 'Menu Left', 'Menu Left');

-- --------------------------------------------------------

--
-- Table structure for table `jos_messages`
--

CREATE TABLE IF NOT EXISTS `jos_messages` (
  `message_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id_from` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id_to` int(10) unsigned NOT NULL DEFAULT '0',
  `folder_id` int(10) unsigned NOT NULL DEFAULT '0',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `state` int(11) NOT NULL DEFAULT '0',
  `priority` int(1) unsigned NOT NULL DEFAULT '0',
  `subject` text NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `useridto_state` (`user_id_to`,`state`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jos_messages`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_messages_cfg`
--

CREATE TABLE IF NOT EXISTS `jos_messages_cfg` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `cfg_name` varchar(100) NOT NULL DEFAULT '',
  `cfg_value` varchar(255) NOT NULL DEFAULT '',
  UNIQUE KEY `idx_user_var_name` (`user_id`,`cfg_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_messages_cfg`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_migration_backlinks`
--

CREATE TABLE IF NOT EXISTS `jos_migration_backlinks` (
  `itemid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` text NOT NULL,
  `sefurl` text NOT NULL,
  `newurl` text NOT NULL,
  PRIMARY KEY (`itemid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_migration_backlinks`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_modules`
--

CREATE TABLE IF NOT EXISTS `jos_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `position` varchar(50) DEFAULT NULL,
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `module` varchar(50) DEFAULT NULL,
  `numnews` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `showtitle` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  `iscore` tinyint(4) NOT NULL DEFAULT '0',
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  `control` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `published` (`published`,`access`),
  KEY `newsfeeds` (`module`,`published`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `jos_modules`
--

INSERT INTO `jos_modules` (`id`, `title`, `content`, `ordering`, `position`, `checked_out`, `checked_out_time`, `published`, `module`, `numnews`, `access`, `showtitle`, `params`, `iscore`, `client_id`, `control`) VALUES
(1, 'Main Menu', '', 1, 'menutop', 0, '0000-00-00 00:00:00', 1, 'mod_mainmenu', 0, 0, 1, 'menutype=mainmenu\nmenu_style=list\nstartLevel=0\nendLevel=0\nshowAllChildren=0\nwindow_open=\nshow_whitespace=0\ncache=1\ntag_id=\nclass_sfx=\nmoduleclass_sfx=_menu\nmaxdepth=10\nmenu_images=0\nmenu_images_align=0\nmenu_images_link=0\nexpand_menu=0\nactivate_parent=0\nfull_active_id=0\nindent_image=0\nindent_image1=\nindent_image2=\nindent_image3=\nindent_image4=\nindent_image5=\nindent_image6=\nspacer=\nend_spacer=\n\n', 1, 0, ''),
(2, 'Login', '', 1, 'login', 0, '0000-00-00 00:00:00', 1, 'mod_login', 0, 0, 1, '', 1, 1, ''),
(3, 'Popular', '', 3, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_popular', 0, 2, 1, '', 0, 1, ''),
(4, 'Recent added Articles', '', 4, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_latest', 0, 2, 1, 'ordering=c_dsc\nuser_id=0\ncache=0\n\n', 0, 1, ''),
(5, 'Menu Stats', '', 5, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_stats', 0, 2, 1, '', 0, 1, ''),
(6, 'Unread Messages', '', 1, 'header', 0, '0000-00-00 00:00:00', 1, 'mod_unread', 0, 2, 1, '', 1, 1, ''),
(7, 'Online Users', '', 2, 'header', 0, '0000-00-00 00:00:00', 1, 'mod_online', 0, 2, 1, '', 1, 1, ''),
(8, 'Toolbar', '', 1, 'toolbar', 0, '0000-00-00 00:00:00', 1, 'mod_toolbar', 0, 2, 1, '', 1, 1, ''),
(9, 'Quick Icons', '', 1, 'icon', 0, '0000-00-00 00:00:00', 1, 'mod_quickicon', 0, 2, 1, '', 1, 1, ''),
(10, 'Logged in Users', '', 2, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_logged', 0, 2, 1, '', 0, 1, ''),
(11, 'Footer', '', 0, 'footer', 0, '0000-00-00 00:00:00', 1, 'mod_footer', 0, 0, 1, '', 1, 1, ''),
(12, 'Admin Menu', '', 1, 'menu', 0, '0000-00-00 00:00:00', 1, 'mod_menu', 0, 2, 1, '', 0, 1, ''),
(13, 'Admin SubMenu', '', 1, 'submenu', 0, '0000-00-00 00:00:00', 1, 'mod_submenu', 0, 2, 1, '', 0, 1, ''),
(14, 'User Status', '', 1, 'status', 0, '0000-00-00 00:00:00', 1, 'mod_status', 0, 2, 1, '', 0, 1, ''),
(15, 'Title', '', 1, 'title', 0, '0000-00-00 00:00:00', 1, 'mod_title', 0, 2, 1, '', 0, 1, ''),
(16, 'Acajoom Subscriber Module', '', 0, 'left', 0, '0000-00-00 00:00:00', 1, 'mod_acajoom', 0, 0, 1, 'listids=0\nred_url=\nlinear=0\nintrotext=\nshowlistname=0\ndefaultchecked=1\nshownamefield=1\ndropdown=0\nselecteddrop=0\nfieldsize=10\nposttext=\nreceivehtmldefault=1\nshowreceivehtml=0\nbutton_text=\nbutton_img=\nbutton_text_change=\nbutton_img_change=templates/defrieisenkram/img/tilmeld-btn.png\nmoduleclass_sfx=\nmod_align=\ncache=0\n\n', 0, 0, ''),
(18, 'Dfi_nyhedsbrev', '', 100, 'left', 0, '0000-00-00 00:00:00', 1, 'mod_dfi_nyhedsbrev', 0, 0, 1, '', 0, 0, ''),
(19, 'Dfi_kontakt', '', 101, 'left', 0, '0000-00-00 00:00:00', 1, 'mod_dfi_kontakt', 0, 0, 1, '', 0, 0, ''),
(20, 'Dfi_adv', '', 102, 'left', 0, '0000-00-00 00:00:00', 1, 'mod_dfi_adv', 0, 0, 1, '', 0, 0, ''),
(21, 'Dfi_navigator', '', 103, 'left', 0, '0000-00-00 00:00:00', 1, 'mod_dfi_navigator', 0, 0, 1, '', 0, 0, ''),
(22, 'Dfi_footer', '', 104, 'left', 0, '0000-00-00 00:00:00', 1, 'mod_dfi_footer', 0, 0, 1, '', 0, 0, ''),
(23, 'Dfi_flip_book', '', 0, 'left', 0, '0000-00-00 00:00:00', 1, 'mod_dfi_flip_book', 0, 0, 1, 'moduleclass_sfx=\n\n', 0, 0, ''),
(24, 'Dfi_login', '', 105, 'left', 62, '2010-11-04 09:43:44', 1, 'mod_dfi_login', 0, 0, 1, '', 0, 0, ''),
(25, 'Dfi_shop_navigator', '', 106, 'left', 0, '0000-00-00 00:00:00', 1, 'mod_dfi_shop_navigator', 0, 0, 1, '', 0, 0, ''),
(27, 'Menu Left', '', 107, 'left', 0, '0000-00-00 00:00:00', 1, 'mod_mainmenu', 0, 0, 1, 'menutype=menuleft\nmenu_style=list\nstartLevel=0\nendLevel=0\nshowAllChildren=0\nwindow_open=\nshow_whitespace=0\ncache=1\ntag_id=\nclass_sfx=\nmoduleclass_sfx=\nmaxdepth=10\nmenu_images=0\nmenu_images_align=0\nmenu_images_link=0\nexpand_menu=0\nactivate_parent=0\nfull_active_id=0\nindent_image=0\nindent_image1=\nindent_image2=\nindent_image3=\nindent_image4=\nindent_image5=\nindent_image6=\nspacer=\nend_spacer=\n\n', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `jos_modules_menu`
--

CREATE TABLE IF NOT EXISTS `jos_modules_menu` (
  `moduleid` int(11) NOT NULL DEFAULT '0',
  `menuid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`moduleid`,`menuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_modules_menu`
--

INSERT INTO `jos_modules_menu` (`moduleid`, `menuid`) VALUES
(1, 0),
(18, 0),
(19, 0),
(20, 0),
(21, 0),
(22, 0),
(23, 0),
(24, 0),
(25, 0),
(27, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_newsfeeds`
--

CREATE TABLE IF NOT EXISTS `jos_newsfeeds` (
  `catid` int(11) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `link` text NOT NULL,
  `filename` varchar(200) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `numarticles` int(11) unsigned NOT NULL DEFAULT '1',
  `cache_time` int(11) unsigned NOT NULL DEFAULT '3600',
  `checked_out` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `rtl` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `published` (`published`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jos_newsfeeds`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_pi_aua_access_components`
--

CREATE TABLE IF NOT EXISTS `jos_pi_aua_access_components` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `component_usergroupid` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jos_pi_aua_access_components`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_pi_aua_access_pages`
--

CREATE TABLE IF NOT EXISTS `jos_pi_aua_access_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pageid_usergroupid` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jos_pi_aua_access_pages`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_pi_aua_actions`
--

CREATE TABLE IF NOT EXISTS `jos_pi_aua_actions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action_usergroupid` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jos_pi_aua_actions`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_pi_aua_categories`
--

CREATE TABLE IF NOT EXISTS `jos_pi_aua_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_groupid` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jos_pi_aua_categories`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_pi_aua_config`
--

CREATE TABLE IF NOT EXISTS `jos_pi_aua_config` (
  `id` varchar(255) NOT NULL,
  `config` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_pi_aua_config`
--

INSERT INTO `jos_pi_aua_config` (`id`, `config`) VALUES
('aua', 'language=english\r\ndefault_tab=usergroups\r\nredirect_to_pi=false\r\nuse_toolbar=true\r\ndisplay_usergroups=true\r\ndisplay_users=true\r\ndefault_usergroup=\r\ndisplay_pagesaccess=true\r\nactive_pagesaccess=false\r\ninherit_rights_parent_page=true\r\ndisplay_itemtypes=true			\r\nactive_itemtypes=false\r\ndisplay_items=true\r\nactive_items=false			\r\ndisplay_itemtype_in_list=false			\r\ndisplay_sections=true\r\nactive_sections=false\r\ndisplay_categories=true\r\nactive_categories=false\r\ndisplay_actions=true\r\nactive_actions=false\r\ndisplay_components=true\r\ndisplay_toolbars=true\r\nshow_joomla_group=true\r\ndisable_joomla_group_selectbox=false\r\nitem_inherits_access=no_default_has_access	\r\ncom_content_access=category_access\r\nactivate_modules=false\r\ndisplay_modules=true\r\nactivate_plugins=false\r\ndisplay_plugins=true\r\nactivate_toolbars=false\r\ndisplay_toolbar_superadmin=true\r\npage_props=true	\r\nitem_props=true	\r\nmenutypes=mainmenu;Main Menu\r\ndropdown_buttons=2;media,4;community\r\nextra_buttons=			\r\nnotify_from_address=no-reply@pages-and-items.com\r\nnotify_from_name=	\r\nuse_componentaccess=false\r\ncomponents=com_poll;Polls;com_poll;0,com_pi_pages_and_items;Pages and Items;com_pi_pages_and_items;0,com_pi_admin_user_access;Admin User Access;com_pi_admin_user_access;0,com_banners;Banners;com_banners;2,com_media;Media Manager;com_media;2,com_trash;Trash manager;com_trash;0\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `jos_pi_aua_items`
--

CREATE TABLE IF NOT EXISTS `jos_pi_aua_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `itemid_usergroupid` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jos_pi_aua_items`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_pi_aua_itemtypes`
--

CREATE TABLE IF NOT EXISTS `jos_pi_aua_itemtypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_groupid` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jos_pi_aua_itemtypes`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_pi_aua_modules`
--

CREATE TABLE IF NOT EXISTS `jos_pi_aua_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_groupid` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jos_pi_aua_modules`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_pi_aua_plugins`
--

CREATE TABLE IF NOT EXISTS `jos_pi_aua_plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin_groupid` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jos_pi_aua_plugins`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_pi_aua_sections`
--

CREATE TABLE IF NOT EXISTS `jos_pi_aua_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section_groupid` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jos_pi_aua_sections`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_pi_aua_usergroups`
--

CREATE TABLE IF NOT EXISTS `jos_pi_aua_usergroups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `email` text NOT NULL,
  `ua_toolbar` tinyint(1) NOT NULL DEFAULT '0',
  `j_toolbar` tinyint(1) NOT NULL DEFAULT '0',
  `extra` tinytext NOT NULL,
  `description` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `jos_pi_aua_usergroups`
--

INSERT INTO `jos_pi_aua_usergroups` (`id`, `name`, `email`, `ua_toolbar`, `j_toolbar`, `extra`, `description`) VALUES
(1, 'test', 'a@a.a', 0, 0, '', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `jos_pi_aua_userindex`
--

CREATE TABLE IF NOT EXISTS `jos_pi_aua_userindex` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `jos_pi_aua_userindex`
--

INSERT INTO `jos_pi_aua_userindex` (`id`, `user_id`, `group_id`) VALUES
(1, 69, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jos_plugins`
--

CREATE TABLE IF NOT EXISTS `jos_plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `element` varchar(100) NOT NULL DEFAULT '',
  `folder` varchar(100) NOT NULL DEFAULT '',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(3) NOT NULL DEFAULT '0',
  `iscore` tinyint(3) NOT NULL DEFAULT '0',
  `client_id` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_folder` (`published`,`client_id`,`access`,`folder`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `jos_plugins`
--

INSERT INTO `jos_plugins` (`id`, `name`, `element`, `folder`, `access`, `ordering`, `published`, `iscore`, `client_id`, `checked_out`, `checked_out_time`, `params`) VALUES
(1, 'Authentication - Joomla', 'joomla', 'authentication', 0, 1, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
(2, 'Authentication - LDAP', 'ldap', 'authentication', 0, 2, 0, 1, 0, 0, '0000-00-00 00:00:00', 'host=\nport=389\nuse_ldapV3=0\nnegotiate_tls=0\nno_referrals=0\nauth_method=bind\nbase_dn=\nsearch_string=\nusers_dn=\nusername=\npassword=\nldap_fullname=fullName\nldap_email=mail\nldap_uid=uid\n\n'),
(3, 'Authentication - GMail', 'gmail', 'authentication', 0, 4, 0, 0, 0, 0, '0000-00-00 00:00:00', ''),
(4, 'Authentication - OpenID', 'openid', 'authentication', 0, 3, 0, 0, 0, 0, '0000-00-00 00:00:00', ''),
(5, 'User - Joomla!', 'joomla', 'user', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', 'autoregister=1\n\n'),
(6, 'Search - Content', 'content', 'search', 0, 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\nsearch_content=1\nsearch_uncategorised=1\nsearch_archived=1\n\n'),
(7, 'Search - Contacts', 'contacts', 'search', 0, 3, 1, 1, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\n\n'),
(8, 'Search - Categories', 'categories', 'search', 0, 4, 1, 0, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\n\n'),
(9, 'Search - Sections', 'sections', 'search', 0, 5, 1, 0, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\n\n'),
(10, 'Search - Newsfeeds', 'newsfeeds', 'search', 0, 6, 1, 0, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\n\n'),
(11, 'Search - Weblinks', 'weblinks', 'search', 0, 2, 1, 1, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\n\n'),
(12, 'Content - Pagebreak', 'pagebreak', 'content', 0, 10000, 1, 1, 0, 0, '0000-00-00 00:00:00', 'enabled=1\ntitle=1\nmultipage_toc=1\nshowall=1\n\n'),
(13, 'Content - Rating', 'vote', 'content', 0, 4, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
(14, 'Content - Email Cloaking', 'emailcloak', 'content', 0, 5, 1, 0, 0, 0, '0000-00-00 00:00:00', 'mode=1\n\n'),
(15, 'Content - Code Hightlighter (GeSHi)', 'geshi', 'content', 0, 5, 0, 0, 0, 0, '0000-00-00 00:00:00', ''),
(16, 'Content - Load Module', 'loadmodule', 'content', 0, 6, 1, 0, 0, 0, '0000-00-00 00:00:00', 'enabled=1\nstyle=0\n\n'),
(17, 'Content - Page Navigation', 'pagenavigation', 'content', 0, 2, 1, 1, 0, 0, '0000-00-00 00:00:00', 'position=1\n\n'),
(18, 'Editor - No Editor', 'none', 'editors', 0, 0, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
(19, 'Editor - TinyMCE', 'tinymce', 'editors', 0, 0, 1, 1, 0, 0, '0000-00-00 00:00:00', 'mode=advanced\nskin=0\ncompressed=0\ncleanup_startup=0\ncleanup_save=2\nentity_encoding=raw\nlang_mode=0\nlang_code=en\ntext_direction=ltr\ncontent_css=1\ncontent_css_custom=\nrelative_urls=1\nnewlines=1\ninvalid_elements=applet\nextended_elements=\ntoolbar=top\ntoolbar_align=left\nhtml_height=550\nhtml_width=750\nelement_path=1\nfonts=1\npaste=1\nsearchreplace=1\ninsertdate=1\nformat_date=%Y-%m-%d\ninserttime=1\nformat_time=%H:%M:%S\ncolors=1\ntable=1\nsmilies=1\nmedia=1\nhr=1\ndirectionality=1\nfullscreen=1\nstyle=1\nlayer=1\nxhtmlxtras=1\nvisualchars=1\nnonbreaking=1\nblockquote=1\ntemplate=0\nadvimage=1\nadvlink=1\nautosave=1\ncontextmenu=1\ninlinepopups=1\nsafari=1\ncustom_plugin=\ncustom_button=\n\n'),
(20, 'Editor - XStandard Lite 2.0', 'xstandard', 'editors', 0, 0, 0, 1, 0, 0, '0000-00-00 00:00:00', ''),
(21, 'Editor Button - Image', 'image', 'editors-xtd', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', ''),
(22, 'Editor Button - Pagebreak', 'pagebreak', 'editors-xtd', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', ''),
(23, 'Editor Button - Readmore', 'readmore', 'editors-xtd', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', ''),
(24, 'XML-RPC - Joomla', 'joomla', 'xmlrpc', 0, 7, 0, 1, 0, 0, '0000-00-00 00:00:00', ''),
(25, 'XML-RPC - Blogger API', 'blogger', 'xmlrpc', 0, 7, 0, 1, 0, 0, '0000-00-00 00:00:00', 'catid=1\nsectionid=0\n\n'),
(27, 'System - SEF', 'sef', 'system', 0, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', ''),
(28, 'System - Debug', 'debug', 'system', 0, 2, 1, 0, 0, 0, '0000-00-00 00:00:00', 'queries=1\nmemory=1\nlangauge=1\n\n'),
(29, 'System - Legacy', 'legacy', 'system', 0, 3, 0, 1, 0, 0, '0000-00-00 00:00:00', 'route=0\n\n'),
(30, 'System - Cache', 'cache', 'system', 0, 4, 0, 1, 0, 0, '0000-00-00 00:00:00', 'browsercache=0\ncachetime=15\n\n'),
(31, 'System - Log', 'log', 'system', 0, 5, 0, 1, 0, 0, '0000-00-00 00:00:00', ''),
(32, 'System - Remember Me', 'remember', 'system', 0, 6, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
(33, 'System - Backlink', 'backlink', 'system', 0, 7, 0, 1, 0, 0, '0000-00-00 00:00:00', ''),
(34, 'Acajoom Content Bot', 'acajoombot', 'acajoom', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', ''),
(35, 'System - Modules Anywhere', 'modulesanywhere', 'system', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', ''),
(36, 'Editor Button - Modules Anywhere', 'modulesanywhere', 'editors-xtd', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', ''),
(37, 'System - Defrieisenkram', 'defrieisenkram', 'system', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', ''),
(38, 'System - Contents Anywhere', 'contentsanywhere', 'system', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `jos_polls`
--

CREATE TABLE IF NOT EXISTS `jos_polls` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `voters` int(9) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `access` int(11) NOT NULL DEFAULT '0',
  `lag` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jos_polls`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_poll_data`
--

CREATE TABLE IF NOT EXISTS `jos_poll_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pollid` int(11) NOT NULL DEFAULT '0',
  `text` text NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pollid` (`pollid`,`text`(1))
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jos_poll_data`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_poll_date`
--

CREATE TABLE IF NOT EXISTS `jos_poll_date` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `vote_id` int(11) NOT NULL DEFAULT '0',
  `poll_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `poll_id` (`poll_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jos_poll_date`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_poll_menu`
--

CREATE TABLE IF NOT EXISTS `jos_poll_menu` (
  `pollid` int(11) NOT NULL DEFAULT '0',
  `menuid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pollid`,`menuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_poll_menu`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_sections`
--

CREATE TABLE IF NOT EXISTS `jos_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `image` text NOT NULL,
  `scope` varchar(50) NOT NULL DEFAULT '',
  `image_position` varchar(30) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_scope` (`scope`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `jos_sections`
--

INSERT INTO `jos_sections` (`id`, `title`, `name`, `alias`, `image`, `scope`, `image_position`, `description`, `published`, `checked_out`, `checked_out_time`, `ordering`, `access`, `count`, `params`) VALUES
(1, 'Din Isenkræmmer', '', 'din-isenkaemmer', '', 'content', 'left', '', 1, 62, '2011-11-21 13:40:35', 1, 0, 4, '');

-- --------------------------------------------------------

--
-- Table structure for table `jos_session`
--

CREATE TABLE IF NOT EXISTS `jos_session` (
  `username` varchar(150) DEFAULT '',
  `time` varchar(14) DEFAULT '',
  `session_id` varchar(200) NOT NULL DEFAULT '0',
  `guest` tinyint(4) DEFAULT '1',
  `userid` int(11) DEFAULT '0',
  `usertype` varchar(50) DEFAULT '',
  `gid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `client_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `data` longtext,
  PRIMARY KEY (`session_id`(64)),
  KEY `whosonline` (`guest`,`usertype`),
  KEY `userid` (`userid`),
  KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_session`
--

INSERT INTO `jos_session` (`username`, `time`, `session_id`, `guest`, `userid`, `usertype`, `gid`, `client_id`, `data`) VALUES
('admin', '1329835283', '4pg3p7jrs46a9grf7iafknf9u7', 0, 62, 'Super Administrator', 25, 1, '8TL62mLGysX_f9zc_-vE_rqf5brrXnT0KSA5xG1mjvi1K60yd4FabtNGTlR4knuYkATFWPisyKg_7igYwnTfpZEBcMmagTaIbZBc2WLWKqwWe8AlrwKjg4pVryn-NMTlNRhDPcEz_b4inh4-uEitEJXN3LvFjZHiGc3LRuptmPUxK7sNzcRjwQVq2SymI-zu8pIQDhnDgqAFqdINnBcZexjz58RnjgpiDOf_zrGF7FeuEVbiKrSx8LbamYp9n2SMi8tBjIrPLvy5_6lX2GtU6mYuKwu-3SnqxmUNkGKZXFYzFD6QLkCxkxpWrWAuex9CFHwj0NowOOecpbIlncFPYROSW2ItNHx9E8m5qeAmKtnPiXE2BWyeA-0OZLG3YwzWkj6FRLMtWQ5KY4gImkS0ImmuxZfCM0T6htUb6BTtdIi0iVWxJ09n-9uG7IQW99Hj3w58VN5ulWDow00Q8zfqoqsP__R3Ql1Zw-oBrvBif1TkjQhFLrdSnmxD8IC5lGVWlzsL4CRJwk1do7bN5RVVY4tJbWbjB441pyOjzoINkBDeuBZdbDSamuXwWcO46S4oTiL3kbrNLY4UsM-NZuGFilWOE6s25bAQy1VR624WNoblYn83V-xrDy-JL_YOKwDSGyVdiVl6GZRU6xRzI5_x7nrJPA-AgNK6cy3wLmC0xtYUJgWFizLIiX9Q8hcDJrGWnAuV2KfhKvtxFUQUPwLy4WjaBXgI9F79atO6PX5LE6T9lGGnJviyoGA2zhxQ3PdFP_rFx6Qy7DUBwAPWXklhqu909_1JfLqAmhjUHJdN6_YRM6leD7GFWXwQblA8_164T-_MrfmZLXd-M691aJB66PKiGZaa80ZNtIbo_2vXSoAN9owGBzn-yXSm4MQae2SuDsOHRWoQX8ZUkU05wx5WGC1MW3jYLLZutsDApq0MKx9QJArO2okK4Hy_3P5gUidWuvU0xnR0h7TcQ06QHoMBTpwR9AsxOTw4nbEkhUtj8S3EgRJumYo-EFSoRoofypZiw9OH16Dwigx101Ac8FVYl1DCIsPFIJCYaX0zLdy0myCwbjNCN6QaQEvz5rr6djmPPCMH8861SOEHof8BLuHYFeqH3mS9QBwsrE4pvopYMRHYm1MV710RcZdgMzHpQilqk1a0Qxv6wuHDuDpSDBBLeBVJlJXZcpXtRDSpyeB9yN2e0EsdMk-mBM8cSRBjDFls1DSZ-Ivyq9l0WxX2mewRsWT_Bo38b2J6bT3omXujDwm6yIoZ5DHC9SyBTb6jIDzDAn3Y3gvT5s4HsVC4fsl18qBjHIyOHHQwS-WrzuhFt2e6XRI09IYlRBUAtTSf67SxmawiIMemPXwMVkmu-Ihq5uJe2PrUVdLxX4ZcTdQqfFvERP63BBPGBBWYHa4e1n3II3IiQsz0RJtivWSUMCVAiMeXymWk6cQG57VQxuFrjdA4XrkJwr2wcxgZ-SbTuftdYEhsrG9TsCcyPt3CZD6elgHJPwUz0ddU0KXyQjOZnRQK5PHISaJlfNoTv4H6-sgHMlLH6z_D_8KnO3ciicCZGj9vyBSIf1-O8KiPIBbrQyb54gRIEdgDc-old4ZAl1030n1OErJObVhJYYUaSpKIyYKG-2aJ4azZ7G31b2XRhXt8hc_5we3Knam29Hv7GQBMwX6Zi1ljlLQD62maposR246HSm-AG6Yp2fkMTgt4rh3_LtnNdv9mqH-DuNyaMdxrrBUBwd4dV_9DkBZIJG0_G1_eezP-gM06uZEvepnFdCc_UpRQ7uUO5Qjruu0LZ7fbEsnpa8D5-A6m93u0QvlxC2F8-tr7y88MCKSy7yb32jFPDJCmCf1hVE2UISEP2B2cLJ20LYJRNt1VSvKAao_3VsB5ji2jrAH2CLCDFJ2juZWezHfqV9XzrejvfDpkOX7J6bs1WSeIabuFx9HlIaThVriZ-RsMjGKV3w3fCwOlZxYCBJbHIXjXc7PwwRehDhKyRWfTzNsTx2dQuC290i7W6NozCn_HXYB3G9eg5Sqd5pUxNjWJsAw_4kzR9dlsKNgsCMRFMlMVaR7FdLItgjjKk2SZ3oanOhjFrM4fTt23fishLupotogeJ0rOj-8lFzlpMf9xye7LgDHFE4uHyv7i76EWXCQeVUPHA4QcGhlexALpAog8o4SNzrrQ4QQZyRC-rm_Bki7HMV7T2YiNHVcXA8SxlDd_AJzhTLh-gaj_X32CyFhfkS15VX4ZiUhmzQsQfVvIl6qJAnX4dEcTcr6wc7EdgjuqipUim3eKUForfW63a5AlxcZc5Xy2rxqZ9aK9mObiCJWB_7uITFkaKS5SAXbvfkrlP3WFBwP0tJto9rYs3v9ijFcfAS6hTa-NpVgGu4mdQYTJ-wxP1RoztSzS1NKrXBbpcugLh6GQOyjwTzh_VyBkgbQg3a6-S-Mtl_M8TUOv2j2aHBQxPNTliw3A0M6s9hPCiwcCtPaTqggleLoAHiUkAHVaL9vuMIzGADAhIXHjlcrCK5K4tIbJKMPb3dB_j5bnoLZjZrPfhEAW5grFSrPnaYLi4-UgYcqlhUvfjSHtA3euzoTs6smQA0ETn6AB26Zgn0lEh5sVfz4ZdNLWHwS2SExsp_-OZUCUz2XO62ecIuT9JPOJe215WvECOc-rrN7nsk5503319lbiPSpwq28AmUKPt3wt0-W_nacpRxko9nYwy8Eoc1V8jYWl6yiAGUXyOWhai9pw8X8YGNHr7rtoI93YNdgkrMWn72vc2CD8wAoTjJPjLRVYNdja5O_Ri4Dcy3Ym9JtuI3OdtMgIJ7lD4ERuVKNOcfdSx8YqQQob4OedytqqGDl9keCSqS6IsgPbFBoY3pW9YzK8SBdwBi3KOc4vLncMKuq5-UnTkbpWgU1RJO7wPKCKboak3-KqWNKEX37aIGx0YEbDbwFjiBND0fuoph5GpE8ljJwzwdiyLTD6O7PfuLJcn7bpsn4adX1ngIW-_6Vm5rkWnn3vzUwniSPC73J7m_nR8v-s_a7RwrAvwWKDH6t_n1HHax0F1_FUcf6wLP_uNVhUYb77gV-NOC-D0Plv6imJOIVULJpHjtLiWEJEh7U89_OfDjaMGU2OfG1aMrjUQkHr_FAgf87TD8hNoBBLyUKjGSoAQWKJGi-htf4WQNN_l37nbbXYx06htal5NIuLGd3lzz1OWKzk2HRpUWR1G3dIiGMldzVlMsM2uAiHaWEbz1Fxckhd-l2jRPLTdoIpZ9VwV1eALj3t0Jgo6EuJ9el4351zaMFDhIpiRi_9L2mU3d01qOAntMKSq0vgOcLXZx4RMPJ2LyAv6k_lO-nzSJe8tvzUj0Tv0xz2B93bs8oQQNg3V7g_v5HiGjIncVvfYqLk7j8nyGXRrJVleVZADAcrGm-IX_GZdAwZXLApvWEg5Yy4D5ddywUmDWry0zmB4s-_s5caLq5Fr1GR3lenbxiaoXTyoJ1flgLI0COOuOFDMn5H2e23JlYSxBfdW7rvLrtdMpUe-eZ_x7wzS6wqVtGcnoVdEqh9xMXJa6EM7RKN_4SiyEyz1USFVs22RJrC4UUdYshnW9Ec4gIU4WA6IR8610ka_b61u7Y03KOGaUtevaWbi9KXcsTgiQc9u5pu8--SEOe8-fB_4BMpAL3mxZofZjdYDSBajH5Kk4NE6rcZeJJVFFZlcj6og9AoohW5EtTcwnOqHM-IAONmeKMbcsxDEmBW9GgF4E7SAwE1umB928tZwYSOnahTMTdV3GDcHpYAlLej_lEhqlFkDQynOE4thszYGQygYaaimvbS2sBDOP_uzeIUpOtXrh9ehTighQbLcI1FJ8xW-yjQ2foGKYFN7Fcbd4287tk4nmaDLjM-W2HvRfQpaBY9CNr32Cm8DZW8BhwFarMMqHouBKONcUwLV0qwrxK-vLFeJJsmg4pDvnsn5bPa7NLKHcH_Qt_a9CztJXqH2clyu2gFM9m49TeKKqg0MC17LAK83S4MW_KJPM46LelVZExqxK0x6QMe-80Ld9bkmjXaEiPwKWXvo42KOZwfTQH4rySGELCJ8292s1nbaGtMpQXX-gyW0t_dWBT_zMPymyyG87_Lra4iB6J8F11KuU8CfVwm5fqne-FppRXbqObsgubQn2ozDT497Vpd2csqi7Tux2I_X0TMuYko4xWFTZ4MZDny10G2x9-SEs2fl1I-ht7__eEZdNpdDVZOPcc_oeaivCzGGZE80n0sVBJ0_E0ixusIB-k6cD917uI8L9a4gjStS8KH1ZKTC3sck0cHmKicBlMzXuJvtyFZWKqoq_czVuI2ay6-E5GMTs3Q7sJ3xvJHR8vUogBEfGx2SU3HM_I-jfosQUIqVfNA8ZHbx0uBNcwpGHQ4qC1h2YGYqXpzl6jZPtd5To2zUUVQQ-L_6sTs1KfiiOvNPGlXYMiieonh1EZEmmircuLmZ9aiIucDuugipKrTffrA0K_h5mLCo4hXVLuAO21QGMgetrHpVXlIMhutCzZMbdAKUpbSCGAFNuu7hYnIfSNSy8GIqqnZnqtQoR4PRFppeD3PQ0yxs1UA-uVj6w6xMjWiGrHzwmYvRXrsyo-7VJNcEeLNij9eyryT7fwGn7la84NV0KaxSvrl1nDvDjbSXStC03GhlgnaHAtuhtNbU4h9EPGW9BfOTgB9aWg3YZW_qNQIQHsZdP-cBH1gNOO-Dsapfaxr9-iDrDEe6nmXTaMYw4qqnsMjMwL6cmJvQddaDFE1cYFSHCrkkPIextHtMqX_L_FLjIC5sNWBazROLqyWPo3KhryhhYNRswlgZhkUbMsDnvx7uq6Osn4oAyHjrUaR_pnoHOqT8qjGzyaZr49vE4_u4gHkSJtPX2YDONuvknEGZxuxpWzlBP0zc6ueSzRtUWfm9SIIq75YLCqXAAuZCx-75Dgr6ghGT9zz2GGW33lCNIW_xQ13tPXDHI5b38wakggg9ocHLmG5jLASEsZM487_GNP0gPpwtEZNn0judCtep4OYEk8Ib5qktq4k7a6d2lqgvY-rCO7BIr_jFeFEcT6n2M-TzJ-hMozPjiiv4qnE7QaSZ1nncyH6GQwpglFeNVcj4El7dg5rExxwviJZAU48ZfOU6TyGq-NPbf5Z-gIrqwp32yxMY0YwN4g9XsMmH_a0k4iOELBMWbV02ergXQzNNku5331Zq2PqWULbGXH6p6MjR9f4vRe0-H0smX48ndaUQqkCO8YZpuHwp5tLChah-iRPbO6gw7zN79XXHuIu_sCb3f5lJHAP6RkjUbRPm8gpmNRUmW67qtfaMxpuRW9dLSsv1ApUeRVEd8jEC8KaNBJIoXMg_eY6oxbjb-Xy-Hw0IxImMCeEOQaiDjPrvL5AzSGiO1aTUN8uFAOwv2lj7vgxdrx54kl30N1kwT9DtR6ZoiDoS5IpH7WDGLJ9rYRFi-dSURK1y389e6I9dUXvFdaKqmzkDgsf0nMAZhUffkN3BbOUSmGu9D6mKHpKb3kXLAj6zJ4VTGDUlh42UdxBUbcXkyxzTRKRZxcGbTcYxoYj6uPedlVnbIavyUjNZDdvQVFkfOL89tXfaX28V8oYt1bIUrbt_Lnz7f3daCfqgD6c7MT09cbKgA9UOKmLCTTo4s59uLw45vXITOVAXo2Onj5ydNEsm4dk4QFFCkwJaTosEoNhDQFYIjYM2iUNW10gmxuQPXwnX4Jd_YVFOx5ilr_ktpr7nnDSgi8Ot5Qj_J_ast9JKqAZGHBhqoioofY_YLIuvNRiIQK4FtulgN70FGqpVpN1hThbkARvv2J2v4JtsRIgPG_R8eW-T_iADdTvIs8VYYerMqf3LII8Vw_Jyi4P2xBW6CXXCb6bUTpARRVmMbMPQundmVMVWZ8LDAU1hODTa9Uzn4J2UkIHFFO6D0MuIMUqYzTkbSx090dJ0Gao6kc9wNqn4FOJBlOIkG6R2faoetNftxCqNB0LosdiBBtxkbT992bRv3x7LlleyJgyEhfNVqEprhYYtZvzwaHnkjWlTwkttiLHTW4Jqy05AZ8-pNBs1fZWWoTJV7G8BIKU-NVg689pS13PYzrT93T6MrKeMJjdUzGkzMOA0wFPCABCZSitxgx8WI1wTVwSKqPP8ppCMRj_meKjkUZb5D9ZfKu81gBm7XnTVmZTR0on1rFMnIqFhzvt3gj17y6e-H8HFjc8xcAahd43Or-eCkbgPJ9W0q29TN35ynYIgNJhq3L0_GcQAXmEBTG41Mv1zPIwT7kPwKiWZZMv6HK9RHOjeQymh4lj9TfYQnfY6HDMtdVYG0Oh0u2prXiYqwnOB_cJLe8d8pWlhnvtvfNSHFDrYS7zDtylGkD1H62qn9JYRakNxbfyUdQbnkCy3iA110i3sjxvWWl_LH5Sp043SyMETh8udvmPa0wKmdCcGjYOHAPCsYNDmVfxK2tlEUPi6OhlwJIzOD3Z7aA2tgKEd2eepKd19i60XyGxeSV8eTrSX-L0Q21-fZQsxHIiZenqJp2PeC0hvd9JwhRfTXnGCiG-Zrf4QgPHRW9wVAovk-fO-z181oyO3bgFixbDz-xe_Cm73VD0WCN34on-0n-vZxT8k_Jbt-ngznTncHqZP-b4rUVF4M-YRKH06FgT3uNk5-w_aLeQLhH0ftOZZShoF5dGR_U0RcRBLQxOybGrpd1DsDeQN4sEV3VUdlaJBwefjfZsHJUoFiqOuPZKeAFZ1Y8riNl6ZGw-uVXQeqWXkOm-DvWnm9xNKHKZgrkAV3vs80W6ixm5rzqcdcsvXMLrTPUpNQy0KGlPZevhDGWfNqDtf2mS8MrgdevyZgoNKTycTarKpyqwnA9FGXwoUffmvcKkIvMExCisneL2WudpnftgtlLep5mBDLZVJcKrMO0rPJcmpnELmgt4eCLE5VBe0eQZKTOyvG5WOxnVcKNkVkyehz0MpvpEUvLWW2RKSNhx204CL04pcZ30IsoycKrxS6hl-oUH92vJx3r9J8VahjT9q6nOodJoU9KYMj_8pfBrA7aK6vB-K0JxxoD0VkDwLdbmUN5h-MQdAUr7_mDCd3UGkuFW-vi1T10iSJSD7sUHA4dYU26lfiQX_KRhTH58R5W-7dR6ZVRz79SkNSgaLZ9XlK-j69cO_e_4REuHH-ozJh8yoDN_nGSwBe8N4i7lyJhqHQ4qAWTy5U647LvPj2z9Lv41YrVeeUn5laKMcQKp8E0_UWW4RRuO9Uj8PwSvPvNIgsfkXvM4hrbT7hQJonAv0rd_YQDiwOHcekrWhmGR2VLICrQChu7Uq5Z6z-FD_pK6Vknds5_QL8XybnnO3tUz884agps9sf6OGUVUuYz5g_S6pYnablyVkw5KPTvVHkjUCwouA8UzO4nicp0c1iR_A0_MbB_RlzmNMFWeqsuIOcdECfG73Ef6fB9OoPXzI90kcgTQAgUeRwsHZGXObbmSJ0-FHhw3HgAYmebhtf279Kz8vm551Bn2micsoZsuUpxcEyQnkDFjY0lvflTdtKVtXiGmjV2uqsCaOqZE-V2OBde0KLSyKfBOmKVh_DYPFG2aMDgUVmMUbcN4uANX-GfBHD4xBOkBNrDr-uXdgJ96u6R2cOHan9v8xEA88jNPRfwzCn8Cf4_CBZ0BiGgVeMeUxVgfrYfRPjEouGvXjbMV2a13fBfwvlNYrHWbbraIFUIzXH7xaXsuMNnr_N1SGwTNks6S4I_dmY53tTXxgzOJswgSj41jE3ZGiJC0CAHT4AYh0rQgJDQ12s9chzP6p5c5O6whSetCzlYzD9ZQYdUZ_-BDw5t0x-MXXIqsYD6Kx04UZ1lJVP4pJEcXy-U-zDp4w3yj8EAZQj8FUZhrd0Yr1MnNl_omsv7QE30BVqdSx42MFLw1LisYDDW4guXcpeF7OoMJsWwL7tfdu_rS8LeTaBReYgvaQ7T_hiygJjyY03dw3dTSO-wBHZlIyNO3Ws4XSF38YGzhyQ5zCN14cDCchJ7ASlUhy6pQyZYgLBK4R8BNVFKZY_2ve4fEYUMbbS_Ih4C-19FpLwA8TT4hxjKnvYPaawgx3ivtKA2oH_qzrTBZfiLwiFofI6GQnn_re3iXIOymoi-QVuX_fzxnE52S2_SvjHUq6etMUqEExVAdV_A6jhCAGTtgQDPo2SKygs2YU9uX-3a47GCjhxKjYWcPUoBT-TKybKjyhjp6b3RjiKbeNhGn72QocdfFkWhLtHOqkfpq-Op6IOVmFxwR9Ci5j4FObfaEvtmww--9fZczqQjpJtSggcMI5vw5D2cRcBGhlKyDWqPptujQwsqvV6Ol_QmfUELt34za2hTkq7ZVljrIoi85aKZ0GeFiYX7-pNRsvalElWo0h1Su0w7tBptHY5I4BP_NgOY1WsDs_pTa-kOfkZQ5iAKFNMYS22QzvxSA7IRIp9mLsVE8Kz_dLmgjfWCHjXQAu_z7VtdD7QZcdOsBgRzY1EDEFilVBXE_SFqwfwjqPL3QRLvFyQww3_y3fnVfDcf265vyVS26vCMxm_ec9T3Lt_QHYlrJnKWgyT9xzHy79iNl3NIOybDsBL_qkV0tJJx6zrVBFw5AOLvMKZxl9x3xmJ-XvS5M5DagIZclhtUXQn8XkZZSCUMZwICN35ZM3zPNUkAhI6zSGkjvRXIHT50cd94KFgqITQNkEHSzB1WkTQzRZzoga80g0rOlJKjqriN-5bhSq2-zQpvLuGf4HqxTgJHCxqhP6QT7fVr9nFtKIFEtXi4uI6ednyflS8ryTVJNp6NAfKTz1Cvhp_JyX-sW9pkoBOmSIhSMazrBvU0FsMZeSgxVwKYSqyOQceX6lV2fLPLEHg8vG8HnylNDljw66g4Ni2EoZw_ep23ml8kj'),
('', '1329835102', '5dgb2htgha9jg26cpko23bapu5', 1, 0, '', 0, 0, 'n7xqdN08cb9R_pH6g_y7bBG9-E7Y2SoatX29AJZj01yysGmcbaw5ZxIvPD17diyAxYhnvFCGXVzH5dEq75MAloypExs48mVdck34DsEx-XW1ETxrjmvr4xRBcbYDAZYJrp9w9V7WIjwygWLHdSffGw03Np0Y3rZoAyB3foJCnzn93ITQYAbb4lnFNcsuU4sGuYRl17nU8Clhf1eNrjLuoki38Y9VDHT4RI23pTkZS_GRBpVAwGTGBl2QU6rzNJOUwqVhXKnXlf5ppVJQIC4Ekt8RaQgeOoGe4vB4yoKnkzekIiwP096wSToVw_5cEbjx_fPce1d1mXCeJ_d4b-uUNVC2t4URjB-ni0KIwJ1x5nTknjDn79mcNe_A4wY9ueWj3YMxwtxr6ecKwf17sIR0Gd9NECHGbUwSeuTVH92sk86srvudoZMepW4kFpiMywXCwpDq5NaYticXKjQA1XLHkgT1RQ4zAQY9U7dPGBCoKPYDMFEYoiYdsRN87DmjdO45Tw-1VWDog0A9L5ecNLo9oZlKfbtF-eOsupBCwoYADtkpmuBz_CxdVFfxLqnBIyhkuoP1yfEL2Ezd85wHUguU-nnIAVJIA7QbQs6ZELBYoBQcaq5gtEEMwT5FGG1b7ttNmYbzo7Fj3eegy0KJZlsMiWnUqtIQciUuctpRJZNqbyb4yXFUOZgCH1HkPdU5aCM0B1GpdoyL5envLWtiHlYYXGznYotNdkk8ObDapmowPPcXRa7U7JEG9sce__QIx0xq7aKzE2ZahkLLNUeSneavB5o4Qifp5Vv5EPE-MtdG1Rl5qVnxXmtkIpCcXnbVR7Q9kUa4KVO5IM-DX4gSCJE5qCGIpBMCuvqJnbk5FkjD2sROT_KEwA0h_wcTdzKRzEDPvuaDydq0ZV03pvYzXb02QMZPsWSZIX1bMAT9W6E-5l4BtMs773DlM4O4n3KUP2mg3mH5urZjS_qSS7iRlT5WJ7x-IMQgiBsQoQ0z8l5Pj4VRoRw5WUr8h21fIbiao3-T__s4vv7T-t5SRZsoL0J84FdEH015B_Q6kT9f-9IYt7h7a0TZmX1HO32CHVkqGTu93C6BrzXN7Sq-Npcew10ts5Jxm-tbUqN97ty_FCwW4Raf_2AHM-KU8fRUwxfcb0zbF2QdkozfIK2Sa5NC-FI5NLHNtUplXyLeMt4iXa0BIokzsSjUbCacJTItlXJgoXHIw7Bk4XQ0uX25ywG7J-7DORcxKPqXauSnXsVf8MAd6NDqaM0zRvpZKio1Akw13votUGGZsFN-QgyNJifgn3GyywxXtlpUFU9b14nZXSX0RBuEHlq6kQtzI7MGfyOYo633A8QLm5oh9FuB_dnirqIIMdRRirGaz-cbrrNlPvGJ-42KFKCR0UrSsZBocAOnfaeHdupEEmzQMjrKI9kEf_K4NbZ5SVdEoStpEhRgSaYzkA29kXbr_dusnclpBkfzgxH-vNZI2vsVkB9ccREbeekzOZz491EIbC0rI-sCOu6iYMPkyTWYDVaOM02dJHbmgt2Yq170LIp1bd7ntMHjqEtXQOt3b2Xl8Jvm4UmMCeqh34Wy8KtM1ywp0Va-6-G57Awf');

-- --------------------------------------------------------

--
-- Table structure for table `jos_stats_agents`
--

CREATE TABLE IF NOT EXISTS `jos_stats_agents` (
  `agent` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_stats_agents`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_templates_menu`
--

CREATE TABLE IF NOT EXISTS `jos_templates_menu` (
  `template` varchar(255) NOT NULL DEFAULT '',
  `menuid` int(11) NOT NULL DEFAULT '0',
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`menuid`,`client_id`,`template`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_templates_menu`
--

INSERT INTO `jos_templates_menu` (`template`, `menuid`, `client_id`) VALUES
('defrieisenkram', 0, 0),
('khepri', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jos_users`
--

CREATE TABLE IF NOT EXISTS `jos_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(150) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `usertype` varchar(25) NOT NULL DEFAULT '',
  `block` tinyint(4) NOT NULL DEFAULT '0',
  `sendEmail` tinyint(4) DEFAULT '0',
  `gid` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `registerDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastvisitDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `activation` varchar(100) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usertype` (`usertype`),
  KEY `idx_name` (`name`),
  KEY `gid_block` (`gid`,`block`),
  KEY `username` (`username`),
  KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=78 ;

--
-- Dumping data for table `jos_users`
--

INSERT INTO `jos_users` (`id`, `name`, `username`, `email`, `password`, `usertype`, `block`, `sendEmail`, `gid`, `registerDate`, `lastvisitDate`, `activation`, `params`) VALUES
(62, 'Administrator', 'admin', 'ngo.bieu@mwc.vn', 'ea1ff913324b31af456317ff7dc77cbc:B5QlaRvoGscQUmAjj7XRAawCIT3ya5zP', 'Super Administrator', 0, 1, 25, '2009-12-30 10:32:28', '2012-02-21 13:21:59', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=1\n\n'),
(63, 'client', 'client', 'client@client.com', '1e885283c660d159dfd3ce1164d741cb:TVnhqR7zhbIvSycoNwDSREvFP7XNJyDZ', 'Registered', 0, 0, 18, '2009-12-30 03:45:24', '2010-01-08 09:02:58', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=0\n\n'),
(69, 'Cuong', 'cuong', 'nguyen.cuong@mwc.vn', 'c212540c18acaba54546beff91bb0ddf:gcgvkpLJ3JO94MZyIHHft9scLxOHL9Bv', 'Super Administrator', 0, 0, 25, '2010-01-13 07:14:47', '2012-02-07 03:31:16', '', 'page_title=Edit Your Details\nlanguage=\ntimezone=0\n\n'),
(70, 'test2', 'test2', 'a@a.a', 'df06b8393ab4885d309cb6f7bf69b4e0:l06JkgxzAwe8DB7s7xejKBU2TvVokU1J', 'Registered', 0, 0, 18, '2010-01-14 03:08:20', '2010-03-15 08:43:46', '', 'page_title=Edit Your Details\nlanguage=\ntimezone=0\n\n'),
(71, 'Kim Hau', 'mwc', 'tkhau@mwc.vn', 'cd98006bdcc92b785251129102d96c95:wbj8TXpU0VwVcWaeQr5OPgeFWHxlyxmk', 'Registered', 0, 0, 18, '2010-01-20 13:14:16', '2010-05-25 12:06:59', '42c0615cbdefd95d2d21389af216d313', 'page_title=Rediger dine detaljer\n\n'),
(72, 'DFI', 'testmwc', 'info@dfi.dk', '33fc681ed20be7998aa620556415abbd:leV1TnLIZ01Fa33IieO1zqqFMItbuPT0', 'Super Administrator', 0, 0, 25, '2010-04-19 03:16:26', '2012-02-21 14:32:56', '', 'language=\ntimezone=0\nadmin_language=\neditor=\nhelpsite=\n\n'),
(73, 'Tran Duy Loc', 'loctest', 'tran.loc@mwc.vn', '466883a742dce6caaefee1a2cf5407f4:QyJttxBTHNhyYcyDMRu3CcEKXcoKzzmy', 'Registered', 0, 0, 18, '2010-04-22 04:34:21', '2010-04-27 09:17:13', '', '\n'),
(74, 'Kim Tran', 'info@mwc.vn', 'info@mwc.vn', '8ab6196dd199c907345ebb4ed82e29b3:wEp0mKF8ndLubmEKNvLoBrxLIkz1x8i2', 'Registered', 0, 0, 18, '2010-05-19 09:13:56', '2010-05-19 09:21:41', '', '\n'),
(75, 'sdf', 'sfdsf', 'sdfs@sdfsdf.com', '2bde39e88271413b7ce1b1fae63ae711:UnMGSHwa7D57Nvh07HCCjbEtusepMIRY', 'Registered', 0, 0, 18, '2010-05-21 03:37:15', '0000-00-00 00:00:00', '', '\n'),
(76, 'sdf', 'sfsdf', 'a@a.com', '8b5cc9e6b97e80da63829c86df1a2462:nCwPv8Y8kQvptj1MoYOP5LlsL6CH8xeq', 'Registered', 0, 0, 18, '2010-05-21 03:38:04', '0000-00-00 00:00:00', '', '\n'),
(77, 'DFI Administrator', 'dfi_admin', 'jesper@dinisenkraemmer.dk', '91e1709e4fd0508f6682a5897436d493:dgk6JoxSCkddFH6NqHimSPTtHswWD7qf', 'Manager', 0, 0, 23, '2010-05-25 08:02:55', '2010-12-12 22:02:22', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=1\n\n');

-- --------------------------------------------------------

--
-- Table structure for table `jos_vm_country`
--

CREATE TABLE IF NOT EXISTS `jos_vm_country` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_id` int(11) NOT NULL DEFAULT '1',
  `country_name` varchar(64) DEFAULT NULL,
  `country_3_code` char(3) DEFAULT NULL,
  `country_2_code` char(2) DEFAULT NULL,
  PRIMARY KEY (`country_id`),
  KEY `idx_country_name` (`country_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Country records' AUTO_INCREMENT=246 ;

--
-- Dumping data for table `jos_vm_country`
--

INSERT INTO `jos_vm_country` (`country_id`, `zone_id`, `country_name`, `country_3_code`, `country_2_code`) VALUES
(1, 1, 'Afghanistan', 'AFG', 'AF'),
(2, 1, 'Albania', 'ALB', 'AL'),
(3, 1, 'Algeria', 'DZA', 'DZ'),
(4, 1, 'American Samoa', 'ASM', 'AS'),
(5, 1, 'Andorra', 'AND', 'AD'),
(6, 1, 'Angola', 'AGO', 'AO'),
(7, 1, 'Anguilla', 'AIA', 'AI'),
(8, 1, 'Antarctica', 'ATA', 'AQ'),
(9, 1, 'Antigua and Barbuda', 'ATG', 'AG'),
(10, 1, 'Argentina', 'ARG', 'AR'),
(11, 1, 'Armenia', 'ARM', 'AM'),
(12, 1, 'Aruba', 'ABW', 'AW'),
(13, 1, 'Australia', 'AUS', 'AU'),
(14, 1, 'Austria', 'AUT', 'AT'),
(15, 1, 'Azerbaijan', 'AZE', 'AZ'),
(16, 1, 'Bahamas', 'BHS', 'BS'),
(17, 1, 'Bahrain', 'BHR', 'BH'),
(18, 1, 'Bangladesh', 'BGD', 'BD'),
(19, 1, 'Barbados', 'BRB', 'BB'),
(20, 1, 'Belarus', 'BLR', 'BY'),
(21, 1, 'Belgium', 'BEL', 'BE'),
(22, 1, 'Belize', 'BLZ', 'BZ'),
(23, 1, 'Benin', 'BEN', 'BJ'),
(24, 1, 'Bermuda', 'BMU', 'BM'),
(25, 1, 'Bhutan', 'BTN', 'BT'),
(26, 1, 'Bolivia', 'BOL', 'BO'),
(27, 1, 'Bosnia and Herzegowina', 'BIH', 'BA'),
(28, 1, 'Botswana', 'BWA', 'BW'),
(29, 1, 'Bouvet Island', 'BVT', 'BV'),
(30, 1, 'Brazil', 'BRA', 'BR'),
(31, 1, 'British Indian Ocean Territory', 'IOT', 'IO'),
(32, 1, 'Brunei Darussalam', 'BRN', 'BN'),
(33, 1, 'Bulgaria', 'BGR', 'BG'),
(34, 1, 'Burkina Faso', 'BFA', 'BF'),
(35, 1, 'Burundi', 'BDI', 'BI'),
(36, 1, 'Cambodia', 'KHM', 'KH'),
(37, 1, 'Cameroon', 'CMR', 'CM'),
(38, 1, 'Canada', 'CAN', 'CA'),
(39, 1, 'Cape Verde', 'CPV', 'CV'),
(40, 1, 'Cayman Islands', 'CYM', 'KY'),
(41, 1, 'Central African Republic', 'CAF', 'CF'),
(42, 1, 'Chad', 'TCD', 'TD'),
(43, 1, 'Chile', 'CHL', 'CL'),
(44, 1, 'China', 'CHN', 'CN'),
(45, 1, 'Christmas Island', 'CXR', 'CX'),
(46, 1, 'Cocos (Keeling) Islands', 'CCK', 'CC'),
(47, 1, 'Colombia', 'COL', 'CO'),
(48, 1, 'Comoros', 'COM', 'KM'),
(49, 1, 'Congo', 'COG', 'CG'),
(50, 1, 'Cook Islands', 'COK', 'CK'),
(51, 1, 'Costa Rica', 'CRI', 'CR'),
(52, 1, 'Cote D''Ivoire', 'CIV', 'CI'),
(53, 1, 'Croatia', 'HRV', 'HR'),
(54, 1, 'Cuba', 'CUB', 'CU'),
(55, 1, 'Cyprus', 'CYP', 'CY'),
(56, 1, 'Czech Republic', 'CZE', 'CZ'),
(57, 1, 'Denmark', 'DNK', 'DK'),
(58, 1, 'Djibouti', 'DJI', 'DJ'),
(59, 1, 'Dominica', 'DMA', 'DM'),
(60, 1, 'Dominican Republic', 'DOM', 'DO'),
(61, 1, 'East Timor', 'TMP', 'TP'),
(62, 1, 'Ecuador', 'ECU', 'EC'),
(63, 1, 'Egypt', 'EGY', 'EG'),
(64, 1, 'El Salvador', 'SLV', 'SV'),
(65, 1, 'Equatorial Guinea', 'GNQ', 'GQ'),
(66, 1, 'Eritrea', 'ERI', 'ER'),
(67, 1, 'Estonia', 'EST', 'EE'),
(68, 1, 'Ethiopia', 'ETH', 'ET'),
(69, 1, 'Falkland Islands (Malvinas)', 'FLK', 'FK'),
(70, 1, 'Faroe Islands', 'FRO', 'FO'),
(71, 1, 'Fiji', 'FJI', 'FJ'),
(72, 1, 'Finland', 'FIN', 'FI'),
(73, 1, 'France', 'FRA', 'FR'),
(74, 1, 'France, Metropolitan', 'FXX', 'FX'),
(75, 1, 'French Guiana', 'GUF', 'GF'),
(76, 1, 'French Polynesia', 'PYF', 'PF'),
(77, 1, 'French Southern Territories', 'ATF', 'TF'),
(78, 1, 'Gabon', 'GAB', 'GA'),
(79, 1, 'Gambia', 'GMB', 'GM'),
(80, 1, 'Georgia', 'GEO', 'GE'),
(81, 1, 'Germany', 'DEU', 'DE'),
(82, 1, 'Ghana', 'GHA', 'GH'),
(83, 1, 'Gibraltar', 'GIB', 'GI'),
(84, 1, 'Greece', 'GRC', 'GR'),
(85, 1, 'Greenland', 'GRL', 'GL'),
(86, 1, 'Grenada', 'GRD', 'GD'),
(87, 1, 'Guadeloupe', 'GLP', 'GP'),
(88, 1, 'Guam', 'GUM', 'GU'),
(89, 1, 'Guatemala', 'GTM', 'GT'),
(90, 1, 'Guinea', 'GIN', 'GN'),
(91, 1, 'Guinea-bissau', 'GNB', 'GW'),
(92, 1, 'Guyana', 'GUY', 'GY'),
(93, 1, 'Haiti', 'HTI', 'HT'),
(94, 1, 'Heard and Mc Donald Islands', 'HMD', 'HM'),
(95, 1, 'Honduras', 'HND', 'HN'),
(96, 1, 'Hong Kong', 'HKG', 'HK'),
(97, 1, 'Hungary', 'HUN', 'HU'),
(98, 1, 'Iceland', 'ISL', 'IS'),
(99, 1, 'India', 'IND', 'IN'),
(100, 1, 'Indonesia', 'IDN', 'ID'),
(101, 1, 'Iran (Islamic Republic of)', 'IRN', 'IR'),
(102, 1, 'Iraq', 'IRQ', 'IQ'),
(103, 1, 'Ireland', 'IRL', 'IE'),
(104, 1, 'Israel', 'ISR', 'IL'),
(105, 1, 'Italy', 'ITA', 'IT'),
(106, 1, 'Jamaica', 'JAM', 'JM'),
(107, 1, 'Japan', 'JPN', 'JP'),
(108, 1, 'Jordan', 'JOR', 'JO'),
(109, 1, 'Kazakhstan', 'KAZ', 'KZ'),
(110, 1, 'Kenya', 'KEN', 'KE'),
(111, 1, 'Kiribati', 'KIR', 'KI'),
(112, 1, 'Korea, Democratic People''s Republic of', 'PRK', 'KP'),
(113, 1, 'Korea, Republic of', 'KOR', 'KR'),
(114, 1, 'Kuwait', 'KWT', 'KW'),
(115, 1, 'Kyrgyzstan', 'KGZ', 'KG'),
(116, 1, 'Lao People''s Democratic Republic', 'LAO', 'LA'),
(117, 1, 'Latvia', 'LVA', 'LV'),
(118, 1, 'Lebanon', 'LBN', 'LB'),
(119, 1, 'Lesotho', 'LSO', 'LS'),
(120, 1, 'Liberia', 'LBR', 'LR'),
(121, 1, 'Libyan Arab Jamahiriya', 'LBY', 'LY'),
(122, 1, 'Liechtenstein', 'LIE', 'LI'),
(123, 1, 'Lithuania', 'LTU', 'LT'),
(124, 1, 'Luxembourg', 'LUX', 'LU'),
(125, 1, 'Macau', 'MAC', 'MO'),
(126, 1, 'Macedonia, The Former Yugoslav Republic of', 'MKD', 'MK'),
(127, 1, 'Madagascar', 'MDG', 'MG'),
(128, 1, 'Malawi', 'MWI', 'MW'),
(129, 1, 'Malaysia', 'MYS', 'MY'),
(130, 1, 'Maldives', 'MDV', 'MV'),
(131, 1, 'Mali', 'MLI', 'ML'),
(132, 1, 'Malta', 'MLT', 'MT'),
(133, 1, 'Marshall Islands', 'MHL', 'MH'),
(134, 1, 'Martinique', 'MTQ', 'MQ'),
(135, 1, 'Mauritania', 'MRT', 'MR'),
(136, 1, 'Mauritius', 'MUS', 'MU'),
(137, 1, 'Mayotte', 'MYT', 'YT'),
(138, 1, 'Mexico', 'MEX', 'MX'),
(139, 1, 'Micronesia, Federated States of', 'FSM', 'FM'),
(140, 1, 'Moldova, Republic of', 'MDA', 'MD'),
(141, 1, 'Monaco', 'MCO', 'MC'),
(142, 1, 'Mongolia', 'MNG', 'MN'),
(143, 1, 'Montserrat', 'MSR', 'MS'),
(144, 1, 'Morocco', 'MAR', 'MA'),
(145, 1, 'Mozambique', 'MOZ', 'MZ'),
(146, 1, 'Myanmar', 'MMR', 'MM'),
(147, 1, 'Namibia', 'NAM', 'NA'),
(148, 1, 'Nauru', 'NRU', 'NR'),
(149, 1, 'Nepal', 'NPL', 'NP'),
(150, 1, 'Netherlands', 'NLD', 'NL'),
(151, 1, 'Netherlands Antilles', 'ANT', 'AN'),
(152, 1, 'New Caledonia', 'NCL', 'NC'),
(153, 1, 'New Zealand', 'NZL', 'NZ'),
(154, 1, 'Nicaragua', 'NIC', 'NI'),
(155, 1, 'Niger', 'NER', 'NE'),
(156, 1, 'Nigeria', 'NGA', 'NG'),
(157, 1, 'Niue', 'NIU', 'NU'),
(158, 1, 'Norfolk Island', 'NFK', 'NF'),
(159, 1, 'Northern Mariana Islands', 'MNP', 'MP'),
(160, 1, 'Norway', 'NOR', 'NO'),
(161, 1, 'Oman', 'OMN', 'OM'),
(162, 1, 'Pakistan', 'PAK', 'PK'),
(163, 1, 'Palau', 'PLW', 'PW'),
(164, 1, 'Panama', 'PAN', 'PA'),
(165, 1, 'Papua New Guinea', 'PNG', 'PG'),
(166, 1, 'Paraguay', 'PRY', 'PY'),
(167, 1, 'Peru', 'PER', 'PE'),
(168, 1, 'Philippines', 'PHL', 'PH'),
(169, 1, 'Pitcairn', 'PCN', 'PN'),
(170, 1, 'Poland', 'POL', 'PL'),
(171, 1, 'Portugal', 'PRT', 'PT'),
(172, 1, 'Puerto Rico', 'PRI', 'PR'),
(173, 1, 'Qatar', 'QAT', 'QA'),
(174, 1, 'Reunion', 'REU', 'RE'),
(175, 1, 'Romania', 'ROM', 'RO'),
(176, 1, 'Russian Federation', 'RUS', 'RU'),
(177, 1, 'Rwanda', 'RWA', 'RW'),
(178, 1, 'Saint Kitts and Nevis', 'KNA', 'KN'),
(179, 1, 'Saint Lucia', 'LCA', 'LC'),
(180, 1, 'Saint Vincent and the Grenadines', 'VCT', 'VC'),
(181, 1, 'Samoa', 'WSM', 'WS'),
(182, 1, 'San Marino', 'SMR', 'SM'),
(183, 1, 'Sao Tome and Principe', 'STP', 'ST'),
(184, 1, 'Saudi Arabia', 'SAU', 'SA'),
(185, 1, 'Senegal', 'SEN', 'SN'),
(186, 1, 'Seychelles', 'SYC', 'SC'),
(187, 1, 'Sierra Leone', 'SLE', 'SL'),
(188, 1, 'Singapore', 'SGP', 'SG'),
(189, 1, 'Slovakia (Slovak Republic)', 'SVK', 'SK'),
(190, 1, 'Slovenia', 'SVN', 'SI'),
(191, 1, 'Solomon Islands', 'SLB', 'SB'),
(192, 1, 'Somalia', 'SOM', 'SO'),
(193, 1, 'South Africa', 'ZAF', 'ZA'),
(194, 1, 'South Georgia and the South Sandwich Islands', 'SGS', 'GS'),
(195, 1, 'Spain', 'ESP', 'ES'),
(196, 1, 'Sri Lanka', 'LKA', 'LK'),
(197, 1, 'St. Helena', 'SHN', 'SH'),
(198, 1, 'St. Pierre and Miquelon', 'SPM', 'PM'),
(199, 1, 'Sudan', 'SDN', 'SD'),
(200, 1, 'Suriname', 'SUR', 'SR'),
(201, 1, 'Svalbard and Jan Mayen Islands', 'SJM', 'SJ'),
(202, 1, 'Swaziland', 'SWZ', 'SZ'),
(203, 1, 'Sweden', 'SWE', 'SE'),
(204, 1, 'Switzerland', 'CHE', 'CH'),
(205, 1, 'Syrian Arab Republic', 'SYR', 'SY'),
(206, 1, 'Taiwan', 'TWN', 'TW'),
(207, 1, 'Tajikistan', 'TJK', 'TJ'),
(208, 1, 'Tanzania, United Republic of', 'TZA', 'TZ'),
(209, 1, 'Thailand', 'THA', 'TH'),
(210, 1, 'Togo', 'TGO', 'TG'),
(211, 1, 'Tokelau', 'TKL', 'TK'),
(212, 1, 'Tonga', 'TON', 'TO'),
(213, 1, 'Trinidad and Tobago', 'TTO', 'TT'),
(214, 1, 'Tunisia', 'TUN', 'TN'),
(215, 1, 'Turkey', 'TUR', 'TR'),
(216, 1, 'Turkmenistan', 'TKM', 'TM'),
(217, 1, 'Turks and Caicos Islands', 'TCA', 'TC'),
(218, 1, 'Tuvalu', 'TUV', 'TV'),
(219, 1, 'Uganda', 'UGA', 'UG'),
(220, 1, 'Ukraine', 'UKR', 'UA'),
(221, 1, 'United Arab Emirates', 'ARE', 'AE'),
(222, 1, 'United Kingdom', 'GBR', 'GB'),
(223, 1, 'United States', 'USA', 'US'),
(224, 1, 'United States Minor Outlying Islands', 'UMI', 'UM'),
(225, 1, 'Uruguay', 'URY', 'UY'),
(226, 1, 'Uzbekistan', 'UZB', 'UZ'),
(227, 1, 'Vanuatu', 'VUT', 'VU'),
(228, 1, 'Vatican City State (Holy See)', 'VAT', 'VA'),
(229, 1, 'Venezuela', 'VEN', 'VE'),
(230, 1, 'Viet Nam', 'VNM', 'VN'),
(231, 1, 'Virgin Islands (British)', 'VGB', 'VG'),
(232, 1, 'Virgin Islands (U.S.)', 'VIR', 'VI'),
(233, 1, 'Wallis and Futuna Islands', 'WLF', 'WF'),
(234, 1, 'Western Sahara', 'ESH', 'EH'),
(235, 1, 'Yemen', 'YEM', 'YE'),
(236, 1, 'Serbia', 'SRB', 'RS'),
(237, 1, 'The Democratic Republic of Congo', 'DRC', 'DC'),
(238, 1, 'Zambia', 'ZMB', 'ZM'),
(239, 1, 'Zimbabwe', 'ZWE', 'ZW'),
(240, 1, 'East Timor', 'XET', 'XE'),
(241, 1, 'Jersey', 'XJE', 'XJ'),
(242, 1, 'St. Barthelemy', 'XSB', 'XB'),
(243, 1, 'St. Eustatius', 'XSE', 'XU'),
(244, 1, 'Canary Islands', 'XCA', 'XC'),
(245, 1, 'Montenegro', 'MNE', 'ME');

-- --------------------------------------------------------

--
-- Table structure for table `jos_weblinks`
--

CREATE TABLE IF NOT EXISTS `jos_weblinks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(250) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(250) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `archived` tinyint(1) NOT NULL DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`,`published`,`archived`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jos_weblinks`
--

