<?php

namespace Pickling;

class FeatureRepository
{
    /** @var string */
    private $rootDir;

    /** @var FeatureParser */
    private $parser;

    public function __construct(string $rootDir, FeatureParser $parser)
    {
        $this->rootDir = $rootDir;
        $this->parser = $parser;
    }

    public function findOne(string $id): ?Feature
    {
        $filePath = $this->filePathFromId($id);
        if (is_readable($filePath) === false) {
            return null;
        }

        $content = file_get_contents($filePath);

        return $this->parser->create($id, $content);
    }

    private function filePathFromId(string $id): string
    {
        return "{$this->rootDir}$id.feature";
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
