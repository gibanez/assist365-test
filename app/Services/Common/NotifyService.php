<?php
/**
 * Created by PhpStorm.
 * User: gibanez
 * Date: 16/9/2025
 * Time: 07:41
 */

namespace App\Services\Common;


use App\Contracts\Repository\NotificationRepositoryInterface;
use App\Models\Notification;

class NotifyService
{

    /**
     * @var NotificationRepositoryInterface
     */
    private $notificationRepository;

    public function __construct(NotificationRepositoryInterface $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    public function send($eventName, $data)
    {
        Notification::create([
            'event' => $eventName,
            'data'  => $data,
        ]);
    }
}