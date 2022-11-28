

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


function reserva(id){
    const formdata = new FormData();
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


