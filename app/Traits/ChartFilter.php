<?php

namespace App\Traits;

trait ChartFilter
{

    /**
     * filter data by by date format
     *
     * @param mixed $query
     *
     */
    public function scopeDashboardChartFilter($query)
    {
        $filter = request()->input('format');

        switch ($filter) {
            case 'last_month':
                return $query->whereMonth('created_at', now());
                break;

            case 'all_dates':
                return $query;
                break;
        }

        return $query->whereYear('created_at', now());
    }
}
