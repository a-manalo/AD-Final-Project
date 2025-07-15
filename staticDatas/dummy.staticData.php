<?php
$user = [
    'username' => 'shadownymph',
    'joined' => '2023-01-10',
    'reputation_score' => '4.5/5', // Added this based on the UI expectation (★★★★☆)
];

$userProducts = [
    [
        'name' => 'Ambrosia Dust',
        'price' => 12000,
        'description' => 'Fine golden powder...',
        'seller' => 'shadownymph',
        'category' => 'drugs',
        'image' => '/pages/product/assets/img/Drugs/ambrosia_dust.png'
    ],
    [
        'name' => 'Soma Resin',
        'price' => 10000,
        'description' => 'Sticky resin from Vedic rituals...',
        'seller' => 'shadownymph',
        'category' => 'drugs',
        'image' => '/pages/product/assets/img/Drugs/soma_resin.png'
    ]
];

$orderHistory = [
    [
        'product_name' => 'Petals of Yomi',
        'date' => '2024-06-20',
        'status' => 'Delivered'
    ],
    [
        'product_name' => 'Horn of the Centaur',
        'date' => '2024-07-02',
        'status' => 'Shipped'
    ],
    [ // Added another status to demonstrate the 'pending' or 'failed' styling
        'product_name' => 'Dragon\'s Breath Elixir',
        'date' => '2024-07-10',
        'status' => 'Pending'
    ],
    [
        'product_name' => 'Crimson Vial',
        'date' => '2024-07-12',
        'status' => 'Failed'
    ]
];