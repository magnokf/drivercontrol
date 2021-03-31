<?php $v->layout("_theme"); ?>
    <div class="app_main_box">
        <section class="app_main_left">
            <article class="app_widget">
                <header class="app_widget_title">
                    <h2 class="icon-bar-chart">Controle de Manutenções</h2>
                </header>
                <div id="control"></div>
            </article>


        </section>

        <section class="app_main_right">
            <ul class="app_widget_shortcuts">

                <li class="expense radius transition" data-modalopen=".app_modal_service">
                    <p class="icon-plus-circle">Serviços e Reparos</p>
                </li>
            </ul>




        </section>
    </div>

<?php $v->start("scripts"); ?>
    <script type="text/javascript">
        $(function () {
            Highcharts.setOptions({
                lang: {
                    decimalPoint: ',',
                    thousandsSep: '.'
                }
            });

            var chart = Highcharts.chart('control', {
                chart: {
                    type: 'areaspline',
                    spacingBottom: 0,
                    spacingTop: 5,
                    spacingLeft: 0,
                    spacingRight: 0,
                    height: (9 / 16 * 100) + '%'
                },
                title: null,
                xAxis: {
                    categories: [<?= $chart->categories;?>],
                    minTickInterval: 1
                },
                yAxis: {
                    allowDecimals: true,
                    title: null,
                },
                tooltip: {
                    shared: true,
                    valueDecimals: 2,
                    valuePrefix: 'R$ '
                },
                credits: {
                    enabled: false
                },
                plotOptions: {
                    areaspline: {
                        fillOpacity: 0.5
                    }
                },
                series: [{
                    name: 'Receitas',
                    data: [<?= $chart->income;?>],
                    color: '#61DDBC',
                    lineColor: '#36BA9B'
                }, {
                    name: 'Despesas',
                    data: [<?= $chart->expense;?>],
                    color: '#F76C82',
                    lineColor: '#D94352'
                }]
            });

            $("[data-onpaid]").click(function (e) {
                setTimeout(function () {
                    $.post('<?= url("/app/dash");?>', function (callback) {
                        if (callback.chart) {
                            chart.update({
                                xAxis: {
                                    categories: callback.chart.categories
                                },
                                series: [{
                                    data: callback.chart.income
                                }, {
                                    data: callback.chart.expense
                                }]
                            });
                        }

                        if (callback.wallet) {
                            $(".app_wallet").removeClass("gradient-red gradient-green").addClass(callback.wallet.status);
                            $(".app_flex_amount").text("R$ " + callback.wallet.wallet);
                            $(".app_flex_balance .income").text("R$ " + callback.wallet.income);
                            $(".app_flex_balance .expense").text("R$ " + callback.wallet.expense);
                        }
                    }, "json");
                }, 200);
            });
        });
    </script>
<?php $v->end(); ?>