const routes = require('../../public/js/fos_js_routes.json');
const routing = require('../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js');

routing.setRoutingData(routes);

module.exports.ajax_delete_task = function (id) {

    

    if (confirm('Etes vous sûr de vouloir supprimer la tâche ?')){
        let token = document.getElementById('crypt_token').value;
        $.ajax({
            
            url: routing.generate('task_delete'),
            type: "POST",
            dataType: "json",   
            async : true,
            data: JSON.stringify({id, token}),
            
            success: function (id)
            {
                
                let component_to_destroy = document.getElementById(`task_id_${id}`);
                /* component_to_destroy.classList.add('removed-item'); */
                // remove clicked element
                $('.grid').masonry( 'remove', component_to_destroy )
                // layout remaining item elements
                .masonry('layout');
                
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
                alert('Error : ' + errorThrown);
            }
        });
        return false;
        
    } 
};

module.exports.open_form_update_task = function (id) {
    
    
    let form_to_open = document.getElementById(`form_update_${id}`);
    
    form_to_open.classList.toggle('opened');
    
    
    
    
};

module.exports.ajax_update_task = function (id) {
    
    if (confirm('Etes vous sûr de vouloir mettre à jour la tâche ?')){
        let token = document.getElementById('crypt_token').value;
        let taskname = document.getElementById(`taskName_${id}`).value;
        let taskDueDate = document.getElementById(`taskDueDate_${id}`).value;   
        
        
        $.ajax({
            
            url: routing.generate('task_update'),
            type: "POST",
            dataType: "json",   
            async : true,
            data: JSON.stringify({id, taskname,taskDueDate,token}),
            
            success: function (data)
            {
                $(`#taskName_${data['id']}`).val('');
                $(`#taskDueDate_${data['id']}`).val('');
                let taskname_container = document.getElementById(`taskeName_container_${id}`);
                let taskDueDate_container = document.getElementById(`taskeDueDate_container_${id}`);   
                
                taskname_container.innerHTML = data['taskname'];
                taskDueDate_container.innerHTML = data['taskDueDate'];
                
                
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
                alert('Error : ' + errorThrown);
            }
        });
        return false;
        
    }
    
};


module.exports.open_form_create_task = function () {
    
    
    let form_to_open = document.getElementById(`form_create`);
    
    form_to_open.classList.toggle('opened');
    
    
    
    
};

module.exports.ajax_create_task = function () {
    let taskname = document.getElementById('taskNameCreate').value;
    let taskDueDate = document.getElementById('taskDueDateCreate').value;   
    
    
    $.ajax({
        
        url: routing.generate('task_create'),
        type: "POST",
        dataType: "json",   
        async : true,
        data: JSON.stringify({taskname,taskDueDate}),
        
        success: function (data)
        {
            
            $('#taskNameCreate').val("");
            $('#taskDueDateCreate').val("");
            let taskname = data['taskname'];
            let taskDueDate = data['taskDueDate'];
            let id = data['id'];
            const path_close = data['close'];
            const path_update = data['update'];
            
            const $items = $(`<div id="task_id_${id}" class="grid-item col-4 mt-5 contain-task">
            <p class="controller-task update" onclick="ajax_request.open_form_update_task(${id})">
            <img  src="${path_update}"></p>
            <p class="controller-task delete" onclick="ajax_request.ajax_delete_task(${id})">
            <img  src="${path_close}"></p>
            <div class="col-12 task d-flex flex-column align-items-center">
            <h2 id="taskeName_container_${id}" class="text-center">${taskname}</h2>
            <span id="taskeDueDate_container_${id}">${taskDueDate}</span></div>
            <div id="form_update_${id}" class="col-12 form_update">
            <input type="text" id="taskName_${id}" name="task[task]_${id}" required="required" maxlenght="20" class="listTask" placeholder="Nom de la tache">
            <input type="date" id="taskDueDate_${id}" name="task[dueDate]_${id}" required="required" value="2019-01-30">
            <button type="submit" id="task_update_btn_${id}" name="task[save]_${id}" onclick="ajax_request.ajax_update_task(${id})">Update Task</button></div></div>`);
            
            $('.grid').prepend( $items )
            // add and lay out newly prepended items
            .masonry( 'prepended', $items );
            
        },
        error : function(XMLHttpRequest, textStatus, errorThrown){
            alert('Error : ' + errorThrown);
        }
    });
    return false;
    
}

