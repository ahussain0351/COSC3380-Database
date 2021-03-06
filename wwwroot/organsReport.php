
<?php
    session_start();

    if( $_SESSION['userRole'] != "Admin" &&
        $_SESSION['userRole'] != "Doctor")
        header("Location: /");
?>

<!--    PAGE HEADER   -->
<?php
    require "WebsiteContent/Header.php";
?>

<!--    Connect to the MySQL database   -->
<?php
    require "Database/MySQLconfig.php";
?>

<!-- Top Bar -->
<?php
    require "WebsiteContent/TopBar/TopBar.php";
?>

<!-- Left Sidebar -->
<?php
    require "WebsiteContent/LeftSidebar/LeftSidebar.php";
?>


<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">
    <!--    Donor table -->
    <div id="organsReportTable" class="w3-container w3-section w3-padding-large w3-card-4 w3-light-grey">
        <h2>Organ Stats</h2>

     
<?php


    $queryOrgansList = "SELECT Organ as organName, count(*) as num from db_organdonorsystem.donor group by Organ order by count(*) desc";
    $results = $conn->query($queryOrgansList);
    $orgransList = $results->fetchAll();

        if(count($orgransList) > 0)
        {?>
            <table class="w3-table-all">
                <thead>
                <tr class="w3-green">
                    <th>#</th>
                    <th>Organ</th>
                    <th># of organ</th>
                    <th>% of total organs</th>
                </tr>
                </thead>

                <?php
                $counter = 1;
                foreach($orgransList as $organ)
                {?>
                    <tr class="w3-hover-green">
                        <td><?= $counter?>.</td>
                        <td><?= $organ['organName']?></td>
                        <td><?= $organ['num']?></td>
                        <td><?= $organ['num']/count($organsList)?></td>
                    </tr>
                    <?php

                    $counter++;
                }?>
            </table>
            <?php
        }
        else
        {?>
            <h3>No organs for donation.</h3>
            <?php
        } 
        Header("Location /");  ?>
    </div>
</div>

<!--    PAGE FOOTER  -->
<?php
    require "WebsiteContent/Footer.php";
?>