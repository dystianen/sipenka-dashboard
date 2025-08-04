<?php
function getComparisonLabel($value)
{
  $labels = [
    1 => 'Sama penting',
    2 => 'Antara 1 dan 3',
    3 => 'Sedikit lebih penting',
    4 => 'Antara 3 dan 5',
    5 => 'Lebih penting',
    6 => 'Antara 5 dan 7',
    7 => 'Sangat penting',
    8 => 'Antara 7 dan 9',
    9 => 'Mutlak lebih penting'
  ];

  return $labels[$value] ?? $value;
}
