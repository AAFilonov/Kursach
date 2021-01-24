var Objects;


function update_success(result_) {
    console.log("sucess update");
    console.log(result_);
    if (result_['info'] != null) {
        var error_info = "<div>" + result_['info'] + "</div>";
        $("#result_block").empty();
        $("#result_block").append(error_info);
        $("#save_form").attr("disabled", true);
        $("#add_form").attr("disabled", false);



        init();
    }
    if (result_['error'] != null) {
        var error_info = "<div>" + result_['error'] + "</div>";
        $("#result_block").empty();
        $("#result_block").append(error_info);
    }


};

function update_error(result) {
    console.log("error update");
    console.log(result);
    if (result['error'] != null) {
        var error_info = "<div>" + result['error'] + "</div>";
        $("#result_block").append(error_info);
    }
};

function save_form() {

    var row_new = $('form').serializeArray();
    var column_names = [];
    var new_values = [];
    row_new.forEach(element => {
        column_names.push(element['name']);
        new_values.push(element['value']);
    });
    console.log("update attempt");



    $.ajax({
        type: "post",
        url: "../update_row.php",
        ContentType: "application/json",
        data: {
            new_poles: new_values,
            old_poles: Objects['data'][row_num_value],
            columns: column_names,
            table: Objects['columns'][0]['table']
        },
        success: update_success,
        error: update_error
    });
}

function add_form() {

    var row_new = $('form').serializeArray();
    var column_names = [];
    var new_values = [];
    row_new.forEach(element => {
        column_names.push(element['name']);
        new_values.push(element['value']);
    });
    console.log("update attempt");



    $.ajax({
        type: "post",
        url: "../add_row.php",
        ContentType: "application/json",
        data: {
            new_poles: new_values,
            columns: column_names,
            table: Objects['columns'][0]['table']
        },
        success: update_success,
        error: update_error
    });
}


function edit_row_click(row_num) {

    $("#save_form").attr("disabled", false);
    $("#add_form").attr("disabled", true);
    row_num_value = row_num;
    console.log("edit row " + row_num);
    var form_items = $("#edit_form").find("input");


    Objects['data'][row_num].forEach(function(item, i, arr) {

        form_items[i].value = item;


    });
}

function del_row_click(row_num) {
    console.log("delete row " + row_num);
    $.ajax({
        type: "post",
        ContentType: "application/json",
        url: "../del_row.php",
        data: {
            old_poles: Objects['data'][row_num],
            columns: Objects['columns'],
            table: Objects['columns'][0]['table']
        },
        success: update_success,
        error: update_error
    });
}

function form_fill(columns) {
    $("#edit_form").empty();
    var form_html = "";
    columns['columns'].forEach(function(item, i, arr) {
        form_html += "<div>";
        form_html += "<label for='" + columns['columns'][i][0] + "'>" + columns['columns'][i][0] + ":";
        form_html += "</label>";
        form_html += "<input 'type='text' ";
        form_html += "name='" + columns['columns'][i][0] + "'>";
        form_html += "</div>";
    });

    $("#edit_form").append(form_html);

}
var isTableInited = false;
var object_table;

function render_table(result) {

    Objects = result;

    object_table.clear();
    result['data'].forEach(function(item, i, arr) {


        item.push(i);
        item.push(i);


        object_table.row.add(item).draw(false);
    });

    console.log(result);
    console.log("table fill success");
}


function table_fill(result) {

    var queryString = location.search; // Returns:'?q=123'
    // Further parsing:
    let params = new URLSearchParams(queryString);
    let table = params.get("table"); // is the number 123

    var lenght = $("#object_table_length").find('option:selected').val();
    var page = $("#object_table_page").find('option:selected').val();
    var querry = "select * from " + table + " LIMIT " + lenght + " OFFSET " + lenght * page;

    console.log("try to fill a table");
    $.ajax({
        type: "post",
        url: "../ajax_requests.php",
        data: {
            request: querry
        },
        success: render_table,
        error: {
            function(result) {
                console.log("failed to fill table");
                console.log(result);

            }
        }
    });

}

function object_success_handle(result) {

    var columns = [];
    columns['columns'] = result['data'];
    //Objects = result;
    console.log("column request success");
    console.log(result);
    form_fill(columns);
    $(document).on("click", "#save_form", save_form);
    $(document).on("click", "#add_form", add_form);



    if (result['error'] != null) console.log(result['error']);
    else {
        console.log(result['data']);
        console.log(result['rows']);
        table_init(columns);
        table_fill();

    };







}

init();