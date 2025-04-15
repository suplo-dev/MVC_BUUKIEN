"use strict";

/*
// Table of content
// - Search AJAX settings
// - Search debounce
// - Search simulate no results
// - Datatables
// - Analytics chart
// - Widget chart (.saw-chart)
// - Widget circle chart (.saw-chart-circle)
// - Feather
// - Range filter
*/

(function($, window){
    /*
    // Search AJAX settings
    */
    window.stroyka.search.getAjaxSettings = function(query) {
        return {
            url: 'ajax/suggestions.html?query=' + encodeURIComponent(query),
        };
    };

    /*
    // Search debounce
    */
    window.stroyka.search.requestMiddleware.add(function(next, query, abortController) {
        return new Promise(function(resolve) {
            const timer = setTimeout(function() {
                resolve(next(query, abortController));
            }, 500);

            abortController.add(function() {
                clearTimeout(timer);
            });
        });
    });

    /*
    // Search simulate no results
    */
    window.stroyka.search.requestMiddleware.add(function(next, query, abortController) {
        if (query.length >= 6) {
            return Promise.resolve('');
        } else {
            return Promise.resolve(next(query, abortController));
        }
    });

    /*
    // Datatables
    */
    (function() {
        $.fn.DataTable.ext.pager.numbers_length = 5;
        $.fn.DataTable.defaults.oLanguage.sInfo = 'Dòng _START_ đến _END_ của _TOTAL_';
        $.fn.DataTable.defaults.oLanguage.sLengthMenu = 'Số dòng trên trang _MENU_';

        const template = '' +
            '<"sa-datatables"' +
                '<"sa-datatables__table"t>' +
                '<"sa-datatables__footer"' +
                    '<"sa-datatables__pagination"p>' +
                    '<"sa-datatables__controls"' +
                        '<"sa-datatables__legend"i>' +
                        '<"sa-datatables__divider">' +
                        '<"sa-datatables__page-size"l>' +
                    '>' +
                '>' +
            '>';

        $('.sa-datatables-init').each(function() {
            const tableSearchSelector = $(this).data('sa-search-input');
            const table = $(this).DataTable({
                dom: template,
                paging: true,
                ordering: true,
                drawCallback: function() {
                    $(this.api().table().container()).find('.pagination').addClass('pagination-sm');
                },
            });

            if (tableSearchSelector) {
                $(tableSearchSelector).on('input', function() {
                    table.search(this.value).draw();
                });
            }
        });
    })();

    /*
    // Analytics chart
    */
    (function() {
        const chartCanvas = document.getElementById('example-chart-js-analytics');

        if (!chartCanvas) {
            return;
        }

        new Chart(chartCanvas.getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [
                    {
                        backgroundColor: window.stroyka.colors.getThemeColor(),
                        borderColor: 'transparent',
                        borderWidth: 0,
                        fill: 'origin',
                        data: [
                            (10 / 240) * 1200,
                            (26 / 240) * 1200,
                            (105 / 240) * 1200,
                            (57 / 240) * 1200,
                            (94 / 240) * 1200,
                            (26 / 240) * 1200,
                            (57 / 240) * 1200,
                            (48 / 240) * 1200,
                            (142 / 240) * 1200,
                            (94 / 240) * 1200,
                            (128 / 240) * 1200,
                            (222 / 240) * 1200,
                        ],
                    },
                ],
            },
            options: {
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        display: false,
                    },
                },

                scales: {
                    y: {
                        ticks: {
                            fontFamily: 'Roboto',
                            fontSize: 13,
                            fontColor: '#828f99',
                            // Include a dollar sign in the ticks
                            callback: function (value) {
                                return '$' + value;
                            },
                        },
                        gridLines: {
                            lineWidth: 1,
                            color: 'rgba(0, 0, 0, 0.1)',
                            zeroLineWidth: 1,
                            zeroLineColor: 'rgba(0, 0, 0, 0.1)',
                            drawBorder: false,
                        },
                    },
                    x: {
                        ticks: {
                            fontFamily: 'Roboto',
                            fontSize: 13,
                            fontColor: '#828f99',
                        },
                        gridLines: {
                            display: false,
                        },
                    },
                },
            },
        });
    }());

    /*
    // Stacked Bar
    */
    (function() {
        const chartCanvas = document.getElementById('stacked-bar');
    
        if (!chartCanvas || !(chartCanvas instanceof HTMLCanvasElement)) {
            return;
        }
    
        // Lấy dữ liệu từ div
        const dataDiv = document.getElementById('data');
        const typeChart = dataDiv.getAttribute('type-chart');
        const arrayUnit = JSON.parse(dataDiv.getAttribute('array-unit'));
        const data = JSON.parse(dataDiv.getAttribute('data'));
    
        const datasets = data.map(item => ({
            label: item[0],
            backgroundColor: item[1],
            borderColor: 'transparent',
            borderWidth: 0,
            fill: 'origin',
            data: item[2],
        }));
    
        const myChart = new Chart(chartCanvas.getContext('2d'), {
            type: typeChart,
            data: {
                labels: arrayUnit,
                datasets: datasets,
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // Cho phép chiều cao thay đổi
                plugins: {
                    legend: {
                        display: true,
                    },
                },
                scales: {
                    y: {
                        stacked: true,
                        ticks: {
                            fontFamily: 'Roboto',
                            fontSize: 13,
                            fontColor: '#828f99',
                            callback: function(value) {
                                return value + ' đơn';
                            },
                        },
                        grid: {
                            drawBorder: false,
                            color: 'rgba(0, 0, 0, 0.1)',
                        },
                    },
                    x: {
                        stacked: true,
                        ticks: {
                            fontFamily: 'Roboto',
                            fontSize: 13,
                            fontColor: '#828f99',
                        },
                        grid: {
                            display: false,
                        },
                    },
                },
            },
        });
    }());

    /*
    // Widget circle chart (.saw-chart-circle)
    */
    $('.saw-chart-circle[data-sa-data]').each(function() {
        const data = $(this).data('sa-data');
        const labels = data.map(function(item) { return item.label; });
        const values = data.map(function(item) { return item.value; });
        const colors = data.map(function(item) { return item.color; });
        const canvas = $(this).find('canvas')[0];

        new Chart(canvas, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [
                    {
                        borderColor: '#fff',
                        hoverBorderColor: '#fff',
                        borderWidth: 2,
                        fill: 'origin',
                        data: values,
                        backgroundColor: colors,
                        hoverBackgroundColor: colors,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        display: false,
                    },
                },
            },
        });
    });

    /*
    // Feather
    */
    feather.replace({
        width: '1em',
        height: '1em',
    });

    /*
    // Range filter
    */
    $('.sa-filter-range').each(function() {
        const min = $(this).data('min');
        const max = $(this).data('max');
        const from = $(this).data('from');
        const to = $(this).data('to');
        const slider = this.querySelector('.sa-filter-range__slider');

        stroyka.nouislider.create(slider, {
            start: [from, to],
            connect: true,
            range: {
                'min': min,
                'max': max
            },
            tooltips: true,
            pips: {
                mode: 'count',
                values: 5,
                density: 3,
                stepped: true,
            }
        });

        const inputs = [
            $(this).find('.sa-filter-range__input-from')[0],
            $(this).find('.sa-filter-range__input-to')[0]
        ];

        slider.noUiSlider.on('update', function (values, handle) {
            inputs[handle].value = values[handle];
        });
    });
}(jQuery, window));

// Sự kiện khi trang đã tải xong
window.onload = function() {
    document.getElementById('spinner').style.visibility = 'hidden'; // Ẩn spinner
};