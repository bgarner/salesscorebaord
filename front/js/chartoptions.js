
var chartoptions = {
  fullWidth: true,
  chartPadding: {
    top: 30,
    right: 25,
    left: -20,
    bottom: -20
  },      
  seriesBarDistance: 40,
  axisX: {
    offset: 60
  },
  axisY: {
    offset: 80,
        labelInterpolationFnc: function(value) {
            return (value / 1000000) + 'M';
        },

    scaleMinSpace: 15
  }
};

/**********************----------------------------------------------------------------------- */
var pieoptions = {
  labelInterpolationFnc: function(value) {
    return value[0]
  }
};

var pieresponsiveOptions = [
  ['screen and (min-width: 640px)', {
    chartPadding: {
        top: 30,
        right: 0,
        left: 200,
        bottom: 30
    }, 
    // labelOffset: 0,
    labelDirection: 'explode',
    labelInterpolationFnc: function(value) {
      return value;
    }
  }],
  ['screen and (min-width: 1024px)', {
    labelOffset: 0,
        chartPadding: {
        top: 30,
        right: 0,
        left: 350,
        bottom: 30
        }
    }]
];


/**********************----------------------------------------------------------------------- */
var plusminusoptions = {
  high: 10,
  low: -10,
  chartPadding: {
    right: 20,
    top: 30,
    left: 20
  },   
  plugins: [
    Chartist.plugins.ctPointLabels({
      textAnchor: 'middle'
    })
  ]
}

