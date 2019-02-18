<p align="center">
    <img src="https://github.com/youandmedigital/craft-getfiles/blob/master/src/icon.svg" alt="GetFiles" width="150"/>
</p>

# GetFiles for Craft

This Craft CMS 3 plugin retrieves a list of files based on a specified folder path.

## Use case

**Example 1:**

You might have a folder on your server with some images. You want to output the
contents of this folder in the front-end using twig.

**Example 2:**

You might have a generic service worker setup and want to "set and forgot" assets
from your build folder.

## Usage

**Example 1:**

```
{% set settings =
    {
        filepath: '/assets/images/',
        pathformat: '2'
    }
%}
{% set images = craft.getfiles.config(settings) %}

<p>Available images:</p>
{% for image in images %}
    <img src="{{ image }}" alt="{{ image }}">
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
{% set settings =
    {
        filepath: '/assets/images/',
        pathformat: '1',
        pattern: '*.gif'
    }
%}
{% set images = craft.getfiles.config(settings) %}

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
{% set settings =
    {
        filepath: '',
        pathformat: '',
        pattern: ''
    }
%}
```
- **filepath** (required): The path to a folder, relative to your base path
- **pattern** (optional, defaults to `*`): Regex pattern
- **pathformat** (optional, defaults to `2`): If you specify `1`, the plugin will return the filename only. If you specify `2`, the plugin will output the filename prefixed with your sites base path.

## Changelog
