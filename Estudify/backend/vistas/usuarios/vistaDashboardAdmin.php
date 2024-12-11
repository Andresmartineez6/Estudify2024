<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <?php include "../vistaHeaderUsuario.php"; ?>
    <div class="container mx-auto my-8">
        <h2 class="text-3xl font-bold mb-6">Gestión de Usuarios</h2>
        <table class="table-auto w-full bg-white shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                <tr class="border-b">
                    <td class="px-4 py-2"><?php echo $usuario['id_usuario']; ?></td>
                    <td class="px-4 py-2"><?php echo $usuario['nombre']; ?></td>
                    <td class="px-4 py-2"><?php echo $usuario['email']; ?></td>
                    <td class="px-4 py-2">
                        <form method="POST" class="inline">
                            <input type="hidden" name="id_usuario" value="<?php echo $usuario['id_usuario']; ?>">
                            <input type="hidden" name="accion" value="eliminar">
                            <button class="bg-red-500 text-white px-4 py-2 rounded">Eliminar</button>
                        </form>
                        <button onclick="editarUsuario(<?php echo $usuario['id_usuario']; ?>, '<?php echo $usuario['nombre']; ?>', '<?php echo $usuario['email']; ?>')" class="bg-blue-500 text-white px-4 py-2 rounded">Modificar</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <form method="POST" class="mt-8 bg-white p-6 rounded shadow-md">
            <h3 class="text-2xl font-bold mb-4">Añadir Usuario</h3>
            <input type="hidden" name="accion" value="añadir">
            <div class="mb-4">
                <label class="block text-gray-700">Nombre:</label>
                <input type="text" name="nombre" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Email:</label>
                <input type="email" name="email" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Contraseña:</label>
                <input type="password" name="contraseña" class="w-full px-4 py-2 border rounded" required>
            </div>
            <button class="bg-green-500 text-white px-4 py-2 rounded">Añadir</button>
        </form>
    </div>
    <script>
        function editarUsuario(id, nombre, email) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.innerHTML = `
                <input type="hidden" name="id_usuario" value="${id}">
                <input type="hidden" name="accion" value="modificar">
                <label>Nombre: <input type="text" name="nombre" value="${nombre}" required></label>
                <label>Email: <input type="email" name="email" value="${email}" required></label>
                <button type="submit">Guardar</button>
            `;
            document.body.appendChild(form);
            form.submit();
        }
    </script>
</body>
</html>
