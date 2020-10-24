<?php

/** Product class
 * 
 * @property String $sku Stock-keeping unit code
 * @property String $name Name
 * @property String $description Description
 * @property String $imageURL URL of the image
 * @property INTEGER $idCategory Unique number of the category
 * @property INTEGER $stock available for sale
 * @property FLOAT $price Price
 * @property INTEGER $id unique number
 * 
 * @author Gustavo Espinoza
 * @version 1.0
 */
class Product
{
    // Attributes
    private $sku,
        $id,
        $name,
        $description,
        $imageURL,
        $idCategory,
        $stock,
        $price;


    // Constructor
    /**
     * Constructor function
     * @param String $sku Stock-keeping unit code
     * @param String $name Name
     * @param String $description Description
     * @param String $imageURL URL of the image
     * @param INTEGER $idCategory Unique number of the category
     * @param INTEGER $stock available for sale
     * @param FLOAT $price Price
     * @param INTEGER $id unique number
     */
    function __construct($sku = null, $name = null, $description = null, $imageURL = null, $idCategory = null, $stock = null, $price = null, $id = null)
    {
        $this->sku = $sku;
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->imageURL = $imageURL;
        $this->idCategory = $idCategory;
        $this->stock = $stock;
        $this->price = $price;
    }

    // Set methods

    /** Set SKU
     * @param STRING $SKU Stock-keeping unit code
     */
    public function setSKU(string $SKU = null)
    {
        $this->sku = $SKU;
    }

    /** Set id 
     * @param INTEGER $id Unique number
     */
    public function setID(int $id = null)
    {
        $this->id = $id;
    }

    /** Set name
     * @param String $name Name
     */
    public function setName(string $name = null)
    {
        $this->name = $name;
    }

    /** Set description
     * @param String Detail description
     */
    public function setDescription(string $description = null)
    {
        $this->description = $description;
    }

    /** Set image Url
     * @param String $imageURL Absolute path to the image
     */
    public function setImageURL(string $imageURL = null)
    {
        $this->imageURL = $imageURL;
    }

    /** Set id Category
     * @param String $idCategory unique number for the category
     */
    public function setIDCategory(int $idCategory = null)
    {
        $this->idCategory = $idCategory;
    }

    /** Set Stock 
     * @param INTEGER $stock available for sale
     */
    public function setStock(int $stock = null)
    {
        $this->stock = $stock;
    }

    /** Set Price 
     * @param INTEGER $price price
     */
    public function setPrice(int $price = null)
    {
        $this->price = $price;
    }

    // Get methods

    /** GET SKU
     * @return String Stock-keeping unit code
     */
    public function getSKU()
    {
        return $this->sku;
    }

    /** Get ID 
     * @return INTEGER Unique number
     */
    public function getId()
    {
        return $this->id;
    }

    /** Get Name
     * @return String Name
     */
    public function getName()
    {
        return $this->name;
    }

    /** Get Description
     * @return String detail description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /** Get Image URL
     * @return String Absolute path to the image
     */
    public function getImageURL()
    {
        return $this->imageURL;
    }

    /** Get ID Category
     * @return INTEGER unique number for category
     */
    public function getIdCategory()
    {
        return $this->idCategory;
    }

    /** Get Stock 
     * @return INTEGER Available for sale
     */
    public function getStock()
    {
        return $this->stock;
    }

    /** Get Price
     * @return FLOAT Price
     */
    public function getPrice()
    {
        return $this->price;
    }
}