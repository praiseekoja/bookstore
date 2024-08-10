<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class DevCredentials extends Authenticatable
{
    use HasApiTokens;

    protected $table = 'dev_credentials';
}


/**
 *
 * {
 *   "Ayo": "1|llsMVtuMnY9vXsdygvbnhv7d3TjOksNSQcTkEmR20270ac6f",
 *   "Cheto": "2|bDQ9KYMndDJWe1YmV7L0FBtpN5ih42saDgS9ik3Z322ea9ec",
 *   "Collins": "3|sw6Sukjd8mBPI1T1YwE2IqcuVwFPFif1Ld2Wduxueae497d6"
 * }
 *
 */
