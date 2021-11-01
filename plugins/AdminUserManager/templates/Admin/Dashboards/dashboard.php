<?php
use Cake\Core\Configure;
// dump($this->request->getAttribute('identity'));
 //dump($this->request->getAttribute('identity'));
//dump(Configure::read('Setting.MAIN_LOGO_1'))
?>
<div class="row">
			

<div class="col-12 col-sm-12 col-md-12">
				<div class="panel-default">
					<div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
						<h2>Inquiry Manager</h2>
						<div class="d-flex flex-wrap">								
						</div>
					</div>
					<div class="panel-body">
						<?php
					// Load a plugin cell
						echo $this->cell('Enquiry.Enquiry',['options' => ['admin_user_id' => $this->request->getAttribute('identity')->id]]);
						?>
					</div>
				</div>
			</div>

			
</div>

<?php
// In your view file
$this->Html->script(['https://www.gstatic.com/charts/loader.js'], ['block' => true]);
//$this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js', ['block' => true]);
$this->Html->script(['/assets/plugins/Chart.js-2.9.3/dist/Chart.min.js', '/assets/plugins/Chart.js-2.9.3/samples/utils.js'], ['block' => true]);
$this->Html->css('/assets/plugins/Chart.js-2.9.3/dist/Chart.min', ['block' => true]);
//$this->Html->css('carousel', ['block' => true]);
?>		

<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
	google.charts.load('current', {packages: ['corechart',"bar"]});
    google.charts.setOnLoadCallback(schoolCount);
    google.charts.setOnLoadCallback(unPaidInvoices);
var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
var config = {
			type: 'line',
			data: {
				labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
				datasets: [{
					label: 'Organization Income',
					backgroundColor: window.chartColors.blue,
					borderColor: window.chartColors.blue,
					data: [
						20000,
						5000,
						35000,
						22000,
						18000,
						0,
						10000,
						5000,
						60000,
						28000,
						4000,
						1500
					],
					fill: false,
				}, {
					label: 'Expenditure',
					fill: false,
					backgroundColor: window.chartColors.red,
					borderColor: window.chartColors.red,
					data: [
						5000,
						2500,
						35000,
						45000,
						0,
						0,
						25000,
						5000,
						500,
						32000,
						1000,
						0
					],
				}]
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				title: {
					display: false,
					text: 'Chart.js Line Chart'
				},
				// tooltips: {
				// 	mode: 'index',
				// 	intersect: false,
				// },
				// hover: {
				// 	mode: 'nearest',
				// 	intersect: true
				// },
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Month'
						}
					}],
					yAxes: [{
						display: true,
						ticks: {
		                    callback: function(label, index, labels) {
		                        return label/1000+'k';
		                    }
		                },
		                scaleLabel: {
		                    display: true,
		                    labelString: '1k = 1000'
		                }
						// scaleLabel: {
						// 	display: true,
						// 	labelString: 'Amount in INR'
						// },
						// ticks: {
						// 	 min: 0,
						// 	 max: 8000,

						// 	// forces step size to be 5 units
						// 	stepSize: 200
						// }
					}]
				}
			}
		};
window.onload = function() {
			var ctx = document.getElementById('orgPnl').getContext('2d');
			window.myLine = new Chart(ctx, config);
		};
<?php $this->Html->scriptEnd(); ?>
</script>
