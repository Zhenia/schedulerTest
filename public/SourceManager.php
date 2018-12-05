<?php

namespace App;

class SourceManager
{
    private $curl;
    public function __construct(){
        $this->curl = curl_init();
    }
    public function loadApplicationById($id){
        curl_setopt_array($this->curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://internal-interviews.ascendify.works/getRunTimes/'.$id
        ));
        $result = curl_exec($this->curl);
        return $result;
    }

}