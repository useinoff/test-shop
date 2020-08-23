<?php
require 'bootstrap.php';

$statement = <<<EOS
    CREATE TABLE `product` (
      `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
      `name` varchar(255) NOT NULL DEFAULT '',
      `price` double NOT NULL DEFAULT 0,
      `image` varchar(255) NOT NULL DEFAULT '',
      `insertedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
      `updatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    ) 
    ENGINE=InnoDB
    DEFAULT CHARSET=utf8mb4;
    
    INSERT INTO `product` (`id`, `name`, `price`, `image`, `insertedOn`, `updatedOn`)
VALUES
	(1, 'Товар', 10, 'source/images/item.png', '2020-08-23 14:08:56', '2020-08-23 14:09:33'),
	(2, 'Товар', 20, 'source/images/item.png', '2020-08-23 14:08:56', '2020-08-23 14:09:33'),
	(3, 'Товар', 30, 'source/images/item.png', '2020-08-23 14:08:56', '2020-08-23 14:09:33'),
	(4, 'Товар', 40, 'source/images/item.png', '2020-08-23 14:08:56', '2020-08-23 14:09:33'),
	(5, 'Товар', 50, 'source/images/item.png', '2020-08-23 14:08:56', '2020-08-23 14:09:33'),
	(6, 'Товар', 60, 'source/images/item.png', '2020-08-23 14:08:56', '2020-08-23 14:09:33'),
	(7, 'Товар', 70, 'source/images/item.png', '2020-08-23 14:08:56', '2020-08-23 14:09:33'),
	(8, 'Товар', 80, 'source/images/item.png', '2020-08-23 14:08:56', '2020-08-23 14:09:33'),
	(9, 'Товар', 90, 'source/images/item.png', '2020-08-23 14:08:56', '2020-08-23 14:09:33'),
	(10, 'Товар', 100, 'source/images/item.png', '2020-08-23 14:08:56', '2020-08-23 14:09:33'),
	(11, 'Товар', 110, 'source/images/item.png', '2020-08-23 14:08:56', '2020-08-23 14:09:33'),
	(12, 'Товар', 120, 'source/images/item.png', '2020-08-23 14:08:56', '2020-08-23 14:09:33'),
	(13, 'Товар', 130, 'source/images/item.png', '2020-08-23 14:08:56', '2020-08-23 14:09:33'),
	(14, 'Товар', 140, 'source/images/item.png', '2020-08-23 14:08:56', '2020-08-23 14:09:33'),
	(15, 'Товар', 150, 'source/images/item.png', '2020-08-23 14:08:56', '2020-08-23 14:09:33'),
	(16, 'Товар', 160, 'source/images/item.png', '2020-08-23 14:08:56', '2020-08-23 14:09:33'),
	(17, 'Товар', 170, 'source/images/item.png', '2020-08-23 14:08:56', '2020-08-23 14:09:33'),
	(18, 'Товар', 180, 'source/images/item.png', '2020-08-23 14:08:56', '2020-08-23 14:09:33');
        
EOS;

try {
    $createTable = $dbConnection->exec($statement);
    echo "Success!\n";
} catch (\PDOException $e) {
    exit($e->getMessage());
}