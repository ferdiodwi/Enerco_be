<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EnergySourceResource\Pages;
use App\Models\EnergySource;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EnergySourceResource extends Resource
{
    protected static ?string $model = EnergySource::class;

    public static function getNavigationIcon(): string { return 'heroicon-o-bolt'; }
    public static function getNavigationGroup(): string { return 'Data Master'; }
    public static function getNavigationLabel(): string { return 'Sumber Energi'; }
    public static function getNavigationSort(): ?int { return 3; }

    public static function form(Schema $form): Schema
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Sumber Energi')->schema([
                Forms\Components\Select::make('provider_id')
                    ->relationship('provider', 'name')
                    ->searchable()->preload()->required(),
                Forms\Components\TextInput::make('name')->required()->maxLength(255),
                Forms\Components\Select::make('type')
                    ->options([
                        'solar' => 'Surya',
                        'wind' => 'Angin',
                        'hydro' => 'Mikrohidro',
                        'biomass' => 'Biomassa',
                        'hybrid' => 'Hybrid',
                    ])->required(),
                Forms\Components\Textarea::make('description')->rows(3),
            ])->columns(2),

            Forms\Components\Section::make('Lokasi')->schema([
                Forms\Components\TextInput::make('address')->required(),
                Forms\Components\TextInput::make('city')->required(),
                Forms\Components\TextInput::make('province')->required(),
                Forms\Components\TextInput::make('latitude')->numeric()->required(),
                Forms\Components\TextInput::make('longitude')->numeric()->required(),
            ])->columns(2),

            Forms\Components\Section::make('Kapasitas')->schema([
                Forms\Components\TextInput::make('capacity_kwh')
                    ->label('Kapasitas Total (kWh)')->numeric()->required(),
                Forms\Components\TextInput::make('available_kwh')
                    ->label('Kapasitas Tersedia (kWh)')->numeric()->required(),
                Forms\Components\TextInput::make('cost_per_kwh')
                    ->label('Biaya per kWh (Rp)')->numeric()->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'active' => 'Aktif',
                        'full' => 'Penuh',
                        'maintenance' => 'Maintenance',
                        'inactive' => 'Nonaktif',
                    ])->default('active')->required(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('provider.name')->label('Provider')->searchable(),
                Tables\Columns\BadgeColumn::make('type')
                    ->colors([
                        'warning' => 'solar',
                        'info' => 'hydro',
                        'success' => 'biomass',
                        'primary' => 'wind',
                        'gray' => 'hybrid',
                    ]),
                Tables\Columns\TextColumn::make('city')->searchable(),
                Tables\Columns\TextColumn::make('capacity_kwh')
                    ->label('Kapasitas')->numeric()->sortable(),
                Tables\Columns\TextColumn::make('available_kwh')
                    ->label('Tersedia')->numeric()->sortable(),
                Tables\Columns\TextColumn::make('cost_per_kwh')
                    ->label('Rp/kWh')->numeric(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'active',
                        'warning' => 'maintenance',
                        'danger' => fn ($state) => in_array($state, ['full', 'inactive']),
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'solar' => 'Surya',
                        'wind' => 'Angin',
                        'hydro' => 'Mikrohidro',
                        'biomass' => 'Biomassa',
                        'hybrid' => 'Hybrid',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'active' => 'Aktif',
                        'full' => 'Penuh',
                        'maintenance' => 'Maintenance',
                        'inactive' => 'Nonaktif',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEnergySources::route('/'),
            'create' => Pages\CreateEnergySource::route('/create'),
            'edit' => Pages\EditEnergySource::route('/{record}/edit'),
        ];
    }
}
