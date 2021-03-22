<?php

namespace Api\Controller;
use Api\ResourceInterface;

class PostController implements ResourceInterface {

    public function fetchResource($id) {
        echo 'success';
    }

    public function postData() {

    }

    public function deleteResource($id) {

    }

    public function updateData($id) {

    }
}