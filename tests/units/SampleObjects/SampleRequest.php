<?php
declare(strict_types=1);

namespace Graywings\ArrayCapture\Tests\Units\SampleObjects;

use Graywings\ArrayCapture\Capturable;
use Graywings\ArrayCapture\CapturableTrait;
use Graywings\ArrayCapture\Undefinedable;

class SampleRequest
{
    use CapturableTrait;
    #[Capturable(Capturable::INTEGER, 'prop01')]
    #[Undefinedable]
    public ?int $property01;
    #[Capturable(Capturable::FLOAT, 'prop02')]
    public float $property02;
    #[Capturable(Capturable::STRING, 'prop03')]
    public string $property03;
    #[Capturable(Capturable::BOOLEAN, 'prop04')]
    public bool $property04;
    #[Capturable(Capturable::OBJECT, 'prop05', SampleChild::class)]
    public SampleChild $property05;
}