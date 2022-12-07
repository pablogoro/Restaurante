

window.addEventListener("load", (event) => {


   var submit= document.getElementById('submit')
        if (submit){
            submit.addEventListener("click",function(ev) {
                ev.preventDefault();
                console.log(submit);
                console.log('hola');
                const form= document.getElementById('signup');
                console.log(form);
                const formdata= new FormData(form);

                const ajax = new XMLHttpRequest();
                ajax.open("POST","../Controller/singupcontroller.php");
                ajax.onload = function(){
                    if(ajax.status === 200){
                        if (ajax.responseText=="camposVacios"){
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Tienes campos vacios!',
                            })
                        } else if(ajax.responseText=="OK"){
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'No se pudo crear el registro!',
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
                        }
                    }
                }
                ajax.send(formdata)

            });
        }


   var select = document.getElementById('sala')
   var date = document.getElementById('date')
    var time= document.getElementById('time')


    if (select){
        select.addEventListener('change', function (ev){
          sala(select,date,time)

        })
    }
    if (date){
        date.addEventListener('change',function (ev){
            sala(select,date,time)


        })
    }
    if (time){
        time.addEventListener('change',function (ev){
            sala(select,date,time)


        })
    }






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


})
function crearReserva(mesa){
    var form= document.getElementById('formreserva')
    const formdata = new FormData(form);
    var select = document.getElementById('sala')
    var date = document.getElementById('date')
    var time= document.getElementById('time')
    var ocu= document.getElementById('ocu')
    const sala= select.value
    const dia=date.value
    const tiempo= time.value
    formdata.append('mesa',mesa);
    formdata.append('dia',dia);
    formdata.append('tiempo',tiempo);
    formdata.append('ocu',ocu.value);
    const ajax = new XMLHttpRequest();
    ajax.open("POST","../Controller/crearReservaController.php");
    ajax.onload = function(){
        if(ajax.status === 200){

            if (ajax.responseText=="mal"){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Fecha o dia introducidos no válidos!',
                })
                console.log(ajax.responseText)
            }else if (ajax.responseText=="bien"){
                reserva(mesa)
                sala2(sala,dia,tiempo)
                function sala2(select,date,time){
                    const formdata = new FormData();
                    formdata.append('id',select);
                    formdata.append('dia',date);
                    formdata.append('tiempo',time);
                    const ajax = new XMLHttpRequest();
                    ajax.open("POST","../Controller/salacontroller.php");
                    ajax.onload = function(){
                        if(ajax.status === 200){

                            document.getElementById('contenedor').innerHTML= ajax.responseText

                        }
                    };

                    ajax.send(formdata);

                }
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 1500
                })
            }else{
                if (ajax.responseText=="ocu"){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Valor de ocupacón incorrecto!',
                    })
                }else{

                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    })
                }

            }


        }
    };
    ajax.send(formdata);
}


function reserva(id){
    var select = document.getElementById('sala')
    var date = document.getElementById('date')
    var time= document.getElementById('time')
    const sala= select.value
    const dia=date.value
    const tiempo= time.value
    const formdata = new FormData();
    formdata.append('id',sala);
    formdata.append('dia',dia);
    formdata.append('tiempo',tiempo);
    formdata.append('id',id);
    const ajax = new XMLHttpRequest();
    ajax.open("POST","../Controller/mesacontroller.php");
    ajax.onload = function(){
        if(ajax.status === 200){

                document.getElementById('info-box').innerHTML= ajax.responseText

        }

    };
    ajax.send(formdata);
}
function sala(select,date,time){
    const sala= select.value
    const dia=date.value
    const tiempo= time.value
    const formdata = new FormData();
    formdata.append('id',sala);
    formdata.append('dia',dia);
    formdata.append('tiempo',tiempo);
    const ajax = new XMLHttpRequest();
    ajax.open("POST","../Controller/salacontroller.php");
    ajax.onload = function(){
        if(ajax.status === 200){

                document.getElementById('contenedor').innerHTML= ajax.responseText

        }
    };
    ajax.send(formdata);

}

function cerrar(id){
    console.log(id)
    var select = document.getElementById('sala')
    var date = document.getElementById('date')
    var time= document.getElementById('time')
    const sala= select.value
    const dia=date.value
    const tiempo= time.value
    const formdata = new FormData();
    formdata.append('idM',id);
    formdata.append('id',sala);
    formdata.append('dia',dia);
    formdata.append('tiempo',tiempo);
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
            const ajax = new XMLHttpRequest();
            ajax.open("POST","../Controller/cerrarresrevacontroller.php");
            ajax.onload = function(){
                if(ajax.status === 200){
                    if (ajax.responseText == "ok"){
                        reserva(id)
                    }else{

                    }
                }
            };
            sala2(sala,dia,tiempo)
            function sala2(select,date,time){
                const formdata = new FormData();
                formdata.append('id',select);
                formdata.append('dia',date);
                formdata.append('tiempo',time);
                const ajax = new XMLHttpRequest();
                ajax.open("POST","../Controller/salacontroller.php");
                ajax.onload = function(){
                    if(ajax.status === 200){

                        document.getElementById('contenedor').innerHTML= ajax.responseText

                    }
                };
                ajax.send(formdata);

            }
            ajax.send(formdata);

            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'

            )
        }
    })


}


