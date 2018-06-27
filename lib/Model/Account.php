<?php
/**
 * Account
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
 * # MicroCoin API  MicroCoin rider is an API server for the MicroCoin ecosystem.  It acts as the interface between MicroCoin network and applications that want to access the MicroCoin network.  It allows you to submit transactions to the network, check the status of accounts, subscribe to transactions, etc.  Rider provides a RESTful API to allow client applications to interact with the MicroCoin network.  You can communicate with Rider using cURL or just your web browser. However, if you’re building a client application, you’ll likely want to use a MicroCoin SDK in the language of your client\";    # PHP quickstart guide  ## Download the client SDK  First you need a MicroCoin client SDK. You can download it from [here](), or clone from our [Github](https://github.com) repository.  ```  git clone https://  ```  ## Keys and signatures  MicroCoin works with ECDSA signatures, so you need to work with ECDSA keys and signatures.  You can use your favorite **ECDSA** package, or use `simplito/elliptic-php`. We are using `simplito/elliptic-php` in our demos.    ## Generate new ECDSA keyPair  If you have no keys, you must generate a new key, then store it in a secure place.  **Please notice: if you lose your key, you lose your accounts and your coins**  ```php  use Elliptic\\EC;  $ec = new EC('secp256k1');  $myKey = $ec->genKeyPair();  ```  ## Import ECDSA private key  If you have a key, you can import it from a hexadecimal string.  ```php  use Elliptic\\EC;  $ec = new EC('secp256k1');  $myKey = $ec->keyFromPrivate(\"PRIVATE KEY IN HEX\");  ```  ## List your accounts  If you have accounts you can list there. First time you have no accounts, so you need get one.  Every account belongs to a public key. One public key can be used for multiple accounts.  ```php  $api = new \\MicroCoin\\Api\\AccountApi();  // You must convert the ECPoint to a MicroCoin SimpleKey  $key = new \\MicroCoin\\Model\\SimpleKey();  $key->setCurveType(\"secp256k1\");  $key->setX($myKey->getPublic()->getX()->toString(16));  $key->setY($myKey->getPublic()->getY()->toString(16));    print_r($api->myAccounts($key));  ```  ## List accounts for sale  You can purchase accounts, but you need to know which accounts are for sale.  ```php  $api = new \\MicroCoin\\Api\\AccountApi();  print_r($api->getOffers());  ```    ## Purchase account  You can purchase any account for sale, if you have enough coins.  ```php  $api = new \\MicroCoin\\Api\\AccountApi();    // First convert your public key  $key = new \\MicroCoin\\Model\\SimpleKey([      \"curve_type\" => \"secp256k1\",      \"x\" => $myKey->getPublic()->getX()->toString(16),      \"y\" => $myKey->getPublic()->getY()->toString(16)  ]);    $purchaseAccountRequest = new \\MicroCoin\\Model\\PurchaseAccountRequest();   // Account to purchase   $purchaseAccountRequest->setAccountNumber('0-10');  $purchaseAccountRequest->setFee(0);  // This account will pay the price and the fee  $purchaseAccountRequest->setFounderAccount('1-22');    // The new owner  $purchaseAccountRequest->setNewKey($key);   // preapare transaction  $transaction = $api->startPurchaseAccount($purchaseAccountRequest);   // Sign transaction  $sign = $myKey->sign($transaction->getHash());  // Fill signature  $transaction->setSignature(new \\MicroCoin\\Model\\Signature([\"r\"=>$sign->r->toString(16), \"s\"=>$sign->r->toString(16)]));  // Commit transaction  $result = $api->commitPurchaseAccount($transaction);  // You are done  print_r($result);    ```    ## Sending coins  If you have enough balance, you can send coins from your accounts to any valid account.  ```php  $api = new \\MicroCoin\\Api\\TransactionApi();  $sendCoinRequest = new \\MicroCoin\\Model\\TransactionRequest();  // Source account  $sendCoinRequest->setSender('0-10');  // Destination account  $sendCoinRequest->setTarget('1-22');  // Amount to send  $sendCoinRequest->setAmount(0.0001);  // Optinal fee  $sendCoinRequest->setFee(0);  // Optional payload  $sendCoinRequest->setPayload(\"Hello MicroCoin\");  // Prepare a new transaction  $transaction = $api->startTransaction($sendCoinRequest);  // Sign transaction with your private key (private key what belongs to the sender account)  $sign = $myKey->sign($transaction->getHash());  // Fill signature  $transaction->setSignature( new \\MicroCoin\\Model\\Signature([\"r\"=>$sign->r->toString(16), \"s\"=>$sign->r->toString(16)]) );  // Commit transaction  $result = $api->commitTransaction($transaction);  // Coins sent  print_r($result);  ```  ## Change account owner  If you want change your account owner, you can do it with change the assigned public key.  ```php  $changeKeyRequest->setAccountNumber('0-10');  // Key of the new owner  $changeKeyRequest->setNewOwnerPublicKey(new \\MicroCoin\\Model\\SimpleKey([      \"curve_type\" => \"secp256k1\",      \"x\" => $newKey->getPublic()->getX()->toString(16),      \"y\" => $newKey->getPublic()->getY()->toString(16)  ]));  $changeKeyRequest->setFee(0);  // Prepare transaction  $transaction = $api->startChangeKey($changeKeyRequest);  // Fill signature  $transaction->setSignature( new \\MicroCoin\\Model\\Signature([\"r\"=>$sign->r->toString(16), \"s\"=>$sign->r->toString(16)]) );  // Commit transaction  $result = $api->commitPurchaseAccount($transaction);  // You are done  print_r($result);  ```  ***    # Javascript quickstart guide    ## Download the client SDK  First you need a MicroCoin client SDK. You can download it from [here](), or clone from our [Github](https://github.com) repository.  ```  git clone https://  ```  ## Keys and signatures  MicroCoin works with ECDSA signatures, so you need to work with ECDSA keys and signatures.  You can use your favorite **ECDSA** package, or use `elliptic.js`. We are using `elliptic.js` in our demos.    ## Generate new ECDSA keyPair  If you have no keys, you must generate a new key, then store it in a secure place.  **Please notice: if you lose your key, you lose your accounts and your coins**  ```js  var ec = new elliptic.ec(\"secp256k1\");  var myKey = ec.genKeyPair();  ```  ## Import ECDSA private key  If you have a key, you can import it from a hexadecimal string.  ```js  var ec = new elliptic.ec(\"secp256k1\");  var myKey = ec.keyPair({ \"priv\":\"PRIVATE KEY IN HEX\", \"privEnc\":\"hex\" });  ```  ## Export ECDSA key  Sometimes you need save your key, or you need to display it. You can export your key using this method  ```js  var exportedKey = {     private: keyPair.getPrivate(\"hex\"),     public: {         X: keyPair.getPublic().x.toString(16),         Y: keyPair.getPublic().y.toString(16)      }  }  ```  ## List your accounts  If you have accounts you can list there. First time you have no accounts, so you need get one.  Every account belongs to a public key. One public key can be used for multiple accounts.  ```js  var accountApi = new MicroCoin.AccountApi();  // Never send your private key!  accountApi.myAccounts({      \"curveType\":\"secp256k1\",      \"x\": myKey.getPublic().getX(\"hex\"),      \"y\": myKey.getPublic().getY(\"hex\")  }).then(myAccounts => console.log(myAccounts));  ```    ## Get single account  You can request information from a single account. You can see the balance, name, etc..  ```js  var accountApi = new MicroCoin.AccountApi();  accountApi.getAccount(\"0-10\").then(account => console.log(account));  ```    ## List accounts for sale  You can purchase accounts, but you need to know which accounts are for sale.  ```js  var accountApi = new MicroCoin.AccountApi();  accountApi.getOffers().then(offers => console.log(offers));  ```  ## Purchase account  You can purchase any account for sale, if you have enough coins.  ```js  var purchaseRequest = new MicroCoin.PurchaseAccountRequest();  purchaseRequest.setAccountNumber(\"34689-25\"); // The account to purchase  purchaseRequest.setFounderAccount(\"1-22\");   // The founder account will pay for the account  purchaseRequest.setFee(0);  // Optional miner fee  // This is key of the new owner. You can use your own key, or any key what you want.  // After the purchase completed you can only manage this account with this keyPair  purchaseRequest.setNewKey({      \"CurveType\":\"secp256k1\",      \"X\": myKey.getPublic().getX(\"hex\"),      \"Y\": myKey.getPublic().getY(\"hex\")  });  // First prepare the transaction  accountApi.startPurchaseAccount(purchaseRequest).then(function (transaction) {      // Now we need to sign our transaction using the founder account private key      var signature = myKey.sign(transaction.getHash());      // Now fill the signature property      transaction.signature = { \"r\": signature.r, \"s\": signature.s };      // Last we need to commit our transaction and we are done      accountApi.commitPurchaseAccount(transaction).then((response)=>console.log(response), e => console.error(e));  });  ```    ## Sending coins  If you have enough balance, you can send coins from your accounts to any valid account.  ```js  var transactionApi = new MicroCoin.TransactionApi();  var sendCoinRequest = new MicroCoin.TransactionRequest();  sendCoinRequest.setSender('0-10'); // Source account  sendCoinRequest.setTarget('1-22'); // Target account  sendCoinRequest.setAmount(0.0001); // Amount to send  sendCoinRequest.setFee(0); // optional miner fee, one transaction / block (5 min) is free  sendCoinRequest.setPayload(\"Hello MicroCoin\"); // optional payload  // First we are creating a transaction  transactionApi.startTransaction(sendCoinRequest).then(function (transaction) {      // When the transaction created, we need to sign the transaction      var signature = myKey.sign(transaction.getHash());      // Now fill the signature property      transaction.signature = { \"r\": signature.r, \"s\": signature.s };      // Last we need to commit our transaction and we are done      transactionApi.commitTransaction(transaction).then((response)=>console.log(response), e => console.error(e));  });  ```    ## Change account owner  If you want change your account owner, you can do it with change the assigned public key.  ```js  var request = new MicroCoin.ChangeKeyRequest();  request.setAccountNumber(\"0-10\"); // The account to change  // newKey: Public key of the new owner  request.setNewOwnerPublicKey({      \"curveType\":\"secp256k1\",      \"x\": newKey.getPublic().getX(\"hex\"),      \"y\": newKey.getPublic().getY(\"hex\")  });  // First we are creating a transaction  accountApi.startChangeKey(request).then(function (transaction) {      // When the transaction created, we need to sign the transaction      // myKey: key of the current owner       var signature = myKey.sign(transaction.getHash());      transaction.signature = { \"r\": signature.r, \"s\": signature.s };      // Last we need to commit our transaction and we are done, the new owner can use his/her account      accountApi.commitChangeKey(transaction).then((response)=>console.log(response), e => console.error(e));  });  ```
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
 * Account Class Doc Comment
 *
 * @category Class
 * @description MicroCoin account entity
 * @package  MicroCoin
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Account implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'Account';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'account_number' => 'string',
        'balance' => 'float',
        'name' => 'string',
        'type' => 'int',
        'status' => 'string',
        'price' => 'float'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'account_number' => null,
        'balance' => 'decimal',
        'name' => null,
        'type' => null,
        'status' => null,
        'price' => 'decimal'
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
        'balance' => 'balance',
        'name' => 'name',
        'type' => 'type',
        'status' => 'status',
        'price' => 'price'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'account_number' => 'setAccountNumber',
        'balance' => 'setBalance',
        'name' => 'setName',
        'type' => 'setType',
        'status' => 'setStatus',
        'price' => 'setPrice'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'account_number' => 'getAccountNumber',
        'balance' => 'getBalance',
        'name' => 'getName',
        'type' => 'getType',
        'status' => 'getStatus',
        'price' => 'getPrice'
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
        $this->container['balance'] = isset($data['balance']) ? $data['balance'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['type'] = isset($data['type']) ? $data['type'] : null;
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
        $this->container['price'] = isset($data['price']) ? $data['price'] : null;
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
        if ($this->container['balance'] === null) {
            $invalidProperties[] = "'balance' can't be null";
        }
        if ($this->container['type'] === null) {
            $invalidProperties[] = "'type' can't be null";
        }
        if ($this->container['price'] === null) {
            $invalidProperties[] = "'price' can't be null";
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
        if ($this->container['balance'] === null) {
            return false;
        }
        if ($this->container['type'] === null) {
            return false;
        }
        if ($this->container['price'] === null) {
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
     * @param string $account_number Account number
     *
     * @return $this
     */
    public function setAccountNumber($account_number)
    {
        $this->container['account_number'] = $account_number;

        return $this;
    }

    /**
     * Gets balance
     *
     * @return float
     */
    public function getBalance()
    {
        return $this->container['balance'];
    }

    /**
     * Sets balance
     *
     * @param float $balance Account balance
     *
     * @return $this
     */
    public function setBalance($balance)
    {
        $this->container['balance'] = $balance;

        return $this;
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name Account name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets type
     *
     * @return int
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param int $type Account type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param string $status Account status Listed = for sale Normal = normal account
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->container['price'];
    }

    /**
     * Sets price
     *
     * @param float $price Account price if account for sale
     *
     * @return $this
     */
    public function setPrice($price)
    {
        $this->container['price'] = $price;

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


