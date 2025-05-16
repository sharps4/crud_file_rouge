<?php
    class StandController extends Controller
    {
        public function getAll() : void
        {
            if (Controller::postExists(['map']))
            {
                $result = [];
                foreach (StandModel::findByMap($_POST['map']) as $stand)
                {
                    $result[] = $stand->data;
                }
                Controller::renderJSON(['success' => true, 'data' => $result]);
            }
            Controller::renderJSON(['success' => false]);
        }

        public function create() : void
        {
            if (Controller::postExists(['name', 'map']) && MapModel::findOne($_POST['map']) && StandModel::findOne($_POST['name']) === null)
            {
                $stand = new StandModel([
                    'name' => $_POST['name'],
                    'map'  => $_POST['map'],
                ]);
                $stand->insert();
                Controller::renderJSON(['success' => true, 'data' => $stand->data]);
            }
            Controller::renderJSON(['success' => false]);
        }

        public function delete() : void
        {
            if (Controller::postExists(['name']))
            {
                $stand = StandModel::findOne($_POST['name']);
                if ($stand)
                {
                    $stand->delete();
                    Controller::renderJSON(['success' => true]);
                }
            }
            Controller::renderJSON(['success' => false]);
        }
    }
?>