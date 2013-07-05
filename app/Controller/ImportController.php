<?php

class ImportController extends AppController {
    
    public function beforeFilter(){
        $this->Auth->allow('index');
    }

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $uses = array('User', 'UserContact', 'UserProfile', 'UserSetting', 'Story', 'StoryChapter', 'Review');

    private $tableprefix;
    private $stories_path;
    
    private function query($sql)
    {
        $result = mysql_query($sql) or 
            debug("Query:\t".$sql."\nError:\t(".mysql_errno().")\nErrorNumber:\t".mysql_error());
        return $result;
    }

    private function importUser()
    {
        $cursor = $this->query("SELECT * FROM `".$this->tableprefix."authors`") ;
        while ($row = mysql_fetch_array($cursor))
        {
           //debug($row);
            $this->User->create();
            $this->User->save(array('User' => array(
                'id' => $row['uid'],
                'name' => $row['penname'],
                'email' => $row['email'],
                'password' => $row['password'],
                'confirmation' => $row['password'],
                'created' => $row['date'],
                'updated' => $row['date'],
                'role' => $row['level'] + 1
            )));
            $this->UserProfile->create();
            $this->UserProfile->save(array('UserProfile' => array(
                'user_id' => $row['uid'],
                'real_name' => $row['realname'],
                'birthday' => empty($row['birth'])  ? '0000-00-00' : date("Y-m-d", strtotime($row['birth'])),
                'biography' => $row['bio'] 
            )));
            $this->UserContact->create();
            $this->UserContact->save(array('UserContact' => array(
                'user_id' => $row['uid'],
                'homepage' => $row['website'],
                'icq' => $row['ICQ'],
                'yahoo' => $row['Yahoo'],
                'msn' => $row['MSN'],
                'aol' => $row['AOL']
            )));
        }
    }

    private function importStories()
    {
        $cursor = $this->query("SELECT * FROM `".$this->tableprefix."stories`") ;
        while ($row = mysql_fetch_array($cursor))
        {
           //debug($row);
            $this->Story->create();
            $this->Story->save(array('Story' => array(
                'id' => $row['sid'],
                'user_id' => $row['uid'],
                'title' => $row['title'],
                'summary' => $row['summary'],
                'completed' => $row['completed'],
                'created' => $row['date'],
                'updated' => $row['updated'],
           )));
           $this->importChapterFor($row['sid']);
           $this->importStoryReviewsFor($row['sid']);
        }
    }

    private function importChapterFor($storyId)
    {
        $cursor = $this->query("SELECT * FROM `".$this->tableprefix."chapters` WHERE sid = '".$storyId."'");
        while ($row = mysql_fetch_array($cursor))
        {
            if (!$this->stories_in_database)
            {
                $file = $this->stories_path."/".$row['uid']."/".$row['chapid'].".txt";
                $handle = fopen($file, "r");
                $row['storytext'] = fread($handle, filesize($file));
                fclose($handle);        
            }
            $this->StoryChapter->create();
            $this->StoryChapter->save(array('StoryChapter' => array(
                'id' => $row['chapid'],
                'user_id' => $row['uid'],
                'story_id' => $storyId,
                'chapter_number' => $row['inorder'],
                'title' => $row['title'],
                'remarks' => $row['notes'],
                'created' => $row['created'],
                'updated' => $row['lastupdate'],
                'text' => $row['storytext']
            )));
            $this->importChapterReviewsFor($row['chapid']);
        }
    }

    private function importReviews($sql, $id, $type)
    {
        $cursor = $this->query($sql);
        while ($row = mysql_fetch_array($cursor))
        {
            if ($row['isDeleted']) continue;

            $this->Review->create();
            $this->Review->save(array('Review' => array(
                'reference_id' => $id,
                'reference_type' => $type,
                'user_id' => $row['member'],
                'user_name' => $row['reviewer'],
                'text' => $row['review'],
                'created' => $row['date'],
            )));
        }
    }

    private function importStoryReviewsFor($storyId)
    {
        $this->importReviews("SELECT * FROM `".$this->tableprefix."reviews` WHERE sid = '".$storyId."' AND chapid = '0' ", $storyId, 'story');
    }

    private function importChapterReviewsFor($chapterId)
    {
        $this->importReviews("SELECT * FROM `".$this->tableprefix."reviews` WHERE chapid = '".$chapterId."' ", $chapterId, 'story_chapter');
    }


    private function truncateTables()
    {
        $tables = array($this->User->table,  $this->UserContact->table, $this->UserProfile->table, $this->Story->table,
            $this->StoryChapter->table);
        debug("TRUNCATING ".implode($tables, ','));
        $source = ConnectionManager::getDataSource($this->User->useDbConfig);
        foreach ($tables as $table)
        {
            $source->execute("TRUNCATE ".$table);
        }
    }

    /**
     * Displays a view
     */
    public function index() {
        if ($this->request->is('post')) {
            set_time_limit(300);
            $data = $this->request->data['Import'];

            include($data['path_to_installation']."/config/general.php");
            include($data['path_to_installation']."/config/db.php");
            // this is part of db.php of efiction, therefore we do not need to repeat it
            // $mysql_access = mysql_connect(
            //     $data['host'], 
            //     $data['username'],
            //     $data['password']
            // );
            // mysql_select_db($data['database'], $mysql_access);
            $this->tableprefix = $tableprefix."fanfiction_";
            $this->stories_path = $data['path_to_installation']."/".$storiespath;
            $this->stories_in_database = $store == "database";

            $this->truncateTables();
            //
            $this->importUser();
            $this->importStories();
        }
    }
}
?>