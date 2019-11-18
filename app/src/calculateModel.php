<?php

function doCalculation($validated_value_1, $validated_value_2, $validated_calculation_type)
{
  $calculation_result = null;

  $value_1 = $validated_value_1;
  $value_2 = $validated_value_2;
  $calculation_type = $validated_calculation_type;

  switch ($calculation_type) {
    case 'addition':
      $calculation_result = $value_1 + $value_2;
      break;
    case 'subtraction':
      $calculation_result = $value_1 - $value_2;
      break;
    case 'multiplication':
      $calculation_result = $value_1 * $value_2;
      break;
    case 'division':
      $calculation_result = $value_1 / $value_2;
      break;
  }
  return $calculation_result;
}
