<?php
    class MapController extends Controller
    {
        public function index(
            array $params
        ) : void
        {
            Controller::renderPage([
                'title'   => 'Carte',
                'main'    => Controller::renderView('map'),
                'scripts' => ['map'],
            ]);
        }

        public function getAll() : void
        {
            $result = [];
            foreach (MapModel::findAll() as $map)
            {
                $result[] = $map->data;
            }
            Controller::renderJSON(['success' => true, 'data' => $result]);
        }

        public function create() : void
        {
            if (Controller::postExists(['name']) && MapModel::findOne($_POST['name']) === null)
            {
                $map = new MapModel(['name' => $_POST['name']]);
                $map->insert();
                Controller::renderJSON(['success' => true, 'data' => $map->data]);
            }
            Controller::renderJSON(['success' => false]);
        }

        public function delete() : void
        {
            if (Controller::postExists(['name']))
            {
                StandModel::deleteByMap($_POST['name']);
                $map = MapModel::findOne($_POST['name']);
                if ($map)
                {
                    $map->delete();
                    Controller::renderJSON(['success' => true]);
                }
            }
            Controller::renderJSON(['success' => false]);
        }
    }
?>