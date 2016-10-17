# Installation instructions
* Download [ARToolkit](https://artoolkit.org/documentation/doku.php?id=1_Getting_Started:about_installing)
    * Extract ```tar xzvf ARToolKit5-bin-*.tar.gz```
    * Run ```./share/artoolkit5-setenv```
    * Copy ```genTexData``` to /bin
 * Add ```JapSeyz\Ar\ToolkitServiceProvider::class,``` to providers      
    
    
    


# Generate ARToolkit markers from Laravel

You can install the package via composer:

``` bash
composer require japseyz/ar-toolkit
```

## Usage

``` php
$toolkit = new JapSeyz\Ar\Toolkit();
$toolkit->add($pathToJpgImage);
```
