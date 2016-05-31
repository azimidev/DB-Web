-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 19, 2015 at 06:49 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `php_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `Booking`
--

CREATE TABLE IF NOT EXISTS `Booking` (
`booking_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `performance_id` int(11) DEFAULT NULL,
  `booking_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `purchased` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Booking`
--

INSERT INTO `Booking` (`booking_id`, `customer_id`, `performance_id`, `booking_date`, `status`, `purchased`) VALUES
(33, 10, 5, '2015-03-12 16:22:06', 1, 1),
(34, 10, 7, '2015-03-12 16:22:10', 1, 1),
(35, 10, 3, '2015-03-14 18:14:54', 1, 0),
(36, 10, 13, '2015-03-14 18:15:28', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Cart`
--

CREATE TABLE IF NOT EXISTS `Cart` (
`id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `performance_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Customers`
--

CREATE TABLE IF NOT EXISTS `Customers` (
`customer_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(70) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `street` varchar(50) NOT NULL,
  `town` varchar(30) NOT NULL,
  `post_code` varchar(8) NOT NULL,
  `phone_number` varchar(13) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Customers`
--

INSERT INTO `Customers` (`customer_id`, `username`, `password`, `customer_name`, `email`, `street`, `town`, `post_code`, `phone_number`) VALUES
(10, 'paul', '$2y$10$NDRkNDZhM2Q0MjAxZjg5NuzN3XEoMx21zDLdNhaOGZ/n8DRc9.Z8G', 'Prof Paul', 'p.neve@kingston.ac.uk', '12 Kingston Road', 'Kingston', 'K12 0JY', '+447907630288'),
(11, 'amir', '$2y$10$ZjBhYTQyYjUzNGQyNWYyZ.7vuO.Z9FTaZFM09KIZzNnGEUKzVnid6', 'HASSAN AZIMI', 'Persian.Loyal@yahoo.com', '10 Wrights Lane', 'London', 'W8 6TA', '+447912531996');

-- --------------------------------------------------------

--
-- Table structure for table `Performance`
--

CREATE TABLE IF NOT EXISTS `Performance` (
`performance_id` int(11) NOT NULL,
  `production_id` int(11) NOT NULL,
  `performance_name` varchar(50) NOT NULL,
  `details` text CHARACTER SET utf8 COLLATE utf8_unicode_ci
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Performance`
--

INSERT INTO `Performance` (`performance_id`, `production_id`, `performance_name`, `details`) VALUES
(1, 2, 'Les Miserables', 'Monday to Friday\r\n12:00 - 14:00\r\n\r\nLes MisÃ©rables is a 2012 British epic romantic musical historical drama film produced by Working Title Films and distributed by Universal Pictures. The film is based on the musical of the same name by Alain Boublil and Claude-Michel SchÃ¶nberg which is in turn based on the 1862 French novel by Victor Hugo. The film is directed by Tom Hooper, scripted by William Nicholson, Boublil, SchÃ¶nberg, and Herbert Kretzmer, and stars an ensemble cast led by Hugh Jackman, Russell Crowe, Anne Hathaway, and Amanda Seyfried.'),
(2, 2, 'Charlie Hebdo', 'Monday to Friday\r\n20:00 - 22:00\r\n\r\nA young lawyer travels to a remote village where he discovers the vengeful ghost of a scorned woman is terrorizing the locals.\r\n\r\nDirector: James Watkins\r\nWriters: Susan Hill (novel), Jane Goldman (screenplay)\r\nStars: Daniel Radcliffe, Janet McTeer, CiarÃ¡n Hinds | See full cast and crew Â»'),
(3, 3, 'Swan Lake', 'Monday to Friday\r\n20:00 - 22:00\r\n\r\nSwan Lake, Op. 20, is a ballet composed by Pyotr Ilyich Tchaikovsky in 1875â€“76. The scenario, initially in four acts, was fashioned from Russian folk tales[a] and tells the story of Odette, a princess turned into a swan by an evil sorcerer''s curse. The choreographer of the original production was Julius Reisinger. The ballet was premiered by the Bolshoi Ballet on 4 March 1877 at the Bolshoi Theatre in Moscow. Although it is presented in many different versions, most ballet companies base their stagings both choreographically and musically on the 1895 revival of Marius Petipa and Lev Ivanov, first staged for the Imperial Ballet on 15 January 1895, at the Mariinsky Theatre in St. Petersburg. For this revival, Tchaikovsky''s score was revised by the St. Petersburg Imperial Theatre''s chief conductor and composer Riccardo Drigo.'),
(4, 4, 'Billy Elliot', 'Monday to Friday\r\n20:00 - 22:00\r\n\r\nBilly Elliot is a 2000 British drama film written by Lee Hall and directed by Stephen Daldry. Set in north-eastern England during the 1984-85 coal miners'' strike, it stars Jamie Bell as 11-year-old Billy, an aspiring dancer dealing with the negative stereotype of the male ballet dancer, Gary Lewis as his coal miner father, Jamie Draven as Billy''s older brother, and Julie Walters as his ballet teacher.\r\n\r\nIn 2001, author Melvin Burgess was commissioned to write the novelisation of the film based on Lee Hall''s screenplay. The story was adapted for the West End stage as Billy Elliot the Musical in 2005; it opened in Australia in 2007 and on Broadway in 2008.'),
(5, 5, '3 Winters', 'Monday to Friday\r\n20:00 - 22:00\r\n\r\n2 Autumns, 3 Winters (French: 2 automnes 3 hivers) is a 2013 French film written and directed by SÃ©bastien Betbeder.\r\n\r\nThe story is narrated by each of the major characters. At the beginning, 33-year-old Arman (Macaigne) decides to change his life. For starters, he takes up jogging, which is how he has his first meeting with AmÃ©lie (Wyler).'),
(7, 7, 'As You Like It', 'Monday to Friday\r\n14:00 - 16:00\r\n\r\nAs You Like It is a pastoral comedy by William Shakespeare believed to have been written in 1599 or early 1600 and first published in the First Folio, 1623. The play''s first performance is uncertain, though a performance at Wilton House in 1603 has been suggested as a possibility. As You Like It follows its heroine Rosalind as she flees persecution in her uncle''s court, accompanied by her cousin Celia to find safety and, eventually, love, in the Forest of Arden. In the forest, they encounter a variety of memorable characters, notably the melancholy traveller Jaques who speaks many of Shakespeare''s most famous speeches (such as "All the world''s a stage" and "A fool! A fool! I met a fool in the forest"). Jaques provides a sharp contrast to the other characters in the play, always observing and disputing the hardships of life in the country. Historically, critical response has varied, with some critics finding the work of lesser quality than other Shakespearean works and some finding the play a work of great merit.'),
(8, 8, 'A Separation', 'Monday to Friday\r\n19:00 - 22:00\r\n\r\nA Separation (Persian: Ø¬Ø¯Ø§ÛŒÛŒ Ù†Ø§Ø¯Ø± Ø§Ø² Ø³ÛŒÙ…ÛŒÙ†â€Ž JodaÃ­-e NadÃ©r az SimÃ­n, "The Separation of Nader and Simin") is a 2011 Iranian drama film written and directed by Asghar Farhadi, starring Leila Hatami, Peyman Moaadi, Shahab Hosseini, Sareh Bayat, and Sarina Farhadi. It focuses on an Iranian middle-class couple who separate, and the conflicts that arise when the husband hires a lower-class care giver for his elderly father, who suffers from Alzheimer''s disease.\r\n\r\nA Separation won the Academy Award for Best Foreign Language Film in 2012, becoming the first Iranian film to win the award. It received the Golden Bear for Best Film and the Silver Bears for Best Actress and Best Actor at the 61st Berlin International Film Festival, becoming the first Iranian film to win the Golden Bear.It also won the Golden Globe for Best Foreign Language Film. The film was nominated for the Academy Award for Best Original Screenplay, making it the first non-English film in five years to achieve this.'),
(9, 9, 'Chinese opera', 'Monday to Friday\r\n18:00 - 22:00\r\n\r\n\r\nChinese opera (simplified Chinese: æˆæ›²; traditional Chinese: æˆ²æ›²; pinyin: xÃ¬qÇ”; Jyutping: hei3kuk1; PeÌh-Åe-jÄ«: hÃ¬-khek) is a popular form of drama and musical theatre in China with roots going back to the early periods in China. It is a composite performance art that is an amalgamation of various art forms that existed in ancient China, and evolved gradually over more than a thousand years, reaching its mature form in the 13th century during the Song Dynasty. Early forms of Chinese drama are simple, but over time they incorporated various art forms, such as music, song and dance, martial arts, acrobatics, as well as literary art forms to become Chinese opera.\r\n\r\nThere are numerous regional branches of Chinese opera, of which the Beijing opera (Jingju) is one of the most notable.'),
(10, 10, 'Raja Hindustani', 'Monday to Friday\r\n16:00 - 19:00\r\n\r\nRaja Hindustani (translation: Indian King) is a 1996 Indian Hindi drama romance film directed by Dharmesh Darshan. It tells the tale of a cab driver hailing from a small town, who falls in love with a rich girl. Aamir Khan and Karisma Kapoor play the lead roles. The film was one of the most commercially successful films of the 1990s. Juhi Chawla was first offered the lead role but she refused the film. The film''s music became popular and was successful especially in central and eastern states of India. Karisma Kapoor was hugely complimented for her looks and outstanding performance as Aarti, a rich beautiful sensitive young girl full of dreams and desires. She won the Filmfare Best Actress Award for this film. This film is inspired by Suraj Prakash''s 1965 Hindi film Jab Jab Phool Khile starring Shashi Kapoor and Nanda.'),
(11, 11, 'Noh', 'Monday to Friday\r\n17:00 - 19:00\r\n\r\nNoh (èƒ½ NÅ?), or Nogaku (èƒ½æ¥½ NÅgaku?)â€”derived from the Sino-Japanese word for "skill" or "talent"â€”is a major form of classical Japanese musical drama that has been performed since the 14th century. Developed by Kan''ami and his son Zeami, it is the oldest major theatre art still regularly performed today. Traditionally, a Noh program includes five Noh plays with comedic kyÅgen plays in between, even though an abbreviated program of two Noh plays and one kyÅgen piece has become common in Noh presentations today. An okina play may be presented in the very beginning especially during New Years, holidays, and other special occasions.'),
(12, 12, 'Out of the Fringe', 'Monday to Friday\r\n20:00 - 22:00\r\n\r\n\r\nThere is a new generation of Latina/o dramatists afoot. According to Caridad Svich, editor of Out of the Fringe: Contemporary Latina/Latino Theatre and Performance, "There is a wave of dramatists, storytellers and poets, creating work intensely personal and idiosyncratic, eerie and lyrical, metaphysical and emotive. Flourishing within the margins of an already marginalized theatrical environment, they align themselves with resurgent poetry and the spoken-word movement, with alternative music and literature scenes; their work is bred on the economics of poetry and the nurturing of their work outside official venues."'),
(13, 13, 'WWII', 'Monday to Friday\r\n20:00 - 23:00\r\n\r\nDuring World War II, CEMA (Council for the Encouragement of Music and the Arts) was set up to provide entertainment for the civilian and military population, often in community or church halls or in makeshift theatres in camps. This initiative, and subsequent interest in the arts as a whole, led to the formation of the Arts Council in 1946 which enabled public money to be used to support theatre in the regions, including the construction of new theatres. The Belgrade in Coventry was the first purpose-built theatre after the war.'),
(15, 1, 'Woman in Black First', 'Monday to Friday\r\n16:00 - 18:00\r\n\r\nA young lawyer travels to a remote village where he discovers the vengeful ghost of a scorned woman is terrorizing the locals.\r\n\r\nDirector: James Watkins\r\nWriters: Susan Hill (novel), Jane Goldman (screenplay)\r\nStars: Daniel Radcliffe, Janet McTeer, CiarÃ¡n Hinds | See full cast and crew Â»'),
(16, 1, 'Harry Potter', 'Harry ....'),
(17, 14, 'name 2', 'lorem ipsum');

-- --------------------------------------------------------

--
-- Table structure for table `Production`
--

CREATE TABLE IF NOT EXISTS `Production` (
`production_id` int(11) NOT NULL,
  `production_name` varchar(50) NOT NULL,
  `production_type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Production`
--

INSERT INTO `Production` (`production_id`, `production_name`, `production_type`) VALUES
(1, 'British', 'Action'),
(2, 'French', 'Musical'),
(3, 'American', 'Musical'),
(4, 'Middle Eastern', 'Musical'),
(5, 'Spanish', 'Drama'),
(6, 'Italian', 'Drama'),
(7, 'Russian', 'Comedy'),
(8, 'Persian', 'Opening'),
(9, 'Chinese', 'Openings'),
(10, 'Indian', 'Musical'),
(11, 'Japanese', 'Musical'),
(12, 'Latina', 'Musical'),
(13, 'German', 'Comedy'),
(14, 'A name', 'comedy');

-- --------------------------------------------------------

--
-- Table structure for table `Seat`
--

CREATE TABLE IF NOT EXISTS `Seat` (
`seat_id` int(11) NOT NULL,
  `seat_row` varchar(2) NOT NULL,
  `seat_number` int(3) NOT NULL,
  `price` decimal(5,2) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Seat`
--

INSERT INTO `Seat` (`seat_id`, `seat_row`, `seat_number`, `price`, `status`) VALUES
(1, '1', 1, '15.99', 1),
(2, '1', 2, '15.99', 1),
(3, '1', 3, '15.99', 1),
(4, '2', 1, '15.99', 1),
(5, '2', 2, '15.99', 1),
(6, '2', 3, '15.99', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Ticket`
--

CREATE TABLE IF NOT EXISTS `Ticket` (
`ticket_id` int(11) NOT NULL,
  `performance_id` int(11) DEFAULT NULL,
  `seat_id` int(11) DEFAULT NULL,
  `booking_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1043 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Ticket`
--

INSERT INTO `Ticket` (`ticket_id`, `performance_id`, `seat_id`, `booking_id`) VALUES
(1018, 8, 4, NULL),
(1019, 8, 2, NULL),
(1020, 4, 5, NULL),
(1021, 4, 6, NULL),
(1023, 4, 3, NULL),
(1024, 7, 5, NULL),
(1025, 9, 3, NULL),
(1026, 10, 4, NULL),
(1029, 4, 5, NULL),
(1030, 2, 4, NULL),
(1031, 2, 4, NULL),
(1032, 3, 2, NULL),
(1033, 4, 5, NULL),
(1034, 3, 2, NULL),
(1035, 5, 4, NULL),
(1036, 9, 3, NULL),
(1037, 7, 4, NULL),
(1038, 4, 5, NULL),
(1039, 9, 4, NULL),
(1040, 2, 4, NULL),
(1041, 5, 3, 33),
(1042, 7, 2, 34);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Booking`
--
ALTER TABLE `Booking`
 ADD PRIMARY KEY (`booking_id`), ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `Cart`
--
ALTER TABLE `Cart`
 ADD PRIMARY KEY (`id`), ADD KEY `customer_id` (`customer_id`), ADD KEY `performance_id` (`performance_id`);

--
-- Indexes for table `Customers`
--
ALTER TABLE `Customers`
 ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `Performance`
--
ALTER TABLE `Performance`
 ADD PRIMARY KEY (`performance_id`), ADD KEY `production_id` (`production_id`);

--
-- Indexes for table `Production`
--
ALTER TABLE `Production`
 ADD PRIMARY KEY (`production_id`);

--
-- Indexes for table `Seat`
--
ALTER TABLE `Seat`
 ADD PRIMARY KEY (`seat_id`);

--
-- Indexes for table `Ticket`
--
ALTER TABLE `Ticket`
 ADD PRIMARY KEY (`ticket_id`), ADD KEY `performance_id` (`performance_id`), ADD KEY `seat_id` (`seat_id`), ADD KEY `booking_id` (`booking_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Booking`
--
ALTER TABLE `Booking`
MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `Cart`
--
ALTER TABLE `Cart`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Customers`
--
ALTER TABLE `Customers`
MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `Performance`
--
ALTER TABLE `Performance`
MODIFY `performance_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `Production`
--
ALTER TABLE `Production`
MODIFY `production_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `Seat`
--
ALTER TABLE `Seat`
MODIFY `seat_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `Ticket`
--
ALTER TABLE `Ticket`
MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1043;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Booking`
--
ALTER TABLE `Booking`
ADD CONSTRAINT `booking_customer` FOREIGN KEY (`customer_id`) REFERENCES `Customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Cart`
--
ALTER TABLE `Cart`
ADD CONSTRAINT `customer_cart` FOREIGN KEY (`customer_id`) REFERENCES `Customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Performance`
--
ALTER TABLE `Performance`
ADD CONSTRAINT `production_performance` FOREIGN KEY (`production_id`) REFERENCES `Production` (`production_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Ticket`
--
ALTER TABLE `Ticket`
ADD CONSTRAINT `ticket_performance` FOREIGN KEY (`performance_id`) REFERENCES `Performance` (`performance_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `ticket_seats` FOREIGN KEY (`seat_id`) REFERENCES `Seat` (`seat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tickets_booking` FOREIGN KEY (`booking_id`) REFERENCES `Booking` (`booking_id`) ON DELETE SET NULL ON UPDATE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
