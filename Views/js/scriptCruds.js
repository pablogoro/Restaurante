window.addEventListener('load',function (e){
    listar('')
    document.getElementById('select').addEventListener('change', function (e){
      listar('')
    })
    var buscar=document.getElementById(`buscar`)
    buscar.addEventListener("keyup", () => {
        const filtro = buscar.value;
        if (filtro == "") {
            listar('');
        }else{
            listar(filtro);
        }
    });

    document.getElementById('logOut').addEventListener('click', function (){
        Swal.fire({
            title: 'CERRAR SESION',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Cerrada!',
                    'success'
                )
                window.location.href="../index.php"
            }



        })


    })
    document.getElementById('registrar').addEventListener('click',crearForm)


    //modal


            // Get the modal
            var modal = document.getElementById("myModal");

        // Get the button that opens the modal
            var btn = document.getElementById("registrar");
        // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
            btn.onclick = function() {
                modal.style.display = "block";
            }

        // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }

        // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
})


function listar (filtro){
    let resultado = document.getElementById("resultado");
    let usuario = document.getElementById('select').value
    let formdata = new FormData();
    formdata.append('filtro',filtro);
    formdata.append('user',usuario);

    const ajax = new XMLHttpRequest();
    ajax.open('POST','../Controller/listar.php');
    ajax.onload= function (){
        if(ajax.status == 200){
            resultado.innerHTML = ajax.responseText;
        }else{
            resultado.innerText = 'Error';
        }
    }
    ajax.send(formdata);
}

function crearForm(){
    let usuario = document.getElementById('select').value
    const formdata= new FormData();
    formdata.append('user',usuario);
    const ajax = new XMLHttpRequest();
    ajax.open("POST","../Controller/crearformcontroller.php");
    ajax.onload = function(){
        if(ajax.status === 200){
            const div=document.getElementById('form-crear')
                div.innerHTML=ajax.responseText;
        }
    };
    ajax.send(formdata);
}

function crear(e){


    document.getElementById('form-crear').addEventListener('submit',function (e){
        e.preventDefault()
    })
    const form=document.getElementById('form-crear')
    const img=document.getElementById('img').value
    const formdata= new FormData(form);
    formdata.append('img',img);
    const ajax = new XMLHttpRequest();
    ajax.open("POST","../Controller/crearcontroller.php");
    ajax.onload = function(){
        listar('');
        if (ajax.responseText=="camposVacios"){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Tienes campos vacios!',
            })
        } else if(ajax.responseText=="OK"){
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Your work has been saved',
                showConfirmButton: false,
                timer: 1500

            })



        }else if (ajax.responseText==="falseCreate"){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'No se pudo crear el registro!',
            })

        }else if (ajax.responseText=="usuarioExiste"){
            console.log('hola')
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'El usuario ya existe!',
            })
        }else if (ajax.responseText=="contraseña"){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Las constraseñas no coinciden!',
            })
        }else if (ajax.responseText=="formato"){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'formato de imagen no válido!',
            })
        }

    };
    ajax.send(formdata);
}


function FormEditar(id) {
    var user=document.getElementById('user')
    let   buttons= document.getElementsByClassName('editar')
    let   buttons2= document.getElementsByClassName('editar2')

    if (user.value=="mesas"){

        for (let i=0 ; i<buttons2.length; i++){

            buttons2[i].addEventListener('click',function (e){
                e.preventDefault()
                let modal2 = document.getElementById("myModal3");


                // Get the button that opens the modal
                let btn = e.target
                // Get the <span> element that closes the modal
                let span = document.getElementsByClassName("close");

                // When the user clicks the button, open the modal
                btn.onclick = function() {
                    modal2.style.display = "block";

                }
                // When the user clicks on <span> (x), close the modal
                for(let i=0 ; i<span.length; i++) {
                    span[i].onclick = function () {
                        modal2.style.display = "none";

                    }
                }
                // When the user clicks anywhere outside of the modal, close it
                window.onclick = function(event) {
                    if (event.target == modal2) {
                        modal2.style.display = "none";
                    }
                }


            })

    }}else{
        for (let i=0 ; i<buttons.length; i++){

            buttons[i].addEventListener('click',function (e){
                e.preventDefault()
                let modal = document.getElementById("myModal2");


                // Get the button that opens the modal
                let btn = e.target
                // Get the <span> element that closes the modal
                let span = document.getElementsByClassName("close");

                // When the user clicks the button, open the modal
                btn.onclick = function() {
                    modal.style.display = "block";

                }
                // When the user clicks on <span> (x), close the modal
                for(let i=0 ; i<span.length; i++) {
                    span[i].onclick = function () {
                        modal.style.display = "none";

                    }
                }
                // When the user clicks anywhere outside of the modal, close it
                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }


            })
    }

}

rellenarEditar(id,user)
}

function rellenarEditar(id, user){
    var formdata = new FormData();
    formdata.append('id', id);
    formdata.append('user', user.value);
    var ajax = new XMLHttpRequest();
    ajax.open('POST', '../Controller/rellenareditar.php');
    ajax.onload = function() {
        if (ajax.status == 200) {
            if (user.value=="mesas"){
                var json = JSON.parse(ajax.responseText);
                document.getElementById('id2').value = json.Id_mesa;
                document.getElementById('capacidad').value = json.capacidad;
                document.getElementById('estado').value = json.estado;
                document.getElementById('sala').value = json.sala;
            }else{
                var json = JSON.parse(ajax.responseText);
                document.getElementById('id').value = json.id;
                document.getElementById('nombre').value = json.nombre;
                document.getElementById('apellido').value = json.apellido;
                document.getElementById('dni').placeholder = json.dni;
                document.getElementById('email').value = json.email;
                document.getElementById('telf').value = json.telf;


            }

        }
    }
    ajax.send(formdata);

}

function editar(){
    var user=document.getElementById('user')

   const id =  document.getElementById('id').value;
   const id2 =  document.getElementById('id2').value;
   const nombre= document.getElementById('nombre').value;
   const apellido=document.getElementById('apellido').value;
   const dni=document.getElementById('dni').value
    const email=document.getElementById('email').value;
    const telf =document.getElementById('telf').value;
    const cap=document.getElementById('capacidad').value;
    const estado=document.getElementById('estado').value;
    const sala=document.getElementById('sala').value;
    const img=document.getElementById('img').value;

    var formdata = new FormData();
    formdata.append('id', id);
    formdata.append('id2', id2);
    formdata.append('nombre', nombre);
    formdata.append('apellido', apellido);
    formdata.append('dni', dni);
    formdata.append('email', email);
    formdata.append('telf', telf);
    formdata.append('user', user.value);
    formdata.append('cap', cap);
    formdata.append('estado', estado);
    formdata.append('sala', sala);
    formdata.append('img', img);
    var ajax = new XMLHttpRequest();
    ajax.open('POST', '../Controller/editar.php');
    ajax.onload = function() {
    alert(ajax.responseText)
        if (ajax.status == 200) {

            if (ajax.responseText=="camposVacios"){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Tienes campos vacios!',
                })
            } else if(ajax.responseText=="OK"){
                listar('');
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 1500

                })



            }else if (ajax.responseText==="falseCreate"){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'No se pudo crear el registro!',
                })

            }else if (ajax.responseText=="usuarioExiste"){
                console.log('hola')
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'El usuario ya existe!',
                })
            }


        }
    }
    let modal=document.getElementById('myModal')
    let modal2 = document.getElementById("myModal2");
    modal.style.display = "none";
    modal2.style.display = "none";
    ajax.send(formdata);


}

function confborrar(id){
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            borrar(id)

        }
    })

}

function borrar(id){
    let usuario = document.getElementById('select').value
    var formdata = new FormData();
    formdata.append('id', id);
    formdata.append('user', usuario);
    var ajax = new XMLHttpRequest();
    ajax.open('POST', '../Controller/borrar.php');
    ajax.onload = function() {
        alert(ajax.responseText)
        if (ajax.status == 200) {
            if (ajax.responseText=='ok'){
                listar('')
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }else{
                alert('mal')
            }

        }
    }

    ajax.send(formdata);


}
