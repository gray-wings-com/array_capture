<?php
declare(strict_types=1);

namespace Graywings\ArrayCapture;

use Attribute;
use Graywings\ArrayCapture\Tests\Units\SampleObjects\SampleChild;

#[Attribute(Attribute::TARGET_PROPERTY)]
enum Capturable
{
    case INTEGER;
    case FLOAT;
    case STRING;
    case BOOLEAN;
    case OBJECT;
    case ENUM;
}