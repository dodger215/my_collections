<?php include('includes/header.php'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-9" id="myBillingArea">
            <?= alertMessage(); ?>
            <?php
            //Fecthing the records from the database
            $disaster = mysqli_query($conn, "SELECT * FROM disaster");
            if (mysqli_num_rows($disaster) > 0) {
                foreach ($disaster as $disasterItem) {
            ?>

                    <h3>DISATER REPORT</h3>
                    In the early hours of <?php echo date('d-m-Y') ?>, the entire Nation through the
                    orthodox electronic and social media was traumatized with an unfortunate
                    news of a <?= $disasterItem['type']; ?>that gutted a three (3) storey building at Okaishie -
                    Makola market. The incident created an alarm in the city of Accra which
                    resulted in a huge crowd of onlookers, sympathizers as well as the instant
                    assembly of disaster management organizations and their personnel. At
                    that initial stage of the outbreak, <?= $disasterItem['description']; ?>. Even though the fire could easily have
                    spread to other adjacent buildings on the account of the combustible
                    nature of items or wares that were traded in, the joint hard work and
                    relentless efforts of the Greater Accra Fire service and disaster
                    management teams successfully contained it in the first day and finally put
                    it off by the late hours of <?php echo date('d-m-Y') ?>.
                    Apart from the Mayor of Accra, there were Ministers of State as well as
                    Officers of National and Regional organizations that also visited the scene
                    on many occasions till the disaster ended.
                    The affected building has a basement with few shops, a ground floor, first,
                    second and third floors. While the second and third floors were utterly <br>
                    destroyed, the first floor slightly, the ground and the basement did not
                    experience any burning but suffered from watering as a result of the
                    firefighting process.
                    To establish a scientific record on the incident and to provide a wellgrounded recommendation for the way forward in the management of the
                    particular disaster and other unforeseen fire incidents, the Metropolitan <br>
                    3
                    Chief Executive constituted a seven (7) member committee from various
                    relevant organizations with the powers to co-opt other institutions to
                    conduct an investigation into the fire outbreak and to submit a report on it
                    for necessary action to be taken.
                    <br>
                    <a href="https://www.openstreetmap.org/search?query=<?= $disasterItem['location'];?>"><img width="400" height="550" src='image/<?= $disasterItem['picture']; ?>'></a>
                    <br>
                    <div class="mb-3">
                        <a class="btn btn-primary" onclick="printMyBillingArea()">Click To Generate Disaster Reports</a>
                    </div>
                <?php
                }
            } else {
                ?>
                <p colspan="7">No Record Found</p>
            <?php
            }

            ?>
        </div>
    </div>
</div>

<script>
    //Printing the invoice
    function printMyBillingArea() {
        var divContents = document.getElementById('myBillingArea').innerHTML;
        var a = window.open('', '');
        a.document.write('<html><title> POS System In PHP </title>');
        a.document.write('<body style="font-family: fangsong">');
        a.document.write(divContents);
        a.document.write('</body></html>');
        a.document.close();
        a.print();
    }
</script>

<?php include('includes/footer.php'); ?>