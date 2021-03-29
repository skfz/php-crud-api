<?php

namespace Api\Controller;
use \PDO;
use Api\ResourceInterface;
use Api\Helper;

class PostController implements ResourceInterface {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function fetchResource($id) {
        $query = "SELECT * FROM posts";
        $params = [];
        if (intval($id)) {
            $query .= " WHERE id=:id";
            $params[':id'] = $id;
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
        $data = json_decode(file_get_contents('php://input'), TRUE);
        $post = filter_var($data['post'], FILTER_SANITIZE_STRING);
        $date = $data['post_date'];
        
        if (!$post || !Helper::validateDate($date)) {
            $response['status_code'] = 'HTTP/1.1 422 Unprocessable Entity';
            $response['body'] = null;
            return $response;
        }

        $query = "INSERT INTO posts (post, post_date) VALUES (:post, :post_date)";
        $stmt = $this->conn->prepare($query);
        try {
            $stmt->execute([
                ':post' => $post,
                ':post_date' => $date
            ]);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }

        $response['status_code'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode(['message' => 'Post created']);

        return $response;
    }

    public function deleteResource($id) {
        if (!intval($id)) {
            $response['status_code'] = 'HTTP/1.1 422 Unprocessable Entity';
            $response['body'] = null;
            return $response;
        }

        $query = "DELETE from posts WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        try {
            $stmt->execute([':id' => $id]);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }

        $response['status_code'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode(['message' => 'Post deleted']);

        return $response;
    }

    public function updateData($id) {
        $data = json_decode(file_get_contents('php://input'), TRUE);
        $post = filter_var($data['post'], FILTER_SANITIZE_STRING);
        $date = $data['post_date'];
        
        if (!$post && !Helper::validateDate($date) || !intval($id)) {
            $response['status_code'] = 'HTTP/1.1 422 Unprocessable Entity';
            $response['body'] = null;
            return $response;
        }

        $fields = [];
        $params = [
            ':id' => $id
        ];

        $query = "UPDATE posts SET ";
        if ($post) {
            $query .= "post = :post";
            $params[':post'] = $post;
        }
        if ($date) {
            $query .= ",post_date = :date";
            $params[':date'] = $date;
        }
        $query .= " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        try {
            $stmt->execute($params);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }

        $response['status_code'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode(['message' => 'Post updated']);

        return $response;
    }
}