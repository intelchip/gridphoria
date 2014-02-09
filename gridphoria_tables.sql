--
-- [Users Table]
--
CREATE TABLE `users` (
   `id` int(11) not null auto_increment,
   `first_name` varchar(200) not null,
   `last_name` varchar(200) not null,
   `password` text not null,
   `role_id` int(11) not null,
   `modified` int(11) not null,
   `modified_by` varchar(200) not null,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
