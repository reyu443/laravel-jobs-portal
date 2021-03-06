<?php
/**
 * Created by PhpStorm.
 * User: andrestntx
 * Date: 3/20/16
 * Time: 10:57 PM
 */

namespace App\Entities;


use Illuminate\Database\Eloquent\Model;

class Jobseeker extends Model
{
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [];

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'cel', 'user_id', 'doc', 'doc_type', 'geo_location_id', 'sex', 'disability'
    ];

    /**
     * Get the GeoLocation for the jobseeker.
     */
    public function geoLocation()
    {
        return $this->belongsTo('App\Entities\GeoLocation');
    }

    /**
     * Get the resumes for the user.
     */
    public function resumes()
    {
        return $this->hasMany('App\Entities\Resume', 'jobseeker_id', 'user_id');
    }

    /**
     *
     */
    public function activities()
    {
        return $this->belongsToMany('App\Entities\Activity', 'assists')
            ->withPivot('assist_at');
    }

    /**
     * Get the user that owns the company.
     */
    public function user()
    {
        return $this->belongsTo('App\Entities\User');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * @return mixed
     */
    public function getAddressAttribute()
    {
        if($geoLocation = $this->geoLocation) {
            return $geoLocation->address;
        }
    }

}