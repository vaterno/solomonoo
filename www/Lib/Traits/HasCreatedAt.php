<?php

namespace Lib\Traits;

trait CreatableTrait
{
    public string $created_at = '';

    protected function initializeCreatedAt(): void
    {
        if (empty($this->created_at)) {
            $this->created_at = date('Y-m-d H:i:s');
        }
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return new \DateTimeImmutable($this->created_at);
    }

    public function setCreatedAt(string $createdAt): static
    {
        if (strtotime($createdAt) === false) {
            throw new \InvalidArgumentException('Was passed incorrect date');
        }

        $this->created_at = $createdAt;
        return $this;
    }
}