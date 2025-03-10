<?php
header('Content-Type: application/json');

$locations = [
  [
    "id" => "cafe",
    "name" => "Le Café under the Dome",
    "category" => "dining",
    "description" => "An elegant café offering pastries, light meals, and refreshments under a magnificent dome.",
    "lat" => 24.466667,
    "lng" => 54.316666,
    "image" => "images/cafe.jpg",
    "extra_info" => "Enjoy handcrafted coffee, gourmet teas, and a selection of French-inspired pastries in a stunning dome-lit setting."
  ],
  [
    "id" => "pool",
    "name" => "Main Swimming Pool",
    "category" => "recreation",
    "description" => "Our signature infinity pool with stunning ocean views and luxurious cabanas.",
    "lat" => 24.465,
    "lng" => 54.317,
    "image" => "images/pool.jpg",
    "extra_info" => "The pool features temperature control, poolside bar service, and private cabanas for a relaxing experience."
  ],
  [
    "id" => "beach",
    "name" => "Private Beach",
    "category" => "recreation",
    "description" => "White sand beach with crystal clear waters, perfect for relaxation and water activities.",
    "lat" => 24.464,
    "lng" => 54.318,
    "image" => "images/beach.jpg",
    "extra_info" => "Beach facilities include sun loungers, umbrellas, a beachside café, and various water sports activities."
  ],
  [
    "id" => "spa",
    "name" => "The Hideaway Spa",
    "category" => "wellness",
    "description" => "Premium spa offering wellness treatments, massages, and beauty services.",
    "lat" => 24.467,
    "lng" => 54.319,
    "image" => "images/spa.jpg",
    "extra_info" => "Indulge in signature massages, aromatherapy sessions, and personalized wellness programs in a serene environment."
  ],
  [
    "id" => "restaurant",
    "name" => "Verduome Restaurant",
    "category" => "dining",
    "description" => "Fine dining restaurant featuring international cuisine prepared by award-winning chefs.",
    "lat" => 24.468,
    "lng" => 54.315,
    "image" => "images/restaurant.jpg",
    "extra_info" => "Experience a world-class dining experience with an extensive wine list and a menu crafted by Michelin-starred chefs."
  ],
  [
    "id" => "sports",
    "name" => "Water Sports Centre",
    "category" => "recreation",
    "description" => "Centre for all water sports activities including jet skiing, parasailing, kayaking, and more.",
    "lat" => 24.463,
    "lng" => 54.320,
    "image" => "images/sports.jpg",
    "extra_info" => "Enjoy thrilling water adventures including wakeboarding, banana boat rides, and guided snorkeling tours."
  ],
  [
    "id" => "tennis",
    "name" => "Tennis Courts",
    "category" => "recreation",
    "description" => "Professional-grade tennis courts available for guests of all skill levels.",
    "lat" => 24.469,
    "lng" => 54.321,
    "image" => "images/tennis.jpg",
    "extra_info" => "Play on state-of-the-art courts with expert coaching available for beginners and professionals alike."
  ],
  [
    "id" => "kids",
    "name" => "Adventure Kids Club",
    "category" => "family",
    "description" => "Supervised kids club with games, activities, and entertainment for children.",
    "lat" => 24.462,
    "lng" => 54.322,
    "image" => "images/kids.jpg",
    "extra_info" => "We provide a safe and fun environment with professional supervision for children aged 3-12 years."
  ]
];

echo json_encode($locations, JSON_PRETTY_PRINT);

?>
