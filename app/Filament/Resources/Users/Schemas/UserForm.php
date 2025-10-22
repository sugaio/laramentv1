<?php

namespace App\Filament\Resources\Users\Schemas;

// --- KOMPONEN INPUT ---
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\CheckboxList;

// --- KOMPONEN LAYOUT ---
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

// --- Helper ---
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Get;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Pengguna')
                    ->description('Detail dasar pengguna.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(
                                table: 'users',
                                column: 'email',
                                ignoreRecord: true
                            ),
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'active' => 'Aktif',
                                'banned' => 'Diblokir',
                            ])
                            ->required()
                            ->default('active')
                            ->native(false),
                        DateTimePicker::make('email_verified_at')
                            ->label('Email Terverifikasi Pada')
                            ->native(false)
                            ->default(fn (string $operation) => $operation === 'create' ? now() : null),
                    ])->columns(2),

                Section::make('Keamanan & Peran')
                    ->schema([
                        TextInput::make('password')
                            ->label(fn (string $operation) => $operation === 'create' ? 'Password' : 'Password Baru (Opsional)')
                            ->password()
                            ->revealable()
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->dehydrateStateUsing(fn (?string $state): ?string =>
                                filled($state) ? Hash::make($state) : null
                            )
                            ->dehydrated(fn (?string $state): bool => filled($state))
                            ->maxLength(255),

                        CheckboxList::make('roles')
                            ->label('Peran (Roles)')
                            ->relationship('roles', 'name')
                            ->searchable()
                            // ->preload()
                            ->columns(2),
                    ])->columns(2),
            ]);
    }
}
