<?php

namespace Pickling;

class Feature
{
    /** @var string */
    private $fileName;

    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    public function path(): string
    {
        $path = '/'.substr($this->fileName, 0, -8);

        return $path;
    }

    public function title(): string
    {
        $title = substr($this->fileName, 0, -8);
        $title = str_replace('-', ' ', $title);

        return ucfirst($title);
    }
}
