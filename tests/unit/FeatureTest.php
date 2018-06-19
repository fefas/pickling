<?php

namespace Pickling;

use PHPUnit\Framework\TestCase;

class FeatureTest extends TestCase
{
    /**
     * @test
     * @dataProvider pathsAndExpectedTitles
     */
    public function parsePathToReadableTitle(string $path, string $expected): void
    {
        $feature = new Feature($path);

        $parsedTitle = $feature->title();

        $this->assertEquals($expected, $parsedTitle);
    }

    public function pathsAndExpectedTitles(): array
    {
        return [
            ['/some-file.feature', 'Some file'],
            ['/group/some-file.feature', 'Group some file'],
        ];

    }

    /**
     * @test
     * @dataProvider pathsAndExpectedIds
     */
    public function parsePathToId(string $path, string $expected): void
    {
        $feature = new Feature($path);

        $id = $feature->id();

        $this->assertEquals($expected, $id);
    }

    public function pathsAndExpectedIds(): array
    {
        return [
            ['/some-file.feature', '/some-file'],
            ['/group/some-file.feature', '/group/some-file'],
        ];

    }
}
