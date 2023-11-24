<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $table = 'calendars';

    protected $fillable = [
        'semester',
        'start_date',
        'end_date'
    ];

    public static function findSemestersBetween($startDate, $endDate)
    {
        $semesters = self::whereBetween('start_date', [$startDate, $endDate])
            ->orWhereBetween('end_date', [$startDate, $endDate])
            ->orWhere(function ($query) use ($startDate, $endDate) {
                $query->where('start_date', '<', $startDate)
                    ->where('end_date', '>', $endDate);
            })
            ->get();

        return $semesters;
    }
}
