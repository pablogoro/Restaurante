<?php

Interface IUser
{
    public function create( $nombre, $apellido, $dni, $telf, $password, $email);
    public function delete( int $id);

}