<?php

class Admin {
    private $_db;
    private $_data;

    public function __construct() {
        $this->_db = DB::getInstance();
    }

    public function getThemes() {
        return glob('views/themes/*', GLOB_ONLYDIR);
    }

    public function addNewPage(array $fields) {
        return $this->_db->insert('nr_custompages', $fields);
    }

    public function updateCustomPage(array $fields, $id) {
        return $id ? $this->_db->update('nr_custompages', $id, $fields) : false;
    }

    public function custompagesData($start = 0, $end = 0) {
        $data = $this->_db->allLimit('nr_custompages', $start, $end);
        return $data->count() ? $data->results() : [];
    }

    public function updateAdsCode($key, $ads) {
        return $this->_db->query("UPDATE `nr_ads` SET `code` = ? WHERE `type` = ?", [$ads, $key]);
    }

    public function updateTerms($key, $value) {
        return $this->_db->query("UPDATE `nr_terms` SET `text` = ? WHERE `type` = ?", [$value, $key]);
    }

    public function deleteData($table, $id) {
        return $table && $id ? $this->_db->delete($table, ['id', '=', $id]) : false;
    }

    public function fetchData($table, $start = 0, $end = 0) {
        $data = $this->_db->allLimit($table, $start, $end);
        return $data->count() ? $data->results() : [];
    }

    public function usersData($start = 0, $end = 0) {
        return $this->fetchData('nr_users', $start, $end);
    }

    public function addNewLanguage($lang_name) {
        $lang_name = preg_replace('/[^a-zA-Z0-9_]/', '', $lang_name); // Sanitize input
        $sql = "ALTER TABLE `nr_langs` ADD `$lang_name` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;";
        
        if ($this->_db->query($sql)) {
            $langs = $this->langsFromDB('english');
            foreach ($langs as $key) {
                $update_sql = "UPDATE `nr_langs` SET `$lang_name` = ? WHERE `lang_key` = ?";
                $this->_db->query($update_sql, [$key->english, $key->lang_key]);
            }
            return true;
        }
        return false;
    }

    public function addNewKey(array $fields) {
        return $this->_db->insert('nr_langs', $fields);
    }

    public function langsFromDB($lang = 'english') {
        return $this->_db->query("SELECT `lang_key`, `$lang` FROM `nr_langs`")->results();
    }

    public function updateConfig($key, $value) {
        return $this->_db->query("UPDATE `nr_config` SET `value` = ? WHERE `name` = ?", [$value, $key]);
    }

    public function countAllData($type) {
        return $type ? number_format($this->_db->all($type)->count()) : 0;
    }

    public function countOnlineUser() {
        $time = time() - 60;
        return number_format($this->_db->get('nr_users', ['lastseen', '>', $time])->count());
    }

    public function usersDataOnline($start = 0, $end = 0) {
        $time = time() - 60;
        $data = $this->_db->allWithLimit('nr_users', ['lastseen', '>', $time], $start, $end);
        return $data->count() ? $data->results() : [];
    }

    public function registeredData($month, $type) {
        $year = date("Y");
        return $this->_db->get($type, ['registered', '=', "$month/$year"])->count();
    }

    public function data() {
        return $this->_data;
    }
}
?>