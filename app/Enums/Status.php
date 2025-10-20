<?php

namespace App\Enums;

final class Status {
    // 2xx Success
    public const HTTP_200_OK = 200;
    public const HTTP_201_CREATED = 201;
    public const HTTP_202_ACCEPTED = 202;
    public const HTTP_204_NO_CONTENT = 204;

    // 3xx Redirection
    public const HTTP_301_MOVED_PERMANENTLY = 301;
    public const HTTP_302_FOUND = 302;
    public const HTTP_304_NOT_MODIFIED = 304;

    // 4xx Client Errors
    public const HTTP_400_BAD_REQUEST = 400;
    public const HTTP_401_UNAUTHORIZED = 401;
    public const HTTP_403_FORBIDDEN = 403;
    public const HTTP_404_NOT_FOUND = 404;
    public const HTTP_405_METHOD_NOT_ALLOWED = 405;
    public const HTTP_409_CONFLICT = 409;
    public const HTTP_422_UNPROCESSABLE_ENTITY = 422; // Laravel validation errors
    public const HTTP_429_TOO_MANY_REQUESTS = 429;

    // 5xx Server Errors
    public const HTTP_500_INTERNAL_SERVER_ERROR = 500;
    public const HTTP_502_BAD_GATEWAY = 502;
    public const HTTP_503_SERVICE_UNAVAILABLE = 503;
    public const HTTP_504_GATEWAY_TIMEOUT = 504;

    /**
     * Get a human-readable label for a status code.
     */
    public static function label(int $status): string {
        return match ($status) {
            self::HTTP_200_OK => 'OK',
            self::HTTP_201_CREATED => 'Created',
            self::HTTP_202_ACCEPTED => 'Accepted',
            self::HTTP_204_NO_CONTENT => 'No Content',
            self::HTTP_301_MOVED_PERMANENTLY => 'Moved Permanently',
            self::HTTP_302_FOUND => 'Found',
            self::HTTP_304_NOT_MODIFIED => 'Not Modified',
            self::HTTP_400_BAD_REQUEST => 'Bad Request',
            self::HTTP_401_UNAUTHORIZED => 'Unauthorized',
            self::HTTP_403_FORBIDDEN => 'Forbidden',
            self::HTTP_404_NOT_FOUND => 'Not Found',
            self::HTTP_405_METHOD_NOT_ALLOWED => 'Method Not Allowed',
            self::HTTP_409_CONFLICT => 'Conflict',
            self::HTTP_422_UNPROCESSABLE_ENTITY => 'Validation Error',
            self::HTTP_429_TOO_MANY_REQUESTS => 'Too Many Requests',
            self::HTTP_500_INTERNAL_SERVER_ERROR => 'Internal Server Error',
            self::HTTP_502_BAD_GATEWAY => 'Bad Gateway',
            self::HTTP_503_SERVICE_UNAVAILABLE => 'Service Unavailable',
            self::HTTP_504_GATEWAY_TIMEOUT => 'Gateway Timeout',
            default => 'Unknown Status',
        };
    }
}
