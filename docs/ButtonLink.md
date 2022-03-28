# ButtonLink

This is Twig implementation of the [ButtonLink] component.

## Examples
pure implementation:
```twig
{% embed "@spirit/buttonLink.twig" with { props: {
    color: 'primary',
    href: '#'
}} %}
    {% block content %}
        Primary ButtonLink
    {% endblock %}
{% endembed %}
```

With Html syntax lexer (enabled by default):
```twig
<ButtonLink href="#" color="primary">Primary ButtonLink</ButtonLink>
```

## Available props

| name      | type      | default value | description                                 |
|-----------|-----------|---------------|---------------------------------------------|
| color     | `string`  | primary       | its possible to use all theme colors        |
| href      | `string`  | #             | anchor href link                            |
| target    | `string`  | __self        | anchor target                               |
| block     | `boolean` | false         | span the full width of a parent             |
| square    | `boolean` | false         | if the button only has an icon              |
| disabled  | `boolean` | false         |                                             |
| ariaLabel | `string`  | undefined     | Accessible Rich Internet Applications label |
| class     | `string`  | undefined     | property to extend with custom classes      |

[Button]: https://github.com/lmc-eu/spirit-design-system/tree/main/packages/web/src/components/ButtonLink