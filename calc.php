<?php 
    $items          = $_POST["items"];
    $min_number     = $_POST['min_number'];
    $max_number     = $_POST['max_number'];
    $section_title  = $_POST['section_title'];
    $new_items = array();
    $all_array = array();

    for ($i = $min_number; $i <= $max_number; $i++) {
        foreach($items as $item) {
            $new_item = array();
            $new_items[$item['key'].$i]['type']          = $item['type'];
            $new_items[$item['key'].$i]['default_value'] = $item['default_value'];
            $new_items[$item['key'].$i]['label']         = str_replace("#num", $i , $item['label']);

            if($new_items[$item['key'].$i]['type'] == "image"){
                $new_items[$item['key'].$i]['filename']  = $item['key'].$i;
            }
        }
    }

    if(isset($section_title) && !empty($section_title)){
        $all_array['name']      = $section_title;
        $all_array['settings']  = $new_items; 
    }else {
        $all_array              = $new_items;
    }

    // var_dump($section_array);die();

    echo json_encode($all_array,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
?>