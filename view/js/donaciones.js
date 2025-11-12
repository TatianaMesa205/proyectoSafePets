
  const forms = document.querySelectorAll('#formRegistroDonacion');
  Array.from(forms).forEach(form=>{
      form.addEventListener('submit',event=>{
          event.preventDefault();
          if(!form.checkValidity()){
              event.stopPropagation();
              form.classList.add('was-validated');
          }else{
              
              // 1. Solo necesitamos el monto
              let monto = document.getElementById('txt_monto').value;
              
              // 2. Preparamos el objeto solo con el monto
              let objData = { "monto": monto };
              
              // 3. Llamamos a la clase (que ahora redirige a Stripe)
              let obj = new Donaciones(objData);
              obj.registrarDonacion(); 
          }
      },false);
  });