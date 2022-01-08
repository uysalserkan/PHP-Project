<?php
session_start();
if (!isset($_SESSION["logged_in"])) {
    header("location: login.php");
    exit;
}
if (isset($_GET['id'])) {
    $_SESSION['apply_job_id'] = $_GET['id'];
} else {
    header("location: index.php");
}


$conn = new mysqli('localhost', 'root', '', 'project');

$sql_fetch = "SELECT * FROM `jobs` WHERE id='{$_SESSION['apply_job_id']}'";

if ($result = mysqli_query($conn, $sql_fetch)) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        $company_name = $row['company'];
        $company_logo_url = $row['company_logo_url'];
        $title = $row['title'];
        $description = $row['description'];
        $apply_url = $row['apply_url'];
        $tag = $row['tag'];
    }
}

?>

<HTML>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title><?php echo $title; ?> Applies | 25ZS</title>

    <style>
        body {
            margin-top: 20px;
        }


        /* USER LIST TABLE */
        .user-list tbody td>img {
            position: relative;
            max-width: 50px;
            float: left;
            margin-right: 15px;
        }

        .user-list tbody td .user-link {
            display: block;
            font-size: 1.25em;
            padding-top: 3px;
            margin-left: 60px;
        }

        .user-list tbody td .user-subhead {
            font-size: 0.875em;
            font-style: italic;
        }

        /* TABLES */
        .table {
            border-collapse: separate;
        }

        .table-hover>tbody>tr:hover>td,
        .table-hover>tbody>tr:hover>th {
            background-color: #eee;
        }

        .table thead>tr>th {
            border-bottom: 1px solid #C2C2C2;
            padding-bottom: 0;
        }

        .table tbody>tr>td {
            font-size: 0.875em;
            background: #f5f5f5;
            border-top: 10px solid #fff;
            vertical-align: middle;
            padding: 12px 8px;
        }

        .table tbody>tr>td:first-child,
        .table thead>tr>th:first-child {
            padding-left: 20px;
        }

        .table thead>tr>th span {
            border-bottom: 2px solid #C2C2C2;
            display: inline-block;
            padding: 0 5px;
            padding-bottom: 5px;
            font-weight: normal;
        }

        .table thead>tr>th>a span {
            color: #344644;
        }

        .table thead>tr>th>a span:after {
            content: "\f0dc";
            font-family: FontAwesome;
            font-style: normal;
            font-weight: normal;
            text-decoration: inherit;
            margin-left: 5px;
            font-size: 0.75em;
        }

        .table thead>tr>th>a.asc span:after {
            content: "\f0dd";
        }

        .table thead>tr>th>a.desc span:after {
            content: "\f0de";
        }

        .table thead>tr>th>a:hover span {
            text-decoration: none;
            color: #2bb6a3;
            border-color: #2bb6a3;
        }

        .table.table-hover tbody>tr>td {
            -webkit-transition: background-color 0.15s ease-in-out 0s;
            transition: background-color 0.15s ease-in-out 0s;
        }

        .table tbody tr td .call-type {
            display: block;
            font-size: 0.75em;
            text-align: center;
        }

        .table tbody tr td .first-line {
            line-height: 1.5;
            font-weight: 400;
            font-size: 1.125em;
        }

        .table tbody tr td .first-line span {
            font-size: 0.875em;
            color: #969696;
            font-weight: 300;
        }

        .table tbody tr td .second-line {
            font-size: 0.875em;
            line-height: 1.2;
        }

        .table a.table-link {
            margin: 0 5px;
            font-size: 1.125em;
        }

        .table a.table-link:hover {
            text-decoration: none;
            color: #2aa493;
        }

        .table a.table-link.danger {
            color: #fe635f;
        }

        .table a.table-link.danger:hover {
            color: #dd504c;
        }

        .table-products tbody>tr>td {
            background: none;
            border: none;
            border-bottom: 1px solid #ebebeb;
            -webkit-transition: background-color 0.15s ease-in-out 0s;
            transition: background-color 0.15s ease-in-out 0s;
            position: relative;
        }

        .table-products tbody>tr:hover>td {
            text-decoration: none;
            background-color: #f6f6f6;
        }

        .table-products .name {
            display: block;
            font-weight: 600;
            padding-bottom: 7px;
        }

        .table-products .price {
            display: block;
            text-decoration: none;
            width: 50%;
            float: left;
            font-size: 0.875em;
        }

        .table-products .price>i {
            color: #8dc859;
        }

        .table-products .warranty {
            display: block;
            text-decoration: none;
            width: 50%;
            float: left;
            font-size: 0.875em;
        }

        .table-products .warranty>i {
            color: #f1c40f;
        }

        .table tbody>tr.table-line-fb>td {
            background-color: #9daccb;
            color: #262525;
        }

        .table tbody>tr.table-line-twitter>td {
            background-color: #9fccff;
            color: #262525;
        }

        .table tbody>tr.table-line-plus>td {
            background-color: #eea59c;
            color: #262525;
        }

        .table-stats .status-social-icon {
            font-size: 1.9em;
            vertical-align: bottom;
        }

        .table-stats .table-line-fb .status-social-icon {
            color: #556484;
        }

        .table-stats .table-line-twitter .status-social-icon {
            color: #5885b8;
        }

        .table-stats .table-line-plus .status-social-icon {
            color: #a75d54;
        }
    </style>
</head>

<body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="container">
        <h2><?php echo $title; ?> Applies - <?php echo $company_name ?></h2>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box clearfix">
                    <?php
                    $sql = "SELECT * FROM apply WHERE job_id='{$_SESSION['apply_job_id']}';";
                    if ($result = mysqli_query($conn, $sql)) {
                        if (mysqli_num_rows($result) > 0) {
                            echo '<div class="table-responsive">
                                <table class="table user-list">
                                    <thead>
                                        <tr>
                                            <th><span>Name - Surname</span></th>
                                            <th><span>Applied Date</span></th>
                                            <th class="text-center"><span>CV</span></th>
                                            <th><span>Email</span></th>
                                            <th><span>Delete</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                            while ($row = mysqli_fetch_array($result)) {
                                $img_id = $row['id'] % 9;
                                echo "<tr>
                                <td>
                                    <img src='https://bootdey.com/img/Content/avatar/avatar{$img_id}.png' alt=''>
                                    <a href='#' class='user-link'>{$row['name']} {$row['surname']}</a>
                                </td>
                                <td>
                                    {$row['applied_date']}
                                </td>
                                <td class='text-center'>
                                    <a href='{$row['cv_link']}' target='_blank' class='table-link'>
                                        <span class='fa-stack'>
                                            <i class='fa fa-square fa-stack-2x'></i>
                                            <i class='fa fa-clipboard fa-stack-1x fa-inverse'></i>
                                        </span>
                                    </a>
                                </td>
                                <td>
                                    <a href='mailto:{$row['email']}' target='_blank'>{$row['email']}</a>
                                </td>
                                <td>
                                    <a href='delete_apply.php?id={$row['id']}' class='table-link danger'>
                                        <span class='fa-stack'>
                                            <i class='fa fa-square fa-stack-2x'></i>
                                            <i class='fa fa-trash-o fa-stack-1x fa-inverse'></i>
                                        </span>
                                    </a>
                                </td>           
                            ";
                            }
                            echo "</tbody>
                                </table>
                            </div>";
                        } else {
                            echo '<div class="alert alert-danger"><em>No records were found. Wait a person that apply this job...</em></div>';
                        }
                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</HTML>