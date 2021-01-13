function success_handle(result) {

    console.log("success");
    console.log(result);


    $('#result_block').empty();
    if (result['error'] != null) console.log(result['error']);
    else {
        console.log(result['data']);
        console.log(result['rows']);
    };



    if (result['error'] != null) {
        var error_info = "<div>" + result['error'] + "</div>";
        $("#result_block").append(error_info);
    }

    if (result['data'] != null) {
        var table_info = "<table>";
        table_info += "<tr>";
        result['columns'].forEach(function(item, i, arr) {
            table_info += "<th>";
            table_info += item['name'];
            table_info += "</th>";
        });
        table_info += "</tr>";
        result['data'].forEach(function(item, i, arr) {
            table_info += "<tr>";
            item.forEach(function(itemj, j, arr) {
                table_info += "<td>";
                table_info += itemj;
                table_info += "</td>";
            });
            table_info += "</tr>";
        });
        table_info += "</table>";
        $("#result_block").append(table_info);
    }

}

function error_handle(result) {
    console.log("error");
    console.log(result);
    console.log(result.responseText);
}
$(document).ready(function() {

    $(document).on("click", "#send_querry", function() {
        var querry = $('#querry_text').val();
        //alert(querry);
        if (querry == "") alert("querry is empty!");
        else
            $.ajax({
                type: "post",
                url: "../ajax_requests.php",
                data: {
                    request: querry
                },
                success: success_handle,
                error: error_handle
            });


    });

});

function init() {
    var queryString = location.search; // Returns:'?q=123'
    // Further parsing:
    let params = new URLSearchParams(queryString);
    let table = params.get("table"); // is the number 123

    var querry = "select * from " + table;
    //alert(querry);
    if (querry == "") alert("querry is empty!");
    else
        $.ajax({
            type: "post",
            url: "../ajax_requests.php",
            data: {
                request: querry
            },
            success: object_success_handle,
            error: {
                function(result) {
                    console.log("error");
                    console.log(result);
                    console.log(result.responseText);
                }
            }
        });
}