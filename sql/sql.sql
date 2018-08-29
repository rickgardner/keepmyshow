CREATE TABLE `keepnmyshow`.`shows` (
  `show_id` INT NOT NULL AUTO_INCREMENT,
  `show_name` VARCHAR(45) NULL,
  `show_description` VARCHAR(45) NULL,
  `show_network` VARCHAR(45) NULL,
  `show_image_large` VARCHAR(45) NULL,
  `show_image_small` VARCHAR(45) NULL,
  `show_uri` VARCHAR(45) NULL,
  PRIMARY KEY (`show_id`));

