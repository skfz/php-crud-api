<?php

namespace Api;

interface ResourceInterface {
    
    public function fetchResource($id);

    public function postData();

    public function deleteResource($id);

    public function updateData($id);
}