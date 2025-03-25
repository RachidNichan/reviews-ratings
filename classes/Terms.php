<?php

class Terms {
    private $_db;
    private $_data;

    // Constructor accepts an optional term and initializes the database instance
    public function __construct($term = null) {
        $this->_db = DB::getInstance();

        // If a term is provided, we attempt to find it on instantiation
        if ($term) {
            $this->find($term);
        }
    }

    /**
     * Finds a term by its 'type' field.
     * 
     * @param string|null $term The term type to search for.
     * @return bool True if term is found, false otherwise.
     */
    public function find($term = null) {
        if ($term) {
            $data = $this->_db->get('nr_terms', ['type', '=', $term]);

            if ($data->count()) {
                $this->_data = $data->first(); // Store the first matching term
                return true; // Term found
            }
        }
        return false; // Term not found
    }

    /**
     * Retrieves the term's text based on the 'type'.
     * 
     * @param string|null $term The type of the term.
     * @return mixed The term's text if found, null otherwise.
     */
    public function get($term = null) {
        if ($term) {
            $data = $this->_db->get('nr_terms', ['type', '=', $term]);

            if ($data->count()) {
                $this->_data = $data->first();
                return $this->_data->text; // Return the text field of the term
            }
        }
        return null; // No term found
    }

    /**
     * Checks if the term data exists.
     * 
     * @return bool True if term data exists, false otherwise.
     */
    public function exists() {
        return !empty($this->_data); // Simplified existence check
    }

    /**
     * Returns the term's data.
     * 
     * @return mixed The term's data.
     */
    public function data() {
        return $this->_data;
    }
}
?>