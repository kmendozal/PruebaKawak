<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Documento</title>
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
      background-color: #27ae60;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background-color: #219150;
    }
  </style>
</head>
<body>

  <form action="/document_crud/public/dashboard/editarAction" method="POST">
    <h2>Editar Documento</h2>

    <!-- Campo oculto para el ID -->
    <input type="hidden" name="DOC_ID" value="<?= $data['documento']['DOC_ID'] ?? '' ?>">

    <label for="doc_nombre">Nombre del Documento</label>
    <input type="text" id="doc_nombre" name="DOC_NOMBRE" value="<?= $data['documento']['DOC_NOMBRE'] ?? '' ?>" required>

    <label for="doc_codigo">Código</label>
    <input type="text" id="doc_codigo" name="DOC_CODIGO" value="<?= $data['documento']['DOC_CODIGO'] ?? '' ?>" readonly required>

    <label for="doc_contenido">Contenido</label>
    <textarea id="doc_contenido" name="DOC_CONTENIDO" rows="5" required><?= $data['documento']['DOC_CONTENIDO'] ?? '' ?></textarea>

      <label for="doc_id_tipo">Tipo de Documento</label>
      <select id="doc_id_tipo" name="DOC_ID_TIPO">
        <?php foreach ($data['tipos'] as $tipo): ?>
            <option value="<?= $tipo['TIP_ID'] ?>" <?= (isset($data['documento']['DOC_ID_TIPO']) && $data['documento']['DOC_ID_TIPO'] == $tipo['TIP_ID']) ? 'selected' : '' ?>><?= htmlspecialchars($tipo['TIP_NOMBRE']) ?></option>
        <?php endforeach; ?>
      </select>

    <label for="doc_id_proceso">Proceso</label>
      <select id="doc_id_proceso" name="DOC_ID_PROCESO">
        <?php foreach ($data['procesos'] as $proceso): ?>
            <option value="<?= $proceso['PRO_ID'] ?>" <?= (isset($data['documento']['DOC_ID_PROCESO']) && $data['documento']['DOC_ID_PROCESO'] == $proceso['PRO_ID']) ? 'selected' : '' ?>><?= htmlspecialchars($proceso['PRO_NOMBRE']) ?></option>
        <?php endforeach; ?>
      </select>





   

    <button type="submit">Actualizar Documento</button>
  </form>

</body>
</html>
