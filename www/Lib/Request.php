<?php

namespace Lib;

use Lib\Enums\HttpMethods;

class Request
{
    protected bool $wantsJson = false;

    public function __construct(
        protected HttpMethods $method,
        protected string $url,
        protected array $data
    ) {
        if (
            isset($_SERVER['CONTENT_TYPE']) &&
            strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false
        ) {
            $this->wantsJson = true;
        }
    }

    public static function makeFromGlobals()
    {
        $urlParts = explode('?', $_SERVER['REQUEST_URI'], 2);
        $url = $urlParts[0] ?? '/';

        return new static(HttpMethods::GET, $url, $_GET);
    }

    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function isGet(): bool
    {
        return $this->method === HttpMethods::GET;
    }

    public function getGetData(): array
    {
        return $this->isGet() ? $this->data : [];
    }
}
