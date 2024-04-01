<?php
class pagnation
{
    private $number_of_item;
    private $current_page;
    private $table;
    public function __construct($number_of_item, $current_page, $table)
    {
        $this->number_of_item = $number_of_item;
        $this->current_page = $current_page;
        $this->table = $table;
    }
    public function setNumberOfItem($number_of_item)
    {
        $this->number_of_item = $number_of_item;
    }
    public function getNumberOfItem()
    {
        return $this->number_of_item;
    }
    public function setCurrentPage($current_page)
    {
        $this->current_page = $current_page;
    }
    public function getCurrentPage()
    {
        return $this->current_page;
    }
    public function setTable($table)
    {
        $this->table = $table;
    }
    public function getTable()
    {
        return $this->table;
    }
    public function loadProductForPagnation()
    {
        $id = array(
            'products' => 'id',
            'orders' => 'id',
            'accounts'=> 'username',
            'authors'=> 'id',
            'publishers'=> 'id',
            'categories'=> 'id',
        );
        $database = new connectDB();
        $offset = ($this->current_page - 1) * $this->number_of_item;
        $id = $id[$this->table];
        $sql = "SELECT * FROM $this->table ORDER BY $id ASC LIMIT $this->number_of_item OFFSET $offset ";
        $result = $database->query($sql);
        if ($result->num_rows > 0) {
            return (object) array(
                'success' => true,
                'data' => $result
            );
        } else {
            return (object) array(
                'success' => false
            );
        }
        $database->close();
    }
    function getTotalRecords()
    {

        $database = new connectDB();
        $total_records = $database->query("SELECT * FROM $this->table");
        $database->close();
        return $total_records->num_rows;
    }
    public function renderProduct()
    {
        $database = new connectDB();
        $load_result = $this->loadProductForPagnation();
        if ($load_result->success) {
            $result = $load_result->data;
   
            switch ($this->table) {
                case "products": {
                        echo '<div class="table__wrapper">
                    <table id="content-product">
                        <thead class="menu">
                            <tr>
                                <th>Mã SP</th>
                                <th>Ảnh</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Phân loại</th>
                                <th>Ngày cập nhật</th>
                                <th>Ngày tạo</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody class="table-content" id="content">';
                        
                        while ($row = mysqli_fetch_array($result)) {
                            // masp
                            echo '<tr>
                        <td class="id">' . $row['id'] . '</td>';
                            // img

                            echo '<td class="image">
                        <img src="../' . $row['image_path'] . '" alt="image not found" />';
                            //name
                            echo '<td class="name">' . $row['name'] . '</td>';
                            //catagory
                            $cat_sql = "SELECT name  FROM `categories` WHERE id IN (SELECT category_id  FROM `category_details` WHERE product_id = '" . $row[0] . "')";
                            $cat_result = $database->query($cat_sql);

                            echo '<td class="type">';
                            $category = mysqli_fetch_array($cat_result);
                            if ($category) echo $category['name'];
                            while ($category = mysqli_fetch_array($cat_result)) echo "," . $category['name'];
                            echo '</td>';
                            // date
                            echo '<td class="date-update">14/11/2023</td>
                        <td class="date-creat">14/11/2023</td>';
                            //price and amount
                            echo '<td class="price">' . $row['price'] . '</td>
                        <td class="amount">' . $row['quantity'] . '</td>';
                            // button
                            echo '<td class="actions ">
                        <button class="actions--edit" >Sửa</button>
                        <button class="actions--delete" >Xoá</button>
                        </td>';
                            echo '</tr>';
                        }
                        echo ' 
                        </tbody>
                        </table>
                    
                        </div>';
                    }
                    break;
                case "orders": {
                        echo '
                    <div class="table__wrapper">
                        <table id="content-product">
                            <thead class="menu">
                                <tr>
                                    <th>Mã đơn</th>
                                    <th>Mã KH</th>
                                    <th>Mã NV</th>
                                    <th>Ngày tạo</th>
                                    <th>Tổng giá</th>
                                    <th>Địa chỉ giao</th>
                                    <th>Trạng thái</th>
                                    <th>Mã giảm giá</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody class="table-content" id="content">
                    ';
                        while ($row = mysqli_fetch_array($result)) {
                            echo '<tr>';
                            echo '<td class="order_id" id="order_id' . $row[0] . '">' . $row[0] . '</td>';
                            echo '<td class="customer_id">' . $row[1] . '</td>';
                            echo '<td class="staff_id">' . $row[2] . '</td>';
                            echo '<td class="date-update">' . $row[4] . '</td>';
                            echo '<td class="total_price">' . $row[5] . '</td>';
                            $sql_address = 'SELECT * from delivery_infoes WHERE id="' . $row[3] . '"';
                            $result_address = $database->query($sql_address);
                            $row_address = mysqli_fetch_array($result_address);

                            echo '<td class="address">' . $row_address['address'] . '</td>';

                            $sql_status = 'SELECT * from order_statuses WHERE id="' . $row[6] . '"';
                            $result_status  = $database->query($sql_status);
                            $row_status = mysqli_fetch_array($result_status);

                            echo '<td class="status">' . $row_status['name'] . '</td>';
                            echo '<td class="discount_code">' . $row[7] . '</td>';
                            echo '<td class="actions">
                        <button class="actions--view">Chi tiết hoá đơn</button>
                        <button class="actions--delete">Xoá</button>
                        </td>
                        </tr>';
                        }
                        echo ' 
                    </tbody>
                    </table>
                    </div>';
                    }
                    break;
                case "accounts":{
                    echo '
                    <div class="table__wrapper">
                        <table id="content-product">
                            <thead class="menu">
                            <tr>
                                <th>Mã người dùng</th>
                                <th>Tên người dùng</th>
                                <th>Email</th>
                                <th>Loại tài khoản</th>
                                <th>Ngày đăng ký</th>
                                <th>Trạng thái tài khoản</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody class="table-content" id="content">
                    ';
                        
                        while ($row = mysqli_fetch_array($result)) {
                            echo '<tr>';
                            echo '<td class="id">'  . $row['username'] . '</td>';
                            echo '<td class="name">' . 'Tên người dùng'. '</td>';
                            echo '<td class="email">' .'Email'. '</td>';

                            $sql_role = 'SELECT * from roles WHERE id="' . $row['role_id'] . '"';
                            $row_role = mysqli_fetch_array($database->query($sql_role));

                            echo '<td class="type" value="staff">' . $row_role['name'] . '</td>';
                            echo '<td class="date-create">' . 'Ngày đăng ký' . '</td>';
                            echo '<td class="status" value="active">' .'Trạng thái tài khoản'. '</td>';
                            echo '<td class="actions">
                            <button class="actions--edit">Sửa</button>
                            <button class="actions--delete">Xoá</button>
                        </td>
                        </tr>';
                        }
                        echo ' 
                    </tbody>
                    </table>
                    </div>';
                }
                break;
                case "authors":{
                    echo '
                    <div class="table__wrapper">
                    <table id="content-product">
                        <thead class="menu">
                            <tr>
                            <th>Mã tác giả</th>
                            <th>Tên tác giả</th>
                            <th>Email tác giả</th>
                            <th>Thể loại viết</th>
                            <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody class="table-content" id="content">

                    ';

                        while ($row = mysqli_fetch_array($result)) {
                            echo '<tr>';
                            echo '<td class="id">'  . $row['id'] . '</td>';
                            echo '<td class="name">' . $row['name']. '</td>';
                            echo '<td class="email">' .'Email'. '</td>';
                            echo '<td class="genres">';
                            $sql_gerne = "SELECT c.name
                            FROM   authors a
                            INNER JOIN author_details ad ON ad.author_id = a.id
                            INNER JOIN category_details cd ON cd.product_id = ad.product_id
                            INNER JOIN categories c ON c.id = cd.category_id
                            WHERE a.id =".$row['id'] ;
                            $result_gerne = $database->query($sql_gerne);
                            $gerne = "";
                            while($row_gerne = mysqli_fetch_array($result_gerne)){
                                $gerne =$gerne. $row_gerne['name'].', ';
                            }
                            echo rtrim($gerne, ', ').'</td>';
                            echo '<td class="actions">
                            <button class="actions--edit">Sửa</button>
                            <button class="actions--delete">Xoá</button>
                        </td>
                        </tr>';
                        }
                        echo ' 
                    </tbody>
                    </table>
                    </div>';
                }
                break;
                case "publishers":{
                    echo '
                    <div class="table__wrapper">
                    <table id="content-product">
                        <thead class="menu">
                            <tr>
                            <th>Mã NXB</th>
                            <th>Tên NXB</th>
                            <th>Email NXB</th>
                            <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody class="table-content" id="content">

                    ';

                        while ($row = mysqli_fetch_array($result)) {
                            echo '<tr>';
                            echo '<td class="id">'  . $row['id'] . '</td>';
                            echo '<td class="name">' . $row['name']. '</td>';
                            echo '<td class="email">' .'Email'. '</td>';
                            echo '<td class="actions">
                            <button class="actions--edit">Sửa</button>
                            <button class="actions--delete">Xoá</button>
                        </td>
                        </tr>';
                        }
                        echo ' 
                    </tbody>
                    </table>
                    </div>';
                }
                break;
                case "categories":{
                    echo '
                    <div class="table__wrapper">
                    <table id="content-product">
                        <thead class="menu">
                            <tr>
                            <th>Mã thể loại</th>                 
                            <th>Tên thể loại</th>
                            <th>Số lượng sách</th>
                            <th>Ngày cập nhật</th>
                            <th>Ngày tạo</th>          
                            <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody class="table-content" id="content">

                    ';

                        while ($row = mysqli_fetch_array($result)) {
                            echo '<tr>';
                            echo '<td class="id">'  . $row['id'] . '</td>';
                            echo '<td class="name">' . $row['name']. '</td>';
                            $sql_amount = 
                            "SELECT SUM(quantity) as total 
                                FROM `products`  as p 
                                INNER JOIN category_details as cd ON cd.category_id = ".$row['id']."
                                WHERE p.id = cd.product_id";
                            $result_amount = $database->query($sql_amount);
                            echo '<td class="amount">' .mysqli_fetch_array($result_amount)['total']. '</td>';
                            echo '<td class="date-update">14/11/2023</td>
                            <td class="date-creat">14/11/2023</td>';
                            echo '<td class="actions">
                            <button class="actions--edit">Sửa</button>
                            <button class="actions--delete">Xoá</button>
                        </td>
                        </tr>';
                        }
                        echo ' 
                    </tbody>
                    </table>
                    </div>';
                }
                break;
            }
            echo '<div class="pagination">';

            $page_number = ceil($this->getTotalRecords() / $this->number_of_item);
            if ($this->current_page > 1) {
                echo "<span class='pag-pre'>&laquo;</span>";
                echo "<span class='pag'>1</span>";
            }
            if ($this->current_page > 2) {
                echo "<span class='pag'>2</span>";
            }
            if ($this->current_page > 4) echo sprintf("...<span class='pag'>%u</span>", $this->current_page - 1);
            elseif ($this->current_page > 3) echo "<span class='pag'>3</span>";
            echo "<span class='active'>$this->current_page</span>";
            if ($this->current_page < $page_number) echo sprintf("<span class='pag'>%u</span>", $this->current_page + 1);
            if ($this->current_page + 3 < $page_number) echo "...";
            if ($this->current_page + 2 < $page_number) echo sprintf("<span class='pag'>%u</span>", $page_number - 1);
            if ($this->current_page + 1 < $page_number) echo "<span class='pag'>$page_number</span>";

            if ($this->current_page < $page_number) echo "<span class='pag-con'>&raquo;</span>";

            echo '</div>';
        }
        $database->close();
    }
}
