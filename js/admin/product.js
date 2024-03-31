// Load the jquery
var script = document.createElement("SCRIPT");
script.src = 'https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js';
script.type = 'text/javascript';
document.getElementsByTagName("head")[0].appendChild(script);
var search = location.search.substring(1);
urlParams = JSON.parse('{"' + search.replace(/&/g, '","').replace(/=/g, '":"') + '"}', function (key, value) { return key === "" ? value : decodeURIComponent(value) })
var number_of_item = urlParams['item'];
var current_page = urlParams['pag'];
if (current_page == null) {
    current_page = 1;
}
if (number_of_item == null) {
    number_of_item = 5;
}
function checkReady() {
    return new Promise(async function (resolve) {
        while (!window.jQuery) {
            await new Promise(resolve => setTimeout(resolve, 20));
        }
        resolve();
    })
}
async function loadForFirstTime() {
    await checkReady();
    loadItem();
}
function pagnationBtn() {
    // pagnation
    document.querySelectorAll('.pag').forEach((btn) => btn.addEventListener('click', function () {
        current_page=btn.innerHTML;
        loadItem();
    }));
    if (document.getElementsByClassName('pag-pre').length > 0)
        document.querySelector('.pag-pre').addEventListener('click', function () {
            current_page = Number(document.querySelector('span.active').innerHTML) - 1;
            loadItem(number_of_item, current_page);
        });
    if (document.getElementsByClassName('pag-con').length > 0)
        document.querySelector('.pag-con').addEventListener('click', function () {
            current_page = Number(document.querySelector('span.active').innerHTML) + 1;

            loadItem();
        });
}
function loadItem() {
    $.ajax({
        url: '../controller/admin/pagnation.controller.php',
        type: "post",
        dataType: 'html',
        data: {
            number_of_item: number_of_item,
            current_page: current_page,
            function: "render"
        }
    }).done(function (result) {
        var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?page=' + urlParams['page'] + '&item=' + number_of_item + '&pag=' + current_page ;
        window.history.pushState({path:newurl},'',newurl);
        $('.result').html(result);
        pagnationBtn();
        js();

    })
};
document.addEventListener("DOMContentLoaded", () => {
    loadForFirstTime()
});



//js
var js = function () {
    var edit_btns = document.getElementsByClassName("actions--edit");
    for (var i = 0; i < edit_btns.length; i++) {
        edit_btns[i].addEventListener('click', e => {
            document.querySelector('.modal-edit-product-container').classList.add('show');
            function displayImage(input) {
                const file = input.files[0]; // Lấy ra tệp được chọn từ input file
                const imagePreview = document.getElementById('imagePreview'); // Lấy thẻ img hiển thị trước ảnh

                // Kiểm tra xem đã chọn tệp hình ảnh hay chưa
                if (file) {
                    const reader = new FileReader(); // Tạo một đối tượng FileReader

                    // Thiết lập sự kiện khi FileReader đã đọc xong file
                    reader.onload = function (event) {
                        // Thiết lập thuộc tính src của thẻ img để hiển thị ảnh đã chọn
                        imagePreview.src = event.target.result;
                        imagePreview.style.display = 'block'; // Hiển thị thẻ img
                    };

                    // Đọc nội dung của tệp hình ảnh dưới dạng URL
                    reader.readAsDataURL(file);
                }
            }
            const fileInput = document.getElementById('fileInput');
            fileInput.addEventListener('change', function () {
                displayImage(this); // Gọi hàm displayImage và truyền vào input element
            });

            // Hidden choose img
            const editRadio = document.querySelectorAll('input[name="image"]');
            const chooseImgContainer = document.querySelector('.choose-img');

            editRadio.forEach(function (radio) {
                radio.addEventListener('change', function () {
                    if (this.value === 'edit') {
                        chooseImgContainer.classList.remove('hidden'); // Hiển thị phần chọn ảnh khi chọn "Sửa Hình"
                    } else {
                        chooseImgContainer.classList.add('hidden'); // Ẩn phần chọn ảnh khi chọn các tùy chọn khác
                    }
                });
            });

            // Button close
            const modal_edit_container = document.querySelector("#modal-edit-container");

            const btnClose = document.querySelector("#btnClose");
            // console.log(btnClose)
            btnClose.addEventListener('click', () => {
                // console.log(modal_edit_container)
                modal_edit_container.classList.remove('show')
            });

        });

    }

    // delete

    const del_btns = document.getElementsByClassName("actions--delete");

    for (var i = 0; i < del_btns.length; i++) {
        del_btns[i].addEventListener('click', function () {
            let selected_content = this.parentNode.parentNode;
            let product_id = selected_content.querySelector('.id').innerHTML;
            let product_name = selected_content.querySelector('.name').innerHTML;
            let img_link = selected_content.querySelector('img').src;
            var del_html = `
        <div class="modal-edit-product-container show" id="modal-edit-container">
        <div class="modal-edit-product">
            <div class="modal-header">
                <h3>Xác nhận xóa sản phẩm</h3>
                <button class="btn-close" id="btnClose"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="del-body">
                    <div class="image">
                        <img id="imagePreview" src="${img_link}" alt="image not found">
                    </div>
                    <div class="thongtin">
                        <div><span style="font-weight: bold;">Mã sản phẩm :</span> <span id="product-delete-id">${product_id}</span> </div>
                        <div><span style="font-weight: bold;">Tên sản phẩm :</span> <span>${product_name}</span> </div>
                    </div>
                </div>
                <div class="del-btn-container">
                    <input type="button" value="Hủy" class="del-cancel">
                    <input type="button" value="Xác nhận" class="del-confirm">
                </div>
            </div>
        </div>
    </div>

        `;


            modal.innerHTML = del_html;
            $('.del-confirm').click(function (e) {
                e.preventDefault();
                var $id = $('#product-delete-id').html();
                $.ajax({
                    url: '../controller/admin/product.controller.php',
                    type: "post",
                    dataType: 'html',
                    data: {
                        delete_id: $id
                    }
                }).done(function (result) {
                    selected_content.remove();
                    modal_edit_container.classList.remove('show');
                })
            })

            // Button close
            const modal_edit_container = document.querySelector("#modal-edit-container");

            const btnClose = document.querySelector("#btnClose");
            // console.log(btnClose)
            btnClose.addEventListener('click', () => {
                // console.log(modal_edit_container)
                modal_edit_container.classList.remove('show')
            });
            // Button cancel
            const btnCancel = document.querySelector(".del-cancel");
            // console.log(btnClose)
            btnCancel.addEventListener('click', () => {
                // console.log(modal_edit_container)
                modal_edit_container.classList.remove('show')
            });
        });

    }

}