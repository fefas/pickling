<?php

namespace Pickling;

use PHPUnit\Framework\TestCase;

class FindAddFeaturesInDirTest extends TestCase
{
    use FeatureFileFixtureTrait;

    /** @var FeatureRepository */
    private $repo;

    /** @var Parser */
    private $parser;

    protected function setUp(): void
    {
        $this->parser = $this->createMock(Parser::class);
        $this->repo = new FeatureRepository(TMP_DIR, $this->parser);

        $this->cleanTmpDir();
    }

    /**
     * @test
     */
    public function returnEmptyArrayIfNoFeatureIsFound(): void
    {
        $empty = $this->repo->findAll();

        $this->assertEmpty($empty);
    }

    /**
     * @test
     */
    public function returnFeaturesLocatedInTheDir(): void
    {
        $this->fixtureFeatureFile('/some1.feature', 'content1');
        $this->fixtureFeatureFile('/some2.feature', 'content2');
        $this->fixtureFeatureFile('/group/some3.feature', 'content3');
        $feature1 = $this->createMock(Feature::class);
        $this->parser
            ->expects($this->at(0))
            ->method('create')
            ->willReturn($feature1);
        $feature2 = $this->createMock(Feature::class);
        $this->parser
            ->expects($this->at(1))
            ->method('create')
            ->willReturn($feature2);
        $feature3 = $this->createMock(Feature::class);
        $this->parser
            ->expects($this->at(2))
            ->method('create')
            ->willReturn($feature3);

        $features = $this->repo->findAll();

        $expected = [
            $feature1,
            $feature2,
            $feature3,
        ];
        $this->assertEquals($expected, $features);
    }
}
