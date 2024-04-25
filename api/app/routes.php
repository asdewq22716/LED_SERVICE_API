<?php
declare (strict_types = 1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use App\Application\Actions\Api\XxxxXxxxxxAction; // ตัวอย่าง
use App\Application\Actions\Api\civilCasePersonAction;
use App\Application\Actions\Api\civilCaseDetailAction;
use App\Application\Actions\Api\civilCaseAssetsLandAction;
use App\Application\Actions\Api\civilCaseAssetsBuildingAction;
use App\Application\Actions\Api\civilCaseAssetsCondoAction;
use App\Application\Actions\Api\civilCaseAssetsMachineryAction;
use App\Application\Actions\Api\civilCaseAssetsLotteryAction;
use App\Application\Actions\Api\civilCaseAssetsFirearmAction;
use App\Application\Actions\Api\civilCaseAssetsCarAction;
use App\Application\Actions\Api\civilCaseAssetsStockAction;
use App\Application\Actions\Api\civilCaseAssetsFundAction;
use App\Application\Actions\Api\civilCaseAssetsRentAction;
use App\Application\Actions\Api\civilCaseAssetsStallRentAction;
use App\Application\Actions\Api\civilCaseAssetsIndoorRentAction;
use App\Application\Actions\Api\civilCaseAssetsOtherAction;
use App\Application\Actions\Api\civilCaseAssetsBoatAction;
use App\Application\Actions\Api\civilCaseAssetsBondAction;
use App\Application\Actions\Api\civilCaseCmdOfficeAction;
use App\Application\Actions\Api\civilCaseCourtOrderAction;
use App\Application\Actions\Api\civilCaseAccountAction;
use App\Application\Actions\Api\civilCaseReceiptAction;
use App\Application\Actions\Api\civilCaseOrderAction;
use App\Application\Actions\Api\civilCaseDocAction;
use App\Application\Actions\Api\civilCaseSequestrationAction;
use App\Application\Actions\Api\checkBankruptAssetsAction;
use App\Application\Actions\Api\checkCivilAssetsAction;
use App\Application\Actions\Api\checkCivilAssets2Action;
use App\Application\Actions\Api\bankruptAssetsBuildingAction;
use App\Application\Actions\Api\bankruptCasePersonAction;
use App\Application\Actions\Api\bankruptCaseDetailAction;
use App\Application\Actions\Api\bankruptAssetsMachineryAction;
use App\Application\Actions\Api\bankruptAssetsBondAction;
use App\Application\Actions\Api\bankruptAssetsLotteryAction;
use App\Application\Actions\Api\bankruptAssetsVechicleAction;
use App\Application\Actions\Api\bankruptAssetsRentAction;
use App\Application\Actions\Api\bankruptAssetsInsuranceAction;
use App\Application\Actions\Api\bankruptAssetsOtherAction;
use App\Application\Actions\Api\bankruptCourtOrderAction;
use App\Application\Actions\Api\bankruptDocAction;
use App\Application\Actions\Api\bankruptAssetsFirearmAction;
use App\Application\Actions\Api\bankruptAssetsStockAction;
use App\Application\Actions\Api\bankruptAssetsFundAction;
use App\Application\Actions\Api\bankruptAssetsMoneyAction;
use App\Application\Actions\Api\bankruptAssetsBookBankAction;
use App\Application\Actions\Api\bankruptCasePerBankruptAction;
use App\Application\Actions\Api\bankruptCmdOfficeAction;
use App\Application\Actions\Api\bankruptCaseCreditorAction;
use App\Application\Actions\Api\bankruptAssetsCoopAction;
use App\Application\Actions\Api\bankruptAssetsLegalAction;
use App\Application\Actions\Api\DebtRehabilitationCaseDebtorAction;
use App\Application\Actions\Api\DebtRehabilitationCaseCreditorAction;
use App\Application\Actions\Api\DebtRehabilitationCaseDetailAction;
use App\Application\Actions\Api\MediateCaseDetailAction;
use App\Application\Actions\Api\MediatePersonAction;
use App\Application\Actions\Api\BackOfficeUserAction;
use App\Application\Actions\Api\bankruptAssetsCondoAction;
use App\Application\Actions\Api\bankruptAssetsLandAction;
use App\Application\Actions\Api\bankrupAssetsMachineryAction;
use App\Application\Actions\Api\MediateCmdOfficeAction;
use App\Application\Actions\Api\DebtRehabilitationCmdOfficeAction;
use App\Application\Actions\Api\CmdBankRuptAction;
use App\Application\Actions\Api\CmdBankRuptDetailsAction;
use App\Application\Actions\Api\civilCaseAssetsBuildingRentAction;
use App\Application\Actions\Api\getAnnounceCivilCaseAction;
use App\Application\Actions\Api\getAnnounceCivilCaseResultAction;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/a', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });
    
    $app->post('/XxxxXxxxxx', XxxxXxxxxxAction::class); // ตัวอย่าง
    $app->post('/civilCasePerson', civilCasePersonAction::class);
    $app->post('/civilCaseDetail', civilCaseDetailAction::class);
    $app->post('/civilCaseAssetsLand', civilCaseAssetsLandAction::class);
    $app->post('/civilCaseAssetsBuilding', civilCaseAssetsBuildingAction::class);
    $app->post('/civilCaseAssetsCondo', civilCaseAssetsCondoAction::class);
    $app->post('/civilCaseAssetsMachinery', civilCaseAssetsMachineryAction::class);
    $app->post('/civilCaseAssetsBoat', civilCaseAssetsBoatAction::class);
    $app->post('/civilCaseAssetsBond', civilCaseAssetsBondAction::class);
    $app->post('/civilCaseAssetsLottery', civilCaseAssetsLotteryAction::class);
    $app->post('/civilCaseAssetsFirearm', civilCaseAssetsFirearmAction::class);
    $app->post('/civilCaseAssetsCar', civilCaseAssetsCarAction::class);
    $app->post('/civilCaseAssetsStock', civilCaseAssetsStockAction::class);
    $app->post('/civilCaseAssetsFund', civilCaseAssetsFundAction::class);
    $app->post('/civilCaseAssetsRent', civilCaseAssetsRentAction::class);
    $app->post('/civilCaseAssetsStallRent', civilCaseAssetsStallRentAction::class);
    $app->post('/civilCaseAssetsIndoorRent', civilCaseAssetsIndoorRentAction::class);
    $app->post('/civilCaseAssetsOther', civilCaseAssetsOtherAction::class);
    $app->post('/civilCaseCmdOffice', civilCaseCmdOfficeAction::class);
    $app->post('/civilCaseCourtOrder', civilCaseCourtOrderAction::class);
    $app->post('/civilCaseAccount', civilCaseAccountAction::class);
    $app->post('/civilCaseReceipt', civilCaseReceiptAction::class);
    $app->post('/civilCaseOrder', civilCaseOrderAction::class);
    $app->post('/civilCaseSequestration', civilCaseSequestrationAction::class);
    $app->post('/civilCaseDoc', civilCaseDocAction::class);
    $app->post('/checkCivilAssets', checkCivilAssetsAction::class);
    $app->post('/checkCivilAssets2', checkCivilAssets2Action::class);

    $app->post('/checkBankruptAssets', checkBankruptAssetsAction::class);
    $app->post('/bankruptAssetsBuilding', bankruptAssetsBuildingAction::class);
    $app->post('/bankruptCasePerson', bankruptCasePersonAction::class);
    $app->post('/bankruptCaseDetail', bankruptCaseDetailAction::class);
    $app->post('/bankruptAssetsMachinery', bankruptAssetsMachineryAction::class);
    $app->post('/bankruptAssetsBond', bankruptAssetsBondAction::class);
    $app->post('/bankruptAssetsLottery', bankruptAssetsLotteryAction::class);
    $app->post('/bankruptAssetsVechicle', bankruptAssetsVechicleAction::class);
    $app->post('/bankruptAssetsRent', bankruptAssetsRentAction::class);
    $app->post('/bankruptAssetsInsurance', bankruptAssetsInsuranceAction::class);
    $app->post('/bankruptAssetsOther', bankruptAssetsOtherAction::class);
    $app->post('/bankruptCourtOrder', bankruptCourtOrderAction::class);
    $app->post('/bankruptDoc', bankruptDocAction::class);
    $app->post('/bankruptAssetsFirearm', bankruptAssetsFirearmAction::class);
    $app->post('/bankruptAssetsStock', bankruptAssetsStockAction::class);
    $app->post('/bankruptAssetsFund', bankruptAssetsFundAction::class);
    $app->post('/bankruptAssetsMoney', bankruptAssetsMoneyAction::class);
    $app->post('/bankruptAssetsBookBank', bankruptAssetsBookBankAction::class);
    $app->post('/bankruptCmdOffice', bankruptCmdOfficeAction::class);
    $app->post('/bankruptCaseCreditor', bankruptCaseCreditorAction::class);
    $app->post('/bankruptAssetsCondo', bankruptAssetsCondoAction::class);
    $app->post('/bankruptAssetsLand', bankruptAssetsLandAction::class);
    $app->post('/bankrupAssetsMachinery', bankrupAssetsMachineryAction::class);
    $app->post('/bankruptCasePerBankrupt', bankruptCasePerBankruptAction::class);
    $app->post('/bankruptAssetsCoop', bankruptAssetsCoopAction::class);
    $app->post('/bankruptAssetsLegal', bankruptAssetsLegalAction::class);

    $app->post('/DebtRehabilitationCaseDebtor', DebtRehabilitationCaseDebtorAction::class);
    $app->post('/DebtRehabilitationCaseCreditor', DebtRehabilitationCaseCreditorAction::class);
    $app->post('/DebtRehabilitationCaseDetail', DebtRehabilitationCaseDetailAction::class);
    $app->post('/DebtRehabilitationCmdOffice', DebtRehabilitationCmdOfficeAction::class);

    $app->post('/MediateCaseDetail', MediateCaseDetailAction::class);
    $app->post('/MediatePerson', MediatePersonAction::class);
    $app->post('/MediateCmdOffice', MediateCmdOfficeAction::class);

    $app->post('/BackOfficeUser', BackOfficeUserAction::class);
    $app->post('/CmdBankRupt', CmdBankRuptAction::class);
    $app->post('/CmdBankRuptDetails', CmdBankRuptDetailsAction::class);
    $app->post('/civilCaseAssetsBuildingRent', civilCaseAssetsBuildingRentAction::class);
    $app->post('/getAnnounceCivilCase', getAnnounceCivilCaseAction::class);
    $app->post('/getAnnounceCivilCaseResult', getAnnounceCivilCaseResultAction::class);

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });
};
