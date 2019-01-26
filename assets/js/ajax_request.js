function ajax_delete_task(e, id){
e.preventDefault();
that = $(this);
$.ajax({
    url:'{{ path("task_delete") }}',
    type: "POST",
    dataType: "json",
    data: {
        "id": "that.id"
    },
    async: true,
    success: function (data)
    {
        console.log(data)
        $('div#ajax-results').html(data.output);

    }
});
return false;

}