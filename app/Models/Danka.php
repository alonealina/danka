<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Danka extends Model
{
    use HasFactory;

    protected $guarded = ['id']; 
    protected $table = 'danka';

    protected $appends = [
        'full_address1', 'full_address2', 'kaiki_int',
    ];

    public function getFullAddress1Attribute() {
        return $this->pref . $this->city;
    }

    public function getFullAddress2Attribute() {
        return '"'. $this->address . '　' . $this->building . '"';
    }

    public function getKaikiIntAttribute() {
        if($this->kaiki <= 0) {
            return 1;
        } else {
            return $this->kaiki + 2;
        }
    }

    public function outputCsvContentDanka() {
        return [
            $this->id,
            $this->name,            
            $this->name_kana,    
            '"'.$this->tel.'"',         
            '"'.$this->mobile.'"',         
            $this->mail,       
            $this->introducer,       
            '"'.$this->zip.'"',         
            $this->full_address1,
            $this->full_address2,
            $this->created_at,
            $this->star_flg,
            $this->segaki_flg,
            $this->yakushiji_flg,
            $this->notices,
        ];
    }

    public function outputCsvContentStar() {
        return [
            $this->id,
            $this->name,            
            $this->name_kana,    
            '"'.$this->tel.'"',         
            '"'.$this->mobile.'"',         
            $this->mail,       
            '"'.$this->zip.'"',         
            $this->full_address1,
            $this->full_address2,
            $this->star_flg,
            $this->segaki_flg,
            $this->yakushiji_flg,
        ];
    }

    public function outputCsvContentNenki() {
        return [
            $this->danka_id,
            $this->name,            
            $this->name_kana,    
            '"'.$this->tel.'"',         
            '"'.$this->mobile.'"',         
            $this->mail,       
            '"'.$this->zip.'"',         
            $this->full_address1,
            $this->full_address2,
            $this->type,
            $this->common_name,
            $this->common_kana,
            $this->posthumous,
            $this->gender_h,
            $this->gyonen,
            $this->meinichi,
            $this->kaiki_int,
            $this->kaiki_flg,
            $this->column,
        ];
    }

    public function outputCsvContentNoukotsu() {
        return [
            $this->danka_id,
            $this->name,            
            $this->name_kana,    
            '"'.$this->tel.'"',         
            '"'.$this->mobile.'"',         
            $this->mail,       
            '"'.$this->zip.'"',         
            $this->full_address1,
            $this->full_address2,
            $this->type,
            $this->common_name,
            $this->common_kana,
            $this->posthumous,
            $this->gender_h,
            $this->gyonen,
            $this->meinichi,
            $this->kaiki_int,
            $this->kaiki_flg,
            $this->ihai_no,
            $this->konryubi,
            $this->nokotsu_no,
            $this->nokotsubi,
            $this->nokotsuidobi,
            $this->column,
            $this->henjokaku1.$this->henjokaku2.$this->henjokaku3.$this->henjokaku4,
        ];
    }

}
