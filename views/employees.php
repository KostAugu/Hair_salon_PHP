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
                <li><h3>FILTRAI</h3></li>
                <li><input type="text"></li>
            </ul>    
        </div> 
        <div class='col-sm-10'>

<?php
displayModal($modalWindow);
selection();
pagesList(selectSQL(connection(), $offset, $limit, $searchParameters), $limit, $offset, $offsetLink, $searchParameters);
table(selectSQL(connection(), $offset, $limit, $searchParameters),$offset, $limit);
selection();
pagesList(selectSQL(connection(), $offset, $limit, $searchParameters), $limit, $offset, $offsetLink, $searchParameters);
?>
        </div> 
    </div>
</div>