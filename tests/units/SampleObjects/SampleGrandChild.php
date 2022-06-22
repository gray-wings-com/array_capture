<?php
declare(strict_types=1);

namespace Graywings\ArrayCapture\Tests\Units\SampleObjects;

use Graywings\ArrayCapture\Capturable;
use Graywings\ArrayCapture\CapturableTrait;

class SampleGrandChild
{
    use CapturableTrait;
    #[Capturable(Capturable::INTEGER, 'prop050501')]
    public int $property050501;
    #[Capturable(Capturable::FLOAT, 'prop050502')]
    public float $property050502;
    #[Capturable(Capturable::STRING, 'prop050503')]
    public string $property050503;
    #[Capturable(Capturable::BOOLEAN, 'prop050504')]
    public bool $property050504;
}