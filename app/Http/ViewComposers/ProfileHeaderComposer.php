<?php
/**
 * Created by PhpStorm.
 * User: l
 * Date: 24/11/2018
 * Time: 01:06 PM
 */

namespace App\Http\ViewComposers;


use App\Http\Repositories\ProfileHeaderRepository;
use Illuminate\View\View;

class ProfileHeaderComposer
{
    protected $profile;

    public function __construct(ProfileHeaderRepository $p)
    {
        $this->profile = $p;
    }

    public function compose(View $view)
    {
        $profileInfo = (object)$this->profile->profiles();

        $user = $profileInfo->user;
        $profile = $profileInfo->profile;
        $logs = $profileInfo->logs;
        $friend = $profileInfo->friend;
        $hasFollower = $profileInfo->hasFollower;
        $hasFollowing = $profileInfo->hasFollowing;



        $view->with(compact(['user','profile','logs','friend','hasFollower','hasFollowing']));
    }
}