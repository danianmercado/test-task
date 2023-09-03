<?php

namespace App\Controller;

use App\Controller\ApiController;
use App\Form\CalculationForm;
use App\Form\DataValidator\CalculationType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends ApiController
{
    private $formFactory;

    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
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
        return 8;
        // $data = $this->getRequestData();

        // return $this->amountCalculationHandler->setProduct($data['product'])
        //     ->setCouponCode($data['couponCode'] ?? null)
        //     ->setTaxNumber($data['taxNumber'])
        //     ->calculation();
    }
}
