<?php
include_once 'header.php';
?>

<style>
    .main-topic {
        margin: 0px 30px;
        padding: 30px 10px;
        align-items: center;
        margin-bottom: 40px;
    }

    .table-wishlist thead {
        border-bottom: 1px solid #e5e5e5;
        margin-bottom: 5px;
    }

    .table-wishlist thead tr th {
        padding: 8px 0 18px;
        color: black;
        font-size: 16px;
        font-weight: 700;
    }

    .table-wishlist tr td {
        padding: 25px 0;
        vertical-align: middle;
    }

    .table-wishlist tr td .img-product {
        width: 72px;
        float: left;
        /* margin-right: 31px; */
        line-height: 63px;
    }

    .table-wishlist tr td .img-product img {
        width: 100%;
    }

    .prdt-name {
        display: flex;
        align-items: center;
    }

    .round-black-btn {
        border-radius: 25px;
        background: #00A3FF;
        color: #fff;
        padding: 5px 20px;
        display: inline-block;
        border: solid 2px #00A3FF;
        transition: all 0.5s ease-in-out 0s;
        cursor: pointer;
        font-size: 14px;
    }

    .round-black-btn:hover,
    .round-black-btn:focus {
        background: transparent;
        color: black;
        text-decoration: none;
    }

    .in-stock-box {
        background: black;
        font-size: 12px;
        text-align: center;
        border-radius: 25px;
        padding: 4px 15px;
        display: inline-block;
        color: #fff;
    }

    .trash-icon {
        font-size: 20px;
        color: #212529;
    }
</style>

<div class="main-topic">
    <h2>My Wishlist</h2>
</div>

<div class="container">
    <div class="row">   
        <div class="col-md-12">
            <div class="table-wishlist">
                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                    <thead>
                        <tr>
                            <th width="45%">Product Name</th>
                            <th width="15%">Unit Price</th>
                            <th width="15%">Stock Status</th>
                            <th width="15%"></th>
                            <th width="10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="45%">
                                <div class="prdt-name">
                                    <div class="img-product">
                                        <img src="./Source/images.jpeg" alt="" class="mCS_img_loaded">
                                    </div>
                                    <div class="name-product">
                                        Cranberry Wine
                                    </div>
                                </div>
                            </td>
                            <td width="15%" class="price">Rs.4000.00</td>
                            <td width="15%"><span class="in-stock-box">In Stock</span></td>
                            <td width="15%"><button class="round-black-btn small-btn">Add to Cart</button></td>
                            <td width="10%" class="text-center"><a href="#" class="trash-icon"><i class="far fa-trash-alt"></i></a></td>
                        </tr>
                        <tr>
                            <td width="45%">
                                <div class="prdt-name">
                                    <div class="img-product">
                                        <img src="./Source/images2.jpeg" alt="" class="mCS_img_loaded">
                                    </div>
                                    <div class="name-product">
                                        Cherry Wine
                                    </div>
                                </div>
                            </td>
                            <td width="15%" class="price">Rs.4600.00</td>
                            <td width="15%"><span class="in-stock-box">In Stock</span></td>
                            <td width="15%"><button class="round-black-btn small-btn">Add to Cart</button></td>
                            <td width="10%" class="text-center"><a href="#" class="trash-icon"><i class="far fa-trash-alt"></i></a></td>
                        </tr>
                        <tr>
                            <td width="45%">
                                <div class="prdt-name">
                                    <div class="img-product">
                                        <img src="./Source/images3.png" alt="" class="mCS_img_loaded">
                                    </div>
                                    <div class="name-product">
                                        Chocolate Wine
                                    </div>
                                </div>
                            </td>
                            <td width="15%" class="price">Rs. 5200.00</td>
                            <td width="15%"><span class="in-stock-box">In Stock</span></td>
                            <td width="15%"><button class="round-black-btn small-btn">Add to Cart</button></td>
                            <td width="10%" class="text-center"><a href="#" class="trash-icon"><i class="far fa-trash-alt"></i></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<?php
include_once 'footer.php';
?>