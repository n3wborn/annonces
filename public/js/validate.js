function validateForm(){
    // var nom = document.getElementById("myForm");
    // if (nom == "") {
    //   alert("Le nom doit être renseigné");
    //   return false;
    // }

    // var prenom = document.getElementById["myForm"]["prenom"].value;
    // if (prenom == "") {
    //   alert("Le prénom doit être renseigné");
    //   return false;
    // }

    // var courriel = document.getElementById["myForm"]["courriel"].value;
    // if (courriel == "") {
    //   alert("L'e-mail doit être renseigné");
    //   return false;
    // }

    // var telephone = document.getElementById["myForm"]["telephone"].value;
    // if (telephone == "") {
    //   alert("Le téléphone doit être renseigné");
    //   return false;
    // }
    var form = document.getElementById("myForm");
    var courriel = document.getElementById("courriel").value;
    var pattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;;
       if (courriel.match(pattern))
       {
        myForm.classList.add("valid");
        myForm.classList.remove("invalid");
        text.innerHTML ="Votre adresse email est valide.";
        text.style.color ="#85C630";
        }
        else
        {
        myForm.classList.remove("valid");
        myForm.classList.add("invalid");
        text.innerHTML ="Veuillez saisir une adresse email valide.";
        text.style.color ="#9f1226";
       }

       if (courriel == "")
       {
        myForm.classList.remove("valid");
        myForm.classList.remove("invalid");
        text.innerHTML ="Veuillez compléter ce champ.";
        text.style.color ="#9f1226";
       }


    // var description = document.getElementById["myForm"]["description"].value;
    // if (description == "") {
    //   alert("Vous devez ajouter un texte à l'annonce");
    //   return false;
    // }

  } 