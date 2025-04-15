<!-- sa-app__body -->
<div id="top" class="sa-app__body">
    <div class="pb-5">
        <div class="container-fluid p-0">
            <div class="card">
                <div class="sa-divider"></div>
                <!-- <table class="sa-datatables-init table table-hover border-muted" data-order="[[ 9, &quot;asc&quot; ]]" data-sa-search-input="#table-search"> -->
                <table class="table table-hover border-muted mb-5">
                    <thead>
                        <tr class="small">
                            <!-- <th class="w-min">ID</th> -->
                            <th class="col-2 text-center">Mã nhân viên</th>
                            <th class="col-2 text-center">Họ tên</th>
                            <th class="col-2 text-center">Số điện thoại</th>
                            <th class="col-2 text-center">Username</th>
                            <th class="col-2 text-center">Phân quyền</th>
                            <th class="col-2 text-end">Hành động</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php if($list_employee) : ?>
                        <?php foreach ($list_employee as $employee) : ?>
                            <tr class="small <?= $employee['name_role'] === 'admin' ? 'bg-warning bg-opacity-10' : '' ?>">
                                <td class="small align-middle text-center">
                                    <?= $employee['code_user'] ?>
                                </td>
                                <td class="small align-middle text-center">
                                    <?= $employee['full_name'] ?>
                                <td class="small align-middle text-center">
                                    <?= $employee['phone'] ?>
                                </td>
                                <td class="small align-middle text-center ">
                                    <?= $employee['username'] ?>
                                </td>
                                <td class="small align-middle text-center">
                                    <?= ($employee['username'] === 'admin' ? '<span class="text-danger fw-bold">Quản trị viên</span>' : ($employee['name_role'] === 'admin' ? '<span class="text-danger">'.$employee['name_role'].'</span>' : $employee['name_role'])) ?>
                                </td>
                                <td class="small align-middle text-end">
                                    <button type="button" class="btn btn-sm btn-warning p-1 px-2 me-2 <?= ($employee['username'] == 'admin' && auth('username') !== 'admin') ? 'invisible' : '' ?>" onclick="getOnePost('<?= $employee['id_user'] ?>')">
                                        <small>Sửa</small>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger p-1 px-2 <?= ($employee['username'] == 'admin') ? 'invisible' : '' ?>" onclick="delete_employee('<?= $employee['id_user'] ?>')">
                                        <small>Xoá</small>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                        <?php else : ?>
                            <tr class="small text-center">
                                <td colspan="6">
                                    Danh sách trống
                                </td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Footer Page -->
<div class="d-none position-fixed fixed-bottom d-flex bg-primary">
    <div class="container-fluid d-flex px-0 py-3">
        <div class="col-1 invisible">
            space
        </div>

        <div class="col-1">
            <select class="form-select form-select-sm border-0 bg-blue-light text-light rounded-0">
                <option value="0" selected disabled>- Lọc đơn vị -</option>
                <?php foreach (ARR_POST_BRAND as $i => $name): ?>
                    <option value="<?= ++$i ?>"><?= $name ?></option>
                <?php endforeach ?>
            </select>
        </div>
        
        <div class="col-1 invisible">
            space
        </div>

        <div class="col-1">
            <div class="dropdown sa-toolbar__item">
                <button class="sa-toolbar-user btn-sm bg-primary small fw-normal bg-blue-light text-light rounded-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                    data-bs-offset="0,1" aria-expanded="false">
                    - Lọc ngày gửi -
                </button>
                <ul style="width: 360px !important" class="dropdown-menu p-5" aria-labelledby="dropdownMenuButton">
                    <li>
                        <div class="">
                            <div class="input-group mb-3">
                                <span class="input-group-text w-25">
                                    <small>Từ ngày</small>
                                </span>
                                <input type="date" class="form-control" placeholder="Username" aria-label="Username">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text w-25">
                                    <small>Đến ngày</small>
                                </span>
                                <input type="date" class="form-control" placeholder="Username" aria-label="Username">
                            </div>
                            <div class="text-center mt-4">
                                <button class="btn btn-sm btn-primary text-light small">Xác nhận lọc</button>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-6 invisible">
            space
        </div>

        <div class="col-1">
            <select class="form-select form-select-sm border-0 bg-blue-light text-light rounded-0">
                <option value="0" selected disabled>- Lọc trạng thái -</option>
                <?php foreach (ARR_STATE_POST as $i => $item): extract($item)?>
                    <option value="<?= ++$i ?>"><?= $name ?></option>
                <?php endforeach ?>
            </select>
        </div>
    </div>
</div>

<!-- Modal Thêm mới -->
<style>
    .select2-container--open {
        z-index: 9999;
    }
</style>

<!-- Modal sửa nhân viên -->
<div class="modal fade" id="modalEditEmployee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <form method="post">
                <input type="hidden" name="id_force" value="">
                <div class="modal-body text-center px-5">
                    <div class="row justify-content-between">
                        <div class="col-12 text-center h4 fw-normal mb-5 pb-2">
                            Cập nhật thông tin nhân viên
                        </div>
                        <input id="id_user" type="hidden" name="id_user" value="<?= $id_user ?>" >
                        <div class="py-2 col-12 text-start">
                            <?= show_error($error_valid) ?>
                        </div>
                        <div class="col-6 py-2 px-3 text-start mb-4">
                            <label class="small text-muted" for="code_user">Mã nhân viên</label>
                            <input id="code_user" name="code_user" value="<?= $code_user ?>" type="text" placeholder="Mã nhân viên"
                                class="form-control ps-0 border-0 border-bottom border-2 outline-none" />
                        </div>
                        <div class="col-6 py-2 px-3 text-start mb-4">
                            <label class="small text-muted" for="full_name">Họ tên</label>
                            <input name="full_name" value="<?= $full_name ?>" id="full_name" type="text" placeholder="Nhập họ và tên"
                                class="form-control ps-0 border-0 border-bottom border-2 outline-none" />
                        </div>
                        <div class="col-6 py-2 px-3 text-start mb-4">
                            <label class="small text-muted" for="id_role">Phân quyền</label>
                            <select name="id_role" id="id_role" class="form-select ps-0 border-0 border-bottom border-2 outline-none">
                                <option value="0" selected disabled>--- Chọn phân quyền ---</option>
                                <option value="1" <?= $id_role == 1 ? 'selected' : '' ?>> Adminitrator </option>
                                <option value="2" <?= $id_role == 2 ? 'selected' : '' ?>> Employee </option>
                            </select>
                        </div>
                        <div class="col-6 py-2 px-3 text-start mb-4">
                            <label class="small text-muted" for="phone">Số điện thoại</label>
                            <input name="phone" value="<?= $phone ?>" id="phone" type="text" placeholder="Nhập số điện thoại"
                                class="form-control ps-0 border-0 border-bottom border-2 outline-none" />
                        </div>
                        <div class="col-6 py-2 px-3 text-start mb-4">
                            <label class="small text-muted" for="username">Email/Username</label>
                            <input <?= ($username === 'admin') ? 'readonly' : '' ?> name="username" value="<?= $username ?>" id="username" type="text" placeholder="Nhập email/username để đăng nhập"
                                class="form-control ps-0 border-0 border-bottom border-2 outline-none" />
                        </div>
                        <div class="col-6 py-2 px-3 text-start mb-4">
                            <label class="small text-muted" for="password">Thay đổi mật khẩu</label>
                            <input name="password" id="password" type="password" placeholder="Nhập mật khẩu mới"
                                class="form-control ps-0 border-0 border-bottom border-2 outline-none" />
                        </div>
                        <div class="col-12 mt-4">
                            <button name="editEmployee" type="submit" class="w-btn-fill btn btn-primary text-light ms-2">Cập nhật</button>
                            <button type="button" class="w-btn-fill btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal thêm nhân viên -->
<div class="modal fade" id="modalAddEmployee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <form method="post">
                <input type="hidden" name="id_force" value="">
                <div class="modal-body text-center px-5">
                    <div class="row justify-content-between">
                        <div class="col-12 text-center h4 fw-normal mb-5 pb-2">
                            Thông tin nhân viên
                        </div>
                        <div class="py-2 col-12 text-start">
                            <?= show_error($error_valid) ?>
                        </div>
                        <div class="col-6 py-2 px-3 text-start mb-4">
                            <label class="small text-muted" for="code_user">Mã nhân viên</label>
                            <input name="code_user" id="code_user" value="<?= $code_user ?>" type="text" placeholder="Mã nhân viên"
                                class="form-control ps-0 border-0 border-bottom border-2 outline-none" />
                        </div>
                        <div class="col-6 py-2 px-3 text-start mb-4">
                            <label class="small text-muted" for="full_name">Họ tên</label>
                            <input name="full_name" value="<?= $full_name ?>" id="full_name" type="text" placeholder="Nhập họ và tên"
                                class="form-control ps-0 border-0 border-bottom border-2 outline-none" />
                        </div>
                        <div class="col-6 py-2 px-3 text-start mb-4">
                            <label class="small text-muted" for="id_role">Phân quyền</label>
                            <select name="id_role" id="id_role" class="form-select ps-0 border-0 border-bottom border-2 outline-none">
                                <option value="0" selected disabled>--- Chọn phân quyền ---</option>
                                <option value="1" <?= $id_role == 1 ? 'selected' : '' ?>> Adminitrator </option>
                                <option value="2" <?= $id_role == 2 ? 'selected' : '' ?>> Employee </option>
                            </select>
                        </div>
                        <div class="col-6 py-2 px-3 text-start mb-4">
                            <label class="small text-muted" for="phone">Số điện thoại</label>
                            <input name="phone" value="<?= $phone ?>" id="phone" type="text" placeholder="Nhập số điện thoại"
                                class="form-control ps-0 border-0 border-bottom border-2 outline-none" />
                        </div>
                        <div class="col-6 py-2 px-3 text-start mb-4">
                            <label class="small text-muted" for="username">Email/Username</label>
                            <input name="username" value="<?= $username ?>" id="username" type="text" placeholder="Nhập email/username để đăng nhập"
                                class="form-control ps-0 border-0 border-bottom border-2 outline-none" />
                        </div>
                        <div class="col-6 py-2 px-3 text-start mb-4">
                            <label class="small text-muted" for="password">Mật khẩu</label>
                            <input name="password" id="password" type="password" placeholder="Nhập mật khẩu"
                                class="form-control ps-0 border-0 border-bottom border-2 outline-none" />
                        </div>
                        <div class="col-12 mt-4">
                            <button name="addEmployee" type="submit" class="w-btn-fill btn btn-primary text-light ms-2">Xác nhận</button>
                            <button type="button" class="w-btn-fill btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>



<!-- Modal xoá nhân viên -->
<div class="modal fade" id="modalDeleteEmployee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xoá nhân viên</h5>
                <button type="button" class="sa-close sa-close--modal" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form method="post">
                <input type="hidden" name="id" value="">
                <div class="modal-body text-center px-5">
                    <div class="mb-5">
                        Bạn có chắc chắn xoá ? Việc xoá vĩnh viễn sẽ không thể khôi phục lại !
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                    <button name="deleteEmployee" type="submit" class="btn btn-danger">Xoá</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function delete_employee(id) {
        document.querySelector('input[name="id"]').value = id;
        var myModal = new bootstrap.Modal(document.getElementById('modalDeleteEmployee'));
        myModal.show();
    }
</script>

<script>
    function getOnePost(id) {
        // Hiện modal
        var myModal = new bootstrap.Modal(document.getElementById('modalEditEmployee'));
        
        // Gửi yêu cầu AJAX để lấy dữ liệu
        $.ajax({
            url: `/admin/getEmployee?id=${id}`, // Sử dụng template string để chèn ID
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                // Kiểm tra nếu status là 200
                if (response.status === 200) {
                    const data = response.data; // Lấy dữ liệu

                    // Gán giá trị vào các input có ID tương ứng
                    $("#id_user").val(data.id_user || '');
                    $("#code_user").val(data.code_user || '');
                    $("#id_role").val(data.id_role || '');
                    $("#full_name").val(data.full_name || '');
                    $("#phone").val(data.phone || '');
                    $("#username").val(data.username || '');
                    // Hiện modal sau khi đã gán giá trị
                    myModal.show();
                } else {
                    console.error('Error: ', response.message); // Xử lý nếu status không phải 200
                }
            },
            error: function (xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
    }
</script>