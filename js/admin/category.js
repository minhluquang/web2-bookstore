var filter_form = document.querySelector(".admin__content--body__filter");
function getFilterFromURL() {
    filter_form.querySelector("#categoryName").value = (urlParams['name'] != null) ? urlParams['name'] : "";
    filter_form.querySelector("#categoryId").value = (urlParams['id'] != null) ? urlParams['id'] : "";
    filter_form.querySelector("#cateDateSelect").value = (urlParams['date_type'] != null) ? urlParams['date_type'] : "";
    filter_form.querySelector("#date_start").value = (urlParams['date_start'] != null) ? urlParams['date_start'] : "";
    filter_form.querySelector("#date_end").value = (urlParams['date_end'] != null) ? urlParams['date_end'] : "";
}
function pushFilterToURL() {
    var filter = getFilterFromForm();
    var url_key = {
        "category_name": "name",
        "category_id": "id",
        "category_date_type": "date_type",
        "category_date_start": "date_start",
        "category_date_end": "date_end",
    }
    var url = "";
    Object.keys(filter).forEach(key => {
        url += (filter[key] != null && filter[key] != "") ? `&${url_key[key]}=${filter[key]}` : "";
    });
    return url;
}
function getFilterFromForm() {
    return {
        "category_name": filter_form.querySelector("#categoryName").value,
        "category_id": filter_form.querySelector("#categoryId").value,     
        "category_date_type": filter_form.querySelector("#cateDateSelect").value,
        "category_date_start": filter_form.querySelector("#date_start").value,
        "category_date_end": filter_form.querySelector("#date_end").value,
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
    // the ajax below are for create product

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
            function: "renderCategory",
            filter: filter
        }
    }).done(function (result) {
        var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?page=' + urlParams['page'] + '&item=' + number_of_item + '&current_page=' + current_page;
        newurl += pushFilterToURL();
        window.history.pushState({ path: newurl }, '', newurl);
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
                function: "renderCategory",
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

 var js = function() {
    const create_html = `<div class="modal-edit-product-container show" id="modal-edit-container">
<div class="modal-edit-product">
    <div class="modal-header">
        <h3>Thêm thể loại</h3>
        <button class="btn-close" id="btnClose"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body">
        <form action="">

            <div class="modal-body-2">
                <div class="flex">
                    <label for="name">Tên thể loại</label>
                    <input id="nameCategory" type="text" add-index="2" placeholder="Tên thể loại">
                </div>
                
            </div>
            <div>
            </div>
            <input type="reset" value="Hủy" class="create-cancel">
            <input type="submit" value="Xác nhận" class="create-confirm" add-index="9">
        </form>
    </div>
</div>
</div>`;

document.querySelector(".body__filter--action__add").addEventListener("click", (e) => {
    e.preventDefault();
    modal.innerHTML = create_html;
    const modal_create_container = document.querySelector(".modal-edit-product-container");
    modal.querySelector('.create-confirm').addEventListener('click', function (e) {
        e.preventDefault();
        $.ajax({
            url: '../controller/admin/category.controller.php',
            type: "post",
            dataType: 'html',
            data: {
                function: "create",
                field: {                   
                    name: modal.querySelector('#nameCategory').value,                 
                }
            }
        }).done(function (result) {
            loadItem();
            $("#sqlresult").html(result);
           
        })
        modal_create_container.classList.remove('show');
    });
    

    document.querySelector("#btnClose").addEventListener("click", () => {
    modal_create_container.classList.remove('show');
});
document.querySelector(".create-cancel").addEventListener("click", () => {
    modal_create_container.classList.remove('show');
});

});


const edit_html = `<div class="modal-edit-product-container show" id="modal-edit-container">
<div class="modal-edit-product">
    <div class="modal-header">
        <h3>Sửa thể loại</h3>
        <button class="btn-close" id="btnClose"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body">
        <form action="">

            <div class="modal-body-2">
                <div class="flex">
                    <label for="name">Tên thể loại</label>
                    <input id="name" type="text" add-index="2" placeholder="Tên thể loại">
                </div>
                
            </div>
            <div>
            </div>
            <input type="reset" value="Hủy" class="create-cancel">
            <input type="submit" value="Xác nhận" class="create-confirm" add-index="9">
        </form>
    </div>
</div>
</div>`;

var edit_btns = document.getElementsByClassName("actions--edit");
    for (var i = 0; i < edit_btns.length; i++) {
        edit_btns[i].addEventListener('click', function(e) {
            modal.innerHTML = edit_html;
            const modal_edit_container = document.querySelector("#modal-edit-container");
            modal.querySelector("#btnClose").addEventListener("click", ()=> {
                modal_edit_container.classList.remove('show');
            });
            modal.querySelector('.create-cancel').addEventListener('click', ()=> {
                modal_edit_container.classList.remove('show');
            });
            var id = this.parentNode.parentNode.querySelector(".id").innerHTML;
            modal.querySelector('#name').value = this.parentNode.parentNode.querySelector(".name").innerHTML;

            modal.querySelector('.create-confirm').addEventListener('click', function (e) {
                e.preventDefault();
                $.ajax({
                    url: '../controller/admin/category.controller.php',
                    type: "post",
                    dataType: 'html',
                    data: {
                        function: "edit",
                        field: { 
                            id: id,                  
                            name: modal.querySelector('#name').value,                 
                        }
                    }
                }).done(function (result) {
                    loadItem();
                    $("#sqlresult").html(result);
                   
                })
                modal_edit_container.classList.remove('show');
            });
            
        });

    }


    // delete

    const del_btns = document.getElementsByClassName("actions--delete");

    for (var i = 0; i < del_btns.length; i++) {
        del_btns[i].addEventListener('click', function () {
            let selected_content = this.parentNode.parentNode;
            let category_id = selected_content.querySelector('.id').innerHTML;
            let category_name = selected_content.querySelector('.name').innerHTML;

            var del_html = `
        <div class="modal-edit-product-container show" id="modal-edit-container">
        <div class="modal-edit-product">
            <div class="modal-header">
                <h3>Xác nhận xóa sản phẩm</h3>
                <button class="btn-close" id="btnClose"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="del-body">
                    
                    <div class="thongtin">
                        <div><span style="font-weight: bold;">Mã sản phẩm :</span> <span id="category-delete-id">${category_id}</span> </div>
                        <div><span style="font-weight: bold;">Tên sản phẩm :</span> <span>${category_name}</span> </div>
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
                var $id = $('#category-delete-id').html();
                $.ajax({
                    url: '../controller/admin/category.controller.php',
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
