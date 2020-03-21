<?php

$current_user_id = get_current_user_id();

$units = get_terms(array(
    'taxonomy' => 'unit'
));

$lessonTitles = [];

foreach($units as $unit) {
    $unitLessons =  get_posts(array(
        'post_type' => 'lessons',
        'numberposts' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'unit',
                'field' => 'slug',
                'terms' => $unit->slug
            )
        )
    ));
    $unitTitles = [];
    foreach($unitLessons as $lesson) {
        array_push($unitTitles, $lesson->post_title);
    }
    $lessonTitles[$unit->slug] = $unitTitles;
}
?>

    </div>
</section>

<section>
    <header class="container container--inner">
        <h2 class="text__title">Your Classes</h2>
    </header>
    <div class="container container--inner">
    <div class="classes">
        <?php

        $exampleJson = '{"1":"10","2":null,"3":null,"4":null,"5":null,"6":null}';

        $classes = get_field('classes', 'user_'.$current_user_id);
        if(is_array($classes) && count($classes) > 0) {
            $classNum = 0;
            foreach($classes as $class) {
                $unit = $class['unit']->slug;
                $className = $class['class_name'];
                $unitLessonTitles = $lessonTitles[$unit];
                // $values = json_decode($class['results']);
                $values = json_decode($exampleJson);
                $index = 1;
                echo '<div class="class">
                <button class="expand-class" data-class="'.$classNum.'">'.$className.' <span class="toggle-icon"></span></button>';
                echo '<div class="lessons-container" data-class="'.$classNum.'">';
                foreach($unitLessonTitles as $unitLesson)
                {
                    $hasValue = ($values->$index != '') ? true : false;
                    echo 
                    '<div class="lesson">
                        <span class="title">Lesson '.$index.' - '.$unitLesson.'</span>';
                        if($hasValue) :
                            echo '<span class="icon complete"></span>';
                            echo '<span class="value">'.$values->$index.' Active Minutes</span>';
                        else :
                            echo '<span class="icon incomplete"></span>';
                            echo '<button data-classnum="'.$classNum.'" class="submit-minutes">Submit Active Minutes</button>';
                        endif;
                    echo '</div>';
                    $index++;
                }
                $classNum++;
                echo '</div></div>';
            }
        }
        ?>

    </div>
    </div>

    <div class="container container--inner add-new-class-container">
        <h2 class="text__title">Add a new class</h2>

        <form action="#" class="display--flex display--flex-wrap add-class-form" data-currentuserid="<?= $current_user_id;?>">
            <div class="input-container">
                <input type="text" name="Class Name" id="class_name" required/>
                <label for="class_name">Class Name</label>
            </div>
            <div class="input-container">
                <select  name="Unit" id="class_unit" required>
                    <options>
                        <option value="unit_1">Unit 1</option>
                        <option value="unit_2">Unit 2</option>
                        <option value="unit_3">Unit 3</option>
                    </options>

                </select>
                <label for="class_unit">Unit</label>
            </div>
            <button class="btn newClass">Save class</button>
        </form>
    </div>
</section>


<section>
    <div class="container container--inner">