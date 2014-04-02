--
-- MySQL 5.6.17
-- Tue, 01 Apr 2014 11:16:52 +0000
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=4;

INSERT INTO `course_schedule` (`id`, `course_id`, `start_time`, `end_time`, `day`, `modified`, `modified_by`) VALUES 
('3', '1', '1:00am', '1:30am', 'Tuesday', '1396350945', 'SYS');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=2;

INSERT INTO `courses` (`id`, `crn`, `name`, `description`, `instructor_id`, `semester`, `slot`, `modified`, `modified_by`) VALUES 
('1', '10908', 'Test course', 'testing stuff', '2', '1', '9', '1396350945', 'SYS');

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

CREATE TABLE `slots` (
   `id` int(11) not null auto_increment,
   `slot` varchar(11) not null,
   `modified` int(11) not null,
   `modified_by` varchar(200) not null,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=20;

INSERT INTO `slots` (`id`, `slot`, `modified`, `modified_by`) VALUES 
('1', '1', '1396068897', 'SYS'),
('2', '2', '1396328087', 'SYS'),
('3', '3', '1396328087', 'SYS'),
('4', '4', '1396328087', 'SYS'),
('5', '5', '1396328087', 'SYS'),
('6', '6', '1396328087', 'SYS'),
('7', '7', '1396328087', 'SYS'),
('8', '8', '1396328087', 'SYS'),
('9', '9', '1396328087', 'SYS'),
('10', '10', '1396328087', 'SYS'),
('11', '11', '1396328087', 'SYS'),
('12', '12', '1396328087', 'SYS'),
('13', '13', '1396328087', 'SYS'),
('14', '14', '1396328087', 'SYS'),
('15', '15', '1396328087', 'SYS'),
('16', '16', '1396328087', 'SYS'),
('17', 'Mon Nite', '1396328087', 'SYS'),
('18', 'Tue Nite', '1396328087', 'SYS'),
('19', 'Wed Nite', '1396328087', 'SYS');

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
('2', 'arama.james@gmail.com', 'James', 'Arama', 'c747a57bf4405fbce591c994e928b00521f260e3', '1', '1396109274', 'SYS');