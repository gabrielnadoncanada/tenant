<?php

namespace Devlense\FilamentTenant\Resources;

use App\Filament\Resources;
use App\Filament\Actions\SoftDeleteBulkAction;
use App\Filament\Resources\TenantResource\Pages;
use App\Filament\Tables\Actions\SoftDeleteAction;

use Devlense\FilamentTenant\Models\Tenant;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Tables;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class TenantResource extends Resources
{
    protected static ?string $model = Tenant::class;

    protected static bool $shouldCheckPolicyExistence = false;

    protected static ?int $navigationSort = 999;

    protected static ?string $recordTitleAttribute = Tenant::TITLE;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static bool $isScopedToTenant = false;

    protected static function leftColumn(): array
    {
        return [
            Section::make()
                ->columnSpan(1)
                ->columns()
                ->schema([
                    Forms\Components\TextInput::make(Tenant::TITLE)
                        ->required(),
                    Forms\Components\TextInput::make(Tenant::EMAIL)
                        ->email()
                        ->required(),
                ]),
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make(Tenant::TITLE)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make(Tenant::CURRENCY)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make(Tenant::MEASUREMENT_SYSTEM)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make(Tenant::EMAIL)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make(Tenant::CREATED_AT)
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make(Tenant::UPDATED_AT)
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\RestoreAction::make(),
                SoftDeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
            ])
            ->bulkActions([
                SoftDeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ]);
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.group.administration');
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTenants::route('/'),
            'create' => Pages\CreateTenant::route('/create'),
            'edit' => Pages\EditTenant::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();

        return parent::getEloquentQuery()
            ->when(
                $user->hasRole('Super Administrateur'),
                fn ($query) => $query->withoutGlobalScopes([
                    SoftDeletingScope::class,
                ]),
                fn ($query) => $query
                    ->join('Tenant_user', 'tenants.id', '=', 'tenant_user.tenant_id')
                    ->where('tenant_user.user_id', $user->id)
                    ->select('tenants.*')
            );
    }
}
