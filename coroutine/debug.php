<?php
/**
 * This file is part of Swow
 *
 * @link     https://github.com/swow/swow
 * @contact  twosee <twose@qq.com>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code
 */

declare(strict_types=1);

Swow\Coroutine::run(static function () {
    (static function () {
        (static function () {
            var_dump(Swow\Coroutine::getCurrent());
        })();
    })();
});
