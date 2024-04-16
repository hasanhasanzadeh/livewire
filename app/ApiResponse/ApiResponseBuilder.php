<?php

namespace App\ApiResponse;

class ApiResponseBuilder
{

    private  ApiResponse $response;

    public function __construct()
    {
        $this->response=new ApiResponse();
        return $this->response;
    }

    public function withAppend(array $append)
    {
        $this->response->setAppend($append);
        return $this;
    }
    public function withStatus(int $status)
    {
        $this->response->setStatus($status);
        return $this;
    }
    public function withMsg(array $msg)
    {
        $this->response->setMsg($msg);
        return $this;
    }
    public function withData(mixed $data)
    {
        $this->response->setData($data);
        return $this;
    }

    public function build(): ApiResponse
    {
        return $this->response;
    }
}
