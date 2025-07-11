CREATE TABLE IF NOT EXISTS payments (
    id uuid NOT NULL PRIMARY KEY DEFAULT gen_random_uuid(),
    transaction_id uuid NOT NULL REFERENCES transactions (id),
    payment_method VARCHAR(100), -- e.g., Credit Card, PayPal
    amount_paid DECIMAL(10, 2) NOT NULL,
    payment_status VARCHAR(50) DEFAULT 'Unpaid', -- e.g., Paid, Failed
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

