<?php
declare(strict_types=1);

namespace Graywings\ArrayCapture\Tests\Units;

use Graywings\ArrayCapture\Tests\Units\SampleObjects\SampleRequest;
use PHPUnit\Framework\TestCase;

class CapturableTraitTest extends TestCase
{
    function test_capture() {
        $request = SampleRequest::capture([
            'prop02' => '1.23',
            'prop03' => 'hello world',
            'prop04' => 'true',
            'prop05' => [
                'prop0501' => '111',
                'prop0502' => '1.23',
                'prop0503' => 'hello world',
                'prop0504' => 'true',
                'prop0505' => [
                    'prop050501' => '111',
                    'prop050502' => '1.23',
                    'prop050503' => 'hello world',
                    'prop050504' => 'true'
                ],
                'prop0506' => '1'
            ]
        ]);
        var_dump($request);
    }
}
