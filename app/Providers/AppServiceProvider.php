<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema;

use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use App\User;
use App\Products;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    
    public function boot(Dispatcher $events)
    {
        Schema::defaultStringLength(191);

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            
            $event->menu->add([
                'text'        => 'Proizvodi',
                'url'         => 'admin/products',
                'icon'        => 'box-open',
                'label'       => Products::count(),
                'label_color' => 'success',

            ],
            [
                'text'        => 'Blog',
                'url'         => 'admin/blog',
                'icon'        => 'edit',
                // 'label'       => 4,
                // 'label_color' => 'success',
            ],
            [
                'text'        => 'Kompanija',
                'url'         => 'admin/company',
                'icon'        => 'building',
                // 'label'       => 4,
                // 'label_color' => 'success',
            ],
            [
                'text'        => 'Karijera',
                'url'         => 'admin/career',
                'icon'        => 'briefcase',
                // 'label'       => 4,
                // 'label_color' => 'success',
                'can' => 'isAdmin'
            ],
        );
            
            $event->menu->add('PODEšAVANjE NALOGA');
            $event->menu->add([
                'text' => 'Korisnici',
                'url'  => '/admin/users',
                'icon' => 'users',
                'label' => User::count(),
            ],
            [
                'text' => 'Moj profil',
                'url'  => '/admin/userProfile',
                'icon' => 'user',
            ]);
        });
    }
}

        