<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class SearchController extends Controller
{
    private function getResultsCount($q)
    {
        $pdo = DB::connection()->getPdo();
        $_query = "%" . $q . "%";

        $sql =
       "SELECT COUNT(*) AS `count` FROM policy_holders
        WHERE first_name LIKE :query_1
        OR middle_name LIKE :query_2
        OR last_name LIKE :query_3
        OR suffix LIKE :query_4
        OR address LIKE :query_5
        ";

        $query = $pdo->prepare($sql);
        $query->execute([
            'query_1' => $_query,
            'query_2' => $_query,
            'query_3' => $_query,
            'query_4' => $_query,
            'query_5' => $_query,
        ]);
        $item = $query->fetchObject('stdClass');
        $policy_holders = $item->count;

        $sql =
       "SELECT COUNT(*) AS `count` FROM vehicle_details
        WHERE mv_file_no LIKE :query_1
        OR plate_no LIKE :query_2
        OR serial_no LIKE :query_3
        OR motor_no LIKE :query_4
        OR make LIKE :query_5
        OR model LIKE :query_6
        OR color LIKE :query_7
        ";

        $query = $pdo->prepare($sql);
        $query->execute([
            'query_1' => $_query,
            'query_2' => $_query,
            'query_3' => $_query,
            'query_4' => $_query,
            'query_5' => $_query,
            'query_6' => $_query,
            'query_7' => $_query,
        ]);
        $item = $query->fetchObject('stdClass');
        $insured_vehicles = $item->count;

        $sql =
       "SELECT COUNT(policy_details.id) AS `count` FROM policy_details
        INNER JOIN vehicle_premiums
        ON policy_details.premium_code=vehicle_premiums.code
        WHERE  policy_details.coc_no LIKE :query_1
        OR policy_details.policy_no LIKE :query_2
        OR policy_details.or_no LIKE :query_3
        OR vehicle_premiums.type LIKE :query_4
        ";

        $query = $pdo->prepare($sql);
        $query->execute([
            'query_1' => $_query,
            'query_2' => $_query,
            'query_3' => $_query,
            'query_4' => $_query,
        ]);
        $item = $query->fetchObject('stdClass');
        $authenticated_policies = $item->count;

        return [
            'policy_holders'         => $policy_holders,
            'insured_vehicles'       => $insured_vehicles,
            'authenticated_policies' => $authenticated_policies,
        ];
    }

    public function index()
    {
        return view('search.index');
    }

    public function policy_holders(Request $request)
    {
        $pdo = DB::connection()->getPdo();
        $_query = "%" . $request->query('query'). "%";

        $sql =
       "SELECT * FROM policy_holders
        WHERE first_name LIKE :query_1
        OR middle_name LIKE :query_2
        OR last_name LIKE :query_3
        OR suffix LIKE :query_4
        OR address LIKE :query_5
        ";

        $query = $pdo->prepare($sql);
        $query->execute([
            'query_1' => $_query,
            'query_2' => $_query,
            'query_3' => $_query,
            'query_4' => $_query,
            'query_5' => $_query,
        ]);
        $policy_holders = $query->fetchAll(PDO::FETCH_CLASS, 'stdClass');

        return view('search.policy_holders', [
            'count'          => $this->getResultsCount($request->query('query')),
            'policy_holders' => $policy_holders,
        ]);
    }

    public function insured_vehicles(Request $request)
    {
        $pdo = DB::connection()->getPdo();
        $_query = "%" . $request->query('query'). "%";

        $sql =
       "SELECT * FROM vehicle_details
        WHERE mv_file_no LIKE :query_1
        OR plate_no LIKE :query_2
        OR serial_no LIKE :query_3
        OR motor_no LIKE :query_4
        OR make LIKE :query_5
        OR model LIKE :query_6
        OR color LIKE :query_7
        ";

        $query = $pdo->prepare($sql);
        $query->execute([
            'query_1' => $_query,
            'query_2' => $_query,
            'query_3' => $_query,
            'query_4' => $_query,
            'query_5' => $_query,
            'query_6' => $_query,
            'query_7' => $_query,
        ]);
        $insured_vehicles = $query->fetchAll(PDO::FETCH_CLASS, 'stdClass');

        return view('search.insured_vehicles', [
            'count'            => $this->getResultsCount($request->query('query')),
            'insured_vehicles' => $insured_vehicles,
        ]);
    }

    public function authenticated_policies(Request $request)
    {
        $pdo = DB::connection()->getPdo();
        $_query = "%" . $request->query('query'). "%";

        $sql =
       "SELECT policy_details.*, vehicle_premiums.type FROM policy_details
        INNER JOIN vehicle_premiums
        ON policy_details.premium_code=vehicle_premiums.code
        WHERE  policy_details.coc_no LIKE :query_1
        OR policy_details.policy_no LIKE :query_2
        OR policy_details.or_no LIKE :query_3
        OR vehicle_premiums.type LIKE :query_4
        ";

        $query = $pdo->prepare($sql);
        $query->execute([
            'query_1' => $_query,
            'query_2' => $_query,
            'query_3' => $_query,
            'query_4' => $_query,
        ]);
        $authenticated_policies = $query->fetchAll(PDO::FETCH_CLASS, 'stdClass');

        return view('search.authenticated_policies', [
            'count'                  => $this->getResultsCount($request->query('query')),
            'authenticated_policies' => $authenticated_policies,
        ]);
    }
}
