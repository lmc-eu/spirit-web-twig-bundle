# Select

This is Twig implementation of the [Select][select] component.

The placeholder for the select element is handled in a different way than other form fields.
We add the first option item without a value with the `selected` attribute. You can also use the `disabled` attribute
if the select field is mandatory.

Basic example usage:

```twig
<Select id="example" label="Label" name="example">
  <option value="" selected>Placeholder</option>
  <option value="1">Option 1</option>
  <option value="2">Option 2</option>
</Select>
```

Usage with `isRequired` attribute:

```twig
<Select id="example" label="Label" name="example" isRequired>
  <option value="" selected disabled>Placeholder</option>
  <option value="1">Option 1</option>
  <option value="2">Option 2</option>
</Select>
```

Without lexer:

```twig
{% embed "@spirit/select.twig" with { props: {
    id: 'example'
    name: 'example'
    label: 'Label'
    isRequired: true
}} %}
    {% block content %}
      <option value="" selected disabled>Placeholder</option>
      <option value="1">Option 1</option>
      <option value="2">Option 2</option>
    {% endblock %}
{% endembed %}
```

## API

| Prop name         | Type                                           | Default | Required | Description                                                |
| ----------------- | ---------------------------------------------- | ------- | -------- | ---------------------------------------------------------- |
| `helperText`      | `string`                                       | `null`  | no       | Custom helper text                                         |
| `id`              | `string`                                       | —       | yes      | Select and label identification                            |
| `isDisabled`      | `bool`                                         | `false` | no       | If true, select is disabled                                |
| `isFluid`         | `bool`                                         | `false` | no       | If true, the element spans to the full width of its parent |
| `isLabelHidden`   | `bool`                                         | `false` | no       | If true, label is hidden                                   |
| `isRequired`      | `bool`                                         | `false` | no       | If true, select is required                                |
| `label`           | `string`                                       | —       | yes      | Label text                                                 |
| `validationText`  | `string`, `string[]`                           | `null`  | no       | Validation text                                            |
| `name`            | `string`                                       | `null`  | no       | Select name                                                |
| `validationState` | [Validation dictionary][dictionary-validation] | `null`  | no       | Type of validation state.                                  |

On top of the API options, you can add `data-*` or `aria-*` attributes to
further extend component's descriptiveness and accessibility. Also, UNSAFE styling props are available,
see the [Escape hatches][escape-hatches] section in README to learn how and when to use them.
These attributes will be passed to the topmost HTML element of the component.

[select]: https://github.com/lmc-eu/spirit-design-system/tree/main/packages/web/src/scss/components/Select
[dictionary-validation]: https://github.com/lmc-eu/spirit-design-system/blob/main/docs/DICTIONARIES.md#validation
[escape-hatches]: https://github.com/lmc-eu/spirit-design-system/tree/main/packages/web-twig/README.md#escape-hatches