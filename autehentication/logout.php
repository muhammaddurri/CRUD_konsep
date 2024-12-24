<?php
session_start();
session_unset();
session_destroy();
headers("Loation: login.html");
exit;

?>