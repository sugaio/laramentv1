<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Resources\Users\Schemas\UserForm;
use App\Filament\Resources\Users\Tables\UsersTable;
use App\Models\User;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use BackedEnum;
use UnitEnum;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    /**
     * @var string|class-string<BackedEnum>|null
     */
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-users';

    /**
     * @var string|class-string<UnitEnum>|null
     */
    protected static string|UnitEnum|null $navigationGroup = 'Manajemen Akses';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        // Mendelegasikan Form ke class terpisah
        return UserForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        // Mendelegasikan Tabel ke class terpisah
        return UsersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
