<?php

namespace Lib;

class View
{
    public const PATH = ROOT . '/resources/templates/';
    protected array $data = [];

    public function __set($name, $value): void
    {
        $this->data[$name] = $value;
    }

    public function __get($name): mixed
    {
        return $this->data[$name] ?? null;
    }

    public function __isset($name): bool
    {
        return isset($this->data[$name]);
    }

    public function render(string $template): false|string
    {
        ob_start();
            include static::PATH . $template . '.php';
            $contents = ob_get_contents();
        ob_end_clean();

        return $contents;
    }
}