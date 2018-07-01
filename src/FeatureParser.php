<?php

namespace Pickling;

use Behat\Gherkin\Keywords\ArrayKeywords as BehatKeywords;
use Behat\Gherkin\Lexer as BehatLexer;
use Behat\Gherkin\Parser as BehatParser;

class FeatureParser
{
    /** @var string */
    private $baseDir;

    /** @var BehatParser */
    private $behatParser;

    public function __construct(string $baseDir)
    {
        $this->baseDir = $baseDir;
        $this->behatParser = $this->createBehatParser();
    }

    public function createFromPath(string $path): Feature
    {
        $id = substr($path, 0, -8);
        $content = file_get_contents($this->baseDir.$path);
        $behatFeature = $this->behatParser->parse($content);

        return new Feature($id, $content, $behatFeature);
    }

    private function createBehatParser(): BehatParser
    {
        $keywords = new BehatKeywords([
            'en' => [
                'feature'          => 'Feature',
                'background'       => 'Background',
                'scenario'         => 'Scenario',
                'scenario_outline' => 'Scenario Outline|Scenario Template',
                'examples'         => 'Examples|Scenarios',
                'given'            => 'Given',
                'when'             => 'When',
                'then'             => 'Then',
                'and'              => 'And',
                'but'              => 'But'
            ],
        ]);

        return new BehatParser(new BehatLexer($keywords));
    }
}
