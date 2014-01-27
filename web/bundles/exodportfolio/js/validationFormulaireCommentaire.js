function validationCommentaire(){
	var formulaire = document.forms['formulaireCommentaire'];
	var nom = formulaire.nom.value;
	var email = formulaire.email.value;
	var message = formulaire.message.value;
	var idarticle = formulaire.idarticle.value;
	
	if(nom!="" && email!="" && message!="" && idarticle!=""){
		envoiDonnee(nom,email,message,idarticle);
	}else{
		$('#output').html("Il manque des informations");
		$('#output').css("color","red");
		return false;
	}
}

function envoiDonnee(nom,email,message,idarticle){
	//get the url for the form
	var url=$("#formulaireCommentaire").attr("action");
	
	//start send the post request
	$.ajax({
		  type: "POST",
		  url: url,
		  data: {
			nom: nom,
			email: email,
			message : message,
			idarticle : idarticle
		  }
	}).done(function( msg ) {
		var data = JSON.parse(msg);
		
		 if(data.responseCode==200 ){           
	    	$('#output').html(data.returnback);
	    	$('#output').css("color","red");
	    	construireNouveauCom(nom,email,message);
	    }
	    else if(data.responseCode==400){//bad request
	    	$('#output').html(data.returnback);
	    	$('#output').css("color","red");
	    }
	});
  return false;
}

function construireNouveauCom(nom,email,message){
	if(!($('#empty') === undefined )){
		$('#empty').hide();
	}
		
	var block = document.getElementById('commentaireLigne');
	
	var commentaireArticle = document.createElement('div');
	var strong = document.createElement('strong');
	var date = new Date();
	var month =date.getMonth()+1;
	strong.innerHTML = date.getDate()+"/"+month+"/"+date.getFullYear()+" - Par "+nom ;
	var p = document.createElement('p');
	p.innerHTML = message;
	commentaireArticle.appendChild(strong);
	commentaireArticle.appendChild(p);
	
	block.insertBefore(commentaireArticle);
}

function testChamp(dirChamps){
	var formulaire = document.forms['formulaireCommentaire'];
	
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
