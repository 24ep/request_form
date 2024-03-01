function get_count_read_nt() {
    $.post("/get/get_count_nt_unread.php", {}, function(data) {
        $('#get_count_nt_unread').html(data);
    });
}

function update_readed_nt() {
    $.post("/action/action_update_read_nt.php", {}, function(data) {
        // $('#project_bucket').html(data);
    });
}

function get_list_update_job() {
    $.post("/get/get_list_job_update.php", {}, function(data) {
        $('#get_list_job_update').html(data);
        timeago().render(document.querySelectorAll('.timeago'));
        update_readed_nt();
        get_count_read_nt();
    });
}