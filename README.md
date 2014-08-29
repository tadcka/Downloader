Downloader
==========

[![Build Status](https://scrutinizer-ci.com/g/tadcka/Downloader/badges/build.png?b=master)](https://scrutinizer-ci.com/g/tadcka/Downloader/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/tadcka/Downloader/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/tadcka/Downloader/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/tadcka/Downloader/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/tadcka/Downloader/?branch=master)

Downloader component.

## Installation

### Step 1: Download TadckaPaginatorBundle using composer

Add Downloader in your composer.json:

```js
{
    "require": {
        "tadcka/downloader": "dev-master"
    }
}
```

Now tell composer to download the component by running the command:

``` bash
$ php composer.phar update tadcka/downloader
```

### Step 3: How use?

Image downloader example:

``` php
$imageDownloader = new \Tadcka\Component\Downloader\Image\ImageDownloader();
$imageDownloader->download(https://test.org/test.png, '/download-test/');
```