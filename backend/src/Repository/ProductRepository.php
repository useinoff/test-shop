<?php
namespace Src\Repository;

use libphonenumber\PhoneNumberUtil;
use Src\Service\CurrencyService;

class ProductRepository {

    private $db;
    private $currencyService;

    /**
     * PhoneRepository constructor.
     * @param $db
     */
    public function __construct($db)
    {
        $this->db = $db;
        $this->currencyService = new CurrencyService();
    }

    /**
     * @param $limit
     * @param $page
     * @return mixed
     */
    public function findAll()
    {
        $statement = "
            SELECT 
                *
            FROM
                product;
        ";

        try {
            $statement = $this->db->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($result as &$item) {
                $item['price'] = $this->currencyService->convertInto($item['price']);
            }
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    /**
     * @return mixed
     */
    public function random()
    {
        $statement = "
            SELECT 
                *
            FROM
                product
            ORDER BY RAND()
            LIMIT 1
        ";

        try {
            $statement = $this->db->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($result as &$item) {
                $item['price'] = $this->currencyService->convertInto($item['price']);
            }
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
}