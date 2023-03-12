(function($) {
  const $success = '#39DA8A';
  const $danger = '#FF5B5C';
  const $info = '#00CFDD';

  const options = {
    series: [0, 0, 0],
    chart: {
      type: 'donut',
      height: 326,
    },
    colors: [$success, $info, $danger],
    labels: ['Lunas', 'Janji Bayar', 'Tidak Dieksekusi'],
    responsive: [
      {
        breakpoint: 480,
        options: {
          chart: {
            width: 200
          },
          legend: {
            position: 'bottom'
          }
        }
      }
    ]
  }

  var orderStatusChart = new ApexCharts(
    document.querySelector("#status-order-chart"),
    options
  )

  // Summary Chart
  // ----------
  initOrderStatusChart = () => {
    'use strict';
    orderStatusChart.render();
  }

  updateSummaryChart = (params) => {
    'use strict';

    const options = {
      series: [0, 0, 0],
      chart: {
        type: 'donut',
        height: 326,
      },
      colors: [$success, $info, $danger],
      labels: ['Lunas', 'Janji Bayar', 'Tidak Dieksekusi'],
      responsive: [
        {
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }
      ]
    }

    const status_orders = JSON.parse($("#status_orders").val());
    if (status_orders) {
      options.series = [status_orders.total_paid, status_orders.total_debt, status_orders.total_not_executed]
    }

    orderStatusChart.updateOptions(options);
  }

})(jQuery);