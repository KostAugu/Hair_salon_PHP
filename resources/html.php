<?php

function table ($result, $offset, $limit, $toClients="", $clientSessionId="") {
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
                            <?php
                            if (!$toClients) {
                            ?>
                                <tr>
                                    <th style="width: 24%">Klientas</th>
                                    <th style="width: 32%">Kirpėja</th>
                                    <th style="width: 44%">Veiksmai</th>
                                </tr>
                            <?php
                            }
                            ?>    
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
                            if (!$toClients) {
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
                            }
                            ?>
                            <tr>
                                <td colspan="4" style="width: 100%">
                                <?php
                                if (!empty($clientSessionId)) {
                                    echo "Laikas rezervuotas klientui: " . $client[0];
                                } else {
                                ?>
                                    <form method="post">
                                        <button name="<?php echo $toClients ? "client" : ""; ?>reserve" value="<?php echo $date; ?>" id="reserve" type='submit' class='btn btn-success btn-sm'><span>Pridėti rezervaciją</span></button>
                                    </form> 
                                <?php
                                }
                                ?>    
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