  new Chartist.Line('#chart1', {
    labels: ['Mon', 'Tues','Wed', 'Thurs', 'Fri', 'Sat', 'Sun'],

       series: [
      {
        name: 'LY Sales',
        data: [ 6523456, 6623456 , 7523456, 5523456, 6323456, 5923456, 6234568 ]
      },
      {
        name: 'TY Sales',
        data: [ 5523456, 4623456 , 8523456, 4823456, 4223456, 6123456, 6923456 ]
      }
    ]

  }, {
  fullWidth: true,
  chartPadding: {
    right: 40
  },  
  axisY: {
    labelInterpolationFnc: function(value) {
      return (value / 1000000) + 'M';
    }
  }
});

  

var data = {
    labels: ['Footwear (20%)', 'Hardgoods', 'Softgoods', 'Hockey', 'Golf', 'Licensed' ],
    series: [20, 15, 25, 8, 5, 2]
};

var options = {
  labelInterpolationFnc: function(value) {
    return value[0]
  }
};

var responsiveOptions = [
  ['screen and (min-width: 640px)', {
    chartPadding: 30,
    labelOffset: 10,
    labelDirection: 'explode',
    labelInterpolationFnc: function(value) {
      return value;
    }
  }],
  ['screen and (min-width: 1024px)', {
    labelOffset: -20,
    chartPadding: 20
  }]
];

// new Chartist.Pie('#pie', data, options, responsiveOptions);

new Chartist.Pie('#pie', data, options, responsiveOptions, {
  labelInterpolationFnc: function(value) {
    return Math.round(value / data.series.reduce(sum) * 100) + '%';
  }
});


var databar = {
  labels: ['Mon', 'Tues','Wed', 'Thurs', 'Fri', 'Sat', 'Sun'],
  series: [
    [1, 2, 4, 8, 6, -2, -1]
  ]
};

var optionsbar = {
  high: 10,
  low: -10
}

new Chartist.Bar('#bar', databar, optionsbar).on('draw', function(data) {

  if(data.type === 'bar') {
    data.element.attr({
      style: 'stroke: green; stroke-width: 100px'
    });

    if(data.value.y < 0){
      data.element.attr({
        style: 'stroke-width: 100px; stroke: red;'
      });
    }
    
  }


});

