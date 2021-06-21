<?php

/**
 *  All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace Hkreuter\GraphQL\CustomerGraph\Tests\Codeception\Acceptance;

use Codeception\Util\HttpCode;
use Hkreuter\GraphQL\CustomerGraph\Tests\Codeception\AcceptanceTester;

/**
 * @group customer_aboutme
 */
final class AboutMeCest
{
    public function testCannotSetAboutMeIfNotLoggedIn(AcceptanceTester $I): void
    {
        $I->wantToTest('cannot query aboutMe field without token');

        $result = $this->queryAboutMe($I);

        $I->assertSame(
            'Cannot query field "customer" on type "Query".',
            $result['errors'][0]['message']
        );
    }

    public function testSetAboutMeWithAnonymousToken(AcceptanceTester $I): void
    {
        $I->wantToTest('cannot query aboutMe field without anonymous token');

        $I->anonymousLoginToGraphQLApi();

        $result = $this->queryAboutMe($I);

        $I->assertSame(
            'Cannot query field "customer" on type "Query".',
            $result['errors'][0]['message']
        );
    }

    public function testSetAboutMe(AcceptanceTester $I): void
    {
        $I->wantToTest('can set and query aboutMe field when logged in');

        $I->loginToGraphQLApi('user@oxid-esales.com', 'useruser');

        $aboutMe = 'Never deliver on a Monday';
        $result  = $this->setCustomerAboutMe($I, $aboutMe);
        $I->assertEquals($aboutMe, $result['data']['customerAboutMe']['aboutMe']);

        $result = $this->queryAboutMe($I);
        $I->assertEquals($aboutMe, $result['data']['customer']['aboutMe']);

        $result = $this->setCustomerAboutMe($I, '');
        $I->assertEquals('', $result['data']['customerAboutMe']['aboutMe']);
    }

    public function testSetAboutMeException(AcceptanceTester $I): void
    {
        $I->wantToTest('cannot exceed aboutMe field limit');

        $I->loginToGraphQLApi('user@oxid-esales.com', 'useruser');

        $result = $this->setCustomerAboutMe($I, str_pad('x', 300));

        $I->assertEquals(
            'Input exceeds allowed length of max 256 characters',
            $result['errors'][0]['message']
        );
    }

    private function queryAboutMe(AcceptanceTester $I): array
    {
        $query = 'query {
                       customer  {
                          id
                          aboutMe
                       }
                  }';

        return $this->getGQLResponse($I, $query, []);
    }

    private function setCustomerAboutMe(AcceptanceTester $I, string $aboutMe): array
    {
        $query = 'mutation {
                       customerAboutMe (aboutMe: "' . $aboutMe . '") {
                          id
                          aboutMe
                       }
                  }';

        return $this->getGQLResponse($I, $query, []);
    }

    private function getGQLResponse(
        AcceptanceTester $I,
        string $query,
        array $variables = []
    ): array {
        $I->sendGQLQuery($query, $variables);
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();

        return $I->grabJsonResponseAsArray();
    }
}
