<?php

namespace App\Exceptions;

use Exception;

class CustomApiException extends Exception
{
    protected $status;

    public function __construct($message = "An error occurred", $status = 400, Exception $previous = null)
    {
        $this->status = $status;
        parent::__construct($message, $status, $previous);
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function render($request)
    {
        return response()->json([
            'success' => false,
            'error' => [
                'code' => $this->status,
                'message' => $this->getMessage(),
            ],
        ], $this->status);
    }

    public static function notFound($message = "Resource not found")
    {
        return new static($message, 404);
    }
}
