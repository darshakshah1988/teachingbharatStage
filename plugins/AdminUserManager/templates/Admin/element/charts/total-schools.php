<div class="panel-default commercial-panel school-count">
    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
        <h2>Total Students</h2>
        <div class="d-flex flex-wrap graph-nav">
            <?php echo $this->Form->control('year', ['options' => $years, 'empty' => false, 'label' => false,'default' => date('Y') , 'class' => 'form-control commercialYear', 'templates' => ['select' => '<select name="{{name}}"{{attrs}}>{{content}}</select>','inputContainer' => '{{content}}', 'formGroup' => '{{input}}']]) ?>
        </div>
    </div> 
    <div class="panel-body commercialPreLoader">
        <div class="chart-container" style="position: relative; height:40vh; width:100%">
            <canvas id="totalAdmissions" width="100%"></canvas>
         </div>
    </div>
    <div class="panel-footer d-flex justify-content-between flex-wrap align-items-center">
        <ul class="graph-indicator">
            <li><span class="income rect">Total Students</span></li>
        </ul>
        <div>
            <a href="#" class="export-btn">Export</a>
        </div> 
    </div>
</div>

<script>
<?php $this->Html->scriptStart(['block' => 'inlineScript']); ?>
$(document).ready(() => {
    totalAdmissions();
});
$(".school-count select").on("change", function(){
    totalAdmissions();
    var url = $(this).closest(".panel-default").find(".panel-footer div a").attr('href');
    var newUrl = removeURLParameter(url,'year');
    newUrl += "&year=" + $(this).val();
    $(this).closest(".panel-default").find(".panel-footer div a").attr("href", newUrl);
});

let totalAdmissions = () => {
    var ctx = document.getElementById('totalAdmissions').getContext('2d');
      var year = $(".school-count select option:selected").val();
      var listing_type = "school";
      var stats = "drawn";
     $.ajax({
            url: '<?php echo $this->Url->build(['controller' => 'AdminUsers', 'action' => 'listings', 'plugin' => 'AdminUserManager']) ?>',
            type: 'get',
            data: {listing_type: listing_type, stats: stats, year: year},
            dataType: 'json',
            headers: {
                "accept": "application/json",
                'Authorization' : 'Bearer {{ Auth::user()->api_token }}',
            },
            beforeSend: function() {
                $('.commercialPreLoader').waitMe();
            },
            complete: function(response) {
                setTimeout(function(){
                    $('.commercialPreLoader').waitMe('hide');
                    }, 500);
            },
            success: function(response) {
               // var res = JSON.parse(response);
                var dataTable = [];
                //dataTable.push(['Month', 'Students']);
                $.each(response.data, function(month, count) {
                    dataTable.push(count);
                    });
                
                var barChartData = {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    label: 'Admission',
                    //backgroundColor: window.chartColors.red,
                    backgroundColor: '#53c3f5',
                    hoverBackgroundColor: '#53c3f5',
                    //stack: 'Stack 0',
                    maxBarThickness: 16,
                    data: dataTable
                    }
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
                                // callback: function(label, index, labels) {
                                //     return label/1000+'k';
                                // }
                            },
                        }]
                    }
                }
            });


        },error: function (xhr, ajaxOptions, thrownError) {
            var errors = JSON.parse(xhr.responseText);
            var title =   JSON.parse(xhr.responseText).message;
            console.log(errors.errors);
        }
    });

}
<?php $this->Html->scriptEnd(); ?>
</script>