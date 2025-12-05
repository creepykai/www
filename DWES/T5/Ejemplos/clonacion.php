<?php
class A
{
    public $valor1;
    public $valor2;
    public function __toString()
    {
        $cad = "($this->valor1, $this->valor2)";
        return $cad;
    }
}
$a = new A();
$a->valor1 = 1;
$a->valor2 = 2;
echo $a;
$b = clone $a;
echo $b;
$b->valor1 = 5;
echo $a;
echo $b;
?>