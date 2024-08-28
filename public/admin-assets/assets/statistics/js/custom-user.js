
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

    /*--------------------------------------
        grid masonry
    --------------------------------------*/

    var columnWidth = ($( ".grid-item" ).outerWidth()) ;
    var $grid = $('.grid').masonry({
        itemSelector: '.grid-item',
        isOriginLeft : true,
        percentPosition: true,
        horizontalOrder: false,
        transitionDuration: '0.5s',
        columnWidth:  columnWidth //330
    });
	console.log(columnWidth);
    $grid.on('click', '.grid-item', function(){

            $( ".grid-item" ).removeClass('grid-item-lg');
            $( ".grid-item" ).find('.statistics-box').removeClass("d-none");
            $( ".grid-item" ).find('.statistics-box-info').addClass("d-none");

            $( this ).toggleClass('grid-item-lg');
            $( this ).find('.statistics-box').addClass("d-none");
            $( this ).find('.statistics-box-info').removeClass("d-none");
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
    
    /*

        USER

    */


    /*--------------------------------------
        chart-user-1
    --------------------------------------*/

    const   ctx_user_1 = document.getElementById('chart-user-1');
    const   gradient_user_1 = ctx_user_1.getContext('2d').createLinearGradient(0, 0, 0, 270);
            gradient_user_1.addColorStop(1, 'rgb(85, 216, 254)');
            gradient_user_1.addColorStop(0, 'rgb(85, 216, 254, .5)');

    const chart_user_1 = new Chart(ctx_user_1, {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr', 'May', 'Jun'],
            datasets: [{
                maxBarThickness: 6,
        //      label: '# of Votes',
                data: [12, 19, 33, 25, 12, 23],
                borderWidth: 0,
                backgroundColor: gradient_user_1,
            }]
        },
        options: {
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
                    }
                },
                x:{
                    display: false,
                    grid: {
                        display: false
                    }
                }
            }
        },
    });
   


    /*--------------------------------------
        chart-user-2
    --------------------------------------*/

    const   ctx_user_2 = document.getElementById('chart-user-2');
    const   gradient_user_2 = ctx_user_2.getContext('2d').createLinearGradient(0, 0, 0, 270);
            gradient_user_2.addColorStop(1, 'rgb(85, 216, 254)');
            gradient_user_2.addColorStop(0, 'rgb(85, 216, 254, .5)');

    const chart_user_2 = new Chart(ctx_user_2, {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr', 'May', 'Jun'],
            datasets: [{
                maxBarThickness: 6,
        //      label: '# of Votes',
                data: [12, 19, 33, 25, 12, 23],
                borderWidth: 0,
                backgroundColor: gradient_user_2,
            }]
        },
        options: {
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
                    }
                },
                x:{
                    display: false,
                    grid: {
                        display: false
                    }
                }
            }
        },
    });
    const ctx_user_2_1 = document.getElementById('chart-user-2-1').getContext('2d');
    const chart_user_2_2 = new Chart(ctx_user_2_1, {
        type: 'line',
        data: license_data,
        options: {
            responsive: true,

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
                   //     display: false
                    },
                },
                x:{
                    grid: {
                  //      display: false
                    },
                }
            }
        },
    });

    /*--------------------------------------
        chart-user-3
    --------------------------------------*/

    const   ctx_user_3 = document.getElementById('chart-user-3');
    const   gradient_user_3 = ctx_user_3.getContext('2d').createLinearGradient(0, 0, 0, 270);
            gradient_user_3.addColorStop(1, 'rgb(85, 216, 254)');
            gradient_user_3.addColorStop(0, 'rgb(85, 216, 254, .5)');

    const chart_user_3 = new Chart(ctx_user_3, {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr', 'May', 'Jun'],
            datasets: [{
                maxBarThickness: 6,
        //      label: '# of Votes',
                data: [12, 19, 33, 25, 12, 23],
                borderWidth: 0,
                backgroundColor: gradient_user_3,
            }]
        },
        options: {
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
                    }
                },
                x:{
                    display: false,
                    grid: {
                        display: false
                    }
                }
            }
        },
    });
    const   ctx_user_3_1 = document.getElementById('chart-user-3-1').getContext('2d');
    const chart_user_3_1 = new Chart(ctx_user_3_1, {
        type: 'line',
        data: activations_chart,
        options: {
            elements: {
                line: {
                    tension: 0
                }
            },
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                //    display: false,
                    beginAtZero: true,
                    grid: {
                        display: false
                    },
                },
                x:{
                    grid: {
                        display: false
                    },
                }
            },
        }
    });


    /*--------------------------------------
        chart-user-4
    --------------------------------------*/

    const   ctx_user_4 = document.getElementById('chart-user-4');
    const   gradient_user_4 = ctx_user_4.getContext('2d').createLinearGradient(0, 0, 0, 270);
            gradient_user_4.addColorStop(1, 'rgb(85, 216, 254)');
            gradient_user_4.addColorStop(0, 'rgb(85, 216, 254, .5)');

    const chart_user_4 = new Chart(ctx_user_4, {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr', 'May', 'Jun'],
            datasets: [{
                maxBarThickness: 6,
        //      label: '# of Votes',
                data: [12, 19, 33, 25, 12, 23],
                borderWidth: 0,
                backgroundColor: gradient_user_4,
            }]
        },
        options: {
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
                    }
                },
                x:{
                    display: false,
                    grid: {
                        display: false
                    }
                }
            }
        },
    });

   

    /*--------------------------------------
        chart-user-5
    --------------------------------------*/

    const   ctx_user_5 = document.getElementById('chart-user-5');
    const   gradient_user_5 = ctx_user_5.getContext('2d').createLinearGradient(0, 0, 0, 270);
            gradient_user_5.addColorStop(1, 'rgb(85, 216, 254)');
            gradient_user_5.addColorStop(0, 'rgb(85, 216, 254, .5)');

    const chart_user_5 = new Chart(ctx_user_5, {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr', 'May', 'Jun'],
            datasets: [{
                maxBarThickness: 6,
        //      label: '# of Votes',
                data: [12, 19, 33, 25, 12, 23],
                borderWidth: 0,
                backgroundColor: gradient_user_5,
            }]
        },
        options: {
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
                    }
                },
                x:{
                    display: false,
                    grid: {
                        display: false
                    }
                }
            }
        },
    });

    

    /*--------------------------------------
        chart-user-6
    --------------------------------------*/

    const   ctx_user_6 = document.getElementById('chart-user-6');
    const   gradient_user_6 = ctx_user_6.getContext('2d').createLinearGradient(0, 0, 0, 270);
            gradient_user_6.addColorStop(1, 'rgb(85, 216, 254)');
            gradient_user_6.addColorStop(0, 'rgb(85, 216, 254, .5)');

    const chart_user_6 = new Chart(ctx_user_6, {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr', 'May', 'Jun'],
            datasets: [{
                maxBarThickness: 6,
        //      label: '# of Votes',
                data: [12, 19, 33, 25, 12, 23],
                borderWidth: 0,
                backgroundColor: gradient_user_6,
            }]
        },
        options: {
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
                    }
                },
                x:{
                    display: false,
                    grid: {
                        display: false
                    }
                }
            }
        },
    });
