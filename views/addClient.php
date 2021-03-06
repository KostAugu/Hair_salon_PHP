<div class='container-fluid'>
    <div class='row'>
        <div class='col-sm-2'>
            <ul class='sidebar-nav'>
                <hr>
                <li class="flex-column links d-flex justify-content-start">
                    <a class="navbar-brand" href="/addemployee">Įvesti kirpėją</a>
                    <a class="navbar-brand" href="/addclient">Įvesti klientą</a>
                    <a class="navbar-brand" href="/clientslist">Klientai</a>
                </li> 
                <hr> 
            </ul>    
        </div> 
        <div class='col-sm-10'>
            <div class="addForm">
                <form class="mt-5" method="POST">
                    <table class="table text-center mt-5">
                        <tr>
                            <th width="34.5%"><label>Vardas</label></th>
                            <td width="34.5%">
                                <input type="text" name="name" value='<?php echo $name;?>'> 
                                <input type='hidden' name='post_id' value='<?php echo createPassword(64);?>'>
                            </td>
                            <td width="31%"><span class="error"> <?php echo $nameErr;?></span></td>                    
                        </tr>
                        <tr>
                            <td colspan="3">                            
                                <button class="btn btn-primary" id="clientEntry" type="submit" name="clientEntry" value="Submit">Įvesti</button>
                            </td>
                        </tr>
                    </table>
                </form>
                <h3 class="success"><?php echo $message;?></h3>
            </div>
        </div> 
    </div>
</div>