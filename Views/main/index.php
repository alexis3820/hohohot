<?php include(ROOT.'/Views/main/header.php'); ?>
<div class="row justify-content-center">
    <div class="col-8 text-center mt-5 mb-5">
        <h1>Bienvenu sur Hohohot !</h1>
        <div class="">
            <canvas id="graph"></canvas>
        </div>
    </div>
</div>
    <script type="text/javascript">
        Chart.defaults.global.title.display = true;
        Chart.defaults.global.title.text = 'Températures'
        var ctx = document.getElementById('graph').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: [<?php foreach($temperatures as $temperature){
                    echo $temperature['date'].',';
                } ?>],
                datasets: [{
                    label: 'Températures Extérieur',
                    backgroundColor: 'rgba(255, 255, 227,0.3)',
                    borderColor: 'rgb(255, 255, 227)',
                    // data: [0, 10, 5, 2, 20, 30, 33]
                    data: [<?php foreach($temperatures as $temperature){
                        echo $temperature['value_ext'].',';
                    } ?>]
                }]
            },

            // Configuration options go here
            options: {
                title:{
                    text: 'Evolution des températures'
                },
                elements:{
                    point:{
                        radius: 5,
                        backgroundColor: "rgb(0,0,255)"
                    }
                }
            }
        });
    </script>
<?php include(ROOT.'/Views/main/footer.php'); ?>