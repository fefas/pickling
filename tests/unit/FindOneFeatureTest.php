<?php

namespace Pickling;

use PHPUnit\Framework\TestCase;

class FindOneFeatureTest extends TestCase
{
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
    public function returnFeatureCreatedFromParserIfIdIsFound(): void
    {
        file_put_contents(TMP_DIR.'/some-feature.feature', 'content');
        $feature = $this->createMock(Feature::class);
        $this->parser
            ->method('create')
            ->willReturn($feature);

        $result = $this->repo->findOne('/some-feature');

        $this->assertEquals($feature, $result);
    }

    /**
     * @test
     */
    public function returnNullIfGivenIdIsNotFound(): void
    {
        $result = $this->repo->findOne('/some-feature');

        $this->assertNull($result);
    }

    private function cleanTmpDir(): void
    {
        $toDelete = TMP_DIR.'/*';
        exec("rm -r $toDelete");
    }
}
