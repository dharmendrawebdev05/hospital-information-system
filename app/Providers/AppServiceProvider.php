<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Gate;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Support\Facades\Event;

class AppServiceProvider extends ServiceProvider
{
/**
* Register any application services.
*/
public function register(): void
{
//
}

/**
* Bootstrap any application services.
*/
public function boot(): void
{

Schema::defaultStringLength(191);

Event::listen(BuildingMenu::class, function (BuildingMenu $event) {
if (auth()->check()) {
$user = auth()->user();

// Strict Role Check - Jo role hoga, sirf wahi ek dashboard add hoga
if ($user->role === 'superadmin' || $user->hasRole('superadmin')) {
$event->menu->add([
'text' => 'Dashboard',
'url'  => '/dashboard',
'icon' => 'fas fa-tachometer-alt',
]);
} elseif ($user->role === 'admin' || $user->hasRole('admin')) {
$event->menu->add([
'text' => 'Dashboard',
'url'  => '/dashboard',
'icon' => 'fas fa-tachometer-alt',
]);
} elseif ($user->role === 'doctor' || $user->hasRole('doctor')) {
$event->menu->add([
'text' => 'Dashboard',
'url'  => '/doctor/dashboard',
'icon' => 'fas fa-tachometer-alt',
]);
} elseif ($user->role === 'nurse' || $user->hasRole('nurse')) {
$event->menu->add([
'text' => 'Dashboard',
'url'  => '/nurse/dashboard',
'icon' => 'fas fa-tachometer-alt',
]);
}
}
});
}

}

