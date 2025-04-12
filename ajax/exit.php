<?php 
setcookie('login', '', time() - 3600 * 24 * 30, '/');    // видалити години в cookie так як видалити повністю cookie
unset($_COOKIE['login']);