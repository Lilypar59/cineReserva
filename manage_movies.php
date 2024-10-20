<?php
// Incluir la conexión a la base de datos
include 'conn.php';

// Obtener lista de películas
$movies = [];
$sql = "SELECT * FROM movies";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $movies[] = $row;
    }
}

// Agregar nueva película
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_movie'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];

    $sql = "INSERT INTO movies (title, description, duration) VALUES ('$title', '$description', $duration)";
    if ($conn->query($sql) === TRUE) {
        echo "Nueva película agregada.";
    } else {
        echo "Error al agregar: " . $conn->error;
    }

    // Recargar la página para mostrar la nueva película
    header('Location: manage_movies.php');
}

// Eliminar película
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $sql = "DELETE FROM movies WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Película eliminada.";
    } else {
        echo "Error al eliminar: " . $conn->error;
    }

    // Recargar la página para mostrar la lista actualizada
    header('Location: manage_movies.php');
}

// Editar película
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_movie'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];

    $sql = "UPDATE movies SET title = '$title', description = '$description', duration = $duration WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Película actualizada.";
    } else {
        echo "Error al actualizar: " . $conn->error;
    }

    header('Location: manage_movies.php');
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestionar Películas</title>
    <link
        href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
        rel="stylesheet" />
</head>

<body class="bg-gray-100">

    <nav class="bg-blue-600 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="admindashboard.php" class="text-white text-2xl font-bold">CineReserva Admin</a>
            <a href="index.php" class="text-white">Cerrar Sesión</a>
        </div>
    </nav>


    <!-- Formulario para agregar nueva película -->


    <hr>
    <!-- formulario -->
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Gestionar Películas</h1>



        <form method="POST" action="" class="mb-8 bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4">Agregar Nueva Película</h2>

            <input type="hidden" name="action" value="add" />
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" name="title" placeholder="Título" required class="w-full px-3 py-2 border rounded-md">
                <input type="text" name="description" placeholder="Descripción" required class="w-full px-3 py-2 border rounded-md">
                <input type="number" name="duration" placeholder="Duración (minutos)" required class="w-full px-3 py-2 border rounded-md">
                <input
                    type="text"
                    name="image_url"
                    placeholder="URL de la imagen"
                    required
                    class="w-full px-3 py-2 border rounded-md" />
            </div>
            <button type="submit" name="add_movie" class="mt-4 bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Agregar Película</button>
        </form>















        <!-- Lista de películas -->

        <div class="bg-white rounded-lg shadow-md overflow-hidden">

            <h2 class="text-xl font-semibold mb-2">Películas existentes</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">


                <?php foreach ($movies as $movie): ?>

                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="w-full h-64 flex items-center justify-center bg-gray-200" style="width: 300px; height: 300px;">

                        </div>
                        <div class="p-4">
                            <h2 class="text-xl font-semibold mb-2"><?php echo htmlspecialchars($movie['title']); ?></h2>
                            <p class="text-gray-600 mb-4 line-clamp-3"><?php echo htmlspecialchars($movie['description']); ?></p>


                            <a class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300"
                                href="manage_movies.php?delete_id=<?php echo $movie['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar esta película?');">Eliminar</a>
                            <!-- Botón para editar (abre un formulario para editar) -->
                            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300"
                                onclick="document.getElementById('edit-form-<?php echo $movie['id']; ?>').style.display='block'">Editar</button>

                            <!-- Formulario de edición oculto inicialmente -->
                            <form id="edit-form-<?php echo $movie['id']; ?>" method="POST" action="" style="display:none;">

                                <input class="w-full px-3 py-2 border rounded-md" type="hidden" name="id" value="<?php echo $movie['id']; ?>">
                                <input class="w-full px-3 py-2 border rounded-md" type="text" name="title" value="<?php echo $movie['title']; ?>" required>
                                <input class="w-full px-3 py-2 border rounded-md" type="text" name="description" value="<?php echo $movie['description']; ?>" required>
                                <input class="w-full px-3 py-2 border rounded-md" type="number" name="duration" value="<?php echo $movie['duration']; ?>" required>
                                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300" type="submit" name="edit_movie">Guardar Cambios</button>
                            </form>
                        </div>
                    </div>





                <?php endforeach; ?>

            </div>
        </div>
    </div>


</body>

</html>

<?php $conn->close(); ?>