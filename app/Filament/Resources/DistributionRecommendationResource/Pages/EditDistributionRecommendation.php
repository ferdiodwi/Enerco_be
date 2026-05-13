<?php
namespace App\Filament\Resources\DistributionRecommendationResource\Pages;
use App\Filament\Resources\DistributionRecommendationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
class EditDistributionRecommendation extends EditRecord
{
    protected static string $resource = DistributionRecommendationResource::class;
    protected function getHeaderActions(): array { return [Actions\DeleteAction::make()]; }
}
