<?php

namespace Pickling;

use PHPUnit\Framework\TestCase;

class FeatureParserTest extends TestCase
{
    /**
     * @test
     */
    public function createFeatureFromFilePath()
    {
        $baseDir = TMP_DIR;
        $content = <<<FEATURE
Feature: Some Feature
    Some description
FEATURE;

        $filePath = "/some.feature";
        file_put_contents($baseDir.$filePath, $content);

        $factory = new FeatureParser($baseDir);
        $feature = $factory->create('/some', $content);

        $expected = [
            'id' => '/some',
            'content' => $content,
            'title' => 'Some Feature',
            'description' => '  Some description',
        ];
        $this->assertEquals($expected, [
            'id' => $feature->id(),
            'content' => $feature->content(),
            'title' => $feature->parsed()->getTitle(),
            'description' => $feature->parsed()->getDescription(),
        ]);
    }
}
