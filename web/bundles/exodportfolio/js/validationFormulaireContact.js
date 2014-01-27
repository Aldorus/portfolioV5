function validationContact(){
	var formulaire = document.forms['formulaireContact'];
	var nom = formulaire.nom.value;
	var email = formulaire.email.value;
	var message = formulaire.message.value;
	
	if(nom!="" && email!="" && message!=""){
		envoiDonneeContact(nom,email,message);
	}else{
		$('#messageContact').html("Il manque des informations");
		$('#messageContact').css("color","red");
		return false;
	}
}

function envoiDonneeContact(nom,email,message){
	//get the url for the form
	var url=$("#formulaireContact").attr("action");
	
	//start send the post request
	$.ajax({
		  type: "POST",
		  url: url,
		  data: {
			nom: nom,
			email: email,
			message : message
		  }
	}).done(function( msg ) {
		var data = JSON.parse(msg);
		
		 if(data.responseCode==200 ){           
	    	$('#output').html(data.returnback);
	    	$('#output').css("color","red");
	    }
	    else if(data.responseCode==400){//bad request
	    	$('#output').html(data.returnback);
	    	$('#output').css("color","red");
	    }
	});
  return false;
}



function testChampContact(dirChamps){
	var formulaire = document.forms['formulaireContact'];
	
	if(dirChamps=="nom"){
		var champ = formulaire.nom.value;
		if(isEmpty(champ)){
			formulaire.nom.style.background="#FF9696";
		}else{
			formulaire.nom.style.background="white";
			$('#output').html("");
		}
	}else if(dirChamps=="message"){
		var champ = formulaire.message.value;
		if(isEmpty(champ)){
			formulaire.message.style.background="#FF9696";
		}else{
			formulaire.message.style.background="white";
			$('#output').html("");
		}
	}else if(dirChamps=="email"){
		var champ = formulaire.email.value;
		if(isEmpty(champ)){
			formulaire.email.style.background="#FF9696";
		}else{
			formulaire.email.style.background="white";
			$('#output').html("");
		}
	}
}
