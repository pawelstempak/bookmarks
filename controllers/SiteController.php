<?php
/* controllers/SiteController.php */

namespace app\controllers;
use app\core\Controller;
use app\core\Request;
use app\core\Auth;
use app\models\GroupsModel;
use app\models\BookmarksModel;

class SiteController extends Controller
{
    public $groups;

    public $bookmarks;

    public array $menu;

    public function __construct()
    {
        $this->groups = new GroupsModel();
        $this->bookmarks = new BookmarksModel();
        $this->menu = [
            'site_name' => 'Bookmarks',
            'ver' => 'v0.0.1',
            'groups' => $this->groups->loadList()
        ];
    }

    public function home()
    {   
        return $this->render('home', $this->menu);
    }

    public function logout()
    {
        $user = new Auth();
        $user->SignOut();
        header('Location: /');       
    }

    public function groupsList()
    {   
        $groups_list = $this->groups->loadList();
        $params = [
            'groupslist' => $groups_list,
            
        ];        
        return $this->render('groupslist', $this->menu, $params);
    }

    public function newGroup(Request $request)
    {   
        if($request->isPost())
        {
            $this->groups->saveNewOne($request->getBody());
            return $this->redirect('/groupslist');
        }
        return $this->render('newgroup', $this->menu);
    }    

    public function bookmarksList()
    {   
        $bookmarks_list = $this->bookmarks->loadList();
        $params = [
            'bookmarkslist' => $bookmarks_list,
            
        ];        
        return $this->render('bookmarkslist', $this->menu, $params);
    }    

    public function newBookmark(Request $request)
    {   
        if($request->isPost())
        {
            $this->bookmarks->saveNewOne($request->getBody());
            return $this->redirect('/bookmarkslist');
        }
        return $this->render('newbookmark', $this->menu);
    }        
}