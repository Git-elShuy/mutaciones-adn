<?php
namespace App\Services;


class MutationService
{
    public function hasMutation(array $adn): bool
    {
        $n = count($adn); // filas
        $valido = ['A', 'T', 'C', 'G']; // caracteres válidos
        $contador = 0;

        // Validación inicial
        foreach ($adn as $row) { // recorremos cada fila de la matriz
            if (strlen($row) !== $n) { // verificar matriz cuadrada NxN
                return false;
            }
            if (strspn($row, implode('', $valido)) !== $n) { // validar caracteres
                return false;
            }
        }

        // Convertir a matriz bidimensional
        $matriz = array_map('str_split', $adn);

        // Función para verificar dirección
        $verificar_direccion = function($x, $y, $dx, $dy) use ($matriz, $n) {
            $base = $matriz[$x][$y];
            for ($i = 1; $i < 4; $i++) {
                $nx = $x + $dx * $i;
                $ny = $y + $dy * $i;
                if (
                    $nx < 0 || $ny < 0 || 
                    $nx >= $n || $ny >= $n || 
                    $matriz[$nx][$ny] !== $base
                ) {
                    return false;
                }
            }
            return true;
        };

        // Recorrer la matriz
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                if ($j <= $n - 4 && $verificar_direccion($i, $j, 0, 1)) $contador++; // horizontal
                if ($i <= $n - 4 && $verificar_direccion($i, $j, 1, 0)) $contador++; // vertical
                if ($i <= $n - 4 && $j <= $n - 4 && $verificar_direccion($i, $j, 1, 1)) $contador++; // diagonal ↘
                if ($i <= $n - 4 && $j >= 3 && $verificar_direccion($i, $j, 1, -1)) $contador++; // diagonal ↙

                if ($contador > 1) {
                    return true; // el contador se incremento entonces hubo match con algun if de arriba
                }
            }
        }

        return false; // no hay mutación
    }
}
