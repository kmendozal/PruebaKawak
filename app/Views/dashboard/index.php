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
            width: 100%;
        }

        .acciones {
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
        }

        table {
            border-collapse: collapse;
            width: 80%;
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

        .btn {
            padding: 8px 16px;
            border-radius: 5px;
            font-size: 14px;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-editar {
            background-color: #3498db;
        }

        .btn-editar:hover {
            background-color: #2980b9;
        }

        .btn-eliminar {
            background-color: #e74c3c;
        }

        .btn-eliminar:hover {
            background-color: #c0392b;
        }

        .btn-crear {
            background-color: #2ecc71;
        }

        .btn-crear:hover {
            background-color: #27ae60;
        }

        .btn-buscar {
            background-color: #9b59b6;
        }

        .btn-buscar:hover {
            background-color: #8e44ad;
        }
    </style>
</head>

<body>
    <div class="contenido">
        <h1>DASHBOARD </h1>
        <div class="acciones">
            <form action="/document_crud/public/dashboard/creacion" method="GET">
                <button type="submit" class="btn btn-crear">Crear nuevo documento</button>
            </form>

            <form action="/document_crud/public/dashboard/buscar" method="GET">
                <button type="submit" class="btn btn-buscar">Buscar un documento</button>
            </form>
        </div>

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
                            <div style="display: flex; gap: 10px;">
                                <form action="/document_crud/public/dashboard/editar/?id=<?= $campos["DOC_ID"] ?>" method="POST">
                                    <button type="submit" class="btn btn-editar">Editar</button>
                                </form>

                                <form action="/document_crud/public/dashboard/eliminar/?id=<?= $campos["DOC_ID"] ?>" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar este documento?');">
                                    <button type="submit" class="btn btn-eliminar">Eliminar</button>
                                </form>
                            </div>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</body>

</html>