function validateForm(){
    var form = document.getElementById("myForm");
    var nom = document.getElementById('nom').value;
    var prenom = document.getElementById('prenom').value;
    var courriel = document.getElementById("courriel").value;
    var telephone = document.getElementById('telephone').value;
    var description = document.getElementById('description').value;
    var pattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var regName = /^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u;
    var regTel = /^[+]*[(]{0,1}[0-9]{1,3}[)]{0,1}[-\s\./0-9]*$/g;


    // NOM
    if(nom.match(regName))
    {
        myForm.classList.add("valid");
        myForm.classList.remove("invalid");
        //On valide
        textNom.innerHTML ="Votre nom est correct.";
        textNom.style.color ="#85C630"
    }else        
    {
    myForm.classList.remove("valid");
    myForm.classList.add("invalid");
    //On demande de changer ce qui est écrit
    textNom.innerHTML ="Veuillez saisir un nom valide.";
    textNom.style.color ="#9f1226";
   }
   if (nom == "")
       //Si c'est vide
       {
        myForm.classList.remove("valid");
        myForm.classList.remove("invalid");
        //On demande de remplir l'email
        textNom.innerHTML ="Veuillez compléter ce champ.";
        textNom.style.color ="#9f1226";
    }



       //PRENOM
        if(prenom.match(regName))
        {
            myForm.classList.add("valid");
            myForm.classList.remove("invalid");
            //On valide
            textPrenom.innerHTML ="Votre prénom est correct.";
            textPrenom.style.color ="#85C630"
        }else        
        {
        myForm.classList.remove("valid");
        myForm.classList.add("invalid");
   //On demande de changer ce qui est écrit
        textPrenom.innerHTML ="Veuillez saisir un nom valide.";
        textPrenom.style.color ="#9f1226";
        }
        if (prenom == "")
        //Si c'est vide
        {
         myForm.classList.remove("valid");
         myForm.classList.remove("invalid");
         textPrenom.innerHTML ="Veuillez compléter ce champ.";
         textPrenom.style.color ="#9f1226";
        }


        //EMAIL
    //Si les caractères correspondent à ce qui est attendu dans un mail:
       if (courriel.match(pattern))
       {
        myForm.classList.add("valid");
        myForm.classList.remove("invalid");
        //On valide
        textEmail.innerHTML ="Votre adresse email est valide.";
        textEmail.style.color ="#85C630";
        }
        else //A l'inverse
        {
        myForm.classList.remove("valid");
        myForm.classList.add("invalid");
        //On demande de changer ce qui est écrit
        textEmail.innerHTML ="Veuillez saisir une adresse email valide.";
        textEmail.style.color ="#9f1226";
       }

       if (courriel == "")
       //Si c'est vide
       {
        myForm.classList.remove("valid");
        myForm.classList.remove("invalid");
        textEmail.innerHTML ="Veuillez compléter ce champ.";
        textEmail.style.color ="#9f1226";
       }


       //TELEPHONE
              if (telephone.match(regTel))
              {
                  myForm.classList.add("valid");
                  myForm.classList.remove("invalid");
                  //On valide
                  textTel.innerHTML ="Ce numéro est correct";
                  textTel.style.color ="#85C630";
              }else        
              {
              myForm.classList.remove("valid");
              myForm.classList.add("invalid");
         //On demande de changer ce qui est écrit
              textTel.innerHTML ="Veuillez saisir un numéro de téléphone valide.";
              textTel.style.color ="#9f1226";
              }

              if (telephone == "")
              //Si c'est vide
              {
               myForm.classList.remove("valid");
               myForm.classList.remove("invalid");
               
               textTel.innerHTML ="Veuillez compléter ce champ.";
               textTel.style.color ="#9f1226";
              }

              if (description == "")
              //Si c'est vide
              {
               myForm.classList.remove("valid");
               myForm.classList.remove("invalid");
               
               textMess.innerHTML ="Veuillez compléter ce champ.";
               textMess.style.color ="#9f1226";
              }else        
              {
                myForm.classList.add("valid");
                myForm.classList.remove("invalid");
                textMess.innerHTML ="Description completée.";
                textMess.style.color ="#85C630";
              }


  } 

  