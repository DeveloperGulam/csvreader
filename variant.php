<?php
    session_start();
    require_once __DIR__ . '/bigcommerce.php';
    $bigcommerce = new Bigcommerce\Product;
    $products = $bigcommerce->getProduct();
    $product_ids = [];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Zorang :: Akeneo PIM to BigCommerce</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="icon" type="image/ico" href="https://www.akeneo.com/wp-content/themes/akeneo/assets/img/core/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <style>
        body{
            background:#F3EEF9;
            background-image: url('https://www.akeneo.com/wp-content/themes/akeneo/assets/img/hero-waves/akeneo-ico-waves-hero-default.png');
            background-position: right;
            background-repeat: no-repeat;
        }
        .logoSection{
            /* margin-top: 5px;
            margin-left: 5px; */
        }
        .logoSection label {
            font-size: 12px;
            margin-top: -15px;
            margin-left: -10px;
            font-style: italic;
            font-family: fantasy;
        }
        .logo {
            margin-top: 5px;
            margin-left: 5px;
            height:70px;
            max-width: 100%;
            transition: .3s;
            width: auto;
        }
        .main {
            padding: 20px;
            margin-top: 50px;
            margin-left: 25%;
            margin-right: 25%;
            margin-bottom: 50px;
            /* border:1px solid #36145E; */
            background:#F3EEF9;
            border-radius:5px;
            box-shadow: 0 0 2px #36145E;
        }
        .main .title {
            font-weight: 700;
        }
        .mainly {
            border-top: 1px solid #e3e2e2;
            margin-top: 20px;
            background: #ffffff;
            padding: 20px;
        }
        .field-name{
            font-weight: bold;
        }
        .field-title p {
            font-weight: 700;
        }
        .fields-row {
            margin-top: 20px;
        }
        .select-option {
            width: 300px;
        }
        .select-option option {
            width: 300px;
        }
        .btn-primary {
            background-color: #F3EEF9 !important;
            border: 2px solid #9452ba;
            border-radius: 0.5rem;
            color: #000;
        }
        .btn-primary:hover {
            background-color: #9452ba !important;
            border: 2px solid #9452ba;
            border-radius: 0.5rem;
            color: #fff;
        }
        .btn-delete {
            background-color: #fbf7fc !important;
            border: 2px solid #dbd9db;
            border-radius: 0.5rem;
            color: #000;
        }
        .btn-delete:hover {
            background-color: #b3b3b3 !important;
            border: 2px solid #b3b3b3;
            border-radius: 0.5rem;
            color: #fff;
        }
        .hr-tag {
            color: #36145E;
            border-top: 1px dashed red;
        }
        input[type="color"] {
            padding: 0;
            margin: 0;
            outline: none;
            -webkit-appearance: none;
            border: none;
            width: 32px;
            height: 32px;
        }
        input[type="color"]::-webkit-color-swatch-wrapper {
            padding: 0;
        }
        input[type="color"]::-webkit-color-swatch {
            border: none;
        }
    </style>
</head>
<body>
    <div class="logoSection">
        <img class="logo" src="https://upload.wikimedia.org/wikipedia/commons/7/73/Logo_akeneo.png" type="image/jpeg" alt="Akeneo Logo" class="exclude-lazy">
        <label>Zorang Partner</label>
    </div>
    <div class="main">
        <p class="title text-center mt-2">Create Product Variant</p>
        <hr class="hr-tag"/>
        <div class="mainly">
            <form class="fields-row" action="" method="post" encType="multipart/form-data">
                <div class="mb-3">
                    <label for="product_ids" class="form-label">Akeneo URL</label>
                    <select name="data[product_ids][]" id="product_ids" class="form-control" multiple required>
                        <option value="">Select</option>
                        <?php foreach($products["data"] as $product){ ?>
                            <option value="<?= $product['id'] ?>"><?= $product['name'] ?></option>
                        <?php } ?>
                    </select>
                    <div id="sampleHelp" class="form-text">Select product to create variant.</div>
                </div>
                <div class="mb-3">
                    <label for="display_name" class="form-label">Display Name</label>
                    <input type="text" name="data[display_name]" class="form-control" id="display_name" required>
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select name="data[type]" id="type" class="form-control" required>
                        <option value="">Select Type</option>
                        <option value="Swatch">Swatch</option>
                        <option value="Radio">Radio Buttons</option>
                        <option value="rectangle_list">Rectangle List</option>
                        <option value="Dropdown">Dropdown</option>
                    </select>
                </div>
                <div class="mb-3" id="color_parent">
                    <label for="color" class="form-label">Value</label>
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="text" placeholder="Red, Blue / XL, L" name="data[color][]" class="form-control" id="color" required>
                        </div>
                        <div class="col-sm-2 colorDiv" style="display: none;">
                            <input type="color" name="data[color_code][]" class="form-control" id="color_code" required>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <button type="button" class="btn btn-primary float-right btn-add">+ Add More</button>
                    <button type="button" class="btn btn-delete float-right" disabled="true">- Delete One</button>
                </div>
                
                <button type="submit" name="submit" class="btn btn-primary">Save Variant</button>
            </form>
        </div>
    </div>
    <script>
        var count = 1;
        var colorShow = false;
        $(document).ready(function(){
            $('#type').change(function(){
                var type = $('#type').val();
                if(type == 'Swatch') {
                    colorShow = true;
                    $('.colorDiv').show();
                } else {
                    colorShow = false;
                    $('.colorDiv').hide();
                }
            });
            $('.btn-add').click(function(){
                count++;
                $('.btn-delete').prop('disabled', false);
                $("#color_parent").append(`<div class="row mt-2" id="${count}">
                    <div class="col-sm-6">
                        <input type="text" placeholder="Color name" name="data[color][]" class="form-control" id="color" required>
                    </div>
                    <div class="col-sm-2 colorDiv" style="display: ${(colorShow) ? '' : 'none'};">
                        <input type="color" name="data[color_code][]" class="form-control" id="color_code" required>
                    </div>
                </div>`);
            });
            $('.btn-delete').click(function(){
                // console.log(count);
                if(count > 1) {
                    $("#"+count).last().remove();
                    count--;
                    $('.btn-delete').prop('disabled', false);
                } else {
                    $('.btn-delete').prop('disabled', true);
                }
            });
        });
    </script>
    <?php
    if(isset($_POST['submit'])){
        $data = $_POST['data'];
        echo "<pre>";
        print_r($data);die;
        $result = $bigcommerce->createProductOption($data);
        if($result){
            echo '<script>toastr.success("Variant added successfully!!");</script>';
        } else {
            echo "<pre>";
            print_r($result);
            echo '<script>toastr.error("Something went wrong!!");</script>';
        }
    }
    
    ?>
</body>
</html>