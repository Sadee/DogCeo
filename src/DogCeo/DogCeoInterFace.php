<?php


namespace DogCeo;


interface DogCeoInterFace
{

    public function allBreeds();

    public function random();

    public function byBreed(string $breedName);

    public function bySubBreed(string $subBreedName);

}