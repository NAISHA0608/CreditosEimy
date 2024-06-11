<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calcular Precio de Electrodoméstico</title>
    <link href="./css/tailwind.css" rel="stylesheet">
</head>
<body class="bg-pink-300 flex items-center justify-center min-h-screen">
    <div class="bg-whiterounded-lg shadow-md ">
        <h2 class="text-4xl mb-6 text-center">Calcular Precio de Electrodoméstico</h2>
        <form action="index.php" method="post" onsubmit="return validateForm()">
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Nombre del Electrodoméstico</label>
                <input type="text" id="name" name="name" class="mt-1 p-2 w-full border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="color" class="block text-gray-700">Color (GRIS, BLANCO, NEGRO)</label>
                <select id="color" name="color" class="mt-1 p-2 w-full border rounded-lg" required>
                    <option value="Blanco">Blanco</option>
                    <option value="Gris">Gris</option>
                    <option value="Negro">Negro</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="energy" class="block text-gray-700">Consumo Energético (A, B, C)</label>
                <select id="energy" name="energy" class="mt-1 p-2 w-full border rounded-lg" required>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="weight" class="block text-gray-700">Peso (kg)</label>
                <input type="text" id="weight" name="weight" class="mt-1 p-2 w-full border rounded-lg" required>
            </div>
            <button type="submit" class="w-full bg-red-500 text-white p-2 rounded-lg">Calcular</button>
        </form>
        <div class="mt-8">
        <div class="mt-8">
            <h3 class="text-xl mb-4 text-center">Tabla de Consumo Energético</h3>
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 bg-blue-500 font-semibold text-gray-700">Letra</th>
                        <th class="py-2 px-4 bg-blue-500 font-semibold text-gray-700">Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t">
                        <td class="py-2 px-4 border-r">A</td>
                        <td class="py-2 px-4">100$</td>
                    </tr>
                    <tr class="border-t">
                        <td class="py-2 px-4 border-r">B</td>
                        <td class="py-2 px-4">80$</td>
                    </tr>
                    <tr class="border-t">
                        <td class="py-2 px-4 border-r">C</td>
                        <td class="py-2 px-4">60$</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br></br>
        <div class="mt-8">
            <h3 class="text-xl mb-4 text-center">Tabla de Peso</h3>
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 bg-blue-500 font-semibold text-gray-700">Tamaño</th>
                        <th class="py-2 px-4 bg-blue-500 font-semibold text-gray-700">Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t">
                        <td class="py-2 px-4 border-r">Entre 0 y 19 kg</td>
                        <td class="py-2 px-4">10$</td>
                    </tr>
                    <tr class="border-t">
                        <td class="py-2 px-4 border-r">Entre 20 y 49 kg</td>
                        <td class="py-2 px-4">50$</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br></br>
        <div class="mt-8">
            <h3 class="text-xl mb-4 text-center">Tabla de Colores</h3>
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 bg-blue-500 font-semibold text-gray-700">Color</th>
                        <th class="py-2 px-4 bg-blue-500 font-semibold text-gray-700">Porcentaje de Descuento</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t">
                        <td class="py-2 px-4 border-r">Blanco</td>
                        <td class="py-2 px-4">5%</td>
                    </tr>
                    <tr class="border-t">
                        <td class="py-2 px-4 border-r">Gris</td>
                        <td class="py-2 px-4">7%</td>
                    </tr>
                    <tr class="border-t">
                        <td class="py-2 px-4 border-r">Negro</td>
                        <td class="py-2 px-4">10%</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br></br>
        <?php
        function agregarProducto($nombre, $color, $consumo, $peso){
            $precio = calcularPrecio($consumo, $peso);
            $descuento = calcularDescuento($precio, $color);

            $GLOBALS['producto'] = array(
                'Nombre' => $nombre,
                'Color' => $color,
                'Consumo' => $consumo,
                'Peso' => $peso,
                'Precio' => $precio,
                'Descuento' => $descuento,
            );
        }

        function calcularPrecio($consumo, $peso) {
            $vConsumo = 0;
            $vPeso = 0;

            // Asignar el valor del consumo de acuerdo a la tabla
            if ($consumo == "A") {
                $vConsumo = 100;
            } elseif ($consumo == "B") {
                $vConsumo = 80;
            } elseif ($consumo == "C") {
                $vConsumo = 60;
            }

            // Asignar el valor del peso de acuerdo a la tabla
            if ($peso >= 0 && $peso <= 19) {
                $vPeso = 10;
            } elseif ($peso >= 20 && $peso <= 49) {
                $vPeso = 50;
            }
            return $vConsumo * $vPeso;
        }

        function calcularDescuento($precio, $color) {
            $descuento = 0.0;
            if ($color == "blanco") {
                $descuento = $precio * 0.05;
            } elseif ($color == "gris") {
                $descuento = $precio * 0.07;
            } elseif ($color == "negro") {
                $descuento = $precio * 0.10;
            }
            return $descuento;
        }

        function mostrarInformacionGeneral($producto) {
            echo '<table class="min-w-full bg-white">';
            echo '<thead>';
            echo '<tr>';
            echo '<th class="py-2 px-4 bg-blue-500 font-semibold text-gray-700">Característica</th>';
            echo '<th class="py-2 px-4 bg-blue-500 font-semibold text-gray-700">Valor</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            foreach ($producto as $caracteristica => $valor) {
                echo '<tr class="border-t">';
                echo '<td class="py-2 px-4 border-r">' . $caracteristica . '</td>';
                echo '<td class="py-2 px-4">' . $valor . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        }

        agregarProducto("Televisor", "gris", "B", 50);
        mostrarInformacionGeneral($GLOBALS['producto']);
        ?>
    </div>
</body>
<script src="scripts.js"></script>
</html>
