<?php

namespace Vineyard\StatamicGaDashboard\Widgets;

use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;
use Statamic\Widgets\Widget;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class GaTraffic extends Widget
{
    /**
     * The HTML that should be shown in the widget.
     *
     * @return string|\Illuminate\View\View
     */
    public function html()
    {
        //Cache::flush();

        $number_of_days = 30;

        $start = new Carbon($number_of_days.' days ago');
        $first_day = date('Y-m-d',strtotime($start->toDateString()));
        $end = new Carbon('today');
        $last_day = date('Y-m-d',strtotime($end->toDateString()));
        $period = Period::create($start, $end);
        $range = [$start,$end];

        if (!Cache::has('analyticsData'))
        {
            $analyticsData = Analytics::fetchTotalVisitorsAndPageViews($period);
            Cache::put('analyticsData', $analyticsData, now()->addHours(24));
        }
        else
        {
            $analyticsData = Cache::get('analyticsData');
        }

        foreach($analyticsData as $data)
        {
            $day = date('Y-m-d',strtotime($data['date']));
            $x_axis[$day] = $day;
            $y_axis[$day] = $data['activeUsers'];
            $y_axis2[$day] = $data['screenPageViews'];
        }

        // Iterate over the period
        $carbon_period = CarbonPeriod::create($start, $end);
        foreach ($carbon_period as $date) {
            $day = $date->format('Y-m-d');
            if(!isset($x_axis[$day]))
            {
                $x_axis[$day] = $day;
                $y_axis[$day] = 0;
                $y_axis2[$day] = 0;
            }
        }

        ksort($x_axis);
        ksort($y_axis);
        ksort($y_axis2);

        $x = array_values($x_axis);
        $y = array_values($y_axis);
        $y2 = array_values($y_axis2);

        return view('ga-dashboard::widgets.ga-traffic')
            ->with('x',$x)
            ->with('y',$y)
            ->with('y2',$y2)
            ->with('range',$range)
            ->with('number_of_days',$number_of_days);
    }
}
