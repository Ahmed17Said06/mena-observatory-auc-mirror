<?php

namespace App\Filament\Resources\CountriesResource\Pages;

use App\Filament\Resources\CountriesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCountries extends EditRecord
{
    protected static string $resource = CountriesResource::class;

    protected function getActions(): array
    {
        return [
//            Actions\DeleteAction::make(),
        ];
    }
}
