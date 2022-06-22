<?php
declare(strict_types=1);

namespace Graywings\ArrayCapture;

use InvalidArgumentException;
use ReflectionEnum;
use ReflectionClass;
use ReflectionEnumBackedCase;
use ReflectionException;
use ReflectionNamedType;
use UnitEnum;

trait CapturableTrait
{
    public static function capture(
        array $eachParameters
    ): self{
        $self = new self();
        $reflection = new ReflectionClass(self::class);
        $selfReflection = new ReflectionClass($self);
        $properties = $reflection->getProperties();
        foreach($properties as $property) {
            $attributes = $property->getAttributes();
            $undefinedable = array_filter($attributes, function($attribute) {
                return $attribute->getName() === Undefinedable::class;
            });
            $isUndefinedable = $undefinedable > 0;
            foreach ($attributes as $attribute) {
                if ($attribute->getName() === Capturable::class) {
                    $property = $selfReflection->getProperty($property->getName());

                    if ($isUndefinedable && !array_key_exists($attribute->getArguments()[1], $eachParameters)) {
                        $value = null;
                    } else {
                        match($attribute->getArguments()[0]) {
                            Capturable::INTEGER => $value = intval($eachParameters[$attribute->getArguments()[1]]),
                            Capturable::FLOAT => $value = floatval($eachParameters[$attribute->getArguments()[1]]),
                            Capturable::STRING => $value = strval($eachParameters[$attribute->getArguments()[1]]),
                            Capturable::BOOLEAN => $value = boolval($eachParameters[$attribute->getArguments()[1]]),
                            Capturable::OBJECT => $value = $attribute->getArguments()[2]::capture($eachParameters[$attribute->getArguments()[1]]),
                            Capturable::ENUM => $value = self::enumSet($eachParameters, $attribute->getArguments()[1], $attribute->getArguments()[2])
                        };
                    }
                    $property->setValue($self, $value);
                }
            }
        }
        return $self;
    }

    private static function enumSet(
        array $eachParameter,
        string $propertyName,
        string $enumName,
    ): UnitEnum {
        try {
            $reflection = new ReflectionEnum($enumName);
        } catch (ReflectionException $e) {
            throw new InvalidArgumentException();
        }
        if ($reflection->isBacked()) {
            $enumBackedType = $reflection->getBackingType();
            if (is_a($enumBackedType, ReflectionNamedType::class)) {
                settype($eachParameter[$propertyName], $enumBackedType->getName());
                $value = $eachParameter[$propertyName];
            } else {
                throw new InvalidArgumentException('Impossible enum backed type.');
            }
        } else {
            throw new InvalidArgumentException('Invalid target enum type. Cannot set no backed enum.');
        }
        foreach ($reflection->getCases() as $case) {
            if (is_a($case, ReflectionEnumBackedCase::class)) {
                if ($case->getBackingValue() === $value) {
                    return $case->getValue();
                }
            }
        }
        throw new InvalidArgumentException('Invalid enum backed value. enumName: ' . $enumName . 'value: ' . $value);
    }
}