<?php

namespace Pickling;

use PHPUnit\Framework\TestCase;

class ParseFeatureFileTest extends TestCase
{
    /**
     * @test
     * @dataProvider expectedAccordingToIdsAndContents
     */
    public function createFeatureUsingBehatAsParser(array $expected, string $id, string $content): void
    {
        $factory = new Parser();
        $feature = $factory->create($id, $content);

        $this->assertEquals($expected, [
            'id' => $feature->id(),
            'content' => $feature->content(),
            'title' => $feature->parsed()->getTitle(),
            'description' => $feature->parsed()->getDescription(),
        ]);
    }

    public function expectedAccordingToIdsAndContents()
    {
        return [
            'without description' => [
                [
                    'id' => '/some',
                    'content' => 'Feature: Some Feature',
                    'title' => 'Some Feature',
                    'description' => null,
                ],
                '/some',
                'Feature: Some Feature',
            ],
            'with description' => [
                [
                    'id' => '/another',
                    'content' => "Feature: Another Feature\n  Description here",
                    'title' => 'Another Feature',
                    'description' => 'Description here',
                ],
                '/another',
                "Feature: Another Feature\n  Description here",
            ],
        ];
    }
}
