<?php

namespace App\Filament\Resources\Users\Pages;

use App\Domains\Identity\Models\User;
use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['password'] = Hash::make($data['password']);

        return $data;
    }

    protected function afterCreate(): void
    {
        $this->record->assignRole($this->data['role']);
    }
}
