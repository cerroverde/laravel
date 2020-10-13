<?php
/**
 * README
 * En este caso, el calculo de los elementos de Fibonacci lo realice a diferencia
 * que en el caso de JAVASCRIPT, sumando las variables desde 0 teniendo como limite
 * los rangos del timestamp del mes actual o del año en curso. De lo contrario
 * daria cero (0) ya que no hay elementos Fibonacci dentro de esos rangos.
 */
 class fiboNumbers
 {
   function __construct() {

   }

   function calculate($Ftime,$Ltime) {
     // echoing variables
     echo "First timestamp: $Ftime \n";
     echo "Last Timestamp: $Ltime \n";

     // Initialize first
     // three Fibonacci Numbers
     $f1 = 0; $f2 = 1; $f3 = 1;

     // Count fibonacci
     // numbers in given range
     $result = 0;

     while ($f3 <= $Ltime) {
        if ($f3 >= $Ftime)
          $result++;
       		$f1 = $f2;
       		$f2 = $f3;
          echo $f3 . "\n";

          // Next question
       		$f3 = $f1 + $f2;
     }

     echo $result;
   }

 }

class fibonacci extends fiboNumbers
{

  function __construct()
  {
    date_default_timezone_set('UTC');
    if (date_default_timezone_get()) {
      echo 'date_default_timezone_set: ' . date_default_timezone_get() . "\n";
    }
  }

  function get_month() {
    echo "\n ------- Fibonacci By Month ------- \n";
    $query_date = date("Y-m-d H:i:s");

    // First day of the month.
    $first = date('Y-m-01 00:00:00', strtotime($query_date));
    $Ftime = strtotime($first);

    // Last day of the month.
    $last = date('Y-m-t 00:00:00', strtotime($query_date));
    $Ltime = strtotime($last);

    // Make calculation
    fiboNumbers::calculate($Ftime,$Ltime);
  }

  function get_year() {
    echo "\n ------- Fibonacci By Year ------- \n";
    $query_date = date("Y-m-d H:i:s");

    // First day of the yaer.
    $first = date('Y-01-01 00:00:00', strtotime($query_date));
    $Ftime = strtotime($first);

    // Last day of the year.
    $last = date('Y-12-31 23:59:59', strtotime($query_date));
    $Ltime = strtotime($last);

    fiboNumbers::calculate($Ftime,$Ltime);

  }

  function get_range() {
    echo "\n ------- Fibonacci By Range ------- \n";
    $query_date = date("Y-m-d H:i:s");

    // First date to calculate
    $first = date('1970-01-01 00:00:00', strtotime($query_date));
    $Ftime = strtotime($first);

    // Last date to calculate
    $last = date('2046-12-31 23:59:59', strtotime($query_date));
    $Ltime = strtotime($last);

    fiboNumbers::calculate($Ftime,$Ltime);
  }
}
// Init instance
$a = new fibonacci();

// Get fibonacci by actual month
$a->get_month();

// Get fibonacci by actual year

$a->get_year();

// Get fibonacci by range
// Have to declare dates inside in  the function get_range
$a->get_range();

?>
