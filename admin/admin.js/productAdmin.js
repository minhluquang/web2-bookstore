const edit = document.querySelector('#edit');
const modal = document.querySelector('#modal')

const html = `
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

edit.addEventListener('click', e => {
    modal.innerHTML = html;

    document.addEventListener("DOMContentLoaded", function () {
      const fileInput = document.getElementById('fileInput');
      const imagePreview = document.getElementById('imagePreview');
  
      fileInput.addEventListener('change', function (event) {
          const file = event.target.files[0];
          if (file) {
              const reader = new FileReader();
              reader.onload = function (e) {
                  imagePreview.src = e.target.result;
                  imagePreview.style.display = 'block';
              };
              reader.readAsDataURL(file);
          }
      });
  });
  
  // Hidden choose img
  const editRadio = document.querySelectorAll('input[name="image"]');
  const chooseImgContainer = document.querySelector('.choose-img');
  
  editRadio.forEach(function(radio) {
  radio.addEventListener('change', function() {
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

  


  


 