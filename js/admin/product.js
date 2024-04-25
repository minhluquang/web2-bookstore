var filter_form = document.querySelector(".admin__content--body__filter");
function getFilterFromURL() {
    filter_form.querySelector("#productName").value = (urlParams['name'] != null) ? urlParams['name'] : "";
    filter_form.querySelector("#productId").value = (urlParams['id'] != null) ? urlParams['id'] : "";
    filter_form.querySelector("#categorySelect").value = (urlParams['category'] != null) ? urlParams['category'] : "";
    filter_form.querySelector("#cateDateSelect").value = (urlParams['date_type'] != null) ? urlParams['date_type'] : "";
    filter_form.querySelector("#date_start").value = (urlParams['date_start'] != null) ? urlParams['date_start'] : "";
    filter_form.querySelector("#date_end").value = (urlParams['date_end'] != null) ? urlParams['date_end'] : "";
    filter_form.querySelector("#price_start").value = (urlParams['price_start'] != null) ? urlParams['price_start'] : "";
    filter_form.querySelector("#price_end").value = (urlParams['price_end'] != null) ? urlParams['price_end'] : "";
}
function pushFilterToURL() {
    var filter = getFilterFromForm();
    var url_key = {
        "product_name": "name",
        "product_id": "id",
        "product_category": "category",
        "product_date_type": "date_type",
        "product_date_start": "date_start",
        "product_date_end": "date_end",
        "product_price_start": "price_start",
        "product_price_end": "price_end",
    }
    var url = "";
    Object.keys(filter).forEach(key => {
        url += (filter[key] != null && filter[key] != "") ? `&${url_key[key]}=${filter[key]}` : "";
    });
    return url;
}
function getFilterFromForm() {
    return {
        "product_name": filter_form.querySelector("#productName").value,
        "product_id": filter_form.querySelector("#productId").value,
        "product_category": filter_form.querySelector("#categorySelect").value,
        "product_date_type": filter_form.querySelector("#cateDateSelect").value,
        "product_date_start": filter_form.querySelector("#date_start").value,
        "product_date_end": filter_form.querySelector("#date_end").value,
        "product_price_start": filter_form.querySelector("#price_start").value,
        "product_price_end": filter_form.querySelector("#price_end").value,
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
var current_page = urlParams['current_page'];
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
    $.ajax({
        url: '../controller/admin/product.controller.php',
        type: "post",
        dataType: 'html',
        data: {
            function: "getCategories"
        }
    }).done(function (result) {
        document.querySelector(".admin__content--body__filter").querySelector("#categorySelect").innerHTML = result;
    })

}
function pagnationBtn() {
    // pagnation
    document.querySelectorAll('.pag').forEach((btn) => btn.addEventListener('click', function () {
        current_page = btn.innerHTML;
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
    var filter = getFilterFromForm();
    $.ajax({
        url: '../controller/admin/pagnation.controller.php',
        type: "post",
        dataType: 'html',
        data: {
            number_of_item: number_of_item,
            current_page: current_page,
            function: "getRecords",
            filter: filter
        }
    }).done(function (result) {
        if (current_page > parseInt(result)) current_page = parseInt(result)
        if (current_page < 1) current_page = 1;
        $.ajax({
            url: '../controller/admin/pagnation.controller.php',
            type: "post",
            dataType: 'html',
            data: {
                number_of_item: number_of_item,
                current_page: current_page,
                function: "render",
                filter: filter
            }
        }).done(function (result) {

            var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?page=' + urlParams['page'] + '&item=' + number_of_item + '&current_page=' + current_page;
            newurl += pushFilterToURL();
            window.history.pushState({ path: newurl }, '', newurl);
            $('.result').html(result);
            // console.log(result)
            pagnationBtn();
            filterBtn();
            js();
        })
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
                function: "render",
            }
        }).done(function (result) {
            var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?page=' + urlParams['page'] + '&item=' + number_of_item + '&current_page=' + current_page;
            window.history.pushState({ path: newurl }, '', newurl);
            $('.result').html(result);
            pagnationBtn();
            js();
        })
    })
}

//js
var js = function () {
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
    var multiselect_category = [];
    var multiselect_author = [];
    const multiselect = document.querySelector("#multiselect");
    const multiselect_html = `<div class="modal-edit-product-container show" id="modal-edit-container">
    <div class="modal-edit-product">
        <div class="modal-header">
            <h3 id="multiselect-header"></h3>
            <button class="btn-close" id="btnClose"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="modal-body">
            <div id="multiselect-main">
                <div class="body-header">
                    <span id="modal-header">Đã chọn:</span>
                </div>
                <div class="multiselect-body" id="multiselect-selected"></div>
                <div class="body-header">
                    <span id="modal-header">Còn lại:</span>
                    <input type="text">
                </div>
                <div class="multiselect-body" id="multiselect-available"></div>
            </div>
            <input type="reset" value="Reset" class="button-cancel">
            <input type="submit" value="Xác nhận" class="button-confirm">
        </div>
    </div>
</div>`;
    var category_content = "";
    var author_content = "";
    const modal_html = `<div class="modal-edit-product-container show" id="modal-edit-container">
        <div class="modal-edit-product">
            <div class="modal-header">
                <h3 id="modal-header"></h3>
                <button class="btn-close" id="btnClose"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="edit-image">
                        <div id="choose-img-select">
                            <input type="radio" id="retain" value="retain" name="image" checked>
                            <label for="retain">Giữ Hình</label>
                            <input type="radio" id="edit" value="edit" name="image">
                            <label for="edit">Sửa Hình</label>
                        </div>
                        <div class="choose-img hidden">
                            <label for="fileInput">Chọn hình ảnh:</label>
                            <div class="img">
                                <img id="imagePreview" src="#" alt="Ảnh xem trước" style="display: none;">
                            </div>
                            <input type="file" name="choose-img" id="fileInput">
                        </div>

                    </div>
                    <div class="modal-body-2">
                        <div class="flex">
                            <label for="name">Tên sản phẩm</label>
                            <input id="name" type="text" add-index="2" placeholder="Tên sản phẩm">
                        </div>
                        <div class="flex">
                            <label for="price">Giá sản phẩm</label>
                            <input id="price" type="text" add-index="3" placeholder="Giá sản phẩm">
                        </div>
                        <div class="flex">
                            <label for="quantity">Số lượng</label>
                            <input id="quantity" type="text" add-index="4" placeholder="Số lượng">
                        </div>
                        <div class="flex">
                            <label for="publisher_id">Nhà xuất bản</label>
                            <select id="publisher_id">
                            </select>
                        </div>
                        <div class="flex">
                            <span style="display:flex;">
                                <label for="categorySelect" style="flex: 50%">Thể loại</label>
                                <button type="button" class="open-multiselect" id="category-multiselect">Thêm</button>
                            </span>
                            <span id="category-amount" style="padding:5px 0px 0px 5px;">Đã chọn 0 thể loại</span>
                        </div>
                        <div class="flex">
                        <span style="display:flex;">
                                <label for="categorySelect" style="flex: 50%">Tác giả</label>
                                <button type="button" class="open-multiselect" id="author-multiselect">Thêm</button>
                            </span>
                            <span id="author-amount" style="padding:5px 0px 0px 5px;">Đã chọn 0 tác giả</span>
                            <!-- <label for="author">Tác giả</label>
                            <select id="author">
                            </select> -->
                        </div>
                    </div>
                    <input type="reset" value="Hủy" class="button-cancel">
                    <input type="submit" value="Xác nhận" class="button-confirm" >
                </form>
            </div>
        </div>
    </div>`;
    const modal = document.querySelector("#modal");

    document.querySelector(".body__filter--action__add").addEventListener("click", (e) => {
        modal.innerHTML = modal_html;
        multiselect_category = [];
        multiselect_author = [];
        const modal_edit_container = modal.querySelector("#modal-edit-container");
        modal.querySelector('#choose-img-select').remove();
        modal.querySelector('.choose-img').classList.remove("hidden");
        modal.querySelector('#modal-header').innerHTML= "Thêm sản phẩm";

        $.ajax({
            url: '../controller/admin/product.controller.php',
            type: "post",
            dataType: 'html',
            data: {
                function: "getCategories"
            }
        }).done(function (result) {
            // <span class="multiselect-content" value=1>Tâm lý học<i class="fa-solid fa-xmark cancel-multiselect"></i></span>
            category_content = result.replace("<option value=''>Chọn thể loại</option>", "").replace(/option/gi, "span").replace(/<span value/gi, '<span class="multiselect-content" data-value').replace(/<\/span>/gi, '<i class="fa-solid fa-xmark cancel-multiselect"></i></span>');
        })
        $.ajax({
            url: '../controller/admin/product.controller.php',
            type: "post",
            dataType: 'html',
            data: {
                function: "getAuthors"
            }
        }).done(function (result) {
            author_content = result.replace("<option value=''>Chọn tác giả</option>", "").replace(/option/gi, "span").replace(/<span value/gi, '<span class="multiselect-content" data-value').replace(/<\/span>/gi, '<i class="fa-solid fa-xmark cancel-multiselect"></i></span>');
        })
        $.ajax({
            url: '../controller/admin/product.controller.php',
            type: "post",
            dataType: 'html',
            data: {
                function: "getPublishers"
            }
        }).done(function (result) {
            document.querySelector("#modal").querySelector("#publisher_id").innerHTML = result;
        })
        modal.querySelector('.button-confirm').addEventListener('click', function (e) {
            e.preventDefault();
            $.ajax({
                url: '../controller/admin/product.controller.php',
                type: "post",
                dataType: 'html',
                data: {
                    function: "create",
                    field: {
                        id:  0 ,
                        name: modal.querySelector('#name').value,
                        publisher_id: modal.querySelector('#publisher_id').value,
                        image: document.getElementById('imagePreview').src,
                        quantity: modal.querySelector('#quantity').value,
                        price: modal.querySelector('#price').value,
                        category: multiselect_category,
                        author: multiselect_author,
                    }
                }
            }).done(function (result) {
                loadItem();
                $("#sqlresult").html(result);
            })
            modal_edit_container.classList.add('hidden')
        });
        modal.querySelector("#btnClose").addEventListener('click', () => {
            modal_edit_container.classList.add('hidden')
        });
        modal.querySelector('.button-cancel').addEventListener('click', function (e) {
            modal_edit_container.classList.add('hidden');
        });
        $("#modal").on('keydown', 'input', function (event) {
            if (event.which == 13) {
                event.preventDefault();
                var $this = $(event.target);
                var index = parseFloat($this.attr('add-index'));
                $('[add-index="' + (index + 1).toString() + '"]').focus();
            }
        });
        modal.querySelectorAll('select').forEach((select) => select.addEventListener('change', function (e) {
            var index = parseFloat(select.getAttribute('add-index'))
            $('[add-index="' + (index + 1).toString() + '"]').focus();
        }))
        const fileInput = document.getElementById('fileInput');
        fileInput.addEventListener('change', function () {
            displayImage(this); // Gọi hàm displayImage và truyền vào input element
        });

        modal.querySelector("#category-multiselect").addEventListener("click", () => {
            multiselect.innerHTML = multiselect_html;
            multiselect.querySelector("#btnClose").addEventListener('click', () => {
                multiselect.querySelector("#modal-edit-container").classList.add('hidden')
            });
            multiselect.querySelector(".button-cancel").addEventListener('click', () => {
                multiselect.querySelector("#multiselect-selected").querySelectorAll('.multiselect-content').forEach( function (select) {
                    multiselect.querySelector("#multiselect-selected").querySelector('[data-value="' + select.getAttribute("data-value").toString() + '"]').classList.add("hidden")
                    multiselect.querySelector("#multiselect-available").querySelector('[data-value="' + select.getAttribute("data-value").toString() + '"]').classList.remove("hidden")
                })
            });
            multiselect.querySelector("#multiselect-header").innerHTML = "Chọn thể loại";
            multiselect.querySelector("#multiselect-selected").innerHTML = category_content.replace(/class="multiselect-content"/gi, 'class="multiselect-content hidden"');
            multiselect.querySelector("#multiselect-available").innerHTML = category_content;
            multiselect.querySelector("#multiselect-selected").querySelectorAll('.multiselect-content').forEach((select) => select.addEventListener('click', function () {
                multiselect.querySelector("#multiselect-selected").querySelector('[data-value="' + this.getAttribute("data-value").toString() + '"]').classList.add("hidden")
                multiselect.querySelector("#multiselect-available").querySelector('[data-value="' + this.getAttribute("data-value").toString() + '"]').classList.remove("hidden")
            }))
            multiselect.querySelector("#multiselect-available").querySelectorAll('.multiselect-content').forEach((select) => select.addEventListener('click', function () {
                multiselect.querySelector("#multiselect-selected").querySelector('[data-value="' + this.getAttribute("data-value").toString() + '"]').classList.remove("hidden")
                multiselect.querySelector("#multiselect-available").querySelector('[data-value="' + this.getAttribute("data-value").toString() + '"]').classList.add("hidden")
            }))
            multiselect_category.forEach(function (select) {
                multiselect.querySelector("#multiselect-selected").querySelector('[data-value="' + select.toString() + '"]').classList.remove("hidden")
                multiselect.querySelector("#multiselect-available").querySelector('[data-value="' + select.toString() + '"]').classList.add("hidden")
            })
            multiselect.querySelector('.button-confirm').addEventListener('click', function (e) {
                e.preventDefault();
                multiselect_category = []
                multiselect.querySelector("#multiselect-selected").querySelectorAll('.multiselect-content').forEach(function (select) {
                    if (!select.classList.contains("hidden")) multiselect_category.push(select.getAttribute("data-value"))
                })
                multiselect.querySelector("#modal-edit-container").classList.add('hidden')
                modal.querySelector("#category-amount").innerHTML = "Đã chọn "+multiselect_category.length.toString()+" thể loại";
            })
        })
        modal.querySelector("#author-multiselect").addEventListener("click", () => {
            multiselect.innerHTML = multiselect_html;
            multiselect.querySelector("#btnClose").addEventListener('click', () => {
                multiselect.querySelector("#modal-edit-container").classList.add('hidden')
            });
            multiselect.querySelector(".button-cancel").addEventListener('click', () => {
                multiselect.querySelector("#multiselect-selected").querySelectorAll('.multiselect-content').forEach( function (select) {
                    multiselect.querySelector("#multiselect-selected").querySelector('[data-value="' + select.getAttribute("data-value").toString() + '"]').classList.add("hidden")
                    multiselect.querySelector("#multiselect-available").querySelector('[data-value="' + select.getAttribute("data-value").toString() + '"]').classList.remove("hidden")
                })
            });
            multiselect.querySelector("#multiselect-header").innerHTML = "Chọn thể loại";
            multiselect.querySelector("#multiselect-selected").innerHTML = author_content.replace(/class="multiselect-content"/gi, 'class="multiselect-content hidden"');
            multiselect.querySelector("#multiselect-available").innerHTML = author_content;
            multiselect.querySelector("#multiselect-selected").querySelectorAll('.multiselect-content').forEach((select) => select.addEventListener('click', function () {
                multiselect.querySelector("#multiselect-selected").querySelector('[data-value="' + this.getAttribute("data-value").toString() + '"]').classList.add("hidden")
                multiselect.querySelector("#multiselect-available").querySelector('[data-value="' + this.getAttribute("data-value").toString() + '"]').classList.remove("hidden")
            }))
            multiselect.querySelector("#multiselect-available").querySelectorAll('.multiselect-content').forEach((select) => select.addEventListener('click', function () {
                multiselect.querySelector("#multiselect-selected").querySelector('[data-value="' + this.getAttribute("data-value").toString() + '"]').classList.remove("hidden")
                multiselect.querySelector("#multiselect-available").querySelector('[data-value="' + this.getAttribute("data-value").toString() + '"]').classList.add("hidden")
            }))
            multiselect_author.forEach(function (select) {
                multiselect.querySelector("#multiselect-selected").querySelector('[data-value="' + select.toString() + '"]').classList.remove("hidden")
                multiselect.querySelector("#multiselect-available").querySelector('[data-value="' + select.toString() + '"]').classList.add("hidden")
            
            })
            multiselect.querySelector('.button-confirm').addEventListener('click', function (e) {
                e.preventDefault();
                multiselect_author = []
                multiselect.querySelector("#multiselect-selected").querySelectorAll('.multiselect-content').forEach(function (select) {
                    if (!select.classList.contains("hidden")) multiselect_author.push(select.getAttribute("data-value"))
                })
                multiselect.querySelector("#modal-edit-container").classList.add('hidden')
                modal.querySelector("#author-amount").innerHTML = "Đã chọn "+multiselect_author.length.toString()+" tác giả";
            })
        })
    });
    var edit_btns = document.getElementsByClassName("actions--edit");
    for (var i = 0; i < edit_btns.length; i++) {
        edit_btns[i].addEventListener('click', function () {
            // modal.innerHTML = create_html;
            // const modal_edit_container = document.querySelector("#modal-edit-container");
            multiselect_category = this.parentNode.parentNode.querySelector(".type").getAttribute("value").replace(/[\[ \]]/gi,"").split(",");
            multiselect_author = this.parentNode.parentNode.querySelector(".author").getAttribute("value").replace(/[\[ \]]/gi,"").split(",");
            var publisher_value = this.parentNode.parentNode.querySelector(".id").getAttribute("publisher_id");
            var id = this.parentNode.parentNode.querySelector(".id").innerHTML;
            $.ajax({
                url: '../controller/admin/product.controller.php',
                type: "post",
                dataType: 'html',
                data: {
                    function: "getCategories"
                }
            }).done(function (result) {
                // <span class="multiselect-content" value=1>Tâm lý học<i class="fa-solid fa-xmark cancel-multiselect"></i></span>
                category_content = result.replace("<option value=''>Chọn thể loại</option>", "").replace(/option/gi, "span").replace(/<span value/gi, '<span class="multiselect-content" data-value').replace(/<\/span>/gi, '<i class="fa-solid fa-xmark cancel-multiselect"></i></span>');
            })
            $.ajax({
                url: '../controller/admin/product.controller.php',
                type: "post",
                dataType: 'html',
                data: {
                    function: "getAuthors"
                }
            }).done(function (result) {
                author_content = result.replace("<option value=''>Chọn tác giả</option>", "").replace(/option/gi, "span").replace(/<span value/gi, '<span class="multiselect-content" data-value').replace(/<\/span>/gi, '<i class="fa-solid fa-xmark cancel-multiselect"></i></span>');
            })
            $.ajax({
                url: '../controller/admin/product.controller.php',
                type: "post",
                dataType: 'html',
                data: {
                    function: "getPublishers"
                }
            }).done(function (result) {
                modal.querySelector("#publisher_id").innerHTML = result;
                modal.querySelector('#publisher_id').value = publisher_value;

            })
            modal.innerHTML = modal_html;
            modal.querySelector('#name').value = this.parentNode.parentNode.querySelector(".name").innerHTML;
            modal.querySelector('#quantity').value = this.parentNode.parentNode.querySelector(".amount").innerHTML;
            modal.querySelector('#price').value = this.parentNode.parentNode.querySelector(".price").innerHTML.replace(/[₫.]+/g, '');
            modal.querySelector('#modal-header').innerHTML= "Sửa sản phẩm mã "+this.parentNode.parentNode.querySelector(".id").innerHTML;
            modal.querySelector("#category-amount").innerHTML = "Đã chọn "+multiselect_category.length.toString()+" thể loại";
            modal.querySelector("#author-amount").innerHTML = "Đã chọn "+multiselect_author.length.toString()+" tác giả";

            const fileInput = document.getElementById('fileInput');
            fileInput.addEventListener('change', function () {
                displayImage(this); // Gọi hàm displayImage và truyền vào input element
            });

            // Hidden choose img
            const editRadio = modal.querySelectorAll('input[name="image"]');
            const chooseImgContainer = modal.querySelector('.choose-img');

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
            const modal_edit_container = modal.querySelector("#modal-edit-container");
            modal.querySelector("#btnClose").addEventListener('click', () => {
                modal_edit_container.classList.remove('show')
            });
            modal.querySelector('.button-cancel').addEventListener('click', function (e) {
                modal_edit_container.classList.add('hidden');
            });
            modal.querySelector("#category-multiselect").addEventListener("click", () => {
                multiselect.innerHTML = multiselect_html;
                multiselect.querySelector("#btnClose").addEventListener('click', () => {
                    multiselect.querySelector("#modal-edit-container").classList.add('hidden')
                });
                multiselect.querySelector(".button-cancel").addEventListener('click', () => {
                    multiselect.querySelector("#multiselect-selected").querySelectorAll('.multiselect-content').forEach( function (select) {
                        multiselect.querySelector("#multiselect-selected").querySelector('[data-value="' + select.getAttribute("data-value").toString() + '"]').classList.add("hidden")
                        multiselect.querySelector("#multiselect-available").querySelector('[data-value="' + select.getAttribute("data-value").toString() + '"]').classList.remove("hidden")
                    })
                });
                multiselect.querySelector("#multiselect-header").innerHTML = "Chọn thể loại";
                multiselect.querySelector("#multiselect-selected").innerHTML = category_content.replace(/class="multiselect-content"/gi, 'class="multiselect-content hidden"');
                multiselect.querySelector("#multiselect-available").innerHTML = category_content;
                multiselect.querySelector("#multiselect-selected").querySelectorAll('.multiselect-content').forEach((select) => select.addEventListener('click', function () {
                    multiselect.querySelector("#multiselect-selected").querySelector('[data-value="' + this.getAttribute("data-value").toString() + '"]').classList.add("hidden")
                    multiselect.querySelector("#multiselect-available").querySelector('[data-value="' + this.getAttribute("data-value").toString() + '"]').classList.remove("hidden")
                }))
                multiselect.querySelector("#multiselect-available").querySelectorAll('.multiselect-content').forEach((select) => select.addEventListener('click', function () {
                    multiselect.querySelector("#multiselect-selected").querySelector('[data-value="' + this.getAttribute("data-value").toString() + '"]').classList.remove("hidden")
                    multiselect.querySelector("#multiselect-available").querySelector('[data-value="' + this.getAttribute("data-value").toString() + '"]').classList.add("hidden")
                }))
                multiselect_category.forEach(function (select) {
                    multiselect.querySelector("#multiselect-selected").querySelector('[data-value="' + select.toString() + '"]').classList.remove("hidden")
                    multiselect.querySelector("#multiselect-available").querySelector('[data-value="' + select.toString() + '"]').classList.add("hidden")
                })
                multiselect.querySelector('.button-confirm').addEventListener('click', function (e) {
                    e.preventDefault();
                    multiselect_category = []
                    multiselect.querySelector("#multiselect-selected").querySelectorAll('.multiselect-content').forEach(function (select) {
                        if (!select.classList.contains("hidden")) multiselect_category.push(select.getAttribute("data-value"))
                    })
                    multiselect.querySelector("#modal-edit-container").classList.add('hidden')
                    modal.querySelector("#category-amount").innerHTML = "Đã chọn "+multiselect_category.length.toString()+" thể loại";
                })
            })
            modal.querySelector("#author-multiselect").addEventListener("click", () => {
                multiselect.innerHTML = multiselect_html;
                multiselect.querySelector("#btnClose").addEventListener('click', () => {
                    multiselect.querySelector("#modal-edit-container").classList.add('hidden')
                });
                multiselect.querySelector(".button-cancel").addEventListener('click', () => {
                    multiselect.querySelector("#multiselect-selected").querySelectorAll('.multiselect-content').forEach( function (select) {
                        multiselect.querySelector("#multiselect-selected").querySelector('[data-value="' + select.getAttribute("data-value").toString() + '"]').classList.add("hidden")
                        multiselect.querySelector("#multiselect-available").querySelector('[data-value="' + select.getAttribute("data-value").toString() + '"]').classList.remove("hidden")
                    })
                });
                multiselect.querySelector("#multiselect-header").innerHTML = "Chọn thể loại";
                multiselect.querySelector("#multiselect-selected").innerHTML = author_content.replace(/class="multiselect-content"/gi, 'class="multiselect-content hidden"');
                multiselect.querySelector("#multiselect-available").innerHTML = author_content;
                multiselect.querySelector("#multiselect-selected").querySelectorAll('.multiselect-content').forEach((select) => select.addEventListener('click', function () {
                    multiselect.querySelector("#multiselect-selected").querySelector('[data-value="' + this.getAttribute("data-value").toString() + '"]').classList.add("hidden")
                    multiselect.querySelector("#multiselect-available").querySelector('[data-value="' + this.getAttribute("data-value").toString() + '"]').classList.remove("hidden")
                }))
                multiselect.querySelector("#multiselect-available").querySelectorAll('.multiselect-content').forEach((select) => select.addEventListener('click', function () {
                    multiselect.querySelector("#multiselect-selected").querySelector('[data-value="' + this.getAttribute("data-value").toString() + '"]').classList.remove("hidden")
                    multiselect.querySelector("#multiselect-available").querySelector('[data-value="' + this.getAttribute("data-value").toString() + '"]').classList.add("hidden")
                }))
                multiselect_author.forEach(function (select) {
                    multiselect.querySelector("#multiselect-selected").querySelector('[data-value="' + select.toString() + '"]').classList.remove("hidden")
                    multiselect.querySelector("#multiselect-available").querySelector('[data-value="' + select.toString() + '"]').classList.add("hidden")
                
                })
                multiselect.querySelector('.button-confirm').addEventListener('click', function (e) {
                    e.preventDefault();
                    multiselect_author = []
                    multiselect.querySelector("#multiselect-selected").querySelectorAll('.multiselect-content').forEach(function (select) {
                        if (!select.classList.contains("hidden")) multiselect_author.push(select.getAttribute("data-value"))
                    })
                    multiselect.querySelector("#modal-edit-container").classList.add('hidden')
                    modal.querySelector("#author-amount").innerHTML = "Đã chọn "+multiselect_author.length.toString()+" tác giả";
                })
            })
            // confirm edit
            modal.querySelector('.button-confirm').addEventListener('click', function (e) {
                e.preventDefault();
                image = document.getElementById('imagePreview').src;
                if (chooseImgContainer.classList.contains("hidden")) image = ""
                $.ajax({
                    url: '../controller/admin/product.controller.php',
                    type: "post",
                    dataType: 'html',
                    data: {
                        function: "edit",
                        field: {
                            id: id,
                            name: modal.querySelector('#name').value,
                            publisher_id: modal.querySelector('#publisher_id').value,
                            image: image,
                            quantity: modal.querySelector('#quantity').value,
                            price: modal.querySelector('#price').value,
                            category: multiselect_category,
                            author: multiselect_author,
                        }
                    }
                }).done(function (result) {
                    loadItem();
                    $("#sqlresult").html(result);
                })
                modal_edit_container.classList.add('hidden')
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
                        function: "delete",
                        id: $id
                    }
                }).done(function (result) {
                    loadItem();
                    $("#sqlresult").html(result);
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