--
-- MySQL 5.6.17
-- Thu, 03 Apr 2014 04:29:05 +0000
--

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=5;

INSERT INTO `courses` (`id`, `crn`, `name`, `description`, `instructor_id`, `semester`, `slot`, `modified`, `modified_by`) VALUES 
('3', '1091', 'Test course', 'Test', '2', '1', '2', '1396417732', 'SYS'),
('4', '1234', 'cs 1', 'fghjj', '2', '2', '8', '1396473157', 'SYS');

CREATE TABLE `days` (
   `id` int(11) not null auto_increment,
   `day` varchar(11) not null,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=8;

INSERT INTO `days` (`id`, `day`) VALUES 
('1', 'Sunday'),
('2', 'Monday'),
('3', 'Tuesday'),
('4', 'Wednesday'),
('5', 'Thursday'),
('6', 'Friday'),
('7', 'Saturday');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=3;

INSERT INTO `slot_allocation` (`id`, `course_id`, `slot_id`, `modified`, `modified_by`) VALUES 
('1', '3', '2', '1396398658', 'SYS'),
('2', '4', '8', '1396473157', 'SYS');

CREATE TABLE `slot_schedule` (
   `id` int(11) not null auto_increment,
   `slot_id` int(11) not null,
   `start_time` varchar(200) not null,
   `end_time` varchar(200) not null,
   `day_id` int(11) not null,
   `modified` int(11) not null,
   `modified_by` varchar(200) not null,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=50;

INSERT INTO `slot_schedule` (`id`, `slot_id`, `start_time`, `end_time`, `day_id`, `modified`, `modified_by`) VALUES 
('4', '1', '8:00 AM', '9:15 AM', '2', '1396487058', 'arama.james@gmail.com'),
('5', '1', '8:00 AM', '9:15 AM', '5', '1396487058', 'arama.james@gmail.com'),
('6', '2', '9:30 AM', '10:45 AM', '2', '1396488010', 'arama.james@gmail.com'),
('7', '2', '9:30 AM', '10:45 AM', '5', '1396488010', 'arama.james@gmail.com'),
('8', '3', '8:00 AM', '9:15 AM', '3', '1396489342', 'arama.james@gmail.com'),
('9', '3', '8:00 AM', '9:15 AM', '6', '1396489342', 'arama.james@gmail.com'),
('10', '4', '9:30 AM', '10:45 AM', '3', '1396489420', 'arama.james@gmail.com'),
('11', '4', '9:30 AM', '10:45 AM', '6', '1396489420', 'arama.james@gmail.com'),
('12', '5', '8:00 AM', '9:15 AM', '4', '1396489512', 'arama.james@gmail.com'),
('13', '5', '11:00 AM', '12:15 PM', '6', '1396489512', 'arama.james@gmail.com'),
('14', '6', '9:30 AM', '10:45 AM', '4', '1396489590', 'arama.james@gmail.com'),
('15', '6', '11:00 AM', '12:15 PM', '2', '1396489590', 'arama.james@gmail.com'),
('16', '7', '11:00 AM', '12:15 PM', '3', '1396489638', 'arama.james@gmail.com'),
('17', '7', '11:00 AM', '12:15 PM', '5', '1396489638', 'arama.james@gmail.com'),
('18', '8', '12:30 PM', '1:45 PM', '2', '1396489710', 'arama.james@gmail.com'),
('19', '8', '12:30 PM', '1:45 PM', '5', '1396489710', 'arama.james@gmail.com'),
('20', '9', '12:30 PM', '1:45 PM', '3', '1396489778', 'arama.james@gmail.com'),
('21', '9', '12:30 PM', '1:45 PM', '6', '1396489778', 'arama.james@gmail.com'),
('22', '10', '2:00 PM', '3:15 PM', '2', '1396489848', 'arama.james@gmail.com'),
('23', '10', '2:00 PM', '3:15 PM', '5', '1396489848', 'arama.james@gmail.com'),
('24', '11', '2:00 PM', '3:15 PM', '3', '1396489928', 'arama.james@gmail.com'),
('25', '11', '2:00 PM', '3:15 PM', '6', '1396489928', 'arama.james@gmail.com'),
('26', '12', '2:00 PM', '3:15 PM', '4', '1396490012', 'arama.james@gmail.com'),
('27', '12', '3:30 PM', '4:45 PM', '6', '1396490012', 'arama.james@gmail.com'),
('28', '17', '6:30 PM', '7:45 PM', '2', '1396490154', 'arama.james@gmail.com'),
('29', '17', '6:30 PM', '7:30 PM', '4', '1396490154', 'arama.james@gmail.com'),
('30', '18', '6:30 PM', '7:45 PM', '3', '1396490215', 'arama.james@gmail.com'),
('31', '18', '6:30 PM', '7:45 PM', '5', '1396490215', 'arama.james@gmail.com'),
('32', '19', '8:00 PM', '9:15 PM', '2', '1396490267', 'arama.james@gmail.com'),
('33', '19', '8:00 PM', '9:15 PM', '4', '1396490267', 'arama.james@gmail.com'),
('34', '20', '8:00 PM', '9:15 PM', '3', '1396490348', 'arama.james@gmail.com'),
('35', '13', '3:30 PM', '4:45 PM', '2', '1396490407', 'arama.james@gmail.com'),
('36', '13', '3:30 PM', '4:45 PM', '4', '1396490407', 'arama.james@gmail.com'),
('37', '14', '3:30 PM', '4:45 PM', '3', '1396490457', 'arama.james@gmail.com'),
('38', '14', '3:30 PM', '4:45 PM', '5', '1396490457', 'arama.james@gmail.com'),
('39', '15', '5:00 PM', '6:15 PM', '2', '1396490500', 'arama.james@gmail.com'),
('40', '15', '5:00 PM', '6:15 PM', '4', '1396490500', 'arama.james@gmail.com'),
('41', '16', '5:00 PM', '6:15 PM', '3', '1396490541', 'arama.james@gmail.com'),
('42', '16', '5:00 PM', '6:15 PM', '5', '1396490541', 'arama.james@gmail.com'),
('43', '21', '6:30 PM', '9:15 PM', '2', '1396498618', 'arama.james@gmail.com'),
('44', '22', '6:30 PM', '9:15 PM', '3', '1396498668', 'arama.james@gmail.com'),
('45', '23', '6:30 PM', '9:15 PM', '4', '1396498701', 'arama.james@gmail.com'),
('46', '24', '6:15 PM', '9:30 PM', '5', '1396498761', 'arama.james@gmail.com'),
('47', '25', '8:00 AM', '10:45 AM', '7', '1396498809', 'arama.james@gmail.com'),
('48', '26', '11:00 AM', '1:45 PM', '7', '1396498853', 'arama.james@gmail.com'),
('49', '27', '2:00 PM', '4:45 PM', '7', '1396498900', 'arama.james@gmail.com');

CREATE TABLE `slots` (
   `id` int(11) not null auto_increment,
   `slot` varchar(11) not null,
   `capacity` int(11) not null,
   `modified` int(11) not null,
   `modified_by` varchar(200) not null,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=28;

INSERT INTO `slots` (`id`, `slot`, `capacity`, `modified`, `modified_by`) VALUES 
('1', '1', '5', '1396487058', 'arama.james@gmail.com'),
('2', '2', '5', '1396488010', 'arama.james@gmail.com'),
('3', '3', '5', '1396489342', 'arama.james@gmail.com'),
('4', '4', '5', '1396489420', 'arama.james@gmail.com'),
('5', '5', '5', '1396489512', 'arama.james@gmail.com'),
('6', '6', '5', '1396489590', 'arama.james@gmail.com'),
('7', '7', '5', '1396489638', 'arama.james@gmail.com'),
('8', '8', '5', '1396489710', 'arama.james@gmail.com'),
('9', '9', '5', '1396489778', 'arama.james@gmail.com'),
('10', '10', '5', '1396489848', 'arama.james@gmail.com'),
('11', '11', '5', '1396489928', 'arama.james@gmail.com'),
('12', '12', '5', '1396490012', 'arama.james@gmail.com'),
('13', '13', '6', '1396490407', 'arama.james@gmail.com'),
('14', '14', '6', '1396490457', 'arama.james@gmail.com'),
('15', '15', '6', '1396490500', 'arama.james@gmail.com'),
('16', '16', '6', '1396490541', 'arama.james@gmail.com'),
('17', '17', '7', '1396490154', 'arama.james@gmail.com'),
('18', '18', '6', '1396490215', 'arama.james@gmail.com'),
('19', '19', '7', '1396490267', 'arama.james@gmail.com'),
('20', '20', '7', '1396490348', 'arama.james@gmail.com'),
('21', '21', '5', '1396498618', 'arama.james@gmail.com'),
('22', '22', '5', '1396498668', 'arama.james@gmail.com'),
('23', '23', '5', '1396498701', 'arama.james@gmail.com'),
('24', '24', '5', '1396498761', 'arama.james@gmail.com'),
('25', '25', '5', '1396498809', 'arama.james@gmail.com'),
('26', '26', '5', '1396498853', 'arama.james@gmail.com'),
('27', '27', '5', '1396498900', 'arama.james@gmail.com');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=4;

INSERT INTO `users` (`id`, `email`, `first_name`, `last_name`, `password`, `role_id`, `modified`, `modified_by`) VALUES 
('2', 'arama.james@gmail.com', 'James', 'Arama', 'c747a57bf4405fbce591c994e928b00521f260e3', '1', '1396458102', 'SYS'),
('3', 'ronncoleman@gmail.com', 'Ron', 'Coleman', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2', '1396472562', 'SYS');