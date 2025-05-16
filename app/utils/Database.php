<?php
    class Database
    {
        static private ?\PDO $pdo = null;


        static public function execute(
            string $query,
            array  $values = []
        ) : array
        {
            if (self::$pdo === null)
            {
                try
                {
                    self::$pdo = new \PDO(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
                }
                catch (\Throwable $th)
                {
                    die($th->getMessage());
                }
            }
            $stmt = self::$pdo->prepare($query);
            $stmt->execute($values);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        static public function select(
            string $table,
            string $where  = '',
            array  $values = []
        ) : array
        {
            $where = $where ? 'WHERE '.$where : '';
            return Database::execute(
                "SELECT * FROM $table $where;",
                $values
            );
        }

        static public function insert(
            string $table,
            array  $values
        ) : array
        {
            $columns = [];
            $placeholders = [];
            foreach ($values as $column => $value)
            {
                $columns[] = $column;
                $placeholders[] = ":$column";
            }
            $columns = implode(', ', $columns);
            $placeholders = implode(', ', $placeholders);
            return Database::execute(
                "INSERT INTO $table ($columns) VALUES ($placeholders);",
                $values
            );
        }

        static public function delete(
            string $table,
            string $where  = '',
            array  $values = []
        ) : array
        {
            $where = $where ? 'WHERE '.$where : '';
            return Database::execute(
                "DELETE FROM $table $where;",
                $values
            );
        }

        static public function update(
            string $table,
            array  $set,
            string $where  = '',
            array  $values = []
        ) : array
        {
            $update = [];
            foreach ($set as $column => $value)
            {
                $update[] = "$column = $value";
            }
            $update = 'SET '.implode(', ', $update);
            $where = $where ? 'WHERE '.$where : '';
            return Database::execute(
                "UPDATE $table $update $where;",
                $values
            );
        }
    }
?>