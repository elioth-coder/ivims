<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use PDO;

trait UploadCountTrait
{
    private function getUploadsPerProvince()
    {
        $pdo = DB::connection()->getPdo();
        $pdo->exec("SET SESSION sql_mode = (SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");
        $sql =
        "SELECT `province`, COUNT(*) AS `count`
        FROM `policy_holders`
        WHERE `id` IN (SELECT `policy_holder_id` FROM `policy_details`)
        GROUP BY `province`;
        ";

        $query = $pdo->prepare($sql);
        $query->execute();
        $items = $query->fetchAll(PDO::FETCH_CLASS, 'stdClass');

        return $items;
    }


    public function getUploadsPerCompany()
    {
        $pdo = DB::connection()->getPdo();
        $pdo->exec("SET SESSION sql_mode = (SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");
        $sql =
        "SELECT COUNT(`policy_details`.`id`) AS `count`, `companies`.`code`, `companies`.`name`
        FROM `policy_details`
        INNER JOIN companies
        ON policy_details.company_id=companies.id
        GROUP BY policy_details.company_id";

        $query = $pdo->prepare($sql);
        $query->execute();
        $items = $query->fetchAll(PDO::FETCH_CLASS, 'stdClass');

        return $items;
    }

    public function getUploadsPerMonth()
    {
        $pdo = DB::connection()->getPdo();
        $pdo->exec("SET SESSION sql_mode = (SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");
        $sql =
        "SELECT MONTH(date_issued) AS number, UPPER(MONTHNAME(date_issued)) AS month, COUNT(id) AS `count`
        FROM `policy_details`
        WHERE YEAR(date_issued)=:year
        GROUP BY month
        ORDER BY number ASC";

        $query = $pdo->prepare($sql);
        $query->execute([
            'year' => date('Y'),
        ]);
        $items = $query->fetchAll(PDO::FETCH_CLASS, 'stdClass');

        return $items;
    }
}
