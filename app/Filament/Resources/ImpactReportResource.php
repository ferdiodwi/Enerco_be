<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ImpactReportResource\Pages;
use App\Models\ImpactReport;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ImpactReportResource extends Resource
{
    protected static ?string $model = ImpactReport::class;

    public static function getNavigationIcon(): string { return 'heroicon-o-chart-bar'; }
    public static function getNavigationGroup(): string { return 'AI & Rekomendasi'; }
    public static function getNavigationLabel(): string { return 'Laporan Dampak'; }
    public static function getNavigationSort(): ?int { return 5; }

    public static function form(Schema $form): Schema
    {
        return $form->schema([
            Forms\Components\Section::make('Detail Laporan')->schema([
                Forms\Components\Select::make('business_id')
                    ->relationship('business', 'name')->required()->searchable()->preload(),
                Forms\Components\Select::make('distribution_recommendation_id')
                    ->relationship('distributionRecommendation', 'id')->searchable()->preload(),
                Forms\Components\TextInput::make('old_energy_cost')
                    ->label('Biaya Energi Lama (Rp)')->numeric()->required(),
                Forms\Components\TextInput::make('new_energy_cost')
                    ->label('Biaya Energi Baru (Rp)')->numeric()->required(),
                Forms\Components\TextInput::make('cost_saving')
                    ->label('Penghematan (Rp)')->numeric(),
                Forms\Components\TextInput::make('productivity_increase_percentage')
                    ->label('Peningkatan Produktivitas (%)')->numeric()->required(),
                Forms\Components\TextInput::make('estimated_emission_reduction')
                    ->label('Pengurangan Emisi (kg CO₂)')->numeric()->required(),
                Forms\Components\TextInput::make('report_period')
                    ->label('Periode Laporan')->required(),
                Forms\Components\Textarea::make('notes')->label('Catatan')->rows(3),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('business.name')->label('UMKM')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('report_period')->label('Periode')->sortable(),
                Tables\Columns\TextColumn::make('old_energy_cost')->label('Biaya Lama')->money('idr'),
                Tables\Columns\TextColumn::make('new_energy_cost')->label('Biaya Baru')->money('idr'),
                Tables\Columns\TextColumn::make('cost_saving')->label('Penghematan')->money('idr')
                    ->color('success'),
                Tables\Columns\TextColumn::make('productivity_increase_percentage')
                    ->label('Produktivitas (↑)')
                    ->suffix('%'),
                Tables\Columns\TextColumn::make('estimated_emission_reduction')
                    ->label('Emisi (↓)')
                    ->suffix(' kg'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListImpactReports::route('/'),
            'create' => Pages\CreateImpactReport::route('/create'),
            'edit' => Pages\EditImpactReport::route('/{record}/edit'),
        ];
    }
}
