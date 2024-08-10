<?php
    if((isset($_GET['month']) && $_GET['month'] != '') && (isset($_GET['year']) && $_GET['year'] != ''))
    {
        $time = $_GET['year'].'-'.$_GET['month'].'-1';
        $date = strtotime($time);
    }
    else
    {
        $date = strtotime(date('y-m-d')); 
    }

    $day = date('d', $date);
    $month = date('m', $date);
    $year = date('Y', $date);
    $firstDay = mktime(0,0,0,$month, 1, $year);
    $title = strftime('%B', $firstDay);
    $dayOfWeek = date('D', $firstDay);
    $daysInMonth = cal_days_in_month(0, $month, $year);
    $timestamp = strtotime('next Sunday');
    $weekDays = array();

    for($i=0;$i<7;$i++)
    {
        $weekDays[] = strftime('%a', $timestamp);
        $timestamp = strtotime('+1 day', $timestamp);
    }

    $blank = date('w', strtotime("{$year}-{$month}-01"));
?>
<!-- Main content -->
<section class="content mb-3">
    <div class="container-fluid">
        <h5 class="pt-3 pb-2">Dashboard</h5>
        <div class="row mb-2 text-sm">
            <div class="col-12 col-sm-6 col-md-3">
                <a class="my-info-box info-box" href="index.php?com=setting&act=capnhat" title="Cấu hình website">
                    <span class="my-info-box-icon info-box-icon bg-primary"><i class="fas fa-cogs"></i></span>
                    <div class="info-box-content text-dark">
                        <span class="info-box-text text-capitalize">Cấu hình website</span>
                        <span class="info-box-number">View more</span>
                    </div>
                </a>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <a class="my-info-box info-box" href="index.php?com=user&act=admin_edit" title="Tài khoản">
                    <span class="my-info-box-icon info-box-icon bg-danger"><i class="fas fa-user-cog"></i></span>
                    <div class="info-box-content text-dark">
                        <span class="info-box-text text-capitalize">Tài khoản</span>
                        <span class="info-box-number">View more</span>
                    </div>
                </a>
            </div>
            <div class="clearfix hidden-md-up"></div>
            <div class="col-12 col-sm-6 col-md-3">
                <a class="my-info-box info-box" href="index.php?com=user&act=admin_edit&changepass=1" title="Đổi mật khẩu">
                    <span class="my-info-box-icon info-box-icon bg-success"><i class="fas fa-key"></i></span>
                    <div class="info-box-content text-dark">
                        <span class="info-box-text text-capitalize">Đổi mật khẩu</span>
                        <span class="info-box-number">View more</span>
                    </div>
                </a>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <a class="my-info-box info-box" href="index.php?com=contact&act=man" title="Thư liên hệ">
                    <span class="my-info-box-icon info-box-icon bg-info"><i class="fas fa-address-book"></i></span>
                    <div class="info-box-content text-dark">
                        <span class="info-box-text text-capitalize">Thư liên hệ</span>
                        <span class="info-box-number">View more</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="content pb-4">
   <div class="container-fluid">
       <div class="card">
           <div class="card-header">
               <h5 class="mb-0">Thống kê truy cập tháng <?=$month?>/<?=$year?></h5>
           </div>
           <div class="card-body">
            <form class="form-filter-charts row align-items-center mb-1" action="index.php" method="get" name="form-thongke" accept-charset="utf-8">
                <div class="col-md-4">
                    <div class="form-group">
                        <select class="form-control select2" name="month" id="month">
                            <option value="">Chọn tháng</option>
                            <?php for($i=1; $i<=12 ;$i++) { ?>
                                <?php
                                if(isset($_GET['year'])) $selected = ($i==$_GET['month']) ? 'selected':'';
                                else $selected = ($i==date('m')) ? 'selected':'';
                                ?>
                                <option value="<?=$i?>" <?=$selected?>>Tháng <?=$i?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <select class="form-control select2" name="year" id="year">
                            <option value="">Chọn năm</option>
                            <?php for($i=2000;$i<=date('Y')+20;$i++) { ?>
                                <?php
                                if(isset($_GET['year'])) $selected = ($i==$_GET['year']) ? 'selected':'';
                                else $selected = ($i==date('Y')) ? 'selected':'';
                                ?>
                                <option value="<?=$i?>" <?=$selected?>>Năm <?=$i?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"><button type="submit" class="btn btn-success">Thống Kê</button></div>
                </div>
            </form>
               <div id="apexMixedChart"></div>
           </div>
       </div>
   </div>
</section>

<script src="assets/apexcharts/apexcharts.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var apexMixedChart;
        var options = {
            colors: ['#3c8dbc'],
            chart:
            {
                id: 'apexMixedChart',
                height: 450,
                type: 'line',
                dropShadow:
                {
                    enabled: true,
                    color: '#000',
                    top: 18,
                    left: 7,
                    blur: 20,
                    opacity: 0.2
                }
            },
            series: [{
                name: 'Thống kê truy cập tháng <?=$month?>',
                type: 'line',
                data: [
                    <?php for($i = 1; $i <= $daysInMonth; $i++) {
                        $k = $i+1;
                        $begin = strtotime($year.'-'.$month.'-'.$i);
                        $end = strtotime($year.'-'.$month.'-'.$k);
                        $todayrc = $d->rawQueryOne("select count(*) as todayrecord from #_counter where tm >= ? and tm < ?",array($begin,$end));
                        $today_visitors = $todayrc['todayrecord']; ?>
                        <?=$today_visitors?>,
                    <?php } ?>
                ]
            }],
            stroke: {
              curve: 'smooth'
            },
            grid: {
                borderColor: '#e7e7e7',
                row: {
                    colors: ['#f3f3f3', 'transparent'],
                    opacity: 0.5
                },
            },
            markers: {
                size: 1
            },
            dataLabels: {
                enabled: false
            },
            labels: [
                <?php for($i = 1; $i <= $daysInMonth; $i++) {
                    $k = $i+1;
                    $begin = strtotime($year.'-'.$month.'-'.$i);
                    $end = strtotime($year.'-'.$month.'-'.$k);
                    $todayrc = $d->rawQueryOne("select count(*) as todayrecord from #_counter where tm >= ? and tm < ?",array($begin,$end));
                    $today_visitors = $todayrc['todayrecord']; ?>
                    'D<?=$i?>',
                <?php } ?>
            ],
            legend: {
                position: 'top',
                horizontalAlign: 'right',
                floating: true,
                offsetY: -25,
                offsetX: -5
            }
        }

        apexMixedChart = new ApexCharts(document.querySelector("#apexMixedChart"), options);
        apexMixedChart.render();
    })
</script>