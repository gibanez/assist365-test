<?php
/**
 * Created by PhpStorm.
 * User: gibanez
 * Date: 16/9/2025
 * Time: 07:42
 */

namespace App\Contracts\Repository;


use App\Models\Notification;

interface NotificationRepositoryInterface
{
    public function persist(Notification $notification);
}