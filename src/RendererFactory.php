<?php

namespace Pickling;

use Twig_Loader_Array as TwigLoader;
use Twig_Environment as Twig;

class RendererFactory
{
    private const TEMPLATE_HOMEPAGE = <<<TEMPALTE
<html>
  <body>
    <h1>Features:</h1>
    <ul>
    {% for feature in features %}
      <li><a href="{{ feature.path() }}">{{ feature.title() }}</a></li>
    {% endfor %}
    </ul>
  </body>
</html>
TEMPALTE;

    public static function createInMemory(): Renderer
    {
        $twigLoader = new TwigLoader([
            'homepage' => self::TEMPLATE_HOMEPAGE,
        ]);

        return self::create($twigLoader);
    }

    private static function create(TwigLoader $twigLoader): Renderer
    {
        $twig = new Twig($twigLoader);

        return new Renderer($twig);
    }
}
