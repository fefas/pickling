<?php

namespace Pickling;

use Twig_Loader_Array as TwigLoader;
use Twig_Environment as Twig;

class RendererFactory
{
    private const TEMPLATE_HOMEPAGE = <<<TEMPALTE
{% import _self as func %}

{% macro listFeatures(features) %}
    {% import _self as self %}

    <ul>
    {% for feature in features %}
        {% if feature is iterable %}
            {{ self.listFeatures(feature) }}
        {% else %}
            <li><a href="?feature={{ feature.id() }}">{{ feature.title() }}</a></li>
        {% endif %}
    {% endfor %}
    </ul>
{% endmacro %}

<html>
  <body>
    <h1>Features:</h1>
    {{ func.listFeatures(features) }}
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
