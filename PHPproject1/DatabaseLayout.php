<?php

//Creating two tables, posts and users

//Posts:
/*+----+-----------+--------------+------------+
|     field      |     type     | specs      |
+----+-----------+--------------+------------+
|  id            | INT(11)      |            |
|  user_id       | INT(11)      |            |
|  title         | VARCHAR(255) |            |
|  slug          | VARCHAR(255) | UNIQUE     |
|  views         | INT(11)      |            |
|  image         | VARCHAR(255) |            |
|  body          | TEXT         |            |
|  published     | boolean      |            |
|  created_at    | TIMESTAMP    |            |
|  updated_at    | TIMESTAMP    |            |
+----------------+--------------+------------+*/

//Users:

/*+----+-----------+------------------------+------------+
|     field      |     type               | specs      |
+----+-----------+------------------------+------------+
|  id            | INT(11)                |            |
|  username      | VARCHAR(255)           | UNIQUE     |
|  email         | VARCHAR(255)           | UNIQUE     |
|  role          | ENUM("Admin","Author") |            |
|  password      | VARCHAR(255)           |            |
|  created_at    | TIMESTAMP              |            |
|  updated_at    | TIMESTAMP              |            |
+----------------+--------------+---------+------------+*/

//SQL Queries to create the tables:

/*CREATE TABLE `users` (
    `id` int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `username` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `role` enum('Author','Admin') DEFAULT NULL,
    `password` varchar(255) NOT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `posts` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` int(11) DEFAULT NULL,
    `title` varchar(255) NOT NULL,
    `slug` varchar(255) NOT NULL UNIQUE,
    `views` int(11) NOT NULL DEFAULT '0',
    `image` varchar(255) NOT NULL,
    `body` text NOT NULL,
    `published` tinyint(1) NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
     FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
   ) ENGINE=InnoDB DEFAULT CHARSET=latin1*/