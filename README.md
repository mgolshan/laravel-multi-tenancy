## Multi Tenancy Boilerplate

This is a multi-tenancy boilerplate project using https://tenancyforlaravel.com/ and inspired by a [LaravelDaily](https://github.com/LaravelDaily/Laravel-Multi-Tenancy-Multi-DB-Demo) sample repository.

### Useful tutorials and resources
- **[Laravel Multi-Tenancy Tutorial Playlist](https://www.youtube.com/playlist?list=PLoT0Ngy3KoLLomJDbNhIrQRT3n0UHVxqQ)**
- **[Install XDebug](https://xdebug.org/wizard)**
- **[Laragon](https://laragon.org/)** 

### How to use with Laragon
* Use {project}.localhost for the local domain to allow wildcard subdomains.
* Run `composer install`
* Run `npm install`
* Run `vite`

**NOTE:** For the production use, you need to add the subdomain dns configuration functionality to the registration process.
The controller is `app/Http/Controllers/Auth/RegisteredUserController.php`


### Example codes:
The project comes with basic project and task management features for the sake of providing a few example.

It also includes breeze auth with inertia vue3.
