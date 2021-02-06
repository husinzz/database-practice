<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Site</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <!-- TO START -->
    <?php
    $tblName = "pelangan"; // Insert the table name here
    $fk = "IDPelanggan"; // Insert the FK to sort in ascending order
    ?>


    <!-- TODO LIST -->

    <!-- END OF TODO LIST -->

    <?php

    $connection = mysqli_connect(
        "localhost",
        "root",
        "root",
        "testbase"
    );

    if (mysqli_connect_errno()) {
        echo "Connection failed : " . mysqli_connect_errno();
    };

    $query = mysqli_query($connection, 'SHOW COLUMNS FROM ' . $tblName); // fetch column names

    while ($fetchedCol = mysqli_fetch_array($query)) { // place the column names into an array
        $colNames[] = $fetchedCol['Field']; // array filled with field column
    };
    ?>

    <div class="container-md my-5">
        <form action="#" method="post">
            <div class="row">
                <div class="col-md-2 col-sm-12">
                    <h3 class="">Select Term</h3>
                </div>
                <div class="col-md-4 col-sm-12">
                    <!-- START FORM -->
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <select class="border border-dark form-select form-select-md" aria-label=".form-select-md" name="term">
                                <?php
                                for ($val = 0; $val < count($colNames); $val++) {
                                    echo '<option value="' . $colNames[$val] . '">' . $colNames[$val] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="my-1">
                <div class="input-group">
                    <input type="search" name="search" class="form-control border border-dark" placeholder="Search" />
                    <button class="btn btn-light border border-secondary" type="submit" name="submit">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $valQuery = $_POST['term'];  // Storing Selected Value In Variable
            // echo "Searching :" . $valQuery;  // Displaying Selected Value
        }

        if (isset($_POST['search'])) {
            $searchQuery = $_POST['search'];
            // echo 'lol sikon : '. $searchQuery;
        }
        ?>

        <!-- END FORM -->
        <div>
            <?php
            $query = mysqli_query($connection, 'SELECT COUNT(*) FROM ' . $tblName);
            $numOfRow = mysqli_fetch_array($query);
            ?>


            <?php
            if (empty($searchQuery)) {
                echo '<h6 class="text-center my-5">Query Empty</h6>';
            } else {
                $query = mysqli_query($connection, "SELECT * FROM " . $tblName . " WHERE " . $valQuery . " = '" . $searchQuery . "' ORDER BY " . $fk . " asc");
                echo '<table class="table table-hover border border-dark my-1">
                <thead>
                    <tr>';

                for ($val = 0; $val < count($colNames); $val++) {
                    echo '<th scope="col">' . $colNames[$val] . '</th>';
                }

                echo '</tr>
                </thead>
                <tbody>';

                while ($tblData = mysqli_fetch_assoc($query)) {
                    echo '<tr>';
                    for ($val = 0; $val < count($colNames); $val++) {
                        echo '<td class="border border-dark">' . $tblData[$colNames[$val]] . '</td>';
                    }
                    echo '</tr>';
                }

                echo '</tbody>
            </table>';
            }
            ?>



        </div>
    </div>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
</body>

</html>