<?php

namespace Pickling;

trait FeatureFileFixtureTrait
{
    protected function cleanTmpDir(): void
    {
        $toDelete = $this->featuresDir().'/*';
        exec("rm -r $toDelete 2> /dev/null");
    }

    protected function fixtureFeatureFile(string $path, string $content): void
    {
        $path = $this->processPath($path);

        file_put_contents($path, $content);
    }

    private function featuresDir(): string
    {
        return FEATURES_DIR;
    }

    private function processPath(string $path): string
    {
        $path = $this->featuresDir().$path;
        $parts = explode('/', $path);
        array_pop($parts);

        $folder = implode('/', $parts);

        if (false === file_exists($folder)) {
            mkdir($folder);
        }

        return $path;
    }
}
