<?php

namespace App\Enums;

enum EnergyType: string
{
    case Solar = 'solar';
    case Wind = 'wind';
    case Hydro = 'hydro';
    case Biomass = 'biomass';
    case Geothermal = 'geothermal';
    case Other = 'other';
}
