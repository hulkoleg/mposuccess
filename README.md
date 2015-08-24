## mposuccess install

Install using Composer, edit your ```composer.json``` file to include:
```
"require-dev": {
	"notprometey/mposuccess": "dev-install"
}
```
Update composer from the command line:
```
composer update
```
or

```

composer require notprometey/mposuccess:dev-install
```

Add a new Service Provider to the ```providers``` array in your ```config/app.php``` file:
```
/*
 * Develop Providers
 */
Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class,
Barryvdh\Debugbar\ServiceProvider::class,

/*
 * Production Providers
 */
Notprometey\Mposuccess\MposuccessServiceProvider::class,
Frozennode\Administrator\AdministratorServiceProvider::class,
Bican\Roles\RolesServiceProvider::class,
```
Add a new Service Provider to the ```aliases``` array in your ```config/app.php``` file:
```
'Debugbar' => Barryvdh\Debugbar\Facade::class,
```

Then publish Teacher's assets with `php artisan vendor:publish`.

Run `php artisan migrate` to update you're database to latest migration.