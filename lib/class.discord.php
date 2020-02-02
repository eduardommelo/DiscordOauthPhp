<?php 
require_once 'class.api.php';
class Discord{
    private $config;
    private $api;
    function __construct($val){
        $this->config = $val;
        $this->api = new Api();
    }
    function authenticate(){
       $result = $this->api->requestPOST('https://discordapp.com/api/oauth2/token', [
            'grant_type' => 'authorization_code',
            'code' => $_GET['code'],
            'redirect_uri' => $this->config['url_server'].'login.php'], 
            
            [
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: Basic '.$this->api->btoa($this->config['btoa_discord'])]);
        return $result;
    }
    function author($session){
        $result = $this->api->requestGET('https://discordapp.com/api/users/@me', false, [
        'authorization: '.$session->token_type.' '.$session->access_token]);
        return $result;
    }
    function guilds($session){
        $result = $this->api->requestGET('https://discordapp.com/api/users/@me/guilds', false, [
        'authorization: '.$session->token_type.' '.$session->access_token]);
        return $result;
    }
}



?>