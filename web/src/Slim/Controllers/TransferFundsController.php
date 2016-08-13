<?php
/**
 * PHP version 7.0
 *
 * This source file is subject to the license that is bundled with this package in the file LICENSE.
 */
namespace Ewallet\Slim\Controllers;

use Ewallet\ManageWallet\TransferFunds;
use Money\Money;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\{Request, Response};
use Twig_Environment as Environment;

class TransferFundsController
{
    /** @var TransferFunds */
    private $action;

    /** @var Environment */
    private $template;

    /**
     * @param Environment $template
     * @param TransferFunds $action
     */
    public function __construct(
        Environment $template,
        TransferFunds $action = null
    ) {
        $this->template = $template;
        $this->action = $action;
    }

    /**
     * Show the form to transfer funds between members
     *
     * @return ResponseInterface
     */
    public function enterTransferInformation(Request $_, Response $response): ResponseInterface
    {
        $html = $this->template->render('member/transfer-funds.html.twig');
        $response->getBody()->write($html);

        return $response;
    }

    /**
     * Perform the transfer
     *
     * @param Request $request
     * @return ResponseInterface
     */
    public function transfer(Request $request, Response $response): ResponseInterface
    {
        $senderId = 1; // This should be the authenticated user id..
        $recipientId = $request->getParam('recipientId');
        $amount = Money::MXN($request->getParam('amount') * 100);

        $summary = $this->action->transfer($senderId, $recipientId, $amount);

        $html = $this->template->render('member/transfer-funds.html.twig', [
            'sender' => $summary->sender(),
            'recipient' => $summary->recipient(),
        ]);
        $response->getBody()->write($html);

        return $response;
    }
}
