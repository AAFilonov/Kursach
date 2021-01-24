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
    var form_items = $("#edit_form").children();

    console.log(form_items);
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

function form_fill() {
    $("#edit_form").empty();
    var form_html = "";
    Objects['columns'].forEach(function(item, i, arr) {
        form_html += "<div>";
        form_html += "<label for='" + Objects['columns'][i]['name'] + "'>" + Objects['columns'][i]['name'] + ":";
        form_html += "</label>";
        form_html += "<input 'type='text' ";
        form_html += "name='" + Objects['columns'][i]['name'] + "'>";
        form_html += "</div>";
    });

    $("#edit_form").append(form_html);

}
var isTableInited = false;
var table;

function render_table(result) {
    $("#object_block").empty();
    if (isTableInited) {

        table.destroy();
    }

    var col_info = [];
    var data_info = [];
    result['columns'].forEach(function(item, i, arr) {

        var tmp = {
            title: item['name']
        };
        col_info.push(tmp);
    });
    var tmp_e = { title: "edit" };
    var tmp_d = { title: "del" };
    //col_info.push(tmp_e, tmp_d);
    result['data'].forEach(function(item, i, arr) {
        var tmp = item;

        tmp['edit'] = i;
        tmp['del'] = i;
        //tmp['edit'] = "<td><a class='edit_row' href='#' onclick='edit_row_click(" + i + ")'>изменить</a></td>";
        // tmp['del'] = "<td> <a class='edit_row' href='#' onclick='del_row_click(" + i + ")'>удалить</a></td>";
        data_info.push(tmp);
    });
    console.log(col_info, data_info);

    table = $("#object_table").DataTable({

        paging: false,
        ordering: true,
        info: false,
        searching: false,
        scrollY: "600px",
        scrollCollapse: true,
        data: data_info,
        columns: [
            col_info[0],
            col_info[1],
            col_info[2],
            {
                "data": "edit",
                "render": function(data, type, row, meta) {
                    if (type === 'display') {
                        data = "<a href='#'   onclick='edit_row_click(" + data + ")'>" + "изменить" + "</a>";
                    }

                    return data;
                }
            },
            {
                "data": "edit",
                "render": function(data, type, row, meta) {
                    if (type === 'display') {
                        data = "<a href='#'   onclick='del_row_click(" + data + ")'>" + "удалить" + "</a>";
                    }

                    return data;
                }
            }
        ]

    });
    isTableInited = true;

}

function object_success_handle(result) {
    Objects = result;
    console.log("success");
    console.log(result);
    form_fill();
    $(document).on("click", "#save_form", save_form);
    $(document).on("click", "#add_form", add_form);



    if (result['error'] != null) console.log(result['error']);
    else {
        console.log(result['data']);
        console.log(result['rows']);
    };



    if (result['error'] != null) {
        var error_info = "<div>" + result['error'] + "</div>";
        $("#object_block").append(error_info);
    }

    if (result['data'] != null) {
        render_table(result);
    }




}

init();