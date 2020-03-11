<?php
session_start();
session_destroy();
require_once("../function.php");
redirect('login');