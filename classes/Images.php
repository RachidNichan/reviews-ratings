<?php

class Images {
    private $_db;

    public function __construct() {
        $this->_db = DB::getInstance();
    }

    public function uploadImage($file, $name, $type, $type_file, $option_id = 0, $placement = '') {
        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        $allowed_extensions = ['jpg', 'jpeg', 'png'];
        $allowed_mime_types = ['image/jpeg', 'image/png'];
        
        if (!in_array($ext, $allowed_extensions) || !in_array($type_file, $allowed_mime_types)) {
            return false;
        }
        
        if ($placement === 'user') {
            $filename  = Hash::unique(20) . '_user_avatar.' . $ext;
            $file_path = './upload/images/' . $filename;

            if (self::compress($file, $file_path, 50)) {
                $user = new User();
                if ($user->update(['user_avatar' => $filename])) {
                    self::resizeCropImage(200, 200, $file_path, $file_path, 90);
                    return true;
                }
            }
        }
        return false;
    }

    public static function resizeCropImage($max_width, $max_height, $source_file, $dst_dir, $quality = 80) {
        $img_info = @getimagesize($source_file);
        if (!$img_info) return false;

        list($width, $height) = $img_info;
        $mime = $img_info['mime'];

        $image_create_funcs = [
            'image/jpeg' => 'imagecreatefromjpeg',
            'image/png' => 'imagecreatefrompng',
            'image/gif' => 'imagecreatefromgif'
        ];

        if (!isset($image_create_funcs[$mime])) return false;

        $src_img = $image_create_funcs[$mime]($source_file);
        if (!$src_img) return false;

        if (function_exists('exif_read_data')) {
            $exif = @exif_read_data($source_file);
            if (!empty($exif['Orientation'])) {
                $rotation_map = [3 => 180, 6 => -90, 8 => 90];
                if (isset($rotation_map[$exif['Orientation']])) {
                    $src_img = imagerotate($src_img, $rotation_map[$exif['Orientation']], 0);
                }
            }
        }

        $dst_img = imagecreatetruecolor($max_width, $max_height);
        $ratio = min($max_width / $width, $max_height / $height);
        $new_width = (int)($width * $ratio);
        $new_height = (int)($height * $ratio);
        
        imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        imagejpeg($dst_img, $dst_dir, $quality);

        imagedestroy($dst_img);
        imagedestroy($src_img);

        return true;
    }

    public static function compress($source, $destination, $quality = 75) {
        $info = getimagesize($source);
        if (!$info) return false;

        $image_funcs = [
            'image/jpeg' => 'imagecreatefromjpeg',
            'image/png' => 'imagecreatefrompng',
            'image/gif' => 'imagecreatefromgif'
        ];

        if (!isset($image_funcs[$info['mime']])) return false;

        $image = $image_funcs[$info['mime']]($source);
        imagejpeg($image, $destination, $quality);
        imagedestroy($image);
        
        return true;
    }

    public static function createAvatar($string) {
        $image_name = Hash::unique(20) . '_user_avatar.png';
        $image_path = './upload/images/' . $image_name;
        
        $avatar = imagecreatetruecolor(200, 200);
        $bg_color = imagecolorallocate($avatar, random_int(0, 255), random_int(0, 255), random_int(0, 255));
        imagefill($avatar, 0, 0, $bg_color);

        $text_color = imagecolorallocate($avatar, 255, 255, 255);
        $font_path = "./views/font/arial.ttf";
        if (!file_exists($font_path)) return false;

        imagettftext($avatar, 100, 0, 55, 150, $text_color, $font_path, $string);
        imagepng($avatar, $image_path);
        imagedestroy($avatar);
     
        return $image_name;
    }
}

?>