/*=========================================================================================
    File Name: dashboard-ecommerce.js
    Description: dashboard ecommerce page content with Apexchart Examples
    ----------------------------------------------------------------------------------------
    Item Name: Frest HTML Admin Template
    Version: 1.0
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(window).on("load", function () {
  const charts = JSON.parse($("#charts").val())
  const summary = JSON.parse($("#summaryWorkLetter").val())
  const colors = ["#008FFB", "#00E396", "#FEB019", "#FF4560", "#775DD0", "#FF3399", "#00CCCC"]

  var $primary = '#5A8DEE';
  var $secondary = '#828D99';
  var $light_primary = "#E2ECFF";

  // Work Letter Summary
  // --------------------
  var workLetterSummaryOptions = {
    chart: {
      height: 270,
      type: 'line',
      stacked: false,
    },
    colors: [$primary, "#ff0022", "#05e296"],
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'smooth',
      width: 2.5,
      dashArray: [0, 8]
    },
    fill: {
      type: 'gradient',
      gradient: {
        inverseColors: false,
        shade: 'light',
        type: "vertical",
        gradientToColors: [$light_primary, "#ff0022", "#05e296"],
        opacityFrom: 0.7,
        opacityTo: 0.55,
        stops: [0, 80, 100]
      }
    },
    series: [
      {
        name: 'Diterima',
        data: summary.map(el => el.received),
        type: 'area',
      }, 
      {
        name: 'Diteliti',
        data: summary.map(el => el.researched),
        type: 'line',
      },
      {
        name: 'CHP Selesai',
        data: summary.map(el => el.chp_finished),
        type: 'line',
      }
    ],
    xaxis: {
      type: 'datetime',
      categories: summary.map(el => el.date),
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
      labels: {
        show: true,
        style: {
          colors: $secondary
        }
      }
    },
    tooltip: {
      x: { show: false }
    },
  }

  var workLetterSummary = new ApexCharts(
    document.querySelector("#workLetterSummary"),
    workLetterSummaryOptions
  );

  workLetterSummary.render();

  // Work Letter Received
  // -----------------------------------
  var workLetterReceivedOption = {
    series: charts.received.values,
    colors: colors,
    labels: charts.received.names,
    tooltip: {
      custom: function(el) {
        return `
          <div style="background: ${colors[el.seriesIndex]}; border-radius: 5px">
            <p class="mb-0 white" style="padding: 5px; font-size: 12px;">
              ${charts.received.names[el.seriesIndex]} : ${charts.received.values[el.seriesIndex]} /
              ${charts.received.units[el.seriesIndex]}
            </p>
          </div>
        `
      }
    },
    legend: {
      show: true,
      formatter: function(seriesName, opts) {
          return [charts.received.legend[opts.seriesIndex]]
      },
    },
    chart: {
      type: 'donut',
      height: 267
      // height: 250
    },
    responsive: [
      {
        breakpoint: 1000,
        options: {
          legend: {
            position: "bottom"
          }
        }
      }
    ]
  }
  var workLetterReceived = new ApexCharts(
    document.querySelector("#workLetterReceived"),
    workLetterReceivedOption
  );
  workLetterReceived.render();

  // Work Letter Researched
  // -----------------------------------
  var workLetterResearchedOption = {
    series: charts.researched.values,
    colors: colors,
    labels: charts.researched.names,
    tooltip: {
      custom: function(el) {
        return `
          <div style="background: ${colors[el.seriesIndex]}; border-radius: 5px">
            <p class="mb-0 white" style="padding: 5px; font-size: 12px;">
              ${charts.researched.names[el.seriesIndex]} : ${charts.researched.values[el.seriesIndex]} /
              ${charts.researched.units[el.seriesIndex]}
            </p>
          </div>
        `
      }
    },
    legend: {
      show: true,
      formatter: function(seriesName, opts) {
          return [charts.researched.legend[opts.seriesIndex]]
      },
    },
    chart: {
      type: 'donut',
      height: 267
      // height: 250
    },
    responsive: [
      {
        breakpoint: 1000,
        options: {
          legend: {
            position: "bottom"
          }
        }
      }
    ]
  }
  var workLetterResearched = new ApexCharts(
    document.querySelector("#workLetterResearched"),
    workLetterResearchedOption
  );
  workLetterResearched.render();
  
  // CHP Finished
  // -----------------------------------
  var chpFinishedOption = {
    series: charts.finished.values,
    colors: colors,
    labels: charts.finished.names,
    tooltip: {
      custom: function(el) {
        return `
          <div style="background: ${colors[el.seriesIndex]}; border-radius: 5px">
            <p class="mb-0 white" style="padding: 5px; font-size: 12px;">
              ${charts.finished.names[el.seriesIndex]} : ${charts.finished.values[el.seriesIndex]} /
              ${charts.finished.units[el.seriesIndex]}
            </p>
          </div>
        `
      }
    },
    legend: {
      show: true,
      formatter: function(seriesName, opts) {
          return [charts.finished.legend[opts.seriesIndex]]
      },
    },
    chart: {
      type: 'donut',
      height: 250
      // height: 250
    },
    responsive: [
      {
        breakpoint: 1000,
        options: {
          legend: {
            position: "bottom"
          }
        }
      }
    ]
  }
  var chpFinished = new ApexCharts(
    document.querySelector("#chpFinished"),
    chpFinishedOption
  );
  chpFinished.render();

  var testOption = {
    series: [
      {
        name: "CHP Selesai",
        data: transformSeriesData(charts.bar.chart, "finished")
      }, 
      {
        name: 'RKAKL Diteliti',
        data: transformSeriesData(charts.bar.chart, "researched")
      }, 
      {
        name: 'RKAKL Diterima',
        data: transformSeriesData(charts.bar.chart, "received")
      }, 
      {
        name: 'Total Satker',
        data: transformSeriesData(charts.bar.chart, "work_unit")
      }
    ],
    chart: {
      type: 'bar',
      height: 350,
    },
    responsive: [
      {
        breakpoint: 480,
        options: {
          legend: {
            position: 'bottom',
            offsetX: -10,
            offsetY: 0
          }
        }
      }
    ],
    xaxis: {
      categories: charts.bar.chart.legend
    },
    plotOptions: {
      bar: {
        dataLabels: {
          position: 'top'
        }
      }
    },
    dataLabels: {
      enabled: false
    },
    fill: {
      opacity: 1
    },
    legend: {
      position: 'bottom',
    },
  };
  var chpCompared = new ApexCharts(
    document.querySelector("#chpCompared"),
    testOption
  );
  chpCompared.render();

  // CHP COMPARED DETAIL
  var details = ""
  for (const key in charts.bar.list) {
    if (Object.hasOwnProperty.call(charts.bar.list, key)) {
      const el = charts.bar.list[key];

      details += `
      <a href="javascript:void(0);" class="list-group-item list-group-item-action" style="padding: 0.5rem 1rem">
        <span style="font-weight: bold; font-size: 12px">${el.code}. ${el.label} (Satker: ${el.work_unit})</span>
        <br>

        <span style="color: grey; margin-left: 20px; font-size: 12px">
          RKAKL Diterima: ${el.received} ; RKAKL Diteliti: ${el.researched}; CHP Selesai: ${el.finished}
        </span>
      </a>
      `
    }
  }

  $("#detail_chp_compared").html(details)

  function transformSeriesData(charts, key) {
    let data = [];

    if (Object.keys(charts).length > 0) {
      
      for (const val of charts.legend) {
        if (charts[key].hasOwnProperty(val)) {
          data.push(charts[key][val])
        } else {
          data.push(0)
        }
      }
      
    }

    return data
  }
});
