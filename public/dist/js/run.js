// validate
$.validator.setDefaults({
	highlight: function(element){
		$(element)
		.closest(".form-control")
		.addClass("is-invalid")
	},
	unhighlight: function(element) {
		$(element)
		.closest(".form-control")
		.removeClass("is-invalid")
		.addClass("is-valid")
	}
}) 

const sweetAlert = function(message,type,time=2500){
	Swal.fire({
		position: 'center',
		icon: type,
		title: message,
		showConfirmButton: false,
		timer: time
		}) 
}

const bodyBlock = function(){
	 
}

const bodyloadNoBlock = function(){
	 
}

// submit delete

function FormDelete(text,msm,event){
	 
	 
	 console.log(event)
	 event.preventDefault();
	Swal.fire({
		title: msm,
		text: "¡No podrás revertir esto!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Si, Borralo'
	}).then((result) => {
		if (result.isConfirmed) { 
			javascript:document.getElementById('formdelete' + text).submit();
			return false; 
		}
	})
}
		

function FormDeleteModal(text,msm,event){
	 var form = document.getElementById('formdelete' + text)
	 document.body.appendChild(form);
	 console.log("----")
	console.log(form)
	event.preventDefault();
   Swal.fire({
	   title: msm,
	   text: "¡No podrás revertir esto!",
	   icon: 'warning',
	   showCancelButton: true,
	   confirmButtonColor: '#3085d6',
	   cancelButtonColor: '#d33',
	   confirmButtonText: 'Si, Borralo'
   }).then((result) => {
	   if (result.isConfirmed) { 
		   form.submit();
		   return false; 
	   }
   })
}