<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap 4 Product List</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>

<style>
    body {
        margin: 0;
        padding-bottom: 80px; /* space for fixed button */
        background-color: #f2f2f2;
    }

    .container {
        width: 100%;
        max-width: 500px;
        margin: 30px auto;
        box-shadow: 0 4px 10px rgba(0, 0, 1, 0.1);
        background-color: #fff;
        border-radius: 12px;
        padding: 20px;
    }

    .product-box {
        display: flex;
        align-items: center;
        border: 1px solid #ddd;
        padding: 15px;
        margin-bottom: 15px;
        border-radius: 12px;
        background: #ffffff;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        transition: transform 0.2s ease;
    }

    .product-box:hover {
        transform: scale(1.01);
    }

    .product-box img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        margin-right: 15px;
        border-radius: 8px;
        border: 1px solid #ccc;
    }

    .product-box .details h5 {
        margin: 0;
        font-size: 1rem;
        font-weight: 600;
    }

    .product-box .details p {
        margin: 5px 0 0;
        color: #555;
    }

    .qty-controls {
        display: flex;
        align-items: center;
        margin-left: auto;
    }

    .qty-controls input {
        width: 60px;
        text-align: center;
        margin: 0 6px;
        height: 35px;
    }
.product-list-scroll {
    max-height: calc(100vh - 220px);
    overflow-y: auto;
    padding-right: 10px;

    /* Hide scrollbar for all browsers */
    scrollbar-width: none; /* Firefox */
    -ms-overflow-style: none;  /* Internet Explorer 10+ */
}

.product-list-scroll::-webkit-scrollbar {
    display: none; /* Chrome, Safari, Opera */
}


    @media (min-width: 768px) {
        .product-box {
            min-height: 140px;
            padding: 20px;
        }

        .product-box img {
            width: 90px;
            height: 90px;
        }

        .product-box .details h5 {
            font-size: 1.25rem;
        }
    }

   .product-wrapper {
    position: relative;
    max-height: calc(100vh - 120px); /* Adjust as per header size */
    overflow-y: auto;
    padding-bottom: 30px; /* space for fixed button */
}

.send-btn-wrapper {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    padding: 2px;
    background: white; /* for visibility */
    box-shadow: 0 -2px 5px rgba(0,0,0,0.05);
}

</style>


    </style>
</head>
<body>
    <div class="container py-4">
        <!-- PHP: Get first category ID safely -->
        <?php
        $first_cat_id = (!empty($cats) && isset($cats[0]['category_id'])) ? $cats[0]['category_id'] : 0;
        ?>

        <!-- Category Buttons -->
        <?php if (!empty($cats)) : ?>
            <div class="btn-group btn-group-toggle d-flex flex-wrap" data-toggle="buttons">
                <?php foreach ($cats as $index => $row) { ?>
                    <label class="btn btn-outline-primary m-1 <?php if ($index === 0) echo 'active'; ?>" id="btn-cat-<?= $row['category_id'] ?>" onclick="showProducts(<?= $row['category_id'] ?>)">
                        <input type="radio" name="categories" autocomplete="off" <?php if ($index === 0) echo 'checked'; ?> /> <?= $row['category_name'] ?>
                    </label>
                <?php } ?>
            </div>
        <?php else : ?>
            <p class="text-danger">No categories found.</p>
        <?php endif; ?>

<!-- Wrapper for scroll + fixed button -->
<div class="product-wrapper mt-4">
    
    <!-- Scrollable Product List -->
    <div class="product-list-scroll">
        <div class="row">
            <?php if (!empty($products)) : ?>
                <?php foreach ($products as $row) 
                    {
                    
                    
                    if(isset($_SESSION['cart'][$row['product_id']]))
                         $qty = $_SESSION['cart'][$row['product_id']];
                    else
                         $qty = 0;
                ?>
                    <div class="col-12 mb-4 box box_cat<?= $row['category_id'] ?>" style="display: <?= ($row['category_id'] === $first_cat_id) ? 'block' : 'none'; ?>;">
                        <div class="product-box">
                            <img src="<?=base_url()?>uploads/<?= $row['product_image'] ?>" alt="<?= $row['product_name'] ?>" class="img-fluid" />
                            <div class="details">
                                <h5><?= $row['product_name'] ?></h5>
                                <p>Price: ₹<?= $row['product_price'] ?></p>
                            </div>
                            <div class="qty-controls">
                                <button class="btn btn-outline-secondary btn-sm" onclick="decreaseQty(this,<?=$row['product_id']?>)" aria-label="Decrease quantity">-</button>
                                <input type="number" class="form-control" value="<?=$qty?>" min="0" aria-label="Quantity" />
                                <button class="btn btn-outline-secondary btn-sm" onclick="increaseQty(this,<?=$row['product_id']?>)" aria-label="Increase quantity">+</button>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php else : ?>
                <div class="col-12">
                    <p class="text-warning">No products available.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Fixed Button -->
    <div class="send-btn-wrapper">
        <a href="<?=base_url()?>user/send_to_kichen">
        <button class="btn btn-primary btn-block py-2 font-weight-bold">
            Send To Kitchen
        </button>
        </a>
    </div>
</div>




    <script>
        function showProducts(categoryId) {
            const buttons = document.querySelectorAll('.btn-group-toggle .btn');
            const productBoxes = document.querySelectorAll('.box');

            buttons.forEach(button => button.classList.remove('active'));
            const activeButton = document.getElementById(`btn-cat-${categoryId}`);
            if (activeButton) activeButton.classList.add('active');

            productBoxes.forEach(box => box.style.display = 'none');
            document.querySelectorAll(`.box_cat${categoryId}`).forEach(box => box.style.display = 'block');
        }

        
        function increaseQty(button,product_id) {
            const input = button.previousElementSibling;
            input.value = parseInt(input.value) + 1;

            console.log(input.value,product_id);

            $.ajax({

                "url":"<?=base_url()?>user/add_product_in_session",
                "data":{"product_id":product_id, "qty":input.value}

            }).done(function(res)
            {
                console.log(res);
            });
        }

        function decreaseQty(button,product_id) {
            const input = button.nextElementSibling;
            if(parseInt(input.value) > 0) {
                input.value = parseInt(input.value) -1;

                $.ajax({

                "url":"<?=base_url()?>user/add_product_in_session",
                "data":{"product_id":product_id, "qty":input.value}

            }).done(function(res)
            {
                console.log(res);
            });
            }
        }
    </script>
</body>
</html>