<?php
// hàm khởi tạo
ob_start();
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Khởi tạo các session
if(!isset($_SESSION['user'])) $_SESSION['user'] = '';
if(!isset($_SESSION['toast']) || !is_array($_SESSION['toast'])) $_SESSION['toast'] = [];
if(!isset($_SESSION['canvas'])) $_SESSION['canvas'] = '';

// config
require_once 'config.php';

// models
require_once 'models/database.php';
require_once 'models/function.php';
