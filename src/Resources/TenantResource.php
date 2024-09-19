<?php

namespace Devlense\FilamentTenant\Resources;

use Devlense\FilamentTenant\Models\Tenant;
use Devlense\FilamentTenant\Resources\TenantResource\Pages\CreateTenant;
use Devlense\FilamentTenant\Resources\TenantResource\Pages\EditTenant;
use Devlense\FilamentTenant\Resources\TenantResource\Pages\ListTenants;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Table;

class TenantResource extends Resource
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
                Tables\Actions\ForceDeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTenants::route('/'),
            'create' => CreateTenant::route('/create'),
            'edit' => EditTenant::route('/{record}/edit'),
        ];
    }
}
