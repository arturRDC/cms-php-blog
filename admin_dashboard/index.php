<?php
include 'includes/header.php';
?>


<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php
        include 'includes/navigation.php';
        ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Administrator Dashboard
                            <br>
                            <small><?php echo "Welcome, " . $_SESSION['first_name'] ?></small>
                        </h1>


                    </div>
                </div>
                <!-- /.row -->
                <?php
                include "dashboard.php";
                ?>
                <script type="text/javascript">
                    google.charts.load("current", {
                        packages: ["bar"]
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Amount'],

                            <?php
                            echo "['Draft Posts', {$numDraftPosts}],";
                            echo "['Pending Comments', {$numPendingComments}],";
                            echo "['Posts', {$numPosts}],";
                            echo "['Comments', {$numComments}],";
                            echo "['Categories', {$numCategories}],";
                            echo "['Users', {$numUsers}],";
                            ?>

                        ]);
                        console.log(data);


                        var options = {
                            chart: {
                                title: "",
                                subtitle: "",
                            },
                        };

                        var chart = new google.charts.Bar(
                            document.getElementById("columnchart_material")
                        );

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>
                <div id="columnchart_material" style="width: auto; height: 500px;"></div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php
    include 'includes/footer.php';
    ?>