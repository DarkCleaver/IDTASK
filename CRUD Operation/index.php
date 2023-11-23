<?php include 'connection.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>E-Library Hub</title>
    <style>
        body {
            background: url("img/sun-tornado.svg") no-repeat center center;
            background-size: cover;
            height: auto;
            margin: 0;
        }

        /* table.scroll {
			border:1px #a9c6c9 solid;
		}
        table.scroll thead {
			display:table;
		}
		table.scroll tbody {
			display:block;
			height:400px;
			overflow:auto;
			float:left;
			width:100%;
		}
		table.scroll tbody tr {
			display:table;
			width:100%;
		}
		table.scroll th, td {
			width:33%;
			padding:8px;
		} */
    </style>
</head>

<body>
    <!-- style="background-image: linear-gradient(to right, #0172af, #74febd);" -->
    <nav class="navbar navbar-expand-lg sticky-top" style="background-color: #0172af;">
        <div class="container-fluid mx-5">
            <a class="navbar-brand fw-bold text-white" href="#">E-Library Hub</a>
            <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> -->
            <form>
                <a class="btn fw-bold" style="background-color: white;" href=" "><img src="img/admin.svg" width="20" height="20" class="d-inline-block align-top" alt=""></a>
            </form>
            <!-- <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto mb-2 mb-xl-0 mx-5">
                    <li class="nav-item">
                        <a class="nav-link active text-white" ia-current="page" href="overview.php">Overview</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="dataeditor.php">Data Editor</a>
                    </li>
                </ul>
            </div> -->
        </div>
    </nav>

    <main>
    <div class="container">
    <div class="row justify-content-center">
    <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4  mx-auto">
        <h1 data-text="Books">Books</h1>
        <?php if (!isset($_GET['view'])) { ?>

            <a class="btn btn-success mb-3" href="?page=index&view=insert">Create Book</a>
            <table class="table table-striped scroll">
                <tr>
                    <th>Cover</th>
                    <th>No</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                <?php
                $no = 0;
                $hasil = mysqli_query($db, "SELECT * FROM books");

                while ($row = mysqli_fetch_object($hasil)) {
                    $no++;
                ?>
                    <tr>
                        <td><img style="width: 70px; height: 100px;" src="<?= $row->photo ?>"></td>
                        <td><?= $no ?></td>
                        <td><?= $row->title ?></td>
                        <!-- <td><?=
                            $limitedtitle = substr($row->title, 0, 70) . '...';
                            ?></td> -->
                        <td><?= $row->category_id ?></td>
                        <td><?= $row->publish_at ?></td>
                        <td><a class="btn btn-warning" href="?page=index&view=update&id=<?= $row->id ?>">Update</a>
                            <a class="btn btn-danger" href="dataeditor-process.php?action=delete&id=<?= $row->id ?>">Delete</a>
                        </td>
                    </tr>
                <?php } ?>

            </table>
        <?php } else if ($_GET['view'] == 'insert') { ?>

            <form method="post" action="dataeditor-process.php?action=insert" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Book Title">
                </div>
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category" class="form-select">
                        <option value="1">Novel</option>
                        <option value="2">Comic</option>
                        <option value="3">Biography</option>
                        <option value="4">Magazine</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Publish Date</label>
                    <input type="date" name="publish" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Cover</label>
                    <input type="file" name="cover" class="form-control">
                </div>
                <div class="d-flex gap-5">
                    <a href="index.php" class="btn w-50 py-2" style="background-color: #EE9322;"><button class="btn  text-white">Cancel</button></a>
                    <button class="btn w-50 py-2 text-white" style="background-color: #0C356A;" type="submit">Save</button>
                </div>

            </form>

        <?php } else if ($_GET['view'] == 'update') { ?>
            <?php
            $hasil = mysqli_query($db, "SELECT * FROM books WHERE id='$_GET[id]'");
            while ($row = mysqli_fetch_object($hasil)) {
            ?>
                <form method="post" action="dataeditor-process.php?action=update&id=<?= $_GET['id'] ?> " enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">title</label>
                        <input type="text" name="title" value="<?= $row->title ?>" class="form-control" placeholder="Book Title">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select name="category" class="form-select">
                            <option value="1">Novel</option>
                            <option value="2">Comic</option>
                            <option value="3">Biography</option>
                            <option value="4">Magazine</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Publish Date</label>
                        <input type="date" name="publish" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cover</label>
                        <input type="file" name="cover" class="form-control">
                    </div>
                    <div class="d-flex gap-5">
                    <a href="index.php" class="btn w-50 py-2" style="background-color: #EE9322;"><button class="btn  text-white">Cancel</button></a>
                    <button class="btn w-50 py-2 text-white" style="background-color: #0C356A;" type="submit">Save</button>
                    </div>
                    
                </form>
        <?php }
        } ?>

    </div>
    </div>
    </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>