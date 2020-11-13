<?php

/** Detail for orders class
 * 
 * @param INTEGER $id unique number
 * @param INTEGER $idOrder id of the order
 * @param INTEGER $idProduct id of the product
 * @param INTEGER $quantity how many product the user buy
 * 
 * @author Gustavo Espinoza
 * @version 1.0
 */
class Detail
{

    // Attributes
    private $id,
        $idOrder,
        $idProduct,
        $quantity;

    // Constructor
    /** Detail for orders class
     * @param INTEGER $id unique number
     * @param INTEGER $idOrder id of the order
     * @param INTEGER $idProduct id of the product
     * @param INTEGER $quantity how many product the user buy
     */
    public function __construct($id = null, $idOrder = null, $idProduct = null, $quantity = null)
    {
        $this->id = $id;
        $this->idOrder = $idOrder;
        $this->idProduct = $idProduct;
        $this->quantity = $quantity;
    }

    // Set methods

    /** Set ID for the detail of the order
     * @param INTEGER unique number
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /** Set the id order
     * @param INTEGER unique number from the order
     */
    public function setIdORder($idOrder)
    {
        $this->idOrder = $idOrder;
    }

    /** Set the id of the product
     * @param INTEGER unique number of the product
     */
    public function setIdProduct($idProduct)
    {
        $this->idProduct = $idProduct;
    }

    /** Set the quantity of the product buy from the user
     * @param INTEGER how many the user buy?
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    // GET methods

    /** Get id
     * @return INTEGER Unique number
     */
    public function  getID()
    {
        return $this->id;
    }

    /** Get idOrder
     * @return INTEGER id of the order
     */
    public function getIdOrder()
    {
        return $this->idOrder;
    }

    /** Get idProduct
     * @return INTEGER unique number of the product
     */
    public function getIdProduct()
    {
        return $this->idProduct;
    }

    /** Get the number of products
     * @return INTEGER amount of the product the user buy
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
}