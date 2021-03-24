<?php

namespace Api\Controller;
use \PDO;
use Api\ResourceInterface;

class PostController implements ResourceInterface {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function fetchResource($id) {
        $query = "SELECT * FROM posts";
        $params = [];
        if (intval($id)) {
            $query .= " WHERE id=?";
            $params[] = $id;
        }

        $stmt = $this->conn->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        try {
            $stmt->execute($params);
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
            exit($e->getMessage());
        }

        $response['status_code'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);

        return $response;
    }

    public function postData() {

    }

    public function deleteResource($id) {

    }

    public function updateData($id) {

    }
}