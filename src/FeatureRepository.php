<?php

namespace Pickling;

use Twig_Loader_Array;
use Twig_Environment;

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
        $features = [];
        foreach (scandir($this->rootDir) as $resource) {
            if (substr($resource, -8) !== '.feature') {
                continue;
            }

            $features[] = new Feature($resource);
        }

        return $features;
    }
}
