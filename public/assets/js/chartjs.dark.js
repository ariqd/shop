$.exists = function(selector) {
  return $(selector).length > 0;
};

/* Line chart Variable */
var lineChartToolTips = {
  displayColors: false,
  mode: "nearest",
  intersect: false,
  position: "nearest",
  xPadding: 8,
  yPadding: 8,
  caretPadding: 8,
  backgroundColor: "#1D1F3C",
  cornerRadius: 4,
  titleFontSize: 13,
  titleFontStyle: "normal",
  bodyFontSize: 13,
  titleFontColor: "rgba(255, 255, 255, 0.8)",
  bodyFontColor: "rgba(255, 255, 255, 0.6)",
  borderWidth: 1,
  borderColor: "rgba(255, 255, 255, 0.08)"
}
var scalesYaxes = [{
  ticks: {
    fontSize: 14,
    fontColor: "rgba(255, 255, 255, 0.4)",
    padding: 15,
    beginAtZero: true,
    autoSkip: false,
    maxTicksLimit: 4
  },
  gridLines: {
    color: "rgba(255, 255, 255, 0.08)",
    zeroLineWidth: 0,
    zeroLineColor: "rgba(255, 255, 255, 0.1)",
    drawBorder: false,
    tickMarkLength: 0
  }
}]
var scalesXaxes = [{
  ticks: {
    fontSize: 14,
    fontColor: "rgba(255, 255, 255, 0.4)",
    padding: 5,
    beginAtZero: true,
    autoSkip: false,
    maxTicksLimit: 4
  },
  gridLines: {
    display: false
  }
}];
/* End Line chart Variable */

/* Start Line Chart1 Initialize */
// Type1
if ($.exists("#tb-chart1-type1")) {
  var ctx1 = document.querySelector("#tb-chart1-type1");
  var myChart1 = new Chart(ctx1, {
    type: "line",
    data: {
      labels: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
      datasets: [{
        data: [12, 18, 12, 10, 17, 6, 10],
        backgroundColor: "rgba(88, 86, 214, 0.1)",
        borderColor: "#5856d6",
        borderWidth: 3,
        lineTension: 0,
        pointBackgroundColor: "#fff",
        pointDotRadius: 10
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: false,
      tooltips: lineChartToolTips,
      scales: {
        yAxes: scalesYaxes,
        xAxes: scalesXaxes
      },
      elements: {
        point: {
          radius: 0
        }
      }
    }
  });
}

// Type2
if ($.exists("#tb-chart1-type2")) {
  var ctx1 = document.querySelector("#tb-chart1-type2");
  var myChart1 = new Chart(ctx1, {
    type: "line",
    data: {
      labels: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
      datasets: [{
        data: [10, 19, 14, 10, 16, 5, 8],
        backgroundColor: "rgba(88, 86, 214, 0.1)",
        borderColor: "#5856d6",
        borderWidth: 3,
        lineTension: 0,
        pointBackgroundColor: "#fff",
        pointDotRadius: 10
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: false,
      tooltips: lineChartToolTips,
      scales: {
        yAxes: scalesYaxes,
        xAxes: scalesXaxes
      },
      elements: {
        point: {
          radius: 0
        }
      }
    }
  });
}

// Type3
if ($.exists("#tb-chart1-type3")) {
  var ctx1 = document.querySelector("#tb-chart1-type3");
  var myChart1 = new Chart(ctx1, {
    type: "line",
    data: {
      labels: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
      datasets: [{
        data: [12, 10, 14, 19, 15, 10, 18],
        backgroundColor: "rgba(88, 86, 214, 0.1)",
        borderColor: "#5856d6",
        borderWidth: 3,
        lineTension: 0,
        pointBackgroundColor: "#fff",
        pointDotRadius: 10
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: false,
      tooltips: lineChartToolTips,
      scales: {
        yAxes: scalesYaxes,
        xAxes: scalesXaxes
      },
      elements: {
        point: {
          radius: 0
        }
      }
    }
  });
}

// Type4
if ($.exists("#tb-chart1-type4")) {
  var ctx1 = document.querySelector("#tb-chart1-type4");
  var myChart1 = new Chart(ctx1, {
    type: "line",
    data: {
      labels: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
      datasets: [{
        data: [18, 15, 14, 10, 19, 9, 13],
        backgroundColor: "rgba(88, 86, 214, 0.1)",
        borderColor: "#5856d6",
        borderWidth: 3,
        lineTension: 0,
        pointBackgroundColor: "#fff",
        pointDotRadius: 10
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: false,
      tooltips: lineChartToolTips,
      scales: {
        yAxes: scalesYaxes,
        xAxes: scalesXaxes
      },
      elements: {
        point: {
          radius: 0
        }
      }
    }
  });
}

// Type5
if ($.exists("#tb-chart1-type5")) {
  var ctx1 = document.querySelector("#tb-chart1-type5");
  var myChart1 = new Chart(ctx1, {
    type: "line",
    data: {
      labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL"],
      datasets: [{
        label: "Earnings",
        data: [100, 90, 110, 100, 90, 105, 90],
        backgroundColor: "rgba(52, 199, 89, 0.1)",
        borderColor: "#34c759",
        borderWidth: 3,
        lineTension: 0,
        pointBackgroundColor: "#fff",
        pointDotRadius: 10
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: false,
      tooltips: lineChartToolTips,
      scales: {
        yAxes: [{
          ticks: {
            fontSize: 0,
            fontColor: "red",
            padding: 5,
            beginAtZero: true,
            autoSkip: false
          },
          gridLines: {
            color: "transparent",
            zeroLineWidth: 0,
            zeroLineColor: "transparent",
            drawBorder: false,
            tickMarkLength: 0
          }
        }],
        xAxes: [{
          ticks: {
            fontSize: 0,
            fontColor: "#34c759",
            padding: 0,
            beginAtZero: true,
            autoSkip: false
          },
          gridLines: {
            color: "transparent",
            tickMarkLength: 0
          }
        }]
      },
      elements: {
        point: {
          radius: 0
        }
      }
    }
  });
}

// Type6
if ($.exists("#tb-chart1-type6")) {
  var ctx1 = document.querySelector("#tb-chart1-type6");
  var myChart1 = new Chart(ctx1, {
    type: "line",
    data: {
      labels: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
      datasets: [{
        data: [-100, -90, -60, 60, 90, 105, 90],
        backgroundColor: "rgba(0, 122, 255, 0.1)",
        borderColor: "#007aff",
        borderWidth: 3,
        lineTension: 0,
        pointBackgroundColor: "#fff",
        pointDotRadius: 10
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: false,
      tooltips: lineChartToolTips,
      scales: {
        yAxes: scalesYaxes,
        xAxes: scalesXaxes
      },
      elements: {
        point: {
          radius: 0
        }
      }
    }
  });
}

// Type7
if ($.exists("#tb-chart1-type7")) {
  var ctx1 = document.querySelector("#tb-chart1-type7");
  var myChart1 = new Chart(ctx1, {
    type: "line",
    data: {
      labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL"],
      datasets: [{
        label: "Earnings",
        data: [100, 90, 110, 100, 90, 105, 90],
        backgroundColor: "rgba(0, 122, 255, 0.1)",
        borderColor: "#007aff",
        borderWidth: 3,
        lineTension: 0,
        pointBackgroundColor: "#fff",
        pointDotRadius: 10
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: false,
      tooltips: lineChartToolTips,
      scales: {
        yAxes: [{
          ticks: {
            fontSize: 0,
            fontColor: "red",
            padding: 5,
            beginAtZero: true,
            autoSkip: false
          },
          gridLines: {
            color: "transparent",
            zeroLineWidth: 0,
            zeroLineColor: "transparent",
            drawBorder: false,
            tickMarkLength: 0
          }
        }],
        xAxes: [{
          ticks: {
            fontSize: 0,
            fontColor: "#34c759",
            padding: 0,
            beginAtZero: true,
            autoSkip: false
          },
          gridLines: {
            color: "transparent",
            tickMarkLength: 0
          }
        }]
      },
      elements: {
        point: {
          radius: 0
        }
      }
    }
  });
}
// Type8
if ($.exists("#tb-chart1-type8")) {
  var ctx1 = document.querySelector("#tb-chart1-type8");
  var myChart1 = new Chart(ctx1, {
    type: "line",
    data: {
      labels: ["Day 0", "Day 20", "Day 40", "Day 60", "Day 80", "Day 100", "Day 120", "Day 140", "Day 160", "Day 180"],
      datasets: [{
          data: [80, 90, 60, 60, 90, 105, 80, 130, 150, 200],
          backgroundColor: "rgba(0, 122, 255, 0.1)",
          borderColor: "#007aff",
          borderWidth: 3,
          lineTension: 0,
          pointBackgroundColor: "#fff",
          pointDotRadius: 10
        },
        {
          label: "Earnings",
          data: [50, 70, 100, 120, 80, 70, 60, 110, 90, 140],
          backgroundColor: "rgba(52, 199, 89, 0.1)",
          borderColor: "#34c759",
          borderWidth: 3,
          lineTension: 0,
          pointBackgroundColor: "#fff",
          pointDotRadius: 10
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: false,
      tooltips: lineChartToolTips,
      scales: {
        yAxes: scalesYaxes,
        xAxes: scalesXaxes
      },
      elements: {
        point: {
          radius: 0
        }
      }
    }
  });
}

if ($.exists("#tb-chart1-type9")) {
  let ctx1 = document.querySelector("#tb-chart1-type9");
  let myChart1 = new Chart(ctx1, {
    type: "line",
    data: {
      labels: ["Day 0", "Day 20", "Day 40", "Day 60", "Day 80", "Day 100", "Day 120", "Day 140", "Day 160", "Day 180"],
      datasets: [{
          data: [200, 500, 400, 600, 700, 500, 300, 500, 300, 700],
          backgroundColor: "rgba(0, 122, 255, 0.1)",
          borderColor: "#007aff",
          borderWidth: 3,
          lineTension: 0,
          pointBackgroundColor: "#fff",
          pointDotRadius: 10
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: false,
      tooltips: lineChartToolTips,
      scales: {
        yAxes: [{
          position: "left",
          ticks: {
            fontSize: 14,
            fontColor: "rgba(255, 255, 255, 0.4)",
            padding: 15,
            autoSkip: false,
            maxTicksLimit: 6,
            beginAtZero: true,
            steps: 100,
            stepValue: 5,
            max: 800
          },
          gridLines: {
            color: "rgba(255, 255, 255, 0.08)",
            zeroLineWidth: 1,
            zeroLineColor: "rgba(255, 255, 255, 0.08)",
            drawBorder: false
          }
        }],
        xAxes: scalesXaxes
      },
      elements: {
        point: {
          radius: 0
        }
      }
    }
  });
}
/* End Line Chart1 Initialize */

/* Start Line Chart2 Initialize */
// Type 1
if ($.exists("#tb-chart2-type1")) {
  var ctx = document.querySelector("#tb-chart2-type1").getContext("2d");
  var myBarChart = new Chart(ctx, {
    type: "bar",
    data: {
      labels: ["", "", "", ""],
      datasets: [{
          label: "hotelluxe",
          backgroundColor: "#5856d6",
          data: [7, 3, 4, 0]
        },
        {
          label: "photosy",
          backgroundColor: "#5856d6",
          data: [4, 6, 5, 0]
        },
        {
          label: "magplus",
          backgroundColor: "#5856d6",
          data: [0, 0, 8, 6]
        },
        {
          label: "blogit",
          backgroundColor: "#5856d6",
          data: [0, 0, 4, 3]
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      barValueSpacing: 10,
      legend: false,
      tooltips: lineChartToolTips,
      scales: {
        yAxes: [{
          display: false
        }],
        xAxes: [{
          maxBarThickness: 10,
          display: false
        }]
      }
    }
  });
}

// Type 2
if ($.exists("#tb-chart2-type2")) {
  var ctx = document.querySelector("#tb-chart2-type2").getContext("2d");
  var myBarChart = new Chart(ctx, {
    type: "bar",
    data: {
      labels: ["", "", "", "", "", ""],
      datasets: [{
          label: "hotelluxe",
          backgroundColor: "#5856d6",
          hoverBackgroundColor:"#5856d6",
          data: [7, 3, 4, 4, 5, 3]
        },
        {
          label: "photosy",
          backgroundColor: "rgba(88, 86, 214, 0.5)",
          hoverBackgroundColor: "rgba(88, 86, 214, 0.5)",
          data: [4, 6, 5, 7, 6, 5]
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      barValueSpacing: 10,
      legend: false,
      tooltips: lineChartToolTips,
      scales: {
        yAxes: [{
          ticks: {
            fontSize: 14,
            fontColor: "rgba(255, 255, 255, 0.4)",
            padding: 15,
            beginAtZero: true,
            autoSkip: false,
            maxTicksLimit: 6
          },
          gridLines: {
            color: "rgba(255, 255, 255, 0.08)",
            zeroLineWidth: 1,
            zeroLineColor: "rgba(255, 255, 255, 0.08)",
            drawBorder: false,
            tickMarkLength: 0
          }
        }],
        xAxes: [{
          maxBarThickness: 10,
          display: false
        }]
      }
    }
  });
}

// Type 3
if ($.exists("#tb-chart2-type3")) {
  var ctx = document.querySelector("#tb-chart2-type3").getContext("2d");
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ["", "", "", "", "", "", ""],
      datasets: [{
        label: 'Hours',
        data: [9, 6, 7, 9, 6, 4, 7],
        backgroundColor: '#5ac8fa',
        hoverBackgroundColor:'rgba(90, 200, 250, 0.8)',
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      barValueSpacing: 10,
      legend: false,
      tooltips: false,
      scales: {
        yAxes: [{
          display: false
        }],
        xAxes: [{
          display: false
        }]
      }
    }
  });
}

// Type 4
if ($.exists("#tb-chart2-type4")) {
  var ctx = document.querySelector("#tb-chart2-type4").getContext("2d");
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ["", "", "", "", "", "", ""],
      datasets: [{
        label: 'Hours',
        data: [9, 6, 7, 9, 6, 4, 7],
        backgroundColor: '#5ac8fa',
        hoverBackgroundColor:'rgba(90, 200, 250, 0.8)',
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      barValueSpacing: 10,
      legend: false,
      tooltips: false,
      scales: {
        yAxes: [{
          display: false
        }],
        xAxes: [{
          display: false
        }]
      }
    }
  });
}

// Type 5
if ($.exists("#tb-chart2-type5")) {
  var ctx = document.querySelector("#tb-chart2-type5").getContext("2d");
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ["", "", "", "", "", "", ""],
      datasets: [{
        label: 'Hours',
        data: [9, 6, 7, 9, 6, 4, 7],
        backgroundColor: '#5ac8fa',
        hoverBackgroundColor:'rgba(90, 200, 250, 0.8)',
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      barValueSpacing: 10,
      legend: false,
      tooltips: false,
      scales: {
        yAxes: [{
          display: false
        }],
        xAxes: [{
          display: false
        }]
      }
    }
  });
}

// Type 6
if ($.exists("#tb-chart2-type6")) {
  var ctx = document.querySelector("#tb-chart2-type6").getContext("2d");
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ["", "", "", "", "", "", ""],
      datasets: [{
        label: 'Hours',
        data: [9, 6, 7, 9, 6, 4, 7],
        backgroundColor: '#5ac8fa',
        hoverBackgroundColor:'rgba(90, 200, 250, 0.8)',
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      barValueSpacing: 10,
      legend: false,
      tooltips: false,
      scales: {
        yAxes: [{
          display: false
        }],
        xAxes: [{
          display: false
        }]
      }
    }
  });
}

// Type 7
if ($.exists("#tb-chart2-type7")) {
  var ctx = document.querySelector("#tb-chart2-type7").getContext("2d");
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ["", "", "", "", "", "", ""],
      datasets: [{
        label: 'Hours',
        data: [9, 6, 7, 9, 6, 4, 7],
        backgroundColor: '#5ac8fa',
        hoverBackgroundColor:'rgba(90, 200, 250, 0.8)',
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      barValueSpacing: 10,
      legend: false,
      tooltips: false,
      scales: {
        yAxes: [{
          display: false
        }],
        xAxes: [{
          display: false
        }]
      }
    }
  });
}

// Type 8
if ($.exists("#tb-chart2-type8")) {
  var ctx = document.querySelector("#tb-chart2-type8").getContext("2d");
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ["", "", "", "", "", "", ""],
      datasets: [{
        label: 'Hours',
        data: [9, 6, 7, 9, 6, 4, 7],
        backgroundColor: '#5ac8fa',
        hoverBackgroundColor:'rgba(90, 200, 250, 0.8)',
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      barValueSpacing: 10,
      legend: false,
      tooltips: false,
      scales: {
        yAxes: [{
          display: false
        }],
        xAxes: [{
          display: false
        }]
      }
    }
  });
}

// Type 9
if ($.exists("#tb-chart2-type9")) {
  var ctx = document.querySelector("#tb-chart2-type9").getContext("2d");
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ["", "", "", "", "", "", ""],
      datasets: [{
        label: 'Hours',
        data: [9, 6, 7, 9, 6, 4, 7],
        backgroundColor: '#5ac8fa',
        hoverBackgroundColor:'rgba(90, 200, 250, 0.8)',
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      barValueSpacing: 10,
      legend: false,
      tooltips: false,
      scales: {
        yAxes: [{
          display: false
        }],
        xAxes: [{
          display: false
        }]
      }
    }
  });
}

// Type 10
if ($.exists("#tb-chart2-type10")) {
  var ctx = document.querySelector("#tb-chart2-type10");
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ["M", "T", "W", "T", "F", "S", "S", "M", "T", "W", "T", "F", "S", "S"],
      datasets: [{
        label: 'Hours',
        data: [8, 6, 7, 5, 6, 4, 8, 6, 5, 6, 7, 9, 5, 6],
        backgroundColor: 'rgba(0, 122, 255, 0.1)',
        hoverBackgroundColor:'#007aff',
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: false,
      tooltips: {
        displayColors: false,
        mode: "nearest",
        intersect: false,
        position: "nearest",
        xPadding: 8,
        yPadding: 8,
        caretPadding: 8,
        backgroundColor: "#1D1F3C",
        cornerRadius: 4,
        titleFontSize: 13,
        titleFontStyle: "normal",
        bodyFontSize: 13,
        titleFontColor: "rgba(255, 255, 255, 0.8)",
        bodyFontColor: "rgba(255, 255, 255, 0.6)",
        borderWidth: 1,
        borderColor: "rgba(255, 255, 255, 0.08)",
        callbacks: {
          // use label callback to return the desired label
          label: function(tooltipItem, data) {
            return tooltipItem.yLabel + " hours";
          },
          // remove title
          title: function(tooltipItem, data) {
            return;
          }
        }
      },
      scales: {
        yAxes: [{
          display: false
        }],
        xAxes: scalesXaxes
      },
      elements: {
        point: {
          radius: 0
        }
      }
    }
  });
}

// Type 11
if ($.exists("#tb-chart2-type11")) {
  var ctx = document.querySelector("#tb-chart2-type11");
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ["Extremely", "Very", "Somewhat", "Not So", "Not at All"],
      datasets: [{
        label: 'Hours',
        data: [80, 40, 20, 10, 5],
        backgroundColor: ['#007aff', '#5ac8fa', '#ffcc00', '#ff9500', '#ff3b30'],
        hoverBackgroundColor: ['#007aff', '#5ac8fa', '#ffcc00', '#ff9500', '#ff3b30'],
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: false,
      tooltips: {
        displayColors: false,
        mode: "nearest",
        intersect: false,
        position: "nearest",
        xPadding: 8,
        yPadding: 8,
        caretPadding: 8,
        backgroundColor: "#1D1F3C",
        cornerRadius: 4,
        titleFontSize: 13,
        titleFontStyle: "normal",
        bodyFontSize: 13,
        titleFontColor: "rgba(255, 255, 255, 0.8)",
        bodyFontColor: "rgba(255, 255, 255, 0.6)",
        borderWidth: 1,
        borderColor: "rgba(255, 255, 255, 0.08)",
        callbacks: {
          // use label callback to return the desired label
          label: function(tooltipItem, data) {
            return tooltipItem.xLabel + " " + tooltipItem.yLabel + "%";
          },
          // remove title
          title: function(tooltipItem, data) {
            return;
          }
        }
      },
      scales: {
        yAxes: [{
          position: "left",
          ticks: {
            fontSize: 14,
            fontColor: "rgba(255, 255, 255, 0.4)",
            padding: 15,
            autoSkip: false,
            maxTicksLimit: 6,
            beginAtZero: true,
            steps: 20,
            stepValue: 5,
            max: 100
          },
          gridLines: {
            color: "rgba(255, 255, 255, 0.08)",
            zeroLineWidth: 1,
            zeroLineColor: "rgba(255, 255, 255, 0.08)",
            drawBorder: false
          }
        }],
        xAxes: scalesXaxes
      },
      elements: {
        point: {
          radius: 0
        }
      }
    }
  });
}
/* End Line Chart2 Initialize */


/* Start Line Chart3 Initialize */
if ($.exists("#tb-chart3")) {
  var ctx3 = document.querySelector("#tb-chart3").getContext("2d");
  var myChart3 = new Chart(ctx3, {
    type: "pie",
    data: {
      labels: ["Desktop", "Mobile", "Tablet", "Miscellaneous"],
      datasets: [{
        backgroundColor: ["#ffcc00", "#ff9500", "#ff3b30", "#5856d6"],
        hoverBackgroundColor: ["#ffcc00", "#ff9500", "#ff3b30", "#5856d6"],
        data: [60, 15, 10, 15],
        borderWidth: 0,
        hoverBorderColor: ["#ffcc00", "#ff9500", "#ff3b30", "#5856d6"],
        hoverBorderWidth: 8
      }]
    },
    options: {
      cutoutPercentage: 80,
      legend: false,
      tooltips: lineChartToolTips
    }
  });
}

// Type2
if ($.exists("#tb-chart3-type2")) {
  var ctx3 = document.querySelector("#tb-chart3-type2").getContext("2d");
  var myChart3 = new Chart(ctx3, {
    type: "pie",
    data: {
      labels: ["Opened", "Sent"],
      datasets: [{
        backgroundColor: ["#5856d6", "rgba(255, 255, 255, 0.08)"],
        hoverBackgroundColor: ["#5856d6", "rgba(255, 255, 255, 0.08)"],
        data: [70, 30],
        borderWidth: 0,
        hoverBorderColor: ["#5856d6", "rgba(255, 255, 255, 0.08)"],
        hoverBorderWidth: 3
      }]
    },
    options: {
      cutoutPercentage: 90,
      legend: false,
      tooltips: lineChartToolTips
    }
  });
}

// Type3
if ($.exists("#tb-chart3-type3")) {
  var ctx3 = document.querySelector("#tb-chart3-type3").getContext("2d");
  var myChart3 = new Chart(ctx3, {
    type: "pie",
    data: {
      labels: ["Opened", "Sent"],
      datasets: [{
        backgroundColor: ["#007aff", "rgba(255, 255, 255, 0.08)"],
        hoverBackgroundColor: ["#007aff", "rgba(255, 255, 255, 0.08)"],
        data: [70, 30],
        borderWidth: 0,
        hoverBorderColor: ["#007aff", "rgba(255, 255, 255, 0.08)"],
        hoverBorderWidth: 3
      }]
    },
    options: {
      cutoutPercentage: 90,
      legend: false,
      tooltips: lineChartToolTips
    }
  });
}
/* End Line Chart3 Initialize */

/* Start Line Chart5 Initialize */
if ($.exists("#tb-chart5")) {
  var ctx5 = document.querySelector("#tb-chart5");
  var myChart5 = new Chart(ctx5, {
    type: "line",
    data: {
      labels: ["23 Dec", "", "3 Jan", "", "13 Jan", "", "25 Jan"],
      datasets: [{
          label: "Click",
          data: ["5", "21", "17", "20", "25", "24", "39"],
          backgroundColor: "transparent",
          borderColor: "#5856d6",
          borderWidth: 3,
          lineTension: 0,
          pointBackgroundColor: "#fff",
          pointDotRadius: 10
        },
        {
          label: "Orders",
          data: ["7", "17", "14", "25", "17", "32", "35"],
          backgroundColor: "transparent",
          borderColor: "rgba(88, 86, 214, 0.5)",
          borderWidth: 3,
          lineTension: 0,
          pointBackgroundColor: "#fff",
          pointDotRadius: 10
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: false,
      tooltips: lineChartToolTips,
      scales: {
        yAxes: [{
          position: "right",
          ticks: {
            fontSize: 14,
            fontColor: "rgba(255, 255, 255, 0.4)",
            padding: 5,
            autoSkip: false,
            maxTicksLimit: 4,
            beginAtZero: true,
            steps: 20,
            stepValue: 5,
            max: 40
          },
          gridLines: {
            color: "rgba(255, 255, 255, 0.08)",
            zeroLineWidth: 1,
            zeroLineColor: "rgba(255, 255, 255, 0.08)",
            drawBorder: false
          }
        }],
        xAxes: scalesXaxes
      },
      elements: {
        point: {
          radius: 0
        }
      }
    }
  });
}

// Type2
if ($.exists("#tb-chart5-type2")) {
  var ctx5 = document.querySelector("#tb-chart5-type2");
  var myChart5 = new Chart(ctx5, {
    type: "line",
    data: {
      labels: [
        "3 Dec",
        "28 Dec",
        "3 Jan",
        "8 Jan",
        "13 Jan",
        "20 Jan",
        "25 Jan"
      ],
      datasets: [{
          label: "Click",
          data: ["30", "15", "25", "20", "20", "35", "20"],
          backgroundColor: "transparent",
          borderColor: "#5856d6",
          borderWidth: 3,
          pointBackgroundColor: "#fff",
          pointDotRadius: 10
        },
        {
          label: "Orders",
          data: ["15", "30", "15", "30", "15", "25", "35"],
          backgroundColor: "transparent",
          borderColor: "rgba(88, 86, 214, 0.5)",
          borderWidth: 3,
          pointBackgroundColor: "#fff",
          pointDotRadius: 10
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: false,
      tooltips: lineChartToolTips,
      scales: {
        yAxes: [{
          position: "left",
          ticks: {
            fontSize: 14,
            fontColor: "rgba(255, 255, 255, 0.4)",
            padding: 15,
            autoSkip: false,
            maxTicksLimit: 6,
            beginAtZero: true,
            steps: 10,
            stepValue: 5,
            max: 40
          },
          gridLines: {
            color: "rgba(255, 255, 255, 0.08)",
            zeroLineWidth: 0,
            zeroLineColor: "rgba(255, 255, 255, 0.08)",
            drawBorder: false
          }
        }],
        xAxes: scalesXaxes
      },
      elements: {
        point: {
          radius: 0
        }
      }
    }
  });
}

// Type3
if ($.exists("#tb-chart5-type3")) {
  var ctx5 = document.querySelector("#tb-chart5-type3");
  var myChart5 = new Chart(ctx5, {
    type: "line",
    data: {
      labels: [
        "3 Dec",
        "28 Dec",
        "3 Jan",
        "8 Jan",
        "13 Jan",
        "20 Jan",
        "25 Jan"
      ],
      datasets: [{
          label: "Click",
          data: ["0", "15", "25", "10", "5", "20", "0"],
          backgroundColor: "rgba(0, 122, 255, 0.1)",
          borderColor: "#007aff",
          borderWidth: 3,
          pointBackgroundColor: "#fff",
          pointDotRadius: 10
        },
        {
          label: "Orders",
          data: ["15", "30", "15", "30", "15", "25", "20"],
          backgroundColor: "rgba(52, 199, 89, 0.1)",
          borderColor: "#34c759",
          borderWidth: 3,
          pointBackgroundColor: "#fff",
          pointDotRadius: 10
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: false,
      tooltips: lineChartToolTips,
      scales: {
        yAxes: [{
          position: "left",
          ticks: {
            fontSize: 14,
            fontColor: "rgba(255, 255, 255, 0.4)",
            padding: 15,
            autoSkip: false,
            maxTicksLimit: 6,
            beginAtZero: true,
            steps: 10,
            stepValue: 5,
            max: 40
          },
          gridLines: {
            color: "rgba(255, 255, 255, 0.08)",
            zeroLineWidth: 0,
            zeroLineColor: "rgba(255, 255, 255, 0.08)",
            drawBorder: false,
            tickMarkLength: 0
          }
        }],
        xAxes: scalesXaxes
      },
      elements: {
        point: {
          radius: 0
        }
      }
    }
  });
}

// Type4
if ($.exists("#tb-chart5-type4")) {
  var ctx5 = document.querySelector("#tb-chart5-type4");
  var myChart5 = new Chart(ctx5, {
    type: "line",
    data: {
      labels: [
        "3 Dec",
        "28 Dec",
        "3 Jan",
        "8 Jan",
        "13 Jan",
        "20 Jan",
        "25 Jan"
      ],
      datasets: [{
          label: "Click",
          data: ["0", "15", "25", "10", "5", "20", "0"],
          backgroundColor: "rgba(0, 122, 255, 0.1)",
          borderColor: "#007aff",
          borderWidth: 3,
          pointBackgroundColor: "#fff",
          pointDotRadius: 10
        },
        {
          label: "Orders",
          data: ["15", "30", "15", "30", "15", "25", "20"],
          backgroundColor: "rgba(52, 199, 89, 0.1)",
          borderColor: "#34c759",
          borderWidth: 3,
          pointBackgroundColor: "#fff",
          pointDotRadius: 10
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: false,
      tooltips: lineChartToolTips,
      scales: {
        yAxes: [{
          position: "left",
          ticks: {
            fontSize: 14,
            fontColor: "rgba(255, 255, 255, 0.4)",
            padding: 15,
            autoSkip: false,
            maxTicksLimit: 6,
            beginAtZero: true,
            steps: 10,
            stepValue: 5,
            max: 40
          },
          gridLines: {
            color: "rgba(255, 255, 255, 0.08)",
            zeroLineWidth: 0,
            zeroLineColor: "rgba(255, 255, 255, 0.08)",
            drawBorder: false,
            tickMarkLength: 0
          }
        }],
        xAxes: scalesXaxes
      },
      elements: {
        point: {
          radius: 0
        }
      }
    }
  });
}

// Type5
if ($.exists("#tb-chart5-type5")) {
  var ctx5 = document.querySelector("#tb-chart5-type5");
  var myChart5 = new Chart(ctx5, {
    type: "line",
    data: {
      labels: [
        "3 Dec",
        "28 Dec",
        "3 Jan",
        "8 Jan",
        "13 Jan",
        "20 Jan",
        "25 Jan"
      ],
      datasets: [{
          label: "Click",
          data: ["30", "15", "25", "20", "20", "35", "20"],
          backgroundColor: "transparent",
          borderColor: "#007aff",
          borderWidth: 3,
          pointBackgroundColor: "#fff",
          pointDotRadius: 10
        },
        {
          label: "Orders",
          data: ["15", "30", "15", "30", "15", "25", "35"],
          backgroundColor: "transparent",
          borderColor: "rgba(0, 122, 255, 0.5)",
          borderWidth: 3,
          pointBackgroundColor: "#fff",
          pointDotRadius: 10
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: false,
      tooltips: lineChartToolTips,
      scales: {
        yAxes: [{
          position: "left",
          ticks: {
            fontSize: 14,
            fontColor: "rgba(255, 255, 255, 0.4)",
            padding: 15,
            autoSkip: false,
            maxTicksLimit: 6,
            beginAtZero: true,
            steps: 10,
            stepValue: 5,
            max: 40
          },
          gridLines: {
            color: "rgba(255, 255, 255, 0.08)",
            zeroLineWidth: 0,
            zeroLineColor: "rgba(255, 255, 255, 0.08)",
            drawBorder: false
          }
        }],
        xAxes: scalesXaxes
      },
      elements: {
        point: {
          radius: 0
        }
      }
    }
  });
}
/* End Line Chart5 Initialize */

/* Start Line Chart6 Initialize */
if ($.exists("#tb-chart6")) {
  var ctx6 = document.querySelector("#tb-chart6");
  var myChart6 = new Chart(ctx6, {
    type: "line",
    data: {
      labels: ["23 Dec", "", "3 Jan", "", "13 Jan", "", "25 Jan"],
      datasets: [{
          label: "Month",
          data: ["5", "11", "7", "10", "15", "14", "19"],
          backgroundColor: "transparent",
          borderColor: "rgba(88, 86, 214, 0.4)",
          borderWidth: 3,
          lineTension: 0,
          pointBackgroundColor: "#fff",
          pointDotRadius: 10
        },
        {
          label: "Weekly",
          data: ["27", "30", "24", "35", "27", "34", "36"],
          backgroundColor: "transparent",
          borderColor: "rgba(88, 86, 214, 0.7)",
          borderWidth: 3,
          lineTension: 0,
          pointBackgroundColor: "#fff",
          pointDotRadius: 10
        },
        {
          label: "Daily",
          data: ["47", "50", "44", "55", "47", "52", "55"],
          backgroundColor: "transparent",
          borderColor: "#5856d6",
          borderWidth: 3,
          lineTension: 0,
          pointBackgroundColor: "#fff",
          pointDotRadius: 10
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: false,
      tooltips: lineChartToolTips,
      scales: {
        yAxes: [{
          position: "right",
          ticks: {
            fontSize: 14,
            fontColor: "rgba(255, 255, 255, 0.4)",
            padding: 5,
            autoSkip: false,
            maxTicksLimit: 6,
            beginAtZero: true,
            steps: 20,
            stepValue: 6,
            max: 60
          },
          gridLines: {
            color: "rgba(255, 255, 255, 0.08)",
            zeroLineWidth: 1,
            zeroLineColor: "rgba(255, 255, 255, 0.08)",
            drawBorder: false
          }
        }],
        xAxes: scalesXaxes
      },
      elements: {
        point: {
          radius: 0
        }
      }
    }
  });
}

// Type1
if ($.exists("#tb-chart7-type1")) {
  var ctx7 = document.querySelector("#tb-chart7-type1");
  var myChart7 = new Chart(ctx7, {
    type: "line",
    data: {
      labels: ["23 Dec", "25 Dec", "3 Jan", "", "13 Jan", "25 Dec", "25 Jan"],
      datasets: [{
          label: "Click",
          data: ["5", "14", "7", "10", "15", "14", "19"],
          backgroundColor: "transparent",
          borderColor: "#5856d6",
          borderWidth: 2,
          lineTension: 0,
          pointBackgroundColor: "#fff",
          pointDotRadius: 10
        },
        {
          label: "Orders",
          data: ["8", "10", "4", "15", "7", "12", "15"],
          backgroundColor: "transparent",
          borderColor: "rgba(88, 86, 214, 0.4)",
          borderWidth: 2,
          lineTension: 0,
          pointBackgroundColor: "#fff",
          pointDotRadius: 10
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: false,
      tooltips: false,
      scales: {
        yAxes: [{
          display: false
        }],
        xAxes: [{
          display: false
        }]
      },
      elements: {
        point: {
          radius: 0
        }
      }
    }
  });
}

// Type2
if ($.exists("#tb-chart7-type2")) {
  var ctx7 = document.querySelector("#tb-chart7-type2");
  var myChart7 = new Chart(ctx7, {
    type: "line",
    data: {
      labels: ["23 Dec", "25 Dec", "3 Jan", "", "13 Jan", "25 Dec", "25 Jan"],
      datasets: [{
          label: "Click",
          data: ["5", "14", "7", "10", "15", "14", "19"],
          backgroundColor: "transparent",
          borderColor: "#34c759",
          borderWidth: 2,
          lineTension: 0,
          pointBackgroundColor: "#fff",
          pointDotRadius: 10
        },
        {
          label: "Orders",
          data: ["8", "10", "4", "15", "7", "12", "15"],
          backgroundColor: "transparent",
          borderColor: "rgba(88, 86, 214, 0.4)",
          borderWidth: 2,
          lineTension: 0,
          pointBackgroundColor: "#fff",
          pointDotRadius: 10
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: false,
      tooltips: false,
      scales: {
        yAxes: [{
          display: false
        }],
        xAxes: [{
          display: false
        }]
      },
      elements: {
        point: {
          radius: 0
        }
      }
    }
  });
}

// Type3
if ($.exists("#tb-chart7-type3")) {
  var ctx7 = document.querySelector("#tb-chart7-type3");
  var myChart7 = new Chart(ctx7, {
    type: "line",
    data: {
      labels: ["23 Dec", "25 Dec", "3 Jan", "", "13 Jan", "25 Dec", "25 Jan"],
      datasets: [{
          label: "Click",
          data: ["5", "14", "7", "10", "15", "14", "19"],
          backgroundColor: "transparent",
          borderColor: "#007aff",
          borderWidth: 2,
          lineTension: 0,
          pointBackgroundColor: "#fff",
          pointDotRadius: 10
        },
        {
          label: "Orders",
          data: ["8", "10", "4", "15", "7", "12", "15"],
          backgroundColor: "transparent",
          borderColor: "rgba(88, 86, 214, 0.4)",
          borderWidth: 2,
          lineTension: 0,
          pointBackgroundColor: "#fff",
          pointDotRadius: 10
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: false,
      tooltips: false,
      scales: {
        yAxes: [{
          display: false
        }],
        xAxes: [{
          display: false
        }]
      },
      elements: {
        point: {
          radius: 0
        }
      }
    }
  });
}

// Type4
if ($.exists("#tb-chart7-type4")) {
  var ctx7 = document.querySelector("#tb-chart7-type4");
  var myChart7 = new Chart(ctx7, {
    type: "line",
    data: {
      labels: ["23 Dec", "25 Dec", "3 Jan", "", "13 Jan", "25 Dec", "25 Jan"],
      datasets: [{
          label: "Click",
          data: ["5", "14", "7", "10", "15", "14", "19"],
          backgroundColor: "transparent",
          borderColor: "#ff3b30",
          borderWidth: 2,
          lineTension: 0,
          pointBackgroundColor: "#fff",
          pointDotRadius: 10
        },
        {
          label: "Orders",
          data: ["8", "10", "4", "15", "7", "12", "15"],
          backgroundColor: "transparent",
          borderColor: "rgba(88, 86, 214, 0.4)",
          borderWidth: 2,
          lineTension: 0,
          pointBackgroundColor: "#fff",
          pointDotRadius: 10
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: false,
      tooltips: false,
      scales: {
        yAxes: [{
          display: false
        }],
        xAxes: [{
          display: false
        }]
      },
      elements: {
        point: {
          radius: 0
        }
      }
    }
  });
}
/* End Line Chart6 Initialize */

/* Start Line Chart8 Initialize */
// Type1
if ($.exists(".tb-chart8-type1")) {
  var ctx7 = document.querySelector(".tb-chart8-type1");
  var myChart7 = new Chart(ctx7, {
    type: "line",
    data: {
      labels: ["", "", "", "", "", "", "", "", "", "", "", "", "", ""],
      datasets: [{
        label: "Orders",
        data: ["8", "10", "4", "15", "7", "12", "15", "13", "11", "16","4", "15", "7", "12"],
        backgroundColor: "transparent",
        borderColor: "#f7931a",
        borderWidth: 2,
        lineTension: 0,
        pointBackgroundColor: "#fff",
        pointDotRadius: 10
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: false,
      tooltips: false,
      scales: {
        yAxes: [{
          display: false
        }],
        xAxes: [{
          display: false
        }]
      },
      elements: {
        point: {
          radius: 0
        }
      }
    }
  });
}

// Type2
if ($.exists(".tb-chart8-type2")) {
  var ctx7 = document.querySelector(".tb-chart8-type2");
  var myChart7 = new Chart(ctx7, {
    type: "line",
    data: {
      labels: ["", "", "", "", "", "", "", "", "", "", "", "", "", ""],
      datasets: [{
        label: "Orders",
        data: ["10", "7", "4", "10", "7", "12", "10", "13", "17", "12","4", "15", "10", "14"],
        backgroundColor: "transparent",
        borderColor: "#627eea",
        borderWidth: 2,
        lineTension: 0,
        pointBackgroundColor: "#fff",
        pointDotRadius: 10
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: false,
      tooltips: false,
      scales: {
        yAxes: [{
          display: false
        }],
        xAxes: [{
          display: false
        }]
      },
      elements: {
        point: {
          radius: 0
        }
      }
    }
  });
}

// Type3
if ($.exists(".tb-chart8-type3")) {
  var ctx7 = document.querySelector(".tb-chart8-type3");
  var myChart7 = new Chart(ctx7, {
    type: "line",
    data: {
      labels: ["", "", "", "", "", "", "", "", "", "", "", "", "", ""],
      datasets: [{
        label: "Orders",
        data: ["5", "10", "6", "15", "12", "18", "13", "17", "14", "16","8", "12", "7", "16"],
        backgroundColor: "transparent",
        borderColor: "rgba(34, 34, 34, 0.5)",
        borderWidth: 2,
        lineTension: 0,
        pointBackgroundColor: "#fff",
        pointDotRadius: 10
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: false,
      tooltips: false,
      scales: {
        yAxes: [{
          display: false
        }],
        xAxes: [{
          display: false
        }]
      },
      elements: {
        point: {
          radius: 0
        }
      }
    }
  });
}

// Type4
if ($.exists(".tb-chart8-type4")) {
  var ctx7 = document.querySelector(".tb-chart8-type4");
  var myChart7 = new Chart(ctx7, {
    type: "line",
    data: {
      labels: ["", "", "", "", "", "", "", "", "", "", "", "", "", ""],
      datasets: [{
        label: "Orders",
        data: ["8", "10", "4", "15", "7", "12", "15", "13", "11", "16","4", "15", "7", "12"],
        backgroundColor: "transparent",
        borderColor: "#8dc351",
        borderWidth: 2,
        lineTension: 0,
        pointBackgroundColor: "#fff",
        pointDotRadius: 10
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: false,
      tooltips: false,
      scales: {
        yAxes: [{
          display: false
        }],
        xAxes: [{
          display: false
        }]
      },
      elements: {
        point: {
          radius: 0
        }
      }
    }
  });
}

// Type5
if ($.exists(".tb-chart8-type5")) {
  var ctx7 = document.querySelector(".tb-chart8-type5");
  var myChart7 = new Chart(ctx7, {
    type: "line",
    data: {
      labels: ["", "", "", "", "", "", "", "", "", "", "", "", "", ""],
      datasets: [{
        label: "Orders",
        data: ["12", "10", "6", "9", "14", "11", "15", "18", "12", "10","14", "18", "7", "15"],
        backgroundColor: "transparent",
        borderColor: "#a5a8a9",
        borderWidth: 2,
        lineTension: 0,
        pointBackgroundColor: "#fff",
        pointDotRadius: 10
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: false,
      tooltips: false,
      scales: {
        yAxes: [{
          display: false
        }],
        xAxes: [{
          display: false
        }]
      },
      elements: {
        point: {
          radius: 0
        }
      }
    }
  });
}

// Type6
if ($.exists(".tb-chart8-type6")) {
  var ctx7 = document.querySelector(".tb-chart8-type6");
  var myChart7 = new Chart(ctx7, {
    type: "line",
    data: {
      labels: ["", "", "", "", "", "", "", "", "", "", "", "", "", ""],
      datasets: [{
        label: "Orders",
        data: ["10", "7", "4", "15", "10", "12", "17", "13", "10", "15","8", "12", "9", "17"],
        backgroundColor: "transparent",
        borderColor: "#17de8d",
        borderWidth: 2,
        lineTension: 0,
        pointBackgroundColor: "#fff",
        pointDotRadius: 10
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: false,
      tooltips: false,
      scales: {
        yAxes: [{
          display: false
        }],
        xAxes: [{
          display: false
        }]
      },
      elements: {
        point: {
          radius: 0
        }
      }
    }
  });
}

// Type7
if ($.exists(".tb-chart8-type7")) {
  var ctx7 = document.querySelector(".tb-chart8-type7");
  var myChart7 = new Chart(ctx7, {
    type: "line",
    data: {
      labels: ["", "", "", "", "", "", "", "", "", "", "", "", "", ""],
      datasets: [{
        label: "Orders",
        data: ["8", "10", "4", "15", "7", "12", "15", "13", "11", "16","4", "15", "7", "12"],
        backgroundColor: "rgba(247, 147, 26, 0.1)",
        borderColor: "#f7931a",
        borderWidth: 2,
        lineTension: 0,
        pointBackgroundColor: "#fff",
        pointDotRadius: 10
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: false,
      tooltips: false,
      scales: {
        yAxes: [{
          display: false
        }],
        xAxes: [{
          display: false
        }]
      },
      elements: {
        point: {
          radius: 0
        }
      }
    }
  });
}

// Type8
if ($.exists(".tb-chart8-type8")) {
  var ctx7 = document.querySelector(".tb-chart8-type8");
  var myChart7 = new Chart(ctx7, {
    type: "line",
    data: {
      labels: ["", "", "", "", "", "", "", "", "", "", "", "", "", ""],
      datasets: [{
        label: "Orders",
        data: ["10", "7", "4", "10", "7", "12", "10", "13", "17", "12","4", "15", "10", "14"],
        backgroundColor: "rgba(98, 126, 234, 0.1)",
        borderColor: "#627eea",
        borderWidth: 2,
        lineTension: 0,
        pointBackgroundColor: "#fff",
        pointDotRadius: 10
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: false,
      tooltips: false,
      scales: {
        yAxes: [{
          display: false
        }],
        xAxes: [{
          display: false
        }]
      },
      elements: {
        point: {
          radius: 0
        }
      }
    }
  });
}

// Type9
if ($.exists(".tb-chart8-type9")) {
  var ctx7 = document.querySelector(".tb-chart8-type9");
  var myChart7 = new Chart(ctx7, {
    type: "line",
    data: {
      labels: ["", "", "", "", "", "", "", "", "", "", "", "", "", ""],
      datasets: [{
        label: "Orders",
        data: ["5", "10", "6", "15", "12", "18", "13", "17", "14", "16","8", "12", "7", "16"],
        backgroundColor: "rgba(34, 34, 34, 0.1)",
        borderColor: "rgba(34, 34, 34, 0.5)",
        borderWidth: 2,
        lineTension: 0,
        pointBackgroundColor: "#fff",
        pointDotRadius: 10
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: false,
      tooltips: false,
      scales: {
        yAxes: [{
          display: false
        }],
        xAxes: [{
          display: false
        }]
      },
      elements: {
        point: {
          radius: 0
        }
      }
    }
  });
}

// Type10
if ($.exists(".tb-chart8-type10")) {
  var ctx7 = document.querySelector(".tb-chart8-type10");
  var myChart7 = new Chart(ctx7, {
    type: "line",
    data: {
      labels: ["", "", "", "", "", "", "", "", "", "", "", "", "", ""],
      datasets: [{
        label: "Orders",
        data: ["8", "10", "4", "15", "7", "12", "15", "13", "11", "16","4", "15", "7", "12"],
        backgroundColor: "rgba(141, 195, 81, 0.1)",
        borderColor: "#8dc351",
        borderWidth: 2,
        lineTension: 0,
        pointBackgroundColor: "#fff",
        pointDotRadius: 10
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: false,
      tooltips: false,
      scales: {
        yAxes: [{
          display: false
        }],
        xAxes: [{
          display: false
        }]
      },
      elements: {
        point: {
          radius: 0
        }
      }
    }
  });
}

// Type11
if ($.exists(".tb-chart8-type11")) {
  var ctx7 = document.querySelector(".tb-chart8-type11");
  var myChart7 = new Chart(ctx7, {
    type: "line",
    data: {
      labels: ["", "", "", "", "", "", "", "", "", "", "", "", "", ""],
      datasets: [{
        label: "Orders",
        data: ["12", "10", "6", "9", "14", "11", "15", "18", "12", "10","14", "18", "7", "15"],
        backgroundColor: "rgba(165, 168, 169, 0.1)",
        borderColor: "#a5a8a9",
        borderWidth: 2,
        lineTension: 0,
        pointBackgroundColor: "#fff",
        pointDotRadius: 10
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: false,
      tooltips: false,
      scales: {
        yAxes: [{
          display: false
        }],
        xAxes: [{
          display: false
        }]
      },
      elements: {
        point: {
          radius: 0
        }
      }
    }
  });
}

// Type12
if ($.exists(".tb-chart8-type12")) {
  var ctx7 = document.querySelector(".tb-chart8-type12");
  var myChart7 = new Chart(ctx7, {
    type: "line",
    data: {
      labels: ["", "", "", "", "", "", "", "", "", "", "", "", "", ""],
      datasets: [{
        label: "Orders",
        data: ["10", "7", "4", "15", "10", "12", "17", "13", "10", "15","8", "12", "9", "17"],
        backgroundColor: "rgba(23, 222, 141, 0.1)",
        borderColor: "#17de8d",
        borderWidth: 2,
        lineTension: 0,
        pointBackgroundColor: "#fff",
        pointDotRadius: 10
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: false,
      tooltips: false,
      scales: {
        yAxes: [{
          display: false
        }],
        xAxes: [{
          display: false
        }]
      },
      elements: {
        point: {
          radius: 0
        }
      }
    }
  });
}
/* End Line Chart8 Initialize */
