<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="https://cdn.dal.ca/etc/designs/dalhousie/clientlibs/global/default/images/favicon/favicon.ico.lt_cf5aed4779c03bd30d9b52d875efbe6c.res/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">    <title>EZR Admin</title>
</head>
<?php
    include "includes/database.php";
    $currentFileName=basename(__FILE__, '.php');
?>

<div class="jumbotron jumbotron-fluid">
    <div class="container fluid">
        <h1 class="display-3">EZ Redone Proxy Admin</h1>
        <p>Same thing as EZP Admin, but EZR</p>
    </div>
</div>


<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="index.php">EZR Admin</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php if ($currentFileName == 'index.php') { echo "active"; } ?>">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?php if ($currentFileName == 'posts.php') { echo "active"; } ?>">
                <a class="nav-link" href="posts.php">Posts</a>
            </li>
            <li class="nav-item <?php if ($currentFileName == 'report.php') { echo "active"; } ?>">
                <a class="nav-link" href="report.php">Report Issues</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Categories</a>
                <div class="dropdown-menu">

                    <?php
                    $sql = "SELECT * FROM category";
                    $categories_query_result = $conn->query($sql);

                    if ($categories_query_result->num_rows > 0) {
                        while ($row = $categories_query_result->fetch_assoc()) {
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];

                            echo "<a class='dropdown-item' href='category_post.php?c_id=$cat_id'>$cat_title</a>";
                        }
                    }
                    else {
                        echo "No categories exist yet.";
                    }
                    ?>
                </div>
            </li>
            <?php
            if (isset($_SESSION['role'])) {
                if (($_SESSION['role'] == 0) || ($_SESSION['role'] == 1)) {
                    echo "<li class='nav-item'><a class='nav-link' data-toggle='collapse' data-target='#control-panel' href='#'>Control Panel</a></li>";
                }
            }
            ?>
        </ul>



        <!-- User Profile -->
        <?php if(isset($_SESSION['loggedIn'])) {
            $usermenu1 = <<<_END
				<ul class="navbar-nav pull-right">
					<li class="nav-item dropdown">
						<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
_END;

            $usermenu2 = <<<_END
						<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li>
								<a class='dropdown-item' href="admin/dashboard.php">Dashboard</a>
							</li>
							<li>
								<a class='dropdown-item' href="admin/profile.php">Profile</a>
							</li>
							<li>
								<a class='dropdown-item' href="admin/includes/logout.php">Log Out</a>
							</li>
							<li>
								<a class='dropdown-item' href="index.php" target="_blank">View your Site</a>
							</li>
						</ul>
					</li>
				</ul>
_END;
            echo $usermenu1 . $_SESSION['firstname'] . " " . $_SESSION['lastname'] . $usermenu2;
        }
        ?>


        <?php /*
			<form class="form-inline my-2 my-lg-0">
				<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
			</form>
			*/ ?>
    </div>
</nav>