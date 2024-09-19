<?php

namespace Cache\Infrastructure\Cache;

final class MemoryCache implements ICache
{
    private array $cacheData = [];

    public function has(string $key): bool
    {
        if(!isset($this->cacheData[$key])) {
            return false;
        }

        if(time() > $this->cacheData[$key]['time'] + $this->cacheData[$key]['duration']) {
            unset($this->cacheData[$key]);
            return false;
        }

        return true;
    }

    public function get(string $key): mixed
    {
        return $this->cacheData[$key];
    }

    public function set(string $key, mixed $value, int $duration = 3600): void
    {
        $data = [
            'value' => $value,
            'duration' => $duration,
            'time' => time(),
        ];
        $this->cacheData[$key] = $data;
    }
}
