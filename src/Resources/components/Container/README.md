# Container

This is Twig implementation of the [Container][container] component.

Basic example usage:

```twig
<Container>Content</Container>
```

Without lexer:

```twig
{% embed "@spirit/container.twig" %}
    {% block content %}
        Content
    {% endblock %}
{% endembed %}
```

## Fluid Container

If you need a full-width container, you can use the `isFluid` prop.

```twig
<Container isFluid>Content</Container>
```

## API

| Name      | Type   | Default | Required | Description                 |
| --------- | ------ | ------- | -------- | --------------------------- |
| `isFluid` | `bool` | `false` | ✕        | If true, Container is fluid |

On top of the API options, the components accept [additional attributes][readme-additional-attributes].
If you need more control over the styling of a component, you can use [style props][readme-style-props]
and [escape hatches][readme-escape-hatches].

[container]: https://github.com/lmc-eu/spirit-design-system/tree/main/packages/web/src/scss/components/Container
[readme-additional-attributes]: https://github.com/lmc-eu/spirit-design-system/blob/main/packages/web-twig/README.md#additional-attributes
[readme-style-props]: https://github.com/lmc-eu/spirit-design-system/blob/main/packages/web-twig/README.md#style-props
[readme-escape-hatches]: https://github.com/lmc-eu/spirit-design-system/blob/main/packages/web-twig/README.md#escape-hatches
