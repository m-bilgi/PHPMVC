<?php
declare(strict_types=1);

namespace Core;

class Cache
{
    private string $cachePath;
    private int $defaultTtl;

    public function __construct(string $path = __DIR__ . '/../storage/cache', int $defaultTtl = 300)
    {
        $this->cachePath = rtrim($path, '/');
        $this->defaultTtl = $defaultTtl;

        if (!is_dir($this->cachePath)) {
            mkdir($this->cachePath, 0777, true);
        }
    }

    private function getCacheFile(string $key): string
    {
        return $this->cachePath . '/' . md5($key) . '.cache';
    }

    public function set(string $key, mixed $value, ?int $ttl = null): bool
    {
        $data = [
            'time' => time(),
            'ttl' => $ttl ?? $this->defaultTtl,
            'value' => $value,
        ];

        $file = $this->getCacheFile($key);
        return (bool)file_put_contents($file, serialize($data));
    }

    public function get(string $key): mixed
    {
        $file = $this->getCacheFile($key);

        if (!file_exists($file)) {
            return null;
        }

        $data = unserialize(file_get_contents($file));

        if (time() - $data['time'] > $data['ttl']) {
            unlink($file);
            return null;
        }

        return $data['value'];
    }

    public function has(string $key): bool
    {
        return $this->get($key) !== null;
    }

    public function delete(string $key): void
    {
        $file = $this->getCacheFile($key);
        if (file_exists($file)) {
            unlink($file);
        }
    }

    public function clear(): void
    {
        foreach (glob($this->cachePath . '/*.cache') as $file) {
            unlink($file);
        }
    }
}
