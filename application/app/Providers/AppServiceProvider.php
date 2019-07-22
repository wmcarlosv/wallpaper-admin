<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        $events->Listen(BuildingMenu::class, function(BuildingMenu $event){
            $event->menu->add('MAIN MENU');
            $role = Auth::user()->role;
            if($role == 'administrator'){
                $event->menu->add(
                    [
                        'text' => 'dashboard',
                        'route' => 'home',
                        'icon' => 'dashboard'
                    ],
                    [
                        'text' => 'Profile',
                        'route' => 'profile',
                        'icon' => 'user'
                    ],
                    [
                        'text' => 'Users',
                        'route' => 'users.index',
                        'icon' => 'users'
                    ],
                    [
                        'text' => 'Applications',
                        'route' => 'applications.index',
                        'icon' => 'gamepad'
                    ]
                );
            }else{
                $event->menu->add(
                [
                    'text' => 'Aplications',
                    'route' => 'home',
                    'icon' => 'gamepad'
                ],
                [
                    'text' => 'Profile',
                    'route' => 'profile',
                    'icon' => 'user'
                ]
            );
            }
        });
    }
}
