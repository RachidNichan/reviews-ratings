<?php

class Admin {
    private $_db,
            $_data;

    public function __construct() {
        $this->_db = DB::getInstance();
    }

    public function getThemes() {
        $themes = glob('views/themes/*', GLOB_ONLYDIR);
        return $themes;
    }

    public function addNewPage($fields = array()) {
        if ($this->_db->insert('nr_custompages', $fields)) {
            return true;
        }
    }

    public function updateCustomPage($fields = array(), $id = null) {
        if ($this->_db->update('nr_custompages', $id, $fields)) {
            return true;
        }
    }

    public function custompagesData($start = 0, $end = 0) {
        $data = $this->_db->allLimit('nr_custompages', $start, $end);

        if ($data->count()) {
            return $data->results();
        }
    }

    public function updateAdsCode($key, $ads) {
        $sql = "UPDATE `nr_ads` SET `code` = ? WHERE `type` = '{$key}'";
        if ($this->_db->query($sql, array('code' => $ads))) {
            return true;
        }
    }

    public function updateTerms($key, $value) {
        $sql = "UPDATE `nr_terms` SET `text` = ? WHERE `type` = '{$key}'";
        if ($this->_db->query($sql, array('text' => $value))) {
            return true;
        }
    }

    public function deleteData($table = null, $id = 0) {
        $this->_db->delete($table, array('id', '=', $id));
        return true;
    }

    public function categoriesData($start = 0, $end = 0) {
        $data = $this->_db->allLimit('nr_categories', $start, $end);

        if ($data->count()) {
            return $data->results();
        }
    }

    public function categoriesMainData($start = 0, $end = 0) {
        $data = $this->_db->allLimit('nr_categories_main', $start, $end);

        if ($data->count()) {
            return $data->results();
        }
    }
    
    public function postsData($start = 0, $end = 0) {
        $data = $this->_db->allLimit('nr_posts', $start, $end);

        if ($data->count()) {
            return $data->results();
        }
    }

    public function reviewData($start = 0, $end = 0) {
        $data = $this->_db->allLimit('nr_review', $start, $end);

        if ($data->count()) {
            return $data->results();
        }
    }

    public function usersData($start = 0, $end = 0) {
        $data = $this->_db->allLimit('nr_users', $start, $end);

        if ($data->count()) {
            return $data->results();
        }
    }

    public function addNewLanguage($lang_name) {
        $sql = "ALTER TABLE `nr_langs` ADD `$lang_name` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;";
        if ($this->_db->query($sql)) {
            foreach (self::langsFromDB('english') as $key) {
                $sql = "UPDATE `nr_langs` SET `{$lang_name}` = '{$key->english}' WHERE `lang_key` = '{$key->lang_key}'";
                if ($this->_db->query($sql)) {
                    return true;
                }
            }
        }
    }

    public function addNewKey($fields = array()) {
        if ($this->_db->insert('nr_langs', $fields)) {
            return true;
        }
    }

    public function langsFromDB($lang = 'english') {
        $sql = "SELECT `lang_key`, `$lang` FROM `nr_langs`";
        if ($this->_db->query($sql)) {
            return $this->_db->results();
        }
    }

    public function updateConfig($key, $value) {
        $sql = "UPDATE `nr_config` SET `value` = ? WHERE `name` = '{$key}'";
        if ($this->_db->query($sql, array('value' => $value))) {
            return true;
        }
    }

    public function countAllData($type = null) {
        $data = $this->_db->all($type);
        return number_format($data->count());
    }

    public function countOnlineUser() {
        $time = time() - 60;
        $data = $this->_db->get('nr_users', array('lastseen', '>', $time));
        return number_format($data->count());
    }

    public function usersDataOnline($start = 0, $end = 0) {
        $time = time() - 60;
        $data = $this->_db->allWithLimit('nr_users', array('lastseen', '>', $time), $start, $end);

        if ($data->count()) {
            return $data->results();
        }
    }

    public function registeredData($month, $type = null) {
        $year = date("Y");
        $data = $this->_db->get($type, array('registered', '=', $month.'/'.$year));
        return $data->count();
    }

    public function data() {
        return $this->_data;
    }
}

?>