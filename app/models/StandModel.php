<?php
    class StandModel extends Model
    {
        public const TABLE        = 'Stand';
        public const UNIQUECOLUMN = 'name';
        public const COLUMNS      = [
            'name'    => [],
            'map'     => [],
            'x'       => ['default' => 0],
            'y'       => ['default' => 0],
            'width'   => ['default' => 1],
            'height'  => ['default' => 1],
            'visited' => ['default' => false],
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

        public function getMap() : string
        {
            return $this->data['map'];
        }

        public function setMap(
            string $map
        ) : void
        {
            $this->data['map'] = $map;
        }

        public function getX() : int
        {
            return $this->data['x'];
        }

        public function setX(
            int $x
        ) : void
        {
            $this->data['x'] = $x;
        }

        public function getY() : int
        {
            return $this->data['y'];
        }

        public function setY(
            int $y
        ) : void
        {
            $this->data['y'] = $y;
        }

        public function getWidth() : int
        {
            return $this->data['width'];
        }

        public function setWidth(
            int $width
        ) : void
        {
            $this->data['width'] = $width;
        }

        public function getHeight() : int
        {
            return $this->data['height'];
        }

        public function setHeight(
            int $height
        ) : void
        {
            $this->data['height'] = $height;
        }

        public function getVisited() : bool
        {
            return $this->data['visited'];
        }

        public function setVisited(
            bool $visited
        ) : void
        {
            $this->data['visited'] = $visited;
        }

        public static function findByMap(
            string $map
        ) : array
        {
            $result = [];
            foreach (Database::select(self::TABLE, 'map = :map', ['map' => $map]) as $entry)
            {
                $result[] = new StandModel($entry);
            }
            return $result;
        }

        public static function deleteByMap(
            string $map
        ) : void
        {
            Database::delete(self::TABLE, 'map = :map', ['map' => $map]);
        }
    }
?>