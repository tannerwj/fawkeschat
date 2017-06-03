-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 03, 2017 at 02:05 PM
-- Server version: 5.6.32-78.1-log
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `greensu8_chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `comebacks`
--

CREATE TABLE IF NOT EXISTS `comebacks` (
  `id` int(11) NOT NULL,
  `comeback` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comebacks`
--

INSERT INTO `comebacks` (`id`, `comeback`) VALUES
(2, 'you are not as bad as people say, you are much, much worse.'),
(3, 'now we know why some animals eat their own children.'),
(4, 'please, keep talking. i always yawn when i am interested.'),
(5, 'talk is cheap, but thats ok, so are you.'),
(6, 'if we killed everybody who hates you, it wouldnt be murder, it would be an apocalypse!'),
(7, 'this is an excellent time for you to become a missing person.'),
(8, 'im busy now. can i ignore you some other time?'),
(9, 'when i look into your eyes, i see straight through to the back of your head.'),
(10, 'a sharp tongue does not mean you have a keen mind.'),
(11, 'anyone who told you to be yourself couldnt have given you any worse advice.'),
(12, 'are you always this stupid or are you making a special effort today.'),
(13, 'do you want me to accept you as you are, or do you want me to lie to myself and try to like you?'),
(14, 'dont let your mind wander, its far too small to be let out on its own.'),
(15, 'dont thank me for insulting you, it was a pleasure.'),
(16, 'dont you realize that there are enough people to hate in the world already without you putting in so'),
(17, 'he always finds himself lost in thought; its unfamiliar territory.'),
(18, 'i bet you get bullied a lot.'),
(19, 'i can tell that you are lying, your lips are moving.'),
(20, 'i dont know what makes you so dumb but it really works.'),
(21, 'i dont mind you talking so much, as long as you dont mind me not listening.'),
(22, 'i dont think you are a fool, but whats my opinion compared to that of thousands of others.'),
(23, 'i know you are nobodys fool, but maybe someone will adopt you one day.'),
(24, 'i like you. people say ive got no taste, but i like you.'),
(25, 'i used to think that you were a colossal pain in the neck. now i have a much lower opinion of you.'),
(26, 'i will defend, to your death, my right to my opinion.'),
(27, 'i would have liked to insult you, but the sad truth is that you wouldnt understand me.');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE IF NOT EXISTS `complaints` (
  `complaint_id` int(10) NOT NULL,
  `message` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(10) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `privacy_settings`
--

CREATE TABLE IF NOT EXISTS `privacy_settings` (
  `privacy_id` int(10) NOT NULL,
  `description` varchar(255) NOT NULL,
  `value` int(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privacy_settings`
--

INSERT INTO `privacy_settings` (`privacy_id`, `description`, `value`) VALUES
(1, 'you are able to receive private chats', 1),
(2, 'other users cannot send private chats to you (this also deletes all your private chats)', 0);

-- --------------------------------------------------------

--
-- Table structure for table `private_chats`
--

CREATE TABLE IF NOT EXISTS `private_chats` (
  `chat_id` int(10) NOT NULL,
  `message` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(10) NOT NULL,
  `recipient` int(10) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `public_chats`
--

CREATE TABLE IF NOT EXISTS `public_chats` (
  `chat_id` int(10) NOT NULL,
  `message` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=4374 DEFAULT CHARSET=latin1;

--
-- Table structure for table `random_sites`
--

CREATE TABLE IF NOT EXISTS `random_sites` (
  `site_id` int(3) NOT NULL,
  `site` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `random_sites`
--

INSERT INTO `random_sites` (`site_id`, `site`) VALUES
(1, 'http://www.bing.com/search?q=chocolate'),
(3, 'http://www.gotoquiz.com/the_terrorist_test'),
(4, 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'),
(10, 'http://www.newyorker.com/news/john-cassidy/why-edward-snowden-is-a-hero');

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE IF NOT EXISTS `region` (
  `region_id` int(10) NOT NULL,
  `lat` varchar(20) NOT NULL,
  `lng` varchar(20) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=446 DEFAULT CHARSET=latin1;

--
-- Table structure for table `substitutions`
--

CREATE TABLE IF NOT EXISTS `substitutions` (
  `sub_id` int(10) NOT NULL,
  `text_from` varchar(100) NOT NULL,
  `text_to` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `substitutions`
--

INSERT INTO `substitutions` (`sub_id`, `text_from`, `text_to`) VALUES
(1, 'stfu', 'shut the front door'),
(2, 'lol', 'that is slightly funny'),
(3, 'haha', 'i''m not even smiling'),
(4, 'hell', 'h e double hockey sticks'),
(5, 'omg', 'jiminy crickets'),
(6, 'sucks', 'rocks'),
(7, 'btw', 'oh yeah, also'),
(8, 'jk', 'most definitely'),
(9, 'lmao', 'balderdash'),
(10, 'sol', 'bummer'),
(11, 'ttyl', 'adios'),
(12, 'wtf', 'gobbledygook'),
(13, 'son of a bitch', 'son of a gun'),
(14, 'xoxo', 'i hate you'),
(16, 'brb', 'i probably will not return'),
(17, 'byob', 'bring your own briefcase'),
(18, 'l8r', 'at a time in the near or not-so-near future'),
(19, 'g2g', 'i really ought to be going'),
(20, 'mkay', 'ok (said in a snotty 14 year old girls voice)'),
(21, 'myob', 'focus on your own business rather than mine'),
(22, 'fuck', 'fudge-nickels'),
(23, 'ass', 'lint-licker'),
(24, 'shit', 'frijoles');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) NOT NULL,
  `privacy` int(2) NOT NULL DEFAULT '1',
  `email` varchar(60) NOT NULL,
  `password` char(128) NOT NULL,
  `salt` char(128) NOT NULL,
  `image` int(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=2616 DEFAULT CHARSET=latin1;

--
-- Table structure for table `user_images`
--

CREATE TABLE IF NOT EXISTS `user_images` (
  `image_id` int(10) NOT NULL,
  `url` varchar(50) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_images`
--

INSERT INTO `user_images` (`image_id`, `url`) VALUES
(1, 'images/1.png'),
(2, 'images/2.png'),
(3, 'images/3.png'),
(4, 'images/4.png'),
(5, 'images/5.png'),
(6, 'images/6.png'),
(7, 'images/7.png'),
(8, 'images/8.png'),
(9, 'images/9.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comebacks`
--
ALTER TABLE `comebacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `privacy_settings`
--
ALTER TABLE `privacy_settings`
  ADD PRIMARY KEY (`privacy_id`);

--
-- Indexes for table `private_chats`
--
ALTER TABLE `private_chats`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `public_chats`
--
ALTER TABLE `public_chats`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `random_sites`
--
ALTER TABLE `random_sites`
  ADD PRIMARY KEY (`site_id`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`region_id`);

--
-- Indexes for table `substitutions`
--
ALTER TABLE `substitutions`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_images`
--
ALTER TABLE `user_images`
  ADD PRIMARY KEY (`image_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comebacks`
--
ALTER TABLE `comebacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `complaint_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `privacy_settings`
--
ALTER TABLE `privacy_settings`
  MODIFY `privacy_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `private_chats`
--
ALTER TABLE `private_chats`
  MODIFY `chat_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `public_chats`
--
ALTER TABLE `public_chats`
  MODIFY `chat_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4374;
--
-- AUTO_INCREMENT for table `random_sites`
--
ALTER TABLE `random_sites`
  MODIFY `site_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `region_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=446;
--
-- AUTO_INCREMENT for table `substitutions`
--
ALTER TABLE `substitutions`
  MODIFY `sub_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2616;
--
-- AUTO_INCREMENT for table `user_images`
--
ALTER TABLE `user_images`
  MODIFY `image_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
