<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
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
        .hr-tag {
            color: #36145E;
            border-top: 1px dashed red;
        }
    </style>
</head>
<body>
    <div class="logoSection">
        <img class="logo" src="https://upload.wikimedia.org/wikipedia/commons/7/73/Logo_akeneo.png" type="image/jpeg" alt="Akeneo Logo" class="exclude-lazy">
        <label>Zorang Partner</label>
    </div>
    <div class="main">
        <p class="title text-center mt-2">Attribute Mapping/Data Sync</p>
        <hr class="hr-tag"/>
        <div class="mainly">
            <form class="fields-row" action="" method="post" encType="multipart/form-data">
                <div class="mb-3">
                    <label for="sampleFile" class="form-label">Upload Sample File</label>
                    <input type="file" name="sample_file" class="form-control" id="sampleFile" aria-describedby="sampleHelp" required>
                    <div id="sampleHelp" class="form-text">Please upload the sample file of BigCommerce.</div>
                </div>
                <div class="mb-3">
                    <label for="akeneoFile" class="form-label">Upload Akeneo File</label>
                    <input type="file" name="akeneo_file" class="form-control" id="akeneoFile" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Next</button>
            </form>
        </div>
    </div>

    <?php
    if(isset($_POST['submit'])){
        $mimes = array('application/vnd.ms-csv','text/csv');
        if(in_array($_FILES['sample_file']['type'], $mimes) && in_array($_FILES['akeneo_file']['type'], $mimes)){
            session_start();
            // sample data processing
            $sample_header = [];
            $sample_data = [];
            $sample_file = $_FILES['sample_file']['tmp_name'];
            $sampleHandle = fopen($sample_file,"r");
            $sample_row_counter = 0;
            while (($sampleRow = fgetcsv($sampleHandle, 10000, ",")) != FALSE){
                if($sample_row_counter) {
                    $sample_data[] = $sampleRow;
                } else {
                    $sample_header = $sampleRow;
                }
                $sample_row_counter++;

            }
            $_SESSION["sample_header"] = $sample_header;
            $_SESSION["sample_data"] = $sample_data;

            //akeneo data processing
            $akeneo_file = $_FILES['akeneo_file']['tmp_name'];
            $akeneo_rows = $fields = array(); 
            // $i = 0;
            // $handle = @fopen($akeneo_file, "r");
            // echo "<pre>";
            // if ($handle) {
            //     while (($row = fgetcsv($handle, 4096)) !== false) {
            //         if (empty($fields)) {
            //             $fields = $row;
            //             continue;
            //         }
            //         foreach ($row as $k=>$value) {
            //             if(!empty([$fields[$k]])){
            //                 $akeneo_rows[$i][$fields[$k]] = $value;
            //             }
            //         }
            //         $i++;
            //     }
            //     if (!feof($handle)) {
            //         echo "Error: unexpected fgets() fail\n";
            //     }
            //     fclose($handle);
            // }
            // $assocData = array();

            if( ($handle = fopen($akeneo_file, "r")) !== FALSE) {
                $rowCounter = 0;
                while (($rowData = fgetcsv($handle, 0, ",")) !== FALSE) {
                    if( 0 === $rowCounter) {
                        $headerRecord = $rowData;
                    } else {
                        foreach( $rowData as $key => $value) {
                            $akeneo_rows[ $rowCounter - 1][ $headerRecord[ $key] ] = $value;  
                        }
                    }
                    $rowCounter++;
                }
                fclose($handle);
            }
            // echo "<pre>";
            // print_r($akeneo_rows);
            // die;
            $_SESSION["akeneo_rows"] = $akeneo_rows;
            
            $akeneo_header = [];
            $akeneo_data = [];
            $akeneo_file = $_FILES['akeneo_file']['tmp_name'];
            $akeneoHandle = fopen($akeneo_file,"r");
            $akeneo_row_counter = 0;
            while (($akeneoRow = fgetcsv($akeneoHandle, 10000, ",")) != FALSE){
                if($akeneo_row_counter) {
                    $akeneo_data[] = $akeneoRow;
                } else {
                    $akeneo_header = $akeneoRow;
                }
                $akeneo_row_counter++;
            }
            $_SESSION["akeneo_data"] = $akeneo_data;
            $_SESSION["akeneo_header"] = $akeneo_header; 

            // $sample_header = (empty($sample_header)) ? $_SESSION["sample_header"] : $sample_header; 
            // $sample_data = (empty($sample_data)) ? $_SESSION["sample_data"] : $sample_data; 
            // $akeneo_header = (empty($akeneo_header)) ? $_SESSION["akeneo_header"] : $akeneo_header; 
            // $akeneo_data = (empty($akeneo_data)) ? $_SESSION["akeneo_data"] : $akeneo_data;
            header('Location: ./compare.php');die();
        } else {
          ?>
            <script>
              toastr.error('Sorry, this file type not allowed, please upload CSV file only.');
            </script>
          <?php
        }
    }
    
    ?>
</body>
</html>