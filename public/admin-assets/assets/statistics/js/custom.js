'use strict';

let direction = false, isOriginLeft = true, dir = $("html").attr("dir");
if (dir == "rtl") {
    direction = true;
    isOriginLeft = false;
    $("#bs_dir").attr("href", "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css");
} else {
    $("#bs_dir").attr("href", "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css");
};

/*---------------------------------------------------
    tooltip
---------------------------------------------------*/

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})

/*---------------------------------------------------
    Form validation
---------------------------------------------------*/

var forms = document.querySelectorAll('.needs-validation');
Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
        }
        form.classList.add('was-validated')
    }, false)
});

/*--------------------------------------
    grid masonry
--------------------------------------*/

var columnWidth = ($(".grid-item").width() + 30);
console.log(columnWidth);

var $grid = $('.grid').masonry({
    itemSelector: '.grid-item',
    isOriginLeft: true,
    percentPosition: false,
    horizontalOrder: false,
    transitionDuration: '0.5s',
    columnWidth: columnWidth //330
});

$grid.on('click', '.grid-item', function () {
    $(".grid-item").removeClass('grid-item-lg');
    $(".grid-item").find('.statistics-box').removeClass("d-none");
    $(".grid-item").find('.statistics-box-info').addClass("d-none");

    $(this).toggleClass('grid-item-lg');
    $(this).find('.statistics-box').addClass("d-none");
    $(this).find('.statistics-box-info').removeClass("d-none");

    $grid.masonry('layout');
});

$grid.on('click', '.close-statistics-box', function(event){
    event.stopPropagation();
    $( this ).parent().parent().removeClass('grid-item-lg');
    $( this ).parent().parent().find('.statistics-box').removeClass("d-none");
    $( this ).parent().parent().find('.statistics-box-info').addClass("d-none");
    $grid.masonry('layout');
});

$grid.on('click', '.grid-item .statistics-box', function(){
    $( ".grid-item" ).removeClass('grid-item-lg');
    $( ".grid-item" ).find('.statistics-box').removeClass("d-none");
    $( ".grid-item" ).find('.statistics-box-info').addClass("d-none");
    $( this ).parent().addClass('grid-item-lg');
    $( this ).parent().find('.statistics-box-info').removeClass("d-none");
    $( this ).addClass("d-none");
    $grid.masonry('layout');
});


/*--------------------------------------
    countUp
--------------------------------------*/

$('.count').countUp({
    'time': 2000,
    'delay': 15
});

/*--------------------------------------
    Chart 1
--------------------------------------*/

const ctx_1 = document.getElementById('chart-1');
const gradient = ctx_1.getContext('2d').createLinearGradient(0, 0, 0, 270);
gradient.addColorStop(1, 'rgb(84, 216, 255)');
gradient.addColorStop(0, 'rgb(84, 216, 255, .5)');

const chart_1 = new Chart(ctx_1, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Mar', 'May', 'Jun'],
        datasets: [{
            maxBarThickness: 6,
            //        label: '# of Votes',
            data: [12, 19, 33, 25, 12, 23],
            borderWidth: 0,
            backgroundColor: gradient,
        }]
    },
    options: {
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                enabled: false
            }
        },
        scales: {
            y: {
                display: false,
                beginAtZero: true,
                grid: {
                    display: false
                }
            },
            x: {
                display: false,
                grid: {
                    display: false
                }
            }
        }
    },
});
const ctx_1_1 = document.getElementById('chart-1-1').getContext('2d');

var dataset_chart_1_1;

if ( activeProductsCount === 0 && inActiveProductsCount === 0 ) {
    dataset_chart_1_1 = [{
        label: 'Products',
        data: ['100'],
        backgroundColor: "#f1f1f1",
        borderRadius: 50,
        hoverOffset: activeProductsCount
    }];
} else {
    dataset_chart_1_1 = [{
        label: 'Products',
        data: [activeProductsCount, inActiveProductsCount],
        backgroundColor: ['#9BABFE', '#FCA8CF'],
        borderRadius: 50,
        hoverOffset: activeProductsCount
    }];
}

const chart_1_1 = new Chart(ctx_1_1, {
    type: 'doughnut',
    data: {
        labels: [
            ' Active',
            ' Inactive',
        ],
        datasets: dataset_chart_1_1,
    },
    options: {
        cutout: "90%",
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                yAlign: 'top',
            }
        },
        scales: {
            y: {
                display: false,
                beginAtZero: true,
                grid: {
                    display: false
                },
            },
            x: {
                display: false,
                grid: {
                    display: false
                },
            }
        }
    },
});







/*--------------------------------------
    Chart 2
--------------------------------------*/

const ctx_2 = document.getElementById('chart-2');
const gradient2 = ctx_2.getContext('2d').createLinearGradient(0, 0, 0, 270);
gradient2.addColorStop(1, 'rgb(94, 226, 160)');
gradient2.addColorStop(0, 'rgb(94, 226, 160, .5)');

const chart_2 = new Chart(ctx_2, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Mar', 'May', 'Jun'],
        datasets: [{
            maxBarThickness: 6,
            //        label: '# of Votes',
            data: [12, 19, 33, 25, 12, 23],
            borderWidth: 0,
            backgroundColor: gradient2,
        }]
    },
    options: {
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                enabled: false
            }
        },
        scales: {
            y: {
                display: false,
                beginAtZero: true,
                grid: {
                    display: false
                }
            },
            x: {
                display: false,
                grid: {
                    display: false
                }
            }
        }
    },
});






const ctx_2_3 = document.getElementById('chart-2-3').getContext('2d');
const chart_2_3 = new Chart(ctx_2_3, {
    type: 'line',
    data: clientsChart,
    options: {
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                //   display: false,
                beginAtZero: true,
                grid: {
                    //   display: false
                },
            },
            x: {
                grid: {
                    //    display: false
                },
            }
        }
    },
});

/*--------------------------------------
    Chart 3
--------------------------------------*/

const ctx_3 = document.getElementById('chart-3');
const gradient3 = ctx_3.getContext('2d').createLinearGradient(0, 0, 0, 270);
gradient3.addColorStop(1, 'rgb(163, 160, 251)');
gradient3.addColorStop(0, 'rgb(163, 160, 251, .5)');

const chart_3 = new Chart(ctx_3, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Mar', 'May', 'Jun'],
        datasets: [{
            maxBarThickness: 6,
            //        label: '# of Votes',
            data: [12, 19, 33, 25, 12, 23],
            borderWidth: 0,
            backgroundColor: gradient3,
        }]
    },
    options: {
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                enabled: false
            }
        },
        scales: {
            y: {
                display: false,
                beginAtZero: true,
                grid: {
                    display: false
                }
            },
            x: {
                display: false,
                grid: {
                    display: false
                }
            }
        }
    },
});




// const ctx_3_3 = document.getElementById('chart-3-3').getContext('2d');
// const chart_3_3 = new Chart(ctx_3_3, {
//     type: 'bar',
//     data: {
//         labels: ['Jan', 'Feb', 'Mar', 'Mar', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
//         datasets: [{
//             maxBarThickness: 6,
//             //   label: '# of Votes',
//             data: [12, 19, 33, 25, 12, 23, 12, 19, 33, 25, 12, 23],
//             borderWidth: 0,
//             borderRadius: 50,
//             backgroundColor: "#9BABFE",
//         }]
//     },
//     options: {
//         responsive: true,
//         plugins: {
//             legend: {
//                 display: false
//             }
//         },
//         scales: {
//             y: {
//                 display: false,
//                 beginAtZero: true,
//                 grid: {
//                     display: false
//                 }
//             },
//             x: {
//                 grid: {
//                     display: false
//                 }
//             }
//         }
//     },
// });

/*--------------------------------------
    Chart 4
--------------------------------------*/

const ctx_4 = document.getElementById('chart-4');
const gradient4 = ctx_4.getContext('2d').createLinearGradient(0, 0, 0, 270);
gradient4.addColorStop(1, 'rgb(255, 93, 255)');
gradient4.addColorStop(0, 'rgb(255, 93, 255, .5)');

const chart_4 = new Chart(ctx_4, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Mar', 'May', 'Jun'],
        datasets: [{
            maxBarThickness: 6,
            //        label: '# of Votes',
            data: [12, 19, 33, 25, 12, 23],
            borderWidth: 0,
            backgroundColor: gradient4,
        }]
    },
    options: {
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                enabled: false
            }
        },
        scales: {
            y: {
                display: false,
                beginAtZero: true,
                grid: {
                    display: false
                }
            },
            x: {
                display: false,
                grid: {
                    display: false
                }
            }
        }
    },
});


const ctx_4_1 = document.getElementById('chart-4-1').getContext('2d');

var dataset_chart_4_1;

if ( activations === 0 && deActivation === 0 && success_deactivations === 0 && fail_deActivation === 0 ) {
    dataset_chart_4_1 = [{
        label: 'Products',
        data: ["100"],
        backgroundColor: "#f1f1f1",
        borderRadius: 0,
        hoverOffset: 4
    }];
} else {
    dataset_chart_4_1 = [{
        label: 'Products',
        data: [activations, deActivation,success_deactivations,fail_deActivation],
        backgroundColor: ['rgb(121, 210, 222)', 'rgb(121, 210, 222, .3)','rgb(255, 65, 65)', 'rgb(255, 65, 65, .3)'],
        borderRadius: 0,
        hoverOffset: 4
    }]
}

const chart_4_1 = new Chart(ctx_4_1, {
    type: 'doughnut',
    data: {
        labels: [
            'Success Activation',
            'Fail Activation',
            'Success Deactivation',
            'Fail Deactivation'
        ],
        datasets: dataset_chart_4_1,

    },
    options: {
        cutout: "90%",
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                display: false,
                beginAtZero: true,
                grid: {
                    display: false
                },
            },
            x: {
                display: false,
                grid: {
                    display: false
                },
            }
        }
    },
});





/*--------------------------------------
    Chart 5
--------------------------------------*/

const ctx_5 = document.getElementById('chart-5');
const gradient5 = ctx_5.getContext('2d').createLinearGradient(0, 0, 0, 270);
gradient5.addColorStop(1, 'rgb(253, 180, 77)');
gradient5.addColorStop(0, 'rgb(253, 180, 77, .5)');

const chart_5 = new Chart(ctx_5, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Mar', 'May', 'Jun'],
        datasets: [{
            maxBarThickness: 6,
            //        label: '# of Votes',
            data: [12, 19, 33, 25, 12, 23],
            borderWidth: 0,
            backgroundColor: gradient5,
        }]
    },
    options: {
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                enabled: false
            }
        },
        scales: {
            y: {
                display: false,
                beginAtZero: true,
                grid: {
                    display: false
                }
            },
            x: {
                display: false,
                grid: {
                    display: false
                }
            }
        }
    },
});




/*--------------------------------------
    Chart 6
--------------------------------------*/

const ctx_6 = document.getElementById('chart-6');
const gradient6 = ctx_6.getContext('2d').createLinearGradient(0, 0, 0, 270);
gradient6.addColorStop(1, 'rgb(46, 178, 187)');
gradient6.addColorStop(0, 'rgb(46, 178, 187, .5)');

const chart_6 = new Chart(ctx_6, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Mar', 'May', 'Jun'],
        datasets: [{
            maxBarThickness: 6,
            //        label: '# of Votes',
            data: [12, 19, 33, 25, 12, 23],
            borderWidth: 0,
            backgroundColor: gradient6,
        }]
    },
    options: {
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                enabled: false
            }
        },
        scales: {
            y: {
                display: false,
                beginAtZero: true,
                grid: {
                    display: false
                }
            },
            x: {
                display: false,
                grid: {
                    display: false
                }
            }
        }
    },
});


/*--------------------------------------
    Chart 7
--------------------------------------*/

const ctx_7 = document.getElementById('chart-7');
const gradient7 = ctx_7.getContext('2d').createLinearGradient(0, 0, 0, 270);
gradient7.addColorStop(1, 'rgb(255, 101, 101)');
gradient7.addColorStop(0, 'rgb(255, 101, 101, .5)');

const chart_7 = new Chart(ctx_7, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Mar', 'May', 'Jun'],
        datasets: [{
            maxBarThickness: 6,
            //        label: '# of Votes',
            data: [12, 19, 33, 25, 12, 23],
            borderWidth: 0,
            backgroundColor: gradient7,
        }]
    },
    options: {
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                enabled: false
            }
        },
        scales: {
            y: {
                display: false,
                beginAtZero: true,
                grid: {
                    display: false
                }
            },
            x: {
                display: false,
                grid: {
                    display: false
                }
            }
        }
    },
});


/* https://github.com/10bestdesign/jqvmap */
// jQuery(document).ready(function () {
//     $('#vmap').vectorMap({
//         map: 'world_en',
//         enableZoom: true,
//         showTooltip: true,
//         series: {
//             regions: [{
//                 values: gdpData,
//                 scale: ['#C8EEFF', '#0071A4'],
//                 normalizeFunction: 'polynomial'
//             }]
//         },
//         /*
//         onRegionClick: function(element, code, region) {
//             var message = 'You clicked "'
//                 + region
//                 + '" which has the code: '
//                 + code.toUpperCase();

//             alert(message);
//         },

//         code.toUpperCase()
//         */
//         onLabelShow: function (event, label, code) {
//             code = code.toUpperCase()
//             var clients = gdpData[code]?  gdpData[code]['clients_count'] : 0
//             var percentage = gdpData[code]? gdpData[code]['percentage'] : 0

//             var html_box = '\
//                 <div class="map-tooltip">\
//                     <h2 class="header">'+ label.text() + " - " + code + '</h2>\
//                     <div class="content">\
//                         <p class="users"> <i class="fa fa-user"></i> '+ clients + '</p>\
//                         <p class="percent"> ' + percentage + '% </p>\
//                     </div>\
//                 </div>';
//             label.html(html_box);
//         }
//     });
// });

