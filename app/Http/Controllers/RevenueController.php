<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Traits\APIResponse;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use Exception;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    use APIResponse;

    /**
     * Get revenue by date range.
     */
    public function revenueByDate(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date',
        ]);

        $from = Carbon::parse($request->from_date);
        $to = Carbon::parse($request->to_date);
        $fromDate = $from->format('Y-m-d') . ' 00:00:00';
        $toDate = $to->format('Y-m-d') . ' 23:59:59';

        $bills = Bill::whereBetween('created_at', [$fromDate, $toDate])->get();
        $revenue = $bills->sum('tong_tien');

        $revenueByDate = [];
        try {
            $interval = new DateInterval('P1D');
            $dateRange = new DatePeriod($from, $interval, $to->addDay());
            foreach ($dateRange as $date) {
                $date = $date->format('Y-m-d');
                $dailyRevenue = Bill::whereDate('created_at', $date)->sum('tong_tien');
                $revenueByDate[] = ['date' => $date, 'revenue' => $dailyRevenue];
            }
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }

        return $this->success([
            'revenue' => $revenue,
            'revenue_by_date' => $revenueByDate,
        ]);
    }
}
