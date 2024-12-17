<?php
require_once 'book.php';

$book = new Book();
header("Content-Type: application/json");

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        echo json_encode($book->getAll());
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"));

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(['message' => 'Error en el JSON: ' . json_last_error_msg()]);
            break;
        }

        if (isset($data->title, $data->author, $data->year)) {
            if ($book->create($data->title, $data->author, $data->year)) {
                echo json_encode(['message' => 'Libro creado']);
            } else {
                echo json_encode(['message' => 'Error al crear el libro']);
            }
        } else {
            echo json_encode(['message' => 'Datos incompletos para crear el libro']);
        }
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"));

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(['message' => 'Error en el JSON: ' . json_last_error_msg()]);
            break;
        }

        if (isset($data->id, $data->title, $data->author, $data->year)) {
            if ($book->update($data->title, $data->author, $data->year, $data->id)) {
                echo json_encode(['message' => 'Libro actualizado']);
            } else {
                echo json_encode(['message' => 'Error al actualizar el libro']);
            }
        } else {
            echo json_encode(['message' => 'Datos incompletos para actualizar el libro']);
        }
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents("php://input"));

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(['message' => 'Error en el JSON: ' . json_last_error_msg()]);
            break;
        }

        if (isset($data->id)) {
            if ($book->delete($data->id)) {
                echo json_encode(['message' => 'Libro eliminado']);
            } else {
                echo json_encode(['message' => 'Error al eliminar el libro']);
            }
        } else {
            echo json_encode(['message' => 'ID no proporcionado para eliminar el libro']);
        }
        break;

    default:
        echo json_encode(['message' => 'Método no soportado']);
        break;
}
