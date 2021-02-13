<?php
require_once __DIR__ . '/../vendor/autoload.php';

use DogCeo\DogCeo;

$dc = new DogCeo();

echo "\n List all \n";
$dc->allBreeds();

var_dump($dc->error);
var_dump($dc->result);

echo "\n Random one \n";

$dc->random();
var_dump($dc->error);
var_dump($dc->result);

echo "\n by Breed \n";

$dc->byBreed('hound');
var_dump($dc->error);
var_dump($dc->result);

echo "\n by Sub Breed \n";

$dc->bySubBreed('hound');
var_dump($dc->error);
var_dump($dc->result);
