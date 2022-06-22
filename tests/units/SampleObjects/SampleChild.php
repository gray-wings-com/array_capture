<?php
declare(strict_types=1);

namespace Graywings\ArrayCapture\Tests\Units\SampleObjects;

use Graywings\ArrayCapture\Capturable;
use Graywings\ArrayCapture\CapturableTrait;

class SampleChild
{
    use CapturableTrait;
    #[Capturable(Capturable::INTEGER, 'prop0501')]
    public int $property0501;
    #[Capturable(Capturable::FLOAT, 'prop0502')]
    public float $property0502;
    #[Capturable(Capturable::STRING, 'prop0503')]
    public string $property0503;
    #[Capturable(Capturable::BOOLEAN, 'prop0504')]
    public bool $property0504;
    #[Capturable(Capturable::OBJECT, 'prop0505', SampleGrandChild::class)]
    public SampleGrandChild $property0505;
    #[Capturable(Capturable::ENUM, 'prop0506', SampleEnum::class)]
    public SampleEnum $property0506;
}