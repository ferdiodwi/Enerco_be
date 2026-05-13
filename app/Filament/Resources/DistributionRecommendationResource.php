<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DistributionRecommendationResource\Pages;
use App\Models\DistributionRecommendation;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DistributionRecommendationResource extends Resource
{
    protected static ?string $model = DistributionRecommendation::class;

    public static function getNavigationIcon(): string { return 'heroicon-o-sparkles'; }
    public static function getNavigationGroup(): string { return 'AI & Rekomendasi'; }
    public static function getNavigationLabel(): string { return 'Rekomendasi Distribusi'; }
    public static function getNavigationSort(): ?int { return 4; }

    public static function form(Schema $form): Schema
    {
        return $form->schema([
            Forms\Components\Section::make('Detail Rekomendasi')->schema([
                Forms\Components\Select::make('business_id')
                    ->relationship('business', 'name')->required()->searchable()->preload(),
                Forms\Components\Select::make('energy_source_id')
                    ->relationship('energySource', 'name')->required()->searchable()->preload(),
                Forms\Components\Select::make('priority_score_id')
                    ->relationship('priorityScore', 'id')->searchable()->preload(),
                Forms\Components\TextInput::make('recommended_energy_kwh')
                    ->label('Energi Direkomendasikan (kWh)')->numeric()->required(),
                Forms\Components\TextInput::make('distance_km')
                    ->label('Jarak (km)')->numeric()->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'recommended' => 'Direkomendasikan',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                        'implemented' => 'Terimplementasi',
                    ])->default('recommended')->required(),
            ])->columns(2),
            Forms\Components\Section::make('AI Output')->schema([
                Forms\Components\Textarea::make('recommendation_reason')
                    ->label('Alasan Rekomendasi')->rows(3),
                Forms\Components\Textarea::make('ai_summary')
                    ->label('Ringkasan AI')->rows(5),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('business.name')
                    ->label('UMKM')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('energySource.name')
                    ->label('Sumber Energi')->searchable(),
                Tables\Columns\TextColumn::make('priorityScore.total_score')
                    ->label('Skor')->sortable()
                    ->badge()->color(fn ($state) => match(true) {
                        (float)$state >= 81 => 'danger',
                        (float)$state >= 61 => 'warning',
                        (float)$state >= 41 => 'info',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('priorityScore.priority_level')
                    ->label('Level')
                    ->badge()->color(fn ($state) => match($state) {
                        'urgent' => 'danger',
                        'high' => 'warning',
                        'medium' => 'info',
                        'low' => 'gray',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('recommended_energy_kwh')
                    ->label('kWh')->numeric(),
                Tables\Columns\TextColumn::make('distance_km')
                    ->label('Jarak (km)')->numeric(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'gray' => 'draft',
                        'info' => 'recommended',
                        'success' => 'approved',
                        'danger' => 'rejected',
                        'primary' => 'implemented',
                    ]),
            ])
            ->defaultSort('priorityScore.total_score', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'recommended' => 'Direkomendasikan',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                        'implemented' => 'Terimplementasi',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDistributionRecommendations::route('/'),
            'create' => Pages\CreateDistributionRecommendation::route('/create'),
            'edit' => Pages\EditDistributionRecommendation::route('/{record}/edit'),
        ];
    }
}
