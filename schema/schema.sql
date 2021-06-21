SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `user` (
    `name` varchar(280) NOT NULL,
    `phone` varchar(280) NOT NULL,
    `email` varchar(280) NOT NULL PRIMARY KEY,
    `pwd` varchar(280) NOT NULL,
    `role` varchar(280) NOT NULL,
    `status` varchar(280) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `book` (
  `bname` varchar(280) NOT NULL,
  `author` varchar(280) NOT NULL,
  `genre` varchar(280) NOT NULL,
  `isbn` varchar(280) NOT NULL PRIMARY KEY,
  `pages` varchar(280) NOT NULL,
  `publisher` varchar(280) NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `book_stats` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `isbn` varchar(280) NOT NULL,
  `email` varchar(280) NOT NULL,
  `status` varchar(280) NOT NULL,
  `request_date` date,
  `issue_date` date,
  `return_date` date
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `book_stats` AUTO_INCREMENT=1;
