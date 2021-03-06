<?php
/**
 * PurchaseAccountRequest
 *
 * PHP version 5
 *
 * @category Class
 * @package  MicroCoin
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * MicroCoin
 *
 * OpenAPI spec version: 1.0.0
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: unset
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace MicroCoin\Model;

use \ArrayAccess;
use \MicroCoin\ObjectSerializer;

/**
 * PurchaseAccountRequest Class Doc Comment
 *
 * @category Class
 * @description Purchase account request
 * @package  MicroCoin
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class PurchaseAccountRequest implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'PurchaseAccountRequest';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'account_number' => 'string',
        'founder_account' => 'string',
        'new_key' => '\MicroCoin\Model\SimpleKey',
        'signature' => '\MicroCoin\Model\Signature',
        'hash' => 'string',
        'fee' => 'float'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'account_number' => null,
        'founder_account' => null,
        'new_key' => null,
        'signature' => null,
        'hash' => null,
        'fee' => 'decimal'
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'account_number' => 'accountNumber',
        'founder_account' => 'founderAccount',
        'new_key' => 'newKey',
        'signature' => 'signature',
        'hash' => 'hash',
        'fee' => 'fee'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'account_number' => 'setAccountNumber',
        'founder_account' => 'setFounderAccount',
        'new_key' => 'setNewKey',
        'signature' => 'setSignature',
        'hash' => 'setHash',
        'fee' => 'setFee'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'account_number' => 'getAccountNumber',
        'founder_account' => 'getFounderAccount',
        'new_key' => 'getNewKey',
        'signature' => 'getSignature',
        'hash' => 'getHash',
        'fee' => 'getFee'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$swaggerModelName;
    }

    

    

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['account_number'] = isset($data['account_number']) ? $data['account_number'] : null;
        $this->container['founder_account'] = isset($data['founder_account']) ? $data['founder_account'] : null;
        $this->container['new_key'] = isset($data['new_key']) ? $data['new_key'] : null;
        $this->container['signature'] = isset($data['signature']) ? $data['signature'] : null;
        $this->container['hash'] = isset($data['hash']) ? $data['hash'] : null;
        $this->container['fee'] = isset($data['fee']) ? $data['fee'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['account_number'] === null) {
            $invalidProperties[] = "'account_number' can't be null";
        }
        if ($this->container['founder_account'] === null) {
            $invalidProperties[] = "'founder_account' can't be null";
        }
        if ($this->container['fee'] === null) {
            $invalidProperties[] = "'fee' can't be null";
        }
        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {

        if ($this->container['account_number'] === null) {
            return false;
        }
        if ($this->container['founder_account'] === null) {
            return false;
        }
        if ($this->container['fee'] === null) {
            return false;
        }
        return true;
    }


    /**
     * Gets account_number
     *
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->container['account_number'];
    }

    /**
     * Sets account_number
     *
     * @param string $account_number Account to purchase
     *
     * @return $this
     */
    public function setAccountNumber($account_number)
    {
        $this->container['account_number'] = $account_number;

        return $this;
    }

    /**
     * Gets founder_account
     *
     * @return string
     */
    public function getFounderAccount()
    {
        return $this->container['founder_account'];
    }

    /**
     * Sets founder_account
     *
     * @param string $founder_account Founder account, who will pay the price
     *
     * @return $this
     */
    public function setFounderAccount($founder_account)
    {
        $this->container['founder_account'] = $founder_account;

        return $this;
    }

    /**
     * Gets new_key
     *
     * @return \MicroCoin\Model\SimpleKey
     */
    public function getNewKey()
    {
        return $this->container['new_key'];
    }

    /**
     * Sets new_key
     *
     * @param \MicroCoin\Model\SimpleKey $new_key new_key
     *
     * @return $this
     */
    public function setNewKey($new_key)
    {
        $this->container['new_key'] = $new_key;

        return $this;
    }

    /**
     * Gets signature
     *
     * @return \MicroCoin\Model\Signature
     */
    public function getSignature()
    {
        return $this->container['signature'];
    }

    /**
     * Sets signature
     *
     * @param \MicroCoin\Model\Signature $signature signature
     *
     * @return $this
     */
    public function setSignature($signature)
    {
        $this->container['signature'] = $signature;

        return $this;
    }

    /**
     * Gets hash
     *
     * @return string
     */
    public function getHash()
    {
        return $this->container['hash'];
    }

    /**
     * Sets hash
     *
     * @param string $hash Transaction hash to sign the transaction
     *
     * @return $this
     */
    public function setHash($hash)
    {
        $this->container['hash'] = $hash;

        return $this;
    }

    /**
     * Gets fee
     *
     * @return float
     */
    public function getFee()
    {
        return $this->container['fee'];
    }

    /**
     * Sets fee
     *
     * @param float $fee Transaction fee, if any, otherwise zero
     *
     * @return $this
     */
    public function setFee($fee)
    {
        $this->container['fee'] = $fee;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(
                ObjectSerializer::sanitizeForSerialization($this),
                JSON_PRETTY_PRINT
            );
        }

        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


