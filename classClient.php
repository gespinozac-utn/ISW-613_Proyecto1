<?php
class Client
{
    //Attributes
    private $id,
        $idUsuario,
        $name,
        $email,
        $phone,
        $address;

    //Contructor
    function __construct($name = null, $email = null, $phone = null, $address = null, $idUsuario = null, $id = null)
    {
        $this->id = $id;
        $this->idUsuario = $idUsuario;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
    }

    //Set methods
    public function set_id($id)
    {
        $this->id = $id;
    }
    public function set_idUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }
    public function set_name($name)
    {
        $this->name = $name;
    }
    public function set_email($email)
    {
        $this->email = $email;
    }
    public function set_phone($phone)
    {
        $this->phone = $phone;
    }
    public function set_address($address)
    {
        $this->address = $address;
    }

    //Get methods
    public function get_id()
    {
        return $this->id;
    }
    public function get_idUsuario()
    {
        return $this->idUsuario;
    }
    public function get_name()
    {
        return $this->name;
    }
    public function get_email()
    {
        return $this->email;
    }
    public function get_phone()
    {
        return $this->phone;
    }
    public function get_address()
    {
        return $this->address;
    }
}