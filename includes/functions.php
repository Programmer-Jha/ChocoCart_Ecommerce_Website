<?php
    // Developed By: Aniket Kumar Jha
    function prx($arr) {
        echo '<pre>';
        print_r($arr);
        die();
    }

    function get_safe_value($con, $str) {
        if($str != '') {
            $str = trim($str);
            return mysqli_real_escape_string($con, $str);
        }
    }

    function get_product($con, $limit='', $cat_id='', $product_id='', $search_str='') {
        $sql = "SELECT cc_product.*,cc_category.categories FROM cc_product,cc_category WHERE cc_product.status=1";
        if($cat_id != '') {
            $sql .= " and cc_product.categories_id=$cat_id ";
        }
        if($product_id != '') {
            $sql .= " and cc_product.id=$product_id ";
        }
        $sql .= " and cc_product.categories_id=cc_category.id ";
        $sql.=" ORDER BY cc_product.id DESC";
        if($limit != '') {
            $sql.=" LIMIT $limit";
        }
        $res = mysqli_query($con, $sql);
        $data = array();
        while($row=mysqli_fetch_assoc($res)) {
            $data[] = $row;
        }
        return $data;
    }

    function get_related_products($con, $category_id, $product_id, $limit = 4) {
        $sql = "SELECT * FROM cc_product 
            WHERE categories_id = '$category_id' 
            AND id != '$product_id' 
            AND status = 1 
            ORDER BY id DESC 
            LIMIT $limit";
    
        $res = mysqli_query($con, $sql);
        $data = [];

        while ($row = mysqli_fetch_assoc($res)) {
            $data[] = $row;
        }

        return $data;
    }

    function get_cart_qty($con, $user_id) {
        $total_qty = 0;
        if ($user_id) {
            $sql = "SELECT SUM(quantity) as total_qty FROM cc_cart WHERE user_id = '$user_id'";
            $res = mysqli_query($con, $sql);
            if ($res) {
                $row = mysqli_fetch_assoc($res);
                $total_qty = $row['total_qty'] ?? 0;
            }
        }
        return $total_qty;
    }
?>