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
<?php
displayModal($modalWindow);
clientsTable(selectClients(connection()));
?>            
        </div> 
    </div>
</div>