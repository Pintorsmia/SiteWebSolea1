<?php include ('haut.php'); ?>

<script>

    function myUpdate() {
       alert("test");
    }

    function loop() {
        setInterval(myUpdate, 1000);
    }
</script>

<a href="" onclick="myUpdate()">Cliquez moi</a>

<?php include ('bas.php'); ?>