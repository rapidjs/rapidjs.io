<?php
    namespace App\Helpers;

    class JSONResponse {
        public $success = false;
        public $message = '';
        public $data = [];

        function __construct($params = []) {
            $this->success = isset($params['success']) ? $params['success'] : false;
            $this->message = isset($params['message']) ? $params['message'] : 'An error occured.';
            $this->data    = isset($params['data']) ? $params['data']       : [];
        }

        public function success() {
            $this->success = true;
            return $this;
        }

        public function fail() {
            $this->success = true;
            return $this;
        }

        public function with($data = []) {
            $this->data = array_merge_recursive($data, $this->data);
            return $this;
        }

        public function message($message) {
            $this->message = $message;
            return $this;
        }

        public function output() {
            echo $this->toJSON();
        }

        public function toArray() {
            return get_object_vars($this);
        }

        public function toJSON() {
            return json_encode(get_object_vars($this));
        }
    }
?>
