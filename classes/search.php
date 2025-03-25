<?php

class Search {
    private $_db;
    private $_data;

    // Constructor to initialize DB instance and optionally search for data
    public function __construct($search = null) {
        $this->_db = DB::getInstance();
        if ($search) {
            $this->find($search);
        }
    }

    // Find a search entry based on the provided search value (ID or username)
    public function find($search) {
        if ($search) {
            $field = is_numeric($search) ? 'id' : 'review_username';
            $data = $this->_db->get('nr_review', [$field, '=', $search]);

            if ($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }

    // Get search results with pagination support
    public function getSearch($search, $start = 0, $end = 0) {
        if ($search) {
            $field = is_numeric($search) ? 'id' : 'review_username';
            $data = $this->_db->allSearch('nr_review', [$field, '=', $search], $start, $end);

            if ($data->count()) {
                return $data->results();
            }
        }
        return [];  // Return an empty array if no results are found
    }

    // Count the number of search results based on the username or ID
    public function countSearch($search) {
        if ($search) {
            $field = is_numeric($search) ? 'id' : 'review_username';
            $data = $this->_db->get('nr_review', [$field, '=', $search]);
            return $data->count();
        }
        return 0;  // Return 0 if no search value is provided
    }

    // Check if search data exists
    public function exists() {
        return !empty($this->_data);  // Simplified check for data existence
    }

    // Return the search data
    public function data() {
        return $this->_data;
    }
}
?>
