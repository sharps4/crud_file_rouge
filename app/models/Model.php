<?php
    abstract class Model
    {
        public const TABLE        = '';
        public const UNIQUECOLUMN = '';
        public const COLUMNS      = [];

        public array $data = [];


        public function __construct(
            array $data = []
        ) {
            foreach (get_class($this)::COLUMNS as $name => $params)
            {
                if (array_key_exists($name, $data))
                {
                    $this->data[$name] = $data[$name];             
                }
                else if (array_key_exists('default', $params))
                {
                    $this->data[$name] = $params['default'];
                }
                else
                {
                    $this->data[$name] = null;
                }
            }
        }

        public function insert() : void
        {
            Database::insert(
                get_class($this)::TABLE,
                $this->data
            );
        }

        public function update() : void
        {
            $uniqueColumn = get_class($this)::UNIQUECOLUMN;
            $set = [];
            foreach ($this->data as $column => $value)
            {
                if ($column !== $uniqueColumn)
                {
                    $set[$column] = ":$column";
                }
            }
            Database::update(
                get_class($this)::TABLE,
                $set,
                $uniqueColumn.' = :'.$uniqueColumn,
                $this->data
            );
        }

        public function delete() : void
        {
            $uniqueColumn = get_class($this)::UNIQUECOLUMN;
            Database::delete(
                get_class($this)::TABLE,
                $uniqueColumn.' = :'.$uniqueColumn,
                [$uniqueColumn => $this->data[$uniqueColumn]]
            );
        }

        public static function findOne(
            string|int $id
        ) : ?object
        {
            $uniqueColumn = get_called_class()::UNIQUECOLUMN;
            $result = Database::select(
                get_called_class()::TABLE,
                $uniqueColumn.' = :'.$uniqueColumn,
                [$uniqueColumn => $id]
            );
            return count($result) === 0 ? null : new (get_called_class())($result[0]);
        }

        public static function findAll() : array
        {
            $result = [];
            foreach (Database::select(get_called_class()::TABLE) as $entry)
            {
                $result[] = new (get_called_class())($entry);
            }
            return $result;
        }

        public static function deleteAll() : void
        {
            Database::delete(get_called_class()::TABLE);
        }
    }
?>