<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Charts;
use App\User;

class DashboardController extends Controller
{
    public function index()
    {
  Charts::create('line', 'highcharts')
    ->title('My nice chart')
    ->labels(['First', 'Second', 'Third'])
    ->values([5,10,20])
    ->dimensions(1000,500)
    ->responsive(false);
    }
}
