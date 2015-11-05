//   new Chartist.Line('#chart1', {
//     labels: ['M', 'T','W', 'Th', 'F', 'S', 'S'],

//     series: [
//       {
//         name: 'LY Sales',
//         data: [ 6523456, 6623456 , 7523456, 5523456, 6323456, 5923456, 6234568 ]
//       },
//       {
//         name: 'TY Sales',
//         data: [ 5523456, 4623456 , 8523456, 4823456, 4223456, 6123456, 6923456 ]
//       }
//     ]

//   }, {
//   fullWidth: true,
//   chartPadding: {
//     top: 30,
//     right: 40,
//     left: 20
//   },  
//   axisY: {
//     labelInterpolationFnc: function(value) {
//       return (value / 1000000) + 'M';
//     }
//   },
//   plugins: [
//     Chartist.plugins.ctPointLabels({
//       textAnchor: 'middle', 
//       textSize: '10px'
//     })
//   ]
  
// });
// 


new Chartist.Bar('#chart1', {
  labels: ['Mon', 'Tues','Wed', 'Thurs', 'Fri', 'Sat', 'Sun'],
  series: [
    [ 2409573, 2233389, 2279086, 0, 0, 0, 0 ],
    [ 2652988, 2357740, 2567888, 0, 0, 0, 0 ]
  ]
}, {
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
}).on('draw', function(data) {
  if(data.type === 'bar') {
    data.element.attr({
      style: 'stroke-width: 35px'
    }); 
  }
});


var datapie = {
    labels: ['Hardgoods', 'Softgoods', 'Footwear', 'Other' ],
    series: [505880, 1142598, 573694, 26099 ]
}

var options = {
  labelInterpolationFnc: function(value) {
    return value[0]
  }
};

var responsiveOptions = [
  ['screen and (min-width: 640px)', {
    chartPadding: {
        top: 30,
        right: 0,
        left: 300,
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
        left: 500,
        bottom: 30
        }
    }]
];

new Chartist.Pie('#pie', datapie, options, responsiveOptions);


new Chartist.Bar('#bar', {
  labels: ['Mon', 'Tues','Wed', 'Thurs', 'Fri', 'Sat', 'Sun'],
  series: [
    [-4.7, -0.4, -5.6, 0, 0, 0, 0]
  ]
}, {
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
})

.on('draw', function(data) {
  if(data.type === 'bar') {
    data.element.attr({
      style: 'stroke: green; stroke-width: 120px'
    });

    if(data.value.y < 0){
      data.element.attr({
        style: 'stroke-width: 120px; stroke: red;'
      });
    } 
  }
});

var legend = $('.ct-legend');

$.each(datapie.labels, function(i, val) {
    var listItem = $('<li />')
        .addClass('ct-series-' + i)
        .html('<strong>' + val + '</strong>: $' + numberWithCommas(datapie.series[i]))
        .appendTo(legend);
});


function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

// new Chartist.Bar('#bar', databar, optionsbar).on('draw', function(data) {

//   if(data.type === 'bar') {
//     data.element.attr({
//       style: 'stroke: green; stroke-width: 120px'
//     });

//     if(data.value.y < 0){
//       data.element.attr({
//         style: 'stroke-width: 120px; stroke: red;'
//       });
//     }
    
//   }


// });

