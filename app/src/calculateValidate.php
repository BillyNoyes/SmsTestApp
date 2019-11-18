<?php

/** sanitise and validate the entered number
 */

function validateInteger($value_to_check)
{
  $checked_value = false;
  $options = array(
    'options' => array(
      'default' => -1, // value to return if the filter fails
      'min_range' => 0
    )
  );
  if (isset($value_to_check)) {
    $checked_value = filter_var($value_to_check, FILTER_VALIDATE_INT, $options);
  }

  return $checked_value;
}

function validateCalculationType($type_to_check)
{
  $checked_calculation_type = false;
  $calculation_type = array('addition', 'subtraction', 'multiplication', 'division');
  if (in_array($type_to_check, $calculation_type)) {
    $checked_calculation_type = $type_to_check;
  }

  return $checked_calculation_type;
}
