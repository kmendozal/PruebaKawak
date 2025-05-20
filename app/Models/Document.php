<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Document
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function all()
    {
        $stmt = $this->db->query("
           SELECT * FROM DOC_DOCUMENTO D
            INNER JOIN PRO_PROCESO P ON D.DOC_ID_PROCESO = P.PRO_ID
            INNER JOIN TIP_TIPO_DOC T ON D.DOC_ID_TIPO = T.TIP_ID
        ");
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM DOC_DOCUMENTO WHERE DOC_ID = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function findCod($codigo)
    {
        $stmt = $this->db->prepare(" SELECT * FROM DOC_DOCUMENTO D
            INNER JOIN PRO_PROCESO P ON D.DOC_ID_PROCESO = P.PRO_ID
            INNER JOIN TIP_TIPO_DOC T ON D.DOC_ID_TIPO = T.TIP_ID WHERE D.DOC_CODIGO = ? ");
        $stmt->execute([$codigo]);
        return $stmt->fetch();
    }

    public function getTipos()
    {
        return $this->db->query("SELECT * FROM TIP_TIPO_DOC ORDER BY TIP_NOMBRE ")->fetchAll();
    }

    public function getProcesos()
    {
        return $this->db->query("SELECT * FROM PRO_PROCESO ORDER BY PRO_NOMBRE")->fetchAll();
    }

    public function create($data)
    {
        // Obtener prefijos
        $tipo = $this->getTipo($data['DOC_ID_TIPO']);
        $proceso = $this->getProceso($data['DOC_ID_PROCESO']);

        // Calcular consecutivo
        $stmt = $this->db->prepare("
            SELECT COUNT(*) + 1 as next
            FROM DOC_DOCUMENTO 
            WHERE DOC_ID_TIPO = ? AND DOC_ID_PROCESO = ?
        ");
        $stmt->execute([$data['DOC_ID_TIPO'], $data['DOC_ID_PROCESO']]);
        $next = $stmt->fetch()['next'];

        $codigo = "{$tipo['TIP_PREFIJO']}-{$proceso['PRO_PREFIJO']}-$next";

        $stmt = $this->db->prepare("
            INSERT INTO DOC_DOCUMENTO 
            (DOC_NOMBRE, DOC_CODIGO, DOC_CONTENIDO, DOC_ID_TIPO, DOC_ID_PROCESO)
            VALUES (?, ?, ?, ?, ?)
        ");

        return $stmt->execute([
            $data['DOC_NOMBRE'],
            $codigo,
            $data['DOC_CONTENIDO'],
            $data['DOC_ID_TIPO'],
            $data['DOC_ID_PROCESO']
        ]);
    }

    public function update($id, $data)
    {
        $tipo = $this->getTipo($data['DOC_ID_TIPO']);
        $proceso = $this->getProceso($data['DOC_ID_PROCESO']);

        $tipoPrefijo = $tipo['TIP_PREFIJO'];
        $procesoPrefijo = $proceso['PRO_PREFIJO'];

        $siguienteConsecutivo = $this->obtenerSiguienteConsecutivo($tipoPrefijo, $procesoPrefijo, $id);
        $codigo = "$tipoPrefijo-$procesoPrefijo-$siguienteConsecutivo";

        $stmt = $this->db->prepare("
            UPDATE DOC_DOCUMENTO SET 
            DOC_NOMBRE = ?, DOC_CODIGO = ?, DOC_CONTENIDO = ?, 
            DOC_ID_TIPO = ?, DOC_ID_PROCESO = ?
            WHERE DOC_ID = ?
        ");

        return $stmt->execute([
            $data['DOC_NOMBRE'],
            $codigo,
            $data['DOC_CONTENIDO'],
            $data['DOC_ID_TIPO'],
            $data['DOC_ID_PROCESO'],
            $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM DOC_DOCUMENTO WHERE DOC_ID = ?");
        return $stmt->execute([$id]);
    }

    private function getTipo($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM TIP_TIPO_DOC WHERE TIP_ID = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    private function getProceso($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM PRO_PROCESO WHERE PRO_ID = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    private function obtenerSiguienteConsecutivo($tipoPrefijo, $procesoPrefijo, $idActual)
    {
        $prefijo = "$tipoPrefijo-$procesoPrefijo-";

        $stmt = $this->db->prepare("
        SELECT MAX(CAST(SUBSTRING(DOC_CODIGO, LENGTH(?) + 1) AS UNSIGNED)) AS max_num
        FROM DOC_DOCUMENTO
        WHERE DOC_CODIGO LIKE CONCAT(?, '%') AND DOC_ID != ?
    ");
        $stmt->execute([$prefijo, $prefijo, $idActual]);
        $max = $stmt->fetchColumn();

        return ($max !== null ? intval($max) + 1 : 1);
    }
}
