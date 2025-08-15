<?php

namespace Lib;

abstract class Model
{
    public int|string|null $id = null;

    public function getId(): int|string|null
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }
}