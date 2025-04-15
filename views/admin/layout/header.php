<!DOCTYPE html>
<html lang="en" dir="ltr" data-scompiler-id="0">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="format-detection" content="telephone=no" />
    <title><?= (isset($title)) ? $title : WEB_NAME ?></title>
    <!-- icon -->
    <link rel="icon" type="image/png" href="<?= WEB_FAVICON ?>" />
    <!-- fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i" />
    <!-- css -->
    <link rel="stylesheet" href="<?=URL?>assets/admin/vendor/bootstrap/css/bootstrap.ltr.css" />
    <link rel="stylesheet" href="<?=URL?>assets/admin/vendor/highlight.js/styles/github.css" />
    <link rel="stylesheet" href="<?=URL?>assets/admin/vendor/simplebar/simplebar.min.css" />
    <link rel="stylesheet" href="<?=URL?>assets/admin/vendor/quill/quill.snow.css" />
    <link rel="stylesheet" href="<?=URL?>assets/admin/vendor/air-datepicker/css/datepicker.min.css" />
    <link rel="stylesheet" href="<?=URL?>assets/admin/vendor/select2/css/select2.min.css" />
    <link rel="stylesheet" href="<?=URL?>assets/admin/vendor/datatables/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="<?=URL?>assets/admin/vendor/nouislider/nouislider.min.css" />
    <link rel="stylesheet" href="<?=URL?>assets/admin/vendor/fullcalendar/main.min.css" />
    <link rel="stylesheet" href="<?=URL?>assets/admin/css/style.css" />
    <link rel="stylesheet" href="<?=URL?>assets/admin/css/custom.css" />
    <!-- cdn bootstrap icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <!-- cdn jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- cdn google -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- cdn xlsx -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <!-- Summernote CSS - CDN Link -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <!-- //Summernote CSS - CDN Link -->
    <script src='https://cdn.plot.ly/plotly-3.0.1.min.js'></script>
</head>
    <?=toast_show();//dùng toast?>


<body>

    <!-- Spinner -->
    <style>
        #spinner {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: white; /* Nền trắng */
            z-index: 9999; /* Đảm bảo spinner nằm trên cùng */
            display: flex;
            justify-content: center;
            align-items: center;
            visibility: visible; /* Hiển thị spinner ban đầu */
        }
    </style>
    <?php if(BOOL_SPINNER) : ?>
    <div id="spinner">
        <div  style="width: 8px; height: 8px;" class="spinner-grow text-danger" role="status">
        </div>
        <div  style="width: 12px; height: 12px;" class="spinner-grow text-warning mx-2" role="status">
        </div>
        <div  style="width: 16px; height: 16px;" class="spinner-grow text-success" role="status">
        </div>
        <div  style="width: 20px; height: 20px;" class="spinner-grow text-danger mx-2" role="status">
        </div>
        <div  style="width: 24px; height: 24px;" class="spinner-grow text-warning" role="status">
        </div>
    </div>
    <?php endif ?>

    <!-- sa-app -->
    <?php if(is_login()) : // Nếu đăng nhập sẽ show?>
    <div class="sa-app sa-app--desktop-sidebar-hidden sa-app--mobile-sidebar-hidden sa-app--toolbar-fixed">
        <!-- sa-app__sidebar -->
        <div class="sa-app__sidebar">
            <div class="sa-sidebar">
                <div class="sa-sidebar__header">
                    <a class="sa-sidebar__logo" href="<?=URL_ADMIN?>">
                        <!-- logo -->
                        <div class="sa-sidebar-logo text-center">
                                <img width="32" src="<?= WEB_LOGO ?>" alt="">
                                <div class="ms-3 text-light"><?= WEB_NAME ?></div>
                        </div>
                        <!-- logo / end -->
                    </a>
                </div>
                <div class="sa-sidebar__body bg-light bg-opacity-10" data-simplebar="">
                    <ul class="sa-nav sa-nav--sidebar" data-sa-collapse="">
                        <li class="sa-nav__section">
                            <ul class="sa-nav__menu sa-nav__menu--root">
                                <!-- Project Case -->
                                <?php if(auth('name_role') == 'admin') : ?>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="<?=URL_ADMIN?>bieu-do" class="sa-nav__link <?=($page=='dashboard') ? 'bg-dark' : ''?>">
                                        <span class="sa-nav__icon">
                                            <i class="fas fa-chart-bar"></i>
                                        </span>
                                        <span class="sa-nav__title">Biểu đồ</span>
                                    </a>
                                </li>
                                <?php endif ?>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="<?=URL_ADMIN?>quan-li-buu-kien" class="sa-nav__link <?=($page=='post') ? 'bg-dark' : ''?>">
                                        <span class="sa-nav__icon">
                                            <i class="fas fa-boxes"></i>
                                        </span>
                                        <span class="sa-nav__title">Quản lí bưu kiện</span>
                                    </a>
                                </li>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="<?=URL_ADMIN?>doi-soat" class="sa-nav__link <?=($page=='doi-soat') ? 'bg-dark' : ''?>">
                                        <span class="sa-nav__icon">
                                            <i class="fas fa-file-alt"></i>
                                        </span>
                                        <span class="sa-nav__title">Đối soát</span>
                                    </a>
                                </li>
                                <?php if(auth('name_role') == 'admin') : ?>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="<?=URL_ADMIN?>quan-li-nhan-vien" class="sa-nav__link <?=($page=='nhan-vien') ? 'bg-dark' : ''?>">
                                        <span class="sa-nav__icon">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <span class="sa-nav__title">Quản lí nhân viên</span>
                                    </a>
                                </li>
                                <?php endif ?>
                                <form action="/dang-xuat" method="post">
                                    <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                        <button type="submit" name="logout" href="<?=URL_ADMIN?>quan-li-buu-kien" class="sa-nav__link bg-transparent border-0 w-100">
                                            <span class="sa-nav__icon">
                                                <i class="fas fa-sign-out-alt"></i>
                                            </span>
                                            <span class="sa-nav__title text-start">Đăng xuất</span>
                                        </button>
                                    </li>
                                </form>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="sa-app__sidebar-shadow"></div>
            <div class="sa-app__sidebar-backdrop" data-sa-close-sidebar=""></div>
        </div>
        <!-- sa-app__sidebar / end -->
        <!-- sa-app__content -->
        <div class="sa-app__content">
            <!-- sa-app__toolbar -->
            <div class="sa-toolbar sa-toolbar--search-hidden sa-app__toolbar">
                <div class="sa-toolbar__body bg-primary">
                    <div class="sa-toolbar__item">
                        <button class="sa-toolbar__button text-light bg-transparent" type="button" aria-label="Menu" data-sa-toggle-sidebar="">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>

                    <div class="mx-auto d-flex my-auto py-2 flex-grow-1 justify-content-center">
                        <?php if($page == 'parcel') : //Show chức năng quản lí bưu kiện ?>
                        <div class="sa-toolbar_item my-auto px-3 p-2 bg-blue-light rounded rounded-fill-header">
                            <i class="fas fa-search text-light small ms-1 me-3"></i>
                            <input name="searchParcel" type="text" placeholder="Nhập thông tin tìm kiếm" class="form-search"/>
                            <button class="min-w-10x btn btn-sm btn-primary text-light fs-btn-fill-header" data-bs-toggle="modal" data-bs-target="#modalAddParcel">
                                Thêm bưu kiện
                            </button>
                            <button id="importParcel" class="min-w-10x btn btn-sm btn-primary text-light fs-btn-fill-header">
                                Nhập XLSX
                            </button>
                            <button id="updateParcel" class="min-w-10x btn btn-sm btn-primary text-light fs-btn-fill-header">
                                Cập nhật trạng thái
                            </button>
                            <button id="deleteParcel" class="min-w-10x btn btn-sm btn-primary text-light fs-btn-fill-header">
                                Xoá dữ liệu
                            </button>
                            <button id="printParcel" class="min-w-10x btn btn-sm btn-primary text-light fs-btn-fill-header">
                                Print
                            </button>
                        </div>
                        <?php endif ?>
                        <?php if($page == 'doi-soat') : //Show chức năng quản lí đối soát ?>
                        <div class="sa-toolbar_item my-auto px-3 p-2 bg-blue-light rounded rounded-fill-header">
                            <i class="fas fa-search text-light small ms-1 me-3"></i>
                            <input type="text" placeholder="Nhập thông tin tìm kiếm" class="form-search" id="table-search"/>
                            <button class="invisible min-w-10x btn btn-sm btn-primary text-light fs-btn-fill-header" data-bs-toggle="modal" data-bs-target="#modalAddPost">
                                space
                            </button>
                            <button class="invisible min-w-10x btn btn-sm btn-primary text-light fs-btn-fill-header">
                                space
                            </button>
                            <button class="invisible min-w-10x btn btn-sm btn-primary text-light fs-btn-fill-header">
                                space
                            </button>
                            <button id="compareParcel" class="min-w-10x btn btn-sm btn-primary text-light fs-btn-fill-header">
                                Tải XLSX
                            </button>
                            <button id="printDoiSoat" class="min-w-10x btn btn-sm btn-primary text-light fs-btn-fill-header">
                                Print
                            </button>
                        </div>
                        <?php endif ?>
                        <?php if($page == 'nhan-vien') : //Show chức năng quản lí nhân viên ?>
                        <div class="sa-toolbar_item my-auto px-3 p-2 bg-blue-light rounded rounded-fill-header">
                            <i class="fas fa-search text-light small ms-1 me-3"></i>
                            <input type="text" placeholder="Nhập thông tin tìm kiếm" class="form-search" id="table-search"/>
                            <button class="invisible min-w-10x btn btn-sm btn-primary text-light fs-btn-fill-header">
                                space
                            </button>
                            <button class="invisible min-w-10x btn btn-sm btn-primary text-light fs-btn-fill-header">
                                space
                            </button>
                            <button class="invisible min-w-10x btn btn-sm btn-primary text-light fs-btn-fill-header">
                                space
                            </button>
                            <button class="invisible min-w-10x btn btn-sm btn-primary text-light fs-btn-fill-header">
                                space
                            </button>
                            <button class="min-w-10x btn btn-sm btn-primary text-light fs-btn-fill-header" data-bs-toggle="modal" data-bs-target="#modalAddEmployee">
                                Thêm
                            </button>
                        </div>
                        <?php endif ?>
                        <?php if($page == 'dashboard') : // Chức năng biểu đồ ?>
                        <div class="sa-toolbar_item my-auto px-3 p-2 bg-blue-light rounded rounded-fill-header">
                            <i class="fas fa-filter text-light small ms-1 me-3"></i>
                            <input type="hidden" id="type_show" name = "type_show" value="<?= $type_show?>">
                            <input id="time_start" name="time_start" style="width: 130px" type="date" class="form-search" value="<?= $timeStart->format('Y-m-d') ?>"/>
                            <span class="text-light mx-2">&rarr;</span>
                            <input id="time_end" name="time_end" style="width: 130px" type="date" class="form-search" value="<?= $timeEnd->format('Y-m-d') ?>"/>

                            <button class="invisible min-w-5x btn btn-sm btn-primary text-light fs-btn-fill-header">
                                space
                            </button>
                            <button id="showDay" class="min-w-5x btn btn-sm text-light fs-btn-fill-header <?= $type_show == 'day' ? 'btn-primary-active' : 'btn-primary' ?>">
                                Ngày
                            </button>
                            <button id="showWeek" class="min-w-5x btn btn-sm text-light fs-btn-fill-header <?= $type_show == 'week' ? 'btn-primary-active' : 'btn-primary' ?>">
                                Tuần
                            </button>
                            <button id="showMonth" class="min-w-5x btn btn-sm text-light fs-btn-fill-header <?= $type_show == 'month' ? 'btn-primary-active' : 'btn-primary' ?>">
                                Tháng
                            </button>
                            <button id="showYear" class="min-w-5x btn btn-sm text-light fs-btn-fill-header <?= $type_show == 'year' ? 'btn-primary-active' : 'btn-primary' ?>">
                                Năm
                            </button>
                        </div>
                        <?php endif ?>
                    </div>
                    <?php if($page == 'parcel') : // Chức năng biểu đồ ?>
                    <div class="sa-toolbar__item">
                        <i class="fas fa-chart-pie me-5" style="color:white; cursor: pointer" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"></i>
                        <div class="offcanvas offcanvas-end pb-5" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" data-bs-backdrop="false" data-bs-scroll="true">
                            <div class="offcanvas-header">
                                <ul class="nav nav-tabs" id="myTab" role="tablist" style="border-bottom: 2px solid #027594; padding-bottom:1px;">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active nav-link-custom" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Tháng này</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link nav-link-custom" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Tháng trước</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link nav-link-custom" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Total</button>
                                    </li>
                                </ul>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div id='chartThisMonth'></div>
                                        <script>
                                            let ARR_STATE_POST = JSON.parse(`<?php echo json_encode(ARR_STATE_POST); ?> `)
                                            let dataChart = JSON.parse(`<?php echo json_encode($data['chart']['this_month']); ?>`);
                                            let dataThisMonth = {
                                                values: [],
                                                labels: [],
                                                marker: {
                                                    colors: []
                                                },
                                                type: 'pie',
                                                textinfo: "label+percent",
                                                insidetextorientation: "radial",
                                            };
                                            let totalParcel = 0
                                            dataChart.forEach(function (state) {
                                                totalParcel += state.count_parcel
                                            })
                                            dataChart.forEach(function (state) {
                                                dataThisMonth.values.push(parseInt((state.count_parcel / totalParcel * 100).toFixed()))
                                                dataThisMonth.labels.push(state.state_parcel)
                                                dataThisMonth.marker.colors.push(state.color)
                                            })
                                            let layout1 = {
                                                width: 300,
                                                margin: {
                                                    l: 80,
                                                    r: 80,
                                                    b: 0,
                                                    t: 150,
                                                    pad: 0
                                                },
                                                showlegend: false
                                            };

                                            Plotly.newPlot('chartThisMonth', [dataThisMonth], layout1, {responsive: true});
                                        </script>
                                        <div class="row p-0">
                                            <div class="col-12 bg-green-custom text-center border-bottom py-4">Tháng này tổng có <?= array_reduce($data['chart']['this_month'], function ($carry, $state) {
                                                    return $carry + (int)$state['count_parcel'];
                                                }, 0)?> bưu kiện</div>
                                            <div class="col-12 bg-green-custom text-center py-4 d-flex">
                                                <div class="text-center w-50">
                                                    <div class="pb-4">Tổng phí gửi</div>
                                                    <div><?= number_format(array_reduce($data['chart']['this_month'], function ($carry, $state) {
                                                            return $carry + (int)$state['total_fee'];
                                                        }, 0)); ?></div>
                                                </div>
                                                <div class="text-center w-50">
                                                    <div class="pb-4">Tổng COD</div>
                                                    <div><?= number_format(array_reduce($data['chart']['this_month'], function ($carry, $state) {
                                                            return $carry + (int)$state['total_cod'];
                                                        }, 0)); ?></div>
                                                </div>
                                            </div>
                                            <?php foreach ($data['chart']['this_month'] as $value): ?>
                                            <div class="col-12 d-flex align-items-center py-4">
                                                <div class="rounded-circle d-flex justify-content-center align-items-center ms-5" style="width: 48px; height: 48px; background: <?= $value['color'] ?>; color: <?= $value['text_color'] ?>">
                                                    <i class="<?= $value['icon'] ?>"></i>
                                                </div>
                                                <div class="ms-5 ps-5">
                                                    <span class="border border-dark p-1 me-3"><?= $value['count_parcel'] ?></span>
                                                    <?= $value['state_parcel'] ?>
                                                </div>
                                            </div>
                                            <div class="col-6 d-flex justify-content-around py-4" style="background: <?= $value['color'] ?>; color: <?= $value['text_color'] ?>">
                                                <span>Phí gửi:</span>
                                                <span><?= number_format($value['total_fee']) ?></span>
                                            </div>
                                            <div class="col-6 d-flex justify-content-around py-4" style="background: <?= $value['color'] ?>; color: <?= $value['text_color'] ?>">
                                                <span>COD:</span>
                                                <span><?= number_format($value['total_cod']) ?></span>
                                            </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <div id='chartLastMonth' style="width: 100%"></div>
                                        <script>
                                            let dataChartLastMonth = JSON.parse(`<?php echo json_encode($data['chart']['last_month']); ?>`);
                                            let dataLastMonth = {
                                                values: [],
                                                labels: [],
                                                marker: {
                                                    colors: []
                                                },
                                                type: 'pie',
                                                textinfo: "label+percent",
                                                insidetextorientation: "radial",
                                            };
                                            let totalParcelLastMonth = 0
                                            dataChartLastMonth.forEach(function (state) {
                                                totalParcelLastMonth += state.count_parcel
                                            })
                                            dataChartLastMonth.forEach(function (state) {
                                                dataLastMonth.values.push(parseInt((state.count_parcel / totalParcel * 100).toFixed()))
                                                dataLastMonth.labels.push(state.state_parcel)
                                                dataLastMonth.marker.colors.push(state.color)
                                            })
                                            Plotly.newPlot('chartLastMonth', [dataLastMonth],
                                                {
                                                    margin: {
                                                        width: 300,
                                                        l: 80,
                                                        r: 80,
                                                        b: 0,
                                                        t: 150,
                                                        pad: 0
                                                    },
                                                    showlegend: false
                                                }, {responsive: true});
                                        </script>
                                        <div class="row p-0">
                                            <div class="col-12 bg-green-custom text-center border-bottom py-4">Tháng trước tổng có <?= array_reduce($data['chart']['last_month'], function ($carry, $state) {
                                                            return $carry + (int)$state['count_parcel'];
                                                        }, 0)?> bưu kiện</div>
                                            <div class="col-12 bg-green-custom text-center py-4 d-flex">
                                                <div class="text-center w-50">
                                                    <div class="pb-4">Tổng phí gửi</div>
                                                    <div><?= number_format(array_reduce($data['chart']['last_month'], function ($carry, $state) {
                                                            return $carry + (int)$state['total_fee'];
                                                        }, 0)); ?></div>
                                                </div>
                                                <div class="text-center w-50">
                                                    <div class="pb-4">Tổng COD</div>
                                                    <div><?= number_format(array_reduce($data['chart']['last_month'], function ($carry, $state) {
                                                            return $carry + (int)$state['total_cod'];
                                                        }, 0)); ?></div>
                                                </div>
                                            </div>
                                            <?php foreach ($data['chart']['last_month'] as $value): ?>
                                                <div class="col-12 d-flex align-items-center py-4">
                                                    <div class="rounded-circle d-flex justify-content-center align-items-center ms-5" style="width: 48px; height: 48px; background: <?= $value['color'] ?>; color: <?= $value['text_color'] ?>">
                                                        <i class="<?= $value['icon'] ?>"></i>
                                                    </div>
                                                    <div class="ms-5 ps-5">
                                                        <span class="border border-dark p-1 me-3"><?= $value['count_parcel'] ?></span>
                                                        <?= $value['state_parcel'] ?>
                                                    </div>
                                                </div>
                                                <div class="col-6 d-flex justify-content-around py-4" style="background: <?= $value['color'] ?>; color: <?= $value['text_color'] ?>">
                                                    <span>Phí gửi:</span>
                                                    <span><?= number_format($value['total_fee']) ?></span>
                                                </div>
                                                <div class="col-6 d-flex justify-content-around py-4" style="background: <?= $value['color'] ?>; color: <?= $value['text_color'] ?>">
                                                    <span>COD:</span>
                                                    <span><?= number_format($value['total_cod']) ?></span>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                        <div id='chartOverall' style="width: 100%"></div>
                                        <script>
                                            let dataChartOverall = JSON.parse(`<?php echo json_encode($data['chart']['last_month']); ?>`);
                                            let dataOverall = {
                                                values: [],
                                                labels: [],
                                                marker: {
                                                    colors: []
                                                },
                                                type: 'pie',
                                                textinfo: "label+percent",
                                                insidetextorientation: "radial",
                                            };
                                            let totalParcel = 0
                                            dataChartOverall.forEach(function (state) {
                                                totalParcel += state.count_parcel
                                            })
                                            dataChartOverall.forEach(function (state) {
                                                dataOverall.values.push(parseInt((state.count_parcel / totalParcel * 100).toFixed()))
                                                dataOverall.labels.push(state.state_parcel)
                                                dataOverall.marker.colors.push(state.color)
                                            })
                                            Plotly.newPlot('chartOverall', [dataChartOverall], layout1, {responsive: true});
                                        </script>
                                        <div class="row p-0">
                                            <div class="col-12 bg-green-custom text-center border-bottom py-4">Tổng có <?= array_reduce($data['chart']['overall'], function ($carry, $state) {
                                                    return $carry + (int)$state['count_parcel'];
                                                }, 0)?> bưu kiện</div>
                                            <div class="col-12 bg-green-custom text-center py-4 d-flex">
                                                <div class="text-center w-50">
                                                    <div class="pb-4">Tổng phí gửi</div>
                                                    <div><?= number_format(array_reduce($data['chart']['overall'], function ($carry, $state) {
                                                            return $carry + (int)$state['total_fee'];
                                                        }, 0)); ?></div>
                                                </div>
                                                <div class="text-center w-50">
                                                    <div class="pb-4">Tổng COD</div>
                                                    <div><?= number_format(array_reduce($data['chart']['overall'], function ($carry, $state) {
                                                            return $carry + (int)$state['total_cod'];
                                                        }, 0)); ?></div>
                                                </div>
                                            </div>
                                            <?php foreach ($data['chart']['overall'] as $value): ?>
                                                <div class="col-12 d-flex align-items-center py-4">
                                                    <div class="rounded-circle d-flex justify-content-center align-items-center ms-5" style="width: 48px; height: 48px; background: <?= $value['color'] ?>; color: <?= $value['text_color'] ?>">
                                                        <i class="<?= $value['icon'] ?>"></i>
                                                    </div>
                                                    <div class="ms-5 ps-5">
                                                        <span class="border border-dark p-1 me-3"><?= $value['count_parcel'] ?></span>
                                                        <?= $value['state_parcel'] ?>
                                                    </div>
                                                </div>
                                                <div class="col-6 d-flex justify-content-around py-4" style="background: <?= $value['color'] ?>; color: <?= $value['text_color'] ?>">
                                                    <span>Phí gửi:</span>
                                                    <span><?= number_format($value['total_fee']) ?></span>
                                                </div>
                                                <div class="col-6 d-flex justify-content-around py-4" style="background: <?= $value['color'] ?>; color: <?= $value['text_color'] ?>">
                                                    <span>COD:</span>
                                                    <span><?= number_format($value['total_cod']) ?></span>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif ?>
                </div>
                <div class="sa-toolbar__shadow"></div>
            </div>
    <?php endif ?>
            <script>
                // Khi tab được hiển thị (Bootstrap 5 event)
                document.querySelectorAll('button[data-bs-toggle="tab"]').forEach((tabButton) => {
                    tabButton.addEventListener('shown.bs.tab', function (event) {
                        // Lấy ID của tab vừa được hiển thị
                        const targetId = event.target.getAttribute('data-bs-target');

                        // Resize biểu đồ tương ứng (tùy ID chart)
                        if (targetId === '#home') {
                            Plotly.Plots.resize(document.getElementById('chartThisMonth'));
                        } else if (targetId === '#profile') {
                            Plotly.Plots.resize(document.getElementById('chartLastMonth'));
                        }
                        // Nếu có tab contact và thêm chart sau này thì cũng resize ở đây
                    });
                });

                // Resize lại khi mở offcanvas (để tránh trường hợp chưa render xong đã bị che khuất)
                const offcanvas = document.getElementById('offcanvasRight');
                offcanvas.addEventListener('shown.bs.offcanvas', function () {
                    Plotly.Plots.resize(document.getElementById('chartThisMonth'));
                });
            </script>

<!-- Dùng toast -->
<?=toast_show()?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function loadParcel(keyword) {
    // Thay thế nội dung box-result bằng loading indicator
    $("#resultParcel").html(`
        <tr class="align-middle">
            <td class="text-center" colspan="12">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </td>
        </tr>
    `);

    $.ajax({
        url: `/admin/filterParcel?keyword=${encodeURIComponent(keyword)}`,
        method: 'GET',
        dataType: 'json', // Dữ liệu trả về là JSON
        success: function (response) {
            // Kiểm tra mã trạng thái
            if (response.status === 200) {
                // Cập nhật nội dung mới
                $("#resultParcel").html(response.data);
                $("#resultPaginate").html(response.paginate);
                $("#resultCount").html(response.count);
            }
        },
        error: function () {
            console.log("Đã có lỗi xảy ra.");
            $("#resultParcel").html("<tr class='align-middle'><td class='text-center' colspan='12'>Đã có lỗi khi tải dữ liệu. Vui lòng liên hệ ADMIN để hỗ trợ</td></tr>"); // Thông báo lỗi
        }
    });
}

$(document).ready(function () {
    // Gửi yêu cầu mặc định khi trang được tải
    loadParcel('');

    // Theo dõi sự kiện nhập liệu trong ô tìm kiếm
    $('#searchParcel').on('input', function () {
        var keyword = $(this).val();
        loadParcel(keyword); // Gửi yêu cầu tìm kiếm
    });
});
</script>

<script>
    document.getElementById('importParcel').addEventListener('click', function() {
        // Tạo input file ẩn
        const fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.name = 'file_request'; // Đặt tên cho input file
        fileInput.accept = '.xls, .xlsx'; // Cho phép chỉ định định dạng xls và xlsx

        // Xử lý sự kiện khi tệp được chọn
        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                // Tạo một form ẩn để gửi dữ liệu
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/admin/importParcel'; // Đường dẫn đến controller
                form.enctype = 'multipart/form-data'; // Đặt kiểu mã hóa để gửi tệp

                // Thêm input file vào form
                form.appendChild(fileInput);

                // Thêm form vào body và gửi đi
                document.body.appendChild(form);
                form.submit(); // Gửi form
            }
        });

        // Kích hoạt input file
        fileInput.click(); // Kích hoạt dialog chọn tệp
    });
</script>

<script>
    document.getElementById('updateParcel').addEventListener('click', function() {
        // Tạo input file ẩn
        const fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.name = 'file_request'; // Đặt tên cho input file
        fileInput.accept = '.xls, .xlsx'; // Cho phép chỉ định định dạng xls và xlsx

        // Xử lý sự kiện khi tệp được chọn
        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                // Tạo một form ẩn để gửi dữ liệu
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/admin/updateParcel'; // Đường dẫn đến controller
                form.enctype = 'multipart/form-data'; // Đặt kiểu mã hóa để gửi tệp

                // Thêm input file vào form
                form.appendChild(fileInput);

                // Thêm form vào body và gửi đi
                document.body.appendChild(form);
                form.submit(); // Gửi form
            }
        });

        // Kích hoạt input file
        fileInput.click(); // Kích hoạt dialog chọn tệp
    });
</script>

<script>
    document.getElementById('deleteParcel').addEventListener('click', function() {
        // Tạo input file ẩn
        const fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.name = 'file_request'; // Đặt tên cho input file
        fileInput.accept = '.xls, .xlsx'; // Cho phép chỉ định định dạng xls và xlsx

        // Xử lý sự kiện khi tệp được chọn
        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                // Tạo một form ẩn để gửi dữ liệu
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/admin/deleteParcel'; // Đường dẫn đến controller
                form.enctype = 'multipart/form-data'; // Đặt kiểu mã hóa để gửi tệp

                // Thêm input file vào form
                form.appendChild(fileInput);

                // Thêm form vào body và gửi đi
                document.body.appendChild(form);
                form.submit(); // Gửi form
            }
        });

        // Kích hoạt input file
        fileInput.click(); // Kích hoạt dialog chọn tệp
    });
</script>

<script>
    document.getElementById('compareParcel').addEventListener('click', function() {
        // Tạo input file ẩn
        const fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.name = 'file_request'; // Đặt tên cho input file
        fileInput.accept = '.xls, .xlsx'; // Cho phép chỉ định định dạng xls và xlsx

        // Xử lý sự kiện khi tệp được chọn
        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                // Tạo một form ẩn để gửi dữ liệu
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/admin/doi-soat'; // Đường dẫn đến controller
                form.enctype = 'multipart/form-data'; // Đặt kiểu mã hóa để gửi tệp

                // Thêm input file vào form
                form.appendChild(fileInput);

                // Thêm form vào body và gửi đi
                document.body.appendChild(form);
                form.submit(); // Gửi form
            }
        });

        // Kích hoạt input file
        fileInput.click(); // Kích hoạt dialog chọn tệp
    });
</script>
