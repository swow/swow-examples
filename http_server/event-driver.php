<?php

use Swow\Psr7\Message\ServerRequest as HttpRequest;
use Swow\Psr7\Server\EventDriver;
use Swow\Psr7\Server\Server;
use Swow\Psr7\Server\ServerConnection;

require __DIR__ . '/../../vendor/autoload.php';

function sprintfWithConnection(ServerConnection $connection, string $format, ...$args): string
{
    /** @noinspection PhpFormatFunctionParametersMismatchInspection */
    return sprintf("[%s] <%s:%d> {$format}", date('Y-m-d H:i:s'), $connection->getPeerAddress(), $connection->getPeerPort(), ...$args);
}

$server = new EventDriver(new Server());
$server->withStartHandler(static function (Server $server): void {
    echo sprintf("[%s] Server started at http://%s:%s\n", date('Y-m-d H:i:s'), $server->getSockAddress(), $server->getSockPort());
})->withConnectionHandler(static function (ServerConnection $connection): void {
    echo sprintfWithConnection($connection, "New connection established\n");
})->withRequestHandler(static function (ServerConnection $connection, HttpRequest $request): string {
    echo sprintfWithConnection($connection, "%s on %s\n", $request->getMethod(), $request->getUri()->getPath());
    return 'Hello Swow!';
})->startOn('127.0.0.1', 9764);
