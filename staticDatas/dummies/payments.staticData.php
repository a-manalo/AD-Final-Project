<?php
return [
    [
        'transaction_id' => 'tx-ae25d23c-cc11-4f0a-b17a-000000000001', // Buyer One
        'payment_method' => 'Credit Card',
        'amount_paid' => 25000.00,
        'payment_status' => 'Paid'
    ],
    [
        'transaction_id' => 'tx-ae25d23c-cc11-4f0a-b17a-000000000002', // Buyer Two
        'payment_method' => 'PayPal',
        'amount_paid' => 13800.00,
        'payment_status' => 'Paid'
    ],
    [
        'transaction_id' => 'tx-ae25d23c-cc11-4f0a-b17a-000000000003', // Buyer Three
        'payment_method' => 'Crypto',
        'amount_paid' => 31000.00,
        'payment_status' => 'Unpaid'
    ]
];
