<?php

class Lang {
    private DB $_db;
    private ?object $_data = null;

    public function __construct() {
        $this->_db = DB::getInstance();
    }

    /**
     * Fetch a language string from the database.
     * @param string|null $string
     * @return string|null
     */
    public function get(?string $string): ?string {
        if (!$string) return null;
        
        $data = $this->_db->get('nr_langs', ['lang_key', '=', $string]);
        
        if ($data->count()) {
            $this->_data = $data->first();
            return $this->_data->english ?? null;
        }
        return null;
    }

    /**
     * Get available language column names.
     * @return array
     */
    public function getLangsNames(): array {
        $sql = "SHOW COLUMNS FROM `nr_langs`";
        $query = $this->_db->query($sql);
        
        if ($query->count()) {
            return array_slice($query->results(), 2); // Skip first two columns
        }
        return [];
    }

    /**
     * Fetch all languages from the database.
     * @return array
     */
    public function getLanguages(): array {
        $data = $this->_db->all('nr_langs');
        return $data->count() ? $data->results() : [];
    }

    /**
     * Get the last fetched language data.
     * @return object|null
     */
    public function data(): ?object {
        return $this->_data;
    }
}

?>
