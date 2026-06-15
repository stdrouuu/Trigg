-- Table admin 
CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Insert default admin (username: admin, password: admin123 (hash))
INSERT INTO admin (username, password) VALUES ('admin', '$2y$10$L12s1Y.3X7zKUX10yqE1IeY07HscC4K1K2XwP8tN/lFkMhXg7d8iK');

-- Table products (CRUD)
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price INT NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    label ENUM('PLAYSTATION', 'SWITCH 2', 'OTHER') NOT NULL DEFAULT 'OTHER',
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert sample products
INSERT INTO products (name, price, image, label, description) VALUES
('NBA 2K26', 815000, 'assets/img/nba.jpg', 'PLAYSTATION', 'Command every court with authenticity and realism Powered by ProPLAY, giving you ultimate control over how you play in NBA 2K25.'),
('SpongeBob: Titans of the Tide', 479000, 'assets/img/spongebob.jpg', 'SWITCH 2', 'Seamlessly switch between SpongeBob and Patrick and combine their unique skills to save Bikini Bottom from total ghostification.'),
('Kirby: Air Riders', 950000, 'assets/img/kirby.jpg', 'SWITCH 2', 'Ready, set, battle! Charge, boost, and spin to attack your rivals in Kirby Air Riders, a fast-paced vehicle action featuring Kirby and crew.'),
('Call of Duty: Black Ops 7', 999000, 'assets/img/codbo7.jpg', 'PLAYSTATION', 'In Call of Duty Black Ops 7, Treyarch and Raven Software are bringing players the biggest Black Ops ever.'),
('Ninja Gaiden 4', 1045000, 'assets/img/ninja.jpg', 'PLAYSTATION', 'The definitive ninja action-adventure franchise returns with NINJA GAIDEN 4!'),
('Ghost Of Yotei', 1029000, 'assets/img/yotei.jpg', 'PLAYSTATION', 'Taking place 300 years after Ghost of Tsushima, this standalone experience follows a haunted, lone mercenary named Atsu.'),
('The Last of Us Part I', 700000, 'assets/img/tlou1.png', 'PLAYSTATION', 'Discover the award-winning game that inspired the critically acclaimed television show.'),
('God of War Ragnarok', 703200, 'assets/img/gow.png', 'PLAYSTATION', 'Kratos and Atreus embark on a mythic journey for answers before Ragnarok arrives.'),
('Red Dead Redemption 2', 3000, 'assets/img/rdr2.png', 'PLAYSTATION', 'Arthur Morgan and the Van der Linde Gang are outlaws on the run.'),
('The Last of Us Part II', 850000, 'assets/img/tlou2.png', 'PLAYSTATION', 'Experience the winner of over 300 Game of the Year awards, now on Playstation.'),
('Spiderman: Miles Morales', 350000, 'assets/img/spidermanmiles.png', 'PLAYSTATION', 'After the events of Spider-Man Remastered, teenage Miles Morales is adjusting to his new home.'),
('Lynked: Banner of the Spark', 119999, 'assets/img/lynked.jpg', 'SWITCH 2', 'Build your squad, choose abilities, and fight through a fractured kingdom in this tactical adventure.'),
('Jurassic World: Evolution 2', 749000, 'assets/img/jurrasic.jpg', 'PLAYSTATION', 'Create and manage your own dinosaur park with new systems, smarter creatures, and more customization.'),
('EA Sports FC 26', 350000, 'assets/img/fc26.jpg', 'SWITCH 2', 'The Club is Yours in EA SPORTS FC 26. Play your way with an overhauled gameplay experience.'),
('Motogp 25', 350000, 'assets/img/motogp.jpg', 'SWITCH 2', 'Race through official tracks with realistic bike handling and a full career mode.'),
('PlayStation 5 Digital Edition Slim', 8199000, 'assets/img/ps5.jpg', 'PLAYSTATION', 'The PS5 Slim offers fast loading, sharp visuals, and a compact build with a 1TB SSD.'),
('Nintendo Switch 2 Console - 512GB', 8099000, 'assets/img/switch2.jpg', 'SWITCH 2', 'A new generation of hybrid gaming with better performance, improved display, and smooth portability.'),
('Nintendo Switch JoyCon - Green/Pink', 350000, 'assets/img/switch2joycon.jpg', 'SWITCH 2', 'A stylish JoyCon pair with responsive controls, motion support, and HD Rumble.'),
('DualSense Wireless Controller - Starlight Blue', 1499000, 'assets/img/dualsense.jpg', 'PLAYSTATION', 'A PS5 controller with haptic feedback, adaptive triggers, and a clean Starlight Blue finish.'),
('Miyoo Mini Plus Retro Game Portable', 875000, 'assets/img/miyoo.jpg', 'OTHER', 'Miyoo Mini Plus Retro Game Console, Portable Handheld Open Source Game Console.'),
('KontrolFreek Performance Grips - Inferno Red', 240000, 'assets/img/grips.jpg', 'PLAYSTATION', 'Anti-slip grips designed to improve comfort and control during intense gameplay.'),
('Nintendo Eshop Card USD $20', 609000, 'assets/img/mario.jpg', 'SWITCH 2', 'Add $20 credit to your Nintendo account for games, DLC, and digital content.'),
('Nintendo Eshop Card USD $35', 609000, 'assets/img/princess.jpg', 'SWITCH 2', 'Top up your Nintendo account with a $35 card for easy digital purchases.'),
('Nintendo Eshop Card USD $50', 844000, 'assets/img/bowser.jpg', 'SWITCH 2', 'Redeem $50 of eShop credit to buy games, add-ons, and other Nintendo content.'),
('Steam Wallet Gift Card (IDR 60.000)', 63300, 'assets/img/steam.jpg', 'OTHER', 'Add funds to your Steam account for games, items, and marketplace purchases.'),
('PlayStation Network Card IDR 200.000', 303300, 'assets/img/psstore.jpg', 'PLAYSTATION', 'Redeem IDR 200.000 credit for PSN games, DLC, subscriptions, and more.');

-- Table cart 
CREATE TABLE IF NOT EXISTS cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    qty INT NOT NULL DEFAULT 1,
    session_id VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Table favorites
CREATE TABLE IF NOT EXISTS favorites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    session_id VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);