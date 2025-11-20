<?php
setcookie("visitas", "1", time()+3600);
if(isset($_COOKIE["visitas"])){
    $visitas = $_COOKIE["visitas"];
    $visitas++;
    setcookie("visitas", $visitas, time()+3600);
    echo "Visitas: " . $visitas;
}
?>
