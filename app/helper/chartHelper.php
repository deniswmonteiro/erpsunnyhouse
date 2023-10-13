<?php

use App\Models\Contract;
use App\Http\Controllers\ContractController;
use App\Models\SellerTeam;
use \Illuminate\Support\Facades\DB;

function UniqueRandomNumbersWithinRange($min, $max, $quantity)
{
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}

function getMaterialDesignColors()
{
    $materialDesignColors = [
        '#006fb3', '#ff8c00', '#ffea44', '#7C4DFF', '#AB47BC', '#DCE775', '#4DD0E1', '#009688', '#43A047', '#F50057', '#FFEA00', '#FBC02D', '#FF6F00', '#FFAB00', '#E0F7FA', '#FFF176', '#4CAF50', '#40C4FF', '#FF9E80', '#B9F6CA', '#CFD8DC', '#DD2C00', '#FF5722', '#FFC400', '#FFFFFF', '#FF6D00', '#0277BD', '#1A237E', '#880E4F', '#8C9EFF', '#B2FF59', '#004D40', '#FF8A65', '#FF7043', '#EEFF41', '#64B5F6', '#5C6BC0', '#03A9F4', '#FFCDD2', '#EC407A', '#FF9100', '#C62828', '#CDDC39', '#A1887F', '#757575', '#8BC34A', '#546E7A', '#64FFDA', '#4E342E', '#FFF9C4', '#D84315', '#FB8C00', '#D7CCC8', '#D50000', '#6A1B9A', '#B39DDB', '#424242', '#F44336', '#FFEB3B', '#29B6F6', '#E3F2FD', '#B2DFDB', '#607D8B', '#00BCD4', '#FFCA28', '#4527A0', '#00ACC1', '#FFA000', '#90CAF9', '#7986CB', '#7E57C2', '#0091EA', '#3F51B5', '#FFFF8D', '#FF1744', '#CCFF90', '#FFFF00', '#E91E63', '#01579B', '#F06292', '#512DA8', '#0288D1', '#2196F3', '#90A4AE', '#6D4C41', '#FFF59D', '#689F38', '#FFC107', '#039BE5', '#E65100', '#FFA726', '#BF360C', '#212121', '#3949AB', '#9E9E9E', '#4FC3F7', '#66BB6A', '#00897B', '#E0F2F1', '#42A5F5', '#E1F5FE', '#F4511E', '#FFCCBC', '#AEEA00', '#FFE57F', '#82B1FF', '#795548', '#00C853', '#827717', '#FFEE58', '#DCEDC8', '#E57373', '#FFE082', '#F48FB1', '#8BC34A', '#ECEFF1', '#D32F2F', '#FFD740', '#FBE9E7', '#E1BEE7', '#00BCD4', '#FFECB3', '#9575CD', '#1E88E5', '#FFEBEE', '#2962FF', '#AA00FF', '#A7FFEB', '#B71C1C', '#5D4037', '#283593', '#D81B60', '#26A69A', '#6200EA', '#558B2F', '#9E9E9E', '#1B5E20', '#8D6E63', '#C5E1A5', '#EDE7F6', '#4CAF50', '#616161', '#00E676', '#F9A825', '#FF5722', '#03A9F4', '#FF9800', '#B388FF', '#E8EAF6', '#1976D2', '#F3E5F5', '#FF9800', '#B3E5FC', '#A5D6A7', '#F5F5F5', '#FFAB91', '#FCE4EC', '#FFC107', '#0D47A1', '#FF5252', '#795548', '#00796B', '#2E7D32', '#FFD54F', '#F0F4C3', '#FDD835', '#BDBDBD', '#FAFAFA', '#CDDC39', '#C5CAE9', '#F1F8E9', '#E91E63', '#0097A7', '#7B1FA2', '#FF3D00', '#FFD600', '#2196F3', '#FFB74D', '#E0E0E0', '#C8E6C9', '#303F9F', '#AD1457', '#FFF3E0', '#D1C4E9', '#D4E157', '#FFE0B2', '#F4FF81', '#69F0AE', '#FFEB3B', '#33691E', '#448AFF', '#388E3C', '#FF8F00', '#000000', '#C2185B', '#E53935', '#00695C', '#9CCC65', '#80CBC4', '#8E24AA', '#F8BBD0', '#BBDEFB', '#80D8FF', '#64DD17', '#FFF8E1', '#FFCC80', '#FFFDE7', '#3F51B5', '#C51162', '#673AB7', '#E8F5E9', '#FFAB40', '#E6EE9C', '#EEEEEE', '#80DEEA', '#006064', '#00E5FF', '#BA68C8', '#AED581', '#FFB300', '#FF4081', '#F9FBE7', '#9FA8DA', '#9E9D24', '#9C27B0', '#FF80AB', '#4A148C', '#00B0FF', '#311B92', '#F44336', '#2979FF', '#9C27B0', '#C6FF00', '#F57F17', '#18FFFF', '#F57C00', '#263238', '#E040FB', '#CE93D8', '#009688', '#00BFA5', '#E64A19', '#76FF03', '#FF6E40', '#455A64', '#651FFF', '#3D5AFE', '#37474F', '#26C6DA', '#B2EBF2', '#7CB342', '#607D8B', '#78909C', '#B0BEC5', '#EFEBE9', '#304FFE', '#1565C0', '#AFB42B', '#FF8A80', '#673AB7', '#EF6C00', '#EA80FC', '#1DE9B6', '#EF9A9A', '#5E35B1', '#81C784', '#536DFE', '#D500F9', '#FFD180', '#84FFFF', '#BCAAA4', '#EF5350', '#C0CA33', '#4DB6AC', '#81D4FA', '#00838F', '#00B8D4', '#3E2723'
    ];

    return $materialDesignColors;
}

function plotBar($id, $data)
{
    $chart = $data['chart'];
    $categories = $data['categories'];
    $title = $data['title'];
    $subtitle = $data['subtitle'];
    $yAxis = $data['yAxis'];
    $initPointFormat = $data['InitPointFormat'];
    $endPointFormat = $data['EndPointFormat'];

    $chart = json_encode($chart);
    $categories = json_encode($categories);
    $materialDesignColors = getMaterialDesignColors();
    $materialDesignColors = json_encode($materialDesignColors);

    echo "
        <script>
            var CSS_COLOR_NAMES = $materialDesignColors;
            Highcharts.setOptions({
                lang: {
                    months: [
                        'Janeiro',
                        'Fevereiro',
                        'Março',
                        'Abril',
                        'Maio',
                        'Junho',
                        'Julho',
                        'Agosto',
                        'Setembro',
                        'Outubro',
                        'Novembro',
                        'Dezembro'
                    ],
                    shortMonths: [
                        'Jan',
                        'Fev',
                        'Mar',
                        'Abr',
                        'Mai',
                        'Jun',
                        'Jul',
                        'Ago',
                        'Set',
                        'Out',
                        'Nov',
                        'Dez'
                    ],
                    decimalPoint: ',',
                    thousandsSep: '.'
                }
            });
            Highcharts.chart('$id', {
                colors: CSS_COLOR_NAMES,
                chart: {
                    type: 'bar'
                },
                xAxis: {
                    categories: $categories,
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: '$yAxis'
                    }
                },
                title: {
                    text: ''
                },
                subtitle: {
                    text: ''
                },
                legend: {
                    enabled: false
                },
                tooltip: {
                    headerFormat: '<span style=\"font-size:10px\">{point.key}</span><table style=\"width:150px\">',
                    pointFormat: '<tr><td style=\"font-size:14px\"><b> $initPointFormat {point.y} $endPointFormat</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: $chart,
                exporting: {
                    enabled: false
                },
                labels: {
                    enabled: false,
                },
                credits: {
                    enabled: false
                }
            });
        </script>
    ";
}

function plotColumn($id, $data)
{
    $category = $data['category'];
    $chart = $data['chart'];
    $category = json_encode($category);
    $chart = json_encode($chart);

    echo "
        <script>
            Highcharts.setOptions({
                lang: {
                    months: [
                        'Janeiro',
                        'Fevereiro',
                        'Março',
                        'Abril',
                        'Maio',
                        'Junho',
                        'Julho',
                        'Agosto',
                        'Setembro',
                        'Outubro',
                        'Novembro',
                        'Dezembro'
                    ],
                    shortMonths: [
                        'Jan',
                        'Fev',
                        'Mar',
                        'Abr',
                        'Mai',
                        'Jun',
                        'Jul',
                        'Ago',
                        'Set',
                        'Out',
                        'Nov',
                        'Dez'
                    ],
                    decimalPoint: ',',
                    thousandsSep: '.'
                }
            });
            Highcharts.chart('$id', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: ''
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    categories: $category,
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: ''
                    }
                },
                tooltip: {
                    headerFormat: '<span style=\"font-size:10px\">{point.key}</span><table>',
                    pointFormat: '<tr><td style=\"color:{series.color};padding:2px 0;font-size:14px\">{series.name}: </td>' + '<td style=\"padding:2px 0;font-size:14px;text-align:right\"><b>{point.y:.0f}</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: $chart,
                exporting: {
                    enabled: false
                },
                labels: {
                    enabled: false,
                },
                credits: {
                    enabled: false
                }
            });
        </script>
    ";
}

function plotLine($id, $data)
{
    $category = $data['category'];
    $chart = $data['chart'];
    $category = json_encode($category);
    $chart = json_encode($chart);

    echo "
        <script>
            Highcharts.setOptions({
                lang: {
                    months: [
                        'Janeiro',
                        'Fevereiro',
                        'Março',
                        'Abril',
                        'Maio',
                        'Junho',
                        'Julho',
                        'Agosto',
                        'Setembro',
                        'Outubro',
                        'Novembro',
                        'Dezembro'
                    ],
                    shortMonths: [
                        'Jan',
                        'Fev',
                        'Mar',
                        'Abr',
                        'Mai',
                        'Jun',
                        'Jul',
                        'Ago',
                        'Set',
                        'Out',
                        'Nov',
                        'Dez'
                    ],
                    decimalPoint: ',',
                    thousandsSep: '.'
                }
            });
            Highcharts.chart('$id', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: ''
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    categories: $category,
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: ''
                    }
                },
                tooltip: {
                    headerFormat: '<span style=\"font-size: 10px\">{point.key}</span><table>',
                    pointFormat: '<tr><td style=\"color:{series.color};padding:2px 5px;font-size:12px\">{series.name}: </td>' + '<td style=\"padding:2px 0;font-size:12px;text-align:right\"><b>{point.y:.0f}</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: $chart,
                exporting: {
                    enabled: false
                },
                labels: {
                    enabled: false,
                },
                credits: {
                    enabled: false
                }
            });
        </script>
    ";
}

function plotDonut($id, $data, $color)
{
    $rand = rand(1, 9999999999);
    $date = $data['name'];
    $value = $data['value'];

    echo "
        <script>
            Highcharts.setOptions({
                lang: {
                    months: [
                        'Janeiro',
                        'Fevereiro',
                        'Março',
                        'Abril',
                        'Maio',
                        'Junho',
                        'Julho',
                        'Agosto',
                        'Setembro',
                        'Outubro',
                        'Novembro',
                        'Dezembro'
                    ],
                    shortMonths: [
                        'Jan',
                        'Fev',
                        'Mar',
                        'Abr',
                        'Mai',
                        'Jun',
                        'Jul',
                        'Ago',
                        'Set',
                        'Out',
                        'Nov',
                        'Dez'
                    ],
                    decimalPoint: ',',
                    thousandsSep: '.'
                }
            });
            function convertHex(hexCode,opacity){
                var hex = hexCode.replace('#','');

                if (hex.length === 3) {
                    hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
                }

                var r = parseInt(hex.substring(0,2), 16),
                    g = parseInt(hex.substring(2,4), 16),
                    b = parseInt(hex.substring(4,6), 16);

                return 'rgba('+r+','+g+','+b+','+opacity/100+')';
            }
        Highcharts.chart('$id', {
            chart: {
                type: 'solidgauge',
                events: {
                    load: alignLabel,
                    redraw: alignLabel
                },
                spacingTop: 5,
                spacingRight: 2,
                spacingBottom: 10,
                spacingLeft: 2,
                plotBorderWidth: 0,
                marginRight: 2,//-60, //this does move the chart but you'll need to recompute it
                marginLeft: 2,//-60,  //whenever the page changes width
                marginTop: 5,
                marginBottom: 20
            },
            title: {
                text: ''
            },
            pane: {
                center: ['50%', '50%'],
                size: '100%',
                startAngle: 0,
                endAngle: 360,
                background: {
                    backgroundColor: convertHex('$color', 40),
                    innerRadius: '60%',
                    outerRadius: '100%'
                }
            },
            tooltip: {
                enabled: false
            },
            yAxis: {
                stops: [
                    [1, '$color']
                ],
                lineWidth: 0,
                minorTickInterval: null,
                tickAmount: 1,
                title: {
                    text: ''
                },
                labels: {
                    enabled: false,
                },
                min: 0,
                max: 100
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                solidgauge: {
                    dataLabels: {
                        enabled: false
                    }
                }
            },
            series: [{
                name: 'Value',
                innerSize: '50%',
                data: [$value]
            }],
            exporting: {
                enabled: false
            }
        });
        var grossLabel_$rand;
        var grossLabel_name_$rand;

        function alignLabel() {
            var chart = this;

            if (grossLabel_$rand) {
                grossLabel_$rand.destroy();
            }

            if (grossLabel_name_$rand) {
                grossLabel_name_$rand.destroy();
            }

            var newX = chart.plotWidth / 2 + chart.plotLeft,
            newY = chart.plotHeight / 2 + chart.plotTop;

            grossLabel_$rand = chart.renderer.text('$value%', newX, newY)
                .attr({
                    align: 'center'
                })
                .css({
                    color: '#000',
                    fontSize: '8pt'
                }).add();

            grossLabel_name_$rand = chart.renderer.text('$date', newX, newY*2.3)
                .attr({
                    align: 'center'
                })
                .css({
                    color: '#000',
                    fontSize: '8pt'
                })
                .add();
            }
        </script>
    ";
}

function plotDonut2($id, $data)
{
    $graph = [];

    foreach ($data as $d) {
        $g = [
            'name' => $d['name'],
            'y' => $d['value'],
            'color' => $d['color'],
            'dataLabels' => [
                'enabled' => false
            ]
        ];
        array_push($graph, $g);
    }

    $graph = json_encode($graph);
    $start = date('d/m/Y', strtotime(date('Y-m-d') . '-12 month'));
    $today = date('d/m/Y', strtotime(date('Y-m-d')));
    $datestart = DateTime::createFromFormat('d/m/Y', $start)->getTimestamp();
    $dateend = DateTime::createFromFormat('d/m/Y', $today)->getTimestamp();

    $timestamp = rand($datestart, $dateend);
    $date = (new DateTime())->setTimestamp($timestamp);
    $date = strtoupper(strftime('%b/%Y', $date->getTimestamp()));

    echo "
        <script>
            Highcharts.setOptions({
                lang: {
                    months: [
                        'Janeiro',
                        'Fevereiro',
                        'Março',
                        'Abril',
                        'Maio',
                        'Junho',
                        'Julho',
                        'Agosto',
                        'Setembro',
                        'Outubro',
                        'Novembro',
                        'Dezembro'
                    ],
                    shortMonths: [
                        'Jan',
                        'Fev',
                        'Mar',
                        'Abr',
                        'Mai',
                        'Jun',
                        'Jul',
                        'Ago',
                        'Set',
                        'Out',
                        'Nov',
                        'Dez'
                    ],
                    decimalPoint: ',',
                    thousandsSep: '.'
                }
            });
            Highcharts.chart('$id', {
                chart: {
                    plotBackgroundColor: null,
                    plotShadow: false,
                    spacingTop: 0,
                    spacingRight: 0,
                    spacingBottom: 0,
                    spacingLeft: 0,
                    plotBorderWidth: 0,
                    marginRight: 0,
                    marginLeft: 0,
                    marginTop: 0,
                    marginBottom: 0
                },
                title: {
                    text: ''
                },
                plotOptions: {
                    pie: {
                        startAngle: 0,
                        endAngle: 360,
                        center: ['50%', '50%'],
                        size: '100%',
                    }
                },
                series: [{
                    type: 'pie',
                    states: {
                        hover: {
                            enabled: false
                        },
                        inactive: {
                            opacity: 1
                        }
                    },
                    name: 'Potência Vendida',
                    innerSize: '60%',
                    data: $graph
                }],
                exporting: {
                    enabled: false
                },
                labels: {
                        enabled: false,
                },
                credits: {
                    enabled: false
                },
                tooltip: {
                    enabled: false
                }
            });
        </script>
    ";
}

function getChartContractAmount($start_date, $end_date, $sellers, $type)
{
    $contracts_all = [];
    
    foreach ($sellers as $seller) {
        $contracts_installing = $seller->allContracts($start_date, $end_date, ContractController::$STATUS_INSTALLING);
        $contracts_installed = $seller->allContracts($start_date, $end_date, ContractController::$STATUS_INSTALLED);
        $contracts_concluded = $seller->allContracts($start_date, $end_date, ContractController::$STATUS_CONCLUDED);
        
        foreach ($contracts_installing as $contract) {
            if ($type) {
                if ($contract->type === 1) array_push($contracts_all, $contract);
            }
            
            else array_push($contracts_all, $contract);
        }

        foreach ($contracts_installed as $contract) {
            if ($type) {
                if ($contract->type === 1) array_push($contracts_all, $contract);
            }
            
            else array_push($contracts_all, $contract);
        }

        foreach ($contracts_concluded as $contract) {
            if ($type) {
                if ($contract->type === 1) array_push($contracts_all, $contract);
            }
            
            else array_push($contracts_all, $contract);
        }
    }

    $contracts_by_date = array();

    foreach ($contracts_all as $contract) {
        $mesAno = explode('-', $contract->contract_date);
        $contracts_by_date[$mesAno[1] . '/' . $mesAno[0]][] = $contract;
    }

    $amount_list = array();

    foreach ($contracts_by_date as $date => $contract_list) {
        $value = 0;

        foreach ($contract_list as $cl) {
            $value += $cl->paymentData()->value;
        }

        $amount_list[$date] = $value;
    }

    $format = 'Y-m-d H:i:s';
    $start_date = $start_date . ' 00:00:00';
    $end_date = $end_date . ' 23:59:59';
    $date1 = \DateTime::createFromFormat($format, $start_date);
    $date2 = \DateTime::createFromFormat($format, $end_date);
    $dates = array();

    while ($date1 <= $date2) {
        $dates[] = $date1->format('m/Y');
        $date1->modify('+1 month');
    }

    $amount_final = [];
    $dates_array = [];

    foreach ($dates as $key => $d) {
        $date = str_replace('/', '-', '01/' . $d);
        $date = date('Y-m-d', strtotime($date));
        $date = strtoupper(strftime('%b/%Y', (new \DateTime($date))->getTimestamp()));

        array_push($dates_array, $date);
        
        if (!isset($amount_list[$d])) array_push($amount_final, 0);
        else array_push($amount_final, $amount_list[$d]);
    }

    $data = [
        'data' => $amount_final,
        'name' => 'valor',
        'title' => 'Receita Mensal'
    ];

    $chart = [
        'chart' => [$data],
        'categories' => $dates_array,
        'name' => 'Valor',
        'title' => 'Receita Mensal',
        'subtitle' => 'Últimos 12 Meses',
        'yAxis' => 'Em Reais (R$)',
        'InitPointFormat' => 'R$',
        'EndPointFormat' => ''
    ];

    return $chart;
}

function getChartContractConversion($start_date, $end_date, $sellers, $type)
{
    $start_date = $start_date . ' 00:00:00';
    $end_date = $end_date . ' 23:59:59';
    $start = (new \DateTime($start_date))->modify('first day of this month');
    $end = (new \DateTime($end_date))->modify('first day of next month');
    $interval = DateInterval::createFromDateString('1 month');
    $period = new DatePeriod($start, $interval, $end);
    $chart = array();

    foreach ($period as $date) {
        $init = $date->format('Y-m-d');
        $end = $date->format('Y-m-t');
        $contracts_status_id = [];
        $contracts_all_id = [];

        foreach ($sellers as $seller) {
            $contracts_installing = $seller->allContracts($init, $end, ContractController::$STATUS_INSTALLING);
            $contracts_installed = $seller->allContracts($init, $end, ContractController::$STATUS_INSTALLED);
            $contracts_concluded = $seller->allContracts($init, $end, ContractController::$STATUS_CONCLUDED);
            $contracts = $seller->allContracts($init, $end);

            // Vendidos
            foreach ($contracts_installing as $contract) {
                if ($type) {
                    if ($contract->type == 1) array_push($contracts_status_id, $contract->id);
                }
                
                else array_push($contracts_status_id, $contract->id);
            }

            foreach ($contracts_installed as $contract) {
                if ($type) {
                    if ($contract->type == 1) array_push($contracts_status_id, $contract->id);
                }
                
                else array_push($contracts_status_id, $contract->id);
            }

            foreach ($contracts_concluded as $contract) {
                if ($type) {
                    if ($contract->type == 1) array_push($contracts_status_id, $contract->id);
                }
                
                else array_push($contracts_status_id, $contract->id);
            }

            // Orçados
            foreach ($contracts as $contract) {
                if ($type) {
                    if ($contract->type == 1) array_push($contracts_all_id, $contract->id);
                }
                
                else array_push($contracts_all_id, $contract->id);
            }
        }

        $date = strtoupper(strftime('%b/%Y', $date->getTimestamp()));
        $data = [
            'name' => $date,
            'value' => count($contracts_all_id) == 0 ?
                0 :
                round(((count($contracts_status_id) / count($contracts_all_id)) * 100), 2)
        ];

        array_push($chart, $data);
    }

    return $chart;
}

function getChartContractOfferSale($start_date, $end_date, $sellers, $type)
{
    $start_date = $start_date . ' 00:00:00';
    $end_date = $end_date . ' 23:59:59';
    $start = (new \DateTime($start_date))->modify('first day of this month');
    $end = (new \DateTime($end_date))->modify('last day of this month');
    $interval = DateInterval::createFromDateString('1 month');
    $period = new DatePeriod($start, $interval, $end);
    $result = array();

    foreach ($period as $date) {
        $init = $date->format('Y-m-d') . ' 00:00:00';
        $end = $date->format('Y-m-t') . ' 23:59:59';
        $contracts_offer = [];
        $contracts_seller = [];

        foreach ($sellers as $seller) {
            $contracts_budget = $seller->allContracts($init, $end, ContractController::$STATUS_BUDGET);
            $contracts_hired = $seller->allContracts($init, $end, ContractController::$STATUS_HIRED);
            $contracts_active = $seller->allContracts($init, $end, ContractController::$STATUS_ACTIVE);
            $contracts_pendency = $seller->allContracts($init, $end, ContractController::$STATUS_PENDENCY);
            $contracts_installing = $seller->allContracts($init, $end, ContractController::$STATUS_INSTALLING);
            $contracts_installed = $seller->allContracts($init, $end, ContractController::$STATUS_INSTALLED);
            $contracts_concluded = $seller->allContracts($init, $end, ContractController::$STATUS_CONCLUDED);
            $contracts_canceled = $seller->allContracts($init, $end, ContractController::$STATUS_CANCELED);
            
            // Orçamentos
            foreach ($contracts_budget as $contract) {
                if ($type) {
                    if ($contract->type === 1) array_push($contracts_offer, $contract);
                }
                
                else array_push($contracts_offer, $contract);
            }

            foreach ($contracts_hired as $contract) {
                if ($type) {
                    if ($contract->type === 1) array_push($contracts_offer, $contract);
                }
                
                else array_push($contracts_offer, $contract);
            }

            foreach ($contracts_active as $contract) {
                if ($type) {
                    if ($contract->type === 1) array_push($contracts_offer, $contract);
                }
                
                else array_push($contracts_offer, $contract);
            }

            foreach ($contracts_pendency as $contract) {
                if ($type) {
                    if ($contract->type === 1) array_push($contracts_offer, $contract);
                }
                
                else array_push($contracts_offer, $contract);
            }

            foreach ($contracts_canceled as $contract) {
                if ($type) {
                    if ($contract->type === 1) array_push($contracts_offer, $contract);
                }
                
                else array_push($contracts_offer, $contract);
            }

            // Vendas
            foreach ($contracts_installing as $contract) {
                if ($type) {
                    if ($contract->type === 1) array_push($contracts_seller, $contract);
                }
                
                else array_push($contracts_seller, $contract);
            }

            foreach ($contracts_installed as $contract) {
                if ($type) {
                    if ($contract->type === 1) array_push($contracts_seller, $contract);
                }
                
                else array_push($contracts_seller, $contract);
            }

            foreach ($contracts_concluded as $contract) {
                if ($type) {
                    if ($contract->type == 1) array_push($contracts_seller, $contract);
                }
                
                else array_push($contracts_seller, $contract);
            }
        }

        $date = strtoupper(strftime('%b/%Y', $date->getTimestamp()));

        $data = [
            'name' => $date,
            'sale' => count($contracts_seller),
            'offer' => count($contracts_offer),
        ];
        
        array_push($result, $data);
    }

    $category = [];
    $sale = [];
    $offer = [];

    foreach ($result as $res) {
        array_push($category, $res['name']);
        array_push($sale, $res['sale']);
        array_push($offer, $res['offer']);
    }

    $offer = [
        'name' => 'Orçamentos',
        'color' => '#006fb3',
        'data' => $offer
    ];
    $sale = [
        'name' => 'Vendas',
        "color" => '#ff8c00',
        "data" => $sale
    ];
    $chart = [
        'category' => $category,
        'chart' => [$offer, $sale]
    ];

    return $chart;
}

function getChartContractByStatus($start_date, $end_date, $sellers, $type)
{
    $old_date = $start_date . ' 00:00:00';
    $start_date = $start_date . ' 00:00:00';
    $end_date = $end_date . ' 23:59:59';
    $start = (new \DateTime($start_date))->modify('first day of this month');
    $end = (new \DateTime($end_date))->modify('last day of this month');
    $interval = DateInterval::createFromDateString('1 month');

    $sum_budget = 0;
    $sum_hired = 0;
    $sum_active = 0;
    $sum_pendency = 0;
    $sum_installing = 0;
    $sum_installed = 0;
    $sum_concluded = 0;
    $sum_canceled = 0;

    foreach ($sellers as $seller) {
        $contracts_budget = [];
        $contracts_hired = [];
        $contracts_active = [];
        $contracts_pendency = [];
        $contracts_installing = [];
        $contracts_installed = [];
        $contracts_concluded = [];
        $contracts_canceled = [];

        // BUDGET
        $contracts = $seller->allContracts('01/01/2010 00:00:00', $old_date, ContractController::$STATUS_BUDGET);

        foreach ($contracts as $contract) {
            if ($type) {
                if ($contract->type === 1) array_push($contracts_budget, $contract);
            }
            
            else array_push($contracts_budget, $contract);
        }

        // HIRED
        $contracts = $seller->allContracts('01/01/2010 00:00:00', $old_date, ContractController::$STATUS_HIRED);

        foreach ($contracts as $contract) {
            if ($type) {
                if ($contract->type === 1) array_push($contracts_hired, $contract);
            }
            
            else array_push($contracts_hired, $contract);
        }

        // ACTIVE
        $contracts = $seller->allContracts('01/01/2010 00:00:00', $old_date, ContractController::$STATUS_ACTIVE);

        foreach ($contracts as $contract) {
            if ($type) {
                if ($contract->type === 1) array_push($contracts_active, $contract);
            }
            
            else array_push($contracts_active, $contract);
        }

        // PENDENCY
        $contracts = $seller->allContracts('01/01/2010 00:00:00', $old_date, ContractController::$STATUS_PENDENCY);

        foreach ($contracts as $contract) {
            if ($type) {
                if ($contract->type === 1) array_push($contracts_pendency, $contract);
            }
            
            else array_push($contracts_pendency, $contract);
        }

        // INSTALLING
        $contracts = $seller->allContracts('01/01/2010 00:00:00', $old_date, ContractController::$STATUS_INSTALLING);
        
        foreach ($contracts as $contract) {
            if ($type) {
                if ($contract->type === 1) array_push($contracts_installing, $contract);
            }
            
            else array_push($contracts_installing, $contract);
        }

        // INSTALLED
        $contracts = $seller->allContracts('01/01/2010 00:00:00', $old_date, ContractController::$STATUS_INSTALLED);
        
        foreach ($contracts as $contract) {
            if ($type) {
                if ($contract->type === 1) array_push($contracts_installed, $contract);
            }
            
            else array_push($contracts_installed, $contract);
        }

        // CONCLUDED
        $contracts = $seller->allContracts('01/01/2010 00:00:00', $old_date, ContractController::$STATUS_CONCLUDED);
        
        foreach ($contracts as $contract) {
            if ($type) {
                if ($contract->type === 1) array_push($contracts_concluded, $contract);
            }
            
            else array_push($contracts_concluded, $contract);
        }

        // CANCELED
        $contracts = $seller->allContracts('01/01/2010 00:00:00', $old_date, ContractController::$STATUS_CANCELED);
        
        foreach ($contracts as $contract) {
            if ($type) {
                if ($contract->type === 1) array_push($contracts_canceled, $contract);
            }

            else array_push($contracts_canceled, $contract);
        }
        
        $sum_budget += count($contracts_budget);
        $sum_hired += count($contracts_hired);
        $sum_active += count($contracts_active);
        $sum_pendency += count($contracts_pendency);
        $sum_installing += count($contracts_installing);
        $sum_installed += count($contracts_installed);
        $sum_concluded += count($contracts_concluded);
        $sum_canceled += count($contracts_canceled);
    }

    $period = new DatePeriod($start, $interval, $end);
    $result = array();

    foreach ($period as $date) {
        $init = $date->format('Y-m-d') . ' 00:00:00';
        $end = $date->format('Y-m-t') . ' 23:59:59';

        $contracts_budget = [];
        $contracts_hired = [];
        $contracts_active = [];
        $contracts_pendency = [];
        $contracts_installing = [];
        $contracts_installed = [];
        $contracts_concluded = [];
        $contracts_canceled = [];
        
        foreach ($sellers as $seller) {
            // BUDGET
            $contracts = $seller->allContracts($init, $end, ContractController::$STATUS_BUDGET);

            foreach ($contracts as $contract) {
                if ($type) {
                    if ($contract->type === 1) array_push($contracts_budget, $contract);
                }

                else array_push($contracts_budget, $contract);
            }

            // HIRED
            $contracts = $seller->allContracts($init, $end, ContractController::$STATUS_HIRED);

            foreach ($contracts as $contract) {
                if ($type) {
                    if ($contract->type === 1) array_push($contracts_hired, $contract);
                }

                else array_push($contracts_hired, $contract);
            }

            // ACTIVE
            $contracts = $seller->allContracts($init, $end, ContractController::$STATUS_ACTIVE);

            foreach ($contracts as $contract) {
                if ($type) {
                    if ($contract->type === 1) array_push($contracts_active, $contract);
                }

                else array_push($contracts_active, $contract);
            }

            // PENDENCY
            $contracts = $seller->allContracts($init, $end, ContractController::$STATUS_PENDENCY);

            foreach ($contracts as $contract) {
                if ($type) {
                    if ($contract->type === 1) array_push($contracts_pendency, $contract);
                }

                else array_push($contracts_pendency, $contract);
            }

            // INSTALLING
            $contracts = $seller->allContracts($init, $end, ContractController::$STATUS_INSTALLING);

            foreach ($contracts as $contract) {
                if ($type) {
                    if ($contract->type === 1) array_push($contracts_installing, $contract);
                }

                else array_push($contracts_installing, $contract);
            }

            // INSTALLED
            $contracts = $seller->allContracts($init, $end, ContractController::$STATUS_INSTALLED);
            
            foreach ($contracts as $contract) {
                if ($type) {
                    if ($contract->type === 1) array_push($contracts_installed, $contract);
                }

                else array_push($contracts_installed, $contract);
            }

            // CONCLUDED
            $contracts = $seller->allContracts($init, $end, ContractController::$STATUS_CONCLUDED);
            
            foreach ($contracts as $contract) {
                if ($type) {
                    if ($contract->type === 1) array_push($contracts_concluded, $contract);
                }

                else array_push($contracts_concluded, $contract);
            }

            // CANCELED
            $contracts = $seller->allContracts($init, $end, ContractController::$STATUS_CANCELED);
            
            foreach ($contracts as $contract) {
                if ($type) {
                    if ($contract->type === 1) array_push($contracts_canceled, $contract);
                }

                else array_push($contracts_canceled, $contract);
            }
        }

        $date = strtoupper(strftime('%b/%Y', $date->getTimestamp()));

        $sum_budget += count($contracts_budget);
        $sum_hired += count($contracts_hired);
        $sum_active += count($contracts_active);
        $sum_pendency += count($contracts_pendency);
        $sum_installing += count($contracts_installing);
        $sum_installed += count($contracts_installed);
        $sum_concluded += count($contracts_concluded);
        $sum_canceled += count($contracts_canceled);

        $data = [
            'name' => $date,
            'budget' => $sum_budget,
            'hired' => $sum_hired,
            'active' => $sum_active,
            'pendency' => $sum_pendency,
            'installing' => $sum_installing,
            'installed' => $sum_installed,
            'concluded' => $sum_concluded,
            'canceled' => $sum_canceled,
        ];

        array_push($result, $data);
    }

    $category = [];
    $budget = [];
    $hired = [];
    $active = [];
    $pendency = [];
    $installing = [];
    $installed = [];
    $concluded = [];
    $canceled = [];

    foreach ($result as $res) {
        array_push($category, $res['name']);
        array_push($budget, $res['budget']);
        array_push($hired, $res['hired']);
        array_push($active, $res['active']);
        array_push($pendency, $res['pendency']);
        array_push($installing, $res['installing']);
        array_push($installed, $res['installed']);
        array_push($concluded, $res['concluded']);
        array_push($canceled, $res['canceled']);
    }
    
    $budget_chart = [
        'name' => 'ORÇANDO',
        'color' => '#6c757d',
        'data' => $budget
    ];

    $hired_chart = [
        'name' => 'CONTRATADO',
        'color' => '#827717',
        'data' => $hired
    ];

    $active_chart = [
        'name' => 'ATIVO',
        'color' => '#0dcaf0',
        'data' => $active
    ];

    $pendency_chart = [
        'name' => 'PENDÊNCIA',
        'color' => '#dc3545',
        'data' => $pendency
    ];

    $installing_chart = [
        'name' => 'INSTALANDO',
        'color' => '#006fb3',
        'data' => $installing
    ];

    $installed_chart = [
        'name' => 'INSTALADO',
        'color' => '#ffc107',
        'data' => $installed
    ];

    $concluded_chart = [
        'name' => 'CONCLUÍDO',
        'color' => '#198754',
        'data' => $concluded
    ];

    $canceled_chart = [
        'name' => 'CANCELADO',
        'color' => '#212528',
        'data' => $canceled
    ];

    $chart = [
        'category' => $category,
        'chart' => [
            $budget_chart,
            $hired_chart,
            $active_chart,
            $pendency_chart,
            $installing_chart,
            $installed_chart,
            $concluded_chart,
            $canceled_chart
        ]
    ];

    return $chart;
}

function getChartContractStatusAndValue($start_date, $end_date, $sellers, $type)
{
    $old_date = $start_date . ' 00:00:00';
    $start_date = $start_date . ' 00:00:00';
    $end_date = $end_date . ' 23:59:59';
    $start = (new \DateTime($start_date))->modify('first day of this month');
    $end = (new \DateTime($end_date))->modify('last day of this month');
    $interval = DateInterval::createFromDateString('1 month');

    $sum_contracts = 0;
    $sum_value = 0;

    foreach ($sellers as $seller) {
        $contracts_active = [];
        $contracts_conclued = [];

        // ACTIVE
        $contracts = $seller->allContracts('01/01/2010 00:00:00', $old_date, ContractController::$STATUS_CONCLUDED);
        foreach ($contracts as $contract) {
            if ($type) {
                if ($contract->type == 1) {
                    array_push($contracts_active, $contract);

                }
            }
            
            else {
                array_push($contracts_active, $contract);
            }
        }

        // CONCLUDED
        $contracts = $seller->allContracts('01/01/2010 00:00:00', $old_date, ContractController::$STATUS_CONCLUDED);
        foreach ($contracts as $contract) {
            if ($type) {
                if ($contract->type == 1) {
                    array_push($contracts_conclued, $contract);

                }
            }
            
            else {
                array_push($contracts_conclued, $contract);
            }
        }

        $sum_contracts += count($contracts_active);
        $sum_contracts += count($contracts_conclued);

        foreach ($contracts_active as $contract) {
            $sum_value += $contract->getValue();
        }

        foreach ($contracts_conclued as $contract) {
            $sum_value += $contract->getValue();
        }
    }

    $period = new DatePeriod($start, $interval, $end);
    $result = array();

    foreach ($period as $date) {
        $init = $date->format('Y-m-d') . ' 00:00:00';
        $end = $date->format('Y-m-t') . ' 23:59:59';

        $contracts_active = [];
        $contracts_conclued = [];

        foreach ($sellers as $seller) {
            // ACTIVE
            $contracts = $seller->allContracts($init, $end, ContractController::$STATUS_CONCLUDED);

            foreach ($contracts as $contract) {
                if ($type) {
                    if ($contract->type == 1) {
                        array_push($contracts_active, $contract);

                    }
                }
                
                else {
                    array_push($contracts_active, $contract);
                }
            }

            // CONCLUDED
            $contracts = $seller->allContracts($init, $end, ContractController::$STATUS_CONCLUDED);

            foreach ($contracts as $contract) {
                if ($type) {
                    if ($contract->type == 1) {
                        array_push($contracts_conclued, $contract);

                    }
                }
                
                else {
                    array_push($contracts_conclued, $contract);
                }
            }
        }

        $date = strtoupper(strftime('%b/%Y', $date->getTimestamp()));

        $sum_contracts += count($contracts_active);
        $sum_contracts += count($contracts_conclued);

        foreach ($contracts_active as $contract) {
            $sum_value += $contract->getValue();
        }

        foreach ($contracts_conclued as $contract) {
            $sum_value += $contract->getValue();
        }

        $data = [
            'name' => $date,
            'contracts' => $sum_contracts,
            'value' => $sum_value,
        ];

        array_push($result, $data);
    }

    $category = [];
    $active = [];
    $concluded = [];

    foreach ($result as $res) {
        array_push($category, $res['name']);
        array_push($active, $res['contracts']);
        array_push($concluded, $res['value']);
    }

    $active_chart = [
        'name' => 'CONTRATOS ACUMULADOS',
        'color' => '#ff8c00',
        'data' => $active
    ];

    $concluded_chart = [
        'name' => 'VENDAS ACUMULADAS',
        'color' => '#006fb3',
        'data' => $concluded
    ];

    $chart = [
        'category' => $category,
        'chart' => [$active_chart, $concluded_chart]
    ];

    return $chart;
}

function getChartContractGenerationPower($start_date, $end_date, $sellers, $type)
{
    $start = (new \DateTime($start_date))->modify('first day of this month');
    $end_date = date("Y-m-d", strtotime($end_date));
    $end = (new \DateTime($end_date))->modify('first day of next month');
    $interval = DateInterval::createFromDateString('1 month');

    $period = new DatePeriod($start, $interval, $end);
    $chart = array();
    $color_index = 0;

    foreach ($period as $date) {
        $init = $date->format('Y-m-d');
        $end = $date->format('Y-m-t');
        $date = strtoupper(strftime('%b/%Y', $date->getTimestamp()));
        $value = 0;
        
        foreach ($sellers as $seller) {
            $contracts = Contract::where('seller_id', $seller->id)
                ->where('type', 1)
                ->where('status', ContractController::$STATUS_CONCLUDED)
                ->whereBetween('contract_date', [$init, $end])
                ->get();
            
            foreach ($contracts as $contract) {
                if ($type) {
                    if ($contract->type == 1) {
                        $value += $contract->getGeneratorPowerValue();
                    }
                }
                
                else {
                    $value += $contract->getGeneratorPowerValue();
                }
            }
        }

        $data = [
            'name' => $date,
            'value' => round($value, 2),
            'color' => getMaterialDesignColors()[$color_index]
        ];

        $color_index++;
        array_push($chart, $data);
    }

    return $chart;
}

function getChartContractAmountByEquip($team, $start_date, $end_date)
{
    $start_date = explode('/', $start_date);
    $end_date = explode('/', $end_date);

    $start_date = '01/' . $start_date[1] . '/' . $start_date[2];
    $end_date = date("t") . '/' . $end_date[1] . '/' . $end_date[2];

    $start_date = explode('/', $start_date);
    $end_date = explode('/', $end_date);

    $day = 0;
    $month = 1;
    $year = 2;
    $start_date = $start_date[$year] . '-' . $start_date[$month] . '-' . $start_date[$day];
    $end_date = $end_date[$year] . '-' . $end_date[$month] . '-' . $end_date[$day];

    $contracts = Contract::whereBetween('contract_date', [$start_date, $end_date])->get();

    $contracts_by_date = array();

    foreach ($contracts as $contract) {
        if ($team->id == $contract->seller->team->id) {
            $mesAno = explode('-', $contract->contract_date);
            $contracts_by_date[$mesAno[1] . '/' . $mesAno[0]][] = $contract;
        }
    }

    $amount_list = array();

    foreach ($contracts_by_date as $date => $contract_list) {
        $value = 0;

        foreach ($contract_list as $cl) {
            $value += $cl->paymentData()->value;
        }

        $amount_list[$date] = $value;
    }

    $format = 'Y-m-d';

    $date1 = \DateTime::createFromFormat($format, $start_date);
    $date2 = \DateTime::createFromFormat($format, $end_date);
    $dates = array();
    
    while ($date1 <= $date2) {
        $date1->modify('+1 month');
        $dates[] = $date1->format('m/Y');
    }

    $amount_final = [];
    $dates_array = [];

    foreach ($dates as $key => $d) {
        array_push($dates_array, $d);

        if (!isset($amount_list[$d])) {
            array_push($amount_final, 0);
        }
        
        else {
            array_push($amount_final, $amount_list[$d]);
        }
    }

    $chart = [
        'chart' => $amount_final,
        'categories' => $dates_array,
        'name' => $team->name
    ];

    return $chart;
}

function getChartByStatusContract()
{
    $contract_budget = Contract::where('status', ContractController::$STATUS_BUDGET)->get();
    $contract_hired = Contract::where('status', ContractController::$STATUS_HIRED)->get();
    $contract_active = Contract::where('status', ContractController::$STATUS_ACTIVE)->get();
    $contract_pendency = Contract::where('status', ContractController::$STATUS_PENDENCY)->get();
    $contract_installing = Contract::where('status', ContractController::$STATUS_INSTALLING)->get();
    $contract_installed = Contract::where('status', ContractController::$STATUS_INSTALLED)->get();
    $contract_concluded = Contract::where('status', ContractController::$STATUS_CONCLUDED)->get();
    $contract_canceled = Contract::where('status', ContractController::$STATUS_CANCELED)->get();

    return [
        [
            'value' => count($contract_budget),
            'color' => '#6c757d'
        ],
        [
            'value' => count($contract_hired),
            'color' => '#827717'
        ],
        [
            'value' => count($contract_active),
            'color' => '#0dcaf0'
        ],
        [
            'value' => count($contract_pendency),
            'color' => '#dc3545'
        ],
        [
            'value' => count($contract_installing),
            'color' => '#006fb3'
        ],
        [
            'value' => count($contract_installed),
            'color' => '#ffc107'
        ],
        [
            'value' => count($contract_concluded),
            'color' => '#198754'
        ],
        [
            'value' => count($contract_canceled),
            'color' => '#212528'
        ],
    ];
}
