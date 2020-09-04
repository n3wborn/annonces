  var onloadCallback = function() {
    alert("grecaptcha is ready!");
  };

  window.onload = function() {
    var $recaptcha = document.querySelector('#g-recaptcha');

    if($recaptcha) {
        $recaptcha.setAttribute("required", "required");
    }
};
