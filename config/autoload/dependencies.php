<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

use App\services\UserService;
use App\Interface\UserInterface;
use App\services\TransactService;
use App\Interface\TransactInterface;
use App\Interface\ClientInterface;
use App\Http\GuzzleClient;
use App\Interface\NotificationInterface;
use App\services\NotificationService;

return [
    UserInterface::class => UserService::class,
    TransactInterface::class => TransactService::class,
    ClientInterface::class => GuzzleClient::class,
    NotificationInterface::class => NotificationService::class
];
