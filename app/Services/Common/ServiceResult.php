<?php

namespace App\Services\Common;

class ServiceResult
{
    public $isError = false;

    public $errors = [];

    public $message = '';

    public $data = null;

    public static function createErrorResult(string $message, array $errors = []): self
    {
        $result = new self();
        $result->isError = true;
        $result->errors = $errors;
        $result->message = $message;

        return $result;
    }

    public static function createSuccessResult($data): self
    {
        $result = new self();
        $result->isError = false;
        $result->data = $data;

        return $result;
    }
}
