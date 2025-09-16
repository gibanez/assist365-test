<?php
/**
 * Created by PhpStorm.
 * User: gibanez
 * Date: 16/9/2025
 * Time: 07:43
 */

namespace App\Services\Common;


use App\Contracts\Repository\NotificationRepositoryInterface;
use App\Models\Notification;

class NotificationRepositoryDB implements NotificationRepositoryInterface
{

    public function persist(Notification $notification)
    {
        $notification->save();
    }
}