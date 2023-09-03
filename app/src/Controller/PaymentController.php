<?php

namespace App\Controller;

use App\Controller\ApiController;
use App\Form\CalculationForm;
use App\Form\DataValidator\CalculationType;
use App\Services\PriceCalculator;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends ApiController
{
    private $formFactory;
    private $priceCalculator;
    public function __construct(FormFactoryInterface $formFactory, PriceCalculator $priceCalculator)
    {
        $this->formFactory = $formFactory;
        $this->priceCalculator = $priceCalculator;
    }

    #[Route('/api/price_calculation', name: 'price_calculation', methods: ['POST'])]
    public function priceCalculation(Request $request): JsonResponse
    {
        try {
            $this->processCalculationRequest($request);
            return $this->jsonSuccess("Total amount of product is {$this->getTotalAmount()}");
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            return $this->jsonError($exception->getMessage());
        }
    }

    private function processCalculationRequest(Request $request)
    {
        $this->setRequestData($request)
            ->setDataValidator(CalculationType::class)
            ->setForm(CalculationForm::class)
            ->formHandler();

        if ($this->errorExists()) {
            throw new \Exception(json_encode($this->getErrors(), JSON_UNESCAPED_UNICODE), 400);
        }
    }

    private function getTotalAmount()
    {
        $data = $this->getRequestData();
        return $this->priceCalculator->calculatePrice(
            $data['product'],
            $data['taxNumber'],
            $data['couponCode'] ?? null
        );
    }
}
