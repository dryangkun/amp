<?php

namespace Amp\Test;

use Amp;
use Amp\Failure;
use Amp\Loop;

class RethrowTest extends \PHPUnit_Framework_TestCase {
    public function testWaitOnPendingPromise() {
        $exception = new \Exception;

        try {
            Loop::run(function () use ($exception) {
                $promise = new Failure($exception);

                Amp\rethrow($promise);
            });
        } catch (\Exception $reason) {
            $this->assertSame($exception, $reason);
            return;
        }

        $this->fail('Failed promise reason should be thrown from loop');
    }
}
