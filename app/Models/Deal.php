<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;

    protected $guarded = ['id']; 

    protected $dates = ['created_at', 'updated_at'];
    
    protected $appends = [
        'full_address', 'kaiki_int',
    ];

    public function getFullAddress1Attribute() {
        return $this->pref . $this->city;
    }

    public function getFullAddress2Attribute() {
        return $this->address . '　' . $this->building;
    }

    public function getKaikiIntAttribute() {
        if (empty($this->common_name)) {
            return '';
        } elseif($this->kaiki <= 0) {
            return 1;
        } else {
            return $this->kaiki + 2;
        }
    }

    protected $table = 'deal';

    public function outputCsvContent() {
        return [
            $this->deal_no,
            $this->created_at,
            $this->payment_date,
            $this->danka_id,
            $this->danka_name,
            $this->name_kana,
            $this->tel,
            $this->mobile,         
            $this->mail,       
            $this->zip,       
            $this->full_address1,
            $this->full_address2,
            $this->payment_method,
            $this->state,
            $this->item_category_name,
            $this->detail,
            $this->price,
            $this->quantity,
            $this->total,
            $this->common_name,
            $this->common_kana,
            $this->posthumous,
            $this->meinichi,
            $this->kaiki_int,
            $this->gyonen,
            $this->remark,
        ];
    }

}
