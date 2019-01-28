const routes = require('../../public/js/fos_js_routes.json');
const routing = require('../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js');
    

module.exports.ajax_delete_task = function (id) {
    
    
    target = $(this);
    routing.setRoutingData(routes);
    
    
    $.ajax({
        url: routing.generate('task_delete',{ 'id': id}),
        type: "POST",
        dataType: "json",
        data: {
            "id": id
        },
       
        success: function (data)
        {
            alert(data);
            target.remove();
           
            
        },
        error : function(resultat, statut, erreur, request){
            
        }
    });
    return false;
    
    
};