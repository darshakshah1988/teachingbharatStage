<div class="panel-default commercial-panel invoice-status">
    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
        <h2>Payment Status <span>(Invoices)</span></h2>
        <div class="d-flex flex-wrap graph-nav">
            <?php echo $this->Form->control('year', ['options' => $years, 'empty' => false, 'label' => false,'default' => date('Y') , 'class' => 'form-control commercialYear', 'templates' => ['select' => '<select name="{{name}}"{{attrs}}>{{content}}</select>','inputContainer' => '{{content}}', 'formGroup' => '{{input}}']]) ?>
        </div>
    </div>
    <div class="panel-body">
         <div class="chart-container" style="position: relative; height:40vh; width:100%">
            <canvas id="invoiceStatus" width="100%"></canvas>
         </div>
    </div>
    <div class="panel-footer d-flex justify-content-between flex-wrap align-items-center">
        <ul class="graph-indicator">
            <li><span class="income rect">Payment Status</span></li>
        </ul>
        <div>
            <a href="" class="export-btn">Export</a>
        </div>
    </div>
</div>
<script>
<?php $this->Html->scriptStart(['block' => 'inlineScript']); ?>
$(document).ready(() => {
    incomeAllocation();
});
$(".invoice-status select").on("change", function(){
    incomeAllocation();
    var url = $(this).closest(".panel-default").find(".panel-footer div a").attr('href');
    var newUrl = removeURLParameter(url,'year');
    newUrl += "&year=" + $(this).val();
    $(this).closest(".panel-default").find(".panel-footer div a").attr("href", newUrl);
});

let incomeAllocation = () => {
    var ctx = document.getElementById('invoiceStatus').getContext('2d');
    var barChartData = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                label: 'Paid Invoices',
                //backgroundColor: window.chartColors.red,
                backgroundColor: '#53c3f5',
                hoverBackgroundColor: '#53c3f5',
                //stack: 'Stack 0',
                maxBarThickness: 16,
                data: [
                    {y : 25000, id: 51},
                    {y : 30000, id: 62},
                    {y : 15000, id: 63},
                    {y : 18000, id: 64},
                    {y : 45000, id: 66},
                    {y : 37000, id: 68},
                    {y : 16000, id: 74},
                ]
            }, {
                label: 'Un-paid invoices',
                //backgroundColor: window.chartColors.blue,
                backgroundColor: '#de3f7f',
                //stack: 'Stack 0',
                hoverBackgroundColor: '#de3f7f',
                maxBarThickness: 16,
                data: [
                    {y : 5000, id: 1},
                    {y : 18000, id: 3},
                    {y : 1000, id: 8},
                    {y : 8000, id: 33},
                    {y : 5000, id: 36},
                    {y : 7000, id: 38},
                    {y : 1000, id: 42},
                ]
            },
            ]
        };
    window.invoiceStatus = new Chart(ctx, {
                type: 'bar',
                //tickMarkLength: 3,
                data: barChartData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    onClick: openReport,
                    tooltips: {
                        mode: 'index',
                        intersect: false
                    },
                    scales: {
                        xAxes: [{
                            stacked: true,
                        }],
                        yAxes: [{
                            stacked: true,
                            beginAtZero: true,
                            ticks: {
                                maxTicksLimit: 5,
                                precision: 2,
                                //maxRotation: 4,
                                //stepSize: 20000,
                                //sampleSize: 3,
                                autoSkip: true,
                                callback: function(label, index, labels) {
                                    return label/1000+'k';
                                }
                            },
                        }]
                    }
                }
            });
    }

function openReport(evt, element){
    var activePoints = window.invoiceStatus.getElementAtEvent(evt);
    var firstPoint = activePoints[0];
    console.log(firstPoint._datasetIndex +' '+ firstPoint._index);

    var value = window.invoiceStatus.data.datasets[firstPoint._datasetIndex].data[firstPoint._index].y;
    var label = window.invoiceStatus.data.labels[firstPoint._index];
    var unique = window.invoiceStatus.data.datasets[firstPoint._datasetIndex].data[firstPoint._index].id;
    //var value = window.invoiceStatus.data.datasets[firstPoint._datasetIndex].data[firstPoint._index];
    //alert(label + ": " + value + ": "+ unique);
    //  console.log(activePoints[0]);
}
<?php $this->Html->scriptEnd(); ?>
</script>
