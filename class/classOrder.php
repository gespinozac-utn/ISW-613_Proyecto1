<?php

/** Order Class
 * 
 * @property INTEGER $id unique number
 * @property DATETIME $purchaseDate date of purcharse
 * @property INTEGER $idUser id of user who made the purchase
 * @property BOOLEAN $status status of the order, false(0) if is pre-oder, true(1) if is complete.
 * 
 * @author Gustavo Espinoza
 * @version 1.0
 */
class Order
{

    // Attributes
    private $id,
        $purchaseDate,
        $idUser,
        $status;

    // Constructor
    /** Order class
     * 
     * @property INTEGER $id unique number
     * @property DATETIME $purchaseDate date of purcharse
     * @property INTEGER $idUser id of user who made the purchase
     * @property BOOLEAN $status status of the order, false(0) if is pre-oder, true(1) if is complete.
     */
    public function __construct($idUser = null, $purchaseDate = null, $status = null, $id = null)
    {
        $this->id = $id;
        $this->purchaseDate = $purchaseDate;
        $this->idUser = $idUser;
        $this->status = $status;
    }

    // Set methods

    /** Set ID
     * @param INTEGER $id unique number
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /** Set Date of purchase
     * @param DATETIME $purchaseDate date of purcharse
     */
    public function setPurchaseDate($date)
    {
        $this->purchaseDate = $date;
    }

    /** Set id user id of user who made the purchase
     * @param INTEGER $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    /** Set status
     * @param BOOLEAN $status status of the order, false(0) if is pre-oder, true(1) if is complete.
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    // GET methods

    /** Get ID
     * @return INTEGER id for order
     */
    public function getId()
    {
        return $this->id;
    }

    /** Get purchaseDate
     * @return DATETIME date of purchase
     */
    public function getPurchaseDate()
    {
        return $this->purchaseDate;
    }

    /** Get idUser
     * @return INTEGER id of the user from the purchase
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /** Get status
     * @return BOOLEAN status of the purchase, return false(0) if is pre-order, true(1) if is complete
     */
    public function getStatus()
    {
        return $this->status;
    }
}