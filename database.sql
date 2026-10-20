-- EcoTrace Africa - Core Database Architecture
-- Target Region: East Africa / Rwanda Organic Compliance Infrastructure

CREATE TABLE IF NOT EXISTS `farmers` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `farmer_name` VARCHAR(150) NOT NULL,
  `cooperative_id` INT DEFAULT NULL,
  `province` VARCHAR(50) DEFAULT 'Kigali',
  `district` VARCHAR(50) NOT NULL,
  `sector` VARCHAR(50) NOT NULL,
  `farm_size_hectares` DECIMAL(5,2) NOT NULL,
  `primary_crop` VARCHAR(100) DEFAULT 'Organic Chili',
  `registration_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `compliance_logs` (
  `log_id` INT AUTO_INCREMENT PRIMARY KEY,
  `farmer_id` INT NOT NULL,
  `organic_status` ENUM('In Transition', 'Certified Kilimohai', 'Suspended') DEFAULT 'In Transition',
  `synthetic_chemical_check` ENUM('Passed', 'Failed') NOT NULL DEFAULT 'Passed',
  `last_peer_inspection_date` DATE NOT NULL,
  `inspector_notes` TEXT DEFAULT NULL,
  FOREIGN KEY (`farmer_id`) REFERENCES `farmers`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `api_weather_logs` (
  `log_id` INT AUTO_INCREMENT PRIMARY KEY,
  `district` VARCHAR(50) NOT NULL,
  `recorded_temperature_c` DECIMAL(4,2) NOT NULL,
  `recorded_humidity_percent` INT NOT NULL,
  `soil_moisture_index` DECIMAL(4,2) DEFAULT NULL,
  `fetched_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed initial test developer data
INSERT INTO `farmers` (`farmer_name`, `district`, `sector`, `farm_size_hectares`, `primary_crop`) 
VALUES ('Kigali Eco Cooperative - Cluster A', 'Gasabo', 'Gikomero', 4.50, 'Organic Chili');