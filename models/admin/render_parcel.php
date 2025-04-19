<?php

function render_row_parcel($data) {
    extract($data);
    $id_parcel_after = "'".$id_parcel."'";
    //format state
    $label_state = '<select name="state_parcel" data-id="'.$id_parcel.'" class="p-2 small d-block text-center" onchange="updatePost(event)"';
    $optionState = '';
    foreach (ARR_STATE_POST as $state){ ;
        if(strtolower(trim($state['name'])) === strtolower(trim($state_parcel))) {
            $css_attributes = '';
            if(isset($state['color'])) $css_attributes .= 'background-color : '.$state['color'].';';
            if(isset($state['text_color'])) $css_attributes .= 'color : '.$state['text_color'].';';
            $label_state .= 'style="'.$css_attributes.'"';
//            $label_state = '<select class="p-2 small d-block text-center" style="'.$css_attributes.'">'.$state['name'].'</span>';
            $optionState .= '<option value="'.$state['name'].'" selected>'.$state['name'].'</option>';
        } else {
            $optionState .= '<option value="'.$state['name'].'">'.$state['name'].'</option>';
        }
    }
    $label_state .= '>'. $optionState . '</select>';
    // format ngày
    if($date_sent == '0000-00-00') $date_sent = null;

    //return
    return <<<HTML
    <tr class="small">
        <td class="small align-middle text-center" onclick="getOnePost({$id_parcel_after})">
            {$id_parcel}
        </td>
        <td class="small align-middle text-center" onclick="getOnePost({$id_parcel_after})">
            {$brand_post}
        </td>
        <td class="small align-middle text-center" onclick="getOnePost({$id_parcel_after})">
            {$username}
        </td>
        <td class="small align-middle text-center" onclick="getOnePost({$id_parcel_after})">
            {$date_sent}
        </td>
        <td class="small align-middle text-center" onclick="getOnePost({$id_parcel_after})">
            {$name_receiver}
        </td>
        <td class="small align-middle text-center" onclick="getOnePost({$id_parcel_after})">
            {$phone_receiver}
        </td>
        <td class="small align-middle text-center" onclick="getOnePost({$id_parcel_after})">
            {$address_receiver}
        </td>
        <td class="small align-middle text-center" onclick="getOnePost({$id_parcel_after})">
            {$fee}
        </td>
        <td class="small align-middle text-center" onclick="getOnePost({$id_parcel_after})">
            {$cod}
        </td>
        <td class="small align-middle text-center" onclick="getOnePost({$id_parcel_after})">
            {$name_product}
        </td>
        <td class="small align-middle text-center text-light">
            {$label_state}
        </td>
        <td class="small align-middle text-center" onclick="getOnePost({$id_parcel_after})">
            {$note}
        </td>
    </tr>
    HTML;
}

function render_row_empty() {
    return <<<HTML
    <tr class="align-middle">
        <td class="text-center" colspan="12">
            Không tìm thấy kết quả tìm kiếm
        </td>
    </tr>
    HTML;
}

function render_paginate_parcel($total_row, $page_active) {
    // Khởi tạo
    $content = '';
    // Tính tổng số trang
    $total_page = ceil($total_row / LIMIT_ROW_PAGINATE);

    // Xử lý các trang xung quanh trang hiện tại
    $range = 2; // Hiển thị 2 trang trước và 2 trang sau
    $start = max(1, $page_active - $range);
    $end = min($total_page, $page_active + $range);

    // Render trang trước
    if ($page_active == 1) {
        $state_before_page = '-disabled';
        $value_before_page = 0;
    } else {
        $state_before_page = '';
        $value_before_page = $page_active - 1;
    }
    $content .= <<<HTML
    <button value="{$value_before_page}" class="btn-paginate sa-toolbar-user btn-sm bg-primary small fw-normal text-light rounded-0 bg-blue-light{$state_before_page}">
        <small>Trước</small>
    </button>
    HTML;

    // Hiển thị các trang
    if ($page_active <= 3) {
        // Nếu trang active là 1, 2, 3, hiển thị từ 1 đến 3 và sau đó là "..."
        for ($i = 1; $i <= 3; $i++) {
            $state_inner_page = ($i == $page_active) ? '-active' : '';
            $content .= <<<HTML
            <button value="{$i}" class="btn-paginate sa-toolbar-user btn-sm bg-primary small fw-normal text-light rounded-0 bg-blue-light{$state_inner_page}">
                <small>{$i}</small>
            </button>
            HTML;
        }
        // Dấu "..."
        if ($total_page > 3) {
            $content .= "<span class='btn-paginate sa-toolbar-user btn-sm bg-primary small fw-normal text-light rounded-0 bg-blue-light'>...</span>";
        }
        // Hiển thị trang cuối
        $content .= <<<HTML
        <button value="{$total_page}" class="btn-paginate sa-toolbar-user btn-sm bg-primary small fw-normal text-light rounded-0 bg-blue-light">
            <small>{$total_page}</small>
        </button>
        HTML;
    } elseif ($page_active >= $total_page - 2) {
        // Nếu trang active là trang cuối (hoặc gần cuối)
        $content .= <<<HTML
            <button value="1" class="btn-paginate sa-toolbar-user btn-sm bg-primary small fw-normal text-light rounded-0 bg-blue-light">
                <small>1</small>
            </button>
            <span class='btn-paginate sa-toolbar-user btn-sm bg-primary small fw-normal text-light rounded-0 bg-blue-light'>...</span>
            HTML;
        for ($i = $total_page - 2; $i <= $total_page; $i++) {
            $state_inner_page = ($i == $page_active) ? '-active' : '';
            $content .= <<<HTML
            <button value="{$i}" class="btn-paginate sa-toolbar-user btn-sm bg-primary small fw-normal text-light rounded-0 bg-blue-light{$state_inner_page}">
                <small>{$i}</small>
            </button>
            HTML;
        }
    } else {
        // Nếu trang active nằm giữa
        $content .= <<<HTML
            <button value="1" class="btn-paginate sa-toolbar-user btn-sm bg-primary small fw-normal text-light rounded-0 bg-blue-light">
                <small>1</small>
            </button>
            <span class='btn-paginate sa-toolbar-user btn-sm bg-primary small fw-normal text-light rounded-0 bg-blue-light'>...</span>
            HTML;
        for ($i = $page_active - 1; $i <= $page_active + 1; $i++) {
            $state_inner_page = ($i == $page_active) ? '-active' : '';
            $content .= <<<HTML
            <button value="{$i}" class="btn-paginate sa-toolbar-user btn-sm bg-primary small fw-normal text-light rounded-0 bg-blue-light{$state_inner_page}">
                <small>{$i}</small>
            </button>
            HTML;
        }
        $content .= <<<HTML
            <span class='btn-paginate sa-toolbar-user btn-sm bg-primary small fw-normal text-light rounded-0 bg-blue-light'>...</span>
            HTML;
        $content .= <<<HTML
        <button value="{$total_page}" class="btn-paginate sa-toolbar-user btn-sm bg-primary small fw-normal text-light rounded-0 bg-blue-light">
            <small>{$total_page}</small>
        </button>
        HTML;
    }

    // Render trang sau
    if ($total_page > 1) {
        if ($page_active == $total_page) {
            $state_after_page = '-disabled';
            $value_after_page = 0;
        } else {
            $state_after_page = '';
            $value_after_page = $page_active + 1;
        }

        $content .= <<<HTML
        <button value="{$value_after_page}" class="btn-paginate sa-toolbar-user btn-sm bg-primary small fw-normal text-light rounded-0 bg-blue-light{$state_after_page}">
            <small>Sau</small>
        </button>
        HTML;
    }

    return $content;
}
