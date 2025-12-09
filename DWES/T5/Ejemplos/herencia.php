<?php
class animal{
    public $nombre;
    public $edad;
    public $sexo;

    function __construct($nombre, $edad, $sexo){
        $this->nombre = $nombre;
        $this->edad = $edad;
        $this->sexo = $sexo;
    }

    public function comer(){
        echo "El animal come.";
    }

    public function dormir(){
        echo "El animal duerme.";
    }

    public function hacerRuido(){
        echo "El animal hace ruido.";
    }
}

class perro extends animal{ //extends es la palabra clave para la herencia
    public $raza; //Se añade un atributo

    function __construct($nombre, $edad, $sexo, $raza){ // En el constructor se llama a las propiedades de la clase padre y de perro
        parent::__construct($nombre, $edad, $sexo); // parent es la palabra clave para llamar al constructor de la clase padre
        $this->raza = $raza;
    }

    public function comer(){ //Se sobreescribe el metodo comer para que sea diferente al de la clase padre
        echo "El perro come.";
    }

    public function dormir(){ //Se sobreescribe el metodo dormir para que sea diferente al de la clase padre
        echo "El perro duerme.";
    }

    public function hacerRuido(){ //Se sobreescribe el metodo hacerRuido para que sea diferente al de la clase padre
        echo "El perro ladra.";
    }
}

class pajaro extends animal{ //extends es la palabra clave para la herencia
    public $color;

    function __construct($nombre, $edad, $sexo, $color){ // En el constructor se llama a las propiedades de la clase padre y de pajaro
        parent::__construct($nombre, $edad, $sexo);
        $this->color = $color;
    }

    public function comer(){ //Se sobreescribe el metodo comer para que sea diferente al de la clase padre o hermana
        echo "El pajaro come.";
    }

    public function dormir(){ //Se sobreescribe el metodo dormir para que sea diferente al de la clase padre o hermana
        echo "El pajaro duerme.";
    }

    public function hacerRuido(){ //Se sobreescribe el metodo hacerRuido para que sea diferente al de la clase padre o hermana
        echo "El pajaro canta.";
    }
}