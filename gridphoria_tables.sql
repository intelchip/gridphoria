--
-- MySQL 5.6.17
-- Sat, 29 Mar 2014 14:18:37 +0000
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=3;

INSERT INTO `course_schedule` (`id`, `course_id`, `start_time`, `end_time`, `day`, `modified`, `modified_by`) VALUES 
('1', '1', '12:30am', '12:30am', 'Tuesday', '1396102585', 'SYS'),
('2', '1', '12:30am', '1:30am', 'Friday', '1396102585', 'SYS');

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
('1', '1212212', 'Test', 'teasdasdasdsa', '2', '1', '1', '1396102585', 'SYS');

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
   `slot_number` int(11) not null,
   `modified` int(11) not null,
   `modified_by` varchar(200) not null,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=2;

INSERT INTO `slots` (`id`, `slot_number`, `modified`, `modified_by`) VALUES 
('1', '1', '1396068897', 'SYS');

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
('2', 'arama.james@gmail.com', 'James', 'Arama', 'c747a57bf4405fbce591c994e928b00521f260e3', '1', '1396100783', 'SYS');