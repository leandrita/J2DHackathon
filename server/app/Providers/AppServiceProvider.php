<?php

namespace App\Providers;

use App\Models\Skin;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // acá deberia tener una función que lea un archivo json (skins.json) y lo guarde en la base de datos

        // print "Este es un mensaje informativo.";
        // $jsonContent = file_get_contents('skins.json');
        // $skinsData = json_decode($jsonContent, true);



        // foreach ($skinsData as $skinData) {
        //     Skin::updateOrCreate(
        //         ['id' => $skinData['id'], 'name' => $skinData['name'], 'type' => $skinData['type'], 'price' => $skinData['price'], 'color' => $skinData['color']],
        //     );
        // }
    }
}