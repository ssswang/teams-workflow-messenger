<?php

namespace TeamsWorkflowMessenger;

use GuzzleHttp\Psr7\Response;

class Messenger
{
    private $client;
    private $url;
    function __construct($webhookUrl)
    {
        $this->url = $webhookUrl;
        $this->client = new \GuzzleHttp\Client();
    }

    function post($payload){
        //var_dump($this->url);
        $r = $this->client->request('POST', $this->url, [
            'json' => $payload
        ]);
        //$this->responseCodeParser($r);
    }

    private function responseCodeParser($r)
    {
        if ($r instanceof Response) {
            var_dump("Response Code: ". $r->getStatusCode());
        } else {
            var_dump($r);
        }
    }
}