# Graywings/ArrayCapture
## Array casting library

Graywings/ArrayCapture is a library to cast from Associative array to any class's instance

## How to use

``` php
<?php
declare(strict_types=1);

use Graywings\ArrayCapture\Capturable;
use Graywings\ArrayCapture\CapturableTrait;
use Graywings\ArrayCapture\Undefinedable;

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

enum SampleEnum: int
{
    case ONE = 1;
    case TWO = 2;
    case THREE = 3;
}
```
