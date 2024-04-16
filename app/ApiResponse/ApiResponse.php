<?php

namespace App\ApiResponse;

use Illuminate\Http\JsonResponse;

class ApiResponse
{

    private ?array $append = null;
    private int $status = 200;
    private ?array $msg = null;
    private mixed $data = null;


    public function setAppend(array $append): void
    {
        $this->append = $append;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function setMsg(array $msg): void
    {
        $this->msg = $msg;
    }

    public function setData(mixed $data): void
    {
        $this->data = $data;
    }

    public function response(): JsonResponse
    {
        $body = [];
        !is_null($this->msg) && $body['msg'] = $this->msg;
        !is_null($this->data) && $body['data'] = $this->data;
        $body['status'] = $this->status;

        if ($this->append != null) {
            $body = $body + $this->append;
        }

        return response()->json($body, $this->status);
    }

}
