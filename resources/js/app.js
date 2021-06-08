require('./bootstrap');

$( document ).ready(function(event) {
    $("#searchTerm").keyup(function(){search()});
    $('#camper_make').click(function(event){sort(event)});
    $('#camper_brand').click(function(event){sort(event)});
    $('#sleep_number').click(function(event){sort(event)});
    $('#price').click(function(event){sort(event)});
});

function resetArrows(){
    $('#camper_make').attr('class', 'bi bi-arrow-down-up');
    $('#camper_brand').attr('class', 'bi bi-arrow-down-up');
    $('#sleep_number').attr('class', 'bi bi-arrow-down-up');
    $('#price').attr('class', 'bi bi-arrow-down-up');
}

function buildRow(row) {
    let newRow = document.createElement('tr');
    for (const [key, value] of Object.entries(row)) {
        //TODO this needs to be done server side for security
        if(key !== 'id' && key !== 'created_at' && key !== 'updated_at') {
            let td = document.createElement('td');
            const cleanedValue = !value?'':value;
            td.append(document.createTextNode( cleanedValue ));
            newRow.append(td);
        }
    }
    return newRow;
}

function arrowManager(event) {
    $('#searchTerm').val('');
    const currentDirection = event.currentTarget.className
    resetArrows();
        let nextDirection = '';
    switch (currentDirection) {
        case 'bi bi-arrow-down-up':
            event.currentTarget.className = 'bi bi-arrow-up sorted';
            nextDirection = 'asc';
            break;
        case 'bi bi-arrow-up sorted':
            event.currentTarget.className = 'bi bi-arrow-down sorted';
            nextDirection = 'desc';
            break;
        case 'bi bi-arrow-down sorted':
            event.currentTarget.className = 'bi bi-arrow-down-up';
            nextDirection = '';
            break;
    }
    return nextDirection;
}
//todo: refactor sort and search because they are nearly identical.
function sort(event){
    const sortColumn = event.currentTarget.id;
    const direction = arrowManager(event);
    $.ajax({
        url: "/api/search",
        type: "GET",
        data: {
            term: $("#searchTerm").val(),
            column: sortColumn,
            direction: direction,
        },
        success: function(result){
            $("tbody").html('');
            for (const [key, value] of Object.entries(result.data)) {
                $("tbody").append(buildRow(value));
            }
        }});

}

function search() {
    $.ajax({
        url: "/api/search",
        type: "GET",
        data: {
            term: $("#searchTerm").val(),
        },
        success: function(result){
            $("tbody").html('');
            for (const [key, value] of Object.entries(result.data)) {
                $("tbody").append(buildRow(value));
                resetArrows();
            }
        }});
}

