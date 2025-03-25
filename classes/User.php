<?php

class User {
    private $_db,
            $_data,
            $_sessionName,
            $_cookieName,
            $_isLoggedIn;

    public function __construct($user = null) {
        $this->_db = DB::getInstance();
        $this->_sessionName = Config::get('session/session_name');
        $this->_cookieName = Config::get('cookie/cookie_name');

        if ($user === null) {
            $this->_initializeFromSession();
        } else {
            $this->find($user);
        }
    }

    private function _initializeFromSession() {
        if (Session::exists($this->_sessionName)) {
            $user = Session::get($this->_sessionName);
            if ($this->find($user)) {
                $this->_isLoggedIn = true;
            } else {
                // Process logout (optional)
            }
        }
    }

    public function update($fields = [], $id = null) {
        $id = $id ?? ($this->isLoggedIn() ? $this->data()->id : null);
        if ($id && $this->_db->update('nr_users', $id, $fields)) {
            return true;
        }
        return false;
    }

    public function create($fields = []) {
        return $this->_db->insert('nr_users', $fields);
    }

    public function find($user = null) {
        if ($user) {
            $field = is_numeric($user) ? 'id' : 'user_username';
            $data = $this->_db->get('nr_users', [$field, '=', $user]);

            if ($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }

    public function findEmail($email = null) {
        if ($email) {
            $data = $this->_db->get('nr_users', ['user_email', '=', $email]);

            if ($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }

    public function login($email = null, $password = null) {
        if (!$email || !$password) {
            return $this->_handleExistingLogin();
        }

        return $this->_handleLogin($email, $password);
    }

    private function _handleExistingLogin() {
        if ($this->exists()) {
            Session::put($this->_sessionName, $this->data()->id);
            return true;
        }
        return false;
    }

    private function _handleLogin($email, $password) {
        if ($this->findEmail($email) && password_verify($password, $this->data()->user_password)) {
            Session::put($this->_sessionName, $this->data()->id);
            $this->_manageSessionHash();
            return true;
        }
        return false;
    }

    private function _manageSessionHash() {
        $hash = Hash::unique(50);
        $hashCheck = $this->_db->get('nr_users_session', ['session_user_id', '=', $this->data()->id]);

        if (!$hashCheck->count()) {
            $this->_db->insert('nr_users_session', [
                'session_user_id' => $this->data()->id,
                'session_hash_id' => $hash
            ]);
        } else {
            $hash = $hashCheck->first()->session_hash_id;
        }

        Cookie::put($this->_cookieName, $hash, Config::get('cookie/cookie_expiry'));
    }

    public function exists() {
        return !empty($this->_data);
    }

    public function logout() {
        if ($this->exists()) {
            $this->_db->delete('nr_users_session', ['session_user_id', '=', $this->data()->id]);
            Session::delete($this->_sessionName);
            Cookie::delete($this->_cookieName);
        }
    }

    public function data() {
        return $this->_data;
    }

    public function isLoggedIn() {
        return $this->_isLoggedIn;
    }

    public static function getIpAddress() {
        $ipKeys = ['HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED'];
        foreach ($ipKeys as $key) {
            if (!empty($_SERVER[$key]) && self::validateIp($_SERVER[$key])) {
                return $_SERVER[$key];
            }
        }
        return $_SERVER['REMOTE_ADDR'];
    }

    public static function validateIp($ip) {
        return filter_var($ip, FILTER_VALIDATE_IP) !== false;
    }

    public static function getBrowser() {
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $platform = 'Unknown';
        $bname = 'Unknown';
        $version = '';

        // Platform detection
        if (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        } elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        } elseif (preg_match('/iphone|IPhone/i', $u_agent)) {
            $platform = 'iPhone';
        } elseif (preg_match('/android|Android/i', $u_agent)) {
            $platform = 'Android';
        }

        // Browser detection
        $browsers = [
            'MSIE' => 'Internet Explorer',
            'Firefox' => 'Mozilla Firefox',
            'Chrome' => 'Google Chrome',
            'Safari' => 'Apple Safari',
            'Opera' => 'Opera',
            'Netscape' => 'Netscape'
        ];

        foreach ($browsers as $pattern => $name) {
            if (preg_match("/$pattern/i", $u_agent)) {
                $bname = $name;
                break;
            }
        }

        // Version detection
        preg_match_all('#(?<browser>' . implode('|', array_keys($browsers)) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#', $u_agent, $matches);
        $version = $matches['version'][0] ?? '?';

        return [
            'userAgent' => $u_agent,
            'name' => $bname,
            'version' => $version,
            'platform' => $platform,
            'ip_address' => self::getIpAddress()
        ];
    }

    public static function getDevice() {
        return self::isMobile() ? 'mobile' : 'pc';
    }

    public static function IsMobile() {
        $useragent = $_SERVER['HTTP_USER_AGENT'];
        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) {
            return true;
        }
        return false;
    }  
}
