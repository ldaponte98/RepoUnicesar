<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Http extends Model
{
    public static function get($url, $request = [], $array_headers = [])
    {
        $response = null;
        $error = true;
        $message = "";

        $headers = "";
        if(count($array_headers) > 0){

            foreach ($array_headers as $key => $value) {
                $headers .= $key.":".$value." \r\n";
            }

        }
        try {

            $context = stream_context_create([
                "ssl"=>[
                    "verify_peer"=>false,
                    "verify_peer_name"=>false,
                ],
                "http" => [
                    "method" => "GET",
                    "ignore_errors" => true,
                    "header" => $headers
                ]
            ]);

            $response = file_get_contents($url, false, $context);
            //validamos el error
            $status_line = $http_response_header[0];

            preg_match('{HTTP\/\S*\s(\d{3})}', $status_line, $match);

            $status = $match[1];

            if ($status !== "200") {
                $message = $response;
                
            }else{

                $response = json_decode($response);
                $error = false;
                $message = "OK";
            }
        }catch (Exception $e) {
            
            $message = $e->getMessage();
        }

        return (object)[
            'message' => $message,
            'response' => $response,
            'error' => $error
        ];
    }


    public static function post($url, $request = [], $array_headers = [], $encode = true)
    {
        $response = null;
        $error = true;
        $message = "";

        $headers = "";
        if(count($array_headers) > 0){

            foreach ($array_headers as $key => $value) {
                $headers .= $key.":".$value." \r\n";
            }

        }
        try {

            $context = stream_context_create([
                "ssl"=>[
                    "verify_peer"=>false,
                    "verify_peer_name"=>false,
                ],
                "http" => [
                    "method" => "POST",
                    "ignore_errors" => true,
                    "header" => $headers,
                    "content" => $encode ? json_encode($request) : $request
                ]
            ]);

            $response = file_get_contents($url, false, $context);
            //validamos el error
            $status_line = $http_response_header[0];

            preg_match('{HTTP\/\S*\s(\d{3})}', $status_line, $match);

            $status = $match[1];

            if ($status !== "200") {
                $message = $response;
                
            }else{

                $response = json_decode($response);
                $error = false;
                $message = "OK";
            }
        }catch (Exception $e) {
            
            $message = $e->getMessage();
        }

        return (object)[
            'message' => $message,
            'response' => $response,
            'error' => $error
        ];
    }
}
