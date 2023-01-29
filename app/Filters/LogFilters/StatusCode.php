<?php

namespace App\Filters\LogFilters;

use App\Filters\FilterContract;
use App\Filters\QueryFilter;

class StatusCode extends QueryFilter implements FilterContract{
    public function handle($value): void{
        if(is_array($value)){
            $this->query->whereIn('status_code', $value);
        }else{
            $this->query->where('status_code', $value);
        }
    }
}