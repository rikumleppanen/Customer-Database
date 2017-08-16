<?php

class BaseController {

    public static function get_user_logged_in() {
        if (isset($_SESSION['user'])) {
            $user_id = $_SESSION['user'];
            $Mguru = Marketinguru::find($user_id);

            return $Mguru;
        }
        return null;
    }

    public static function check_logged_in() {
        if (!isset($_SESSION['user'])) {
            Redirect::to('/login', array('error' => 'You must sign in before entering!'));
        }
    }

    public static function check_admin_rights() {
        if (isset($_SESSION['user'])) {
            $user_id = $_SESSION['user'];
            $rights = Marketinguru::admin_rights($user_id);
            if ($rights == FALSE) {
                Redirect::to('/login', array('error' => 'You have no rights for entering the requested area'));
            }
        } else {
            check_logged_in();
        }
    }

}
