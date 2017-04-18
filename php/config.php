<?php
/**
 * These are the database login details
 */
define("HOST", "localhost");     // The host you want to connect to.
define("READ_USER", "img_read_user");    // The database read username.
define("READ_PASSWORD", "P@ssw0rd1!");    // The database read password.
define("WRITE_USER", "img_write_user");    // The database read username.
define("WRITE_PASSWORD", "P@ssw0rd2!");    // The database read password.
define("DATABASE", "image_edit");    // The database name.

define("SECURE", FALSE);    // FOR DEVELOPMENT ONLY!!!!

function sec_session_start() {
    $session_name = 'sec_session_id';   // Set a custom session name
    /*Sets the session name.
     *This must come before session_set_cookie_params due to an undocumented bug/feature in PHP.
     */
    session_name($session_name);

    $secure = true;
    // This stops JavaScript being able to access the session id.
    $httponly = true;
    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"],
        $cookieParams["domain"],
        $secure,
        $httponly
    );

    session_start();            // Start the PHP session
    session_regenerate_id(true);    // regenerated the session, delete the old one.
}
?>
