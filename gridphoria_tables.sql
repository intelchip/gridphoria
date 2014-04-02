--
-- MySQL 5.6.17
-- Wed, 02 Apr 2014 05:51:26 +0000
--

CREATE TABLE `course_schedule` (
   `id` int(11) not null auto_increment,
   `course_id` int(11) not null,
   `start_time` varchar(200) not null,
   `end_time` varchar(200) not null,
   `day` varchar(200) not null,
   `modified` int(11) not null,
   `modified_by` varchar(200) not null,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=16;

INSERT INTO `course_schedule` (`id`, `course_id`, `start_time`, `end_time`, `day`, `modified`, `modified_by`) VALUES 
('15', '3', '1:00am', '2:00am', 'Monday', '1396417732', 'SYS');

CREATE TABLE `courses` (
   `id` int(11) not null auto_increment,
   `crn` int(11) not null,
   `name` varchar(200) not null,
   `description` text not null,
   `instructor_id` int(11) not null,
   `semester` int(11) not null,
   `slot` int(11) not null,
   `modified` int(11) not null,
   `modified_by` varchar(200) not null,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=4;

INSERT INTO `courses` (`id`, `crn`, `name`, `description`, `instructor_id`, `semester`, `slot`, `modified`, `modified_by`) VALUES 
('3', '1091', 'Test course', 'Test', '2', '1', '2', '1396417732', 'SYS');

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

CREATE TABLE `semesters` (
   `id` int(11) not null auto_increment,
   `semester` varchar(200) not null,
   `modified` int(11) not null,
   `modified_by` varchar(200) not null,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=3;

INSERT INTO `semesters` (`id`, `semester`, `modified`, `modified_by`) VALUES 
('1', 'Fall', '1396068897', 'SYS'),
('2', 'Spring', '1396068897', 'SYS');

CREATE TABLE `slot_allocation` (
   `id` int(11) not null auto_increment,
   `course_id` int(11) not null,
   `slot_id` int(11) not null,
   `modified` int(11) not null,
   `modified_by` varchar(11) not null,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=2;

INSERT INTO `slot_allocation` (`id`, `course_id`, `slot_id`, `modified`, `modified_by`) VALUES 
('1', '3', '2', '1396398658', 'SYS');

CREATE TABLE `slots` (
   `id` int(11) not null auto_increment,
   `slot` varchar(11) not null,
   `capacity` int(11) not null,
   `modified` int(11) not null,
   `modified_by` varchar(200) not null,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=22;

INSERT INTO `slots` (`id`, `slot`, `capacity`, `modified`, `modified_by`) VALUES 
('1', '1', '5', '1396409435', 'arama.james@gmail.com'),
('2', '2', '5', '1396397227', 'arama.james@gmail.com'),
('3', '3', '5', '1396397251', 'arama.james@gmail.com'),
('4', '4', '5', '1396397260', 'arama.james@gmail.com'),
('5', '5', '5', '1396397269', 'arama.james@gmail.com'),
('6', '6', '5', '1396397278', 'arama.james@gmail.com'),
('7', '7', '5', '1396397287', 'arama.james@gmail.com'),
('8', '8', '5', '1396397298', 'arama.james@gmail.com'),
('9', '9', '5', '1396397307', 'arama.james@gmail.com'),
('10', '10', '5', '1396397324', 'arama.james@gmail.com'),
('11', '11', '5', '1396397337', 'arama.james@gmail.com'),
('12', '12', '5', '1396397349', 'arama.james@gmail.com'),
('13', '13', '6', '1396397370', 'arama.james@gmail.com'),
('14', '14', '6', '1396397379', 'arama.james@gmail.com'),
('15', '15', '6', '1396397390', 'arama.james@gmail.com'),
('16', '16', '6', '1396397403', 'arama.james@gmail.com'),
('17', 'Mon Nite', '7', '1396397423', 'arama.james@gmail.com'),
('18', 'Tue Nite', '6', '1396397441', 'arama.james@gmail.com'),
('19', 'Wed Nite', '7', '1396397453', 'arama.james@gmail.com'),
('20', 'Thur Nite', '7', '1396397723', 'arama.james@gmail.com');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=3;

INSERT INTO `users` (`id`, `email`, `first_name`, `last_name`, `password`, `role_id`, `modified`, `modified_by`) VALUES 
('2', 'arama.james@gmail.com', 'James', 'Arama', 'c747a57bf4405fbce591c994e928b00521f260e3', '1', '1396414545', 'SYS');