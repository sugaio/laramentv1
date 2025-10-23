<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Domains\Identity\Models\User;
use App\Domains\Tenancy\Models\Organization;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserForm
{
    public static function schema(): array
    {
        return [
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            TextInput::make('email')

                ->email()
                ->required()
                ->maxLength(255)
                ->unique(table: User::class, column: 'email', ignoreRecord: true),
            TextInput::make('password')
                ->password()
                ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                ->dehydrated(fn ($state) => filled($state))
                ->required(fn (string $context): bool => $context === 'create')
                ->maxLength(255),
            DateTimePicker::make('email_verified_at'),
            Select::make('organization_id')
                ->label('Organization')
                ->options(Organization::all()->pluck('name', 'id'))
                ->searchable()
                ->required(),
            Select::make('role')
                ->options(Role::all()->pluck('name', 'name'))
                ->searchable()
                ->required(),
        ];
    }
}
