<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportType extends Model
{
    protected $fillable = ['content', 'report_id'];

    public function reports()
    {
        return $this->belongsTo(Report::class);
    }
}
