<?php

/** Product class
 * 
 * @property INTEGER $id unique number
 * @property String $username User name
 * @property String $password User Password
 * @property String $role User role default Cliente
 * 
 * @author Gustavo Espinoza
 * @version 1.0
 */
class User
{
    //Attributes
    private $id,
        $username,
        $password,
        $role;

    //Contructor
    /** Product class
     * 
     * @property INTEGER $id unique number
     * @property String $username User name
     * @property String $password User Password
     * @property String $role User role default Cliente
     */
    function __construct($username = null, $password = null, $id = null, $role = 'Cliente')
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }

    //Set methods

    /** Set id
     * @param INTEGER $id Unique number
     */
    public function set_id($id)
    {
        $this->id = $id;
    }

    /** Set user name
     * @param STRING $username User Name
     */
    public function set_userName($username)
    {
        $this->username = $username;
    }

    /** Set password
     * @param STRING $password User password
     */
    public function set_password($password)
    {
        $this->password = $password;
    }

    /** Set role
     * @param STRING $role User role
     */
    public function set_role($role)
    {
        $this->role = $role;
    }

    //Get methods

    /** GET id
     * @return INTEGER Unique number
     */
    public function get_id()
    {
        return $this->id;
    }

    /** GET username
     * @return String User name
     */
    public function get_userName()
    {
        return $this->username;
    }

    /** GET password
     * @return String User password
     */
    public function get_password()
    {
        return $this->password;
    }

    /** GET role
     * @return String User role
     */
    public function get_role()
    {
        return $this->role;
    }
}