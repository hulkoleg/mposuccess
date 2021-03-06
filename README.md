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
Stolz\Assets\Laravel\ServiceProvider::class,
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

Run `php artisan db:seed --class=UserSeeder` and `php artisan db:seed --class=TablesSeeder` to seed database with test data (users, roles, news and etc). Then you can log in to the admin panel the following data (email/password):
```
	admin@mposuccess.ru / admin 		- role admin
	moderator@mposuccess.ru / moderator	- role moderator
	user@mposuccess.ru / user			- role user (verified user)
	test@mposuccess.ru / test			- role bad.user (not verified user)
```
Download the files [`public`](https://drive.google.com/file/d/0B1FIEy8WL45hRDFzRTNaZXJuVkU/view?usp=sharing) and put them in a folder `PROJECT_DIR\public`

Create sumylink `mklink /D "C:\xampp\htdocs\mposuccess\public\assets" "C:\xampp\htdocs\mposuccess\vendor\notprometey\mposuccess\public\assets"`

Create sumylink `mklink /D "C:\xampp\htdocs\mposuccess\public\images" "C:\xampp\htdocs\mposuccess\vendor\notprometey\mposuccess\public\images"`
