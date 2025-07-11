CREATE TABLE IF NOT EXISTS items (
    id uuid NOT NULL PRIMARY KEY DEFAULT gen_random_uuid(),
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    category VARCHAR(100),
    image_url TEXT,   
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
