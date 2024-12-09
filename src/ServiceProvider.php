<?php

namespace Vineyard\StatamicGaDashboard;

use Statamic\Providers\AddonServiceProvider;
use Illuminate\Support\Facades\View;

class ServiceProvider extends AddonServiceProvider
{
    protected $viewNamespace = 'ga-dashboard';

    protected $widgets = [
        \Vineyard\StatamicGaDashboard\Widgets\GaTraffic::class,
    ];

    public function bootAddon()
    {
        //
    }

    /*
    protected $vite = [
        'input' => [
            'resources/js/cp.js',
            'resources/css/cp.css'
        ],
        'publicDirectory' => 'resources/dist',
    ];
    */
}
