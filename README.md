## Multi Tenancy Boilerplate

This is a multi-tenancy boilerplate project using https://tenancyforlaravel.com/ and inspired by a [LaravelDaily](https://github.com/LaravelDaily/Laravel-Multi-Tenancy-Multi-DB-Demo) sample repository.

It's set to multi-database architecture. You may ch ange this configuration following instructions in the main package.

### Useful tutorials and resources
- **[Laravel Multi-Tenancy Tutorial Playlist](https://www.youtube.com/playlist?list=PLoT0Ngy3KoLLomJDbNhIrQRT3n0UHVxqQ)**
- **[Install XDebug](https://xdebug.org/wizard)**
- **[Laragon](https://laragon.org/)** 

### How to use with Laragon
* Use {project}.localhost for the local domain to allow wildcard subdomains.
* Run `composer install`
* Run `php artisan migrate`
* Run `npm install`
* Run `vite`

**NOTE:** For the production use, you need to add the subdomain dns configuration functionality to the registration process.
The controller is `app/Http/Controllers/Auth/RegisteredUserController.php`

To run migrations for tenants, specify the path:
`php artisan migrate --path=database/migrations/tenant`

### Example codes:
The project comes with basic project and task management features for the sake of providing a few examples.

It also includes breeze auth UI with inertia vue3.

### How it works:
The main domain allows users to register along with a unique subdomain. After registering, the user will be redirected to the dashboard page under the subdomain host address.

The next time a registered user signs in, the user will be redirected to the subdomain dashboard.
