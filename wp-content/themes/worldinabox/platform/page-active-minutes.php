<?php
/**
*   Template name: Active Minutes
**/

get_template_part('platform/partials', 'header');

while ( have_posts() ) : the_post();
?>

<main>

<section>
        <div class="container text__center">
            <h1 class="text__center"><?php the_title(); ?></h1>
        </div>
</section>


<section class="cms bg__grey-light bg--grey-light-brush">
    <div class="container container--inner">
        <?php
            the_content();
        ?>
    </div>
</section>

<section>
    <header class="container container--inner">
        <h2>Your Classes</h2>
    </header>
    <div class="container container--inner classes">
    </div>
    <div class="container container--inner">
        <button class="btn newClass">Add a new class</button>

        <form action="#">
            <div class="input-container">
                <input type="text" name="Class Name" id="class_name"/>
                <label for="class_name">Class Name</label>
            </div>
            <div class="input-container">
                <select  name="Unit" id="class_unit">
                    <options>
                        <option value="unit_1">Unit 1</option>
                        <option value="unit_2">Unit 2</option>
                        <option value="unit_3">Unit 3</option>
                    </options>

                </select>
                <label for="class_unit">Unit</label>
            </div>
        </form>

    </div>
    

</section>

</main>
<?php endwhile;
