<?php

session_start();
session_destroy();

header('../../halaman/login.php');
