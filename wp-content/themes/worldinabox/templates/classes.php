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

        $classes = get_field('classes', 'user_'.$current_user_id);
        if(is_array($classes) && count($classes) > 0) {
            $classNum = 0;
            foreach($classes as $class) {
                $unit = $class['unit']->slug;
                $className = $class['class_name'];
                $unitLessonTitles = $lessonTitles[$unit];
                $values = json_decode($class['results']);
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
                            echo '<span class="value" data-value="'.$values->$index.'">'.$values->$index.' Active Minutes</span>';
                        else :
                            echo '<span class="icon incomplete"></span>';
                            echo '<button data-classnum="'.$classNum.'" class="submit-minutes">Submit Active Minutes</button>';
                        endif;
                        echo '</div>';
                        $index++;
                }
                $index = 1;
                echo '
                <div class="form-container lesson-minutes-container" data-classnum="'.$classNum.'">
                <div class="form-container-container">
                <form class="lesson-minutes" action="" type="post" data-classnum="'.$classNum.'" id="'.$classNum.'-form">';
                echo '<h3 class="text__title">Update '.$className.' Active Minutes</h3>';
                    foreach($unitLessonTitles as $unitLesson) {
                        echo '<div class="input-container">
                                <input type="number" id="'.$classNum . '-' . $index.'" name="'.$index.'" value="'.$values->$index.'"/>
                                <label for="'.$classNum . '-' . $index.'">'.$unitLesson.'</label>
                            </div>';
                        $index++;
                    }
                    echo '<button class="submit-lesson-form btn" data-rowid="'.($classNum+1).'" data-classnum="'.$classNum.'" data-unit="'.$unit.'" data-userid="'.$current_user_id.'" data-className="'.$className.'">Update Active Minutes</button>
                    <p class="error"></p>
                </form>
                </div>
                </div>';
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
                        <?php $units = get_terms(array('taxonomy'=>'unit'));
                        foreach($units as $singleUnit)
                        {
                            echo '<option value="'.$singleUnit->slug.'">'.$singleUnit->name.'</option>';
                        }
                        ?>
                    </options>

                </select>
                <label for="class_unit">Unit</label>
            </div>
            <div class="buttonContainer">
                <button class="btn newClass">Save class</button>
                <p class="error"></p>
            </div>

        </form>
    </div>
</section>


<section>
    <div class="container container--inner">