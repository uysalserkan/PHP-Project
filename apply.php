<?php
session_start();
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

$username = $usersurname = $useremail = $usercv_link = "";
$username_err = $usersurname_err = $useremail_err = $usercv_link_err = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $input_username = trim($_POST["username"]);

    if (empty($input_username)) {
        $username_err = "Please enter a company name.";
    } else {
        $username = $input_username;
    }

    $input_usersurname = trim($_POST["usersurname"]);

    if (empty($input_usersurname)) {
        $usersurname_err = "Please enter a company logo url.";
    } else {
        $usersurname = $input_usersurname;
    }

    $input_job_useremail = trim($_POST["job_useremail"]);

    if (empty($input_job_useremail)) {
        $useremail_err = "Please enter a job useremail.";
    } else {
        $useremail = $input_job_useremail;
    }

    $input_job_usercv_link = trim($_POST["job_usercv_link"]);

    if (empty($input_job_usercv_link)) {
        $usercv_link_err = "Please enter a job usercv_link.";
    } else {
        $usercv_link = $input_job_usercv_link;
    }

    if (
        empty($username_err) && empty($usersurname_err) && empty($useremail_err)
        && empty($tag_err) && empty($usercv_link_err) && empty($apply_url_err)
    ) {
        $last_insert_id = mysqli_insert_id($conn);
        $date = date("F j, Y \a\t g:ia");

        $sql = "INSERT INTO `apply` ( `job_id`, `name`, `surname`, `email`, `cv_link`)
        VALUES ( '{$_SESSION['apply_job_id']}', '{$username}', '{$usersurname}', '{$useremail}', '{$usercv_link}');";

        if ($conn->query($sql) === TRUE) {
            header("location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    mysqli_close($conn);
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <title>Job Apply Page | ZS25</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Apply The <?php echo $title . "\t -> <u>" . $company_name . "</u>"; ?></h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                            <span class="invalid-feedback"><?php echo $username_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Surname</label>
                            <input type="text" name="usersurname" class="form-control <?php echo (!empty($usersurname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $usersurname; ?>">
                            <span class="invalid-feedback"><?php echo $usersurname_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Mail Address</label>
                            <input type="text" name="job_useremail" class="form-control <?php echo (!empty($useremail_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $useremail; ?>">
                            <span class="invalid-feedback"><?php echo $useremail_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>CV Link</label>
                            <input name="job_usercv_link" class="form-control <?php echo (!empty($usercv_link_err)) ? 'is-invalid' : ''; ?>"><?php echo $usercv_link; ?></input>
                            <span class="invalid-feedback"><?php echo $usercv_link_err; ?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Apply Job">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>