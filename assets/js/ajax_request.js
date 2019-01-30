const routes = require('../../public/js/fos_js_routes.json');
const routing = require('../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js');

routing.setRoutingData(routes);

module.exports.ajax_delete_task = function (id) {
    if (confirm('Etes vous sûr de vouloir supprimer la tâche ?')){
        $.ajax({
            
            url: routing.generate('task_delete'),
            type: "POST",
            dataType: "json",   
            async : true,
            data: JSON.stringify(id),
            
            success: function (id)
            {
                
                let component_to_destroy = document.getElementById(`task_id_${id}`);
                component_to_destroy.classList.add('removed-item');
                
                setTimeout(function(){ 
                    component_to_destroy.remove();
                    
                }, 5000);   
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
                alert('Error : ' + errorThrown);
            }
        });
        return false;
        
    } 
};

module.exports.open_form_task = function (id) {
    
    
    let form_to_open = document.getElementById(`form_update_${id}`);
    
    form_to_open.classList.toggle('opened');
    
    
    
};

module.exports.ajax_update_task = function (id) {
    
    if (confirm('Etes vous sûr de vouloir mettre à jour la tâche ?')){
        
        let taskname = document.getElementById(`taskName_${id}`).value;
        let taskDueDate = document.getElementById(`taskDueDate_${id}`).value;   
        
        
        $.ajax({
            
            url: routing.generate('task_update'),
            type: "POST",
            dataType: "json",   
            async : true,
            data: JSON.stringify({id, taskname,taskDueDate}),
            
            success: function (data)
            {
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