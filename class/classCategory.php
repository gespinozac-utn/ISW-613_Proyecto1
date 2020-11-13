<?php

/** Product class
 * 
 * @property String $name Name
 * @property String $parent Parent Name
 * @property INTEGER $id unique number
 * 
 * @author Gustavo Espinoza
 * @version 1.0
 */
class Category
{
    //Attributes
    private $id,
        $name,
        $parent;

    //Contructor
    /** Product class
     * 
     * @property String $name Name
     * @property String $parent Parent Name
     * @property INTEGER $id unique number
     */
    function __construct($name = null, $parent = null, $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->parent = $parent;
    }

    //Set methods

    /** Set ID
     * @param INTEGER $id Unique number
     */
    public function set_id($id)
    {
        $this->id = $id;
    }

    /** Set name
     * @param STRING $name Name
     */
    public function set_name($name)
    {
        $this->name = $name;
    }

    /** Set parent
     * @param STRING $Parent Parent name
     */
    public function set_parent($parent)
    {
        $this->parent = $parent;
    }

    //Get methods

    /** Get ID
     * @return INTEGER Unique number
     */
    public function get_id()
    {
        return $this->id;
    }

    /** Get name
     * @return STRING Name
     */
    public function get_name()
    {
        return $this->name;
    }

    /** Get parent
     * @return STRING Parent name
     */
    public function get_parent()
    {
        return $this->parent;
    }
}