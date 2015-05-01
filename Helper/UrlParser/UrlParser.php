<?php

namespace Kamran\LinkBundle\Helper\UrlParser;


class UrlParser
{

    protected $url;
    private $protocol;
    private $host;
    private $path;
    private $query;

    public function __construct($_url){
        $this->url = $_url;

        $this->parseUrl();
    }

    private function parseUrl(){
        $parsedArray = parse_url($this->url);

        $this->protocol = $parsedArray['scheme'];
        $this->host     = $parsedArray['host'];
    }


    public function isUrl(){

    }

    public function get(){

    }

    public function getHost(){
        return $this->host;
    }


}
