<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
        <div class="panel panel-bd">
            <div class="panel-body">
                <div class="statistic-box">
                    <h2><span class="count-number"><?php echo (!empty($notify->total_app) ? $notify->total_app : null) ?></span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i></span></h2>
                    <div class="small"><?= display('appointment') ?></div>
                    <div class="sparkline1"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
        <div class="panel panel-bd">
            <div class="panel-body">
                <div class="statistic-box">
                    <h2><span class="count-number"><?php echo (!empty($notify->total_patient) ? $notify->total_patient : null) ?></span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i></span></h2>
                    <div class="small"><?= display('patient') ?></div>
                    <div class="sparkline2"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
        <div class="panel panel-bd">
            <div class="panel-body">
                <div class="statistic-box">
                    <h2><span class="count-number"><?php echo (!empty($notify->total_doctor) ? $notify->total_doctor : null) ?></span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i></span></h2>
                    <div class="small"><?= display('doctor') ?></div>
                    <div class="sparkline3"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
        <div class="panel panel-bd">
            <div class="panel-body">
                <div class="statistic-box">
                    <h2><span class="count-number"><?php echo (!empty($notify->total_representative) ? $notify->total_representative : null) ?></span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i></span></h2>
                    <div class="small"><?= display('representative') ?></div>
                    <div class="sparkline4"></div>
                </div>
            </div>
        </div>
    </div>
</div>
 
<div class="row">
    <!-- Total Product Sales area -->
    <div class="col-lg-8">
        <div class="panel panel-default" id="js-timer">
            <div class="panel-body">
                <div class="widget-title">
                    <h3><?= display('total_progress')?></h3>
                    <span><?= display('last_year_status') ?></span>
                </div>
                <canvas id="lineChart" height="170"></canvas>
            </div> <!-- /.panel-body -->
        </div>
    </div>

    <!-- Message area -->
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3><?= display('enquiry') ?></h3>
                <span><?= display('latest_enquiry') ?></span>
            </div>
            <div class="panel-body"> 
                <div class="message_inner">
                    <?php if (!empty($enquires)) {  ?>
                        <?php foreach ($enquires as $enquiry) {  ?>
                        <a href="<?php echo base_url("enquiry/view/$enquiry->enquiry_id") ?>">
                            <div class="inbox-item">
                                <strong class="inbox-item-author"><?php echo $enquiry->name; ?></strong>
                                <span class="inbox-item-date"></span>
                                <p class="inbox-item-text"><?php echo character_limiter(strip_tags($enquiry->enquiry),70); ?></p>
                            </div>
                        </a>
                        <?php } ?>
                    <?php } ?>
                </div> 
            </div>
        </div>
    </div>
    <!-- /.row --> 
</div> <!-- /.row -->
 
 

<script type="text/javascript"> 
    $(window).on('load', function(){
        //line chart
        var ctx = document.getElementById("lineChart");
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July","August","September","October","November","December"],
                datasets: [
                    {
                        label: "Patient",
                        borderColor: "#2C3136",
                        borderWidth: "1",
                        backgroundColor: "rgba(0,0,0,.07)",
                        pointHighlightStroke: "rgba(26,179,148,1)",
                        data: [
                            <?php 
                            if (!empty($chart[0])) {
                                for ($i=0; $i < 12 ; $i++) { 
                                   echo (!empty($chart[0][$i])?$chart[0][$i]->patient:0).", ";
                                }
                            }
                            ?>
                        ]
                    },
                    {
                        label: "Appointment",
                        borderColor: "#73BC4D",
                        borderWidth: "1",
                        backgroundColor: "#73BC4D",
                        pointHighlightStroke: "rgba(26,179,148,1)",
                        data: [
                            <?php
                            if (!empty($chart[1])) {
                                for ($i=0; $i < 12 ; $i++) { 
                                   echo (!empty($chart[1][$i])?$chart[1][$i]->appointment:0).", ";
                                }
                            } 
                            ?> 
                        ]
                    }
                ]
            },
            options: {
                responsive: true,
                tooltips: {
                    mode: 'index',
                    intersect: false
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                }

            }
        });
    });
</script>
 