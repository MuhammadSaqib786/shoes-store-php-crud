CREATE DATABASE shoesdb;

USE shoesdb;

-- Create User table
CREATE TABLE myUser (
  user_id int PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(30) NOT NULL,
  password VARCHAR(30) NOT NULL,
  email VARCHAR(50) NOT NULL Unique,
  age INT(3) NOT NULL,
  phone INT(10) NOT NULL
);

CREATE TABLE Admin (
  
  email VARCHAR(30) PRIMARY KEY,
  password VARCHAR(30) NOT NULL
);

-- insert admin
INSERT INTO Admin (email, password) VALUES ('admin@gmail.com', 'admin');

-- Create Category table
CREATE TABLE Category (
  category_id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL
);
INSERT INTO Category (name) VALUES
  ('Men\'s Shoes'),
  ('Women\'s Shoes'),
  ('Kids\' Shoes'),
  ('Sports Shoes'),
  ('Formal Shoes'),
  ('Casual Shoes'),
  ('Sandals'),
  ('Slippers'),
  ('Boots'),
  ('Sneakers');


-- Create Product table
CREATE TABLE Product (
  product_id INT PRIMARY KEY AUTO_INCREMENT,
  category_id INT,
  name VARCHAR(100) NOT NULL,
  description TEXT NOT NULL,
  price DECIMAL(10, 2) NOT NULL,
  image VARCHAR(200) NOT NULL,
  FOREIGN KEY (category_id) REFERENCES Category(category_id)
);

INSERT INTO Product (category_id, name, description, price, image) VALUES
  (1, 'Men\'s Leather Dress Shoes', 'Premium leather dress shoes for men', 89.99, 'images/mens_leather_dress_shoes.jpg'),
  (1, 'Men\'s Sports Shoes', 'Comfortable sports shoes for men', 59.99, 'images/mens_sports_shoes.jpg'),
  (2, 'Women\'s High Heels', 'Elegant high heels for women', 79.99, 'images/womens_high_heels.jpg'),
  (2, 'Women\'s Casual Sneakers', 'Stylish casual sneakers for women', 69.99, 'images/womens_casual_sneakers.jpg'),
  (3, 'Kids\' Velcro Shoes', 'Easy-to-wear velcro shoes for kids', 39.99, 'images/kids_velcro_shoes.jpg'),
  (3, 'Kids\' Sandals', 'Comfortable sandals for kids', 29.99, 'images/kids_sandals.jpg'),
  (4, 'Running Shoes', 'Lightweight running shoes for sports enthusiasts', 79.99, 'images/running_shoes.jpg'),
  (5, 'Men\'s Oxford Shoes', 'Classic oxford shoes for formal occasions', 99.99, 'images/mens_oxford_shoes.jpg'),
  (6, 'Men\'s Loafers', 'Casual loafers for men', 49.99, 'images/mens_loafers.jpg'),
  (7, 'Women\'s Wedge Sandals', 'Stylish wedge sandals for women', 59.99, 'images/womens_wedge_sandals.jpg');

-- Create Cart table
CREATE TABLE Cart (
  cart_id INT PRIMARY KEY AUTO_INCREMENT,
  user_id INT,
  product_id INT,
  quantity INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES myUser(user_id),
  FOREIGN KEY (product_id) REFERENCES Product(product_id)
);

-- Create Order table
CREATE TABLE Orders (
  order_id INT PRIMARY KEY AUTO_INCREMENT,
  user_id INT,
  product_id INT,
  quantity INT NOT NULL,
  total_price DECIMAL(10, 2) NOT NULL,
  order_date DATETIME NOT NULL,
  FOREIGN KEY (user_id) REFERENCES myUser(user_id),
  FOREIGN KEY (product_id) REFERENCES Product(product_id)
);

