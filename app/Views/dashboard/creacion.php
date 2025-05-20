<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Crear Documento</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 40px;
      background-color: #f4f4f4;
    }

    form {
      background: white;
      padding: 20px;
      max-width: 500px;
      margin: auto;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }

    input[type="text"],
    textarea,
    select {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    button {
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #3498db;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background-color: #2980b9;
    }
  </style>
</head>
<body>

<form action="/document_crud/public/dashboard/creacionAction" method="POST">
    <h2>Crear Documento</h2>

    <label for="doc_nombre">Nombre del Documento</label>
    <input type="text" id="doc_nombre" name="DOC_NOMBRE" required>

    <label for="doc_contenido">Contenido</label>
    <textarea id="doc_contenido" name="DOC_CONTENIDO" rows="5" required></textarea>

   
    <label for="doc_id_tipo">Tipo de Documento</label>
      <select id="doc_id_tipo" name="DOC_ID_TIPO">
        <?php foreach ($arrayData['tipos'] as $tipo): ?>
            <option value="<?= $tipo['TIP_ID'] ?>"><?= htmlspecialchars($tipo['TIP_NOMBRE']) ?></option>
        <?php endforeach; ?>
      </select>

    <label for="doc_id_proceso">Proceso</label>
      <select id="doc_id_proceso" name="DOC_ID_PROCESO">
        <?php foreach ($arrayData['procesos'] as $proceso): ?>
            <option value="<?= $proceso['PRO_ID'] ?>"><?= htmlspecialchars($proceso['PRO_NOMBRE']) ?></option>
        <?php endforeach; ?>
      </select>


    <button type="submit">Guardar Documento</button>
  </form>

</body>
</html>
