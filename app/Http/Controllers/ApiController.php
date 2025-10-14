<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nurigo\Solapi\Exceptions\MessageNotReceivedException;
use Nurigo\Solapi\Models\Kakao\KakaoOption;
use Nurigo\Solapi\Models\Message;
use Nurigo\Solapi\Services\SolapiMessageService;

class ApiController extends Controller
{
  public SolapiMessageService $messageService;

  public function __construct() {
    $this->messageService = new SolapiMessageService(env("SOLAPI_API_KEY"), env("SOLAPI_API_SECRET_KEY"));
  }

  public function send($data) {
    try {
      $pfId = 'KA01PF231017073103411qV0EAriIwG8';
      $templateId = 'KA01TP231017074540269H1asmNJjWy6';

      $kakaoOption = new KakaoOption();
      $kakaoOption->setPfId($pfId)
        ->setTemplateId($templateId);

      $message = new Message();
      $message->setTo($data['phone'])
        ->setKakaoOptions($kakaoOption);

      $variables = [
        "#{A}" => 'A'
      ];
      $kakaoOption->setVariables($variables);

      $result = $this->messageService->send($message);
      return response()->json($result);
    } catch (MessageNotReceivedException $exception) {
      return response()->json([
        'result' => 'fail',
        'message' => $exception->getFailedMessageList(),
        'data' => $exception
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'result' => 'fail',
        'message' => $e->getMessage(),
        'data' => $e
      ]);
    }
  }
}
