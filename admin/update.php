<?php
session_start();
if (!isset($_SESSION["logged_in"])) {
    header("location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $_SESSION['job_id'] = $_GET['id'];
}
$conn = new mysqli('localhost', 'root', '', 'project');

$sql_fetch = "SELECT * FROM `jobs` WHERE id='{$_SESSION['job_id']}'";

if ($result = mysqli_query($conn, $sql_fetch)) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        echo "<br>" . $row['id'] . "<br>";

        $real_job_id = $row['id'];
        $company_name = $row['company'];
        $company_logo_url = $row['company_logo_url'];
        $title = $row['title'];
        $description = $row['description'];
        $apply_url = $row['apply_url'];
        $tag = $row['tag'];
    }
}

// $company_name = $company_logo_url = $title = $description = $apply_url = $tag = "";
$company_name_err = $company_logo_url_err = $title_err = $description_err = $apply_url_err = $tag_err = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $input_company_name = trim($_POST["company_name"]);

    if (empty($input_company_name)) {
        $company_name_err = "Please enter a company name.";
    } else {
        $company_name = $input_company_name;
    }

    $input_company_logo_url = trim($_POST["company_logo_url"]);

    if (empty($input_company_logo_url)) {
        $company_logo_url_err = "Please enter a company logo url.";
    } else {
        $company_logo_url = $input_company_logo_url;
    }

    $input_job_title = trim($_POST["job_title"]);

    if (empty($input_job_title)) {
        $title_err = "Please enter a job title.";
    } else {
        $title = $input_job_title;
    }

    $input_job_description = trim($_POST["job_description"]);

    if (empty($input_job_description)) {
        $description_err = "Please enter a job description.";
    } else {
        $description = $input_job_description;
    }

    $apply_url = trim($_POST["job_apply_url"]);

    $input_job_tag = trim($_POST["job_tag"]);
    if (empty($input_job_tag)) {
        $tag_err = "Please enter a tag.";
    } else {
        $tag = $input_job_tag;
    }

    if (
        empty($company_name_err) && empty($company_logo_url_err) && empty($title_err)
        && empty($tag_err) && empty($description_err) && empty($apply_url_err)
    ) {

        // UPDATE `jobs` SET `company` = 'UYS.AL a a', `company_logo_url` = 'https://logos-world.net/wp-content/uploads/2021/11/Meta-Symbol.png a', `title` = 'Scientist 1 a', `description` = 'Bomboş bir description a', `apply_url` = '--- a', `publisher` = 'admin a', `tag` = 'scientist 21' WHERE `jobs`.`id` = 1

        $sql = "UPDATE `jobs` SET 
            `company`='{$company_name}', 
            `company_logo_url`='{$company_logo_url}', 
            `title`='{$title}', 
            `description`='{$description}', 
            `tag`='{$tag}', 
            `apply_url`='{$apply_url}' 
        WHERE `id`='{$_SESSION['job_id']}'";

        if ($conn->query($sql) === TRUE) {
            echo "SQL: '{$sql}'" . "<br>";
            echo "Job id: '{$real_job_id}'";
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
    <title>Update A Job Ads</title>
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
                    <h2 class="mt-5">Update a Job Ads</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" name="company_name" class="form-control <?php echo (!empty($company_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $company_name; ?>">
                            <span class="invalid-feedback"><?php echo $company_name_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Company Logo URL</label>
                            <input type="text" name="company_logo_url" class="form-control <?php echo (!empty($company_logo_url_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $company_logo_url; ?>">
                            <span class="invalid-feedback"><?php echo $company_logo_url_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Job Title</label>
                            <input type="text" name="job_title" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $title; ?>">
                            <span class="invalid-feedback"><?php echo $title_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Job Description</label>
                            <textarea name="job_description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>"><?php echo $description; ?></textarea>
                            <span class="invalid-feedback"><?php echo $description_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Job Apply URL</label>
                            <input type="text" name="job_apply_url" value="<?php echo $apply_url; ?>">
                        </div>
                        <div class="form-group">
                            <label>Tag</label>
                            <input type="text" name="job_tag" class="form-control <?php echo (!empty($tag_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $tag; ?>">
                            <span class="invalid-feedback"><?php echo $tag_err; ?></span>
                        </div>
                        <button type="submit" class="btn btn-primary" value="Save Job Ad">Save Job Ad</button>
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>