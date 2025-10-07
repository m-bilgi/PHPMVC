<?php

namespace Core;

class ServiceResponse
{
    public bool $success;
    public mixed $data;
    public ?string $message;

    public function __construct(bool $success, mixed $data = null, ?string $message = null)
    {
        $this->success = $success;
        $this->data = $data;
        $this->message = $message;
    }
}
