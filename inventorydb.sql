CREATE TABLE product_categories (id INT PRIMARY KEY, name VARCHAR (255));


CREATE TABLE products (id INT PRIMARY KEY, name VARCHAR(255), stock INT(11), price INT(11), category_id INT(11));

CREATE TABLE orders (id INT PRIMARY KEY, customer_name VARCHAR(255), phone VARCHAR (255), email VARCHAR (255), ordered_products INT(11));

CREATE TABLE ordered_products (product_id INT(11), quantity INT(11), order_ID INT(11));

ALTER TABLE `orders` ADD `date` DATE NOT NULL AFTER `ordered_products`;

ALTER TABLE `product_categories` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `products` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `orders` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;

INSERT INTO product_categories (`name`) VALUES ("stickers"), ("planners"), ("pens");



INSERT INTO `products` (`name`,`stock`,`price`,`category_id`) VALUES ("mini-clipboards","400","5","1");

INSERT INTO `products` (`name`,`stock`,`price`,`category_id`) VALUES ("moon phases","500","5","1"), ("stars", "300","2","1"), ("footballs", "400", "2", "1"), ("smiley faces", "1000", "1.50", "1"), ("lunar calendar", "10", "20", "2"), ("weekly", "200", "20", "2"), ("daily","100", "11.50","2"), ("black", "300", "2.50", "3"), ("blue felt","20", "4.25", "3");


ALTER TABLE `orders` ADD UNIQUE(`ordered_products`);
