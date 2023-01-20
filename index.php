<?php
    session_start();
    require_once __DIR__ . '/Akeneo.php';
    $akeneo = new Akeneo\Akeneo;
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
        <p class="title text-center mt-2">Connect with Akeneo</p>
        <hr class="hr-tag"/>
        <div class="mainly">
            <form class="fields-row" action="" method="post" encType="multipart/form-data">
                <div class="mb-3">
                    <label for="akeneoUrl" class="form-label">Akeneo URL</label>
                    <input type="url" name="data[akeneo_url]" class="form-control" id="akeneoUrl" aria-describedby="akeneoUrl" required>
                    <div id="sampleHelp" class="form-text">Please enter the url file of your Akeneo.</div>
                </div>
                <div class="mb-3">
                    <label for="client_id" class="form-label">ClientId</label>
                    <input type="text" name="data[client_id]" class="form-control" id="client_id" required>
                </div>
                <div class="mb-3">
                    <label for="secret" class="form-label">Secret</label>
                    <input type="text" name="data[secret]" class="form-control" id="secret" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="data[username]" class="form-control" id="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="data[password]" class="form-control" id="password" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Connect</button>
            </form>
        </div>
    </div>

    <?php
    if(isset($_POST['submit'])){
        $data = $_POST['data'];

        $result = $akeneo->getAuthToken($data);
        if($result){
            if(empty($result['code'])){
                
                $_SESSION['connection'] = $result;
                $_SESSION['connection']['akeneo_url'] = $data['akeneo_url'];
                if (!headers_sent()) {
                    header('Location: ./mapping.php');die();
                } else {
                    echo '<script>window.location.href="./mapping.php";</script>';
                }
            } else if(empty($result[0]['error'])) {
                echo '<script>toastr.error("'.$result[0]['error']['message'].'");</script>';
            } else {
                echo '<script>toastr.error("'.$result['message'].'");</script>';
            }
        } else {
            echo '<script>toastr.error("Invalid credentials!");</script>';
        }
    }
    
    ?>
</body>
</html>