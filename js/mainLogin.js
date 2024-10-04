const signInBtn = document.getElementById("signIn");
const signUpBtn = document.getElementById("signUp");
const fistForm = document.getElementById("form1");
const secondForm = document.getElementById("form2");
const container = document.querySelector(".container");

/* signInBtn.addEventListener("click", () => {
	container.classList.remove("right-panel-active");
});
signUpBtn.addEventListener("click", () => {
	container.classList.add("right-panel-active");
}); 
fistForm.addEventListener("submit", (e) => e.preventDefault());
secondForm.addEventListener("submit", (e) => e.preventDefault()); */


$(document).ready(function() {
    $('#btnLogin').click(function() { 
		login();
    });
	document.getElementById('password').addEventListener('keydown', function(event) {
		if (event.key === 'Enter') {
			login();  
		}
	});
});
function login(){
	datos = '&u_=' + $('#usuario').val()+'&p_=' + $('#password').val(); 
		$.ajax({
            async: true,
            type: "POST",
            dataType: "html",
            contentType: "application/x-www-form-urlencoded",
            url: "../php/login.php",
            data: datos,
            beforeSend: function () {  
            },
            success: function (e) {   
                dat = $.parseJSON(e);
                if(dat.obs == ''){  
                    var url = 'index.php';
                    /* var url = 'biblioteca.php'; 
                    if(dat.rol == 'JEFATURA')
                        url = 'home.php';   */
					window.location.href = url;
                }else{ 
					$('#err').html(dat.obs); 
                }
            },
            timeout: 16000,
            error: function () {
            }
        });

}