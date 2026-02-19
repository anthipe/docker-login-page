DROP TABLE IF EXISTS `accounts`;
CREATE TABLE `accounts` (
  `account_id` int NOT NULL AUTO_INCREMENT,
  `employee_id` smallint NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  PRIMARY KEY (`account_id`),
  UNIQUE KEY `username` (`username`),
  KEY `employee_id` (`employee_id`)
);

--
-- Dumping data for table `accounts`
--


INSERT INTO `accounts` VALUES (1,1,'ndavolio','c2d735ed61274b73ed20a49594661e35185797b6ee082cb5145383e548d4f9d0'),(2,2,'afuller','920a9b62afa3169f6acb834bc6166770ca9df63516355a3aafe6970f259efc3e'),(3,3,'jleverling','356b964e125ff2d6b8ac99d4c5471425379fd88311a8e0f1d4833a997835f2df'),(4,4,'mpeacock','499bc7df9d8873c1c38e6898177c343b2a34d2eb43178a9eb4efcb993366c8cd'),(5,5,'sbuchanan','6c94e35ccc352d4e9ef0b99562cff995a5741ce8de8ad11b568892934daee366'),(16,10,'jdoe','ce8457d59078a699acb70416f88155a96a906b7b7aad43708402e3a3bcc8a4b4'),(17,11,'asmith','f76cb816b3f74ecf30d387c64869038ac163fe26f8aabd727c1071dd567fc3d5'),(18,12,'mjones','7929065522441d4053cba7ebffb2d224585a110b13840ff69cf0e89b725af9e7'),(19,13,'kbrown','c75b70bb03291ccdee7c81004d8b1778c01ce0644aab2addcb09f631dcb16e47'),(20,14,'lwilson','f4e99211184a248ac2b1bb736b2f241982bdbfb599a6a1b62d5c50a1cb7ddbe6');
