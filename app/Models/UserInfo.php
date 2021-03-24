<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'account_flag',
        'info_flag',
        'avatar',
        'display_name',
        'desc',
    ];

    // the flag for account_flag
    const ACCOUNT_FLAG_ADMIN = 0x1;
    const ACCOUNT_FLAG_OFFICIAL = 0x2;

    // the flag for info_flag
    const INFO_FLAG_USE_DEFAULT_AVATAR = 0x1;

    // the default avatar file name
    const DEFAULT_AVATAR = [
        '1.png',
        '2.png',
        '3.png',
        '4.png',
        '5.png',
        '6.png',
        '7.png',
        '8.png',
        '9.png',
        '10.png',
    ];

    // get custom attribute

    public function getIsAdminAttribute() {
        return $this->account_flag && UserInfo::ACCOUNT_FLAG_ADMIN;
    }

    public function getIsOfficialAttribute() {
        return $this->account_flag && UserInfo::ACCOUNT_FLAG_OFFICIAL;
    }

    public function getIsUsingDefaultAvatar() {
        return ($this->info_flag && UserInfo::INFO_FLAG_USE_DEFAULT_AVATAR) == UserInfo::INFO_FLAG_USE_DEFAULT_AVATAR;
    }

    //set value
    public function setRandomDefaultAvatar() {
        $this->info_flag |= UserInfo::INFO_FLAG_USE_DEFAULT_AVATAR;
        $randomIndex = rand(0, count(UserInfo::DEFAULT_AVATAR) - 1);
        $this->avatar = UserInfo::DEFAULT_AVATAR[$randomIndex];
    }
}
