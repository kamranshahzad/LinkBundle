<?php

namespace Kamran\LinkBundle\Helper;



class UrlHelper
{

    protected $url = '';

    public function __constuct($_url){
        if(!empty($_url)){
            $this->url = $_url;
        }
    }


    public function urlParams( $urlString = '' ){
        if(!empty($urlString)){
            $currentUrl = parse_url($urlString);
        }else{
            $currentUrl = parse_url($_SERVER['REQUEST_URI']);
        }
        if(array_key_exists('query',$currentUrl)){
            return $currentUrl['query'];
        }
        return '';
    }


}