<?php

session_start();
$json = file_get_contents1('php://input');
$data = json_decode($json);
class API{
    
    public static function instance()
    {

    static $instance = null;
        if($instance === null)
        {
            $instance = new API();
        }
        return $instance;
    
    }
    private function _construct()
    {

    }
    private function _destruct()
    {

    }
    public function login($email, $password)
    {
        if($email == '' && $password == '')
        {
            return "APIKEY@&^T^G@UHB@JSMNAD)I()UADNSD";
        }
        else
        {
            return "";
        }
    }
    public function getInfo($data)
    {
        $url = "https://api.deezer.com/search?q=";
        $curlsesh = curl_init();
        curl_setopt($curlsesh, CURLOPT_RETURNTRANSFER, 1);
        
        if(isset($data))
        {
            if(isset($data->title))
            {
                $url = $url."title: '".$data->title."'";
                curl_setopt($curlsesh, CURLOPT_URL, $url);
                $result = curl_exec($curlsesh);
                $result = json_decode($result);
                
                if(isset($data->return))
                {
                    $temp = [];
                    foreach($result->data as $rank)
                    {
                        array_push($temp, array("title" => "$rank->title", "rank" => $rank->rank));
                    }
                    return $temp;
                }
            }
            curl_close($curlsesh);
        }
    }
    
    function response($succ, $mess = "", $data = "")
    {
        header("HTTP/1.1 200 OK");
        header("Content-Type: application/json");
        
        echo json_encode(["success" => $succ, "message" => $mess, "data" => $data]);
    }
    
}

$api = API::instance();

if(isset($data->email) && isset($data->password))
{
    $key = $api->login($data->email, $data->password);
    if($key == "")
    {
        $api->response(false, "Liar!! You are not you!! Reveal your true identity!!");
    }
    else
    {
        $api->response(true, "You are who you say you are. Come on in.", array("key" => "$key"));
    }
}

if(isset($data->key) && $data->key == "APIKEY@&^T^G@UHB@JSMNAD)I()UADNSD")
{
    if(isset($data->type) && $data->type == "info")
    {
        $api->response(true, "You were successful", $api->getInfo($data));
    }
}

?>