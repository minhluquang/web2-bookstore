// const form = document.getElementById('checkout-form');
// form.addEventListener('submit', function (event) {
//     event.preventDefault();
//     var valid = true;
//     // Validate name field
//     const name = document.getElementById('name');
//     name.classList.remove("error-field");
//     if (!/^[àÀảẢãÃáÁạẠăĂằẰẳẲẵẴắẮặẶâÂầẦẩẨẫẪấẤậẬđĐèÈẻẺẽẼéÉẹẸêÊềỀểỂễỄếẾệỆìÌỉỈĩĨíÍịỊòÒỏỎõÕóÓọỌôÔồỒổỔỗỖốỐộỘơƠờỜởỞỡỠớỚợỢùÙủỦũŨúÚụỤưƯừỪửỬữỮứỨựỰỳỲỷỶỹỸýÝỵỴA-Za-z ]{2,50}$/.test(name.value)) {
//         name.classList.add("error-field");
//         valid = false;
//     }

//     // Validate email field
//     const email = document.getElementById('email');
//     email.classList.remove("error-field");
//     if (!/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/.test(email.value)) {
//         email.classList.add("error-field");
//         valid = false;
//     }

//     // Validate phone field
//     const phone = document.getElementById('phone');
//     phone.classList.remove("error-field");
//     if (!/^\d{10}$/.test(phone.value)) {
//         phone.classList.add("error-field");
//         valid = false;
//     }

//     // Validate address field
//     const address = document.getElementById('address');
//     address.classList.remove("error-field");
//     if (!/^[àÀảẢãÃáÁạẠăĂằẰẳẲẵẴắẮặẶâÂầẦẩẨẫẪấẤậẬđĐèÈẻẺẽẼéÉẹẸêÊềỀểỂễỄếẾệỆìÌỉỈĩĨíÍịỊòÒỏỎõÕóÓọỌôÔồỒổỔỗỖốỐộỘơƠờỜởỞỡỠớỚợỢùÙủỦũŨúÚụỤưƯừỪửỬữỮứỨựỰỳỲỷỶỹỸýÝỵỴA-Za-z0-9 ]{5,200}$/.test(address.value)) {
//         address.classList.add("error-field");
//         valid = false;
//     }
//     if (!valid) {
//         document.querySelector('.error-field').focus();
//         return;
//     }
//     // Submit the form
//     form.submit();
// });
