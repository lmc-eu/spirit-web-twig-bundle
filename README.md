# Spirit Web Twig Bundle

This is a Symfony bundle with Twig implementation of [Spirit Design System] components, extended with JSX-like syntax.

## Requirements

- PHP 7.4 || 8.1
- Symfony 4.4+ || 5.4+ || ^6.1
- Twig >=1.44.6 || >=2.12.5 || 3+

## Changelog

See [CHANGELOG](./CHANGELOG.md)

## How to install

### Step 1

Download using **composer**

Install package

```bash
composer require lmc/spirit-web-twig-bundle
```

### Step 2

Add `SpiritWebTwigBundle` into bundles (under `all` bundles). If you use Symfony flex, it will be configured automatically.

**bundles.php**

```php
    return [
        ...,
        Lmc\SpiritWebTwigBundle\SpiritWebTwigBundle::class => ['all' => true],
    ];
```

### Step 3 (optional)

If you want to change the default settings, create a config

**config/packages/spirit_web_twig.yml**

```yaml
# all parameters are optional
spirit_web_twig:
  # define one or more paths to expand or overload components (uses glob patterns)
  paths:
    - '%kernel.project_dir%/templates/components'
  paths_alias: 'jobs-ui' # default is 'spirit'
  html_syntax_lexer: false # default is true
  spirit_css_class_prefix: 'jobs' # default is null
  icons: # optional settings for svg assets
    paths:
      - '%kernel.project_dir%/assets/icons' # define paths for svg icons set
    alias: 'jobs-icons' # default is 'icons-assets'
```

## Usage

Now you can use Twig components with JSX-like syntax in your Symfony project. You only need to remember that, unlike in HTML, component tags must always start with a capital letter:

```html
<ComponentName attr="value">Some other content</ComponentName>
...
<ComponentName attr="value" />
```

You can pass attributes like this:

```html
<ComponentName
  :any="'any' ~ 'prop'" // this return as "any" prop with value "anyprop"
  other="{{'this' ~ 'works' ~ 'too'}}"
  anotherProp="or this still work"
  not-this="{{'this' ~ 'does'}}{{ 'not work' }}" // this returns syntax as plain text but prop with dash work
  ifCondition="{{ variable == 'success' ? 'true' : 'false' }}"  // condition can only be written via the ternary operator
  jsXCondition={ variable == 'success' ? 'true' : 'false' }  // condition can only be written via the ternary operator
  numberValue={11}  // if value is number 11
  isOpen  // if value is not defined, it is set to true
  isBoolean={false}  // if value is false
>
Submit
</ComponentName>
```

or pure original implementation

```twig
{% embed "@spirit/componentName.twig" with { props: {
    attr: 'value'
}} %}
    {% block content %}
        Some other content
    {% endblock %}
{% endembed %}
```

# Spirit Components

- [Alert](./src/Resources/components/Alert/README.md)
- [Breadcrumbs](./src/Resources/components/Breadcrumbs/README.md)
- [Button](./src/Resources/components/Button/README.md)
- [ButtonLink](./src/Resources/components/ButtonLink/README.md)
- [CheckboxField](./src/Resources/components/CheckboxField/README.md)
- [Collapse](./src/Resources/components/Collapse/README.md)
- [Container](./src/Resources/components/Container/README.md)
- [Dropdown](./src/Resources/components/Dropdown/README.md)
- [Grid](./src/Resources/components/Grid/README.md)
- [Header](./src/Resources/components/Header/README.md)
- [Heading](./src/Resources/components/Heading/README.md)
- [Icon](./src/Resources/components/Icon/README.md)
- [Link](./src/Resources/components/Link/README.md)
- [Modal](./src/Resources/components/Modal/README.md)
- [Pill](./src/Resources/components/Pill/README.md)
- [RadioField](./src/Resources/components/RadioField/README.md)
- [Stack](./src/Resources/components/Stack/README.md)
- [Tabs](./src/Resources/components/Tabs/README.md)
- [Tag](./src/Resources/components/Tag/README.md)
- [Text](./src/Resources/components/Text/README.md)
- [TextField](./src/Resources/components/TextField/README.md)
- [TextFieldBase](./src/Resources/components/TextFieldBase/README.md)
- [Tooltip](./src/Resources/components/Tooltip/README.md)

if you want to extend these components, an example guide is [here](./docs/extendComponents.md).
if you want to contribute, read guide [here](./docs/contribution.md).

[spirit design system]: https://github.com/lmc-eu/spirit-design-system
