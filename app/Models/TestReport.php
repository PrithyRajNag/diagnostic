<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class TestReport extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded=[
        'id',
        'uuid',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function($model) {
            $model->uuid = Str::uuid();

            $model->report_no = "000001";
            $last_data_row = static::orderBy('id', 'DESC')
                ->first();
            if ($last_data_row != null) {
                $last_report_no = $last_data_row->report_no;
                $report_no = $last_report_no != NULL
                    ? str_pad((int)$last_report_no + 1, 6, '0', STR_PAD_LEFT)
                    : str_pad(1, 6, '0', STR_PAD_LEFT);
                $model->report_no = $report_no;
            }
        });
    }
    public function testItems()
    {
        return $this->belongsTo(TestItem::class, 'test_item_id', 'id');
    }
}
