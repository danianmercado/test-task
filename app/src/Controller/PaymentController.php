<?php

namespace App\Controller;

use App\Controller\ApiController;
use App\Form\CalculationForm;
use App\Form\DataValidator\CalculationType;
use App\Form\DataValidator\PayType;
use App\Form\PayForm;
use App\Services\PaymentProcessor\PaymentService;
use App\Services\PriceCalculator;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends ApiController
{
    private $formFactory;
    private $priceCalculator;
    private $paymentService;
    public function __construct(FormFactoryInterface $formFactory, PriceCalculator $priceCalculator, PaymentService $paymentService)
    {
        $this->formFactory = $formFactory;
        $this->priceCalculator = $priceCalculator;
        $this->paymentService = $paymentService;
    }

    #[Route('/api/price_calculation', name: 'price_calculation', methods: ['POST'])]
    public function priceCalculation(Request $request): JsonResponse
    {
        try {
            $this->processCalculationRequest($request);
            return $this->jsonSuccess("Total amount of product is {$this->getTotalAmount()}");
        } catch (\Exception $exception) {
            return $this->jsonError($exception->getMessage());
        }
    }

    #[Route('/api/pay', name: 'pay', methods: ['POST'])]
    public function pay(Request $request): JsonResponse
    {
        try {
            $this->processPayRequest($request);
            if($this->processPayment())
            {
                return $this->jsonSuccess("Payment has been successfully processed.");
            }
            else{
                return $this->jsonError(json_encode("Payment error"));
            }
        } catch (\Exception $exception) {
            // dd($exception->getMessage());
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

    private function processPayRequest(Request $request)
    {
        $this->setRequestData($request)
            ->setDataValidator(PayType::class)
            ->setForm(PayForm::class)
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

    private function processPayment()
    {
        $data = $this->getRequestData();
        $total = (int) $this->getTotalAmount() / 100;
        try {
            $paymentResult = $this->paymentService->processPayment($data['paymentProcessor'], $total);
            return $paymentResult;
        } catch (\Exception $e) {
            throw new \Exception(json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE), 400);
        }
    }
}
