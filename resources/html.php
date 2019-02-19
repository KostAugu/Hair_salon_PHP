<?php

function frontPanel ($limit) {
    ?>
    <div class="wrapper">
        <h2>Radarų duomenys</h2>
        <div id="frontDiv">
            <form method="post" class="float-left">         
                <button name="add" value="1" id="add" type='submit' class='btn btn-success btn-lg'>Įvesti naują įrašą</button>
            </form>
                <button id="filter" type='button' class='btn btn-info btn-lg float-left'>Filtruoti</button>
        </div>
        <div id="searchForm" class="hidden">
            <form method="get">
                <table>
                    <tr>
                        <th><label>Data</label></th>
                        <td><input pattern="[\d,\-,:,\s]+" id="dateSearch" type="text" name="date" value="<?php echo (isset($_GET['date']) && isset($_GET['search'])) ? $_GET['date'] : ''; ?>"></td>
                        <td><input id="dateCB" type="checkbox">Nurodyti intervalą</td>
                        <td><input pattern="[\d,\-,:,\s]+" id="dateInterval1" type="text" name="dateInterval[0]" value="<?php echo (isset($_GET['dateInterval'][0]) && isset($_GET['search'])) ? $_GET['dateInterval'][0] : ''; ?>" disabled></td>
                        <td><input pattern="[\d,\-,:,\s]+" id="dateInterval2" type="text" name="dateInterval[1]" value="<?php echo (isset($_GET['dateInterval'][1]) && isset($_GET['search'])) ? $_GET['dateInterval'][1] : ''; ?>" disabled></td>
                    </tr>    
                    <tr>
                        <th><label>Automobilio numeris</label></th>
                        <td><input pattern="[A-Z|\d]{1,6}" type="text" name="number" value="<?php echo (isset($_GET['number']) && isset($_GET['search'])) ? $_GET['number'] : ''; ?>"></td>
                    </tr> 
                    <tr>
                        <th><label>Atstumas</label></th>
                        <td><input pattern="\d+(\.)?(\d+)?" id="distanceSearch" type="text" name="distance" value="<?php echo (isset($_GET['distance']) && isset($_GET['search'])) ? $_GET['distance'] : ''; ?>"></td>
                        <td><input id="distanceCB" type="checkbox">Nurodyti intervalą</td>
                        <td><input pattern="\d+(\.)?(\d+)?" id="distanceInterval1" type="text" name="distanceInterval[0]" value="<?php echo (isset($_GET['distanceInterval'][0]) && isset($_GET['search'])) ? $_GET['distanceInterval'][0] : ''; ?>" disabled></td>
                        <td><input pattern="\d+(\.)?(\d+)?" id="distanceInterval2" type="text" name="distanceInterval[1]" value="<?php echo (isset($_GET['distanceInterval'][1]) && isset($_GET['search'])) ? $_GET['distanceInterval'][1] : ''; ?>" disabled></td>
                    </tr> 
                    <tr>
                        <th><label>Laikas</label></th>
                        <td><input pattern="\d+(\.)?(\d+)?" id="timeSearch" type="text" name="time" value="<?php echo (isset($_GET['time']) && isset($_GET['search'])) ? $_GET['time'] : ''; ?>"></td>
                        <td><input id="timeCB" type="checkbox">Nurodyti intervalą</td>
                        <td><input pattern="\d+(\.)?(\d+)?" id="timeInterval1" type="text" name="timeInterval[0]" value="<?php echo (isset($_GET['timeInterval'][0]) && isset($_GET['search'])) ? $_GET['timeInterval'][0] : ''; ?>" disabled></td>
                        <td><input pattern="\d+(\.)?(\d+)?" id="timeInterval2" type="text" name="timeInterval[1]" value="<?php echo (isset($_GET['timeInterval'][1]) && isset($_GET['search'])) ? $_GET['timeInterval'][1] : ''; ?>" disabled></td>
                    </tr> 
                    <tr>
                        <th><label>Greitis</label></th>
                        <td><input pattern="\d+(\.)?(\d+)?" id="speedSearch" type="text" name="speed" value="<?php echo (isset($_GET['speed']) && isset($_GET['search'])) ? $_GET['speed'] : ''; ?>"></td>
                        <td><input id="speedCB" type="checkbox">Nurodyti intervalą</td>
                        <td><input pattern="\d+(\.)?(\d+)?" id="speedInterval1" type="text" name="speedInterval[0]" value="<?php echo (isset($_GET['speedInterval'][0]) && isset($_GET['search'])) ? $_GET['speedInterval'][0] : ''; ?>" disabled></td>
                        <td><input pattern="\d+(\.)?(\d+)?" id="speedInterval2" type="text" name="speedInterval[1]" value="<?php echo (isset($_GET['speedInterval'][1]) && isset($_GET['search'])) ? $_GET['speedInterval'][1] : ''; ?>" disabled></td>
                    </tr> 
                    <tr class="text-center">
                        <td colspan="4">
                            <input class="btn btn-primary btn-lgt" type="submit" name="search" >
                            <input type='hidden' name='limit' value='<?php echo $limit;?>'>
                        </td>
                        <td colspan="0.5"><button id="clean" type='button' class='btn btn-warning btn-lgt'>Išvalyti</button></td>
                        <td colspan="0.5"><button id="hide" type='button' class='btn btn-warning btn-lgt'>Slėpti</button></td>
                    </tr>
                </table>
            </form>
        </div>
    <div>
    <?php
}

function table ($result, $offset, $limit) {
    ?>
    <div class="w-80 p-3 mx-auto">
        <table id="datatable" class="table table-striped table-hover text-center" cellspacing="0" width="100%">
            <thead class="thead-dark">
                <tr>
                    <th>Nr</th>
                    <th>Laikas</th>
                    <th>
                        <table style="width: 100%">
                            <thead>
                                <tr>
                                    <th style="width: 24%">Klientas</th>
                                    <th style="width: 32%">Kirpėja</th>
                                    <th style="width: 44%">Veiksmai</th>
                                </tr>
                            </thead>
                        </table>
                    </th>
                </tr>
            </thead>            
            <?php 
    $eilesNr=1 + $offset;
    if (!empty($result)) {
        ?>
            <tbody>
        <?php
        if($result->num_rows == $limit +1) {
            $totalRows = $limit;
        } else {
            $totalRows = $result->num_rows;
        }
        for ($i = 0; $i<$totalRows; $i++) {
            $row = $result->fetch_assoc();
            $id = explode(',',$row['id']);
            $count = $row['count'];
            $date = $row['date'];
            $client_id = explode(',',$row['client_id']);
            $hairdresser_id = explode(',', $row['hairdresser_id']);
            $hairdresser = explode(',', $row['employee']);
            $client = explode(',', $row['name']);
            ?>                    
            <tr>
                <td><?php echo $eilesNr++; ?></td>
                <td><?php echo $date; ?></td>
                <td>
                    <table style="width: 100%">
                        <tbody>
                            <?php
                            for ($j=0; $j<$count; $j++) {
                            ?>
                            <tr>
                                <td style="width: 24%"><?php echo $client[$j]; ?></td>
                                <td style="width: 32%"><?php echo $hairdresser[$j]; ?></td>
                                <td style="width: 44%">
                                    <form method="post">
                                        <input type='hidden' name='date' value='<?php echo $date;?>'>
                                        <button name="edit" value="<?php echo $id[$j]; ?>" id="edit" type='submit' class='btn btn-warning btn-sm'><span>Koreguoti</span></button>
                                        <button name="delete" value="<?php echo $id[$j]; ?>" id="delete" type='submit' class='btn btn-danger btn-sm'><span>Atšaukti rezervaciją</span></button>
                                    </form> 
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <td colspan="4" style="width: 100%">
                                    <form method="post">
                                        <button name="reserve" value="<?php echo $date; ?>" id="reserve" type='submit' class='btn btn-success btn-sm'><span>Pridėti rezervaciją</span></button>
                                    </form> 
                                </td>
                            </tr>                            
                        </tbody>
                    </table>
                </td>
            </tr>    
            <?php
        }
            ?>
            </tbody>
<?php
    } 
    ?>
            </table>
            <?php
                if (empty($result)) echo "<h3 class='text-center'>Nėra duomenų</h3>";
            ?>
    </div>
    <?php
}     

function clientsTable ($result) {
?>
<div class="w-80 p-3 mx-auto">
    <table class="table table-striped table-hover text-center" cellspacing="0" width="100%">
        <thead class="thead-dark">
            <tr>
                <th>Nr</th>
                <th>Id</th>
                <th>Vardas</th>
                <th>Apsilankymai</th>
                <th>Veiksmai</th>
            </tr>
        </thead>            
        <?php 
$eilesNr=1;
if (!empty($result)) {
    ?>
        <tbody>
    <?php
    for ($i = 0; $i<count($result); $i++) {
        $id = $result[$i]['id'];
        $name = $result[$i]['name'];
        $visits = $result[$i]['visits'];
        ?>                    
        <tr>
            <td><?php echo $eilesNr++; ?></td>
            <td><?php echo $id; ?></td>
            <td><?php echo $name; ?></td>
            <td><?php echo $visits; ?> 
            <td>
                <form method="post">
                    <button name="editClient" value="<?php echo $id; ?>" id="editClient" type='submit' class='btn btn-warning btn-sm'><span>Koreguoti</span></button>
                    <button name="deleteClient" value="<?php echo $id; ?>" id="deleteClient" type='submit' class='btn btn-danger btn-sm'><span>Trinti</span></button>
                </form> 
            </td>
            </tr>    
        <?php
    }
        ?>
        </tbody>
<?php
} 
?>
        </table>
        <?php
            if (empty($result)) echo "<h3 class='text-center'>Nėra duomenų</h3>";
        ?>
</div>
<?php
}

function pagesList($result, $limit, $offset, $offsetLink, $searchParameters) {
?>
    <nav>
        <ul id="pagination" class="pagination float-right">
        <?php   
        if ($offset > 0) {
            echo "<li class='page-item'><a class='page-link' href='?". $offsetLink . "&offset=" . ($offset - $limit) . "'>Atgal </a></li>";
        } else {
            echo "<li class='page-item'><a class='page-link disabled' >Atgal </a></li>";
        }
        $number = 0;
        while (totalRows(connection(), $searchParameters)-($limit*$number) > 0) {
            $sk = "";
            if ($limit*$number == $offset) {
                $sk="active";
            }
            echo "<li class='page-item'><a" . " class='page-link ".$sk .  "' href='?" . $offsetLink . "&offset=" . ($number * $limit) . "'> " . ($number+1) . " </a></li>";
            $number++;
        }
        if (empty($result)) {
            echo "<li class='page-item'><a class='page-link disabled'> Pirmyn</a></li>";
        } else if ($result->num_rows == $limit + 1) {
            echo "<li class='page-item'><a class='page-link' href='?" . $offsetLink . "&offset=" . ($offset + $limit) . "'> Pirmyn</a></li>";
        } else {
            echo "<li class='page-item'><a class='page-link disabled'> Pirmyn</a></li>";
        }
?>
        </ul>
    </nav>
<?php    
}

function selection() {
    ?>
    <div class="form-group float-right">
    <select class="btn btn-secondary" id="limitSelect" >
            <option value="10" <?php if(isset($_GET['limit']) && $_GET['limit']==10) echo "selected";?>>10</option>
            <option value="20" <?php if(isset($_GET['limit']) && $_GET['limit']==20) echo "selected";?>>20</option>
            <option value="30" <?php if(isset($_GET['limit']) && $_GET['limit']==30) echo "selected";?>>30</option>
            <option value="40" <?php if(isset($_GET['limit']) && $_GET['limit']==40) echo "selected";?>>40</option>
            <option value="50" <?php if(isset($_GET['limit']) && $_GET['limit']==50) echo "selected";?>>50</option>
    </select>
    </div>
    <?php
}
?>