const routes = require('../../public/js/fos_js_routes.json');
const routing = require('../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js');

routing.setRoutingData(routes);

module.exports.ajax_inscription = function (id) {
   
    let userName = document.getElementById('userName').value;
    let userEmail = document.getElementById('userEmail').value;
    let userPassword = document.getElementById('userPassword').value;
    let userPlainPassword = document.getElementById('userPlainPassword').value;

    if(userPassword !== userPlainPassword) {
        alert("erreur password");
    }

        $.ajax({
            
            url: routing.generate('user_create'),
            type: "POST",
            dataType: "json",   
            async : true,
            data: JSON.stringify({userName,userEmail,userPassword}),
            
            success: function (id)
            {
                
               // say ok to inscription and ask people to log in
                
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
                alert('Error : ' + errorThrown);
            }
        });
        return false;
        
    
};




module.exports.ajax_log = function () {
    let userName = document.getElementById('userName').value;
    let userPassword = document.getElementById('userPassword').value;   
    
    
    $.ajax({
        
        url: routing.generate('user_log'),
        type: "POST",
        dataType: "json",   
        async : true,
        data: JSON.stringify({userName,userPassword}),
        
        success: function (data)
        {
            
            // Faire apparaitre la liste des tâches
          
        },
        error : function(XMLHttpRequest, textStatus, errorThrown){
            alert('Error : ' + errorThrown);
        }
    });
    return false;
    
}

