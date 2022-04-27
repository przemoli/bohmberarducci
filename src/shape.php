<?php
declare(strict_types=1);

/**
 * @template Shape
 * @psalm-type ShapeType = Closure(Closure(float, float, float): Shape, Closure(float, float, float, float): Shape): Shape
 */


/**
 * @template Shape
 * @param float $x
 * @param float $y
 * @param float $z
 * @return ShapeType
 */
function _Circle(float $x, float $y, float $z): Closure {
    return fn($Circle, $Rectangle) => $Circle($x, $y, $z);
}

/**
 * @template Shape
 * @param float $x
 * @param float $y
 * @param float $w
 * @param float $h
 * @return ShapeType
 */
function _Rectangle(float $x, float $y, float $w, float $h): Closure {
    return fn($Circle, $Rectangle) => $Rectangle($x, $y, $w, $h);
}

/**
 * @template Shape
 * @var ShapeType $exampleCircle
 */
$exampleCircle = _Circle(2.0, 1.4, 4.5);

/**
 * @template Shape
 * @var ShapeType $exampleCircle
 */
$exampleRectangle = _Rectangle(1.3, 3.1, 10.3, 7.7);

/**
 * @template Shape
 * @param ShapeType
 * @return float
 */
function area(Closure $shape): float {
    $circleArea = fn(float $x, float $y, float $z): float => 3.14 * $z ^ 2;
    $rectangleArea = fn(float $x, float $y, float $w, float $h): float => $w * $h;
    return $shape(
        $circleArea,
        $rectangleArea
    );
}

printf("Circle %f \n", area($exampleCircle));
printf("Rectangle's area %f \n", area($exampleRectangle));
