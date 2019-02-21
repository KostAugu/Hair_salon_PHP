<div class='container-fluid'>
    <div class='row'>
        <div class='col-sm-2'>
            <ul class='sidebar-nav'>
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
table(selectSQL(connection(), $offset, $limit, $searchParameters, true, $clientSessionId), $offset, $limit, true, $clientSessionId);
selection();
pagesList(selectSQL(connection(), $offset, $limit, $searchParameters), $limit, $offset, $offsetLink, $searchParameters);
?>
        </div> 
    </div>
</div>