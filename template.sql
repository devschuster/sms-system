DROP DATABASE IF EXISTS `job_sms`;
CREATE DATABASE job_sms
    DEFAULT CHARACTER SET = 'utf8mb4';
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `jobID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `jobName` varchar(255) DEFAULT NULL COMMENT 'Job Name',
  `jobDescription` varchar(255) DEFAULT NULL COMMENT 'Job Description',
  `creationDate` datetime DEFAULT NULL COMMENT 'Job Creation Date',
  `startDate` datetime DEFAULT NULL COMMENT 'Job Start Date',
  `endDate` datetime DEFAULT NULL COMMENT 'Job End Date',
  `jobStatus` varchar(255) DEFAULT NULL COMMENT 'Job Status',
  `jobProgress` varchar(255) DEFAULT NULL COMMENT 'Job Progress Percentage',
  `smsSent` varchar(255) DEFAULT NULL COMMENT 'SMS Sent Percentage',
  `smsDelivered` varchar(255) DEFAULT NULL COMMENT 'SMS Delivered Percentage',
  `smsUndelivered` varchar(255) DEFAULT NULL COMMENT 'SMS Undelivered Percentage',
  `smsFailed` varchar(255) DEFAULT NULL COMMENT 'SMS Failed Percentage',
  PRIMARY KEY (`jobID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `sms`;
CREATE TABLE `sms` (
  `smsID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `smsPhone` varchar(255) DEFAULT NULL COMMENT 'Phone number',
  `smsMessage` varchar(255) DEFAULT NULL COMMENT 'SMS Message',
  `sendDate` datetime DEFAULT NULL COMMENT 'Date Time SMS sent',
  `smsStatus` varchar(255) DEFAULT NULL COMMENT 'SMS Status',
  `jobID` int(11) DEFAULT NULL,
  PRIMARY KEY (`smsID`),
  KEY `jobID` (`jobID`),
  CONSTRAINT `fk_jobID` FOREIGN KEY (`jobID`) REFERENCES `jobs` (`jobID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;