CREATE DATABASE IF NOT EXISTS coldnighter3;
USE coldnighter3;

-- Menu items table
CREATE TABLE menu_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    category ENUM('kopi', 'non-kopi', 'makanan', 'dessert') NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    emoji VARCHAR(10),
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Orders table
CREATE TABLE orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    queue_number VARCHAR(20) NOT NULL UNIQUE,
    table_number VARCHAR(10) NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    tax DECIMAL(10,2) NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    payment_method ENUM('qris', 'transfer', 'cash') NOT NULL,
    status ENUM('pending', 'preparing', 'ready', 'completed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Order items table
CREATE TABLE order_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    menu_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (menu_id) REFERENCES menu_items(id)
);

-- Feedback table
CREATE TABLE feedback (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    rating INT CHECK (rating BETWEEN 1 AND 5),
    category VARCHAR(50),
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert sample menu items
INSERT INTO menu_items (name, category, price, emoji, description) VALUES
('Americano', 'kopi', 28000, '☕', 'espresso + air panas. simple, bold.'),
('Cappuccino', 'kopi', 35000, '☕', 'espresso + steamed milk + foam tebal.'),
('Kopi Susu Gula Aren', 'kopi', 32000, '🧋', 'kopi susu dengan gula aren asli.'),
('V60 Pour Over', 'kopi', 42000, '☕', 'manual brew, karakter kopi beda level.'),
('Cold Brew', 'kopi', 38000, '🧊', '16 jam steep, smooth banget.'),
('Matcha Latte', 'non-kopi', 35000, '🍵', 'matcha grade A + oat milk.'),
('Teh Tarik', 'non-kopi', 22000, '🧋', 'teh susu kental, panas atau dingin.'),
('Mojito Virgin', 'non-kopi', 28000, '🍃', 'mint + lime + soda. seger banget.'),
('Avocado Toast', 'makanan', 35000, '🥑', 'sourdough + alpukat + telur setengah matang.'),
('Croissant', 'makanan', 28000, '🥐', 'butter croissant fresh baked.'),
('Nasi Goreng Barista', 'makanan', 42000, '🍳', 'nasi goreng spesial + telor mata sapi.'),
('Cheesecake', 'dessert', 32000, '🍰', 'new york style, creamy + dense.'),
('Tiramisu', 'dessert', 35000, '🍫', 'classic italian, pakai espresso shot.'),
('Brownies', 'dessert', 25000, '🍫', 'fudgy, dark chocolate. adiktif.'),
('Flat White', 'kopi', 36000, '☕', 'ristretto + velvet milk. intensitas tinggi.'),
('Lychee Tea', 'non-kopi', 26000, '🍹', 'teh bunga + lychee segar.');