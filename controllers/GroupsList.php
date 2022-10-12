<?php
/* controllers/GroupsList.php */

namespace app\controllers;
use app\core\Controller;
use app\core\Request;
use app\core\Auth;
use app\models\GroupsModel;

class GroupsList extends Controller
{
    public $groups;

    public $bookmarks;

    public array $menu;

    public function __construct()
    {
        $this->groups = new GroupsModel();
        $this->menu = [
            'site_name' => 'Bookmarks',
            'ver' => 'v0.0.4',
            'groups' => $this->groups->loadList([
                'groups'
            ])
        ];
    }

    public function groupsList(Request $request)
    {   
        $cat = $request->getBody();
        $id = $cat['block1'] ?? $id = "";
        if($id!="")
        {
            $this->groups->deleteOne('groups', $id);
            return $this->redirect('/groupslist');
        }
        $groups_list = $this->groups->loadList();
        $params = [
            'groupslist' => $groups_list,
            
        ];        
        return $this->render('groupslist', $this->menu, $params);
    }
}