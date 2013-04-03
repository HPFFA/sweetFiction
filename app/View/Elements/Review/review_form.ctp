<?php
    
    $parameter = array(
        'url' => $this->Review->addUrl($reference_id, $parent),
        'style' => $this->Review->showFormAfter($parent) ? "display: block" : "display: none"
    );
    $text = '';
    $user_name = '';
    if (!empty($review)) {
        $parameter['url'] = $this->Review->editUrl($review);
        $parameter['id'] = "review_".$review['Review']['id']."_edit_form";
        $parameter['style'] = $this->Review->showFormFor($review) ? "display: block" : "display: none";
        $text = $review['Review']['text'];
    } 
    if (array_key_exists('text', $this->request->data['Review'])) {
        $text = $this->request->data['Review']['text'];
    }
    if ($this->Auth->user() == null && array_key_exists('user_name', $this->request->data['Review'])) {
        $user_name = $this->request->data['Review']['user_name'];
    } 

    echo $this->Form->create('Review', $parameter); 

        if ($this->Auth->user('id') == 0)
        {
            echo $this->Form->input('user_name', array('value' => $user_name));
        }
        $parent_id = $parent == null ? '0' : $parent['Review']['id'];
        $review_id = 0;
        if (!empty($this->request->data['Review']) && array_key_exists('id', $this->request->data['Review'])) {
            $this->request->data['Review']['id'];
        }

        echo $this->Editor->input('text', array('value' => $text, 'id' => 'ReviewText_'.$parent_id.'_'.$review_id));
        
    echo $this->Form->end(__('Submit')); 
   
    
?>
