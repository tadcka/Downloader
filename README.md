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

File downloader example:

``` php
use Tadcka\Component\Downloader\FileDownloader;
use Symfony\Component\Filesystem\Filesystem;

...

$fileDownloader = new FileDownloader(new Filesystem());
$fileDownloader->download('https://test.org/test.txt', '/download-test/');
```

Image downloader example:

``` php
use Tadcka\Component\Downloader\Image\ImageDownloader;
use Symfony\Component\Filesystem\Filesystem;

...

$imageDownloader = new ImageDownloader(new Filesystem());
$imageDownloader->download('https://test.org/test.png', '/download-test/');
```
