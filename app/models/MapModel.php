<?php
    class MapModel extends Model
    {
        public const TABLE        = 'Map';
        public const UNIQUECOLUMN = 'name';
        public const COLUMNS      = [
            'name' => [],
        ];


        public function getName() : string
        {
            return $this->data['name'];
        }

        public function setName(
            string $name
        ) : void
        {
            $this->data['name'] = $name;
        }
    }
?>