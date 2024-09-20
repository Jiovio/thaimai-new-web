<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ecregister extends Model
{
    use HasFactory;

    protected $table = 'ecregister';
    protected $primaryKey = 'id';

    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'ecfrno', 'dateecreg', 'picmeNo', 'motheraadhaarid', 'motheraadhaarname',
        'husbandaadhaarid', 'husbandaadhaarname', 'motherfullname', 'motherdob',
        'motherageecreg', 'motheragemarriage', 'mothermobno', 'mobileofperson',
        'motheredustatus', 'husfullname', 'husdob', 'husageecreg', 'husagemarriage',
        'husmobno', 'husedustatus', 'religion', 'caste', 'BlockId', 'PhcId',
        'HscId', 'PanchayatId', 'VillageId', 'address', 'pincode', 'povertystatus',
        'migrantstatus', 'rationcardtype', 'rationcardnum', 'status', 'createdat',
        'createdBy', 'updatedat', 'updatedBy', 'deletedat', 'deletedBy'
    ];
}
