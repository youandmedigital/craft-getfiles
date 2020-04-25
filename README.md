<p align="center">
    <img src="https://github.com/youandmedigital/craft-getfiles/blob/master/src/icon.svg" alt="GetFiles" width="150"/>
</p>

# GetFiles for Craft 3.1

Retrieve a list of files based on a specified folder path.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

```
cd /path/to/project
```

2. Then tell Composer to load the plugin:

```
composer require youandmedigital/craft-getfiles
```

## Introduction

This little plugin retrieves a list of files based on a specified folder path.

This might be useful to you if

- You're running Craft 3.1 or above
- You need to retrieve files, not managed by Craft CMS, from a folder on your web server and return the output in Twig

## Examples

### Output the contents of a directory

Inside /assets/images there are 3 image files:
```
22 Apr 22:54 image01.jpg
22 Apr 22:54 image02.jpg
22 Apr 22:54 image03.gif
```

In our Twig templates, we set variables and give GetFiles a folder path to search:
```
{% set settings =
    {
        path: '/assets/images/'
    }
%}
{% set file = craft.getfiles.config(settings) %}

<p>Available images:</p>
{% for image in images %}
    <img src="{{ image }}" alt="{{ image }}">
{% endfor %}
```

This example Twig code would output:
```
<img src="/assets/images/image01.jpg" alt="image01.jpg">
<img src="/assets/images/image02.jpg" alt="image02.jpg">
<img src="/assets/images/image03.gif" alt="image03.gif">
```

### Output the contents of a directory which matches a regex pattern

Inside /assets/images there are 3 files:
```
<img src="/assets/images/image01.jpg" alt="image01.jpg">
<img src="/assets/images/image02.jpg" alt="image02.jpg">
<img src="/assets/images/image03.gif" alt="image03.gif">
```

In our Twig templates, we set variables, give GetFiles a folder path to search and a regex pattern to match:
```
{% set settings =
    {
        path: '/assets/images/',
        pattern: '*.gif'
    }
%}
{% set images = craft.getfiles.config(settings) %}

<p>Available images:</p>
{% for image in images %}
<img src="/assets/images/{{ image }}" alt="{{ image }}">
{% endfor %}
```

This example Twig code would output:
```
<p>Available images:<p>
<img src="/assets/images/image03.gif" alt="image03.gif">
```

## Configuring GetFiles

- **path** `(string, required)`: A valid folder for GetFiles to search
- **pattern** `(string, optional, default value '*')`: A regex pattern to match
- **pathFormat** `(string, optional, default value '2')`: If you specify `1`, the plugin will return the filename only. If you specify `2`, the plugin will output the filename name relative to your base path. `3` will output the absolute path to the filename.

Example configuration:
```
{% set myVarSettings =
    {
        path: '<path>',
        pathformat: '<pathformat>',
        pattern: '<pattern>'
    }
%}

{% set myVar = craft.getfiles.config(myVarSettings) %}
```