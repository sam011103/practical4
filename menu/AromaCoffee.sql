
CREATE TABLE IF Not EXISTS cake(
    id VARCHAR(5) NOT NULL,
    image VARCHAR(25) NOT NULL,
    title VARCHAR(25) NOT NULL,
    description VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    PRIMARY KEY(id),
    UNIQUE KEY(title)
);

INSERT INTO cake VALUES ("C01","tiramisu.jpeg","Tiramisu Cake","Coffee flavoured Italian dessert made with Oreo base, cream cheese & dark chocolate.",12.60);
INSERT INTO cake VALUES ("C02","chocomuffin.jpg","Chocolate Muffin","Sinful chocolate chip muffin with decadent chocolate lava filling that could make you fall in love instantly.",6.50);

CREATE TABLE IF Not EXISTS coffee(
    id VARCHAR(5) NOT NULL,
    image VARCHAR(25) NOT NULL,
    title VARCHAR(25) NOT NULL,
    description VARCHAR(255) NOT NULL,
    hotPrice DECIMAL(10,2) NOT NULL,
    coldPrice DECIMAL(10,2) NOT NULL,
    PRIMARY KEY(id),
    UNIQUE KEY(title)
);

INSERT INTO coffee VALUES ("D01","latte.jpeg","Latte","Rich espresso, steamed milk and a dollop of foam.",8.50,9.50);
INSERT INTO coffee VALUES ("D02","chocolate.jpg","Chocolate","Made with Australian chocolate. (337kcal)",10,11);

CREATE TABLE IF Not EXISTS juice(
    id VARCHAR(5) NOT NULL,
    image VARCHAR(25) NOT NULL,
    title VARCHAR(25) NOT NULL,
    description VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    PRIMARY KEY(id),
    UNIQUE KEY(title)
);

INSERT INTO juice VALUES ("J01","watermelon.jpg","Watermelon Juice","Try out our refreshing watermelon juice if it is a hot day.",7.50);
INSERT INTO juice VALUES ("J02","apple.jpeg","Apple Juice","Sweet apple juice that will bring you a lot of happiness.",6.50);
