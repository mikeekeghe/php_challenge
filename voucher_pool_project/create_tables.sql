CREATE TABLE `recipient_tbl` (
  `recipient_id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `email` varchar(30) NOT NULL,
  `name` varchar(200) NOT NULL
   `voucher_id` varchar(30) NOT NULL
) 


CREATE TABLE `special_offer_tbl` (
  `offer_id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `offer_name` varchar(30) NOT NULL,
  `discount_percent` varchar(20) NOT NULL,
  `voucher_id` varchar(50) NOT NULL,
  `recipient` varchar(200) NOT NULL
) 

CREATE TABLE `voucher_code_tbl` (
  `voucher_id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `voucher_code` varchar(50) NOT NULL,
  `recipient_id` varchar(20) NOT NULL,
  `expiry_date` varchar(50) NOT NULL,
  `use_once` varchar(6) NOT NULL,
  `date_used` varchar(50) NOT NULL,
  `percentage_discount` varchar(10) NOT NULL,
  `date_created` varchar(30) NOT NULL
) 
