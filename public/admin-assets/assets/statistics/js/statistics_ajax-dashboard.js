'use strict';
var productNames = []
var productcolors = []
var productLicenses = []

$('.product').each((index, el) => {

    productNames[index] = el.getAttribute('data-name')
    productcolors[index] = el.getAttribute('data-color')
    productLicenses[index] = el.getAttribute('data-licenses')

})



$('#select-chart-2-3').on('change', function () {
    $('#load').show()
    $.ajax({
        url: "/admin/dashboard/clients-chart",
        method: "get",
        data: {
            format: $(this).val()
        }, success: function (response) {
            console.log(response.dates , response.data)
            chart_2_3.data.labels = response.dates
            chart_2_3.data.datasets[0].data = response.data

            chart_2_3.update();
            $('#load').hide()
        }, error: function (response) {
            $('#load').hide()
        }
    })
})

// var productChartNames = []
// var productChartColors = []
// var productChartIncomes = []

// $('.product-chart').each((index, el) => {

//     productChartNames[index] = el.getAttribute('data-name')
//     productChartColors[index] = el.getAttribute('data-color')
//     productChartIncomes[index] = el.getAttribute('data-licenses')

// })

// chart_1_3.data.labels = productNames
// chart_1_3.data.datasets[0].data = productLicenses
// chart_1_3.data.datasets[0].backgroundColor = productcolors

// console.log(chart_1_3.data)
