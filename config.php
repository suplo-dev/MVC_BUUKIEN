<?php

const URL = 'https://cuananh.com/';
const URL_ADMIN = URL.'admin/';
const URL_STORAGE = URL."assets/file/";

const PATH_FILE_AVATAR = "assets/file/avatar/";
const PATH_FILE_MENU = "assets/file/menu/";

const WEB_NAME = 'Evii';
const WEB_LOGO = 'https://cdn-icons-png.flaticon.com/512/3638/3638895.png';
const WEB_FAVICON = 'https://cdn-icons-png.flaticon.com/512/3638/3638895.png';
const WEB_ADDRESS = '01 Trần Hưng Đạo, Phường 5, Quận 1, Hồ Chí Minh';
const WEB_HOTLINE = '0965 279 041';
const WEB_EMAIL = 'contact@cuananh.com';
const WEB_DESCRIPTION = 'Hệ thống quản lí bưu kiện Evii';

const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = '123456';
const DB_NAME = 'buukien';

const TOAST_TIME = 3000;

const LIMIT_SIZE_FILE = 4; // đơn vị MB (megabyte)

const LIMIT_DAY_LOADED = 30; // giới hạn số ngày request chart

const LIMIT_ROW_PAGINATE = 1000; // giới hạn số dòng hiển thị

const BOOL_SPINNER = true; // công tắt spinner ở UI

const DEFAULT_IMAGE = 'https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg';
const DEFAULT_AVATAR = 'https://sbcf.fr/wp-content/uploads/2018/03/sbcf-default-avatar.png';

const ARR_POST_BRAND = [
    'Giao hàng nhanh',
    'Giao hàng TK',
    'J&T Express',
    'VNPost',
    'Ninja Van',
    'BEST Express',
    'Viettel Post'
];

const ARR_PROVINCE = [
    ['id' => 1, 'name' => 'Lai Châu'],
    ['id' => 2, 'name' => 'Hà Nội'],
    ['id' => 3, 'name' => 'Hải Phòng'],
    ['id' => 4, 'name' => 'Đà Nẵng'],
    ['id' => 5, 'name' => 'Hồ Chí Minh'],
    ['id' => 6, 'name' => 'An Giang'],
    ['id' => 7, 'name' => 'Bà Rịa - Vũng Tàu'],
    ['id' => 8, 'name' => 'Bắc Giang'],
    ['id' => 9, 'name' => 'Bắc Ninh'],
    ['id' => 10, 'name' => 'Bến Tre'],
    ['id' => 11, 'name' => 'Bình Định'],
    ['id' => 12, 'name' => 'Bình Dương'],
    ['id' => 13, 'name' => 'Bình Phước'],
    ['id' => 14, 'name' => 'Cà Mau'],
    ['id' => 15, 'name' => 'Cần Thơ'],
    ['id' => 16, 'name' => 'Đắk Lắk'],
    ['id' => 17, 'name' => 'Đắk Nông'],
    ['id' => 18, 'name' => 'Điện Biên'],
    ['id' => 19, 'name' => 'Gia Lai'],
    ['id' => 20, 'name' => 'Hà Giang'],
    ['id' => 21, 'name' => 'Hà Nam'],
    ['id' => 22, 'name' => 'Hà Tĩnh'],
    ['id' => 23, 'name' => 'Hòa Bình'],
    ['id' => 24, 'name' => 'Hưng Yên'],
    ['id' => 25, 'name' => 'Khánh Hòa'],
    ['id' => 26, 'name' => 'Kiên Giang'],
    ['id' => 27, 'name' => 'Kon Tum'],
    ['id' => 28, 'name' => 'Lai Châu'],
    ['id' => 29, 'name' => 'Lâm Đồng'],
    ['id' => 30, 'name' => 'Lạng Sơn'],
    ['id' => 31, 'name' => 'Nam Định'],
    ['id' => 32, 'name' => 'Nghệ An'],
    ['id' => 33, 'name' => 'Ninh Bình'],
    ['id' => 34, 'name' => 'Ninh Thuận'],
    ['id' => 35, 'name' => 'Phú Thọ'],
    ['id' => 36, 'name' => 'Phú Yên'],
    ['id' => 37, 'name' => 'Quảng Bình'],
    ['id' => 38, 'name' => 'Quảng Nam'],
    ['id' => 39, 'name' => 'Quảng Ngãi'],
    ['id' => 40, 'name' => 'Quảng Ninh'],
    ['id' => 41, 'name' => 'Sóc Trăng'],
    ['id' => 42, 'name' => 'Sơn La'],
    ['id' => 43, 'name' => 'Tây Ninh'],
    ['id' => 44, 'name' => 'Thái Bình'],
    ['id' => 45, 'name' => 'Thái Nguyên'],
    ['id' => 46, 'name' => 'Thanh Hóa'],
    ['id' => 47, 'name' => 'Thừa Thiên - Huế'],
    ['id' => 48, 'name' => 'Tiền Giang'],
    ['id' => 49, 'name' => 'Trà Vinh'],
    ['id' => 50, 'name' => 'Tuyên Quang'],
    ['id' => 51, 'name' => 'Vĩnh Long'],
    ['id' => 52, 'name' => 'Vĩnh Phúc'],
    ['id' => 53, 'name' => 'Yên Bái'],
    ['id' => 54, 'name' => 'Hải Dương'],
    ['id' => 55, 'name' => 'Thành phố Hồ Chí Minh'],
    ['id' => 56, 'name' => 'Ninh Thuận'],
    ['id' => 57, 'name' => 'Hà Tĩnh'],
    ['id' => 58, 'name' => 'Thanh Hóa'],
    ['id' => 59, 'name' => 'Đà Nẵng'],
    ['id' => 60, 'name' => 'Hải Phòng'],
    ['id' => 61, 'name' => 'Hà Nội'],
    ['id' => 62, 'name' => 'Cần Thơ'],
    ['id' => 63, 'name' => 'Kiên Giang'],
];

const ARR_STATE_POST = [
    [
        'color' => '#e4e75a',
        'text_color' => 'black',
        'name' => 'Đang gửi',
        'icon' => 'fas fa-truck'
    ],
    [

        'color' => '#70ca34',
        'text_color' => 'black',
        'name' => 'Hoàn thành',
        'icon' => 'fas fa-check'
    ],
    [
        'color' => '#325801',
        'text_color' => 'white',
        'name' => 'Đã nhận cod',
        'icon' => 'fas fa-dollar-sign'
    ],
    [
        'color' => '#e65b5b',
        'text_color' => 'black',
        'name' => 'Chuyển hoàn',
        'icon' => 'fas fa-undo'
    ],
    [
        'color' => '#a10909',
        'text_color' => 'white',
        'name' => 'Đã nhận chuyển hoàn',
        'icon' => 'fas fa-exchange-alt'
    ],
    [
        'color' => '#0B0B0B',
        'text_color' => 'white',
        'name' => 'Chuẩn bị chuyển hoàn',
        'icon' => 'fas fa-archive'
    ],
];
