<?php
class pagnation
{
    private $number_of_item;
    private $current_page;
    private $table;
    private $filter = "";
    private $athorFilter = "";

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
    public function setFilter($filter)
    {
        $this->filter = $filter;
    }
    public function getFilter()
    {
        return $this->filter;
    }
  
    public function getData()
    {
        $id = array(
            'products' => 'id',
            'orders' => 'id',
            'accounts' => 'username',
            'authors' => 'id',
            'publishers' => 'id',
            'categories' => 'id',
        );
        $database = new connectDB();
        $offset = ($this->current_page - 1) * $this->number_of_item;
        $id = $id[$this->table];
        $sql = "SELECT DISTINCT $this->table.* FROM $this->table $this->filter ORDER BY $this->table.$id ASC LIMIT $this->number_of_item OFFSET $offset ";
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
        $total_records = $database->query("SELECT DISTINCT $this->table.* FROM $this->table $this->filter");
        $database->close();
        return $total_records->num_rows;
    }
    public function render()
    {
        $database = new connectDB();
        $load_result = $this->getData();
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
                                <th>Thể loại</th>
                                <th>Ngày cập nhật/Ngày tạo</th>
                                <th>Tác giả</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody class="table-content" id="content">';

                        while ($row = mysqli_fetch_array($result)) {
                            // masp
                            echo '<tr>
                        <td class="id" publisher_id="'.$row['publisher_id'].'">' . $row['id'] . '</td>';
                            // img

                            echo '<td class="image">
                        <img src="../' . $row['image_path'] . '" alt="image not found" />';
                            //name
                            echo '<td class="name">' . $row['name'] . '</td>';
                            //catagory
                            $cat_sql = "SELECT *  FROM `categories` WHERE id IN (SELECT category_id  FROM `category_details` WHERE product_id = '" . $row[0] . "')";
                            $cat_result = $database->query($cat_sql);

                            $category = mysqli_fetch_array($cat_result);
                            echo '<td class="type" value="';
                            if ($category) {
                                echo $category['id'].'">';
                                echo $category['name'];
                            }else echo '">';
                            while ($category = mysqli_fetch_array($cat_result)) echo "," . $category['name'];
                            echo '</td>';
                            // date
                            echo '<td class="date">' . date("d/m/Y", strtotime($row['update_date'])) . ' ' . date("d/m/Y", strtotime($row['create_date'])) . '</td>';
                            //author
                            $author_sql = "SELECT *  FROM `authors` WHERE id IN (SELECT author_id  FROM `author_details` WHERE product_id = '" . $row[0] . "')";
                            $author_result = $database->query($author_sql);

                            echo '<td class="author" value="';
                            $author = mysqli_fetch_array($author_result);
                            if ($author) {
                                echo $author['id'].'">';
                                echo $author['name'];
                            }else echo '">';
                            while ($author = mysqli_fetch_array($cat_result)) echo "," . $author['name'];
                            echo '</td>';
                            //price and amount
                            echo '<td class="price">';
                            $price_number =  $row['price'];
                            $price = "";
                            while ($price_number > 0) {
                                $price = substr("$price_number", -3, 3) . '.' . $price;
                                $price_number = substr("$price_number", 0, -3);
                            }

                            echo  trim($price, '. ') . '&#8363;</td> <td class="amount">' . $row['quantity'] . '</td>';
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
                case "accounts": {
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
                            echo '<td class="name">' . 'Tên người dùng' . '</td>';
                            echo '<td class="email">' . 'Email' . '</td>';

                            $sql_role = 'SELECT * from roles WHERE id="' . $row['role_id'] . '"';
                            $row_role = mysqli_fetch_array($database->query($sql_role));

                            echo '<td class="type" value="staff">' . $row_role['name'] . '</td>';
                            echo '<td class="date-create">' . 'Ngày đăng ký' . '</td>';
                            echo '<td class="status" value="active">' . 'Trạng thái tài khoản' . '</td>';
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
                case "authors": {
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
                            echo '<td class="name">' . $row['name'] . '</td>';
                            echo '<td class="email">' . $row['email'] . '</td>';
                            echo '<td class="genres">';
                            $sql_gerne = "SELECT c.name
                            FROM   authors a
                            INNER JOIN author_details ad ON ad.author_id = a.id
                            INNER JOIN category_details cd ON cd.product_id = ad.product_id
                            INNER JOIN categories c ON c.id = cd.category_id
                            WHERE a.id =" . $row['id'];
                            $result_gerne = $database->query($sql_gerne);
                            $gerne = "";
                            while ($row_gerne = mysqli_fetch_array($result_gerne)) {
                                $gerne = $gerne . $row_gerne['name'] . ', ';
                            }
                            echo rtrim($gerne, ', ') . '</td>';
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
                case "publishers": {
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
                            echo '<td class="name">' . $row['name'] . '</td>';
                            echo '<td class="email">' . 'Email' . '</td>';
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
                case "categories": {
                        echo '
                    <div class="table__wrapper">
                    <table id="content-product">
                        <thead class="menu">
                            <tr>
                            <th>Mã thể loại</th>                 
                            <th>Tên thể loại</th>
                            <th>Số lượng sách</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th>Ngày cập nhật</th>
                            <th>Ngày xóa</th>          
                            <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody class="table-content" id="content">

                    ';

                        while ($row = mysqli_fetch_array($result)) {
                            echo '<tr>';
                            echo '<td class="id">'  . $row['id'] . '</td>';
                            echo '<td class="name">' . $row['name'] . '</td>';
                            $sql_amount =
                                "SELECT SUM(quantity) as total 
                                FROM `products`  as p 
                                INNER JOIN category_details as cd ON cd.category_id = " . $row['id'] . "
                                WHERE p.id = cd.product_id";
                            $result_amount = $database->query($sql_amount);
                            $amount = mysqli_fetch_array($result_amount)['total'];
                            if($amount !== null) {
                                echo '<td class="amount">' . $amount . '</td>';
                            } else {
                                echo '<td class="amount">'. 0 .'</td>';
                            }
                            echo '<td class="status">' . $row['status'] . '</td>';
                            echo '<td class="date-create">'.$row['create_date'].'</td>';
                            echo '<td class="date-update">'.$row['update_date'].'</td>';
                            echo '<td class="date-delete">'.$row['delete_date'].'</td>';
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

function getFilterSQL($data)
{
    $filter = "";   
    $innerjoin = "";
    if (!empty($data)) {
        if (!empty($data['product_name'])) {
            if ($filter != "") $filter = $filter . " AND ";
            $filter = $filter . "`name` LIKE '%" . $data['product_name'] . "%'";
        }
        if (!empty($data['product_id'])) {
            if ($filter != "") $filter = $filter . " AND ";
            $filter = $filter . " id = " . $data['product_id'];
        }
        if (!empty($data['product_price_start'])) {
            if ($filter != "") $filter = $filter . " AND ";
            $filter = $filter . " price >= " . $data['product_price_start'];
        }
        if (!empty($data['product_price_end'])) {
            if ($filter != "") $filter = $filter . " AND ";
            $filter = $filter . " price <= " . $data['product_price_end'];
        }
        if (!empty($data['product_category'])) {
            if ($filter != "") $filter = $filter . " AND ";
            $filter = $filter . " cd.product_id=products.id ";
            $innerjoin = $innerjoin . "INNER JOIN category_details	as cd ON cd.category_id =' " . $data['product_category'] . "'";
        }
        if (!empty($data['product_date_type'])) {
            if (!empty($data['product_date_start'])) {
                if ($filter != "") $filter = $filter . " AND ";
                $filter = $filter . " `" . $data['product_date_type'] . "` >= '" . $data['product_date_start'] . "'";
            }
            if (!empty($data['product_date_end'])) {
                if ($filter != "") $filter = $filter . " AND ";
                $filter = $filter . " `" . $data['product_date_type'] . "` <= '" . $data['product_date_end'] . "'";
            }
        }
        if ($filter != "") $filter = "WHERE " . $filter;
    }
    return $innerjoin . $filter;
}

function getAuthorFilterSQL($data)
{
    $filter = "";    
    if (!empty($data)) {
        if (!empty($data['author_name'])) {
            if ($filter != "") $filter = $filter . " AND ";
            $filter = $filter . "`name` LIKE '%" . $data['author_name'] . "%'";
        }
        if (!empty($data['author_id'])) {
            if ($filter != "") $filter = $filter . " AND ";
            $filter = $filter . " id = " . $data['author_id'];
        }
        if (!empty($data['author_email'])) {
            if ($filter != "") $filter = $filter . " AND ";
            $filter = $filter . "`email` LIKE '%" . $data['author_email'] . "%'";
        }
        
        
        if ($filter != "") $filter = "WHERE " . $filter;
    }
    return  $filter;
}

function getCategoryFilterSQL($data)
{
    $filter = "";    
    if (!empty($data)) {
        if (!empty($data['category_name'])) {
            if ($filter != "") $filter = $filter . " AND ";
            $filter = $filter . "`name` LIKE '%" . $data['category_name'] . "%'";
        }
        if (!empty($data['category_id'])) {     
            if ($filter != "") $filter = $filter . " AND ";
            $filter = $filter . " id = " . $data['category_id'];
        }
        if (!empty($data['category_status'])) {
            if ($filter != "") $filter = $filter . " AND ";
            if ($data['category_status'] == "active") {
                // Sử dụng toán tử bằng (=) thay vì toán tử khác (!=) để xác định trạng thái
                $filter = $filter . "status = 1 " ;
            } elseif ($data['category_status'] == "inactive") {
                $filter = $filter . "status = 0 " ;
            }
            
        }
        
        if (!empty($data['category_date_type'])) {
            if (!empty($data['category_date_start'])) {
                if ($filter != "") $filter = $filter . " AND ";
                $filter = $filter . " `" . $data['category_date_type'] . "` >= '" . $data['category_date_start'] . "'";
            }
            if (!empty($data['category_date_end'])) {
                if ($filter != "") $filter = $filter . " AND ";
                $filter = $filter . " `" . $data['category_date_type'] . "` <= '" . $data['category_date_end'] . "'";
            }
        }
        
        if ($filter != "") $filter = "WHERE " . $filter;
    }
    return  $filter;
}
