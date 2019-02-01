const routes = require('../../public/js/fos_js_routes.json');
const routing = require('../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js');

routing.setRoutingData(routes);

module.exports.ajax_inscription = function() {
   
    let userName = document.getElementById('userName').value;
    let userEmail = document.getElementById('userEmail').value;
    let userPassword = document.getElementById('userPassword').value;
    let userPlainPassword = document.getElementById('userPlainPassword').value;
    let token = document.getElementById('crypt_token').value;  
    
    if(userPassword !== userPlainPassword) {
        alert("erreur password");
    }else{

        $.ajax({
            
            url: routing.generate('user_create'),
            type: "POST",
            dataType: "json",   
            async : true,
            data: JSON.stringify({userName,userEmail,userPassword,token}),
            
            success: function (data)
            {
             ;
                $("#userName").val("");
                $("#userEmail").val("");
                $("#userPassword").val("");
                $("#userPlainPassword").val("");

                
                let error_inscr = document.getElementById('error_inscr');
               
                    error_inscr.innerHTML= `<p>${data}</p>`;
                
             
                
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
                alert('Error : ' + errorThrown);
            }
        });
        return false;
    }
    
};




module.exports.ajax_log = function () {

    let userName = document.getElementById('logName').value;
    let userPassword = document.getElementById('logPassword').value;   
    let token = document.getElementById('crypt_token').value;  
    
    $.ajax({
        
        url: routing.generate('user_login'),
        type: "POST",
        dataType: "json",   
        async : true,
        data: JSON.stringify({userName,userPassword,token}),
        
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

