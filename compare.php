<?php
    session_start();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <style>
        body{
            background:#F3EEF9;
            background-image: url('https://www.akeneo.com/wp-content/themes/akeneo/assets/img/hero-waves/akeneo-ico-waves-hero-default.png');
            background-position: right;
            background-position-y: bottom;
            background-repeat: no-repeat;
        }
        .logoSection{
            margin-top: 15px;
            margin-left: 15px;
        }
        .logoSection label {
            font-style: italic;
            font-family: fantasy;
        }
        .logo {
            height: 35px;
            max-width: 100%;
            transition: .3s;
            width: auto;
        }
        .main {
            padding: 50px;
            margin-top: 20px;
            margin-left: 25%;
            margin-right: 20%;
            margin-bottom: 30px;
            /* border:1px solid #36145E; */
            background:#F3EEF9;
            border-radius:5px;
            box-shadow: 0 0 2px #36145E;
        }
        .main .title {
            margin-top: -20px;
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
        /* .select-option {
            width: 300px;
        }
        .select-option option {
            width: 300px;
        } */
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
    </style>
</head>
<body>
    <div class="logoSection">
        <img class="logo" src="data:image/png;base64,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" type="image/jpeg" alt="Akeneo Logo" class="exclude-lazy">
        <label>Zorang Partner</label>
    </div>
    <div class="main">
        <p class="title text-center">Attribute Mapping/Data Sync</p>
        <div class="mainly">
            <div class="row">
                <div class="col-sm-6 field-title border-bottom"><p>AKENEO ATTRIBUTE</p></div>
                <div class="col-sm-6 field-title border-bottom"><p>FIELD IN BIGCOMMERCE</p></div>
            </div>
            <form class="fields-row" action="" method="post" encType="multipart/form-data">
                <?php foreach($_SESSION["sample_header"] as $field){ ?>
                <div class="row fields-row">
                    <div class="col-sm-6">
                        <select name="data[<?=$field?>]" class="form-control select-option">
                            <option value="">Select</option>
                            <?php foreach($_SESSION["akeneo_header"] as $option){ ?>
                                <option value="<?= $option ?>"><?= $option ?></option>
                            <?php } ?>
                        </select>
                        <!-- <input type="hidden" name="data[bigcommerce][]" value="<?= $field ?>" /> -->
                    </div>
                    <div class="col-sm-6">
                        <p class="field-name"><?= $field ?></p>
                    </div>
                </div>
                <?php } ?>
                <br/>
                <button type="submit" id="submit_attribute" name="submit_attribute" class="btn btn-primary">Generate CSV</button>
                <a href="#" style="display:none;" type="button" id="downloadBtn" name="downloadBtn" class="btn btn-primary"><i class="fa fa-download"></i> Download CSV</a>
            </form>
        </div>
    </div>
    <?php
    if(isset($_POST['submit_attribute'])){
        $data = $_POST['data'];
        $akeneo_rows = $_SESSION["akeneo_rows"];
        $filter_data = [];
        $filter_data[] = $_SESSION["sample_header"];
        foreach($akeneo_rows as $key => $value){
            $temp_data = [];
            foreach($data as $bigcom => $akeneo){
                $temp_data[] = (!empty($value[$akeneo])) ? $value[$akeneo] : '';
            }
            $filter_data[] = $temp_data;
        }
        $location = './target/';
        $file_name = 'target.csv';
        $file_dir = $location . $file_name;

        $fp = fopen($file_dir, 'w');
        foreach ($filter_data as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);
        ?>
        <script type="text/javascript">
            var fileDir = "<?= $file_dir?>";
            document.getElementById('downloadBtn').style.display = 'block';
            document.getElementById('downloadBtn').href = fileDir;
            document.getElementById('submit_attribute').style.display = 'none';
        </script>
        <?php
    }
    ?>
</body>
</html>