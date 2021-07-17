<div class="row">
    <!--  form area -->
    <div class="col-sm-12"  id="PrintMe">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("dashboard_patient/prescription/prescription") ?>"> <i class="fa fa-list"></i>  <?php echo display('prescription_list') ?> </a>  
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 
                </div>
            </div> 

            <div class="panel-body">

                <div class="row">
                    <div class="col-sm-12">

                        <!-- Headline -->
                        <table class="table">
                            <thead>
                                <tr  class="bg-primary">
                                    <td>
                                        <strong><?php echo display('patient_id') ?></strong>: <?php echo $prescription->patient_id; ?>, 
                                        <strong>App ID</strong>: <?php echo $prescription->appointment_id; ?>
                                    </td>
                                    <td  class="text-right"><strong><?php echo display('date') ?></strong>: <?php echo date('m/d/Y', strtotime($prescription->date)); ?>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>  
                                    <td width="50%">
                                        <ul class="list-unstyled">
                                            <li><strong><?php echo $prescription->doctor_name; ?></strong></li> 
                                            <li><?php echo $prescription->specialist; ?></li>
                                            <li><strong><?php echo $prescription->department_name; ?></strong></li>   
                                            <li><?php echo $prescription->designation; ?></li>  
                                            <li><?php echo $prescription->address; ?></li>   
                                        </ul>
                                    </td>      
                                    <td width="50%" class="text-right">
                                        <ul class="list-unstyled">
                                            <li><strong><?php echo $website->title; ?></strong></li>  
                                            <li><?php echo $website->description; ?></li>  
                                            <li><?php echo $website->email; ?></li>  
                                            <li><?php echo $website->phone; ?></li>  
                                        </ul>
                                    </td> 
                                </tr>  
                            </tbody>
                            <tfoot>
                                <tr class="bg-primary">
                                    <td colspan="2">
                                        <?php
                                            $date1=date_create($prescription->date_of_birth);
                                            $date2=date_create(date('Y-m-d'));
                                            $diff=date_diff($date1,$date2); 
                                        ?>
                                        <strong><?php echo display('patient_name') ?></strong>: <?php echo $prescription->patient_name; ?>, 
                                        <strong><?php echo display('age') ?></strong>: <?php echo "$diff->y Years $diff->m Months"; ?>,
                                        <strong><?php echo display('sex') ?></strong>: <?php echo $prescription->sex; ?>,
                                        <strong><?php echo display('weight') ?></strong>: <?php echo $prescription->weight; ?>,
                                        <strong>BP</strong>: <?php echo $prescription->blood_pressure; ?>,
                                        <strong><?php echo display('insurance_name') ?></strong>: <?php echo $prescription->insurance_name; ?>
                                    </td> 
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>



                <div class="row">
                    <div class="col-sm-12">
                        <div style="float:left;width:35%;word-break:all;border-right:1px solid #e4e5e7;padding-right:10px">
                            <!-- chief_complain -->
                            <p>
                                <strong><?php echo display('chief_complain') ?></strong>: <?php echo $prescription->chief_complain; ?>
                            </p>
                            
                            <!-- patient_notes -->
                            <p>
                                <strong><?php echo display('patient_notes') ?></strong>: <?php echo $prescription->patient_notes; ?>
                            </p> 
                        </div>

                        <div style="float:left;width:65%;padding-left:10px">
                            <!-- Medicine -->
                            <table class="table table-striped"> 
                                <thead>
                                    <tr class="bg-info header-2">
                                        <th><?php echo display('medicine_name') ?></th>
                                        <th width="80"><?php echo display('type') ?></th>
                                        <th width="80"><?php echo display('days') ?></th>
                                        <th><?php echo display('instruction') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (!empty($prescription->medicine)) {
                                    $medicine = json_decode($prescription->medicine);

                                    if (sizeof($medicine) > 0) 
                                        foreach ($medicine as $value) { 
                                ?>
                                    <tr>
                                        <td><?php echo $value->name; ?></td> 
                                        <td><?php echo $value->type; ?></td> 
                                        <td><?php echo $value->days; ?></td>  
                                        <td><?php echo $value->instruction; ?></td> 
                                    </tr>
                                <?php  
                                        }
                                    }
                                ?> 
                                </tbody> 
                            </table> 


                            <!-- diagnosis -->
                            <table class="table table-striped"> 
                                <thead>
                                    <tr class="bg-info header-2">
                                        <th><?php echo display('diagnosis') ?></th>
                                        <th><?php echo display('instruction') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (!empty($prescription->diagnosis)) {
                                    $diagnosis = json_decode($prescription->diagnosis);

                                    if (sizeof($diagnosis) > 0) 
                                        foreach ($diagnosis as $value) { 
                                ?>
                                    <tr>
                                        <td><?php echo $value->name; ?></td> 
                                        <td><?php echo $value->instruction; ?></td> 
                                    </tr>
                                <?php  
                                        }
                                    }
                                ?> 
                                </tbody> 
                            </table>  
                        </div> 
                    </div>
                </div>




                <div class="row">
                    <div class="col-sm-12">
                        <!-- Signature -->
                        <table class="table" style="margin-top:50px"> 
                            <thead> 
                                <tr>
                                    <th style="width:50%;"></th>
                                    <td style="width:50%;text-align:center">
                                        <div style="border-bottom:2px dashed #e4e5e7"></div>
                                        <i>Signature</i>
                                    </td>
                                </tr>
                            </thead>
                        </table> 

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 