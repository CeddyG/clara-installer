Clara installer
===============

A controller and services to setup your .env and the first admin (using Sentinel) fastly.

## Installation

```php
composer require ceddyg/clara-installer
```

Add to your providers in 'config/app.php'
```php
CeddyG\ClaraInstaller\InstallerServiceProvider::class,
```

Then to publish the files.
```php
php artisan vendor:publish --provider="CeddyG\ClaraInstaller\InstallerServiceProvider"
```

## Use

After publishing, go to the installation page (exemple : localhost/install) and enter the informations.

Done.