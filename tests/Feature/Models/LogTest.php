<?php

namespace Tests\Feature\Models;

use App\Models\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogTest extends TestCase
{
    use RefreshDatabase , ModelHelperTesting;
    
    protected function model(): Model
    {
        return new Log();
    }
}
