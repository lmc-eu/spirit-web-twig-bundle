<?php

declare(strict_types=1);

namespace Lmc\TwigComponentsBundle\Compiler;

/**
 * Transforms <Tags /> to twig embed tags
 * Most parts shamelessly stolen form Laravel's ComponentTagCompiler {@link https://laravel.com/api/8.x/Illuminate/View/Compilers/ComponentTagCompiler.html}
 */
class ComponentTagCompiler
{
    protected $source;

    public function __construct(string $source)
    {
        $this->source = $source;
    }

    public function compile(): string
    {
        $value = $this->source;
        $value = $this->compileSelfClosingTags($value);
        $value = $this->compileOpeningTags($value);
        $value = $this->compileClosingTags($value);

        return $value;
    }

    /**
     * Compile the opening tags within the given string.
     *
     * @throws \InvalidArgumentException
     */
    protected function compileOpeningTags(string $value): string
    {
        $pattern = "/
            <
                \s*
                ([[A-Z]\w+]*)
                (?<attributes>
                    (?:
                        \s+
                        (?:
                            (?:
                                \{\{\s*\\\$attributes(?:[^}]+?)?\s*\}\}
                            )
                            |
                            (?:
                                [\w\-:.@]+
                                (
                                    =
                                    (?:
                                        \\\"[^\\\"]*\\\"
                                        |
                                        \'[^\']*\'
                                        |
                                        [^\'\\\"=<>]+
                                    )
                                )?
                            )
                        )
                    )*
                    \s*
                )
                (?<![\/=\-])
            >
        /x";

        return preg_replace_callback(
            $pattern,
            function (array $matches) {
                $attributes = $this->getAttributesFromAttributeString($matches['attributes']);
                $name = $matches[1];

                return '{% embed "@seduo-genome/twig/' . mb_strtolower($name) . ".twig\" with { props: $attributes } %}{% block content %}";
            },
            $value
        );
    }

    /**
     * Compile the closing tags within the given string.
     */
    protected function compileClosingTags(string $value): string
    {
        return preg_replace("/<\/\s*([[A-Z]\w+]*)\s*>/", '{% endblock %}{% endembed %}', $value);
    }

    /**
     * Compile the self-closing tags within the given string.
     *
     * @throws \InvalidArgumentException
     */
    protected function compileSelfClosingTags(string $value): string
    {
        $pattern = "/
            <
                \s*
                ([[A-Z]\w+]*)
                (?<attributes>
                    (?:
                        \s+
                        (?:
                            (?:
                                \{\{\s*\\\$attributes(?:[^}]+?)?\s*\}\}
                            )
                            |
                            (?:
                                [\w\-:.@]+
                                (
                                    =
                                    (?:
                                        \\\"[^\\\"]*\\\"
                                        |
                                        \'[^\']*\'
                                        |
                                        [^\'\\\"=<>]+
                                    )
                                )?
                            )
                        )
                    )*
                    \s*
                )
            \/>
        /x";

        return preg_replace_callback(
            $pattern,
            function (array $matches) {
                $attributes = $this->getAttributesFromAttributeString($matches['attributes']);
                $name = $matches[1];

                return '{% embed "@seduo-genome/twig/' . mb_strtolower($name) . ".twig\" with { props: $attributes } %}{% endembed %}";
            },
            $value
        );
    }

    protected function getAttributesFromAttributeString(string $attributeString)
    {
        $attributeString = $this->parseAttributeBag($attributeString);

        $pattern = '/
            (?<attribute>[\w\-:.@]+)
            (
                =
                (?<value>
                    (
                        \"[^\"]+\"
                        |
                        \\\'[^\\\']+\\\'
                        |
                        [^\s>]+
                    )
                )
            )?
        /x';

        if (!preg_match_all($pattern, $attributeString, $matches, PREG_SET_ORDER)) {
            return '{}';
        }

        $attributes = [];

        foreach ($matches as $match) {
            $attribute = $match['attribute'];
            $value = $match['value'] ?? null;

            if ($value === null) {
                $value = 'true';
            }

            if (mb_strpos($attribute, ':') === 0) {
                $attribute = str_replace(':', '', $attribute);
                $value = $this->stripQuotes($value);
            }

            $valueWithoutQuotes = $this->stripQuotes($value);

            if ((mb_strpos($valueWithoutQuotes, '{{') === 0) && (mb_strpos($valueWithoutQuotes, '}}') === mb_strlen($valueWithoutQuotes) - 2)) {
                $value = mb_substr($valueWithoutQuotes, 2, -2);
            }

            $attributes[$attribute] = $value;
        }

        $out = '{';
        foreach ($attributes as $key => $value) {
            $key = "'$key'";
            $out .= "$key: $value,";
        }

        return rtrim($out, ',') . '}';
    }

    /**
     * Strip any quotes from the given string.
     */
    public function stripQuotes(string $value): string
    {
        return mb_strpos($value, '"') === 0 || mb_strpos($value, '\'') === 0
            ? mb_substr($value, 1, -1)
            : $value;
    }

    /**
     * Parse the attribute bag in a given attribute string into it's fully-qualified syntax.
     */
    protected function parseAttributeBag(string $attributeString): string
    {
        $pattern = "/
            (?:^|\s+)                                        # start of the string or whitespace between attributes
            \{\{\s*(\\\$attributes(?:[^}]+?(?<!\s))?)\s*\}\} # exact match of attributes variable being echoed
        /x";

        return preg_replace($pattern, ' :attributes="$1"', $attributeString);
    }
}
