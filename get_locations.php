<?php
header('Content-Type: application/json');

$locations = [
  ["id" => "cafe", "name" => "Le Café under the Dome", "category" => "dining", "description" => "An elegant café offering pastries, light meals and refreshments under a magnificent dome.", "lat" => 24.466667, "lng" => 54.316666, "image" => "images/cafe.jpg"],
  ["id" => "pool", "name" => "Main Swimming Pool", "category" => "recreation", "description" => "Our signature infinity pool with stunning ocean views and luxurious cabanas.", "lat" => 24.465, "lng" => 54.317, "image" => "images/pool.jpg"],
  ["id" => "beach", "name" => "Private Beach", "category" => "recreation", "description" => "White sand beach with crystal clear waters, perfect for relaxation and water activities.", "lat" => 24.464, "lng" => 54.318, "image" => "images/beach.jpg"],
  ["id" => "spa", "name" => "The Hideaway Spa", "category" => "wellness", "description" => "Premium spa offering wellness treatments, massages, and beauty services.", "lat" => 24.467, "lng" => 54.319, "image" => "images/spa.jpg"],
  ["id" => "restaurant", "name" => "Verduome Restaurant", "category" => "dining", "description" => "Fine dining restaurant featuring international cuisine prepared by award-winning chefs.", "lat" => 24.468, "lng" => 54.315, "image" => "images/restaurant.jpg"],
  ["id" => "sports", "name" => "Water Sports Centre", "category" => "recreation", "description" => "Centre for all water sports activities including jet skiing, parasailing, kayaking, and more.", "lat" => 24.463, "lng" => 54.320, "image" => "images/sports.jpg"],
  ["id" => "tennis", "name" => "Tennis Courts", "category" => "recreation", "description" => "Professional-grade tennis courts available for guests of all skill levels.", "lat" => 24.469, "lng" => 54.321, "image" => "images/tennis.jpg"],
  ["id" => "kids", "name" => "Adventure Kids Club", "category" => "family", "description" => "Supervised kids club with games, activities, and entertainment for children.", "lat" => 24.462, "lng" => 54.322, "image" => "images/kids.jpg"]
];

echo json_encode($locations);
?>
