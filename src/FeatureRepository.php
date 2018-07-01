<?php

namespace Pickling;

class FeatureRepository
{
    /** @var string */
    private $rootDir;

    /** @var Parser */
    private $parser;

    public function __construct(string $rootDir, Parser $parser)
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

    public function findAll(): array
    {
        $ids = $this->findAllIds();

        $features = [];
        foreach ($ids as $id) {
            $features[] = $this->findOne($id);
        }

        return $features;
    }

    private function filePathFromId(string $id): string
    {
        return "{$this->rootDir}$id.feature";
    }

    private function findAllIds(): array
    {
        $files = [];
        var_dump(exec("find {$this->rootDir} | sort | grep -e '.feature$'", $files));

        $ids = [];
        foreach ($files as $file) {
            $id = str_replace($this->rootDir, '', $file);
            $id = str_replace('.feature', '', $id);

            $ids[] = $id;
        }

        return $ids;
    }
}
