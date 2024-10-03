<?php
include_once('../../model/connect.php');
include_once('../../model/admin/supplier.model.php');

if (isset($_POST['function'])) {
    $function = $_POST['function'];
    switch ($function) {
        case 'delete':
            deleteSupplier();
            break;
        case 'create':
            createSupplier();
            break;
        case 'edit':
            editSupplier();
            break;
        case 'checkEmailAndPhoneExists':
            checkEmailAndPhoneExists();
            break; // Thêm hàm kiểm tra cả email và số điện thoại
        case 'checkEditEmailAndPhoneExists':
          checkEditEmailAndPhoneExists();
          break; // Thêm hàm kiểm tra cả email và số điện thoại
              
    }
}

function deleteSupplier()
{
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $delete_result = supplier_delete($id);
        echo $delete_result;
    }
}

function createSupplier()
{
    if (isset($_POST['field'])) {
        echo supplier_create($_POST['field']);
    }
}

function editSupplier()
{
    if (isset($_POST['field'])) {
        echo supplier_edit($_POST['field']);
    }
}

function checkEmailExists()
{
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        echo json_encode(['exists' => checkEmailInDatabase($email)]);
    }
}

function checkPhoneExists()
{
    if (isset($_POST['sdt'])) {
        $sdt = $_POST['sdt'];
        echo json_encode(['exists' => checkPhoneInDatabase($sdt)]);
    }
}

function checkEmailAndPhoneExists()
{
    if (isset($_POST['email']) && isset($_POST['sdt'])) {
        $email = $_POST['email'];
        $sdt = $_POST['sdt'];

        $emailExists = checkEmailInDatabase($email);
        $phoneExists = checkPhoneInDatabase($sdt);

        echo json_encode([
            'emailExists' => $emailExists,
            'phoneExists' => $phoneExists
        ]);
    }
}

// Hàm hỗ trợ kiểm tra email trong cơ sở dữ liệu
function checkEmailInDatabase($email)
{
    global $database;  // Sử dụng đối tượng $database từ connect.php

    // Truy vấn kiểm tra email trong bảng suppliers
    $sql = "SELECT COUNT(*) AS count FROM suppliers WHERE email = '$email'";
    $result = $database->query($sql);
    $row = $result->fetch_assoc();

    // Trả về true nếu email đã tồn tại, ngược lại false
    return $row['count'] > 0;
}

// Hàm hỗ trợ kiểm tra số điện thoại trong cơ sở dữ liệu
function checkPhoneInDatabase($sdt)
{
    global $database;  // Sử dụng đối tượng $database từ connect.php

    // Truy vấn kiểm tra số điện thoại trong bảng suppliers
    $sql = "SELECT COUNT(*) AS count FROM suppliers WHERE number_phone = '$sdt'";
    $result = $database->query($sql);
    $row = $result->fetch_assoc();

    // Trả về true nếu số điện thoại đã tồn tại, ngược lại false
    return $row['count'] > 0;
}

function checkEditEmailAndPhoneExists()
{
    if (isset($_POST['email']) && isset($_POST['sdt']) && isset($_POST['currentEmail']) && isset($_POST['currentSdt'])) {
        $email = $_POST['email'];
        $sdt = $_POST['sdt'];
        $currentEmail = $_POST['currentEmail'];
        $currentSdt = $_POST['currentSdt'];

        $emailExists = checkEmailInDatabase($email) && $email !== $currentEmail;
        $phoneExists = checkPhoneInDatabase($sdt) && $sdt !== $currentSdt;

        echo json_encode([
            'emailExists' => $emailExists,
            'phoneExists' => $phoneExists,
        ]);
    }
}
