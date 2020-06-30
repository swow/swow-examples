<?php
/**
 * This file is part of Swow
 *
 * @link     https://github.com/s-wow/swow
 * @contact  twosee <twose@qq.com>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code
 */

declare(strict_types=1);

while (true) {
    Swow\Coroutine::run(static function (Swow\Socket $client) { while ($data = $client->recvString()) { $client->sendString($data); } }, ($server = $server ?? ((new Swow\Socket(Swow\Socket::TYPE_TCP))->bind('127.0.0.1', 9764)->listen()))->accept());
}
