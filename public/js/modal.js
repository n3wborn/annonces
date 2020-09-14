$(document).ready(function(){
	$(".launch-modal").click(function(){
		$("#myModal").modal({
			backdrop: 'static'
		});
	}); 
});

// DELETE BUTTON

const deleteLinks = document.getElementsByClassName('btn_delete');

for (deleteLink of deleteLinks){
    //Affecte l'évenement click 
    //Sur clic executera une fonction sans nom dite anonyme
    deleteLink.addEventListener('click', function(e){
        e.preventDefault();
    
    //Selectionne l'élement ayant l'id modal
    const modal = document.getElementById('modal');
	modal.classList.remove('hidden');
	
	window.setTimeout("location=('/');",2000);
});
}
