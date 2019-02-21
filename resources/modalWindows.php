<div class="modal fade" id="mainForm" role="dialog">
    <div class="modal-dialog">       
        <div class="modal-content">
            <div class="modal-header">                
                <h4 class="modal-title">Duomenų įvedimas</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <form id="form1" method="POST">
                <table class="table text-center">
                    <tr>
                        <th width="34.5%"><label>Greičio fiksavimo data ir laikas</label></th>
                        <td width="34.5%">
                            <input type="text" name="date" value='<?php echo $date;?>'> 
                            <input type='hidden' name='post_id' value='<?php echo createPassword(64);?>'>
                            <input type='hidden' name='id' value='<?php echo $id;?>'>
                        </td>
                        <td width="31%"><span class="error"> <?php echo $dateErr;?></span></td>                    
                    </tr>
                    <tr>
                        <th width="34.5%"><label>Automobilio numeris</label></th>
                        <td width="34.5%"><input type="text" name="client" value="<?php echo $client;?>"></td>
                        <td width="31%"><span class="error"> <?php echo $clientErr;?></span></td>
                    </tr>
                    <tr>
                        <th width="34.5%"><label>Nuvažiuotas atstumas (metrai)</label></th>
                        <td width="34.5%"><input type="text" pattern="\d+(\.|,)?(\d+)?" name="hairdresser" value="<?php echo $hairdresser;?>"></td>
                        <td width="31%"><span class="error"> <?php echo $hairdresserErr;?></span></td>
                    </tr>
                    <tr>
                        <th width="34.5%"><label>Sugaištas laikas (sekundės)</label></th>
                        <td width="34.5%"><input type="text" pattern="\d+(\.|,)?(\d+)?" name="active" value="<?php echo $active;?>"></td>
                        <td width="31%"><span class="error"> <?php echo $activeErr;?></span></td>
                    </tr>
                    <tr>
                        <td colspan="3">                            
                            <button class="btn btn-primary" id="dataEntry" type="submit" form="form1" name="dataEntry" value="Submit">Įvesti</button>
                        </td>
                    </tr>
                </table>
            </form>
                <h3 class="success"><?php echo $message;?></h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Uždaryti</button>
            </div>
        </div>    
    </div>
</div>
<!-- Modal delete window -->
<div class="modal fade" id="deleteForm" role="dialog">
    <div class="modal-dialog">       
        <div class="modal-content">
            <div class="modal-header">                
                <h4 class="modal-title">Duomenų trynimas</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <form id="form2" method="POST">
                <table class="table text-center">
                <?php
                    if($message == '') {
                ?>
                    <tr>
                        <td width="100%" class="table-danger"><h5>Ar tikrai norite atšaukti rezervaciją?</h5>
                            <input type='hidden' name='post_id' value='<?php echo createPassword(64);?>'>
                            <input type='hidden' name='id' value='<?php echo $id;?>'>
                        </td>
                    </tr>
                    <tr>
                        <td width="100%">                            
                            <button class="btn btn-warning btn-lg" id="deleteEntry" type="submit" form="form2" name="deleteEntry" value="Submit">Taip</button>
                            <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal">Ne</button>
                        </td>
                    </tr>
                <?php
                    }
                ?>
                </table>
            </form>
                <h3 class="success"><?php echo $message;?></h3>
            </div>
        </div>    
    </div>
</div>
<!-- Modal reserve window -->
<div class="modal fade" id="reserveForm" role="dialog">
    <div class="modal-dialog">       
        <div class="modal-content">
            <div class="modal-header">                
                <h4 class="modal-title">Rezervavimas</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <form id="form3" method="POST">
                <table class="table text-center">
                    <?php
                        if ($message == '') {
                    ?>
                    <tr>
                        <th width="34.5%"><label>Klientas</label></th>
                        <td width="34.5%">
                            <select type='select' name='client_id' required='true' >
                                <option value="" disabled selected>Pasirinkite klientą</option>
                                    <?php                                    
                                    if (!empty($clients)) {
                                        for ($i = 0; $i<count($clients); $i++) {                                            
                                        ?>
                                            <option value="<?php echo $clients[$i]['id']; ?>"><?php echo $clients[$i]['name']; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                            </select>
                        </td>
                        <td width="31%"><span class="error"> <?php echo $nameErr;?></span></td>                    
                    </tr>                  
                    <tr>
                        <th width="34.5%"><label>Kirpėja</label></th>
                        <td width="34.5%">
                            <select type='select' name='hairdresser_id' required='true' >
                                <option value="" disabled selected>Pasirinkite kirpėją</option>
                                    <?php
                                    if (!empty($hairdressers)) {
                                        for ($i = 0; $i<count($hairdressers); $i++) {                                            
                                        ?>
                                            <option value="<?php echo $hairdressers[$i]['id']; ?>"><?php echo $hairdressers[$i]['first_name'] . " " . $hairdressers[$i]['last_name']; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                            </select>
                            <input type='hidden' name='post_id' value='<?php echo createPassword(64);?>'>
                            <input type='hidden' name='date' value='<?php echo $date;?>'>
                        </td>                   
                    </tr>
                    <tr>
                        <td width="100%">                            
                            <button class="btn btn-warning btn-lg" id="reserveEntry" type="submit" form="form3" name="reserveEntry" value="Submit">Rezervuoti</button>
                            <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal">Atgal</button>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
            </form>
                <h3 class="success"><?php echo $message;?></h3>
            </div>
        </div>    
    </div>
</div>
<!-- Modal edit window -->
<div class="modal fade" id="editReserveForm" role="dialog">
    <div class="modal-dialog">       
        <div class="modal-content">
            <div class="modal-header">                
                <h4 class="modal-title">Rezervavimas</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <form id="form4" method="POST">
                <table class="table text-center">
                    <?php
                        if($message == '' &&  !empty($reservation)) {
                    ?>
                    <tr>
                        <th width="34.5%"><label>Klientas</label></th>
                        <td width="34.5%">
                            <select type='select' name='client_id' required='true' >
                                <option value="" disabled>Pasirinkite klientą</option>
                                    <?php                                    
                                    if (!empty($clients)) {
                                        for ($i = 0; $i<count($clients); $i++) {                                            
                                        ?>
                                            <option value="<?php echo $clients[$i]['id']; ?>" <?php echo $clients[$i]['id'] == $reservation[0]['client_id'] ? 'selected' : ''; ?> ><?php echo $clients[$i]['name']; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                            </select>
                            <input type='hidden' name='post_id' value='<?php echo createPassword(64);?>'>
                            <input type='hidden' name='id' value='<?php echo $reservation[0]['id'];?>'>
                        </td>
                        <td width="31%"><span class="error"> <?php echo $nameErr;?></span></td>                    
                    </tr>
                    <tr>
                        <th width="34.5%"><label>Kirpėja</label></th>
                        <td width="34.5%">
                            <select type='select' name='hairdresser_id' required='true' >
                                <option value="" disabled>Pasirinkite kirpėją</option>
                                    <?php
                                    if (!empty($hairdressers)) {
                                        for ($i = 0; $i<count($hairdressers); $i++) {                                            
                                        ?>
                                            <option value="<?php echo $hairdressers[$i]['id']; ?>" <?php echo $hairdressers[$i]['id'] == $reservation[0]['hairdresser_id'] ? 'selected' : ''; ?> ><?php echo $hairdressers[$i]['first_name'] . " " . $hairdressers[$i]['last_name']; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                            </select>
                        </td>                   
                    </tr>
                    <tr>
                        <td width="100%">                            
                            <button class="btn btn-warning btn-lg" id="editReservation" type="submit" form="form4" name="editReservation" value="Submit">Koreguoti</button>
                            <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal">Atgal</button>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
            </form>
                <h3 class="success"><?php echo $message;?></h3>
            </div>
        </div>    
    </div>
</div>
<!-- Modal client edit window -->
<div class="modal fade" id="editClientForm" role="dialog">
    <div class="modal-dialog">       
        <div class="modal-content">
            <div class="modal-header">                
                <h4 class="modal-title">Rezervavimas</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <form id="form5" method="POST">
                <table class="table text-center">
                    <?php
                        if($message == '' && !empty($clients)) {
                    ?>
                    <tr>
                        <th width="34.5%"><label>Vardas</label></th>
                        <td width="34.5%">
                            <input type='hidden' name='post_id' value='<?php echo createPassword(64);?>'>
                            <input type='hidden' name='id' value='<?php echo $clients[0]['id'];?>'>
                            <input type='text' name='name' value='<?php echo $clients[0]['name'];?>'>
                        </td>
                        <td width="31%"><span class="error"> <?php echo $nameErr;?></span></td>                    
                    </tr>
                    <tr>
                        <td width="100%">                            
                            <button class="btn btn-warning btn-lg" id="editClientForm" type="submit" form="form5" name="editClientForm" value="Submit">Koreguoti</button>
                            <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal">Atgal</button>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
            </form>
                <h3 class="success"><?php echo $message;?></h3>
            </div>
        </div>    
    </div>
</div>
<!-- Modal client delete window -->
<div class="modal fade" id="deleteClientForm" role="dialog">
    <div class="modal-dialog">       
        <div class="modal-content">
            <div class="modal-header">                
                <h4 class="modal-title">Duomenų trynimas</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <form id="form6" method="POST">
                <table class="table text-center">
                <?php
                    if($message == '') {
                ?>
                    <tr>
                        <td width="100%" class="table-danger"><h5>Ar tikrai norite atšaukti rezervaciją?</h5>
                            <input type='hidden' name='post_id' value='<?php echo createPassword(64);?>'>
                            <input type='hidden' name='id' value='<?php echo $id;?>'>
                        </td>
                    </tr>
                    <tr>
                        <td width="100%">                            
                            <button class="btn btn-warning btn-lg" id="deleteClientForm" type="submit" form="form6" name="deleteClientForm" value="Submit">Taip</button>
                            <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal">Ne</button>
                        </td>
                    </tr>
                <?php
                    }
                ?>
                </table>
            </form>
                <h3 class="success"><?php echo $message;?></h3>
            </div>
        </div>    
    </div>
</div>

<!-- Modal client reserve window -->
<div class="modal fade" id="clientReserveForm" role="dialog">
    <div class="modal-dialog">       
        <div class="modal-content">
            <div class="modal-header">                
                <h4 class="modal-title">Rezervavimas</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <form id="form7" method="POST">
                <table class="table text-center">
                    <?php
                        if ($message == '') {
                    ?>
                    <tr>
                        <th width="34.5%"><label>Klientas</label></th>
                        <td width="34.5%">
                            <input type='text' name='name' placeholder="Įveskite savo vardą">
                        </td>
                        <td width="31%"><span class="error"> <?php echo $nameErr;?></span></td>                    
                    </tr>                
                    <tr>
                        <th width="34.5%"><label>Kirpėja</label></th>
                        <td width="34.5%">
                            <select type='select' name='hairdresser_id' required='true' >
                                <option value="" disabled selected>Pasirinkite kirpėją</option>
                                    <?php
                                    if (!empty($hairdressers)) {
                                        for ($i = 0; $i<count($hairdressers); $i++) {                                            
                                        ?>
                                            <option value="<?php echo $hairdressers[$i]['id']; ?>"><?php echo $hairdressers[$i]['first_name'] . " " . $hairdressers[$i]['last_name']; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                            </select>
                            <input type='hidden' name='post_id' value='<?php echo createPassword(64);?>'>
                            <input type='hidden' name='date' value='<?php echo $date;?>'>
                        </td>                   
                    </tr>
                    <tr>
                        <td width="100%">                            
                            <button class="btn btn-warning btn-lg" id="clientReserveEntry" type="submit" form="form7" name="clientReserveEntry" value="Submit">Rezervuoti</button>
                            <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal">Atgal</button>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
            </form>
                <h3 class="success"><?php echo $message;?></h3>
            </div>
        </div>    
    </div>
</div>