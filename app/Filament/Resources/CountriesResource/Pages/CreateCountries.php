<?php

namespace App\Filament\Resources\CountriesResource\Pages;

use App\Filament\Resources\CountriesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCountries extends CreateRecord
{
    protected static string $resource = CountriesResource::class;
}
