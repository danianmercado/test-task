<?php

namespace App\Services;

use App\Entity\Product;
use App\Services\Discounts\DiscountApplier;
use App\Services\Taxes\TaxCalculatorFactory;
use Doctrine\ORM\EntityManagerInterface;

class PriceCalculator
{
    private $taxCalculatorFactory;
    private $discountApplier;
    private $entityManager;

    public function __construct(
        TaxCalculatorFactory $taxCalculatorFactory,
        DiscountApplier $discountApplier,
        EntityManagerInterface $entityManager
    ) {
        $this->taxCalculatorFactory = $taxCalculatorFactory;
        $this->discountApplier = $discountApplier;
        $this->entityManager = $entityManager;
    }

    public function calculatePrice(int $productId, string $taxNumber, ?string $couponCode): float
    {
        try {
            $product = $this->entityManager->getRepository(Product::class)->find($productId);
            $priceAfterDiscount = $product->getPrice();

            if ($couponCode) {
                $priceAfterDiscount = $this->discountApplier->applyDiscount($product->getPrice(), $couponCode);
            }
            $taxCalculator = $this->taxCalculatorFactory->createCalculator($taxNumber);
            $taxAmount = $taxCalculator->calculateTax($priceAfterDiscount);
            $totalPrice = $priceAfterDiscount + $taxAmount;
            if ($totalPrice < 0) {
                throw new \InvalidArgumentException("Total price value cant be negative");
            }
            return $totalPrice;
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }
}
