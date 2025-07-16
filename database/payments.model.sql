CREATE TABLE IF NOT EXISTS payments (
    id uuid NOT NULL PRIMARY KEY DEFAULT gen_random_uuid(),
    transaction_id uuid NOT NULL REFERENCES transactions (id),
    payment_method VARCHAR(100), -- 'Bitcoin' or 'In-Person'
    amount_paid DECIMAL(10, 2),
    payment_status VARCHAR(50) DEFAULT 'Unpaid', -- e.g., Paid, Failed
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    -- Common to all payment methods
    meeting_date DATE NULL,
    meeting_time TIME NULL,
    contact_info VARCHAR(255) NULL,
    location TEXT NULL,

    -- In-Person only
    agreed_amount DECIMAL(10,2) NULL,
    additional_notes TEXT NULL
);