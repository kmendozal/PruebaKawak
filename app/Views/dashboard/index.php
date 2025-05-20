<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Tabla centrada</title>
    <style>
        body {
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .contenido {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        table {
            border-collapse: collapse;
            width: 60%;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        th,
        td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .crear-btn {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="contenido">
        <div class="crear-btn">
            <form action="/document_crud/public/dashboard/creacion" method="GET">
                <button type="submit">Crear nuevo documento</button>
            </form>
        </div>
        <br>

         <div class="buscar-btn">
            <form action="/document_crud/public/dashboard/buscar" method="GET">
                <button type="submit">Buscar un documento</button>
            </form>
        </div>

        <hr>

        <table>
            <thead>
                <tr>
                    <th>DOC_ID</th>
                    <th>DOC_NOMBRE</th>
                    <th>DOC_CODIGO</th>
                    <th>DOC_CONTENIDO</th>
                    <th>DOC_ID_TIPO</th>
                    <th>DOC_ID_PROCESO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($data as $campos): ?>
                    <tr>
                        <td><?= $campos["DOC_ID"] ?></td>
                        <td><?= $campos["DOC_NOMBRE"] ?></td>
                        <td><?= $campos["DOC_CODIGO"] ?></td>
                        <td><?= $campos["DOC_CONTENIDO"] ?></td>
                        <td><?= $campos["PRO_NOMBRE"] ?></td>
                        <td><?= $campos["TIP_NOMBRE"] ?></td>
                        <td>
                            <form action="/document_crud/public/dashboard/editar/?id=<?= $campos["DOC_ID"] ?>" method="POST" style="display:inline;">
                                <button type="submit">Editar</button>
                            </form>
                            <form action="/document_crud/public/dashboard/eliminar/?id=<?= $campos["DOC_ID"] ?>" method="POST" style="display:inline;" onsubmit="return confirm('¿Seguro que quieres eliminar este documento?');">
                                <button type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
