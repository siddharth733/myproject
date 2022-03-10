<?php include('../includes/config.php') ?>
<?php

    if(isset($_POST['class_id']) && $_POST['class_id']){
        $class_id = $_POST['class_id'];
        $class_meta = get_metadata($class_id,'section');
        $output = '<option value="Select Class">-Select Section-</option>';
        foreach($class_meta as $meta){
            $show = get_posts(array('id'=>$meta->meta_value));
            $output .= '<option value="'.$show[0]->id.'">'.$show[0]->title.'</option>';
        }
        echo $output;
        die;
    }

?>