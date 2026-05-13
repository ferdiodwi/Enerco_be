<?php

namespace App\Filament\Widgets;

use App\Models\Business;
use App\Models\DistributionRecommendation;
use App\Models\EnergySource;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->description('Pengguna terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),

            Stat::make('UMKM Aktif', Business::where('status', 'active')->count())
                ->description(Business::where('status', 'active')->sum('employee_count') . ' pekerja')
                ->descriptionIcon('heroicon-m-building-storefront')
                ->color('success'),

            Stat::make('Sumber Energi', EnergySource::where('status', 'active')->count())
                ->description(number_format((float) EnergySource::sum('capacity_kwh')) . ' kWh kapasitas')
                ->descriptionIcon('heroicon-m-bolt')
                ->color('warning'),

            Stat::make('Rekomendasi AI', DistributionRecommendation::count())
                ->description(DistributionRecommendation::where('status', 'implemented')->count() . ' terimplementasi')
                ->descriptionIcon('heroicon-m-sparkles')
                ->color('info'),
        ];
    }
}
