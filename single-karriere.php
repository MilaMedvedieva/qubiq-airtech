<?php
/**
 * The template for displaying all single posts
 */

get_header();
$subtitle = get_field('subtitle');
$big_title = get_field('big_title');
$contact_desc = get_field('description');
$contacts = get_field('contacts');
?>

    <section class="bg-white mb-8 lg:mb-14 mt-8 lg:mb-20">
        <div class="container px-4 mx-auto my-8">
            <?php if(!empty($big_title)): ?>
                <div class="text-right text-black-50 text-3xl md:text-4xl lg:text-5xl font-medium mb-4 lg:mb-8">
                    <h2><?php echo $big_title; ?></h2>
                </div>
                <div class="text-left text-green-50 text-2xl lg:text-4xl font-medium mb-4 lg:mb-8">
                    <h1 class="mb-3 lg:mb-7"><?php single_post_title(); ?></h1>
                    <h3 class="text-lg"><?php echo $subtitle;?></h3>
                </div>
            <?php else: ?>
                <div class="text-left text-green-50 text-2xl lg:text-4xl font-medium mb-4 lg:mb-8">
                    <h1 class="mb-3 lg:mb-7"><?php single_post_title(); ?></h1>
                    <h3 class="text-lg"><?php echo $subtitle;?></h3>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <section>
        <div class="container px-4 mx-auto my-5">
            <div class="grid lg:grid-flow-col lg:auto-cols-max  gap-12">
                <div>
                    <a href="/karriere"  target="_self" class="transition duration-500 ease-in-out text-green-50  text-lg font-light text-link">← zurück zur Übersicht</a>
                </div>
                <div class="text-black-50 text-base lg:text-lg font-light leading-8">
                    <div class="max-w-screen-sm post-content">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
    <?php if(!empty($contact_desc) or !empty($contacts)): ?>
    <section class="info_contacts post-content">
        <div class="container px-4 mx-auto my-8">
            <div class="sm:flex">
                <div class="flex-1">
                    <div class="max-w-screen-sm ml-auto sm:mr-32 text-black-10 text-xl lg:text-2xl font-light lg:leading-7 lg:leading-9">
                        <?php echo $contact_desc; ?>
                    </div>
                </div>
                <div class="flex-initial text-black-10 text-lg font-light">
                    <?php echo $contacts; ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
<?php
get_footer();
