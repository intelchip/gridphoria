--
-- [Users Table]
--

CREATE TABLE `users` (
   `id` int(11) not null auto_increment,
   `email` varchar(200) not null,
   `first_name` varchar(200) not null,
   `last_name` varchar(200) not null,
   `password` text not null,
   `role_id` int(11) not null,
   `modified` int(11) not null,
   `modified_by` varchar(200) not null,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=2;

INSERT INTO `users` (`id`, `email`, `first_name`, `last_name`, `password`, `role_id`, `modified`, `modified_by`) VALUES 
('1', 'arama.james@gmail.com', 'James', 'Arama', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', '1', '1392084764', 'SYS');


--
-- [Roles Table]
--
CREATE TABLE `roles` (
   `id` int(11) not null auto_increment,
   `role` varchar(200) not null,
   `modified` int(11) not null,
   `modified_by` varchar(200) not null,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=3;

INSERT INTO `roles` (`id`, `role`, `modified`, `modified_by`) VALUES 
('1', 'Chair', '1392081659', 'SYS'),
('2', 'Faculty', '1392081659', 'SYS');