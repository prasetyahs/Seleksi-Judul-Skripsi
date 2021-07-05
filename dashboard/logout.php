<?php 
include '../config/config.php';
session_start();
session_destroy();
Redirect($BASE_URL);