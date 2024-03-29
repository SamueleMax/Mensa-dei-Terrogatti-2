CREATE TABLE menu (
    id int NOT NULL AUTO_INCREMENT,
    category varchar(255),
    name varchar(255),
    price int,
    PRIMARY KEY (id)
);
CREATE TABLE orders (
    username varchar(255),
    items JSON
);
CREATE TABLE statuses (
    status varchar(255),
    value boolean
);
INSERT INTO statuses (status, value) VALUES ("orders_open", false);
INSERT INTO menu (category, name, price) VALUES
("Focacce", "Focaccia vuota", 100),
("Focacce", "Focaccia vuota grande", 150),
("Focacce", "Focaccia prosciutto cotto e formaggio", 200),
("Focacce", "Focaccia salame e formaggio", 200),
("Pizze", "Pizza margherita", 150),
("Panini", "Panino prosciutto cotto e formaggio", 200),
("Panini", "Panino salame e formaggio", 200),
("Panini", "Panino pancetta", 200),
("Panini", "Panino speck e brie", 200),
("Panini", "Panino salame piccante", 200),
("Panini", "Panino cotoletta", 200),
("Panini", "Panino cotoletta ketchup", 200),
("Panini", "Panino cotoletta maionese", 200),
("Brioche", "Brioche vuota", 100),
("Brioche", "Brioche crema", 100),
("Brioche", "Brioche marmellata", 100),
("Brioche", "Brioche cioccolato", 100),
("Brioche", "Brioche pistacchio", 100),
("Brioche", "Brioche frutti di bosco", 100),
("Panini gourmet", "Panino cotoletta patatine maionese", 250),
("Panini gourmet", "Panino cotoletta patatine ketchup", 250),
("Panini gourmet", "Panino cordonblu formaggio pomodoro", 250),
("Panini gourmet", "Panino prosciutto crudo pomodoro mozzarella insalata", 250),
("Panini gourmet", "Panino prosciutto cotto verdure grigliate", 250),
("Panini gourmet", "Panino speck brie pomodoro insalata", 250),
("Panini gourmet", "Panino hamburger scamorza pomodoro", 250),
("Panini gourmet", "Panino cotoletta insalata", 250),
("Bibite", "Coca cola", 80),
("Bibite", "Pepsi twist", 80),
("Bibite", "7 UP", 80),
("Bibite", "Chinotto", 80),
("Bibite", "The pesca 1/2 lt", 100),
("Bibite", "The limone 1/2 lt", 100),
("Bibite", "Acqua naturale", 40),
("Bibite", "Acqua gasata", 40);

