<?php

namespace App\Http\Helper;

use Illuminate\Http\Response;

class ResponseHelper
{

    const RESPONSE_TYPE_SUCCESS = 'success';
    const RESPONSE_TYPE_ERROR = 'error';

    private $msg;
    private $type;
    private $response;
    private $data;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function setMsg(string $msg)
    {
        $this->msg = $msg;
        return $this;
    }

    public function success()
    {
        $this->type = self::RESPONSE_TYPE_SUCCESS;
        $this->response->setStatusCode(200);
        return $this;
    }

    public function error()
    {
        $this->type = self::RESPONSE_TYPE_ERROR;
        $this->response->setStatusCode(400);
        return $this;
    }

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function get()
    {
        $content = array_merge((array)$this->data,[
            'type' => $this->type,
            'msg' => $this->msg,
        ]);

        $this->response->setContent($content);

        return $this->response;
    }
}
