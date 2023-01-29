<?php

namespace App\Filters\LogFilters;

use App\Filters\FilterContract;
use App\Filters\QueryFilter;

class EndDate extends QueryFilter implements FilterContract{
    public function handle($value): void{
        $this->query->where('date_time', '<=' , $value);
    }
}