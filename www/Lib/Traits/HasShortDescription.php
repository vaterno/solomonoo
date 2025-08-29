<?php

namespace Lib\Traits;

trait HasShortDescription
{
    public string $short_description;

    public function getDescription(): string
    {
        return $this->short_description;
    }

    public function setShortDescription(string $shortDescription): static
    {
        $this->short_description = $shortDescription;

        return $this;
    }
}