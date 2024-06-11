<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['name']);
    $color = htmlspecialchars($_POST['color']);
    $consumo = htmlspecialchars($_POST['energy']);
    $peso = htmlspecialchars($_POST['weight']);

    function agregarProducto($nombre, $color, $consumo, $peso) {
        $precio = calcularPrecio($consumo, $peso);
        $descuento = calcularDescuento($precio, $color);

        // Return product data as an array
        return array(
            'Nombre' => $nombre,
            'Color' => $color,
            'Consumo' => $consumo,
            'Peso' => $peso,
            'Precio' => $precio,
            'Descuento' => $descuento,
        );
    }

    // Function to calculate price based on consumption and weight
    function calcularPrecio($consumo, $peso) {
        $vConsumo = 0;
        $vPeso = 0;

        if ($consumo == "A") {
            $vConsumo = 100;
        } elseif ($consumo == "B") {
            $vConsumo = 80;
        } elseif ($consumo == "C") {
            $vConsumo = 60;
        }

        if ($peso >= 0 && $peso <= 19) {
            $vPeso = 10;
        } elseif ($peso >= 20 && $peso <= 49) {
            $vPeso = 50;
        }

        return $vConsumo * $vPeso;
    }

    // Function to calculate discount based on color
    function calcularDescuento($precio, $color) {
        $descuento = 0.0;
        if ($color == "Blanco") {
            $descuento = $precio * 0.05;
        } elseif ($color == "Gris") {
            $descuento = $precio * 0.07;
        } elseif ($color == "Negro") {
            $descuento = $precio * 0.10;
        }
        return $descuento;
    }

    // Add product to the global variable $producto
    $producto = agregarProducto($nombre, $color, $consumo, $peso);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calcular Precio de Electrodoméstico</title>
    <link href="./css/tailwind.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-pink-400 via-pink-500 to-red-500 flex items-center justify-center min-h-screen">
    <div class="from-pink-400 via-pink-500 to-red-500 rounded-lg shadow-md p-8 flex flex-wrap">
        <div class="w-full md:w-1/2 p-4">
            <h2 class="text-4xl mb-6 text-center text-gray-800 font-bold">Calcular Precio de Electrodoméstico</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="space-y-4"  onsubmit="return validateForm()">
                <div>
                    <label for="name" class="block text-gray-700">Nombre del Electrodoméstico</label>
                    <input type="text" id="name" name="name" class="mt-1 p-2 w-full border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent" required>
                </div>
                <div>
                    <label for="color" class="block text-gray-700">Color (GRIS, BLANCO, NEGRO)</label>
                    <select id="color" name="color" class="mt-1 p-2 w-full border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent" required>
                        <option value="Blanco">Blanco</option>
                        <option value="Gris">Gris</option>
                        <option value="Negro">Negro</option>
                    </select>
                </div>
                <div>
                    <label for="energy" class="block text-gray-700">Consumo Energético (A, B, C)</label>
                    <select id="energy" name="energy" class="mt-1 p-2 w-full border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent" required>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                    </select>
                </div>
                <div>
                    <label for="weight" class="block text-gray-700">Peso (kg)</label>
                    <input type="text" id="weight" name="weight" class="mt-1 p-2 w-full border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent" required>
                </div>
                <button type="submit" class="w-full bg-pink-500 text-white p-2 rounded-lg hover:bg-pink-600 transition duration-300">Ingresar</button>
            </form>
        </div>
        
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
        <div class="w-full md:w-1/2 p-4">
            <?php mostrarInformacionGeneral($producto); ?>
        </div>
        <?php } ?>
        
    </div>
</body>
</html>

<?php
// Function to display product information
function mostrarInformacionGeneral($producto) {
    echo '<div class="mt-8">';
    echo '<h3 class="text-2xl mb-4 text-center text-gray-800 font-bold">Información del Producto</h3>';
    echo '<table class="min-w-full bg-white rounded-lg overflow-hidden">';
    echo '<thead>';
    echo '<tr class="bg-gray-200 text-gray-700">';
    echo '<th class="py-2 px-4">Característica</th>';
    echo '<th class="py-2 px-4">Valor</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    foreach ($producto as $caracteristica => $valor) {
        echo '<tr>';
        echo '<td class="py-2 px-4">' . $caracteristica . '</td>';
        echo '<td class="py-2 px-4">' . $valor . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
}
?>
        <div class="w-full md:w-1/2 p-4">
            <div class="mt-8">
                <h3 class="text-2xl mb-4 text-center text-gray-800 font-bold">Tabla de Consumo Energético</h3>
                <table class="min-w-full bg-white rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="py-2 px-4">Letra</th>
                            <th class="py-2 px-4">Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4">A</td>
                            <td class="py-2 px-4">$100</td>
                        </tr>
                        <tr class="bg-gray-100">
                            <td class="py-2 px-4">B</td>
                            <td class="py-2 px-4">$80</td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4">C</td>
                            <td class="py-2 px-4">$60</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-8">
                <h3 class="text-2xl mb-4 text-center text-gray-800 font-bold">Tabla de Peso</h3>
                <table class="min-w-full bg-white rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="py-2 px-4">Tamaño</th>
                            <th class="py-2 px-4">Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4">Entre 0 y 19 kg</td>
                            <td class="py-2 px-4">$10</td>
                        </tr>
                        <tr class="bg-gray-100">
                            <td class="py-2 px-4">Entre 20 y 49 kg</td>
                            <td class="py-2 px-4">$50</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-8">
                <h3 class="text-2xl mb-4 text-center text-gray-800 font-bold">Tabla de Colores</h3>
                <table class="min-w-full bg-white rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="py-2 px-4">Color</th>
                            <th class="py-2 px-4">Porcentaje de Descuento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4">Blanco</td>
                            <td class="py-2 px-4">5%</td>
                        </tr>
                        <tr class="bg-gray-100">
                            <td class="py-2 px-4">Gris</td>
                            <td class="py-2 px-4">7%</td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4">Negro</td>
                            <td class="py-2 px-4">10%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</body>
<script src="scripts.js"></script>
</html>

