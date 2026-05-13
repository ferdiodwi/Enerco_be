<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusinessResource\Pages;
use App\Models\Business;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BusinessResource extends Resource
{
    protected static ?string $model = Business::class;

    public static function getNavigationIcon(): string { return 'heroicon-o-building-storefront'; }
    public static function getNavigationGroup(): string { return 'Data Master'; }
    public static function getNavigationLabel(): string { return 'UMKM'; }
    public static function getNavigationSort(): ?int { return 2; }

    public static function form(Schema $form): Schema
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi UMKM')->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()->preload()->required(),
                Forms\Components\TextInput::make('name')
                    ->required()->maxLength(255),
                Forms\Components\Select::make('sector')
                    ->options([
                        'food_processing' => 'Pengolahan Makanan',
                        'fisheries' => 'Perikanan',
                        'agriculture' => 'Pertanian',
                        'textile' => 'Tekstil',
                        'craft' => 'Kerajinan',
                        'manufacturing' => 'Manufaktur',
                        'services' => 'Jasa',
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

            Forms\Components\Section::make('Data Energi & Produksi')->schema([
                Forms\Components\TextInput::make('monthly_energy_need')
                    ->label('Kebutuhan Energi (kWh/bulan)')
                    ->numeric()->required(),
                Forms\Components\TextInput::make('current_energy_cost')
                    ->label('Biaya Energi Saat Ini (Rp/bulan)')
                    ->numeric()->required(),
                Forms\Components\TextInput::make('production_capacity')
                    ->label('Kapasitas Produksi')
                    ->numeric(),
                Forms\Components\TextInput::make('employee_count')
                    ->label('Jumlah Pekerja')
                    ->numeric()->required(),
                Forms\Components\Toggle::make('clean_energy_access')
                    ->label('Sudah Akses Energi Bersih?'),
                Forms\Components\Select::make('status')
                    ->options([
                        'active' => 'Aktif',
                        'inactive' => 'Nonaktif',
                        'pending' => 'Pending',
                    ])->default('active')->required(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('user.name')->label('Pemilik')->searchable(),
                Tables\Columns\BadgeColumn::make('sector')
                    ->colors([
                        'success' => 'food_processing',
                        'info' => 'fisheries',
                        'warning' => 'agriculture',
                    ]),
                Tables\Columns\TextColumn::make('city')->searchable(),
                Tables\Columns\TextColumn::make('monthly_energy_need')
                    ->label('Energi (kWh)')
                    ->numeric()->sortable(),
                Tables\Columns\TextColumn::make('employee_count')
                    ->label('Pekerja')->sortable(),
                Tables\Columns\IconColumn::make('clean_energy_access')
                    ->label('Energi Bersih')
                    ->boolean(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'active',
                        'danger' => 'inactive',
                        'warning' => 'pending',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('sector')
                    ->options([
                        'food_processing' => 'Pengolahan Makanan',
                        'fisheries' => 'Perikanan',
                        'agriculture' => 'Pertanian',
                        'textile' => 'Tekstil',
                        'craft' => 'Kerajinan',
                        'manufacturing' => 'Manufaktur',
                        'services' => 'Jasa',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'active' => 'Aktif',
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
            'index' => Pages\ListBusinesses::route('/'),
            'create' => Pages\CreateBusiness::route('/create'),
            'edit' => Pages\EditBusiness::route('/{record}/edit'),
        ];
    }
}
