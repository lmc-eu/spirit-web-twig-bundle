# Tabs

This is Twig implementation of the [Tabs] component.

Basic example usage:

```html
<TabList>
  <TabItem>
    <TabLink isSelected id="pane1-tab" target="pane1">Item selected</TabLink>
  </TabItem>
  <TabItem>
    <TabLink id="pane2-tab" target="pane2">Item</TabLink>
  </TabItem>
  <TabItem>
    <TabLink href="https://www.example.com">Item link</TabLink>
  </TabItem>
</TabList>
<TabPane id="pane1" isSelected label="pane1-tab">Pane 1</TabPane>
<TabPane id="pane2" label="pane2-tab">Pane 2</TabPane>
```

Without lexer:

```twig
{% embed "@spirit/tabList.twig" %}
    {% block content %}
        {% embed "@spirit/tabItem.twig" %}
            {% block content %}
                {% embed "@spirit/tabLink.twig" with { props: {
                  id: 'pane1-tab',
                  isSelected: true,
                  target: 'pane1',
                } } %}
                    {% block content %}
                        Item selected
                    {% endblock %}
                {% endembed %}
            {% endblock %}
        {% endembed %}
    {% endblock %}
{% endembed %}
```

## API

The Tabs itself consists of many components which cannot be used independently.

### TabList

| Prop name | Type     | Default | Required | Description           |
| --------- | -------- | ------- | -------- | --------------------- |
| `class`   | `string` | `null`  | no       | Additional class name |

### TabItem

| Prop name | Type     | Default | Required | Description           |
| --------- | -------- | ------- | -------- | --------------------- |
| `class`   | `string` | `null`  | no       | Additional class name |

### TabLink

| Prop name    | Type      | Default | Required | Description                  |
| ------------ | --------- | ------- | -------- | ---------------------------- |
| `class`      | `string`  | `null`  | no       | Additional class name        |
| `href`       | `string`  | `null`  | no       | URL target of a link         |
| `id`         | `string ` | `null`  | no       | Tab item identification      |
| `isSelected` | `boolean` | `false` | no       | Whether is tab item selected |
| `target`     | `string`  | `null`  | no       | Target tab pane ID           |

### TabPane

| Prop name    | Type      | Default | Required | Description                    |
| ------------ | --------- | ------- | -------- | ------------------------------ |
| `class`      | `string`  | `null`  | no       | Additional class name          |
| `id`         | `string ` | `null`  | yes      | Tab pane target identification |
| `isSelected` | `boolean` | `false` | no       | Whether is tab pane selected   |
| `label`      | `string`  | `null`  | no       | Aria label of the tab pane     |

[tabs]: https://github.com/lmc-eu/spirit-design-system/tree/main/packages/web/src/scss/components/Tabs
