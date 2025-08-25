<script>
var donutchartportfolioColors = getChartColorsArray("portfolio_donut_charts2");
if (donutchartportfolioColors) {
  var options = {
    series: [<?php foreach ($allBudgetYear as  $value_bd) { echo $value_bd["AMS_BUDGET_AMOUNT"].','; } ?>],
    labels: [<?php  foreach ($allBudgetYear as  $value_bd) { echo '"'.$value_bd["AMS_BUDGET_SOURCENM"] . ' ' . $value_bd["AMS_BUDGET_CLASSNM"].' '.$value_bd["AMS_BUDGET_TYPENM"].'",'; } ?>],
    chart: {
      type: "donut",
      height: 350,
    },

    plotOptions: {
      pie: {
        size: 100,
        offsetX: 0,
        offsetY: 0,
        donut: {
          size: "70%",
          labels: {
            show: true,
            name: {
              show: true,
              fontSize: "18px",
              offsetY: -5,
            },
            value: {
              show: true,
              fontSize: "20px",
              color: "#067FF8",
              fontWeight: 500,
              offsetY: 5,
              formatter: function (val) {
                return val + " บาท";
              },
            },
            total: {
              show: true,
              fontSize: "13px",
              label: "Total",
              color: "#F33506",
              fontWeight: 500,
              formatter: function (w) {
                return (
                  w.globals.seriesTotals.reduce(function (a, b) {
                    return a + b;
                  }, 0) + " บาท"
                );
              },
            },
          },
        },
      },
    },
    dataLabels: {
      enabled: false,
    },
    legend: {
      show: false,
    },
    yaxis: {
      labels: {
        formatter: function (value) {
          return value + " บาท";
        },
      },
    },
    stroke: {
      lineCap: "round",
      width: 2,
    },
    colors: donutchartportfolioColors,
  };
  var chart = new ApexCharts(document.querySelector("#portfolio_donut_charts2"), options);
  chart.render();
}

</script>