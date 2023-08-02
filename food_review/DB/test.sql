

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



CREATE TABLE `admin` (
  `admin_name` varchar(20) NOT NULL,
  `admin_password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;



INSERT INTO `admin` (`admin_name`, `admin_password`) VALUES
('Admin', 'admin@123');


CREATE TABLE `feedback` (
  `food_accuracy` int(50) NOT NULL,
  `food_service` int(50) NOT NULL,
  `hygiene` int(50) NOT NULL,
  `quality` int(50) NOT NULL,
  `ambiance` int(50) NOT NULL,
  `server_behavior` int(50) NOT NULL,
  `additional_comments` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;




COMMIT;


