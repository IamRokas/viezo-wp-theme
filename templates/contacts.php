<?php

/**
 * Template name: Contacts
 */


get_header();
the_post();
$blocks = get_field('blocks');
?>

<main id="main" class="site-main contacts-page bg-dark-grey">

    <?php //get_template_part('partials/page-header'); 
    ?>

    <?php
    if (function_exists('yoast_breadcrumb')) {
        //yoast_breadcrumb( '<div class="big-container container pl-30 breadcrumbs pt-24">','</div>' );
    }
    ?>


    <div class="container justify-center">
        <div class="desktop:flex mb-48 mt-32 border-white border">
            <div class="col-1 flex flex-col desktop:w-1/2 desktop:border-r border-white overflow-hidden">
                <div
                    class="text-white px-24 desktop:px-44 pt-32 desktop:pt-48 pb-32 desktop:pb-40 page-content text-base">
                    <?php

                    the_content(
                        sprintf(
                            wp_kses(
                                /* translators: %s: Name of current post. */
                                esc_html__('Continue reading %s <span class="meta-nav">&rarr;</span>', 'viezo'),
                                [
                                    'span' => [
                                        'class' => [],
                                    ],
                                ]
                            ),
                            the_title('<span class="screen-reader-text">"', '"</span>', false)
                        )
                    );


                    ?>
                </div>

                <!-- Map: fills the rest of the column under the details (initMap() below). -->
                <div class="contacts-map">
                    <div id="map"></div>
                </div>
            </div>
            <div class="col-2 desktop:w-1/2 border-t border-white desktop:border-t-0">
                <div
                    class="text-white z-10 bg-dark-grey py-32 desktop:py-48 px-24 desktop:px-44 rounded-xl desktop:rounded-l-none">
                    <h2><?php esc_html_e('Contact us', 'viezo'); ?></h2>
                    <div class="flex w-full">
                        <?php
                        $contact_form_code = get_field('contact_form', false, false);
                        if (!empty($contact_form_code)) {
                            echo $contact_form_code;
                        }
                        ?>
                        <!-- <div class="pipedriveWebForms"
                            data-pd-webforms="https://webforms.pipedrive.com/f/cs1OmppKjwq28rtyapuEIgn8o1WiwsYsrtrPHN8RNtEmh2dl1qQDshwMcboDUwLP9N">
                            <script src="https://webforms.pipedrive.com/f/loader"></script>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php get_template_part('partials/contact-partners'); ?>

    <?php if (!empty($blocks)): foreach ($blocks as $block): ?>
    <?php echo get_template_part('partials/blocks/' . $block['acf_fc_layout'], null, ['block' => $block]); ?>
    <?php endforeach;
    endif;  ?>


</main><!-- #main -->
<!-- Load Maps JavaScript API with advanced markers support -->
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAELiycZg-eG40aQQwi15Xfu6-C8o8cvJE&callback=initMap&libraries=marker&v=beta"
    async defer>
</script>

<script>
const centerCoords = {
    lat: 54.648462096486234,
    lng: 25.12163756423617
};

const mapStyles = [{
        featureType: "all",
        stylers: [{
                saturation: 0
            },
            {
                hue: "#e7ecf0"
            }
        ]
    },
    {
        featureType: "road",
        stylers: [{
            saturation: -70
        }]
    },
    {
        featureType: "transit",
        stylers: [{
            visibility: "off"
        }]
    },
    {
        featureType: "poi",
        stylers: [{
            visibility: "off"
        }]
    },
    {
        featureType: "water",
        stylers: [{
                visibility: "simplified"
            },
            {
                saturation: -60
            }
        ]
    }
];

window.initMap = function() {
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 11,
        center: centerCoords,
        disableDefaultUI: true,
        styles: mapStyles,
        mapId: 'fd1647ceb1cf854c'
    });

    map.addListener("click", (e) => {
        e.stop(); // Stop click propagation (for some map features)
    });

    // Optionally disable POI clickability
    map.setOptions({
        clickableIcons: false
    });

    // Create a custom icon image element
    const iconImage = document.createElement("img");
    iconImage.src = "<?= get_template_directory_uri(); ?>/build/images/icons/LocationOnBlue.svg";
    iconImage.style.width = "40px";
    iconImage.style.height = "40px";

    // Create the advanced marker
    new google.maps.marker.AdvancedMarkerView({
        position: centerCoords,
        map,
        content: iconImage
    });
};
</script>



<?php get_footer(); ?>

<!-- AIzaSyAxXxfomE-TlYsg1HbOOGHzh1eKLXZ19TI -->