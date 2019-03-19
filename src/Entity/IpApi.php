<?php
/**
 * Created by PhpStorm.
 * User: manager
 * Date: 13.03.19
 * Time: 11:14
 */

namespace App\Entity;

class IpApi
{
    //protected $url = 'https://api.2ip.ua/geo.json';
    private $url = 'http://www.geoplugin.net/json.gp';
    private $ip;
    private $info = [];

    function __construct($ip){
        $this->ip = $ip;
    }

    public function getInfo()
    {
        $info = $this->getIpInfo();
        $this->info['city'] = $info->geoplugin_city;
        $this->info['country'] = $info->geoplugin_countryName;
        $this->info['ip'] = $info->geoplugin_request;
        return $this->info;
    }

    protected function getIpInfo(){
        //$outJson = file_get_contents($this->url.'?ip=81.1.252.98');
        $outJson = file_get_contents($this->url.'?ip='.$this->ip);
        return json_decode($outJson);
    }
}