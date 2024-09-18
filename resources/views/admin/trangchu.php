<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo css('style.css') ?>">
    <title>Trang chủ</title>
    <style>
        button {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="user">
        <form action="#" method="get">
            <input type="hidden" name="action" value="logout">
            <p>Người dùng: 
                <?php
                    if (isset($_SESSION['username'])) {
                        echo $_SESSION['username'];
                    } else {
                        echo 'Không xác định';
                    }
    ?>
            </p>
            <button type="submit">Logout</button>
        </form>
    </div>
    <div class="categorys">
        <p style="display: inline-block; border-bottom: 2px solid red">Giỏ hàng</p> <br>
        <div class="info_cart">
            <?php
    if (! empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $value) {
            echo $key."    SL: $value <br> ";
        }
    } else {
        echo 'Giỏ hàng trống';
    }
    ?>
        </div>
    </div>
    <div class="shop">
    <div class="menu">
            <form action="" method="get">
                <h3>Khu trái cây</h3>
                <span>Chuối</span><button name="add-fruit" value ="Chuối">Thêm</button> <br><br>
                <span>Cà chua</span><button name="add-fruit" value ="Cà chua">Thêm</button><br><br>
                <span>Dưa hấu</span><button name="add-fruit" value ="Dưa hấu">Thêm</button><br><br>
                <span>Nho xanh</span><button name="add-fruit" value ="Nho xanh">Thêm</button><br>
            </form>
        </div>
    </div>
</body>
</html>