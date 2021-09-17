-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2021 at 11:28 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(53, 'About'),
(54, 'Contact'),
(55, 'Services'),
(56, 'Node'),
(61, 'ReactJs');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_post_id` int(11) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(10, 179, 'mohamed', 'contact@zeus.com', 'hello', 'approved', '2021-08-24'),
(11, 184, 'mohamed', 'to@hello.com', 'hi', 'approved', '2021-08-25');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_category_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` varchar(255) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`) VALUES
(179, 56, 'Is Node.js still relevant for 2020 and beyond?', '27', '2021-08-25', 'image_5.jpg', '<p>Yes, Learning Node. js is absolutely 100% Worth in 2020. Firstly, Node.JS is one of the most prominent JavaScript structures which emphatically relieve the work of any person building internet applications. Basically, It is an open-source JavaScript runtime atmosphere, i.e. the infrastructure to construct and run software applications in JavaScript. It allows developers to carry out the code on the server-side means, on their very own computer system, or right in a web browser. For that reason, Node.js is the light, scalable, and also rapid means to create manuscripts.</p><h1>Features:</h1><ul><li><strong>Synchronous Code Execution:</strong> Non-blocking code execution is conceptually more difficult to code than code that runs in a straight line because we have blocks of code hanging around waiting for asynchronous events to return.</li><li><strong>Object-Oriented:</strong> A huge complaint against NodeJS was down to its JavaScript heritage, which frequently involved lots of procedural spaghetti code. Frameworks like CoffeeScript and TypeScript solved these issues but came as a bolt-on for those who seriously cared about coding standards. Now with the release and general adoption of ES6, Classes are built into the framework and the code looks syntactically similar to C#, Java, and SWIFT.</li><li><strong>Cross-platform:</strong> NodeJS is not only cross-platform but when developed with the correct structure can be packaged into an executable containing all its own dependencies.</li><li><strong>Multi-Thread:</strong> One of the most common complaints by people who do not understand node JS is that it is single-threaded and if you have a core CPU it will only run on one core. Node.js is non-blocking which means that all functions are delegated to the event loop and are executed by different threads. That is handled by Node.js run-time. Node.js does support forking multiple processes. It is important to know that the state is not shared between the master and the forked process. We can pass messages to the forked process and master the process from the forked process with function send.</li><li><strong>Use Built-In Debugger:</strong> If you are coming from a language with heavy IDE integration like Java or C#, debugging Node.js apps could get quite confusing. Many Node.js developers resort to using the “flow” debugging pattern by making use of console.log. However, there are better alternatives that are more convenient to debug Node.js apps. For example, Node.js comes packed with its own built-in debugger that you can run by calling node to debug. Node-inspector is also another interesting tool to debug your Node.js apps.</li><li><strong>Functional Inheritance:</strong> JavaScript makes use of prototypal inheritance whereby objects inherit from other objects. This is interesting and simplifies many things. The class operator also comes bundled with the language with ES6.</li></ul><p>So, coming to the conclusion, nowadays global powerhouses like Uber, PayPal, and LinkedIn, all widely use NodeJS. If these huge brands are using it, then it’s obviously a popular technology already and something to keep in mind when you’re expanding your employability skill set and making career choices.</p>', 'node,js,php', '0', 'published', 10),
(184, 55, 'second post changed', '21', '2021-08-26', 'proj3.jpg', '<p>heloooo</p>', 'weekendlight,java,services', '3', 'published', 39),
(189, 56, 'Is Node.js still relevant for 2020 and beyond?', '27', '2021-08-27', 'image_5.jpg', '', 'node,js,php', '0', 'published', 1),
(190, 55, 'second post changed', '21', '2021-08-27', 'proj3.jpg', '', 'weekendlight,java,services', '3', 'published', 2),
(191, 56, 'Is Node.js still relevant for 2020 and beyond?', '27', '2021-08-28', 'image_5.jpg', '', 'node,js,php', '0', 'published', 10),
(192, 55, 'second post changed', '21', '2021-08-28', 'proj3.jpg', '', 'weekendlight,java,services', '3', 'published', 45);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `token`) VALUES
(21, 'admin', '$2y$10$N9NHuW5V2XsbUA8kYPFwPuXbuLDgj9HARd6MjO/8q6rn8pITJ1A7y', 'mohamed', 'elhadouchi', 'admin@cms.com', 'user_default_image.png', 'admin', '398f6f0a4709b5a09830a1fc92c380b2d044539c160971b7188f37a77cf5ef95b97881a1836fd30aa7958db2051cbbc58b53'),
(27, 'saidd', '$2y$12$05mooWvZU81uOQQyJtLeOeWWIjvCnFSNGcYsAxAv9r1NQmwh9GL6y', 'elhadouchi', 'said', 'contact@zeus.godee', 'node.png', 'subscriber', ''),
(40, 'mohamed', '$2y$12$LgpHnz9el/NLUrWOWcoZkeyc8YI849Uro2dTG4L2HfkNubaBNs1qO', 'mohamed', 'elhadouchi', 'melhadouch@gmail.com', 'user_default_image.png', 'subscriber', 'e9acc162a6d7ae3453a201e41dd906cf9e238068bdd649f9ed21698f2e0f1427bbc09dff25801f7dc17d103e937e4eaee42a');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(28, 's7nhh2nc1obol94lssag11ibee', 1629929290),
(29, 'apdk1vge3c1lebafdg1t8pq3ts', 1629898403),
(30, 'jsdb1tamj7vveuicfn513og164', 1629928876),
(31, '5gaa8r260am6q6h0823hc8jkvq', 1629939534),
(32, 'g26l2pe7u7vlblrbu3b3d0efk6', 1630025456),
(33, '3htc5voa8m1dtuk6g2fg12kiof', 1630013280),
(34, '5krfu23gps6m5fg70asmq4eet9', 1630113518),
(35, 'au5q3hh40rgkp70le2vtr3qjua', 1630153995),
(36, '2i90k7nbifdmmve41jdd8qtsjj', 1630195708),
(37, 'dnc3mfted05i4t0sojmrcjnv25', 1630195700),
(38, '9mf5768lgr1a82koapc6rn8s32', 1630252381),
(39, 'p5t7b2gaj8kn3nfhllscrvasdi', 1630286989),
(40, 'afl3k7gq0ej0n2k3daetadgm6m', 1630368633);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
