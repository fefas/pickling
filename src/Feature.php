<?php

namespace Pickling;

use Behat\Gherkin\Node\FeatureNode as BehatFeature;

class Feature
{
    /** @var string */
    private $id;

    /** @var string */
    private $content;

    /** @var BehatFeature */
    private $parsed;

    public function __construct(string $id, string $content, BehatFeature $parsed)
    {
        $this->id = $id;
        $this->content = $content;
        $this->parsed = $parsed;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function parsed(): BehatFeature
    {
        return $this->parsed;
    }
}
