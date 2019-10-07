<?php

use MVC\Controller;

class ControllersEndpoints  extends Controller
{

    public function listAllEndpoints()
    {
        $this->response->sendStatus(200);
        $this->response->setContent([
            'Endpoints'     => [
                'Users'     => [
                    '/api/v1/user/all'          => 'Gets a list of all the platform users',
                    '/api/v1/users/:id'         => 'Get a user by its :id',
                    '/api/v1/users/:username'   => 'Get a user by its username',
                ],
                'Accounts'  => [
                    '/api/v1/accounts/all'      => 'Gets a list of all the accounts',
                ],
                'Campaigns' => [
                    '/api/v1/campaigns/all'     => 'Gets a list of all the campaigns',
                ],
                'Reports'   => [
                    '/api/v1/reports/all'       => 'Gets a list of all the reports',
                ],
                'Schedules' => [
                    '/api/v1/schedules/all'     => 'Gets a list of all the schedules',
                ]
            ]
        ]);
    }




}
