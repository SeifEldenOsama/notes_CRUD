CREATE TABLE `notes` (
  `noteID` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `noteTitle` varchar(255) NOT NULL,
  `noteContent` varchar(255) NOT NULL,
  `noteDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO `notes` (`noteID`, `noteTitle`, `noteContent`, `noteDate`) VALUES
(1, 'seifelden', 'hello hiisiihfa sd\r\n', '2018-07-25 07:01:23'),

CREATE TABLE `user` (
  `username` varchar(255) NOT NULL PRIMARY KEY,
  `userEmail` varchar(255) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
);

INSERT INTO `user` (`username`, `userEmail`, `fullName`, `password`) VALUES
('seifelden', 'seifosama@gmail.com', 'seifelden', '098f6bcd4621d373cade4e832627b4f6'),

ALTER TABLE `user`
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);
