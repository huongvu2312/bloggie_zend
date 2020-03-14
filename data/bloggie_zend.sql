-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2020 at 11:36 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bloggie_zend`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `user` varchar(25) NOT NULL,
  `content` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `user`, `content`, `date_created`, `post_id`) VALUES
(1, 'Anonymous', 'This is kind of boring.', '2020-03-10 23:33:51', 8),
(2, 'Not_A_Developer', 'I myself would prefer a new laptop over a banana', '2020-03-10 23:33:57', 8);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `draft` tinyint(1) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `description`, `draft`, `date_created`) VALUES
(1, 'AngularJS', 'AngularJS is a JavaScript-based open-source front-end web framework mainly maintained by Google and by a community of individuals and corporations to address many of the challenges encountered in developing single-page applications. It aims to simplify both the development and the testing of such applications by providing a framework for client-side model-view-controller (MVC) and model-view-viewmodel (MVVM) architectures, along with components commonly used in rich Internet applications.\r\n\r\nAngularJS is the frontend part of the MEAN stack, consisting of MongoDB database, Express.js web application server framework, Angular.js itself, and Node.js server runtime environment. Version 1.7.x is on Long Term Support until July 1st 2021. After that date AngularJS will no longer be updated and Angular (2.0+) is suggested instead.', 1, '2020-03-10 19:10:05'),
(2, 'Server administrator', 'A server administrator, or admin has the overall control of a server. This is usually in the context of a business organization, where a server administrator oversees the performance and condition of multiple servers in the business organization, or it can be in the context of a single person running a game server.\r\n\r\nThe Server Administrator\'s role is to design, install, administer, and optimize company servers and related components to achieve high performance of the various business functions supported by the servers as necessary. This includes ensuring the availability of client/server applications, configuring all new implementations, and developing processes and procedures for ongoing management of the server environment. Where applicable, the Server Administrator will assist in overseeing the physical security, integrity, and safety of the data center/server farm. ', 0, '2020-03-10 19:55:37'),
(3, 'PHP', 'PHP is a popular general-purpose scripting language that is especially suited to web development. It was originally created by Rasmus Lerdorf in 1994; the PHP reference implementation is now produced by The PHP Group. PHP originally stood for Personal Home Page, but it now stands for the recursive initialism PHP: Hypertext Preprocessor.\r\n\r\nPHP code is usually processed on a web server by a PHP interpreter implemented as a module, a daemon or as a Common Gateway Interface (CGI) executable. On a web server, the result of the interpreted and executed PHP code â€” which may be any type of data, such as generated HTML or binary image data â€” would form the whole or part of a HTTP response. Various web template systems, web content management systems, and web frameworks exist which can be employed to orchestrate or facilitate the generation of that response. Additionally, PHP can be used for many programming tasks outside of the web context, such as standalone graphical applications and robotic drone control. Arbitrary PHP code can also be interpreted and executed via command line interface (CLI). ', 0, '2020-03-10 19:16:12'),
(4, 'JavaScript', 'JavaScript (/ËˆdÊ’É‘ËvÉ™ËŒskrÉªpt/), often abbreviated as JS, is a programming language that conforms to the ECMAScript specification. JavaScript is high-level, often just-in-time compiled, and multi-paradigm. It has curly-bracket syntax, dynamic typing, prototype-based object-orientation, and first-class functions.\r\n\r\nAlongside HTML and CSS, JavaScript is one of the core technologies of the World Wide Web. JavaScript enables interactive web pages and is an essential part of web applications. The vast majority of websites use it for client-side page behavior, and all major web browsers have a dedicated JavaScript engine to execute it.\r\n\r\nAs a multi-paradigm language, JavaScript supports event-driven, functional, and imperative programming styles. It has application programming interfaces (APIs) for working with text, dates, regular expressions, standard data structures, and the Document Object Model (DOM). However, the language itself does not include any input/output (I/O), such as networking, storage, or graphics facilities, as the host environment (usually a web browser) provides those APIs.\r\n\r\nOriginally used only in web browsers, JavaScript engines are also now embedded in server-side website deployments and non-browser applications.\r\n\r\nAlthough there are similarities between JavaScript and Java, including language name, syntax, and respective standard libraries, the two languages are distinct and differ greatly in design. ', 0, '2020-03-10 19:15:35'),
(5, 'ReactJS', 'React (also known as React.js or ReactJS) is a JavaScript library for building user interfaces. It is maintained by Facebook and a community of individual developers and companies.\r\n\r\nReact can be used as a base in the development of single-page or mobile applications. However, React is only concerned with rendering data to the DOM, and so creating React applications usually requires the use of additional libraries for state management and routing. Redux and React Router are respective examples of such libraries.', 1, '2020-03-10 19:11:05'),
(6, 'Frontend', 'Frontend is the presentation layer, itâ€™s that part of an application, which the user can see, for example, a graphical user interface (short: GUI).\r\n\r\nOn the whole it can be noted that by talkig about a website, you also talk about its frontend. Everything you can see on an website, - fonts, colors, menus, buttons, tables and many more - were coded and/or assembled via html, css, JavaScript and for example the graphics for this site were produced with Photoshop. With this mix of coding and designing you have a wide range of possibilities for the individual designs for an application. The frontend closes the gap between interface and the actions which run in the background.\r\nThis makes an user interaction with the backend possible, which would otherwise be difficult or require a high level of specialized know-how.', 0, '2020-03-10 19:17:24'),
(7, 'Backend', 'The backend is decleared as the data access layer. That means it\'s the part of an application that is not visible to the user (contrasting the frontend).\r\nIt contains all programming of the application and the administration area.\r\n\r\nFor example, on a website, you first encounter the frontend, i.e. the user interface. The frontend lets you interact with the backend. As soon as you enter information, they are transferred to a database on a server.\r\n\r\nTo make an application functional, you need the backend, which takes care of the implementation of the functions. You as an user can\'t see all those programming, for the functions that run in the background.\r\n\r\nThe person behind these steps is called the backend developer. He or she also uses programming languages â€‹â€‹such as PHP.', 0, '2020-03-10 19:18:11'),
(8, 'Web developer', 'A web developer is a programmer who specializes in, or is specifically engaged in, the development of World Wide Web applications using a clientâ€“server model. The applications typically use HTML, CSS and JavaScript in the client, PHP, ASP.NET (C#) or Java in the server, and http for communications between client and server. A web content management system is often used to develop and maintain web applications.\r\n\r\nWeb developer is a sensitive animal and should not be observed directly in their natural habitat. Both them and their related cousin software developer had developed a terrible sense of humour, in which they will share and talk about IT meme which no one else in Earth could understand. Web developer had been recorded to be \"tame\" and \"easy to pet\", but they could be very dangerous and had shown concerned behaviors such as throwing their machine toy after 4 hours of typing on it. If these situations arise, it had been advised to give the web developer a banana and take him to a nice, comfortable bed.', 0, '2020-03-10 19:31:25');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `date_created`) VALUES
(1, 'vu@gmail.com', '$2y$10$Xik30HwkjuwBlFCO1m7Y8Ow24SbypSVvymREEAse8COq3W249CnVy', '2020-03-13 20:05:25'),
(2, 'test@gmail.com', '$2y$10$Xik30HwkjuwBlFCO1m7Y8Ow24SbypSVvymREEAse8COq3W249CnVy', '2020-03-13 20:12:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
