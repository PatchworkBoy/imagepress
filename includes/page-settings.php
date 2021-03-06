<?php
function imagepress_admin_page() {

    /**
    if (empty(get_imagepress_option('ip_tracking'))) {
        echo '<div class="notice-warning settings-error notice is-dismissible"><p>We need your <a href="' . admin_url('edit.php?post_type=' . get_imagepress_option('ip_slug') . '&page=imagepress_admin_page&tab=settings_tab#tracking') . '">approval to collect data</a> regarding ImagePress plugin usage and its environment.</p></div>';
    }
    /**/
    ?>
    <div class="wrap">
        <h1>ImagePress Settings</h1>

        <?php
        $tab = (filter_has_var(INPUT_GET, 'tab')) ? filter_input(INPUT_GET, 'tab') : 'dashboard_tab';

        $i = get_imagepress_option('ip_slug');
        ?>
        <h2 class="nav-tab-wrapper ip-nav-tab-wrapper">
            <a href="edit.php?post_type=<?php echo $i; ?>&page=imagepress_admin_page&amp;tab=dashboard_tab" class="nav-tab <?php echo $tab == 'dashboard_tab' ? 'nav-tab-active' : ''; ?>"><?php _e('Dashboard', 'imagepress'); ?></a>
            <a href="edit.php?post_type=<?php echo $i; ?>&page=imagepress_admin_page&amp;tab=install_tab" class="nav-tab <?php echo $tab == 'install_tab' ? 'nav-tab-active' : ''; ?>"><?php _e('Installation', 'imagepress'); ?></a>
            <a href="edit.php?post_type=<?php echo $i; ?>&page=imagepress_admin_page&amp;tab=settings_tab" class="nav-tab <?php echo $tab == 'settings_tab' ? 'nav-tab-active' : ''; ?>"><?php _e('Settings', 'imagepress'); ?></a>
            <a href="edit.php?post_type=<?php echo $i; ?>&page=imagepress_admin_page&amp;tab=configurator_tab" class="nav-tab <?php echo $tab == 'configurator_tab' ? 'nav-tab-active' : ''; ?>"><?php _e('Configurator', 'imagepress'); ?></a>
            <?php if (get_imagepress_option('ip_mod_collections') == 1) { ?>
                <a href="edit.php?post_type=<?php echo $i; ?>&page=imagepress_admin_page&amp;tab=collections_tab" class="nav-tab <?php echo $tab == 'collections_tab' ? 'nav-tab-active' : ''; ?>"><?php _e('Collections', 'imagepress'); ?></a>
            <?php } ?>
            <a href="edit.php?post_type=<?php echo $i; ?>&page=imagepress_admin_page&amp;tab=label_tab" class="nav-tab <?php echo $tab == 'label_tab' ? 'nav-tab-active' : ''; ?>"><?php _e('Labels', 'imagepress'); ?></a>
            <a href="edit.php?post_type=<?php echo $i; ?>&page=imagepress_admin_page&amp;tab=upload_tab" class="nav-tab <?php echo $tab == 'upload_tab' ? 'nav-tab-active' : ''; ?>"><?php _e('Upload', 'imagepress'); ?></a>
            <a href="edit.php?post_type=<?php echo $i; ?>&page=imagepress_admin_page&amp;tab=authors_tab" class="nav-tab <?php echo $tab == 'authors_tab' ? 'nav-tab-active' : ''; ?>"><?php _e('Authors', 'imagepress'); ?></a>
            <?php if (get_imagepress_option('ip_mod_login') == 1) { ?>
                <a href="edit.php?post_type=<?php echo $i; ?>&page=imagepress_admin_page&amp;tab=login_tab" class="nav-tab <?php echo $tab == 'login_tab' ? 'nav-tab-active' : ''; ?>"><?php _e('Login', 'imagepress'); ?></a>
            <?php } ?>
            <a href="edit.php?post_type=<?php echo $i; ?>&page=imagepress_admin_page&amp;tab=fields_tab" class="nav-tab <?php echo $tab == 'fields_tab' ? 'nav-tab-active' : ''; ?>"><?php _e('Fields', 'imagepress'); ?></a>

            <a href="edit.php?post_type=<?php echo $i; ?>&page=imagepress_admin_page&amp;tab=notifications_tab" class="nav-tab <?php echo $tab == 'notifications_tab' ? 'nav-tab-active' : ''; ?>"><i class="fa fa-fw fa-bell"></i>&nbsp;</a>

            <a href="edit.php?post_type=<?php echo $i; ?>&page=imagepress_admin_page&amp;tab=extensions" class="nav-tab <?php echo $tab == 'extensions' ? 'nav-tab-active' : ''; ?>"><i class="fa fa-star" aria-hidden="true" style="color:#E74C3C;"></i> Extensions</a>
        </h2>

        <?php if($tab == 'dashboard_tab') {
            global $wpdb;

            // Get the WP built-in version
            $ipdata = get_plugin_data(IP_PLUGIN_FILE_PATH);

            echo '<div id="gb-ad">
                <h3 class="gb-handle">Thank you for using ImagePress!</h3>
                <div id="gb-ad-content">
                    <div class="inside">
                        <img src="' . IP_PLUGIN_URL . '/img/gb-logo-white-512.png" alt="getButterfly">';

                        // Check if Noir UI theme exists
                        $noir_ui_theme = wp_get_theme('noir-ui');
                        if($noir_ui_theme->exists()) {
                            echo '<h4>You are using <strong>' . $noir_ui_theme->get('Name') . '</strong> theme version ' . $noir_ui_theme->get('Version') . '</h4>';
                        } else {
                            echo '<h4>Check out <a href="https://getbutterfly.com/marketplace/noir-ui-theme-wordpress/" rel="external" target="_blank">Noir UI</a>, our accompanying theme for ImagePress. With customizable elements and colours, Noir UI lets your image gallery stand out from less developed alternatives.</h4>';
                        }

                        echo '<hr>
                        <p>If you enjoy this plugin, do not forget to <a href="https://codecanyon.net/item/imagepress/4252736" rel="external">rate it on CodeCanyon</a>! We work hard to update it, fix bugs, add new features and make it compatible with the latest web technologies.</p>
                    </div>
                    <div class="gb-footer">
                        <p>For support, feature requests and bug reporting, please visit the <a href="https://getbutterfly.com/?utm_source=plugin&utm_medium=link&utm_campaign=imagepress" rel="external">official website</a>.<br>&copy;' . date('Y') . ' <a href="https://getbutterfly.com/" rel="external"><strong>getButterfly</strong>.com</a> &middot; <a href="https://getbutterfly.com/members/documentation/imagepress/">Documentation</a> &middot; <small>Code wrangling since 2005</small></p>
                    </div>
                </div>
            </div>';

            echo '<p>
                <small>You are using ImagePress plugin version <strong>' . $ipdata['Version'] . '</strong>.</small><br>
                <small>You are using PHP version ' . PHP_VERSION . ' and MySQL server version ' . $wpdb->db_version() . '.</small>
            </p>

            <h3>Shortcodes</h3>
            <p>
                <b>Note #1:</b> All parameters are optional. They are shown for reference only and to illustrate various scenarios.<br>
                <b>Note #2:</b> Deprecated shortcodes will be removed in future versions of ImagePress. All deprecated shortcodes have a better equivalent, so check the list below and pick the one that applies to your requirements.
            </p>
            <p>
                <code>[imagepress-add]</code> - show the submission form.<br>
                <code>[imagepress-add category="landscapes"]</code> - show the submission form with a fixed (hidden) category. Use the category <b>slug</b>.<br>
                <code>[imagepress-add-bulk]</code> - show the bulk submission form.<br>
                <br>
                <code>[imagepress-search]</code> - show the search form.<br>
                <br>
                <code>[imagepress-loop]</code> <sup class="ip-new">new</sup> - display all images.<br>
                <code>[imagepress-loop user="7"]</code> <sup class="ip-new">new</sup> - filter images by user ID.<br>
                <code>[imagepress-loop count="4"]</code> <sup class="ip-new">new</sup> - display a specific number of images.<br>
                <code>[imagepress-loop filters="yes"]</code> <sup class="ip-new">new</sup> - display all images with filters/sorters.<br>
                <code>[imagepress-loop category="landscapes"]</code> <sup class="ip-new">new</sup> - display all images in a specific category. Use the category <b>slug</b>.<br>
                <code>[imagepress-loop fieldname="album" fieldvalue="red"]</code> <sup class="ip-new">new</sup> - display all images with a specific custom field value.<br>
                <br>
                <code>[imagepress mode="views" count="10"]</code> - display most viewed images (list).<br>
                <code>[imagepress mode="views" type="top" count="1"]</code> - display the most viewed image.<br>
                <code>[imagepress mode="likes" count="10"]</code> - display most liked/voted images (list).<br>
                <code>[imagepress mode="likes" type="top" count="1"]</code> - display the most voted image.<br>
                <br>
                <code>[notifications]</code> - display the notifications.<br>
                <br>
                <code>[imagepress-collections count="X"]</code> - display X collections.<br>
                <br>
                <code>[cinnamon-profile]</code> <sup class="ip-optional">optional</sup> - show user profile on a custom page, such as <b>My Profile</b> or <b>View My Portfolio</b>.<br>
                <code>[cinnamon-profile author="17"]</code> <sup class="ip-optional">optional</sup> - show a certain user profile on a page, where <b>17</b> is the user ID.<br>
            </p>

            <h3>Custom styling</h3>
            <p>See <code>/documentation/single-image.php</code> for a sample single image template. Match it with your <code>/single.php</code> template structure and drop it in your active theme.</p>
            <p>Use the <code>.ip_box_img</code> class to activate lightboxes (based on element class).</p>';
        } ?>
        <?php if($tab == 'install_tab') { ?>
            <h2><?php _e('Installation', 'imagepress'); ?></h2>
            <p>Check the installation steps below and make the required changes.</p>
            <?php
            $slug = $i;
            $author_slug = get_imagepress_option('cinnamon_author_slug');
            $author_login_url = get_imagepress_option('cinnamon_account_page');
            $author_edit_url = get_imagepress_option('cinnamon_edit_page');
            $cinnamon_mod_login = get_imagepress_option('cinnamon_mod_login');
            $ip_profile_page = get_imagepress_option('ip_profile_page');

            $single_template = 'single-' . $slug . '.php';

            echo '<div class="gb-assistant">';
                if ($slug == '') {
                    echo '<p><div class="dashicons dashicons-no"></div> <b>Error:</b> Your image slug is not set. Go to <b>Configurator</b> section and set it.</p>';
                } else {
                    echo '<p><div class="dashicons dashicons-yes"></div> <b>Note:</b> Your image slug is <code>' . $slug . '</code>. If you changed it recently, visit your <b>Permalinks</b> section and resave the changes.</p>';
                }
                if ('' != locate_template($single_template)) {
                    echo '<p><div class="dashicons dashicons-yes"></div> <b>Note:</b> Your image template is available.</p>';
                } else {
                    echo '<p><div class="dashicons dashicons-no"></div> <b>Error:</b> Your image template is not available. Duplicate your <code>single.php</code> template file inside your theme folder, rename it as <code>' . $single_template . '</code> and replace the <code>the_content()</code> section with the code from the sample template file inside the /documentation/ folder.</p>';
                }
            echo '</div>';

            echo '<div class="gb-assistant">';
                if ($author_slug == '') {
                    echo '<p><div class="dashicons dashicons-no"></div> <b>Error:</b> Your author slug is not set. Go to <b>Authors</b> section and set it.</p>';
                } else {
                    echo '<p><div class="dashicons dashicons-yes"></div> <b>Note:</b> Your author slug is <code>' . $author_slug . '</code>. If you changed it recently, visit your <b>Permalinks</b> section and resave the changes.</p>';
                }
                if ($ip_profile_page == 0) {
                    echo '<p><div class="dashicons dashicons-no"></div> <b>Error:</b> Your profile page is not set. Go to <b>Authors</b> section and set it.</p>';
                } else {
                    echo '<p><div class="dashicons dashicons-yes"></div> <b>Note:</b> Your profile page is <b>' . get_the_title($ip_profile_page) . '</b>. If you changed it recently, visit your <b>Permalinks</b> section and resave the changes.</p>';
                }
                if (empty($author_login_url) && $cinnamon_mod_login == 1) {
                    echo '<p><div class="dashicons dashicons-no"></div> <b>Error:</b> Your author login URL is not set. Go to <b>Authors</b> section and set it.</p>';
                } else if (!empty($author_login_url) && $cinnamon_mod_login == 1) {
                    echo '<p><div class="dashicons dashicons-yes"></div> <b>Note:</b> Your author login URL is <code>' . $author_login_url . '</code>.</p>';
                }
                if (empty($author_edit_url)) {
                    echo '<p><div class="dashicons dashicons-no"></div> <b>Error:</b> Your author profile edit URL is not set. Go to <b>Authors</b> section and set it.</p>';
                } else {
                    echo '<p><div class="dashicons dashicons-yes"></div> <b>Note:</b> Your author profile edit URL is <code>' . $author_edit_url . '</code>.</p>';
                }
                if (get_option('default_role') == 'author') {
                    echo '<p><div class="dashicons dashicons-yes"></div> <b>Note:</b> New user default role is <code>author</code>. Subscribers and contributors are not able to edit their uploaded images.</p>';
                } else {
                    echo '<p><div class="dashicons dashicons-no"></div> <b>Error:</b> New user default role should be <code>author</code> in order to allow for front-end image editing. Subscribers and contributors are not able to edit their uploaded images. <a href="' . admin_url('options-general.php') . '">Change it</a>.</p>';
                }
            echo '</div>';

            if (isset($_POST['isResetSubmit'])) {
                global $wpdb;

                $wpdb->query("UPDATE " . $wpdb->prefix . "postmeta SET meta_value = '0' WHERE meta_key = '_like_count'");
                echo '<div class="updated notice is-dismissible"><p>Action completed successfully!</p></div>';
            }
            ?>

            <h3><?php _e('Maintenance', 'imagepress'); ?></h3>
            <form method="post" action="">
                <p>
                    <input type="submit" name="isResetSubmit" value="Reset all likes" class="button-primary">
                    <br><small>This option resets all image likes to 0. This action is irreversible.</small>
                </p>
            </form>
        <?php }
        if ($tab == 'configurator_tab') {
            if (isset($_POST['isGSSubmit'])) {
                $ipUpdatedOptions = array(
                    'ip_box_ui' => $_POST['ip_box_ui'],
                    'ip_grid_ui' => $_POST['ip_grid_ui'],
                    'ip_ipw' => $_POST['ip_ipw'],
                    'ip_ipp' => $_POST['ip_ipp'],
                    'ip_app' => $_POST['ip_app'],
                    'ip_order' => $_POST['ip_order'],
                    'ip_orderby' => $_POST['ip_orderby'],
                    'ip_slug' => $_POST['ip_slug'],
                    'ip_image_size' => $_POST['ip_image_size'],
                    'ip_title_optional' => $_POST['ip_title_optional'],
                    'ip_meta_optional' => $_POST['ip_meta_optional'],
                    'ip_views_optional' => $_POST['ip_views_optional'],
                    'ip_comments' => $_POST['ip_comments'],
                    'ip_likes_optional' => $_POST['ip_likes_optional'],
                    'ip_author_optional' => $_POST['ip_author_optional'],
                    'ip_rel_tag' => $_POST['ip_rel_tag'],
                );
                $ipOptions = get_option('imagepress');
                $ipUpdate = array_merge($ipOptions, $ipUpdatedOptions);
                update_option('imagepress', $ipUpdate);

                echo '<div class="updated notice is-dismissible"><p>Settings updated successfully!</p></div>';
            }
            ?>
            <form method="post" action="">
                <h2><?php _e('Grid Configurator', 'imagepress'); ?></h2>
                <p>The <b>Grid configurator</b> allows you to select which information will be visible inside the image box.</p>
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label>Image box appearance</label></th>
                            <td>
                                <select name="ip_box_ui" id="ip_box_ui">
                                    <option value="default"<?php if ((string) get_imagepress_option('ip_box_ui') === 'default') echo ' selected'; ?>>Default</option>
                                    <option value="overlay"<?php if ((string) get_imagepress_option('ip_box_ui') === 'overlay') echo ' selected'; ?>>Overlay</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label>Image grid display</label></th>
                            <td>
                                <select name="ip_grid_ui" id="ip_grid_ui">
                                    <option value="basic"<?php if ((string) get_imagepress_option('ip_grid_ui') === 'basic') echo ' selected'; ?>>Basic (no styling)</option>
                                    <option value="default"<?php if ((string) get_imagepress_option('ip_grid_ui') === 'default') echo ' selected'; ?>>Default (equal height containers)</option>
                                    <option value="masonry"<?php if ((string) get_imagepress_option('ip_grid_ui') === 'masonry') echo ' selected'; ?>>Masonry</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label>Image box details</label></th>
                            <td>
                            <p>
                                <input name="ip_slug" id="slug" type="text" class="regular-text" placeholder="Image slug" value="<?php echo get_imagepress_option('ip_slug'); ?>" required> <label for="ip_slug"><b>Image</b> slug</label>
                                <br><small>Use an appropriate slug for your image (e.g. <b>image</b> in <code>domain.com/<b>image</b>/myimage</code>).</small>
                                <br><small>Tip: use a singular term, one word only, lowercase, letters only (examples: image, poster, illustration).</small>
                            </p>
                            <p>
                                <select name="ip_image_size" id="ip_image_size">
                                    <optgroup label="WordPress (default)">
                                        <option value="thumbnail"<?php if (get_imagepress_option('ip_image_size') == 'thumbnail') echo ' selected'; ?>>Thumbnail</option>
                                        <option value="medium"<?php if (get_imagepress_option('ip_image_size') == 'medium') echo ' selected'; ?>>Medium</option>
                                    </optgroup>
                                    <optgroup label="ImagePress (default)">
                                        <option value="imagepress_sq_std"<?php if (get_imagepress_option('ip_image_size') == 'imagepress_sq_std') echo ' selected'; ?>>Standard (Square)</option>
                                        <option value="imagepress_pt_std"<?php if (get_imagepress_option('ip_image_size') == 'imagepress_pt_std') echo ' selected'; ?>>Standard (Portrait)</option>
                                        <option value="imagepress_ls_std"<?php if (get_imagepress_option('ip_image_size') == 'imagepress_ls_std') echo ' selected'; ?>>Standard (Landscape)</option>
                                    </optgroup>
                                    <optgroup label="Other registered sizes (use with care)">
                                        <?php
                                        $ip_image_size = get_imagepress_option('ip_image_size');
                                        $thumbsize = isset($ip_image_size) ? esc_attr($ip_image_size) : '';
                                        $image_sizes = ip_return_image_sizes();
                                        foreach ($image_sizes as $size => $atts) {
                                            if ((int) $atts[0] !== 0 && (int) $atts[1] !== 0) {
                                                ?>
                                                <option value="<?php echo $size ;?>" <?php selected($thumbsize, $size); ?>><?php echo $size . ' - ' . implode('x', $atts); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </optgroup>
                                </select> <label for="ip_image_size"><b>Image box</b> thumbnail size</label>
                                <br><small>Use <b>thumbnail</b>, adjust the column size to match your thumbnail size and hide the description in order to have uniform sizes</small>
                            </p>
                            <p>
                                <select name="ip_title_optional" id="ip_title_optional">
                                    <option value="0"<?php if(get_imagepress_option('ip_title_optional') == 0) echo ' selected'; ?>>Hide image title</option>
                                    <option value="1"<?php if(get_imagepress_option('ip_title_optional') == 1) echo ' selected'; ?>>Show image title</option>
                                </select>
                                <label for="ip_title_optional">Show/hide image title</label>
                            </p>
                            <p>
                                <select name="ip_meta_optional" id="ip_meta_optional">
                                    <option value="0"<?php if(get_imagepress_option('ip_meta_optional') == 0) echo ' selected'; ?>>Hide image meta</option>
                                    <option value="1"<?php if(get_imagepress_option('ip_meta_optional') == 1) echo ' selected'; ?>>Show image meta</option>
                                </select>
                                <label for="ip_meta_optional">Show/hide the image meta (category/taxonomy)</label>
                            </p>
                            <p>
                                <select name="ip_views_optional" id="ip_views_optional">
                                    <option value="0"<?php if(get_imagepress_option('ip_views_optional') == 0) echo ' selected'; ?>>Hide image views</option>
                                    <option value="1"<?php if(get_imagepress_option('ip_views_optional') == 1) echo ' selected'; ?>>Show image views</option>
                                </select>
                                <label for="ip_views_optional">Show/hide the number of image views</label>
                            </p>
                            <p>
                                <select name="ip_likes_optional" id="ip_likes_optional">
                                    <option value="0"<?php if(get_imagepress_option('ip_likes_optional') == 0) echo ' selected'; ?>>Hide image likes</option>
                                    <option value="1"<?php if(get_imagepress_option('ip_likes_optional') == 1) echo ' selected'; ?>>Show image likes</option>
                                </select>
                                <label for="ip_likes_optional">Show/hide the number of image likes</label>
                            </p>
                            <p>
                                <select name="ip_comments" id="ip_comments">
                                    <option value="0"<?php if(get_imagepress_option('ip_comments') == '0') echo ' selected'; ?>>Hide image comments</option>
                                    <option value="1"<?php if(get_imagepress_option('ip_comments') == '1') echo ' selected'; ?>>Show image comments</option>
                                </select>
                                <label for="ip_comments">Show/hide the number of image comments</label>
                            </p>
                            <p>
                                <select name="ip_author_optional" id="ip_author_optional">
                                    <option value="0"<?php if(get_imagepress_option('ip_author_optional') == 0) echo ' selected'; ?>>Hide image author</option>
                                    <option value="1"<?php if(get_imagepress_option('ip_author_optional') == 1) echo ' selected'; ?>>Show image author</option>
                                </select>
                                <label for="ip_author_optional">Show/hide the author name and link</label>
                            </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label>Lightbox integration</label></th>
                            <td>
                                <p>
                                    <code>rel="</code><input name="ip_rel_tag" id="ip_rel_tag" type="text" class="regular-text" placeholder="lightbox" value="<?php echo get_imagepress_option('ip_rel_tag'); ?>"><code>"</code> <label for="ip_rel_tag"><b>Image</b> <code>rel</code> tag</label>
                                    <br><small>Use a <code>rel</code> tag based on your lightbox requirements</small>
                                    <br><small>Use <code>prettyPhoto[imagepress]</code> for PrettyPhoto or Avada theme</small>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <hr>
                <h2>Grid Settings</h2>
                <p>These settings apply globally for the image and author grid.</p>
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label>Image grid details</label></th>
                            <td>
                                <input name="ip_ipw" id="ip_ipw" type="number" value="<?php echo get_imagepress_option('ip_ipw'); ?>" min="1" max="1024">
                                <label for="ip_ipw">Images per row (0-32)</label>
                                <br><small>Number of images per grid row.</small>
                                <br>

                                <input name="ip_ipp" id="ip_ipp" type="number" value="<?php echo get_imagepress_option('ip_ipp'); ?>" min="1" max="65536">
                                <label for="ip_ipp">Images per page (0-256)</label>
                                <br><small>How many images per page you want to display using the <code>[imagepress-loop]</code> shortcode.</small>

                                <p>
                                    <label for="ip_order">Sort images</label>
                                    <select name="ip_order" id="ip_order">
                                        <option value="ASC"<?php if(get_imagepress_option('ip_order') == 'ASC') echo ' selected'; ?>>ASC</option>
                                        <option value="DESC"<?php if(get_imagepress_option('ip_order') == 'DESC') echo ' selected'; ?>>DESC</option>
                                    </select> <label for="ip_orderby">by</label> <select name="ip_orderby" id="ip_orderby">
                                        <option value="none"<?php if(get_imagepress_option('ip_orderby') == 'none') echo ' selected'; ?>>none</option>
                                        <option value="ID"<?php if(get_imagepress_option('ip_orderby') == 'ID') echo ' selected'; ?>>ID</option>
                                        <option value="author"<?php if(get_imagepress_option('ip_orderby') == 'author') echo ' selected'; ?>>author</option>
                                        <option value="title"<?php if(get_imagepress_option('ip_orderby') == 'title') echo ' selected'; ?>>title</option>
                                        <option value="name"<?php if(get_imagepress_option('ip_orderby') == 'name') echo ' selected'; ?>>name</option>
                                        <option value="date"<?php if(get_imagepress_option('ip_orderby') == 'date') echo ' selected'; ?>>date</option>
                                        <option value="rand"<?php if(get_imagepress_option('ip_orderby') == 'rand') echo ' selected'; ?>>rand</option>
                                        <option value="comment_count"<?php if(get_imagepress_option('ip_orderby') == 'comment_count') echo ' selected'; ?>>comment_count</option>
                                    </select>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label>Author grid details</label></th>
                            <td>
                                <p>
                                    <input type="number" name="ip_app" id="ip_app" min="1" max="9999" value="<?php echo get_imagepress_option('ip_app'); ?>">
                                    <label for="ip_app">Authors per page</label>
                                    <br><small>How many authors per page you want to display using the <code>[cinnamon-card]</code> shortcode.</small>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <hr>
                <p><input type="submit" name="isGSSubmit" value="Save Changes" class="button-primary"></p>
            </form>
        <?php } else if ($tab == 'collections_tab') {
            global $wpdb;

            $orphan_count = $wpdb->get_var("SELECT COUNT(*) FROM `" . $wpdb->prefix . "ip_collectionmeta` WHERE `image_ID` NOT IN (SELECT `ID` FROM `" . $wpdb->posts . "`)");

            if (isset($_POST['isGSSubmit'])) {
                $ipUpdatedOptions = array(
                    'ip_collections_page' => $_POST['ip_collections_page'],
                );
                $ipOptions = get_option('imagepress');
                $ipUpdate = array_merge($ipOptions, $ipUpdatedOptions);
                update_option('imagepress', $ipUpdate);

                echo '<div class="updated notice is-dismissible"><p>Settings updated successfully!</p></div>';
            } else if (isset($_POST['isCollectionCU'])) {
                $wpdb->query("DELETE FROM `" . $wpdb->prefix . "ip_collectionmeta` WHERE `image_ID` NOT IN (SELECT `ID` FROM `" . $wpdb->posts . "`)");

                echo '<div class="updated notice is-dismissible"><p>Collection images cleaned up successfully!</p></div>';
            }
            ?>
            <form method="post" action="">
                <h2><?php _e('Collections', 'imagepress'); ?></h2>
                <p><?php _e('Use the shortcode tag <code>[imagepress-collections count="X"]</code> in any post or page to display X collections. Note that in order for a collection to be visible, it needs to contain at least one image.', 'imagepress'); ?></p>
                <p><?php _e('<b>Note:</b> In order to view collection images, you need to create a viewer page, which should contain the collections shortcode: <code>[imagepress-collection collection="1"]</code>.', 'imagepress'); ?></p>

                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label for="ip_collections_page"><?php _e('Collection viewer page', 'imagepress'); ?></label></th>
                            <td>
                                <?php
                                wp_dropdown_pages(
                                    array(
                                        'name' => 'ip_collections_page',
                                        'echo' => 1,
                                        'show_option_none' => __('Select collections page...', 'imagepress'),
                                        'option_none_value' => '0',
                                        'selected' => get_imagepress_option('ip_collections_page'),
                                    )
                                );
                                ?>
                                <input type="submit" name="isGSSubmit" value="<?php _e('Save Changes', 'imagepress'); ?>" class="button button-primary">
                            </td>
                        </tr>
                    </tbody>
                </table>

                <hr>
                <h2><?php _e('Manage Collections', 'imagepress'); ?></h2>
                <p><?php _e('Manage existing collections, see how many images they contain, see visibility status and delete selected ones.', 'imagepress'); ?></p>

                <?php
                if (isset($_GET['c'])) {
                    $collection_ID = (int) $_GET['c'];

                    $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "ip_collections WHERE collection_ID = %d", $collection_ID));
                    $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "ip_collectionmeta WHERE image_collection_ID = %d", $collection_ID));

                    echo '<div class="updated notice is-dismissible"><p>Collection removed successfully!</p></div>';
                }
                if (isset($_POST['ip_new_collection_add'])) {
                    $collection_author_ID = get_current_user_id();
                    $collection_title = stripslashes($_POST['ip_new_collection']);
                    $collection_title_slug = sanitize_title($_POST['ip_new_collection']);
                    $collection_status = intval($_POST['ip_new_collection_visibility']);

                    $wpdb->query($wpdb->prepare("INSERT INTO " . $wpdb->prefix . "ip_collections (collection_title, collection_title_slug, collection_status, collection_author_ID) VALUES ('%s', '%s', %d, %d)", $collection_title, $collection_title_slug, $collection_status, $collection_author_ID));

                    echo '<div class="updated notice is-dismissible"><p>Collection added successfully!</p></div>';
                }

                $ip_collections_page_id = get_imagepress_option('ip_collections_page');
                $ip_slug = $i;

                $result = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "ip_collections", ARRAY_A);

                echo '<table class="wp-list-table widefat striped posts">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Collection Name</th>
                            <th scope="col">Author</th>
                            <th scope="col">Images</th>
                            <th scope="col">Visibility</th>
                            <th scope="col"><div class="dashicons dashicons-admin-generic"></div></th>
                        </tr>
                    </thead>';
                    foreach ($result as $collection) {
                        echo '<tr>';
                            $postslistcount = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "ip_collectionmeta WHERE image_collection_ID = '" . $collection['collection_ID'] . "' AND image_collection_author_ID = '" . get_current_user_id() . "'", ARRAY_A);
                            $collectionUser = get_user_by('id', $collection['collection_author_ID']);

                            echo '<td>' . $collection['collection_ID'] . '</td>';
                            echo '<td><b><a href="' . get_permalink($ip_collections_page_id) . '?collection=' . (int) $collection['collection_ID'] . '">' . $collection['collection_title'] . '</a></b></td>';
                            echo '<td><a href="' . admin_url('user-edit.php?user_id=' . $collectionUser->ID) . '">' . $collectionUser->user_nicename . '</a></td>';
                            echo '<td>' . ((count($postslistcount) === 1) ? count($postslistcount) . ' image' : count($postslistcount) . ' images') . '</td>';
                            echo '<td>' . (($collection['collection_status'] == 0) ? '<i class="fa fa-fw fa-eye-slash"></i> private' : '<i class="fa fa-fw fa-eye"></i> public') . '</td>';
                            echo '<td><a href="' . admin_url('edit.php?post_type=' . $ip_slug . '&page=imagepress_admin_page&tab=collections_tab&c=' . $collection['collection_ID']) . '"><span class="dashicons dashicons-trash"></span></a></td>';
                        echo '</tr>';
                    }
                echo '</table>';
                ?>
            </form>

            <hr>
            <h2><?php _e('Add New Collection', 'imagepress'); ?></h2>
            <p><?php _e('Add new collections here. Use short and concise names.', 'imagepress'); ?></p>

            <form method="post">
                <p>
                    <input type="text" name="ip_new_collection" id="ip_new_collection" class="regular-text" placeholder="<?php _e('New collection', 'imagepress'); ?>">
                    <label for="ip_new_collection"><?php _e('New collection name', 'imagepress'); ?></label>
                </p>
                <p>
                    <select name="ip_new_collection_visibility" id="ip_new_collection_visibility">
                        <option value="1"><?php _e('Public', 'imagepress'); ?></option>
                        <option value="0"><?php _e('Private', 'imagepress'); ?></option>
                    </select>
                    <input type="submit" name="ip_new_collection_add" class="button button-secondary" value="<?php _e('Add new collection', 'imagepress'); ?>">
                </p>
            </form>

            <hr>
            <h2><?php _e('Maintenance', 'imagepress'); ?></h2>
            <p><?php _e('Whenever users permanently delete an image, the collection reference is not updated. Use the button below to remove all references to missing images from the collections table.', 'imagepress'); ?></p>
            <p>
                <input type="submit" name="isCollectionCU" value="Remove <?php echo $orphan_count; ?> missing image references" class="button button-secondary">
            </p>
        <?php } else if ($tab == 'login_tab') {
            if (isset($_POST['isGSSubmit'])) {
                $ipUpdatedOptions = array(
                    'ip_login_image' => $_POST['ip_login_image'],
                    'ip_login_bg' => $_POST['ip_login_bg'],
                    'ip_login_box_bg' => $_POST['ip_login_box_bg'],
                    'ip_login_box_text' => $_POST['ip_login_box_text'],
                    'ip_login_page_text' => $_POST['ip_login_page_text'],
                    'ip_login_button_bg' => $_POST['ip_login_button_bg'],
                    'ip_login_button_text' => $_POST['ip_login_button_text'],
                    'ip_login_copyright' => sanitize_text_field($_POST['ip_login_copyright']),
                );
                $ipOptions = get_option('imagepress');
                $ipUpdate = array_merge($ipOptions, $ipUpdatedOptions);
                update_option('imagepress', $ipUpdate);

                echo '<div class="updated notice is-dismissible"><p>Settings updated successfully!</p></div>';
            }
            ?>
            <form method="post" action="">
                <h2><?php _e('Login/Registration', 'imagepress'); ?></h2>
                <p>This section allows you to customize the native WordPress login/registration page (<code>/wp-login.php</code>) by adding/removing/renaming elements and changing default colours and background properties.</p>
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label for="ip_login_image">Page background image<br><small>(optional)</small></label></th>
                            <td>
                                <input type="url" name="ip_login_image" id="ip_login_image" class="regular-text" value="<?php echo get_imagepress_option('ip_login_image'); ?>">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="ip_login_bg">Page background colour</label></th>
                            <td>
                                <input type="text" name="ip_login_bg" id="ip_login_bg" class="ip-color-picker" data-default-color="#FEFEFE" value="<?php echo get_imagepress_option('ip_login_bg'); ?>">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="ip_login_box_bg">Login box background colour</label></th>
                            <td>
                                <input type="text" name="ip_login_box_bg" id="ip_login_box_bg" class="ip-color-picker" data-default-color="#FFFFFF" value="<?php echo get_imagepress_option('ip_login_box_bg'); ?>">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="ip_login_button_bg">Login button background colour</label></th>
                            <td>
                                <input type="text" name="ip_login_button_bg" id="ip_login_button_bg" class="ip-color-picker" data-default-color="#00A0D2" value="<?php echo get_imagepress_option('ip_login_button_bg'); ?>">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="ip_login_button_text">Login button text colour</label></th>
                            <td>
                                <input type="text" name="ip_login_button_text" id="ip_login_button_text" class="ip-color-picker" data-default-color="#FFFFFF" value="<?php echo get_imagepress_option('ip_login_button_text'); ?>">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="ip_login_box_text">Text colour<br><small>(inside login box)</small></label></th>
                            <td>
                                <input type="text" name="ip_login_box_text" id="ip_login_box_text" class="ip-color-picker" data-default-color="#000000" value="<?php echo get_imagepress_option('ip_login_box_text'); ?>">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="ip_login_page_text">Text colour<br><small>(outside login box)</small></label></th>
                            <td>
                                <input type="text" name="ip_login_page_text" id="ip_login_page_text" class="ip-color-picker" data-default-color="#000000" value="<?php echo get_imagepress_option('ip_login_page_text'); ?>">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="ip_login_copyright">Copyright line<br><small>(optional)</small></label></th>
                            <td>
                                <input type="text" name="ip_login_copyright" id="ip_login_copyright" class="regular-text" value="<?php echo get_imagepress_option('ip_login_copyright'); ?>">
                            </td>
                        </tr>
                    </tbody>
                </table>

                <hr>
                <p><input type="submit" name="isGSSubmit" value="Save Changes" class="button-primary"></p>
            </form>
        <?php } else if ($tab == 'settings_tab') {
            if (isset($_POST['isGSSubmit'])) {
                $ipUpdatedOptions = array(
                    'ip_moderate' => $_POST['ip_moderate'],
                    'ip_registration' => $_POST['ip_registration'],
                    'ip_click_behaviour' => $_POST['ip_click_behaviour'],
                    'ip_cat_moderation_include' => $_POST['ip_cat_moderation_include'],
                    'cinnamon_mod_login' => $_POST['cinnamon_mod_login'],
                    'ip_mod_login' => $_POST['ip_mod_login'],
                    'ip_mod_collections' => $_POST['ip_mod_collections'],
                    'ip_upload_redirection' => $_POST['ip_upload_redirection'],
                    'ip_delete_redirection' => $_POST['ip_delete_redirection'],
                    'ip_notification_email' => $_POST['ip_notification_email'],
                    //'ip_tracking' => (int) $_POST['ip_tracking'],
                );
                $ipOptions = get_option('imagepress');
                $ipUpdate = array_merge($ipOptions, $ipUpdatedOptions);
                update_option('imagepress', $ipUpdate);

                echo '<div class="updated notice is-dismissible"><p>Settings updated successfully!</p></div>';
            }
            ?>
            <form method="post" action="">
                <h2>Modules</h2>
                <p>Modules are separate functions which improve ImagePress functionality and extend its behaviour. Modules can be integrated or they can come as separate plugins.</p>
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label for="ip_mod_login">Native login/registration</label></th>
                            <td>
                                <select name="ip_mod_login" id="ip_mod_login">
                                    <option value="1"<?php if(get_imagepress_option('ip_mod_login') == 1) echo ' selected'; ?>>Enable native login/registration module</option>
                                    <option value="0"<?php if(get_imagepress_option('ip_mod_login') == 0) echo ' selected'; ?>>Disable native login/registration module</option>
                                </select>
                                <br><small>This module allows users to log in or register using the native WordPress login page (<code>/wp-login.php</code>).</small>
                                <br><small>The login page can be styled and users redirected to their ImagePress profiles.</small>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="cinnamon_mod_login">Frontend login/registration</label></th>
                            <td>
                                <select name="cinnamon_mod_login" id="cinnamon_mod_login">
                                    <option value="1"<?php if(get_imagepress_option('cinnamon_mod_login') == 1) echo ' selected'; ?>>Enable frontend login/registration module</option>
                                    <option value="0"<?php if(get_imagepress_option('cinnamon_mod_login') == 0) echo ' selected'; ?>>Disable frontend login/registration module</option>
                                </select>
                                <br><small>Use the <code>[cinnamon-login]</code> shortcode to place a tabbed login/registration box anywhere on the site.</small>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="ip_mod_collections">Collections</label></th>
                            <td>
                                <select name="ip_mod_collections" id="ip_mod_collections">
                                    <option value="1"<?php if(get_imagepress_option('ip_mod_collections') == 1) echo ' selected'; ?>>Enable collections module</option>
                                    <option value="0"<?php if(get_imagepress_option('ip_mod_collections') == 0) echo ' selected'; ?>>Disable collections module</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <hr>
                <h2>General Settings</h2>
                <p>These settings apply globally for all ImagePress users.</p>
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label for="ip_registration">User registration</label></th>
                            <td>
                                <select name="ip_registration" id="ip_registration">
                                    <option value="0"<?php if(get_imagepress_option('ip_registration') == '0') echo ' selected'; ?>>Require user registration (recommended)</option>
                                    <option value="1"<?php if(get_imagepress_option('ip_registration') == '1') echo ' selected'; ?>>Do not require user registration</option>
                                </select>
                                <br><small>Require users to be registered and logged in to upload images (recommended).</small>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="ip_click_behaviour">Image behaviour</label></th>
                            <td>
                                <select name="ip_click_behaviour" id="ip_click_behaviour">
                                    <option value="media"<?php if(get_imagepress_option('ip_click_behaviour') == 'media') echo ' selected'; ?>>Open media (image)</option>
                                    <option value="custom"<?php if(get_imagepress_option('ip_click_behaviour') == 'custom') echo ' selected'; ?>>Open image page (requires custom post template)</option>
                                </select>
                                <br><small>What to open when clicking on an image (single image or custom post template).</small>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="ip_moderate">Image moderation</label></th>
                            <td>
                                <select name="ip_moderate" id="ip_moderate">
                                    <option value="0"<?php if(get_imagepress_option('ip_moderate') == '0') echo ' selected'; ?>>Moderate all images (recommended)</option>
                                    <option value="1"<?php if(get_imagepress_option('ip_moderate') == '1') echo ' selected'; ?>>Do not moderate images</option>
                                </select>
                                <br><small>Moderate all submitted images (recommended).</small>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="ip_cat_moderation_include">Moderate entries in this category</label></th>
                            <td>
                                <input type="number" name="ip_cat_moderation_include" id="ip_cat_moderation_include" value="<?php echo get_imagepress_option('ip_cat_moderation_include'); ?>">
                                <br><small>Always moderate entries in this category (use category ID).</small>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <hr>
                <h2>Redirection</h2>
                <p>Optionally redirect users to various pages after image submission/removal. Examples are: a thank you page, a confirmation page, a payment page, a newsletter page or another call to action.</p>
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label for="ip_upload_redirection">Upload redirect</label></th>
                            <td>
                                <input type="url" name="ip_upload_redirection" id="ip_upload_redirection" placeholder="https://" class="regular-text" value="<?php echo get_imagepress_option('ip_upload_redirection'); ?>">
                                <br><small>Redirect users to this page after image upload (optional, leave blank to disable).</small>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="ip_delete_redirection">Delete redirect</label></th>
                            <td>
                                <input type="url" name="ip_delete_redirection" id="ip_delete_redirection" placeholder="https://" class="regular-text" value="<?php echo get_imagepress_option('ip_delete_redirection'); ?>">
                                <br><small>Redirect users to this page after image deletion (optional, leave blank to disable).</small>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <hr>
                <h2>Email Settings</h2>
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label for="ip_notification_email">Administrator email<br><small>(used for new image notification)</small></label></th>
                            <td>
                                <input type="text" name="ip_notification_email" id="ip_notification_email" value="<?php echo get_imagepress_option('ip_notification_email'); ?>" class="regular-text">
                                <br><small>The administrator will receive an email notification each time a new image is uploaded.</small>
                                <br><small>Separate multiple addresses with comma.</small>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <?php /** ?>
                <hr>
                <h2 id="tracking">Tracking and Data Collection <sup class="ip-beta">BETA</sup></h2>
                <p>To maintain a plugin, we need to know what we're dealing with, what kinds of other plugins our users are using, what themes, what settings, and so on. Please allow us to track that data from your install. It will not track any user details, so your security and privacy are safe with us.</p>
                <p>The benefits of providing tracking statistics is that the information sent back to us can be used to improve the plugin and its compatibility with other plugins and themes, making for a better all round plugin.</p>
                <p><small>Note that this is a beta feature and it may be removed or changed in the future. As there are privacy concerns around this feature, we will let you know in advance.</small></p>
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label for="ip_tracking">Tracking</label></th>
                            <td>
                                <p>
                                    <input type="checkbox" name="ip_tracking" value="1" <?php if (get_imagepress_option('ip_tracking') === '1') echo 'checked'; ?>> <label>Enable tracking and data collection</label>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php /**/ ?>

                <hr>
                <p><input type="submit" name="isGSSubmit" value="Save Changes" class="button-primary"></p>
            </form>
        <?php } else if ($tab == 'authors_tab') {
            if (isset($_POST['cinnamon_submit'])) {
                $ipUpdatedOptions = array(
                    'ip_profile_page' => (int) sanitize_text_field($_POST['ip_profile_page']),
                    'cinnamon_author_slug' => $_POST['cinnamon_author_slug'],
                    'ip_cards_per_author' => $_POST['ip_cards_per_author'],
                    'ip_et_login' => $_POST['ip_et_login'],
                    'cinnamon_show_uploads' => $_POST['cinnamon_show_uploads'],
                    'cinnamon_show_awards' => $_POST['cinnamon_show_awards'],
                    'cinnamon_show_about' => $_POST['cinnamon_show_about'],
                    'cinnamon_show_followers' => $_POST['cinnamon_show_followers'],
                    'cinnamon_show_following' => $_POST['cinnamon_show_following'],
                    'cinnamon_hide_admin' => $_POST['cinnamon_hide_admin'],
                    'cinnamon_account_page' => $_POST['cinnamon_account_page'],
                    'cinnamon_edit_page' => $_POST['cinnamon_edit_page'],
                    'cinnamon_show_likes' => $_POST['cinnamon_show_likes'],
                    'cinnamon_show_collections' => $_POST['cinnamon_show_collections'],
                    'cinnamon_fancy_header' => $_POST['cinnamon_fancy_header'],
                    'approvednotification' => $_POST['approvednotification'],
                    'declinednotification' => $_POST['declinednotification'],
                );
                $ipOptions = get_option('imagepress');
                $ipUpdate = array_merge($ipOptions, $ipUpdatedOptions);
                update_option('imagepress', $ipUpdate);

                echo '<div class="updated notice is-dismissible"><p><strong>Settings saved.</strong></p></div>';
            }
            ?>
            <form method="post" action="">
                <h2>General Settings</h2>
                <p>These settings apply globally for all ImagePress users.</p>

                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row">
                                <label for="ip_profile_page">
                                    <?php _e('Profile page and author slug', 'imagepress'); ?>
                                    <br><small>(<?php _e('required for single user profiles', 'imagepress'); ?>)</small>
                                </label>
                            </th>
                            <td>
                                <p>
                                    <?php
                                    wp_dropdown_pages(array(
                                        'name' => 'ip_profile_page',
                                        'echo' => 1,
                                        'show_option_none' => __('Select profile page...', 'imagepress'),
                                        'option_none_value' => 0,
                                        'selected' => get_imagepress_option('ip_profile_page'),
                                    ));

                                    $ipProfilePage = (int) get_imagepress_option('ip_profile_page')
                                    ?>
                                    <br><small>Make sure you add the <code>[cinnamon-profile]</code> shortcode on this page.</small>
                                </p>
                                <p>
                                    <input type="text" name="cinnamon_author_slug" id="cinnamon_author_slug" value="<?php echo get_imagepress_option('cinnamon_author_slug'); ?>" class="regular-text">
                                    <br><small>Default is <b>author</b> (usage exemples: <b>author</b>, <b>profile</b> or <b>hub</b>).</small>
                                    <br><small>User profile URL will look like <code class="codor"><?php echo get_permalink($ipProfilePage) . '?<b>' . get_imagepress_option('cinnamon_author_slug') . '</b>='; ?>username</code>.</small>
                                    <br><small>Tip: use a singular term, one word only, lowercase, letters only</small>
                                    <br><small>After changing any of the values above, you might need to resave your permalinks, in order to avoid 404 errors.</small>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="cinnamon_account_page">Author account login page</label></th>
                            <td>
                                <input type="url" name="cinnamon_account_page" id="cinnamon_account_page" value="<?php echo get_imagepress_option('cinnamon_account_page'); ?>" class="regular-text" placeholder="https://">
                                <br><small>Create a new page and add the <code>[cinnamon-login]</code> shortcode.</small>
                                <br><small>This shortcode will display a login/registration tabbed section.</small>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="cinnamon_edit_page">Author profile edit page URL</label></th>
                            <td>
                                <input type="url" name="cinnamon_edit_page" id="cinnamon_edit_page" value="<?php echo get_imagepress_option('cinnamon_edit_page'); ?>" class="regular-text" placeholder="https://">
                                <br><small>Create a new page and add the <code>[cinnamon-profile-edit]</code> shortcode.</small>
                                <br><small>This shortcode will display all user fields in a tabbed section.</small>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="ip_et_login">WordPress login URL<br><small>(optional)</small></label></th>
                            <td>
                                <input type="url" name="ip_et_login" id="ip_et_login" value="<?php echo get_imagepress_option('ip_et_login'); ?>" class="regular-text">
                                <br><small>Use this option to define a different login URL than <code>/wp-login.php</code>.</small>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <hr>
                <h2>Author Cards</h2>
                <p>These settings apply to author cards. Use the <code>[cinnamon-card]</code> shortcode to display the cards.</p>
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label for="ip_cards_per_author">Number of images</label></th>
                            <td>
                                <input type="number" name="ip_cards_per_author" id="ip_cards_per_author" value="<?php echo get_imagepress_option('ip_cards_per_author'); ?>" min="0" max="32">
                            </td>
                        </tr>
                    </tbody>
                </table>

                <hr>
                <h2>Author Awards</h2>
                <p>Create a new page and add the <code>[cinnamon-awards]</code> shortcode. This shortcode will list all available awards and their description.</p>
                <p><span class="dashicons dashicons-awards"></span> <a href="<?php echo admin_url('edit-tags.php?taxonomy=award'); ?>" class="button button-secondary">Add/Edit Awards</a></p>

                <hr>
                <h2>Author Profile</h2>
                <p>These settings apply to author profiles.</p>
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label>Profile Settings</label></th>
                            <td>
                                <p>
                                    <select name="cinnamon_show_uploads" id="cinnamon_show_uploads">
                                        <option value="1"<?php if(get_imagepress_option('cinnamon_show_uploads') == 1) echo ' selected'; ?>>Show latest ImagePress uploads</option>
                                        <option value="0"<?php if(get_imagepress_option('cinnamon_show_uploads') == 0) echo ' selected'; ?>>Hide latest ImagePress uploads</option>
                                    </select>
                                </p>
                                <p>
                                    <select name="cinnamon_show_awards" id="cinnamon_show_awards">
                                        <option value="1"<?php if(get_imagepress_option('cinnamon_show_awards') == 1) echo ' selected'; ?>>Show awards</option>
                                        <option value="0"<?php if(get_imagepress_option('cinnamon_show_awards') == 0) echo ' selected'; ?>>Hide awards</option>
                                    </select>
                                </p>
                                <p>
                                    <select name="cinnamon_show_about" id="cinnamon_show_about">
                                        <option value="1"<?php if(get_imagepress_option('cinnamon_show_about') == 1) echo ' selected'; ?>>Show "About" section</option>
                                        <option value="0"<?php if(get_imagepress_option('cinnamon_show_about') == 0) echo ' selected'; ?>>Hide "About" section</option>
                                    </select>
                                </p>
                                <p>
                                    <select name="cinnamon_hide_admin" id="cinnamon_hide_admin">
                                        <option value="1"<?php if(get_imagepress_option('cinnamon_hide_admin') == 1) echo ' selected'; ?>>Hide admin bar for non-admin users</option>
                                        <option value="0"<?php if(get_imagepress_option('cinnamon_hide_admin') == 0) echo ' selected'; ?>>Show admin bar for non-admin users</option>
                                    </select>
                                </p>
                                <hr>
                                <p>
                                    <select name="cinnamon_show_followers" id="cinnamon_show_followers">
                                        <option value="1"<?php if(get_imagepress_option('cinnamon_show_followers') == 1) echo ' selected'; ?>>Show followers</option>
                                        <option value="0"<?php if(get_imagepress_option('cinnamon_show_followers') == 0) echo ' selected'; ?>>Hide followers</option>
                                    </select>
                                    <select name="cinnamon_show_following" id="cinnamon_show_following">
                                        <option value="1"<?php if(get_imagepress_option('cinnamon_show_following') == 1) echo ' selected'; ?>>Show following</option>
                                        <option value="0"<?php if(get_imagepress_option('cinnamon_show_following') == 0) echo ' selected'; ?>>Hide following</option>
                                    </select> <label>Followers behaviour</label>
                                </p>
                                <hr>
                                <p>
                                    <select name="cinnamon_show_likes" id="cinnamon_show_likes">
                                        <option value="1"<?php if(get_imagepress_option('cinnamon_show_likes') == 1) echo ' selected'; ?>>Show likes</option>
                                        <option value="0"<?php if(get_imagepress_option('cinnamon_show_likes') == 0) echo ' selected'; ?>>Hide likes</option>
                                    </select>
                                    <select name="cinnamon_show_collections" id="cinnamon_show_collections">
                                        <option value="1"<?php if(get_imagepress_option('cinnamon_show_collections') == 1) echo ' selected'; ?>>Show collections</option>
                                        <option value="0"<?php if(get_imagepress_option('cinnamon_show_collections') == 0) echo ' selected'; ?>>Hide collections</option>
                                    </select>
                                </p>
                                <hr>
                                <p>
                                    <input type="checkbox" id="cinnamon_fancy_header" name="cinnamon_fancy_header" value="yes" <?php if(get_imagepress_option('cinnamon_fancy_header') == 'yes') echo 'checked'; ?>> <label for="cinnamon_fancy_header">Use a fancy header to display user data (cover image and styled avatar)</label>
                                    <br><small>Unchecking this option will show a basic header, with avatar, name and user links</small>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <hr>
                <h2>Email Settings</h2>
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label>Email Settings</label></th>
                            <td>
                                <p>
                                    <input type="checkbox" id="approvednotification" name="approvednotification" value="yes" <?php if(get_imagepress_option('approvednotification') == 'yes') echo 'checked'; ?>> <label for="approvednotification">Notify author when image is approved</label>
                                    <br>
                                    <input type="checkbox" id="declinednotification" name="declinednotification" value="yes" <?php if(get_imagepress_option('declinednotification') == 'yes') echo 'checked'; ?>> <label for="declinednotification">Notify author when image is rejected</label>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <hr>
                <p><input name="cinnamon_submit" type="submit" class="button-primary" value="Save Changes"></p>
            </form>
        <?php } else if ($tab == 'label_tab') {
            if (isset($_POST['isGSSubmit'])) {
                $ipUpdatedOptions = array(
                    'ip_name_label' => $_POST['ip_name_label'],
                    'ip_email_label' => $_POST['ip_email_label'],
                    'ip_caption_label' => $_POST['ip_caption_label'],
                    'ip_category_label' => $_POST['ip_category_label'],
                    'ip_tag_label' => $_POST['ip_tag_label'],
                    'ip_description_label' => $_POST['ip_description_label'],
                    'ip_ezdz_label' => $_POST['ip_ezdz_label'],
                    'ip_upload_label' => $_POST['ip_upload_label'],
                    'ip_image_label' => $_POST['ip_image_label'],
                    'ip_video_label' => $_POST['ip_video_label'],
                    'ip_notifications_mark' => $_POST['ip_notifications_mark'],
                    'ip_notifications_all' => $_POST['ip_notifications_all'],
                    'cms_verified_profile' => $_POST['cms_verified_profile'],
                    'ip_upload_success_title' => $_POST['ip_upload_success_title'],
                    'ip_upload_success' => $_POST['ip_upload_success'],
                    'ip_vote_like' => stripslashes_deep($_POST['ip_vote_like']),
                    'ip_vote_unlike' => stripslashes_deep($_POST['ip_vote_unlike']),
                    'cinnamon_edit_label' => $_POST['cinnamon_edit_label'],
                    'cinnamon_pt_account' => $_POST['cinnamon_pt_account'],
                    'cinnamon_pt_social' => $_POST['cinnamon_pt_social'],
                    'cinnamon_pt_author' => $_POST['cinnamon_pt_author'],
                    'cinnamon_pt_profile' => $_POST['cinnamon_pt_profile'],
                    'cinnamon_pt_collections' => $_POST['cinnamon_pt_collections'],
                    'cinnamon_pt_images' => $_POST['cinnamon_pt_images'],
                    'ip_load_more_label' => $_POST['ip_load_more_label'],
                );
                $ipOptions = get_option('imagepress');
                $ipUpdate = array_merge($ipOptions, $ipUpdatedOptions);
                update_option('imagepress', $ipUpdate);

                echo '<div class="updated notice is-dismissible"><p>Settings updated successfully!</p></div>';
            }
            ?>
            <form method="post" action="">
                <h2><?php _e('Label Settings', 'imagepress'); ?></h2>
                <p><?php _e('Configure, set or translate any of ImagePress labels. Leave a label blank to disable/hide it.', 'imagepress'); ?></p>
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label for="ip_name_label">Name label</label></th>
                            <td>
                                <input type="text" name="ip_name_label" id="ip_name_label" value="<?php echo get_imagepress_option('ip_name_label'); ?>" class="regular-text">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="ip_email_label">Email address label</label></th>
                            <td>
                                <input type="text" name="ip_email_label" id="ip_email_label" value="<?php echo get_imagepress_option('ip_email_label'); ?>" class="regular-text">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="ip_caption_label">Image caption label<br><small>Leave blank to disable</small></label></th>
                            <td>
                                <input type="text" name="ip_caption_label" id="ip_caption_label" value="<?php echo get_imagepress_option('ip_caption_label'); ?>" class="regular-text">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="ip_category_label">Image category label<br><small>(dropdown)</small></label></th>
                            <td>
                                <input type="text" name="ip_category_label" id="ip_category_label" value="<?php echo get_imagepress_option('ip_category_label'); ?>" class="regular-text">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="ip_tag_label">Image tag label<br><small>(dropdown)</small></label></th>
                            <td>
                                <input type="text" name="ip_tag_label" id="ip_tag_label" value="<?php echo get_imagepress_option('ip_tag_label'); ?>" class="regular-text">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="ip_description_label">Image description label<br><small>(textarea)<br>Leave blank to disable</small></label></th>
                            <td>
                                <input type="text" name="ip_description_label" id="ip_description_label" value="<?php echo get_imagepress_option('ip_description_label'); ?>" class="regular-text">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="ip_upload_label">Image upload button label<br><small>(button)</small></label></th>
                            <td>
                                <input type="text" name="ip_upload_label" id="ip_upload_label" value="<?php echo get_imagepress_option('ip_upload_label'); ?>" class="regular-text">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="ip_image_label">Image upload selection label<br><small>(link)</small></label></th>
                            <td>
                                <input type="text" name="ip_image_label" id="ip_image_label" value="<?php echo get_imagepress_option('ip_image_label'); ?>" class="regular-text">
                            </td>
                        </tr>
                        <?php if(get_imagepress_option('ip_ezdz') === '1') { ?>
                            <tr>
                                <th scope="row"><label for="ip_image_label">Drag and drop upload label</label></th>
                                <td>
                                    <input type="text" name="ip_ezdz_label" id="ip_ezdz_label" value="<?php echo get_imagepress_option('ip_ezdz_label'); ?>" class="regular-text">
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <th scope="row"><label for="ip_video_label">Image video link<br><small>(Youtube/Vimeo)<br>Leave blank to disable</small></label></th>
                            <td>
                                <input type="text" name="ip_video_label" id="ip_video_label" value="<?php echo get_imagepress_option('ip_video_label'); ?>" class="regular-text">
                            </td>
                        </tr>
                    </tbody>
                </table>

                <hr>
                <h2><?php _e('Notifications', 'imagepress'); ?></h2>
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label for="ip_notifications_mark">"Mark all as read" label</label></th>
                            <td>
                                <input type="text" name="ip_notifications_mark" id="ip_notifications_mark" value="<?php echo get_imagepress_option('ip_notifications_mark'); ?>" class="regular-text">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="ip_notifications_all">"View all notifications" label</label></th>
                            <td>
                                <input type="text" name="ip_notifications_all" id="ip_notifications_all" value="<?php echo get_imagepress_option('ip_notifications_all'); ?>" class="regular-text">
                            </td>
                        </tr>
                    </tbody>
                </table>

                <hr>
                <h2><?php _e('Tooltips', 'imagepress'); ?></h2>
                <p>The tooltip text will appear when the icon is hovered.</p>
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label for="cms_verified_profile">Verified profile tooltip</label></th>
                            <td>
                                <input type="text" name="cms_verified_profile" id="cms_verified_profile" value="<?php echo get_imagepress_option('cms_verified_profile'); ?>" class="regular-text">
                            </td>
                        </tr>
                    </tbody>
                </table>

                <hr>
                <h2><?php _e('Image Upload', 'imagepress'); ?></h2>
                <p>This text will appear when the image upload is successful. Leave blank to disable.</p>
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label for="ip_upload_success_title">Upload success title</label></th>
                            <td>
                                <input type="text" name="ip_upload_success_title" id="ip_upload_success_title" value="<?php echo get_imagepress_option('ip_upload_success_title'); ?>" class="regular-text">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="ip_upload_success">Upload success</label></th>
                            <td>
                                <input type="text" name="ip_upload_success" id="ip_upload_success" value="<?php echo get_imagepress_option('ip_upload_success'); ?>" class="regular-text">
                            </td>
                        </tr>
                    </tbody>
                </table>

                <hr>
                <h2><?php _e('Users', 'imagepress'); ?></h2>
                <p>This text will appear when the image upload is successful. Leave blank to disable.</p>
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label for="cinnamon_edit_label">Author profile edit label</label></th>
                            <td>
                                <input type="text" name="cinnamon_edit_label" id="cinnamon_edit_label" value="<?php echo get_imagepress_option('cinnamon_edit_label'); ?>" placeholder="Edit profile" class="regular-text">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label>Profile edit tab labels</label></th>
                            <td>
                                <p>
                                    <!-- pt = profile tab -->
                                    <input type="text" name="cinnamon_pt_account" value="<?php echo get_imagepress_option('cinnamon_pt_account'); ?>" class="regular-text" placeholder="Account details"><br>
                                    <input type="text" name="cinnamon_pt_social" value="<?php echo get_imagepress_option('cinnamon_pt_social'); ?>" class="regular-text" placeholder="Social details"><br>
                                    <input type="text" name="cinnamon_pt_author" value="<?php echo get_imagepress_option('cinnamon_pt_author'); ?>" class="regular-text" placeholder="Author details"><br>
                                    <input type="text" name="cinnamon_pt_profile" value="<?php echo get_imagepress_option('cinnamon_pt_profile'); ?>" class="regular-text" placeholder="Profile details"><br>
                                    <input type="text" name="cinnamon_pt_collections" value="<?php echo get_imagepress_option('cinnamon_pt_collections'); ?>" class="regular-text" placeholder="Collections"><br>
                                    <input type="text" name="cinnamon_pt_images" value="<?php echo get_imagepress_option('cinnamon_pt_images'); ?>" class="regular-text" placeholder="Image editor">
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="ip_load_more_label">"Load more" button</label></th>
                            <td>
                                <input type="text" name="ip_load_more_label" id="ip_load_more_label" value="<?php echo get_imagepress_option('ip_load_more_label'); ?>" placeholder="Load more" class="regular-text">
                            </td>
                        </tr>
                    </tbody>
                </table>

                <hr>
                <h2><?php _e('Like/Unlike', 'imagepress'); ?></h2>
                <p>This text will appear when the image upload is successful. Leave blank to disable.</p>
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label>Like/Unlike</label></th>
                            <td>
                            <p>
                                <input type="text" name="ip_vote_like" id="ip_vote_like" value="<?php echo get_imagepress_option('ip_vote_like'); ?>" placeholder="I like this image" class="regular-text">
                                <label for="ip_vote_like">"Like" label</label>
                                <br><small>Examples: Like, Appreciate, Love, Vote</small>
                                <br>
                                <input type="text" name="ip_vote_unlike" id="ip_vote_unlike" value="<?php echo get_imagepress_option('ip_vote_unlike'); ?>" placeholder="Oops! I don't like this" class="regular-text">
                                <label for="ip_vote_unlike">"Unlike" label</label>
                            </p>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <hr>
                <p><input type="submit" name="isGSSubmit" value="Save Changes" class="button-primary"></p>
            </form>
        <?php } else if ($tab == 'upload_tab') {
            if (isset($_POST['isGSSubmit'])) {
                $ipUpdatedOptions = array(
                    'ip_ezdz' => $_POST['ip_ezdz'],
                    'ip_request_user_details' => $_POST['ip_request_user_details'],
                    'ip_upload_secondary' => $_POST['ip_upload_secondary'],
                    'ip_allow_tags' => $_POST['ip_allow_tags'],
                    'ip_upload_tos' => $_POST['ip_upload_tos'],
                    'ip_upload_tos_url' => $_POST['ip_upload_tos_url'],
                    'ip_upload_tos_error' => $_POST['ip_upload_tos_error'],
                    'ip_upload_tos_content' => $_POST['ip_upload_tos_content'],
                    'ip_upload_size' => $_POST['ip_upload_size'],
                    'ip_global_upload_limit' => $_POST['ip_global_upload_limit'],
                    'ip_global_upload_limit_message' => $_POST['ip_global_upload_limit_message'],
                    'ip_cat_exclude' => $_POST['ip_cat_exclude'],
                    'ip_max_quality' => $_POST['ip_max_quality'],
                    'ip_dropbox_enable' => $_POST['ip_dropbox_enable'],
                    'ip_dropbox_key' => $_POST['ip_dropbox_key'],
                );
                $ipOptions = get_option('imagepress');
                $ipUpdate = array_merge($ipOptions, $ipUpdatedOptions);
                update_option('imagepress', $ipUpdate);

                if ((int) trim($_POST['ip_quota_increase']) > 0) {
                    $ipUsers = get_users();
                    $ip_quota_increase = (int) trim($_POST['ip_quota_increase']);

                    foreach ($ipUsers as $user) {
                        $quota = (int) get_the_author_meta('ip_upload_limit', $user->ID);

                        if ((string) $_POST['ip_quota_action'] === 'increase') {
                            update_user_meta($user->ID, 'ip_upload_limit', $quota + $ip_quota_increase);
                        } else if ((string) $_POST['ip_quota_action'] === 'decrease') {
                            update_user_meta($user->ID, 'ip_upload_limit', $quota - $ip_quota_increase);
                        } else if ((string) $_POST['ip_quota_action'] === 'set') {
                            update_user_meta($user->ID, 'ip_upload_limit', $ip_quota_increase);
                        }
                    }
                }

                echo '<div class="updated notice is-dismissible"><p>Users quota increased successfully!</p></div>';
                echo '<div class="updated notice is-dismissible"><p>Settings updated successfully!</p></div>';
            }
            ?>
            <form method="post" action="">
                <h2><?php _e('Upload Settings', 'imagepress'); ?></h2>
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label for="ip_max_quality">Image quality</label></th>
                            <td>
                                <input name="ip_max_quality" id="ip_max_quality" type="number" value="<?php echo get_imagepress_option('ip_max_quality')?>" min="0" max="100">
                                <br><small>Set image quality when uploading image.</small>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="ip_upload_size">Maximum image upload size<br><small>(in kilobytes)</small></label></th>
                            <td>
                                <input type="number" name="ip_upload_size" id="ip_upload_size" min="0" max="65536" step="1024" value="<?php echo get_imagepress_option('ip_upload_size'); ?>">
                                <br><small>Try 4096 for most configurations.</small>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="ip_cat_exclude">Exclude categories</label></th>
                            <td>
                                <input type="text" name="ip_cat_exclude" id="ip_cat_exclude" value="<?php echo get_imagepress_option('ip_cat_exclude'); ?>">
                                <br><small>Exclude these categories from the upload form (separate IDs with comma).</small>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label>Upload details</label></th>
                            <td>
                                <select name="ip_request_user_details" id="ip_request_user_details">
                                    <option value="1"<?php if(get_imagepress_option('ip_request_user_details') == 1) echo ' selected'; ?>>Request user name and email</option>
                                    <option value="0"<?php if(get_imagepress_option('ip_request_user_details') == 0) echo ' selected'; ?>>Do not request user name and email</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label>Upload features</label></th>
                            <td>
                                <p>
                                    <input type="checkbox" name="ip_ezdz" value="1" <?php if(get_imagepress_option('ip_ezdz') === '1') echo 'checked'; ?>> <label>Enable drag and drop upload</label>
                                </p>
                                <select name="ip_upload_secondary" id="ip_upload_secondary">
                                    <option value="1"<?php if(get_imagepress_option('ip_upload_secondary') == 1) echo ' selected'; ?>>Enable secondary upload button</option>
                                    <option value="0"<?php if(get_imagepress_option('ip_upload_secondary') == 0) echo ' selected'; ?>>Disable secondary upload button</option>
                                </select> <label for="ip_upload_secondary">Enable/disable additional images (variants, progress shots, making of, etc.)</label>
                                <br>
                                <select name="ip_allow_tags" id="ip_allow_tags">
                                    <option value="1"<?php if(get_imagepress_option('ip_allow_tags') == 1) echo ' selected'; ?>>Enable tags</option>
                                    <option value="0"<?php if(get_imagepress_option('ip_allow_tags') == 0) echo ' selected'; ?>>Disable tags</option>
                                </select> <label for="ip_allow_tags">Enable/disable image tags dropdown</label>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label>Terms and conditions of use</label></th>
                            <td>
                                <select name="ip_upload_tos" id="ip_upload_tos">
                                    <option value="1"<?php if(get_imagepress_option('ip_upload_tos') == 1) echo ' selected'; ?>>Enable terms and conditions</option>
                                    <option value="0"<?php if(get_imagepress_option('ip_upload_tos') == 0) echo ' selected'; ?>>Disable terms and conditions</option>
                                </select> <label for="ip_upload_tos">Enable/disable terms and conditions of use</label>
                                <br>
                                <input type="text" name="ip_upload_tos_content" id="ip_upload_tos_content" class="regular-text" value="<?php echo get_imagepress_option('ip_upload_tos_content'); ?>" placeholder="I agree with the terms and conditions"> <label for="ip_upload_tos_content">Terms and conditions of use body</label>
                                <br>
                                <input type="text" name="ip_upload_tos_error" id="ip_upload_tos_error" class="regular-text" value="<?php echo get_imagepress_option('ip_upload_tos_error'); ?>" placeholder="Please indicate that you accept the terms and conditions of use"> <label for="ip_upload_tos_error">Terms and conditions of use error</label>
                                <br>
                                <input type="url" name="ip_upload_tos_url" id="ip_upload_tos_url" class="regular-text" value="<?php echo get_imagepress_option('ip_upload_tos_url'); ?>" placeholder="https://"> <label for="ip_upload_tos_url">Terms and conditions of use URL</label>
                                <br><small>Opens in new tab/window</small>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <hr>
                <h2>Limits and Quotas</h2>
                <p>
                    Set global and per-user upload limits.<br>
                    Set individual limits for each user in their <a href="<?php echo admin_url('users.php'); ?>">profile editor</a>. Individual limits have higher priority than global limits.
                </p>
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label for="ip_global_upload_limit">Maximum image upload limit</label></th>
                            <td>
                                <input type="number" name="ip_global_upload_limit" id="ip_global_upload_limit" min="0" max="999999" step="1" value="<?php echo get_imagepress_option('ip_global_upload_limit'); ?>"> <label for="ip_global_upload_limit">Image upload limit (global, if no other limits are specified)</label>
                                <hr>

                                <p>
                                    <select name="ip_quota_action">
                                        <option value="increase">Increase all users quota by</option>
                                        <option value="decrease">Decrease all users quota by</option>
                                        <option value="set">Set all users quota to</option>
                                    </select> <input name="ip_quota_increase" type="number" min="0" placeholder="0"> images
                                    <br><small>Note that setting a limit higher than the global limit will override it.</small>
                                </p>

                                <hr>
                                <textarea class="large-text" rows="4" id="ip_global_upload_limit_message" name="ip_global_upload_limit_message" placeholder="You have reached the maximum number of images allowed."><?php echo get_imagepress_option('ip_global_upload_limit_message'); ?></textarea>
                                <br><small>Set a message when maximum number of images is reached.</small>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <hr>
                <h2>Integrations</h2>
                <p>Allow third-party modules to hook into the upload functions.</p>
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label><i class="fa fa-dropbox"></i> Dropbox</label></th>
                            <td>
                                <p>
                                    <input type="checkbox" name="ip_dropbox_enable" value="1" <?php if(get_imagepress_option('ip_dropbox_enable') === '1') echo 'checked'; ?>> <label>Enable Dropbox upload</label>
                                </p>
                                <p>
                                    <input name="ip_dropbox_key" id="ip_dropbox_key" type="text" class="regular-text" value="<?php echo get_imagepress_option('ip_dropbox_key'); ?>"> <label for="ip_dropbox_key">Dropbox API Key</label>
                                    <br><small>Allow users to upload images from their Dropbox accounts. Requires an <a href="https://www.dropbox.com/developers/dropins/chooser/js" rel="external">API key</a>. <a href="https://www.dropbox.com/developers/apps/create?app_type_checked=dropins" rel="external">Create new Dropbox app.</a></small>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <p><input type="submit" name="isGSSubmit" value="Save Changes" class="button-primary"></p>
            </form>
        <?php } else if ($tab == 'notifications_tab') {
            if (isset($_POST['notification_add'])) {
                global $wpdb;

                $notification_type_custom = $_POST['notification_type_custom'];
                $notification_icon_custom = $_POST['notification_icon_custom'];
                $notification_link_custom = $_POST['notification_link_custom'];
                $notification_user = $_POST['notification_user'];
                $when = date('Y-m-d H:i:s');

                if(!empty($notification_link_custom))
                    $notification_type = '<a href="' . $notification_link_custom . '">' . $notification_type_custom . '</a>';
                else
                    $notification_type = '' . $notification_type_custom . '';

                $sql = "INSERT INTO " . $wpdb->prefix . "notifications (`userID`, `postID`, `actionType`, `actionIcon`, `actionTime`) VALUES (0, '$notification_user', '$notification_type', '$notification_icon_custom', '$when')";
                $wpdb->query($sql);

                echo '<div class="updated notice is-dismissible"><p>Notification added successfully!</p></div>';
            }
            ?>
            <script>
            jQuery(document).ready(function($) {
                $('.ajax_trash').click(function(e){
                    var data = {
                        action: 'ajax_trash_action',
                        odvm_post: $(this).attr('data-post'),
                    };

                    $.post(ajaxurl, data, function(response) {
                        alert('' + response);
                    });
                    fade_vote = $(this).attr('data-post');
                    $('#notification-' + fade_vote).fadeOut('slow', function(){});
                    e.preventDefault();
                });
            });
            </script>

            <form method="post">
                <h3>Add new notification</h3>
                <p>
                    <input type="text" name="notification_icon_custom" id="notification_icon_custom" class="regular-text" placeholder="fa-bicycle">
                    <label for="notification_icon_custom">Notification icon (FontAwesome)</label>
                    <br>
                    <input type="text" name="notification_type_custom" id="notification_type_custom" class="regular-text">
                    <label for="notification_type_custom">Notification type (custom)</label>
                    <br><small>This is the notification body text (e.g. <em>Check out this great new feature!</em> or <em>You have been verified!</em>).</small>
                </p>
                <p>
                    <input type="url" name="notification_link_custom" id="notification_link_custom" class="regular-text" placeholder="https://">
                    <label for="notification_link_custom">Notification link (custom)</label>
                    <br><small>This is the URL link the text above will point to.</small>
                </p>
                <p>
                    <?php
                    $args = array(
                        'name' => 'notification_user',
                        'show_option_none' => 'Show to this user only (optional, leave blank to show to all users)...'
                    );
                    wp_dropdown_users($args); ?>
                </p>
                <p>
                    <input type="submit" name="notification_add" value="Add custom notification" class="button button-secondary">
                </p>
            </form>

            <hr>
            <h3>All notifications</h3>
            <?php
            global $wpdb;

            $limit = 256;

            $sql = "SELECT * FROM " . $wpdb->prefix . "notifications ORDER BY ID DESC LIMIT " . $limit . "";
            $results = $wpdb->get_results($sql);
            foreach($results as $result) {
                ?>
                <div id="notification-<?php echo $result->ID; ?>">
                    <a href="#" class="ajax_trash" data-post="<?php echo $result->ID; ?>"><i class="fa fa-fw fa-trash"></i></a>&nbsp;
                    <?php
                    $display = '';
                    $action = $result->actionType;
                    $nickname = get_the_author_meta('nickname', $result->userID);
                    $time = human_time_diff(strtotime($result->actionTime), current_time('timestamp')) . ' ago';
                    $ip_collections_page_id = get_imagepress_option('ip_collections_page');

                    if($result->status == 0)
                        $status = '<i class="fa fa-fw fa-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;';
                    if($result->status == 1)
                        $status = '<i class="fa fa-fw fa-check-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;';

                    $display .= $status;
                    $display .= ' [' . $result->ID . '] ';

                    if($action == 'loved')
                        $display .= '' . get_avatar($result->userID, 16) . ' <i class="fa fa-fw fa-heart"></i> <a href="' . getImagePressProfileUri($result->userID, false) . '">' . $nickname . '</a> ' . $action . ' a poster <a href="' . get_permalink($result->postID) . '">' . get_the_title($result->postID) . '</a> <time>' . $time . '</time>';

                    else if($action == 'collected')
                        $display .= '' . get_avatar($result->userID, 16) . ' <i class="fa fa-fw fa-folder"></i> <a href="' . getImagePressProfileUri($result->userID, false) . '">' . $nickname . '</a> ' . $action . ' a poster <a href="' . get_permalink($result->postID) . '">' . get_the_title($result->postID) . '</a> into a <a href="' . get_permalink($ip_collections_page_id) . '?collection=' .  $result->postKeyID . '">collection</a> <time>' . $time . '</time>';

                    else if($action == 'added')
                        $display .= '' . get_avatar($result->userID, 16) . ' <i class="fa fa-fw fa-arrow-circle-up"></i> <a href="' . getImagePressProfileUri($result->userID, false) . '">' . $nickname . '</a> ' . $action . ' <a href="' . get_permalink($result->postID) . '">' . get_the_title($result->postID) . '</a> <time>' . $time . '</time>';

                    else if($action == 'followed')
                        $display .= '' . get_avatar($result->userID, 16) . ' <i class="fa fa-fw fa-plus-circle"></i> <a href="' . getImagePressProfileUri($result->userID, false) . '">' . $nickname . '</a> ' . $result->actionType . ' you <time>' . $time . '</time>';

                    else if($action == 'commented on')
                        $display .= '' . get_avatar($result->userID, 16) . ' <i class="fa fa-fw fa-comment"></i> <a href="' . getImagePressProfileUri($result->userID, false) . '">' . $nickname . '</a> ' . $action . ' a poster <a href="' . get_permalink($result->postID) . '">' . get_the_title($result->postID) . '</a> <time>' . $time . '</time>';

                    else if($action == 'replied to a comment on') {
                        $comment_id = get_comment($result->postID);
                        $comment_post_ID = $comment_id->comment_post_ID;

                        $display .= '' . get_avatar($result->userID, 16) . ' <i class="fa fa-fw fa-comment"></i> <a href="' . getImagePressProfileUri($result->userID, false) . '">' . $nickname . '</a> replied to a comment on <a href="' . get_permalink($comment_post_ID) . '">' . get_the_title($comment_post_ID) . '</a> <time>' . $time . '</time>';
                    }

                    else if($action == 'featured')
                        $display .= '' . get_the_post_thumbnail($result->postID, array(16,16)) . ' <i class="fa fa-fw fa-star"></i> <a href="' . get_permalink($result->postID) . '">' . get_the_title($result->postID) . '</a> poster was ' . $action . ' <time>' . $time . '</time>';

                    // custom
                    else if(0 == $result->postID || '-1' == $result->postID) {
                        $display .= '<i class="fa fa-fw ' . $result->actionIcon . '"></i> ' . $result->actionType . ' <time>' . $time . '</time>';
                    }

                    echo $display;
                    ?>
                </div>
            <?php } ?>
        <?php } else if ($tab == 'fields_tab') {
            global $wpdb;

            if (isset($_POST['isCFSubmit'])) {
                $ip_field_type = intval($_POST['ip_field_type']);
                $ip_field_order = intval($_POST['ip_field_order']);
                $ip_field_name = stripslashes($_POST['ip_field_name']);
                $ip_field_slug = sanitize_text_field($_POST['ip_field_slug']);
                $ip_field_content = sanitize_text_field($_POST['ip_field_content']);

                $wpdb->query($wpdb->prepare("INSERT INTO " . $wpdb->prefix . "ip_fields (field_type, field_order, field_name, field_slug, field_content) VALUES (%d, %d, '%s', '%s', '%s')", $ip_field_type, $ip_field_order, $ip_field_name, $ip_field_slug, $ip_field_content));

                echo '<div class="updated notice is-dismissible"><p>Field added successfully!</p></div>';
            }
            ?>
            <form method="post" action="">
                <h2><?php _e('Custom Fields', 'imagepress'); ?></h2>
                <p>ImagePress custom fields are additional/optional fields used by the upload form to add/select options and values. For example, an image can have five additional fields, like copyright, size, location, country and price.</p>

                <hr>
                <h2><?php _e('Add New Field', 'imagepress'); ?></h2>
                <p>Add new custom field to your upload form.</p>
                <script>
                jQuery(document).ready(function() {
                    jQuery("#ip_field_name").keyup(function() {
                        var ip_slug = jQuery.trim(this.value);
                        $ip_slug = ip_slug.toLowerCase().replace(/[^a-z0-9-]/gi, '_').replace(/-+/g, '_').replace(/^-|-$/g, '');

                        jQuery("#ip_field_slug").val($ip_slug ? $ip_slug : "");
                    });
                });
                </script>
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label for="ip_field_type">Field type</label></th>
                            <td>
                                <select name="ip_field_type" id="ip_field_type">
                                    <option value="1">Input (text)</option>
                                    <option value="2">Input (URL)</option>
                                    <option value="3">Input (email)</option>
                                    <option value="4">Input (number)</option>
                                    <option value="5">Textarea</option>
                                    <option value="6">Checkbox</option>
                                    <option value="7">Radiobox</option>
                                    <option value="8">Dropdown</option>

                                    <optgroup label="Field presets">
                                        <option value="20">Sketchfab (model ID)</option>
                                        <option value="21">Vimeo (video ID)</option>
                                        <option value="22">Youtube (video ID)</option>
                                        <option value="23">Google Maps location (address)</option>
                                        <option value="24">Round.me (tour ID)</option>
                                    </optgroup>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="ip_field_order">Field order</label></th>
                            <td>
                                <input type="number" name="ip_field_order" id="ip_field_order" value="" min="0" max="99999" step="1" placeholder="0">
                                <br><small>This is the field order</small>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="ip_field_name">Field name</label></th>
                            <td>
                                <input type="text" name="ip_field_name" id="ip_field_name" class="regular-text" value="">
                                <br><small>This is the field label</small>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="ip_field_slug">Field slug</label></th>
                            <td>
                                <input type="text" name="ip_field_slug" id="ip_field_slug" class="regular-text" value="">
                                <br><small>This is the field slug</small>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="ip_field_content">Field content<br><small>(optional)</small></label></th>
                            <td>
                                <textarea class="large-text code" rows="4" name="ip_field_content" id="ip_field_content"></textarea>
                                <br><small>Use dropdown options, separated by comma (e.g. <code>Value 1, Value 2, Value 3</code>)</small>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <hr>
                <p><input type="submit" name="isCFSubmit" value="Add Field" class="button-primary"></p>

                <hr>
                <h2><?php _e('Manage Custom Fields', 'imagepress'); ?></h2>

                <?php wp_enqueue_script("jquery"); ?>
                <?php wp_enqueue_script("jquery-ui-core"); ?>
                <?php wp_enqueue_script("jquery-ui-sortable"); ?>
                <script>
                jQuery(document).ready(function() {
                    var fixHelperModified = function(e, tr) {
                        var $originals = tr.children();
                        var $helper = tr.clone();
                        $helper.children().each(function(index) {
                            jQuery(this).width($originals.eq(index).width())
                        });
                        return $helper;
                    };

                    jQuery("#ip-sortable tbody").sortable({
                        helper: fixHelperModified,
                        handle: '.handle',
                        opacity: 0.75,
                        update: function() {
                            var order = jQuery("#ip-sortable tbody").sortable('serialize');
                            //console.log(order);
                            jQuery("#ip-info").load('<?php echo IP_PLUGIN_URL; ?>/includes/sortable-fields.php?' + order);
                        }
                    }).enableSelection();
                });
                </script>
                <?php
                if(isset($_GET['cf'])) {
                    $field_id = (int) $_GET['cf'];

                    $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "ip_fields WHERE field_id = %d", $field_id));

                    echo '<div class="updated notice is-dismissible"><p>Custom field removed successfully!</p></div>';
                }

                $ip_slug = get_imagepress_option('ip_slug');

                $result = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "ip_fields ORDER BY field_order ASC", ARRAY_A);

                echo '<div id="ip-info"><p><i class="fa fa-arrows"></i> ' . __('Drag custom fields to reorder them', 'imagepress') . '</p></div>
                <table id="ip-sortable" class="wp-list-table widefat striped posts">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Field Name</th>
                            <th scope="col">Field Slug</th>
                            <th scope="col">Field Type</th>
                            <th scope="col">Field Content</th>
                            <th scope="col">Shortcode</th>
                            <th scope="col"><div class="dashicons dashicons-admin-generic"></div></th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($result as $field) {
                        echo '<tr id="listItem_' . $field['field_id'] . '">';
                        echo '<td><span class="handle"><span class="dashicons dashicons-move"></span></span></td>';
                            echo '<td><b>' . $field['field_name'] . '</b></td>';
                            echo '<td>' . $field['field_slug'] . '</td>';

                            if((int) $field['field_type'] === 1)
                                echo '<td>Input (text)</td>';
                            if((int) $field['field_type'] === 2)
                                echo '<td>Input (URL)</td>';
                            if((int) $field['field_type'] === 3)
                                echo '<td>Input (email)</td>';
                            if((int) $field['field_type'] === 4)
                                echo '<td>Input (number)</td>';
                            if((int) $field['field_type'] === 5)
                                echo '<td>Textarea</td>';
                            if((int) $field['field_type'] === 6)
                                echo '<td>Checkbox</td>';
                            if((int) $field['field_type'] === 7)
                                echo '<td>Radiobox</td>';
                            if((int) $field['field_type'] === 8)
                                echo '<td>Dropdown</td>';

                            if((int) $field['field_type'] === 20)
                                echo '<td>Sketchfab ID (text)</td>';
                            if((int) $field['field_type'] === 21)
                                echo '<td>Vimeo ID (text)</td>';
                            if((int) $field['field_type'] === 22)
                                echo '<td>Youtube ID (text)</td>';
                            if((int) $field['field_type'] === 23)
                                echo '<td>Google Maps location (text)</td>';
                            if((int) $field['field_type'] === 24)
                                echo '<td>Round.me Tour ID (text)</td>';

                            echo '<td>' . $field['field_content'] . '</td>';
                            echo '<td><code>[ip-field field="' . $field['field_slug'] . '"]</code></td>';
                            echo '<td><a href="' . admin_url('edit.php?post_type=' . $ip_slug . '&page=imagepress_admin_page&tab=fields_tab&cf=' . $field['field_id']) . '"><span class="dashicons dashicons-trash"></span></a></td>';
                        echo '</tr>';
                    }
                echo '</tbody></table>';
                ?>
            </form>
        <?php } else if ($tab === 'extensions') { ?>
            <h2><?php _e('Extensions', 'imagepress'); ?></h2>
            <div class="flex-grid-thirds">
                <div class="ip-card">
                    <h3>Bulk Upload</h3>
                    <p>A backend tool (administrator-only) used to upload multiple images simultaneously. The only limitation is your server configuration.</p>
                    <div class="ip-card-cta">
                        <a href="https://getbutterfly.com/downloads/imagepress-bulk-upload/" class="button button-primary">Get it!</a>
                    </div>
                </div>
                <div class="ip-card">
                    <h3>Email Post Approval</h3>
                    <p>Get notification and approve pending image submissions via email with a single click.</p>
                    <div class="ip-card-cta">
                        <a href="https://getbutterfly.com/downloads/imagepress-email-post-approval/" class="button button-primary">Get it!</a>
                    </div>
                </div>
                <div class="ip-card">
                </div>
            </div>

            <h2><?php _e('Themes', 'imagepress'); ?></h2>
            <div class="grid flex-grid-thirds">
                <div class="ip-card">
                    <h3>Noir UI</h3>
                    <p>Noir UI is the official WordPress theme for ImagePress. Noir UI features custom widgets, a single image template and many tweaks and integration functions.</p>
                    <div class="ip-card-cta">
                        <a href="https://getbutterfly.com/downloads/noir-ui/" class="button button-primary">Get it!</a>
                    </div>
                </div>
                <div class="ip-card">
                </div>
                <div class="ip-card">
                </div>
            </div>
        <?php } ?>
    </div>
    <?php
}
