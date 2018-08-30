<?php


namespace KassaCom\SDK\Model\Request\Item;


use KassaCom\SDK\Model\PaymentMethods;
use KassaCom\SDK\Model\Traits\RecursiveRestoreTrait;
use KassaCom\SDK\Model\Types\PaymentType;

class PaymentMethodDataItem extends AbstractRequestItem
{
    use RecursiveRestoreTrait;

    /**
     * @var string
     * @see \KassaCom\SDK\Model\PaymentMethods
     */
    private $type;

    /**
     * @var string
     */
    private $account;

    /**
     * @var string
     */
    private $cardNumber;

    /**
     * @var string
     */
    private $cardMonth;

    /**
     * @var string
     */
    private $cardYear;

    /**
     * @var string
     */
    private $cardSecurity;

    /**
     * @var bool|null
     */
    private $capture;

    /**
     * @return string
     * @see \KassaCom\SDK\Model\PaymentMethods
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return $this
     * @see \KassaCom\SDK\Model\PaymentMethods
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param string $account
     *
     * @return $this
     */
    public function setAccount($account)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * @return string
     */
    public function getCardNumber()
    {
        return $this->cardNumber;
    }

    /**
     * @param string $cardNumber
     *
     * @return $this
     */
    public function setCardNumber($cardNumber)
    {
        $this->cardNumber = $cardNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getCardMonth()
    {
        return $this->cardMonth;
    }

    /**
     * @param string $cardMonth
     *
     * @return $this
     */
    public function setCardMonth($cardMonth)
    {
        $this->cardMonth = $cardMonth;

        return $this;
    }

    /**
     * @return string
     */
    public function getCardYear()
    {
        return $this->cardYear;
    }

    /**
     * @param string $cardYear
     *
     * @return $this
     */
    public function setCardYear($cardYear)
    {
        $this->cardYear = $cardYear;

        return $this;
    }

    /**
     * @return string
     */
    public function getCardSecurity()
    {
        return $this->cardSecurity;
    }

    /**
     * @param string $cardSecurity
     *
     * @return $this
     */
    public function setCardSecurity($cardSecurity)
    {
        $this->cardSecurity = $cardSecurity;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getCapture()
    {
        return $this->capture;
    }

    /**
     * @param bool|null $capture
     *
     * @return $this
     */
    public function setCapture($capture)
    {
        if ((null !== $capture) && !is_bool($capture)) {
            throw new \InvalidArgumentException("statusDescription must be string on null");
        }
        $this->capture = $capture;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getRequiredFields()
    {
        $requiredFields = [
            'type' => new PaymentType($this),
        ];

        if ($this->getType() === PaymentMethods::PAYMENT_METHOD_CARD) {
            $requiredFields['card_number'] = ReceiptRequestItem::TYPE_STRING;
            $requiredFields['card_month'] = ReceiptRequestItem::TYPE_STRING;
            $requiredFields['card_year'] = ReceiptRequestItem::TYPE_STRING;
            $requiredFields['card_security'] = ReceiptRequestItem::TYPE_STRING;
        } else if ($this->getType() === PaymentMethods::PAYMENT_METHOD_QIWI) {
            $requiredFields['account'] = ReceiptRequestItem::TYPE_STRING;
        }

        return $requiredFields;
    }

    /**
     * @inheritDoc
     */
    public function getOptionalFields()
    {
        return [
            'card_number' => ReceiptRequestItem::TYPE_STRING,
            'card_month' => ReceiptRequestItem::TYPE_STRING,
            'card_year' => ReceiptRequestItem::TYPE_STRING,
            'card_security' => ReceiptRequestItem::TYPE_STRING,
            'account' => ReceiptRequestItem::TYPE_STRING,
            'capture' => ReceiptRequestItem::TYPE_BOOLEAN,
        ];
    }
}
