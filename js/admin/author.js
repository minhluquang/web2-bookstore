  var filter_form = document.querySelector(".admin__content--body__filter");
  function getFilterFromURL() {
      filter_form.querySelector("#authorName").value = (urlParams['name'] != null) ? urlParams['name'] : "";
      filter_form.querySelector("#authorId").value = (urlParams['id'] != null) ? urlParams['id'] : "";
      filter_form.querySelector("#authorEmail").value = (urlParams['email'] != null) ? urlParams['email'] : "";

  }
  function pushFilterToURL() {
      var filter = getAUFilterFromForm();
      var url_key = {
          "author_name": "name",
          "author_id": "id",
          "author_email": "email",

      }
      var url = "";
      Object.keys(filter).forEach(key => {
          url += (filter[key] != null && filter[key] != "") ? `&${url_key[key]}=${filter[key]}` : "";
      });
      return url;
  }
  function getAUFilterFromForm() {
      return {
          "author_name": filter_form.querySelector("#authorName").value,
          "author_id": filter_form.querySelector("#authorId").value,
          "author_email": filter_form.querySelector("#authorEmail").value
      }

  }

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
      getFilterFromURL();
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
    var filter = getAUFilterFromForm();

      $.ajax({
          url: '../controller/admin/pagnation.controller.php',
          type: "post",
          dataType: 'html',
          data: {
              number_of_item: number_of_item,
              current_page: current_page,
              function: "renderAuthor",
              filter: filter
          }
      }).done(function (result) {
          var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?page=' + urlParams['page'] + '&item=' + number_of_item + '&pag=' + current_page ;
          newurl += pushFilterToURL();
          window.history.pushState({path:newurl},'',newurl);
          $('.result').html(result);
          pagnationBtn();
          filterBtn();
          js();

      })
  };
  document.addEventListener("DOMContentLoaded", () => {
      loadForFirstTime()
  });

  function filterBtn() {
    $(".body__filter--action__filter").click((e) => {
        current_page = 1;
        e.preventDefault();
        loadItem();
    })
    $(".body__filter--action__reset").click((e) => {
        current_page = 1;
        $.ajax({
            url: '../controller/admin/pagnation.controller.php',
            type: "post",
            dataType: 'html',
            data: {
                number_of_item: number_of_item,
                current_page: current_page,
                function: "renderAuthor",
            }
        }).done(function (result) {
            var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?page=' + urlParams['page'] + '&item=' + number_of_item + '&current_page=' + current_page;
            window.history.pushState({ path: newurl }, '', newurl);
            $('.result').html(result);
            console.log(result);
            pagnationBtn();
            js();
        })
    })
  }
  const js = function () {


    const editModal = document.getElementById("editModal");
    const editModalContent = document.querySelector(".editModal-content .form");
    const editFunctionButton = document.querySelector(".editFunctionButton");
    const editAuthorButton = document.querySelector(".editAuthorButton");
    const closeEditIcon = document.querySelector(".editModal-content .close i");
    
    const deleteModal = document.getElementById("deleteModal");
    const deleteModalContent = document.querySelector(".deleteModal-content .form");
    const deleteAuthorButton = document.querySelector(".deleteAuthorButton");
    const closeDeleteIcon = document.querySelector(".deleteModal-content .close i");

    const editHtml = `
      <h2>Chỉnh sửa thông tin tác giả</h2>
      <form id="form">
        <div class="input-field">
          <label for="editAuthorId">Mã tác giả</label>
          <input type="text" id="editAuthorId" readonly>
        </div>
        <div class="input-field">
          <label for="editAuthorName">Tên tác giả</label>
          <input type="text" id="editAuthorName">
        </div>
        <div class="input-field">
          <label for="editAuthorEmail">Email</label>
          <input type="email" id="editAuthorEmail">
        </div>
        <div class="input-field">
          <label for="editAuthorRole">Thể loại viết</label>
          <input type="text" id="editAuthorGenres" readonly>
        </div>
      </form>
    `;

    const deleteHtml = `
      <h2>Xác nhận xóa thông tin tác giả</h2>
      <form id="form">
        <label for="editAuthorId">Mã tác giả</label>
        <div id="author-delete-id"></div>
        <label for="editAuthorName">Tên tác giả</label>
        <div id="author-delete-name"></div>
        <label for="editAuthorEmail">Email</label>

        <div id="author-delete-email"></div>
        <div class="form-actions">
          <button type="submit" class="del-confirm">Xác nhận</button>
          <button type="button" class="del-cancel">Hủy bỏ</button>
        </div>
      </form>`;

    const renderModalEditInfoAuthor = (authorId, authorName, authorEmail) => {
      editModalContent.innerHTML = editHtml;
      document.getElementById("editAuthorId").value = authorId;
      document.getElementById("editAuthorName").value = authorName;
      document.getElementById("editAuthorEmail").value = authorEmail;
      editModal.style.display = "block";
    };

    const showConfirmDeleteModal = (authorId, authorName, authorEmail) => {
      deleteModalContent.innerHTML = deleteHtml;

      document.querySelector("#author-delete-id").textContent = authorId;
      document.querySelector("#author-delete-name").textContent = authorName;
      document.querySelector("#author-delete-email").textContent = authorEmail;
      deleteModal.style.display = "block";

    };

    const hideConfirmDeleteModal = () => {
      deleteModal.style.display = "none";
    };
    editAuthorButton.addEventListener("click", (e) => {
      e.preventDefault();
      renderModalEditInfoAuthor("sampleId", "sampleName", "sample@email.com");
      editFunctionButton.classList.remove("d-none");
      editAuthorButton.classList.add("d-none");
    });
    

    closeEditIcon.addEventListener("click", () => {
      editModal.style.display = "none";
    });
    closeDeleteIcon.addEventListener("click", () => {
      deleteModal.style.display = "none";
    });
    window.addEventListener("click", (event) => {
      if (event.target === editModal) {
        editModal.style.display = "none";
      }
    });

    const edit_btns = document.getElementsByClassName("actions--edit");
    for (let i = 0; i < edit_btns.length; i++) {
      edit_btns[i].addEventListener("click", () => {
        let selected_content = edit_btns[i].parentNode.parentNode;
        let author_id = selected_content.querySelector(".id").innerHTML;
        let author_name = selected_content.querySelector(".name").innerHTML;
        let author_email = selected_content.querySelector(".email").innerHTML;
        renderModalEditInfoAuthor(author_id, author_name, author_email);
      });
    }

    /*const del_btns = document.getElementsByClassName("actions--delete");
    for (let i = 0; i < del_btns.length; i++) {
      del_btns[i].addEventListener("click", () => {

        let selected_content = del_btns[i].parentNode.parentNode;
        let author_id = selected_content.querySelector(".id").innerHTML;
        let author_name = selected_content.querySelector(".name").innerHTML;
        let author_email = selected_content.querySelector(".email").innerHTML;
        showConfirmDeleteModal(author_id, author_name, author_email);
      });
    

    const btnConfirmDelete = document.querySelector("#deleteModal .del-confirm");
    btnConfirmDelete.addEventListener("click", (e) => {
      e.preventDefault();
      var $id = $('#author-delete-id').html();
      // Lấy mã tác giả từ modal xác nhận xóa
      // Gửi yêu cầu AJAX để xóa tác giả
      $.ajax({
        url: '../controller/admin/author.controller.php',
        type: 'post',
        dataType: 'html',
        data: {
          function: 'delete',
          id: $id 
        }
      }).done(function (result) {
        // Xử lý kết quả trả về từ server
        loadItem(); // Gọi hàm loadItem() để tải lại danh sách tác giả sau khi xóa
        $("#result").html(result); // Hiển thị kết quả từ server (nếu cần)
        hideConfirmDeleteModal(); // Ẩn modal sau khi xóa thành công
        modal.classList.remove('show');
      }).fail(function (xhr, status, error) {
        // Xử lý lỗi nếu có
        console.error(xhr.responseText); // Log lỗi ra console nếu cần
        alert('Đã xảy ra lỗi khi xóa tác giả.'); // Hiển thị thông báo lỗi
      });
    });
  } 

    const btnCancelDelete = document.querySelector("#deleteModal .del-cancel");
    btnCancelDelete.addEventListener("click", () => {
      hideConfirmDeleteModal();
    });

    const btnCloseDelModal = document.querySelector("#deleteModal .btn-close i");
    btnCloseDelModal.addEventListener("click", () => {
      hideConfirmDeleteModal();
    });*/
  };






