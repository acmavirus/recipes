<canvas id="venhieunhat" width="600" height="200"></canvas>

<script>
    const ctx_venhieunhat = document.getElementById('venhieunhat').getContext('2d');
    const myChart_venhieunhat = new Chart(ctx_venhieunhat, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($dataPointsVNN['x']); ?>,
            datasets: [{
                label: '# of Votes',
                data: <?php echo json_encode($dataPointsVNN['y']); ?>,
                backgroundColor: ["#4661EE", "#EC5657", "#1BCDD1", "#8FAABB", "#B08BEB", "#3EA0DD", "#F5A52A", "#23BFAA", "#FAA586", "#EB8CC6", "#2F4F4F", "#008080", "#2E8B57", "#3CB371", "#90EE90"],
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Lotto ra nhiều trong tháng'
                }
            }
        }
    });
</script>