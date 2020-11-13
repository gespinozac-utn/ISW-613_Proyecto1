<?php

/** Product class
 * 
 * @property INTEGER $id unique number
 * @property INTEGER $idUsuario Unique number of user
 * @property String $name Name
 * @property String $email Email Adress
 * @property String $phone phone number
 * @property String $Address Adress
 * 
 * @author Gustavo Espinoza
 * @version 1.0
 */
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
    /** Product class
     * 
     * @property INTEGER $id unique number
     * @property INTEGER $idUsuario Unique number of user
     * @property String $name Name of the client
     * @property String $email Email Adress
     * @property String $phone phone number
     * @property String $Address Adress
     */
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

    /** Set id
     * @param INTEGER $id Unique Number
     */
    public function set_id($id)
    {
        $this->id = $id;
    }

    /** Set id Usuario
     * @param STRING $idUsuario Id for user
     */
    public function set_idUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    /** Set name
     * @param STRING $name name
     */
    public function set_name($name)
    {
        $this->name = $name;
    }

    /** Set SemailKU
     * @param STRING $email Email adress
     */
    public function set_email($email)
    {
        $this->email = $email;
    }

    /** Set phone
     * @param STRING $phone phone number
     */
    public function set_phone($phone)
    {
        $this->phone = $phone;
    }

    /** Set address
     * @param STRING $address address
     */
    public function set_address($address)
    {
        $this->address = $address;
    }

    //Get methods

    /** GET id
     * @return INTEGER id
     */
    public function get_id()
    {
        return $this->id;
    }

    /** GET idUsuario
     * @return String id for user
     */
    public function get_idUsuario()
    {
        return $this->idUsuario;
    }

    /** GET name
     * @return String name
     */
    public function get_name()
    {
        return $this->name;
    }

    /** GET email
     * @return String email adress
     */
    public function get_email()
    {
        return $this->email;
    }

    /** GET phone
     * @return String phone number
     */
    public function get_phone()
    {
        return $this->phone;
    }

    /** GET Stock-keeping unit code
     * @return address Stock-keeping unit code
     */
    public function get_address()
    {
        return $this->address;
    }
}