
<!DOCTYPE html>
<html>
<body>

<?php
class Car
{
    var $color;
    function Car() {
      $color="green";
	  return $this->color;
	  //$this->color = $color;
    }
    //function what_color() {
     // return $this->color;
    //}
}

function print_vars($obj) {
   foreach (get_object_vars($obj) as $prop => $val) {
     echo "\t$prop = $val\n";
   }
}

// instantiate one object
$herbie = new Car();

// show herbie properties
echo "\herbie: Properties\n";
print_vars($herbie);

?>  

</body>
</html>