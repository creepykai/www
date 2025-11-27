# Guía de Funciones de Ordenamiento en PHP

Para entender este "zoológico" de funciones de ordenamiento en PHP, lo mejor es dividirlas según qué miran (si ordenan por la clave o por el valor) y qué hacen con las llaves (si las mantienen o las destruyen).

Vamos a usar un Diccionario de Productos donde la Clave es el nombre del producto y el Valor es su precio.

```php
// ESTADO INICIAL DEL DICCIONARIO
$productos = [
    "Zapatos" => 50,
    "Camisa"  => 20,
    "Abrigo"  => 100
];
```

Aquí tienes la explicación dividida por grupos lógicos.

## 1. Ordenando por VALOR (El Precio)

Aquí PHP mirará los números (50, 20, 100) para decidir el orden.

### A. Manteniendo la asociación (asort, arsort)

Estas son las más seguras para diccionarios. La **a** significa **Associative**. El producto no pierde su precio.

*   `asort($arr)` (Ascendente): Del más barato al más caro.
*   `arsort($arr)` (Descendente - Reverse): Del más caro al más barato.

```php
// Ejemplo arsort (Precio descendente)
arsort($productos);

/* Resultado:
[
    "Abrigo"  => 100,
    "Zapatos" => 50,
    "Camisa"  => 20
]
¡Perfecto! "Abrigo" sigue valiendo 100.
*/
```

### B. Destruyendo las claves (sort, rsort)

⚠️ **Peligro**: Estas funciones reindexan el array numéricamente (0, 1, 2...). Son útiles para listas simples, pero destructivas para diccionarios asociativos.

*   `sort($arr)`: Ascendente (elimina claves).
*   `rsort($arr)`: Descendente (elimina claves).

```php
// Ejemplo sort (Precio ascendente, pero perdemos los nombres)
sort($productos);

/* Resultado:
[
    0 => 20,   // ¿Qué producto era este? No lo sabemos, se perdió "Camisa".
    1 => 50,
    2 => 100
]
*/
```

## 2. Ordenando por CLAVE (El Nombre)

Aquí PHP ignorará los precios y ordenará alfabéticamente por la llave ("Zapatos", "Camisa", "Abrigo"). La **k** significa **Key**.

*   `ksort($arr)`: Claves Ascendentes (A-Z).
*   `krsort($arr)`: Claves Descendentes (Z-A).

```php
// Ejemplo ksort (Alfabéticamente A-Z)
ksort($productos);

/* Resultado:
[
    "Abrigo"  => 100, // A
    "Camisa"  => 20,  // C
    "Zapatos" => 50   // Z
]
*/
```

## 3. Ordenamiento PERSONALIZADO (u)

Aquí es donde usas la **u** (**User defined**). Tú defines la lógica compleja usando una función anónima. Es útil si quieres ordenar por algo raro (ej: longitud de la palabra, o reglas de negocio complejas).

Todas usan el operador nave espacial `<=>` (PHP 7+) para simplificar.

### A. Por Valor (usort, uasort)

*   `usort($arr, fn)`: Ordena por valor, pero destruye las claves (igual que sort).
*   `uasort($arr, fn)`: Ordena por valor y mantiene las claves (igual que asort). <-- **La más usada en diccionarios complejos.**

```php
// Ejemplo uasort: Ordenar por precio, pero si es par o impar (Lógica extraña de ejemplo)
uasort($productos, function($a, $b) {
    // $a y $b son los PRECIOS
    return $a <=> $b; // Esto es igual a un asort normal, pero manual.
});
```

### B. Por Clave (uksort)

*   `uksort($arr, fn)`: Ordena según tu lógica aplicada a las claves (nombres).

```php
// Ejemplo uksort: Ordenar por la LONGITUD del nombre del producto
uksort($productos, function($a, $b) {
    // $a y $b son los NOMBRES ("Zapatos", "Camisa")
    return strlen($a) <=> strlen($b);
});

/* Resultado (Ordenado por cantidad de letras):
[
    "Camisa"  => 20,  (6 letras)
    "Abrigo"  => 100, (6 letras)
    "Zapatos" => 50   (7 letras)
]
*/
```

## Tabla Resumen Definitiva

Para no perderte, usa esta regla mnemotécnica con las letras de la función:

| Letra en la función | Significado | Efecto |
| :--- | :--- | :--- |
| (nada) | Estándar | Ordena por Valor, Borra las claves. |
| **a** | Associative | Ordena por Valor, Mantiene las claves. |
| **k** | Key | Ordena por Clave, Mantiene las claves. |
| **r** | Reverse | Orden Inverso (Descendente). |
| **u** | User | Lógica propia (Callback). |

### Ejemplo combinado:

*   **k** (Clave) + **r** (Reverse) + **sort** = `krsort` (Ordena por clave, al revés).
*   **u** (Usuario) + **a** (Asociativo) + **sort** = `uasort` (Ordena por valor con tu lógica, mantiene claves).