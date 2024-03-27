var edit_btns = document.getElementsByClassName("actions--edit");
const modal = document.querySelector('#modal')

const edit_html = `
<div class="modal-edit-product-container show" id="modal-edit-container">
<div class="modal-edit-product">
    <div class="modal-header">
        <h3>Thay Đổi thông tin sản phẩm</h3>
        <button class="btn-close" id="btnClose" ><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body">
        <form action="">
            <div class="edit-image">
                <h4>Hình ảnh</h4>
                <input type="radio" id="delete" value="delete" name="image">
                <label for="delete">Xóa Hình</label>
                <input type="radio" id="edit" value="edit" name="image">
                <label for="edit">Sửa Hình</label>
                <input type="radio" id="retain" value="retain" name="image">
                <label for="retain">Giữ Hình</label>
                <div class="choose-img hidden">
                    <label for="choose-img">Chọn hình ảnh:</label>
                    <div class="img">
                        <img id="imagePreview" src="#" alt="Ảnh xem trước" style="display: none;">
                    </div>

                    <input type="file" name="choose-img" id="fileInput">
                </div>

            </div>
            <div class="modal-body-2">
                <div class="edit-name">
                    <label for="">Tên sản phẩm</label>
                    <input type="text" value="Tên sản phẩm">
                </div>
                <div class="edit-category">
                    <label for="">Thể loại</label>
                    <select name="" id="">
                        <option value="science">Khoa học</option>
                        <option value="psychology">Tâm Lý</option>
                        <option value="novel">Tiểu thuyết</option>
                    </select>
                </div>
                <div class="edit-price">
                    <label for="">Giá sản phẩm</label>
                    <input type="text" value="Giá sản phẩm">
                </div>
                <div class="edit-id">
                    <label for="">Mã sản phẩm</label>
                    <input type="text" value="Mã sản phẩm">
                </div>
                <div class="edit-date-create">
                    <label for="">Ngày Tạo</label>
                    <input type="date" value="dateCreate">
                </div>
                <div class="edit-date-update">
                    <label for="">Ngày cập nhật</label>
                    <input type="date" value="dateUpdate">
                </div>

            </div>
            <div>
            </div>

            <input type="submit" value="Xác nhận" class="btn-confirm" >
        </form>
    </div>
</div>
</div>
`


for (var i = 0; i < edit_btns.length; i++) {
    edit_btns[i].addEventListener('click', e => {
        modal.innerHTML = edit_html;
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
        console.log(btnClose)
        btnClose.addEventListener('click', () => {
            console.log(modal_edit_container)
            modal_edit_container.classList.remove('show')
        });

    });

}

// delete

const del_btns = document.getElementsByClassName("actions--delete");


for (var i = 0; i < del_btns.length; i++) {
    // del_btns[i].addEventListener('click',function(){
    //     alert(this.parentNode);
    // });
    del_btns[i].addEventListener('click', function (){
        let product_id=this.parentNode.parentNode.querySelector('.id').innerHTML;
        let product_name=this.parentNode.parentNode.querySelector('.name').innerHTML;
        let img_link=this.parentNode.parentNode.querySelector('img').src;
        var del_html = `
        <div class="modal-edit-product-container show" id="modal-edit-container">
        <div class="modal-edit-product">
            <div class="modal-header">
                <h3>Xác nhận xóa sản phẩm</h3>
                <button class="btn-close" id="btnClose"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <form action="public/product_del.php?id=${product_id}"class="del-body" method=""GET>
                    <div class="image">
                        <img id="imagePreview" src="${img_link}" alt="image not found">
                    </div>
                    <div class="thongtin">
                        <div><span style="font-weight: bold;">Mã sản phẩm :</span> <span>${product_id}</span> </div>
                        <div><span style="font-weight: bold;">Tên sản phẩm :</span> <span>${product_name}</span> </div>
                    </div>
                    <input type="hidden" value="${product_id}" name="id"/>

                    <div class="del-btn-container">
                        <input type="button" value="Hủy" class="del-cancel">
                        <input type="submit" value="Xác nhận" class="del-confirm">
                    </div>

                </form>
            </div>
        </div>
    </div>

        `;
        

        modal.innerHTML = del_html;


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
