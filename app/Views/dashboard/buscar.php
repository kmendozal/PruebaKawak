<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Buscar por Código</title>
    <style>
        body {
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
        }

        .contenido {
            background-color: white;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            width: 300px;
        }

        label {
            margin-bottom: 5px;
        }

        input[type="text"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        th, td {
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
    </style>
</head>

<body>
    <div class="contenido">
        <h2>Buscar Documento por Código</h2>
        <form action="/document_crud/public/dashboard/buscarAction" method="POST">
            <label for="codigo">Ingrese el DOC_CODIGO:</label>
            <input type="text" name="codigo" id="codigo" required>
            <button type="submit">Buscar</button>
        </form>
    </div>

    <?php if (!empty($data) && is_array($data)): ?>
    <table>
        <thead>
            <tr>
                <th>DOC_ID</th>
                <th>DOC_NOMBRE</th>
                <th>DOC_CODIGO</th>
                <th>DOC_CONTENIDO</th>
                <th>DOC_ID_TIPO</th>
                <th>DOC_ID_PROCESO</th>
            </tr>
        </thead>
        <tbody>
       
                <tr>
                    <td><?= $data["DOC_ID"] ?></td>
                    <td><?= $data["DOC_NOMBRE"] ?></td>
                    <td><?= $data["DOC_CODIGO"] ?></td>
                    <td><?= $data["DOC_CONTENIDO"] ?></td>
                    <td><?= $data["PRO_NOMBRE"] ?></td>
                    <td><?= $data["TIP_NOMBRE"] ?></td>
                </tr>

        </tbody>
    </table>
<?php endif; ?>

</body>

</html>
