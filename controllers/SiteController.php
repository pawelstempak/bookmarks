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
            'ver' => 'v0.0.4',
            'groups' => $this->groups->loadList([
                'groups'
            ])
        ];
    }

    public function home()
    {   
        $favorites = $this->bookmarks->loadList(
            [
            'bookmarks'
            ],
            [
            'star' => 1
            ]
        );
        $params = [
            'favorites_bookmarks' => $favorites,
            
        ];          
        return $this->render('home', $this->menu, $params);
    }

    public function logout()
    {
        $user = new Auth();
        $user->SignOut();
        header('Location: /');       
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

    public function newGroup(Request $request)
    {   
        if($request->isPost())
        {
            $this->groups->saveNewOne($request->getBody());
            return $this->redirect('/groupslist');
        }
        return $this->render('newgroup', $this->menu);
    }    

    public function bookmarksList(Request $request)
    {   
        $cat = $request->getBody();
        $id = $cat['block1'] ?? $id = "";
        if($id!="")
        {
            $this->groups->deleteOne('bookmarks', $id);
            return $this->redirect('/bookmarkslist');
        }        
        $bookmarks_list = $this->bookmarks->loadList(['bookmarks']);
        $params = [
            'bookmarkslist' => $bookmarks_list
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
        $groups_list = $this->groups->loadList();
        $params = [
            'groupslist' => $groups_list
        ];          
        return $this->render('newbookmark', $this->menu, $params);
    }        

    public function viewGroup(Request $request)
    {   
        $category = $request->getBody();
        $category_name = $this->groups->loadName($category['block1']);
        $bookmarks = $this->bookmarks->loadList(
            [
                'relations', 'bookmarks'
            ],            
            [
                'relations.id_group' => $category['block1'],
                'relations.id_bookmarks' => 'bookmarks.id'
            ]
        );
        
        $params = [
            'bookmarks' => $bookmarks,
            'category_name' => $category_name
        ];          
        return $this->render('viewgroup', $this->menu, $params);
    }

    public function editGroup(Request $request)
    {
        $groups_data = $request->getBody();
        if($request->isPost())
        {
            $this->groups->saveGroup($groups_data, $groups_data['id']);
            return $this->redirect('/groupslist');
        }
        $params = $this->groups->loadOne(['groups'], ['id'=>$groups_data['block1']]);
        return $this->render('editgroup', $this->menu, $params);
    }     

    public function editBookmark(Request $request)
    {
        $bookmarks_data = $request->getBody();
        if($request->isPost())
        {
            $this->bookmarks->saveBookmark($bookmarks_data, $bookmarks_data['id']);
            return $this->redirect('/bookmarkslist');
        }
        $bookmark_one = $this->bookmarks->loadOne([
            'bookmarks','relations'
        ], 
        [
            'relations.id_bookmarks' => $bookmarks_data['block1'],
            'bookmarks.id' => 'relations.id_bookmarks'
        ]);
        $groups_list = $this->groups->loadList();
        $params = [
            'groupslist' => $groups_list,
            'bookmark_one' => $bookmark_one
        ];          
        return $this->render('editbookmark', $this->menu, $params);
    }      
}