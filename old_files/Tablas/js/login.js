function mostrar(){
    document.getElementById('log-error').style.display = 'block';
    }

    function log(form) {
    if (form.usr.value=="user") { 
        if (form.pass.value=="pass") {              
            //location="file:///C:/Users/Cristian%20Mejia/Desktop/Proyecto/page1.html" 
            open("file:///C:/Users/Cristian%20Mejia/Desktop/Proyecto/page1.html")
            
            alert("Correct")
            
            

        } else {
            mostrar()
            alert("Invalid Password")
    
        }
        } else {  
            mostrar()
            alert("Invalid UserID")
        //setTimeout("alert('Hola Mama!')",2000)
      }
    }