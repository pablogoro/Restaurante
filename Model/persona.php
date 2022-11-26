<?php

abstract class Persona
{
    protected $id;
    protected $nombre;
    protected $apellido;
    protected $Dni;
    protected $telf;
    protected $password;

    /**
     * @param $id
     * @param $nombre
     * @param $apellido
     * @param $Dni
     * @param $telf
     * @param $password
     */
    public function __construct($id, $nombre, $apellido, $dni, $telf, $password)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->Dni = $dni;
        $this->telf = $telf;
        $this->password = $password;
    }

}
