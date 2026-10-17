<?php

header('Content-Type: application/json; charset=utf-8');

include("../conexion.php");
include("../funciones.php");

try {

    $registros = json_decode(
        $_POST['registros'] ?? '[]',
        true
    );

    if (!is_array($registros) || empty($registros)) {
        throw new Exception('No se recibieron registros válidos');
    }

    mysqli_begin_transaction($conn);

    $sql = "UPDATE servicios
            SET Pago = ?
            WHERE Id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        throw new Exception('No fue posible preparar la consulta');
    }

    foreach ($registros as $registro) {

        $id = filter_var(
            $registro['id'] ?? null,
            FILTER_VALIDATE_INT
        );

        $cantidad = filter_var(
            $registro['cantidad'] ?? null,
            FILTER_VALIDATE_INT
        );

        if (
            $id === false || $id === null ||
            $cantidad === false || $cantidad === null ||
            $cantidad < 0
        ) {
            throw new Exception('Se recibieron datos inválidos');
        }

        mysqli_stmt_bind_param(
            $stmt,
            'ii',
            $cantidad,
            $id
        );

        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception('No fue posible actualizar un registro');
        }
    }

    mysqli_stmt_close($stmt);

    mysqli_commit($conn);

    echo json_encode([
        'ok' => true,
        'mensaje' => 'Cambios guardados correctamente'
    ]);

} catch (Throwable $e) {

    if (isset($conn) && $conn instanceof mysqli) {
        mysqli_rollback($conn);
    }

    error_log($e->getMessage());

    http_response_code(400);

    echo json_encode([
        'ok' => false,
        'mensaje' => 'No fue posible guardar los cambios'
    ]);
}