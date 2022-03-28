# Tag

This is Twig implementation of the [Tag] component.

## Examples
pure implementation:
```twig
{% embed "@spirit/tag.twig" with { props: {
    color: 'default'
    theme: 'dark'
}} %}
    {% block content %}
        Tag content
    {% endblock %}
{% endembed %}
```

With Html syntax lexer (enabled by default):
```twig
<Tag color="default" theme="dark">Tag content</Tag>
```

## Available props

| name       | type      | default value |
|------------|-----------|---------------|
| color      | `string`  | default       |
| theme      | `string`  | dark          |
| class      | `string`  | undefined     |

[Tag]: https://github.com/lmc-eu/spirit-design-system/tree/main/packages/web/src/components/Tag