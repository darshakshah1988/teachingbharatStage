<div class="panel-default commercial-panel unpaid-invoice">
    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
        <h2>Un-paid Amount (Invoices)</h2>
        <div class="d-flex flex-wrap graph-nav">
            <?php echo $this->Form->control('year', ['option' => $years, 'empty' => false, 'label' => false,'default' => date('Y') , 'class' => 'form-control commercialYear']) ?>
        </div>
    </div>
    <div class="panel-body commercialPreLoader">
        <div id="unPaidInvoices" style="height:251px; width:100%;"></div>
    </div>
    <div class="panel-footer d-flex justify-content-between flex-wrap align-items-center">
        <ul class="graph-indicator">
            <li><span class="income rect">Un-paid Invoices</span></li>
        </ul>
        <div>
            <a href="#" class="export-btn">Export</a>
        </div>
    </div>
</div>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>

$(".unpaid-invoice select").on("change", function(){
    unPaidInvoices();
    var url = $(this).closest(".panel-default").find(".panel-footer div a").attr('href');
    var newUrl = removeURLParameter(url,'year');
    newUrl += "&year=" + $(this).val();
    $(this).closest(".panel-default").find(".panel-footer div a").attr("href", newUrl);
});

  function unPaidInvoices(){
      var year = $(".unpaid-invoice select option:selected").val();
      var listing_type = "school";
      var stats = "drawn";
     $.ajax({
            url: '<?php echo $this->Url->build(['controller' => 'AdminUsers', 'action' => 'unpaid', 'plugin' => 'AdminUserManager']) ?>',
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
                dataTable.push(['Month', 'Un-paid Amount']);
                $.each(response.data, function(month, drawn) {
                    dataTable.push([month, drawn]);
                    });
                var data = new google.visualization.arrayToDataTable(dataTable);
                var formatter = new google.visualization.NumberFormat({
                    prefix: '₹ ',
                    pattern: 'short',
                });
                formatter.format(data, 1);
                var options = {
                legend: { position: 'none', textStyle: {color: 'yellow', fontSize: 12} },
                axes: {
                    x: {
                    0: { side: 'bottom', label: ''} // Top x-axis.
                    },
                },
                bar: { groupWidth: "50%" },
                hAxis : {
                    textStyle : {
                        fontSize: 10 // or the number you want
                    }

                },
                vAxis: {
                    format: 'short',
                    minValue: 0,
                    //ticks: [1000, 2000, 3000, 4000, 5000, 6000, 7000, 8000]
                },
                colors: ['#ed7d31'],
                // tooltip: {
                //     isHtml: true,
                //     trigger: 'both'
                // },

                };

            var chartDiv = document.getElementById('unPaidInvoices');
            var chart = new google.visualization.ColumnChart(chartDiv);

            google.visualization.events.addListener(chart, 'ready', function () {
                var axisLabels = chartDiv.getElementsByTagName('text');
                for (var i = 0; i < axisLabels.length; i++) {
                    if (axisLabels[i].getAttribute('text-anchor') === 'end') {
                        axisLabels[i].innerHTML = '₹ ' + axisLabels[i].innerHTML;
                    }
                }
            });
            chart.draw(data, options);
            //google.visualization.events.addListener(chart, 'select', selectHandler);
            google.visualization.events.addListener(chart, 'select', selectHandler);
            google.visualization.events.addListener(chart, 'onmouseover', uselessHandler2);
            google.visualization.events.addListener(chart, 'onmouseout', uselessHandler3);
            function selectHandler() {
                    var selectedItem = chart.getSelection()[0];
                    if (selectedItem) {
                        var value = data.getValue(selectedItem.row, selectedItem.column);
                        let month = data.getValue(selectedItem.row, 0);
                        let stateData = {year: year, listing_type: listing_type, stats: stats, value: value, month: month};
                        goToReport(stateData);
                        chart.draw(data, options);
                    }
                };

                function uselessHandler2() {
                    $(chartDiv).css('cursor','pointer')
                    }
                function uselessHandler3() {
                        $(chartDiv).css('cursor','default')
                    }
        },error: function (xhr, ajaxOptions, thrownError) {
            var errors = JSON.parse(xhr.responseText);
            var title =   JSON.parse(xhr.responseText).message;
            console.log(errors.errors);
        }
    });

}
<?php $this->Html->scriptEnd(); ?>
</script>