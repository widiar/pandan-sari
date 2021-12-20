<?php

use App\Models\WaterSport;

function getWaterSport($start, $limit)
{
    return WaterSport::skip($start)->take($limit)->get();
}
