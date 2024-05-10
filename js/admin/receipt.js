var filter_form = document.querySelector(".admin__content--body__filter");
function getFilterFromURL() {
  filter_form.querySelector("#id").value = (urlParams['id'] != null) ? urlParams['id'] : "";
  filter_form.querySelector("#supplierName").value = (urlParams['supplier_id'] != null) ? urlParams['supplier_id'] : "";
  filter_form.querySelector("#staff_id").value = (urlParams['staff_id'] != null) ? urlParams['staff_id'] : "";
  filter_form.querySelector("#date_start").value = (urlParams['date_start'] != null) ? urlParams['date_start'] : "";
  filter_form.querySelector("#date_end").value = (urlParams['date_end'] != null) ? urlParams['date_end'] : "";
  filter_form.querySelector("#price_start").value = (urlParams['price_start'] != null) ? urlParams['price_start'] : "";
  filter_form.querySelector("#price_end").value = (urlParams['price_end'] != null) ? urlParams['price_end'] : "";

}
function pushFilterToURL() {
  var filter = getGRFilterFromForm();
  var url_key = {
    "supplierName": "supplierName",
    "id": "id",
    "staff_id": "staff_id",
    "date_start": "date_start",
    "date_end": "date_end",
    "price_start": "price_start",
    "price_end": "price_end",

  }
  var url = "";
  Object.keys(filter).forEach(key => {
    url += (filter[key] != null && filter[key] != "") ? `&${url_key[key]}=${filter[key]}` : "";
  });
  return url;
}
function getGRFilterFromForm() {
  return {
    "supplierName": filter_form.querySelector("#supplierName").value,
    "id": filter_form.querySelector("#id").value,
    "staff_id": filter_form.querySelector("#staff_id").value,
    "date_start": filter_form.querySelector("#date_start").value,
    "date_end": filter_form.querySelector("#date_end").value,
    "price_start": filter_form.querySelector("#price_start").value,
    "price_end": filter_form.querySelector("#price_end").value,
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
  var filter = getGRFilterFromForm();
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

function addProduct() {
  // Get values from form fields
  let productId = "";
  let quantity ="";
  let productName = ""; // Sử dụng let để có thể thay đổi giá trị

  // Add event listener to productId dropdown
  const productIdDropdown = document.getElementById('productId');
  productIdDropdown.addEventListener('change', function() {
    const selectedProductId = this.value; 
    productName = document.getElementById('productId').selectedOptions[0].text;
     productId = document.getElementById('productId').value;
   
    if (!selectedProductId) return; // Exit if no product is selected

    // AJAX request to get inputPrice
    $.ajax({
      url: '../controller/admin/receipt.controller.php',
      type: "post",
      dataType: 'html',
      data: {
        function: "getPrice",
        field: {
          id: selectedProductId // Send the selected product ID
        }
      }
    }).done(function (result) {
      // Calculate inputPrice
      const inputPrice = 0.8 * parseFloat(result);

      // Update inputPrice field
      document.getElementById('inputPrice').value = inputPrice;
    }).fail(function() {
      alert('Đã xảy ra lỗi khi lấy giá.');
    });
  });

  // Add click event listener to addProduct button
  document.getElementById("addProduct").addEventListener("click", function() {
    quantity = document.getElementById('quantity').value;
    if ( productId.trim() === '' || quantity.trim() === '') {
      alert('Vui lòng nhập đầy đủ thông tin.');
      return;
    }
   

    // Add product to table
    const tableBody = document.getElementById('productTableBody');
    const newRow = tableBody.insertRow();
    newRow.innerHTML = `
      <td>${productId}</td>
      <td>${productName}</td> 
      <td>${quantity}</td>
      <td>${document.getElementById('inputPrice').value}</td>
    `;
    // Reset form fields
    document.getElementById('productId').value = '';
    document.getElementById('quantity').value = '';
    document.getElementById('inputPrice').value = ''; // Reset inputPrice as well
  });
}

function deleteRow() {
  const table = document.getElementById('addTable'); // Lấy thẻ table
  const rowCount = table.rows.length; 
  if (rowCount > 1) {
    table.deleteRow(rowCount - 1); // Xóa dòng cuối cùng (trừ dòng header)
  } else {
    alert('Không có dòng để xóa.');
  }
}
function getProductsBySupplier(selectElement) {
  const tableBody = document.getElementById('productTableBody');
  tableBody.innerHTML = '';

  const supplierId = selectElement.value; 
  $.ajax({
    url: '../controller/admin/receipt.controller.php',
    type: "post",
    dataType: 'html',
    data: {
      function: "getIdProducts",
      field: {
        id: supplierId

      }
    }
  }).done(function (htmlResult) {
    const idProductSelect = document.getElementById('productId');
    idProductSelect.innerHTML = htmlResult;
  });
}

const js = function () {

  const addHtml = `
  <div class="form">
    <h2>Thêm thông tin đơn nhập hàng</h2>
    <form id="form">
      <div class="input-field">
        <label for="supplier">Nhà cung cấp:</label>
        <select id="supplier" onchange="getProductsBySupplier(this)" ">
        <!-- Options for suppliers will be dynamically added -->
      </select>
        </select>
      </div>
      <div class="input-field">
        <label for="productId">Mã sản phẩm:</label>
        <select id="productId">
          <!-- Options for products will be dynamically added -->
        </select>
      </div>
      <div class="input-field">
        <label for="quantity">Số lượng:</label>
        <input type="number" id="quantity">
      </div>
      <div class="input-field">
        <label for="inputPrice">Giá nhập:</label>
        <input type="number" id="inputPrice" readonly>
      </div>
      <div class="form-actions">
        <button type="button"  class="btn" id="addProduct">Thêm sản phẩm</button>
        <button type="button"  onclick="deleteRow()">Xóa</button>

      </div>    
    </form>
    <div class="book-table">
      <table id="addTable">
        <thead>
          <tr>
            <th style="width: 10%">Mã SP</th>
            <th style=" width: 55%">Tên SP</th>
            <th style=" width: 15%">Số Lượng</th>
            <th style=" width: 20%">Giá Nhập</th>
          </tr>
        </thead>
        <tbody id="productTableBody">
          <!-- Products added will be shown here -->
        </tbody>
      </table>
    </div>
  </div>`;

const addModal = document.getElementById('addReiceptModal');
const addModalContent = document.querySelector(".addModal-content .form");
const openModalBtn = document.querySelector('.body__filter--action__add');
const addButton = document.getElementById("addButton");
const closeAddIcon = document.querySelector(".addModal-content .close i");

openModalBtn.addEventListener('click', function () {
  addModalContent.innerHTML = addHtml;
  addModalContent.addEventListener('click',addProduct());
  addModal.style.display = "block";

  // Populate suppliers dropdown
  $.ajax({
    url: '../controller/admin/receipt.controller.php',
    type: "post",
    dataType: 'html', 
    data: {
      function: "getSuppliers"
    }
  }).done(function (htmlResult) {
    const supplierSelect = document.getElementById('supplier');
    supplierSelect.innerHTML = htmlResult;


  });

  
  });
  

  // Đóng modal khi click vào nút close
  closeAddIcon.addEventListener('click', function () {
    addModal.style.display = "none";
  });
 
  addButton.addEventListener('click', function (e) {
    e.preventDefault(); // Ngăn chặn hành vi mặc định của nút (không gửi biểu mẫu)

    // Lấy giá trị từ các trường input
    const supplierId = document.getElementById('supplier').value;
    const products = document.querySelectorAll('#productTableBody tr');
    let totalPrice = 0; // Tổng tiền của đơn hàng

    // Tính tổng tiền và chuỗi dữ liệu chi tiết
    let detailData = [];
    products.forEach((product) => {
        const productId = product.cells[0].textContent; 
        const quantity = product.cells[2].textContent; // Lấy số lượng từ cột 2
        const inputPrice = product.cells[3].textContent; // Lấy giá nhập từ cột 3
        totalPrice += parseFloat(quantity) * parseFloat(inputPrice); // Tính tổng tiền
        detailData.push({ productId, quantity, inputPrice });
    });

    // Thực hiện gửi dữ liệu thông qua Ajax
    $.ajax({
        url: '../controller/admin/receipt.controller.php',
        type: "post",
        dataType: 'html',
        data: {
            function: "create",
            field: {
                supplierId: supplierId,
                totalPrice: totalPrice,
                details: detailData,
                staffId: "stafffahasa"
            }
        }
    }).done(function (result) {
        loadItem(); 
        $("#sqlresult").html(result);
        addModal.style.display = "none";
    });
});





const editModal = document.getElementById("editModal");
const editModalContent = document.querySelector(".editModal-content .form");
const closeEditIcon = document.querySelector(".editModal-content .close i");

const editHtml = `
<div class="form">
  <h2>Xem thông tin đơn nhập hàng</h2>
  <form id="form">
    <div class="input-field">
      <label for="idReceipt">Mã đơn nhập</label>
      <input type="text" id="idForm" readonly="">
      </div>
      <div class="input-field">
      <label for="supplierName">Tên nhà cung cấp</label>
      <input type="text" id="supplierNameForm">
    </div>
    <div class="input-field">
      <label for="staff_id">Tên người nhập hàng</label>
      <input type="email" id="staff_idForm">
      </div>
      <div class="input-field">
      <label for="total_price">Tổng giá</label>
      <input type="text" id="total_price" readonly="">
    </div>
    <div class="input-field">
      <label for="date_create">Ngày lập</label>
      <input type="text" id="date_create" readonly="">
    </div>
  
    <div class="book-table">
    <table id=Table> </table>
    </div>

</div>`;





closeEditIcon.addEventListener("click", () => {
editModal.style.display = "none";
});

window.addEventListener("click", (event) => {
if (event.target === editModal) {
  editModal.style.display = "none";
}
});

var edit_btns = document.querySelectorAll(".actions--edit");
edit_btns.forEach(function(btn) {
btn.addEventListener('click', function () {



  editModalContent.innerHTML = editHtml;
  editModal.style.display = "block";
 
  let id = this.closest("tr").querySelector(".id").innerHTML;
 
  document.getElementById("idForm").value = id;
  document.getElementById("supplierNameForm").value = this.closest("tr").querySelector(".supplierName").innerHTML;
  document.getElementById("total_price").value = this.closest("tr").querySelector(".total_price").innerHTML;
  document.getElementById("staff_idForm").value = this.closest("tr").querySelector(".staff_id").innerHTML;
  document.getElementById("date_create").value = this.closest("tr").querySelector(".date_create").innerHTML;

  let Table = document.querySelector("#Table");
  Table.innerHTML = ""; 
    $.ajax({
      url: '../controller/admin/receipt.controller.php',
      type: "post",
      dataType: 'html', // Chuyển về dạng HTML để nhận đoạn mã HTML từ server
      data: {
        function: "details",
        field: {
          id: id
        
        }
      },
      success: function(response) {
        Table.innerHTML = response;
        
      },
      
    });
});
});








closeEditIcon.addEventListener("click", () => {
  editModal.style.display = "none";
});

window.addEventListener("click", (event) => {
  if (event.target === editModal) {
    editModal.style.display = "none";
  }
});
  

 
}













