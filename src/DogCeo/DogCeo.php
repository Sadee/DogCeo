<?php

namespace DogCeo;

use Exception;

/**
 * Class DogCeo
 * @package DogCeo
 */
class DogCeo implements DogCeoInterFace
{

    /**
     * @var string
     */
    private $endpoint = "https://dog.ceo/api/";

    /**
     * Function name to call correct API function
     * @var string
     */
    private $funcUrl = "";

    /**
     * Curl request method
     * @var string
     */
    private $requestMethod = "GET";

    /**
     * @var array
     */
    private $postParams = [];

    /**
     * Cookie file to handle curl cookies
     * @var string
     */
    private $cookieFilePath = "/tmp/dog_cookie.txt";

    /**
     * This will be filled with successful response
     * @var string
     */
    public $result = "";

    /**
     * @var bool
     */
    public $error = false;

    /**
     * @var string
     */
    private $agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:81.0) Gecko/20100101 Firefox/81.0';

    /**
     * curl request
     * @throws Exception
     */
    private function curlIt()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->agent);
        curl_setopt($ch, CURLOPT_URL, $this->endpoint . $this->funcUrl);
        if($this->requestMethod == 'POST') {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->postParams));
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Accept: application/json'));
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookieFilePath);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookieFilePath);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $err = curl_error($ch);
        $content = curl_exec($ch);

        if ($err != '') {
            $this->error = $err;
        }

        $this->result = $content;
    }

    /**
     * @throws Exception
     */
    public function allBreeds()
    {
        try {
            $this->funcUrl = "breeds/list/all";
            $this->curlIt();
        } catch(Exception $e){
            throw new Exception("Error: ".$e->getMessage(). " File:".$e->getFile(). " Line:".$e->getLine());
        }
    }

    /**
     * @throws Exception
     */
    public function random()
    {
        try {
            $this->funcUrl = "breeds/image/random";
            $this->curlIt();
        } catch(Exception $e){
            throw new Exception("Error: ".$e->getMessage(). " File:".$e->getFile(). " Line:".$e->getLine());
        }
    }

    /**
     * @param string $breedName
     * @throws Exception
     */
    public function byBreed(string $breedName)
    {
        try {
            $this->funcUrl = "breed/$breedName/images";
            $this->curlIt();
        } catch(Exception $e){
            throw new Exception("Error: ".$e->getMessage(). " File:".$e->getFile(). " Line:".$e->getLine());
        }
    }

    /**
     * @param string $subBreedName
     * @throws Exception
     */
    public function bySubBreed(string $subBreedName)
    {
        try {
            $this->funcUrl = "breed/$subBreedName/list";
            $this->curlIt();
        } catch(Exception $e){
            throw new Exception("Error: ".$e->getMessage(). " File:".$e->getFile(). " Line:".$e->getLine());
        }
    }
}