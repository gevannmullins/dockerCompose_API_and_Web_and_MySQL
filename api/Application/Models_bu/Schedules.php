<?php

use MVC\Model;

class ModelsSchedules extends Model
{

    public function execQuery($sql)
    {
        // exec query
        $query = $this->db->query($sql);
        // Conclusion
        $data = [];
        if ($query->num_rows) {
            foreach($query->rows as $key => $value):
                $data[$key] = $value;
            endforeach;
        } else {
            $data[] = $query->rows;
        }
        return $data;
    }

    public function getAllApprovedCampaigns()
    {
        // sql statement
        $sql = "SELECT DISTINCT (T1.id),
        T3.client_name,
        T1.campaign_name,
        T1.campaign_channels,
        T1.campaign_used,
        T1.campaign_status,
        T1.audit_date
        FROM lg_campaigns AS T1
        INNER JOIN lg_campaigns_clients AS T2
        ON T1.id = T2.campaign_id
        INNER JOIN plat_clients AS T3
        ON T2.client_id = T3.client_id
        LEFT JOIN plat_client_accounts AS T4
        ON T3.client_id = T4.client_id
        LEFT JOIN plat_users_accounts AS T5
        ON T4.account_id = T5.account_id
        WHERE T3.client_id > 0
        AND T1.approval_status IN (1,5)
        AND T1.campaign_status = 1;";

        // exec query
        return $this->execQuery($sql);

    }

    public function getUserApprovedCampaigns($user_id, $offernet_account_id)
    {
        // sql statement
        $sql = "SELECT DISTINCT (T1.id),
        T3.client_name,
        T1.campaign_name,
        T1.campaign_channels,
        T1.campaign_used,
        T1.campaign_status,
        T1.audit_date
        FROM lg_campaigns AS T1
        INNER JOIN lg_campaigns_clients AS T2
        ON T1.id = T2.campaign_id
        INNER JOIN plat_clients AS T3
        ON T2.client_id = T3.client_id
        LEFT JOIN plat_client_accounts AS T4
        ON T3.client_id = T4.client_id
        LEFT JOIN plat_users_accounts AS T5
        ON T4.account_id = T5.account_id
        WHERE T3.client_id > 0
        AND T5.user_id=$user_id
        AND T2.offernet_account_id IN ($offernet_account_id)
        AND T1.approval_status IN (1,5)
        AND T1.campaign_status = 1;";

        // exec query
        return $this->execQuery($sql);

    }

    public function getUserAccounts($user_id)
    {

        $sql = "SELECT * FROM plat_users_accounts WHERE user_id='$user_id'";
        return $this->execQuery($sql);

    }




}