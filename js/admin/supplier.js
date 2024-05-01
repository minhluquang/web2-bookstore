var filter_form = document.querySelector(".admin__content--body__filter");
function getFilterFromURL() {
    filter_form.querySelector("#supplierName").value = (urlParams['name'] != null) ? urlParams['name'] : "";
    filter_form.querySelector("#supplierId").value = (urlParams['id'] != null) ? urlParams['id'] : "";
   

}
function pushFilterToURL() {
    var filter = getFilterFromForm();
    var url_key = {
        "supplier_name": "name",
        "supplier_id": "id",
        "supplier_status":"status"
        
        
    }
    var url = "";
    Object.keys(filter).forEach(key => {
        url += (filter[key] != null && filter[key] != "") ? `&${url_key[key]}=${filter[key]}` : "";
    });
    return url;
}
function getFilterFromForm() {
    return {
        "supplier_name": filter_form.querySelector("#supplierName").value,
        "supplier_id": filter_form.querySelector("#supplierId").value,     
        "supplier_status": filter_form.querySelector("#statusSelect").value,
        
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
        e.preventDefault();
        var supplierId = filter_form.querySelector("#supplierId").value.trim();
        var message = filter_form.querySelector("#message");
        var check = true;
        var regex = /^\d+$/;
        if (supplierId !== '' && !supplierId.match(regex)) {
            message.innerHTML = "*Mã nhà cung cấp phải là kí tự số";
            filter_form.querySelector("#supplierId").focus();
            check = false;
        } 

        if (check === true) {
        current_page = 1;
        loadItem();
        }
        
        
       
    })
    $(".body__filter--action__reset").click((e) => {
        check = true;
        message.innerHTML = "";
        current_page = 1;
        status_value = "active";
        $.ajax({
            url: '../controller/admin/pagnation.controller.php',
            type: "post",
            dataType: 'html',
            data: {
                number_of_item: number_of_item,
                current_page: current_page,
                function: "render",
                filter: {
                    supplier_status: status_value
                }
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
        <h3>Thêm nhà cung cấp</h3>
        <button class="btn-close" id="btnClose"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body">
        <form action="">

            <div class="modal-body-2">
                <div class="flex">
                    <label for="name">Tên nhà cung cấp</label>
                    <input id="namesupplier" type="text" add-index="2" placeholder="Tên nhà cung cấp">                   
                </div>

                <div class="flex">
                    <label for="email">Email nhà cung cấp</label>
                    <input id="emailsupplier" type="text" add-index="2" placeholder="Email nhà cung cấp">                   
                </div>

                <div class="flex">
                    <label for="sdt">Số điện thoại nhà cung cấp</label>
                    <input id="sdtsupplier" type="text" add-index="2" placeholder="Email nhà cung cấp">                   
                </div>


                
            </div>
            <div>
            </div>
            <input type="reset" value="Hủy" class="button-cancel">
            <input type="submit" value="Xác nhận" class="button-confirm" add-index="9">
        </form>
    </div>
</div>
</div>`;

document.querySelector(".body__filter--action__add").addEventListener("click", (e) => {
    e.preventDefault();
    modal.innerHTML = create_html;
    const modal_create_container = document.querySelector("#modal-edit-container");
    modal.querySelector('.button-confirm').addEventListener('click', function (e) {
        e.preventDefault();
        $.ajax({
            url: '../controller/admin/supplier.controller.php',
            type: "post",
            dataType: 'html',
            data: {
                function: "create",
                field: {                   
                    name: modal.querySelector('#namesupplier').value,
                    email: modal.querySelector('#emailsupplier').value,
                    sdt: modal.querySelector('#sdtsupplier').value,                 
                }
            }
        }).done(function (result) {
            loadItem();
            $("#sqlresult").html(result);
           
        })
        modal_create_container.classList.add('hidden');
    });
    

    document.querySelector("#btnClose").addEventListener("click", () => {
    modal_create_container.classList.add('hidden');
});
document.querySelector(".button-cancel").addEventListener("click", () => {
    modal_create_container.classList.add('hidden');
});

});


const edit_html = `<div class="modal-edit-product-container show" id="modal-edit-container">
<div class="modal-edit-product">
    <div class="modal-header">
        <h3>Sửa nhà cung cấp</h3>
        <button class="btn-close" id="btnClose"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body">
        <form action="">

            <div class="modal-body-2">
                <div class="flex">
                    <label for="name">Tên nhà cung cấp</label>
                    <input id="name" type="text" add-index="2" placeholder="Tên nhà cung cấp">
                    
                </div>

                <div class="flex">
                <label for="email">Email nhà cung cấp</label>
                <input id="email" type="text" add-index="2" placeholder="Email nhà cung cấp">                   
            </div>

            <div class="flex">
                <label for="sdt">Số điện thoại nhà cung cấp</label>
                <input id="sdt" type="text" add-index="2" placeholder="Email nhà cung cấp">                   
            </div>
                
            </div>
            <div>
            </div>
            <input type="reset" value="Hủy" class="button-cancel">
            <input type="submit" value="Xác nhận" class="button-confirm" add-index="9">
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
            modal.querySelector('.button-cancel').addEventListener('click', ()=> {
                modal_edit_container.classList.remove('show');
            });
            var id = this.parentNode.parentNode.querySelector(".id").innerHTML;
            modal.querySelector('#name').value = this.parentNode.parentNode.querySelector(".name").innerHTML;
            modal.querySelector('#email').value = this.parentNode.parentNode.querySelector(".email").innerHTML;
            modal.querySelector('#sdt').value = this.parentNode.parentNode.querySelector(".number_phone").innerHTML;
            

            modal.querySelector('.button-confirm').addEventListener('click', function (e) {
                e.preventDefault();
                $.ajax({
                    url: '../controller/admin/supplier.controller.php',
                    type: "post",
                    dataType: 'html',
                    data: {
                        function: "edit",
                        field: { 
                            id: id,                  
                            name: modal.querySelector('#name').value,
                            email: modal.querySelector('#email').value,
                            sdt: modal.querySelector('#sdt').value,
                                            
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
            let supplier_id = selected_content.querySelector('.id').innerHTML;
            let supplier_name = selected_content.querySelector('.name').innerHTML;

            var del_html = `
        <div class="modal-edit-product-container show" id="modal-edit-container">
        <div class="modal-edit-product">
            <div class="modal-header">
                <h3>Xác nhận xóa nhà cung cấp</h3>
                <button class="btn-close" id="btnClose"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="del-body">
                    
                    <div class="thongtin">
                        <div><span style="font-weight: bold;">Mã nhà cung cấp :</span> <span id="supplier-delete-id">${supplier_id}</span> </div>
                        <div><span style="font-weight: bold;">Tên nhà cung cấp :</span> <span>${supplier_name}</span> </div>
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
                var $id = $('#supplier-delete-id').html();
                $.ajax({
                    url: '../controller/admin/supplier.controller.php',
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