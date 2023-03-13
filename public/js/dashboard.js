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

    if (params.status_orders.length > 0) {
      const v = params.status_orders[0]
      options.series = [parseInt(v.total_paid, 10), parseInt(v.total_debt, 10), parseInt(v.total_not_executed, 10)]
    }

    orderStatusChart.updateOptions(options);
  }

})(jQuery);