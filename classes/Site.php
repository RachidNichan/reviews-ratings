<?php

class Site {
    private $_db;
    private $_data;

    // Constructor to initialize the DB instance
    public function __construct() {
        $this->_db = DB::getInstance();
    }

    /**
     * Retrieves a configuration value by name.
     * 
     * @param string|null $key The key of the configuration to retrieve.
     * @return mixed The configuration value if found, or null if not.
     */
    public function get($key = null) {
        if ($key === null) {
            return null; // Return null if no key is provided
        }

        // Query the database for the configuration with the given key
        $data = $this->_db->get('nr_config', ['name', '=', $key]);

        // Check if the configuration exists
        if ($data->count()) {
            $this->_data = $data->first();
            return $this->_data->value; // Return the value directly
        }

        // Return null if the configuration is not found
        return null;
    }

    /**
     * Returns the stored data.
     * 
     * @return mixed The stored data object.
     */
    public function data() {
        return $this->_data;
    }
}
?>