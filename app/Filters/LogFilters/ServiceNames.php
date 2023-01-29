<?php

namespace App\Filters\LogFilters;

use App\Filters\FilterContract;
use App\Filters\QueryFilter;

class ServiceNames extends QueryFilter implements FilterContract{
    public function handle($value): void{
        if(is_array($value)){
            $this->query->whereIn('service_name', $value);
        }else{
            $this->query->where('service_name', $value);
        }
    }
}