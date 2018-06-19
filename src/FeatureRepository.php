<?php

namespace Pickling;

class FeatureRepository
{
    /** @var string */
    private $rootDir;

    public function __construct(string $rootDir)
    {
        $this->rootDir = $rootDir;
    }

    public function findAll(): array
    {
        return $this->findAllInDir('/');
    }

    private function findAllInDir(string $relativeDir): array
    {
        $features = [];
        foreach ($this->scanDir($relativeDir) as $content) {

            $relativePath = $relativeDir.$content;

            if ($this->isDir($relativePath)) {
                $features[] = $this->findAllInDir($relativePath.'/');

                continue;
            }

            if ($this->isFeatureFile($relativePath)) {
                $features[] = new Feature($relativePath);

                continue;
            }
        }

        return $features;
    }

    private function scanDir(string $relativeDir): array
    {
        $dir = $this->buildAbsolutePath($relativeDir);
        $contents = scandir($dir);

        unset($contents[0]); // exclude .
        unset($contents[1]); // exclude ..

        return $contents;
    }

    private function isFeatureFile(string $relativePath): bool
    {
        return substr($relativePath, -8) === '.feature';
    }

    private function isDir(string $relativePath): bool
    {
        $path = $this->buildAbsolutePath($relativePath);

        return is_dir($path);
    }

    private function buildAbsolutePath(string $relativeDir): string
    {
        return $this->rootDir.$relativeDir;
    }
}
