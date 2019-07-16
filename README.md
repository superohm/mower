MOWER Install
=====================

## Pre-requis :

1/ Have a PHP local environnement :

Try in command line :
php -v 

2/ Have composer install :

https://getcomposer.org/doc/00-intro.md

## Install instruction :

1/ get git source :

git clone https://github.com/superohm/mower.git mower

3/ go in you folder 

cd mower

4/ launch your composer in your terminal :
``` bash
composer install 
```

5/ execute the mower run command :
**Type the following command**

``` bash

	php bin/console app:run-mower "your_root_dir_to_mower_project"/instructionFile.txt

```

6/ execute the test :
**Type the following command**
``` bash

	php bin/phpunit tests/Mower

```
