CREATE TABLE IF NOT EXISTS public."users" (
    id uuid NOT NULL PRIMARY KEY DEFAULT gen_random_uuid(),
    username varchar(225) NOT NULL UNIQUE,
    password varchar(225) NOT NULL,
    email varchar(255) UNIQUE, 
    role varchar(50) NOT NULL DEFAULT 'buyer', -- other roles are seller, admin
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
