![Logo](https://github.com/youandmedigital/craft-getfiles/blob/master/src/icon.svg =250x)
# GetFiles for Craft

This plugin retrieves a list of files based on a specified folder path.

## Use case

**Example 1:**

You might have a generic service worker setup and want to cache some font files.
Font names change per project. You want to list all the fonts in your build
folder and be able to format the output, so there is one thing less for you to
change when you setup a new project.

**Example 2:**

You might have a folder on your server with some images. You want to output the
contents of this folder in the front-end using twig.

## Usage

**Example 1:**

```
{% set images = craft.getfiles.options('/assets/images/') %}

<p>Available images:</p>
{% for image in images %}
<img src="/assets/images/{{ image }}" alt="{{ image }}">
{% endfor %}
```

Would output:

```
<p>Available images:<p>
<img src="/assets/images/image1.jpg" alt="image1.jpg">
<img src="/assets/images/image2.jpg" alt="image2.jpg">
<img src="/assets/images/image3.jpg" alt="image3.jpg">
<img src="/assets/images/image4.gif" alt="image4.gif">
```

**Example 2:**

```
{% set images = craft.getfiles.options('/assets/images/', '*.gif') %}

<p>Available images:</p>
{% for image in images %}
<img src="/assets/images/{{ image }}" alt="{{ image }}">
{% endfor %}
```

Would output:

```
<p>Available images:<p>
<img src="/assets/images/image4.gif" alt="image4.gif">
```

## Options

```
{% set <variable> = craft.getfiles.options('<filePath>', '<filePattern>', '<filePathFormat>') %}
```
- **filePath** (required): Is the path to your folder
- **filePattern** (optional): Accepts a regex pattern
- **filePathFormat** (optional, defaults to `1`): If you specify `1`, the plugin will return the filename only. If you specify `2`, the plugin will output the filename prefixed with your sites base path.

Please note, if you want to use `filePath` and `filePathFormat` options only, you'll have to supply `filePattern` with a generic regex value.

For example:

```
{% set fonts = craft.getfiles.options('/assets/fonts/', '*', '2') %}
{% for font in fonts %}
{{ font }}
{% endfor %}
```

Would output:
```
/assets/fonts/example-light.woff
/assets/fonts/example-light.woff2
/assets/fonts/example-light.eot
/assets/fonts/example-light.ttf
/assets/fonts/example-light.svg
```
## Changelog
