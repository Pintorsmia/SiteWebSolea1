

function getMessages(){
        const requeteAjax = new XMLHttpRequest();
        console.log(requeteAjax);
        requeteAjax.open("GET", "popIn.php")

        requeteAjax.onload = function(){
            const resultat = JSON.parse(requeteAjax.responseText);
            console.log(resultat);
            if(resultat.option=="vide"){
               // document.getElementById("myModal").style.display = "none";
                modal.style.display = "none";
            }else{
                const html = resultat.map(function(message){     
                    nomcli.innerHTML ="Client : Mr/Mme " + message.nom + " " + message.prenom;
                    numcli.innerHTML ="Numero : " + message.numero;
					addrcli.innerHTML ="Adresse : " + message.adresse;
					raisoncli.innerHTML ="Raison : " + message.raison;
                   // buttoncli.onclick = STOP(message.id);
                    modal.style.display = "block";
        
                
            })
            
            const messages = document.querySelector('.messages');

            messages.innerHTML = html;
   
        }
        
        }
        requeteAjax.send();
        //const interval = window.setInterval(getMessages(),100000);
        //window.clearInterval(timeout);
   
    
}

function STOP(id){
    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open("DELETE", "http://10.1.3.251:8088/ari/channels/" + id + "?api_key=asterisk:asterisk");
    requeteAjax.send();
}

function Timer(){
    const interval = window.setInterval(getMessages,3000);
}
Timer();