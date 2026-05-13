<?php
namespace App\Filament\Resources\DistributionRecommendationResource\Pages;
use App\Filament\Resources\DistributionRecommendationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
class ListDistributionRecommendations extends ListRecords
{
    protected static string $resource = DistributionRecommendationResource::class;
    protected function getHeaderActions(): array { return [Actions\CreateAction::make()]; }
}
