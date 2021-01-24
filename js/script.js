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
        var table_info = "<table class='table  table-responsive'>";
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
    $(document).on("change", "#object_table_length", table_fill);
    $(document).on("click", "#dataTables_filter_button", table_fill);
    $(document).on("change", "#object_table_page", table_fill);

    $(document).on("click", "#button_page_prev", function() {

        if (selected_page != 0) {
            selected_page -= 1;
            $("#selected_page").val(selected_page);
            table_fill();
        } else {
            alert("Достигнута нулевая страница");
        }

        // 
    });
    $(document).on("click", "#button_page_next", function() {
        selected_page += 1;

        $("#selected_page").val(selected_page);
        table_fill();
    })
    $(document).on("click", "#button_page_begining", function() {
        selected_page = 0;
        $("#selected_page").val(selected_page);
        table_fill();
    })
    $("#selected_page").on("change", function() {

        var val = parseInt($("#selected_page").val());
        //alert(val);
        console.log(val);
        if (!isNaN(val)) {
            selected_page = val;
            table_fill();
        } else {
            alert("incorrect value");
        }

    })

});
var selected_page;

function init() {
    selected_page = 0;

    var queryString = location.search; // Returns:'?q=123'
    // Further parsing:
    let params = new URLSearchParams(queryString);
    let table = params.get("table"); // is the number 123
    let db = params.get("db"); // is the number 123

    //var querry = "select * from " + table + " LIMIT " + $("#object_table_length").find('option:selected').text() + " OFFSET " + '0';
    var querry = "select COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS   WHERE TABLE_SCHEMA = '" + db + "'  AND TABLE_NAME = '" + table + "'";
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

function table_init(columns) {
    var col_info = [];
    columns['columns'].forEach(function(item, i, arr) {
        var tmp = {
            title: item[0]
        };
        col_info.push(tmp);
    });
    console.log("columns:");
    console.log(columns);
    console.log("col_info:");
    console.log(col_info);
    var tmp_d = {
        "title": "edit"
    };
    var tmp_e = {
        "title": "del"
    };

    col_info.push(tmp_e);
    col_info.push(tmp_d);
    object_table = $("#object_table").DataTable({

        paging: false,
        ordering: true,
        info: false,
        searching: false,
        sScrollX: true,
        scrollY: 500,
        scrollH: true,
        scrollCollapse: true,
        columns: col_info,

        columnDefs: [{
                targets: -1, // Start with the last
                render: function(data, type, row, meta) {
                    if (type === 'display') {
                        data = "<a href='#'   onclick='del_row_click(" + data + ")'>" + "удалить" + "</a>";
                    }

                    return data;
                }
            },
            {
                targets: -2, // Start with the last
                render: function(data, type, row, meta) {
                    if (type === 'display') {
                        data = "<a href='#'   onclick='edit_row_click(" + data + ")'>" + "изменить" + "</a>";
                    }

                    return data;
                }
            }
        ]
    });

}