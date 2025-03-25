<?php

class CustomPage {
    private DB $_db;
    private ?object $_data = null;

    public function __construct($custom_page = null) {
        $this->_db = DB::getInstance();
        if ($custom_page !== null) {
            $this->find($custom_page);
        }
    }

    public function find($custom_page): bool {
        $field = is_numeric($custom_page) ? 'id' : 'page_name';
        $data = $this->_db->get('nr_custompages', [$field, '=', $custom_page]);

        if ($data->count()) {
            $this->_data = $data->first();
            return true;
        }
        
        $this->_data = null;
        return false;
    }

    public function getCustomPages(): ?array {
        $data = $this->_db->all('nr_custompages');
        return $data->count() ? $data->results() : null;
    }

    public function exists(): bool {
        return $this->_data !== null;
    }

    public function data(): ?object {
        return $this->_data;
    }
}

?>
